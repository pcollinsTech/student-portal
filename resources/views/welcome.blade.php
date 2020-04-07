<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <title>{{ config('app.name', 'Laravel') }}</title>
         <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 54px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
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
                    <ul class="navbar-nav ml-auto">
                    <a href="{{ route('login') }}" style="color:white; font-size:20px">
                        Login <i class="fa fa-sign-out pl-2"></i>
                    </a>
                    </ul>

             
                </div>
            </div>
        </nav>
        <div class="flex-center position-ref my-5">
            

            <div class="content my-5">
                <div class="title m-b-md my-5">
                    <img src="/images/logo.png" alt="">
                    <br/>
                    <p style="font-size: 2rem;">
                        Welcome to the Online Application Portal to Register as a <br/>
                        Pre-registration Trainee of the Pharmaceutical Society NI
                    </p>    
                    <br/>
                  <p style="font-size: 2rem;">
                        To begin your application, please click on the button below
                    </p>
                </div>
                <div class="d-flex justify-content-around">
                    <a href="{{ route('register') }}">
                        <button class="button">Begin Application  >></button>
                    </a>
                    
                </div>
            </div>
        </div>
        <footer class="bg-dark">
            <div class="container py-5">
            
            <div class="text-right">
                <img src="/images/logo.png" alt="" style="height: 50px;">
            </div>
            </div>
        </footer>
    </body>
</html>
