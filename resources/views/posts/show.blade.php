@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{$post->titulo}}">
        
            <div class="p-3">
                <p>0 Likes</p>
            </div>
            
            <div>
                {{-- user: metodo de la clase Post.php relaciond e usuarios --}}
                <p class="font-bold"> {{$post->user->username}} </p>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-5">
                    {{ $post->descripcion }}
                </p>
            </div>

        </div>

        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">

                @auth{{-- El usuario no untenticado no va a poder comentar --}}
                    <p class="text-xl font-bold text-center mb-4">Agrega un Nuevo Comentario</p>
                    
                    @if(session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{session('mensaje')}}
                        </div>
                    @endif

                    <form action=" {{ route('comentarios.store', ['post' => $post, 'user' => $user ]) }} " method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                                Agrega un comentario
                            </label>
                            <textarea
                                id="comentario"
                                name="comentario"
                                type="text"
                                placeholder="Agrega un comentario"
                                class="border p-3 w-full rounded-lg @error('name')
                                    border-red-500
                                @enderror"
                                
                            ></textarea>
        
                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm
                                p-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>

                        <input
                        type="submit"
                        value="Comentar"
                        class="bg-red-600 hover:bg-red-700 transition-colors cursor-pointer
                        uppercase font-bold w-full p-3 text-white rounded-lg"
                        />

                    </form> 
                @endauth

                <div class="bg-white shadow mt-10 mb-5 max-h-96 overflow-y-scroll">
                    @if ($post->comentarios->count())
                        @foreach ( $post->comentarios as $comentario )
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('posts.index', $comentario->user) }}" class="font-bold">
                                    {{$comentario->user->username}}
                                </a>
                                <p>{{$comentario->comentario}}</p>
                                <p class="text-sm text-gray-500">{{$comentario->created_at->diffForHumans()}}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No hay comentarios</p>
                    @endif
                </div>
                
            </div>
        </div>
    </div>  
@endsection