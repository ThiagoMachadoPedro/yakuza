@extends('layout/layout')


@section('title', 'index-user')

@section('conteudo')

@include('components/mensagens')

<div class="container">
    <h1>Usuários</h1>


            <span>Pesquisar</span>
                    <div class="card-body">
                        <form action="{{ route('user-index') }}" method="GET">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <input type="text" name="search" class="form-control" placeholder="Buscar por Nick" value="{{ request('search') }}">
        </div>
        <div class="col-md-6 col-sm-12 mt-1">
            <button type="submit" class="btn btn-info btn-sm">Pesquisar</button>
            <a href="{{ route('user-index') }}" class="btn btn-warning btn-sm">Limpar</a>
        </div>
    </div>
</form>

                    </div>


    <div class="row">
       @foreach($users as $user)
    <div class="col-md-3 col-lg-3 mb-3 pt-4">
        <div class="card">


            <a href="{{ route('user-show', ['id' => $user->id]) }}">
                <img src="{{ url("storage/$user->imageUser" ) }}" class="card-img-top" style="width: 100%; height: 200px; object-fit: cover;" alt="Imagem do usuário">
            </a>
            <div class="card-body">
                <h5 class="card-title">Nome: {{ $user->name }}</h5>
                <h5 class="card-text">Nick: {{ $user->nick }}</h5>
                <p class="card-text"><span class="text-gray-800">E-mail:</span> {{ $user->email }}</p>
                <p class="card-text">Data Criação: <small class="text-muted">{{ $user->created_at->format('d/m/Y H:i:s') }}</small></p>
                <div class="d-flex justify-content-between">
                    @auth
                        @if ($access_level === 1)
                            <a href="{{ route('user-edit', ['id' => $user->id]) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('user-delete', ['id' => $user->id]) }}" method="POST">
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
 <div class="d-flex justify-content-center">
    {{ $users->links('pagination::bootstrap-5') }}
</div>
</div>





@endsection
