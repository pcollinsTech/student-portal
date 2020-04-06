<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>@yield('title')</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


      <style>
        .topper{
            text-transform: uppercase; 
        }


        .col-6 { width: 48%;padding: 5px;display:inline-block;}
         
         .row:after { content: "";  clear: both; }
        
      </style>
   </head>
   <body>
      <header>
         @yield('header')
      </header>
      <div class="container">
         @yield('content')
      </div>
      <footer>
         @yield('footer')
      </footer>
   </body>
</html>