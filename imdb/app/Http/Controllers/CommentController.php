<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Método para armazenar um novo comentário
    public function store(Request $request)
    {
        // Criação do novo comentário
        Comment::create([
            'user_id' => $request->user_id,
            'multimedia_id' => $request->multimedia_id,
            'content' => $request->comment_text,
            'parent_id' => $request->parent_id,
        ]);

        // Redirecionaro de volta à página de detalhes do filme depois de criar
        return redirect()->back()->with('success', 'Comment posted successfully!');
    }

    // Método para atualizar o comentario
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->content = $request->input('newComment');
        $comment->save();

        return redirect()->back()->with('success', 'Comment updated successfully.');
    }

    // Método para excluir o comentario, e se for pai elimnar os filhos tambem
    public function destroy($id)
    {
        // Encontrar o comentário pelo ID
        $comment = Comment::findOrFail($id);

        // Verifique se o comentário é um comentário pai
        if ($comment->parent_id === null) {
            // Se for um comentário pai, exclua todos os comentários filhos
            Comment::where('parent_id', $comment->id)->delete();
        }

        // Exclua o comentário original
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}
