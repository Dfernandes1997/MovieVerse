<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Multimedia;
use App\Models\MultimediaFavoritos;
use App\Models\Favoritos;
use App\Models\User;

class FavoritesController extends Controller
{
    public function favorites()
    {
        $user = auth()->user();
        $favoritos = $user->favoritos()->with('multimedia')->get();
        $multimediaFavoritos = MultimediaFavoritos::whereIn('favoritos_id', $favoritos->pluck('id'))->get();

        return view('front-office.favorites.favorites', compact('favoritos','multimediaFavoritos'));
    }
    public function remove($multimediaFavoritosId)
    {
        // Use o ID recebido para localizar a entrada na tabela multimedia_favoritos
        $multimediaFavoritos = MultimediaFavoritos::find($multimediaFavoritosId);

        if (!$multimediaFavoritos) {
            return redirect()->back()->with('error', 'Multimedia not found in WatchList.');
        }

        // Excluir a entrada correspondente
        $multimediaFavoritos->delete();

        return redirect()->back()->with('success', 'Multimedia removed succesfully from WatchList.');
    }

    // Método para atualizar o nome da lista de favoritos
    public function update(Request $request, $id)
    {
        $favorito = Favoritos::findOrFail($id);
        $favorito->name = $request->input('newListName');
        $favorito->save();

        return redirect()->back()->with('success', 'List name updated successfully.');
    }

    // Método para excluir a lista de favoritos
    public function destroy($id)
    {
        $favorito = Favoritos::findOrFail($id);
        $favorito->multimedia()->detach();
        $favorito->delete();

        return redirect()->back()->with('success', 'List deleted successfully.');
    }

    public function create(Request $request)
    {
        $user_id = auth()->user()->id;
        $name = $request->input('list_name');

        $novaLista = Favoritos::create([
            'user_id' => $user_id,
            'name' => $name,
        ]);

        return redirect()->back()->with('success', 'New list created successfully.');
    }

}
