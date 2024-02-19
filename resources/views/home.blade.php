@extends('layouts.app')

@section('titulo')
    Página Principal
@endsection

@section('contenido')
    {{-- Componente --}}
    <x-listar-post :posts="$posts" />
@endsection