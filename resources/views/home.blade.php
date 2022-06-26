@extends('layouts.app')
@section('titulo')
    Pagina principal
@endsection

@section('contenido')
    <x-listar-post :posts="$posts" />
    {{-- Usar un componente --}}
    {{-- La etiqueta cerrada significa que el componente no usa $slots, caso contrario si usa --}}

    {{-- <x-listar-post>
        <h1>Mostrando post desde slot</h1>
    </x-listar-post> --}}


    {{-- Multiples slots --}}
    {{-- <x-listar-post>
        <x-slot:titulo>
            <header>Esto es un header</header>
        </x-slot:titulo>
        <h1>Mostrando post desde slot</h1>
    </x-listar-post> --}}
    {{-- ESTE CODIGO EQUIVALE AL DEL Foreach
        @forelse ($posts as $post)
        <h1>{{ $post->titulo }}</h1>

    @empty
        <p>NO HAY POSTS </p>
        @endforelse --}}
@endsection
