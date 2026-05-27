<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

<header>
    <nav class="navbar">
        <a class="brand" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.svg') }}" alt="Logo HDC Events">
            <span>HDC Events</span>
        </a>

        <div class="nav-links">
            <a href="{{ url('/') }}">Eventos</a>
            <a href="{{ url('/events/create') }}">Criar Eventos</a>
            <a href="#">Entrar</a>
            <a href="#">Cadastrar</a>
            <a href="{{ url('/contact') }}">Contato</a>
            <a href="{{ url('/products') }}">Produtos</a>
        </div>
    </nav>
</header>

<main>
    @if(session('msg'))
        <p class="msg">{{ session('msg') }}</p>
    @endif

    @yield('content')
</main>

<footer>
    <p>HDC Events &copy; 2026</p>
</footer>

</body>
</html>
