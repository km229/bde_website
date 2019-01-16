<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        @yield('title')
    </head>
    <body>
        @yield('body')
        <script src="{{ asset('js/bootstrap.min.js') }}">
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}">
    </body>
</html>
