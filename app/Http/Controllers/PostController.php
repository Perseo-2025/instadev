<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        //se aplica siempre el middleware para proteger el acceso
        // permitiendo except a ciertos metodos
        $this->middleware('auth')->except(['show','index']);
        
        //Limpiar el cache para que se aplique middleware
        $this->CleanCache();
    }
    
    public function CleanCache()
    {
        header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0',false);
        header('Pragma: no-cache');
    }

    public function index(User $user)
    {
        $posts = Post::where('user_id', $user->id)->latest()->paginate(4);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    /* Creando un registro */
    public function store(Request $rq)
    {
        $this->validate($rq, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        // Post::create([
        //     'titulo' => $rq->titulo,
        //     'descripcion' => $rq->descripcion,
        //     'imagen' => $rq->imagen,
        //     'user_id' => auth()->user()->id 
        // ]);

        // Otra forma
        $post = new Post;
        $post->titulo = $rq->titulo;
        $post->descripcion = $rq->descripcion;
        $post->imagen = $rq->imagen;
        $post->user_id = auth()->user()->id;
        $post->save();

        // $rq->user()->posts()->create([
        //     'titulo' => $rq->titulo,
        //     'descripcion' => $rq->descripcion,
        //     'imagen' => $rq->imagen,
        //     'user_id' => auth()->user()->id 
        // ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }               
    
    public function destroy(Post $post)
    {
       $this->authorize('delete', $post);
       $post->delete();

       //Elimianr Imagen
       $imagen_path = public_path('uploads/' . $post->imagen); /* URL */

       if(File::exists($imagen_path)){
            unlink($imagen_path);
            File::delete($imagen_path);
       }

       return redirect()->route('posts.index', auth()->user()->username);
    }

    
}
