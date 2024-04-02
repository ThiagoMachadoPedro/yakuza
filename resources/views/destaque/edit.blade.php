@extends('layout/layout')

@section('title', 'Editar Usuário')

@section('conteudo')
<div class="container">
    <h1>Editar Post</h1>
     <form action="{{ route('destaque-update', ['id' => $post->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="imagem" class="form-label">Imagem</label>
                    <input type="file" class="form-control" id="destaque" name="destaque" accept="image/*">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="jogadores" class="form-label">Jogadores</label>
                    <input type="text" class="form-control" id="jogadores" name="jogadores" value="{{ $post->jogadores }}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" class="form-control" id="descricao" name="descricao" value="{{ $post->descricao }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <!-- Coloque aqui o outro input -->
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
