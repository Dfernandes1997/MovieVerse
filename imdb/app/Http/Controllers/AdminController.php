<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Genre;
use App\Models\Like;
use App\Models\Multimedia;
use App\Models\MultimediaGenre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function home()
    {
        // total de users
        $totalUsers = User::count();

        // total de likes na multimedia
        $totalLikedMedia = Like::count();

        // total de comentários
        $totalComments = Comment::count();

        // total de multimedia
        $totalMedia = Multimedia::count();

        // todos os gêneros
        $genres = Genre::all();

        // Iniciar um array para armazenar o total de filmes por gênero
        $totalMoviesByGenre = [];

        // Para cada gênero, contar o número de filmes correspondentes
        foreach ($genres as $genre) {
            $genreId = $genre->id;
            
            // Contar o número de multimídias associadas a este gênero
            $totalMovies = DB::table('multimedia_genre')
                ->where('genre_id', $genreId)
                ->count();

            $totalMoviesByGenre[$genre->name] = $totalMovies;
        }

        // 5 multimedias com mais likes
        $multimedia5likes = Multimedia::withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->take(5)
            ->get();

        // 5 multimídias com mais votos no IMDB
        $multimedia5Votes = Multimedia::orderByDesc('imdb_votes')
            ->take(5)
            ->get();

        // 5 users com mais comentários feitos
        $usersWithMostComments = User::join('comments', 'users.id', '=', 'comments.user_id')
            ->select('users.username', DB::raw('COUNT(comments.id) as total_comments'))
            ->groupBy('users.id', 'users.username')
            ->orderByDesc('total_comments')
            ->take(5)
            ->get();



        return view('back-office.admin',[
            'multimedia'=>null,
            'person'=>null,
            'genre'=>null,
            'type'=>null,
            'user'=>null,
            'contact'=>null,
            'totalUsers' => $totalUsers,
            'totalLikedMedia' => $totalLikedMedia,
            'totalComments' => $totalComments,
            'totalMedia' => $totalMedia,
            'totalMoviesByGenre' => $totalMoviesByGenre,
            'multimedia5likes' => $multimedia5likes,
            'multimedia5Votes' => $multimedia5Votes,
            'usersWithMostComments' => $usersWithMostComments,
        ]);
    }
}
