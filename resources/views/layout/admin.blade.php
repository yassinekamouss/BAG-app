<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- font de google : --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    {{-- bootstrap --}}
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.2-web/css/all.min.css') }}">
    {{-- sidebare style! --}}
    <link rel="stylesheet" href="{{ asset('css/admin/admin-sidebare.css') }}">
    <title>@yield('title' , 'Admin page')</title>
    @yield('style')
    
</head>
<body>

    <div class="container-fluid">
        <div class="row flex-nowrap">
            {{-- slide bare --}}
                <x-sideBare />
            {{-- fin slide bare --}}

            {{-- contenu des pages d'admin --}}
                @yield('content')
            {{-- fin contenu des pages d'admin --}}
        </div>
    </div>
    
    
    {{-- Include bootstrap's js files  --}}
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    {{-- <script src="https://kit.fontawesome.com/75eed29eab.js" crossorigin="anonymous"></script> --}}

    {{-- File de script de associe a la page --}}
    @vite('resources/js/app.js')
    <script src="{{ asset('js/admin/confirm_delete.js') }}"></script>
    <script src="{{ asset('js/admin/new_commande_client.js') }}"></script>
    @yield('js')
</body>
</html>