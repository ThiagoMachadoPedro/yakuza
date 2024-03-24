@extends('layout/layout')


@section('title', 'index-user')

@section('conteudo')

@include('components/mensagens')

<div class="container">
    <h1>Dados dos Usuários</h1>
    <h2>Último Post</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Último Post</th>
                <th>Quantidade</th>
            </tr>
        </thead>
        <tbody>
         @foreach($usersWithPostCount as $user)
    <tr>
        <td>{{ $user->name }}</td>
         <td>{{ $user->last_post_date ? $user->last_post_date->format('d/m/Y H:i:s') : '' }}
        <td>{{ $user->post_count }}</td>
       </td>
    </tr>
@endforeach

        </tbody>
    </table>


</div>


@endsection
