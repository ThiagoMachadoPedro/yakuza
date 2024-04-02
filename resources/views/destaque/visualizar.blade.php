@extends('layout/layout')

@section('title', 'Perfil do Usuário')

@section('conteudo')
<div class="container mt-4">
    <div class="row">
        <div  class="col-lg-3 mb-3 pt-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ url("storage/$post->destaque") }}" class="img-fluid  mb-1" style="width: 450px;" alt="Imagem do usuário">

                     <a href="{{ url("storage/{$post->imagem}") }}" download><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                    </svg></a>

                  <div class="card-body">

                         @if ($post->user)
                    <p class="card-title text-start">Postado por: {{ $post->user->name }}</p>
                    @else
                    <p>Usuário não encontrado!</p>
                    @endif
    <p class="card-title text-start">Jogadores: {{ $post->jogadores }}</p>


    <p class="card-text text-start">Descrição:  {{ $post->descricao }}</p>
      <p class="card-text text-start">Data Criação: <small class="text-muted">{{ $post->created_at->format('d/m/Y H:i:s') }}</small></p>

</div>


@endsection
