@extends('layouts.pages.page')
@section('title', 'Depoimentos')

@section('content')
    <h1>Depoimentos</h1>

    <hr>

    <section id="testimonies">
        @foreach($testimonies as $testimony)
            <div class="card text-dark mb-3">
                <h5 class="card-header">{{ $testimony->name }} <small>{{ date_format($testimony->created_at, 'd/m/Y H:i') }}</small></h5>
                <div class="card-body">{{ $testimony->message }}</div>
            </div>
        @endforeach

        {{ $testimonies->links() }}
    </section>

    <section id="form">
        <h3>Envie seu depoimento</h3>

        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST">
            @csrf

            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" name="name">
            </div>

            <div class="form-group">
                <label>Mensagem</label>
                <textarea class="form-control" rows="5" name="message"></textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Enviar</button>
        </form>
    </section>
@endsection
