<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Titulo dinâmico -->
        <title>@yield('title')</title>

        <!-- Fonts Google -->
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto"
            rel="stylesheet"
        />

        <!-- CSS BootStrap -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
            crossorigin="anonymous"
        />

        <!-- CSS Aplicação -->
        <link href="/css/styles.css" rel="stylesheet" />

        <script src="/js/script.js"></script>
    </head>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="collapse navbar-collapse" id="navbar">
                <a href="/" class="navbar-brand">
                    <img src="/img/logo.svg" alt="Planeta">
                </a>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/" class="nav-link">Eventos</a>
                    </li>

                    <li class="nav-item">
                        <a href="/events/create" class="nav-link">Criar Eventos</a>
                    </li>

                    <li class="nav-item">
                        <a href="/contact" class="nav-link">Entrar</a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link">Cadastrar</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <body>
        <!-- Conteúdo da página -->
        @yield('content')

        <footer>
            <p>Eventos &copy; 2023</p>
        </footer>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>
</html>
