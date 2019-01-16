<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        @yield('title')
    </head>
    <body>
        <header>
            <h1>Super titre :)</h1>
        </header>
        @yield('body')
        <footer>
            <p>
                Super footer :)
            </p>
        </footer>
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    </body>
</html>
