@extends('layout/layout')

@section('title', 'index-post')

@section('conteudo')


<div class="container">
    <h1>Publicações</h1>

{{-- 
    {{dd(Storage_path())}} --}}
    @include('components/mensagens')

    <div class="row">

          <div class="card mt-3 border-light shadow">
    <span>Pesquisar</span>
    <div class="card-body">
        <form action="{{ route('post-index') }}" method="GET">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <input type="text" name="post" id="post" class="form-control" placeholder="Buscar por Jogadores">
                </div>
                <div class="col-md-4 col-sm-12">
                    <input type="date" name="data" id="data" class="form-control">
                </div>
                <div class="col-md-4 col-sm-12 mt-1">
                    <button type="submit" class="btn btn-info btn-sm">Pesquisar</button>
                    <a href="{{ route('post-index') }}" class="btn btn-warning btn-sm">Limpar</a>
                </div>
            </div>
        </form>
    </div>
</div>





  @foreach($posts as $post)
    <div class="col-md-3 col-lg-3 mb-3 pt-4">
        <div class="card">
            <a href="{{ route('post-show', ['id' => $post->id]) }}">

                    <img src="{{ asset('storage/' . $post->imagem) }}" class="card-img-top" style="width: 100%; height: 200px; object-fit: cover;" alt="Imagem do post">



            </a>

            <div class="card-body">



                     @if ($post->user)
                    <p>Postado por: {{ $post->user->name }}</p>
                    @else
                    <p>Usuário não encontrado!</p>
                    @endif


                <p class="card-title">Jogadores: {{ Str::limit($post->jogadores, 30) }}</p>
                <p class="card-text">Descrição: {{ Str::limit($post->descricao, 20) }}</p>
                <p class="card-text">Data Criação: <small class="text-muted">{{ $post->created_at->format('d/m/Y H:i:s') }}</small></p>

                <div class="d-flex justify-content-between">
                    @auth
                        @if ($access_level === 1)
                            <a href="{{ route('post-edit', ['id' => $post->id]) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('post-delete', ['id' => $post->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endforeach




    </div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nova Publicação</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h1>Cadastro de Post</h1>
                <form action="{{route('post-store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="imagem" class="form-label">Post</label>
                                <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jogadores" class="form-label">Jogadores</label>
                                <input type="text" class="form-control" id="jogadores" name="jogadores" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descricao</label>
                                <input type="text" class="form-control" id="descricao" name="descricao" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar</button>

                </form>
            </div>
        </div>
    </div>
</div>

<button type="button" class="btn btn-success mt-4 rounded-circle float-end mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <span class="fs-3"> <i class="fas fa-plus"></i></span>
</button>



    <div class="d-flex justify-content-center mt-3">
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection
