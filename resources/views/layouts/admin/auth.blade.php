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
        @yield('content')
    </div>

    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.js') }}"></script>
</body>
</html>
