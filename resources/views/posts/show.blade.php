@extends('layouts.app')
@section('titulo')
    {{ $post->titulo }}
@endsection
@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
            <div class="p-3 flex items-center gap-4">
                @auth
                    {{-- Componente livewire --}}
                    <livewire:like-post :post="$post" />

                    {{-- Permite que un user no autenticado no de likes --}}
                    {{-- @if ($post->checkLike(auth()->user()))
                        <form method="POST" action="{{ route('posts.likes.destroy', $post) }}">
                            @method('DELETE')
                            @csrf
                            <div class="my-4">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="red" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    @else
                        <form method="POST" action="{{ route('posts.likes.store', $post) }}">
                            @csrf
                            <div class="my-4">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="white" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    @endif --}}
                @endauth
                {{-- <p class="font-bold">{{ $post->likes->count() }}
                    <span class="font-normal">Likes</span>
                </p> --}}
            </div>
            <div>
                <p class="font-bold">{{ $post->user->username }}</p>
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                <p class="mt-5">
                    {{ $post->descripcion }}
                </p>
            </div>
            {{-- Confirmamos que el user este autenticado --}}
            @auth
                {{-- Preguntamos si el usuario autenticado corresponde al actual para poder eliminar --}}
                @if ($post->user_id === auth()->user()->id)
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        {{-- Esta practica se conoce como metodo Spoofing --}}
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="Eliminar publicación"
                            class="bg-red-500 hover:bg-red-600 p-2  rounded text-white font-bold mt-4 cursor-pointer">
                    </form>
                @endif
            @endauth
        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                {{-- auth valida que un usuario este autenticado --}}
                @auth
                    <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>
                    @if (session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{ session('mensaje') }}</div>
                    @endif
                    <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold" for="">
                                Añade un comentario
                            </label>
                            <textarea id="comentario" name="comentario" placeholder="Agrega un comentario"
                                class="border p-3 w-full rounded-lg @error('descripcion') border-red-500 @enderror">
                        </textarea>
                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>
                        <input type="submit" value="Comentar"
                            class="bg-sky-600 hover:bg-sky-700 transitions-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                    </form>
                @endauth
                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5 border-gray-300 border-b">
                                <div class="flex ml-3">
                                    <div class="mr-3">
                                        <img src="http://picsum.photos/50" alt="" class="rounded-full">
                                    </div>
                                    <div>
                                        <a href="{{ route('posts.index', $comentario->user) }}" class="font-semibold">
                                            {{ $comentario->user->username }}
                                        </a>
                                        <p>{{ $comentario->comentario }}</p>
                                        <p class="text-sm text-gray-500">
                                            {{ $comentario->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No hay comentarios aún</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
