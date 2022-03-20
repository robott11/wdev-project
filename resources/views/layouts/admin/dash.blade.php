<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">

    <title>@yield('title')</title>
</head>
<body class="bg-dark text-light">
    <div class="container">
        <section id="menu">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container">
                    <a href="{{ route('admin.home') }}" class="navbar-brand">WDEV</a>

                    <div class="collapse navbar-collapse">

                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('admin.home') }}">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('admin.testimony') }}">Depoimentos</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" href="">Usuários</a>
                            </li>
                        </ul>

                        <div class="d-flex justify-content-end" style="width: 100%;">
                            <a href="{{ route('admin.logout') }}">
                                <button type="button" class="btn">Sair</button>
                            </a>
                        </div>

                    </div>
                </div>
            </nav>

        </section>

        <section id="module">
            <div class="container pt-3">
                @yield('content')
            </div>
        </section>

    </div>

    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.js') }}"></script>
</body>
</html>
