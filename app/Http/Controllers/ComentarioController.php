<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    // Solo usuarios autenticado pueden comentar
    public function store(Request $rq, User $user, Post $post)
    {
        // validar el formulario de comentarios
        $this->validate($rq, [
            'comentario' => 'required|max:255' 
        ]);

        // almacenar el resultado
        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $rq->comentario 
        ]);

        // Imprimir un mensaje
        return back()->with('mensaje', 'Comentario Realziado Correctamente');

    }
}
