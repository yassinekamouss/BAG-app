<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/connecte/login_sign.css') }}">
</head>
<body>
    
    @yield('form')

    {{-- Include bootstrap's js files  --}}
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>