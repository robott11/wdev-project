@extends('layouts.admin.dash')
@section('title', 'Admin - Excluir depoimento')

@section('content')
    <h1>Excluir depoimento</h1>

    <hr>

    <a href="{{ route('admin.testimony') }}">
        <button type="button" class="btn btn-warning">Voltar</button>
    </a>

    <hr>

    <form method="POST">
        @csrf

        <div class="form-group">
            Você deseja excluir o depoimento de <b>{{ $name }}</b> com o texto <b>"{{ $message }}"</b> ?
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-danger">Excluir</button>
        </div>
    </form>
@endsection
