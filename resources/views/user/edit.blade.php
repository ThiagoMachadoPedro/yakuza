@extends('layout/layout')

@section('title', 'Editar Usuário')

@section('conteudo')
<div class="container">
    <h1>Editar Usuário</h1>
    <form action="{{ route('user-update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>

           <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>

          <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" class="form-control" id="password" name="password"  required>
        </div>

         <div class="mb-3">
            <label for="nick" class="form-label">Nick</label>
            <input type="text" class="form-control" id="nick" name="nick" value="{{ $user->nick }}" required>
        </div>


        <div class="mb-3">
            <label for="imageUser" class="form-label">Imagem</label>
            <input type="file" class="form-control" id="imageUser" name="imageUser" accept="image/*">
        </div>
          {{-- implementar depoois quem poder ver essa opção --}}

            @auth
            @if ($access_level === 1)

          <div class="col-md-6">
    <div class="mb-3">
        <label for="access_level" class="form-label">Selecione uma opção:</label>

                <select class="form-select" id="access_level" name="access_level" aria-label="Selecione uma opção">
                    <option selected>Selecione...</option>
                    <option value="1" {{ $user->access_level == 1 ? 'selected' : '' }}>ADMIN</option>
                    <option value="2" {{ $user->access_level == 2 ? 'selected' : '' }}>USUÁRIO</option>
                </select>
            @endif
        @endauth
         <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</div>

    </form>
</div>
@endsection
