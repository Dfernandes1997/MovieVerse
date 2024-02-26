<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentLike;
use App\Models\Favoritos;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Recupera os likes do user com os detalhes da multimídia
        $likes = Like::where('user_id', $user->id)->with('multimedia')->get();

        
        $watchlistCount = Favoritos::where('user_id', $user->id)->count();
        $comments = Comment::where('user_id', $user->id)->count();
        $medialikes = Like::where('user_id', $user->id)->count();
        $commentlikes = CommentLike::where('user_id', $user->id)->count();
        
        return view('front-office.profile', compact('likes','watchlistCount','comments','medialikes','commentlikes'));
    }

    public function update(Request $request)
    {
        // Extrai o ID do user autenticado
        $userId = auth()->id();

        // Localiza o user na tabela Users usando o ID
        $user = User::findOrFail($userId);
        
        // Atualiza os campos do user com os dados do formulário
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        
        // Salva as alterações no banco de dados
        $user->save();

        // Redireciona com uma mensagem de sucesso
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
