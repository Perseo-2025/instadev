<div>
    @if($posts->count())

        <div class="grid md:grid-cols-2 lg:grid-col-3 xl:grid-cols-6 gap-6">
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                        <img src="{{ asset('uploads') . '/' .  $post->imagen}}" alt="Imagen del post {{$post->titulo}}">
                    </a>
                </div>    
            @endforeach
        </div>
        {{-- paginacion --}}
        <div class="my-10">
            {{$posts->links('pagination::tailwind')}}
        </div>

    @else
        <p class="text-center">No hay posts. Empieza a seguir a los desarrolladores</p>
    @endif
</div>