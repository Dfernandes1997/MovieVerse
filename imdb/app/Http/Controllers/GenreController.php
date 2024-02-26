<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'asc');

        $genre = Genre::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder
                ->where(function ($innerQueryBuilder) use ($query) {
                    $innerQueryBuilder->where('name', 'like', '%' . $query . '%');
                });
        })->orderBy($sort, $order)
        ->paginate(15);


        return view('back-office.admin', [
            'genre'=>$genre,
            'person' => null,
            'multimedia' => null,
            'type'=>null,
            'user'=>null,
            'contact'=>null,
        ], ["genre"=> $genre, "query" => $query,'sort' => $sort, 'order' => $order]);
    }

    public function delete(Request $request, $id)
    {
        $genre = Genre::findOrFail($id);
        
        $genre->delete();

        return redirect()->route('admin.genres')->with('success', 'Genre deleted successfully');
    }

    public function edit($id)
    {
        $genre = Genre::findOrFail($id);
        return view('back-office.genre.edit', compact('genre'));
    }

    public function update(Request $request, $id)
    {
        $genre = Genre::findOrFail($id);
        $genre->update($request->all());
        return redirect()->route('admin.genres')->with('success', 'Genre updated successfully');
    }

    public function create()
    {
        return view('back-office.genre.create');
    }

    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Cria uma nova instância e atribui os valores
        $genre = new Genre();
        $genre->name = $request->name;

        // Salvar o novo objeto no banco de dados
        $genre->save();

        // Redireciona de volta com uma mensagem de sucesso
        return redirect()->route('admin.genres')->with('success', 'Genre created successfully');
    }
}
