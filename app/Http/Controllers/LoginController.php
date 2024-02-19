<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $rq)
    {
        $this->validate($rq, [
            'email' => 'required|email|max:60',
            'password' => 'required'
        ]);

        // En caso de que el usuario no se pueda autenticar
        // Comprueba si las credenciales son correctas
        if(!auth()->attempt($rq->only('email','password'),$rq->remember ) ){
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        // Reescribir el nuevo password(pendiente)

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
