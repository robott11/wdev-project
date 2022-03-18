@extends('layouts.pages.page')
@section('title', 'Depoimentos')

@section('content')
    <h1>Depoimentos</h1>

    <hr>

    <section id="testimonies">

    </section>

    <section id="form">
        <h3>Envie seu depoimento</h3>

        <form method="POST">
            @csrf

            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" name="name" required>
            </div>

            <div class="form-group">
                <label>Mensagem</label>
                <textarea class="form-control" rows="5" name="message"></textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Enviar</button>
        </form>
    </section>
@endsection
