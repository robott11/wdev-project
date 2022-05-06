@extends('layouts.admin.auth')
@section('title', 'Admin - Login')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="card mt-3 text-dark text-center" style="width: 350px;">
            <div class="card-header">
                <h2>Login</h2>
            </div>

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <ul>
                        @foreach($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card-body">
                <form method="POST">
                    @csrf

                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="text" class="form-control" name="email" placeholder="email@exemplo.com" autofocus>
                    </div>

                    <div class="form-group my-3">
                        <label>Senha</label>
                        <input type="password" class="form-control" name="password" placeholder="********">
                    </div>

                    <button type="submit" class="btn btn-lg btn-danger">Entrar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
