<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentLikeController extends Controller
{
    public function commentlike(Request $request, Comment $comment)
    {
        $user = auth()->user();
        
        // Verifique se o user já deu like neste comment
        if (!$user->commentLikes()->where('comment_id', $comment->id)->exists()) {
            // Se o user ainda não deu like, coluna likes mais 1
            $comment->increment('likes');

            // Criar um registo na tabela de comment_likes
            $user->commentLikes()->create(['comment_id' => $comment->id]);
        }

        // Redirecione de volta para a página anterior
        return back();
    }

    public function commentunlike(Request $request, Comment $comment)
    {
        $user = auth()->user();
        
        // Verificar se o user já deu like neste comment
        if ($user->commentLikes()->where('comment_id', $comment->id)->exists()) {
            // Se o user já deu like, remover a entrada na tabela de comments_likes
            $user->commentLikes()->where('comment_id', $comment->id)->delete();

            // Reduzir a contagem de likes na coluna likes da tabela comment
            $comment->decrement('likes');
        }

        // Redirecione de volta para a página anterior
        return back();
    }
}
