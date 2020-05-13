<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">



  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Styles -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


</head>

<body style="opacity:0;">
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          <img src="/images/mini.png" alt="logo" style="height:70px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        @if (Route::has('login'))
        <div class="ml-auto links">
          @auth
          <a href="{{ url('/registration') }}">Registration</a>
          <a href="{{ url('/logout') }}">Logout <i class="fa fa-sign-out pl-2"></i></a>
          @else
          <a href="{{ url('/login') }}">Login</a>

          @if (Route::has('register'))
          <a href="{{ url('/register') }}">Register</a>
          @endif
          @endauth
        </div>
        @endif
      </div>
    </nav>

    {{-- Content Section --}}
    <div class="container main-container">
      @yield('contents')
    </div>


    <footer class="bg-dark">
      <div class="container py-5">
        <div class="text-right">
          <img src="/images/logo.png" alt="" style="height: 50px;">
        </div>
      </div>
    </footer>

    {{-- Extra Components --}}
    <VNotys></VNotys>
  </div>
</body>


{{-- Vue Js Library --}}
<script src="{{ mix('/js/app.js')}}"></script>

</html>