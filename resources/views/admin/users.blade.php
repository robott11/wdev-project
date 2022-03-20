@extends('layouts.admin.dash')
@section('title', 'Admin - Usuários')

@section('content')
    <h1>Usuários</h1>
    <p>Usuários administrativos</p>

    <hr>

    <table class="table table-light table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Data</th>
            <th>Editado</th>
            <th style="width: 200px;">Ações</th>
        </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td style="width: 175px">{{ $user->created_at }}</td>
                    <td style="width: 175px">{{ $user->updated_at }}</td>
                    <td>
                        <a href="">
                            <button type="button" class="btn btn-primary">Editar</button>
                        </a>
                        <a href="">
                            <button type="button" class="btn btn-danger">Excluir</button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
@endsection
