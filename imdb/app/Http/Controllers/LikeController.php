<?php

namespace App\Http\Controllers;

use App\Models\Multimedia;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Request $request, Multimedia $multimedia)
    {
        $user = auth()->user();
        
        // Verifique se o user já deu like nesta multimedia
        if (!$user->likes()->where('multimedia_id', $multimedia->id)->exists()) {
            // Se o user ainda não deu like, coluna likes mais 1
            $multimedia->increment('likes');

            // Criar um registo na tabela de likes
            $user->likes()->create(['multimedia_id' => $multimedia->id]);
        }

        // Redirecione de volta para a página anterior
        return back();
    }

    public function unlike(Request $request, Multimedia $multimedia)
    {
        $user = auth()->user();
        
        // Verificar se o user já deu like nesta multimedia
        if ($user->likes()->where('multimedia_id', $multimedia->id)->exists()) {
            // Se o user já deu like, remover a entrada na tabela de likes
            $user->likes()->where('multimedia_id', $multimedia->id)->delete();

            // Reduzir a contagem de likes na coluna likes da tabela multimedia
            $multimedia->decrement('likes');
        }

        // Redirecione de volta para a página anterior
        return back();
    }
}
