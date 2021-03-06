<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/images/mini.png" alt="logo" style="height:70px">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @if (Route::has('login'))
                        <div class="top-right links">
                            @auth
                                <a href="{{ url('/registration') }}">Registration</a>
                                <a href="{{ url('/logout') }}">Logout <i class="fa fa-sign-out pl-2"></i></a>
                            @else
                                <a href="{{ route('login') }}">Login</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif

             
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if($errors->any())
                <div class="container">
                    <div class="alert alert-danger text-center">
                        {{$errors->first()}}
                    </div>
                </div>
            @endif
            @if(session()->has('message'))
                    <div class="container">
                        <div class="alert alert-success text-center">
                            {{ session()->get('message') }}
                        </div>
                    </div>
            @endif
            @yield('content')
        </main>
        
    </div>
    <footer class="bg-dark">
        <div class="container py-5">
        
        <div class="text-right">
            <img src="/images/logo-white.png" alt="" style="height: 50px;">
        </div>
        </div>
    </footer>
    @yield('scripts')
</body>
</html>
