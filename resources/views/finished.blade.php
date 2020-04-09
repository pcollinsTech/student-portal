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
                color: white;
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
        <div class="container mb-4" style="line-height: 2rem;">
            

        <h3 class="text-center my-5">Thank You For Submitting Your Online Application</h3>

<p>Your Application will now be reviewed by the Pre Reg Team, if you could please read the below information before closing this window.</p>

<h4 class="primary mt-5 mb-3">1. How will I know my application has been successfully processed?</h4>

<p>We will write to you to confirm if your application has been accepted - this may take several weeks after the deadline for receipt of applications. The letter will provide you with your pre-registration training number and confirm your anticipated start date. Your tutor will also receive a confirmation letter</p>


<h4 class="primary mt-5 mb-3">2. What if my Fitness to Practise circumstances change during the application process or my training year?</h4>

<p>You must notify us if anything occurs that would change the fitness to practise declaration that you made part of the application. This must be done within 7 days. A ‘Self Declaration Form’ must be completed.</p>


<h4 class="primary mt-5 mb-3">3. What if my tutor/site/dates have changed after I have submitted my application?</h4>

<p>If your start date changes prior to commencing training, please ask your employer to email us at pre-registration@psni.org.uk with the details of the change – NB the Pharmaceutical Society will only take instruction from the employer.</p>

<p>If your tutor or training site changes you must follow the notification procedure outlined in the Pre-registration Training Manual (Page 13).</p>

<p>Please note - in the event that you do not notify us of changes to training arrangements, all training subsequent to the un-notified change, will not be recognised.</p>


<h4 class="primary mt-5 mb-3">4. What is the earliest date that I can join the register after completing training in 2021?</h4>

<p>Results from the summer assessment will be released on 22 July 2021. Results for the autumn assessment will be released on 28 October 2021.</p>

<p>Subject to fulfilling all requirements for registration as a pharmacist, including completing all compulsory components of training including passing the Registration Assessment, the earliest date that you will be able to register as a pharmacist after sitting the summer assessment will be 23 July 2021 and for the autumn assessment 29 October 2021.</p>

<p>The deadline to start approved training in time to sit the summer assessment is 01 August 2020.</p>


<p>Trainees and employers should agree a suitable training start date taking into account the dates published above.</p>
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
