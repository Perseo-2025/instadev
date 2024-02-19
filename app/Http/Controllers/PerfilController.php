<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $rq)
    {
        //Modificar el Request
        $rq->request->add(['username' => Str::slug($rq->username)]);

        $this->validate($rq, [
            'username' => ['required','unique:users,username,'.auth()->user()->id, 'min:3', 'max:20',
            'not_in:instadev,editar-perfil'],
        ]);

        if($rq->imagen){
            $imagen = $rq->file('imagen');
            $nombreImagen = Str::uuid() . "." . $imagen->extension(); /* Genera un id unico */
            
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);
    
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        //Guardar Cambios
        $usuario = User::find(auth()->user()->id);

        $usuario->username = $rq->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        //Redireccionar al usuario
        return redirect()->route('posts.index', $usuario->username);
    }
}
