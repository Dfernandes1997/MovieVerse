<?php

namespace App\Http\Controllers;

use App\Models\Multimedia;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'asc');


        $topmovies = Multimedia::orderBy('imdb_votes', 'desc')
                        ->take(6)
                        ->get(); // Obter os 5 filmes com mais votos
        $rankedmovies = Multimedia::orderBy('imdb_rating', 'desc')
                        ->take(3)
                        ->get(); // Obter os 3 filmes com mais pontuação
        
        $todaypicks = Multimedia::inRandomOrder()
                        ->take(4)
                        ->get();
        
        $multimedia = Multimedia::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder
                ->where(function ($innerQueryBuilder) use ($query) {
                    $innerQueryBuilder->where('title', 'like', '%' . $query . '%');
                });
        })->orderBy($sort, $order)
        ->paginate(12);

        return view('front-office.home', compact( 'multimedia', 'topmovies','rankedmovies','todaypicks'), ["multimedia"=> $multimedia, "query" => $query,'sort' => $sort, 'order' => $order]);
    }

}
