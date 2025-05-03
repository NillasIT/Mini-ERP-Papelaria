<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @yield('styles')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="container">
        @include('components.sidebar')

        <div class="content">
            <div class="content-box">
                <div class="header">
                    <h1>Bem-vindo, {{ auth()->check() ? auth()->user()->name : 'Visitante' }}!</h1>

                    <div class="perfil-btn">
                        <a href="{{ route('profile') }}">
                            <img src="{{ asset('assets/icons/profile.png') }}" alt="dasboard">
                            Ver perfil
                        </a>
                    </div>
                </div>
                
                <div class="body-content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    @yield('modals')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('scripts')
</body>
</html>
