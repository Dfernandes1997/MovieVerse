<?php

namespace App\Http\Controllers;

use App\Models\Favoritos;
use App\Models\Genre;
use App\Models\Multimedia;
use App\Models\MultimediaGenre;
use App\Models\MultimediaFavoritos;
use App\Models\Person;
use App\Models\PersonRole;
use App\Models\Type;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request) // mostrar view
    {
        $query = $request->input('query');
        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'asc');

        $genres = Genre::all();
        $multimediaGenres = MultimediaGenre::all();
        $persons = Person::all();
        $personRoles = PersonRole::all();
        $types = Type::all();

        $topmovies = Multimedia::orderBy('imdb_votes', 'desc')
                        ->take(6)
                        ->get(); // Obter os 5 filmes com mais votos
        $rankedmovies = Multimedia::orderBy('imdb_rating', 'desc')
                        ->take(3)
                        ->get(); // Obter os 3 filmes com mais pontuação
        
        $multimedia = Multimedia::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder
                ->where(function ($innerQueryBuilder) use ($query) {
                    $innerQueryBuilder->where('title', 'like', '%' . $query . '%');
                });
        })->orderBy($sort, $order)
        ->paginate(12);

        // verificar se está ou não nos favoritos do user 
        $user = auth()->user();
        if ($user && $user->favoritos) {
            // Obtém os IDs dos favoritos do usuário
            $favoriteMultimediaIds = $user->favoritos->flatMap->multimedia->pluck('id')->toArray();
        } else {
            // Caso o user não esteja autenticado ou não tenha favoritos
            $favoriteMultimediaIds = [];
        }

        // Verifica se o user está autenticado e se possui favoritos para apresentar no modal
        $favoriteLists = [];
        $user = auth()->user();
        if ($user && $user->favoritos) {
            $favoriteLists = $user->favoritos;
        }

        return view('front-office.multimedia.browse', compact('genres', 'multimedia', 'multimediaGenres', 'persons', 'personRoles', 'types', 'topmovies','rankedmovies','favoriteMultimediaIds', 'favoriteLists'), ["multimedia"=> $multimedia, "query" => $query,'sort' => $sort, 'order' => $order]);
    }

    public function show($id) //filmes individuais, details
    {
        $movie = Multimedia::findOrFail($id);
        $comments = $movie->comments()->whereNull('parent_id')->with('children')->get(); // passar comentarios para a view details 

        // Obter os generos(o nome não id) associados ao filmes atraves da tabela relacional, definida no multimedia model
        $genres = $movie->genres()->pluck('name')->toArray();

        // 4 filmes do mesmo genero 
        $relatedMovies = Multimedia::whereHas('genres', function ($query) use ($genres) {
            $query->whereIn('name', $genres);
        })
        ->where('id', '!=', $movie->id) // Excluir o filme atual
        ->inRandomOrder() // aleatoriamente
        ->take(4) // 4 resultados
        ->get();

        // Carregar as pessoas associadas a esta multimedia
        $cast = $movie->persons()->withPivot('role')->get();

        // Inicia um array para agrupar pessoas pelo papel
        $groupedCast = [];

        // Agrupa as pessoas pelo papel
        foreach ($cast as $person) {
            $role = $person->pivot->role;
            $groupedCast[$role][] = $person;
        }

        // verificar se esta ou não nos favoritos
        $user = auth()->user();
        if ($user && $user->favoritos) {
            // Obtém os IDs dos favoritos do usuário
            $favoriteMultimediaIds = $user->favoritos->flatMap->multimedia->pluck('id')->toArray();
        } else {
            // Caso o user não esteja autenticado ou não tenha favoritos
            $favoriteMultimediaIds = [];
        }

        return view('front-office.multimedia.details', compact('movie','genres', 'groupedCast','favoriteMultimediaIds', 'relatedMovies', 'comments', 'id'));
    }

    public function addToFavorites(Request $request) //adicionar aos favoritos atraves do all media
    {
        $user = auth()->user();

        // Verifica se o user está autenticado
        if (!$user) {
            return redirect()->back()->with('error', 'You must be logged in to add to watchlist.');
        }

        // Obtém os dados do formulário
        $favoriteListId = $request->input('favoriteList');
        $newListName = $request->input('newListName');
        $multimediaId = $request->input('multimedia_id');

        // Verifica se o multimedia já está na lista de favoritos
        $multimediaAlreadyInFavorites = MultimediaFavoritos::where('favoritos_id', $favoriteListId)
            ->where('multimedia_id', $multimediaId)
            ->exists();

        if ($multimediaAlreadyInFavorites) {
            return redirect()->back()->with('success', 'This multimedia is already in this watchlist.');
        }


        // Verifica se o user selecionou uma lista existente ou criou uma nova
        if ($favoriteListId) {
            // Adiciona o filme à lista existente
            $favorite = Favoritos::findOrFail($favoriteListId);
            $favorite->multimedia()->attach($multimediaId);
        } elseif ($newListName) {
            // Cria uma nova lista de favoritos
            $favorite = new Favoritos();
            $favorite->user_id = $user->id;
            $favorite->name = $newListName;
            $favorite->save();
            $favorite->multimedia()->attach($request->input('multimedia_id'));
        } else {
            return redirect()->back()->with('error', 'Please select a list or enter a new list name.');
        }

        return redirect()->back()->with('success', 'Added to favorites successfully.');
    }

    public function removefromFavorites(Request $request) //remover dos favoritos atraves do all media
    {
        // Recuperar o ID da multimídia a ser removida da lista
        $multimediaIdToRemove = $request->input('multimedia_id');
        $favoriteListId = $request->input('favoriteList');

        // Verificar se user esta logado
        $user = auth()->user();
        if (!$user) {
            return redirect()->back()->with('error', 'You must be logged in to remove from favorites.');
        }

        try {
            // Remover a entrada correspondente na tabela multimedia_favoritos
            MultimediaFavoritos::where('multimedia_id', $multimediaIdToRemove)
            ->where('favoritos_id', $favoriteListId)
            ->delete();

            // Redirecione de volta à página anterior com uma mensagem de sucesso
            return redirect()->back()->with('success', 'Removed from favorites successfully.');
        } catch (\Exception $e) {
            // Em caso de erro, redirecione de volta com uma mensagem de erro
            return redirect()->back()->with('error', 'Failed to remove from favorites.');
        }
    }
}
