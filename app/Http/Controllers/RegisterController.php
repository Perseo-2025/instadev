<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function  index() 
    {
        return view('auth.register');
    }

    public function store(Request $rq)
    {
       // dd($rq);
       // dd($rq->get('name'));

        // Modificar el Request
        $rq->request->add(['username' => Str::slug($rq->username)]);

       // Validacion 
        $this->validate($rq, [
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:30',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);
        //User::created = INSERT INTO usuarios;
        User::create([
            'name' => $rq->name, 
            'username' => $rq->username,
            'email' => $rq->email,
            'password' => Hash::make($rq->password)
        ]);

        // Auntenticar usuarios
        auth()->attempt([
            'email'=>$rq->email,
            'password'=>$rq->password
        ]);
        //otra forma
        //auth()->attempt($rq->only('email','password'));

        //Redireccionar
        return redirect()->route('posts.index');
    }
  
}
