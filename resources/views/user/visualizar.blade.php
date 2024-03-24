@extends('layout/layout')

@section('title', 'Perfil do Usuário')

@section('conteudo')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ url("storage/$user->imageUser") }}" class="img-fluid rounded-circle mb-3" style="width: 350px;" alt="Imagem do usuário">

                    <div class="card-body">
                        <h5 class="card-title text-start">Nome: {{ $user->name }}</h5>
                        <p class="card-text text-start">Email: {{ $user->email }}</p>
                        <p class="card-text text-start">Nick: {{ $user->nick }}</p>
                        <p class="card-text text-start">Data Criação: <small class="text-muted">{{ $user->created_at->format('d/m/Y H:i:s') }}</small></p>
                       
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Posts</h5>
                    <div class="row">
                        @foreach($posts as $post)
                        <div class="col-md-4 mb-3">
                            <img src="{{ url("storage/{$post->imagem}") }}" class="img-fluid" alt="Foto">
                             <p class="card-title">Jogadores: {{ Str::limit($post->jogadores, 30) }}</p>
                <p class="card-text">Descrição: {{ Str::limit($post->descricao, 20) }}</p>


                                                <a href="{{ url("storage/{$post->imagem}") }}" download><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                    </svg></a>
          </div>
                        @endforeach


                    </div>
                     <div class="d-flex justify-content-center">
    {{ $posts->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection
