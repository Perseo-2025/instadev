<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        /* Autenticando para que puedan ver la pagina principal */
        $this->middleware('auth');
    }


    public function __invoke()
    {
        // Obtener a quien seguimos
        $ids =  auth()->user()->following->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);

        return view('home', [
            'posts' => $posts
        ]);
    }

}