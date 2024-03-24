@extends('layout/layout')


@section('title', 'index-user')

@section('conteudo')



      <div class="container">
    <h1>Cadastro de Post</h1>
    <form action="{{route('user-store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nick" class="form-label">Nick</label>
                    <input type="text" class="form-control" id="nick" name="nick" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="imageUser" class="form-label">Perfil</label>
                    <input type="file" class="form-control" id="imageUser" name="imageUser" accept="image/*" required>
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary ">Enviar</button>
        {{-- implementar para voltar ao login
        <a href="{{route('index')}}"></a> --}}
    </form>
</div>


@endsection
