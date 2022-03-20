@extends('layouts.admin.dash')
@section('title', 'Admin - Editar depoimento')

@section('content')
    <h1>Editar Depoimento</h1>

    <hr>

    <a href="{{ route('admin.testimony') }}">
        <button type="button" class="btn btn-warning">Voltar</button>
    </a>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <hr>

    <form method="POST">
        @csrf

        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="name" class="form-control" value="{{ $name }}">
        </div>

        <div class="form-group my-3">
            <label>Mensagem</label>
            <textarea name="message" class="form-control" rows="5">{{ $message }}</textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>
    </form>
@endsection
