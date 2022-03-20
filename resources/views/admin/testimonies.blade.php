@extends('layouts.admin.dash')
@section('title', 'Admin - Depoimentos')

@section('content')
    <h1>Depoimentos</h1>
    <p>Depoimentos enviados pelos usuários</p>

    <hr>

    @if(session('status'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-light table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th style="width: 200px;">Nome</th>
                <th>Texto</th>
                <th>Data</th>
                <th>Editado</th>
                <th style="width: 200px;">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($testimonies as $testimony)
                <tr>
                    <td>{{ $testimony->id }}</td>
                    <td>{{ $testimony->name }}</td>
                    <td>{{ $testimony->message }}</td>
                    <td>{{ date_format($testimony->created_at, 'd/m/Y H:i:s') }}</td>
                    <td>{{ date_format($testimony->updated_at, 'd/m/Y H:i:s') }}</td>
                    <td>
                        <a href="{{ route('admin.testimony.edit', [$testimony->id]) }}">
                            <button type="button" class="btn btn-primary">Editar</button>
                        </a>

                        <a href="{{ route('admin.testimony.del', [$testimony->id]) }}">
                            <button type="button" class="btn btn-danger">Excluir</button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $testimonies->links() }}
@endsection
