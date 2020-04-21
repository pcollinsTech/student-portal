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
            

            <h3 class="text-center my-4">Before you begin your application please read all the infomormation below and confirm you have all items required from the checklist</h3>
            <h4 class="primary text-center my-4">HOW TO COMPLETE THIS APPLICATION FORM - PLEASE READ CAREFULLY</h4>
        
            <p class="text-center px-4">ALL FIELDS MUST BE FULLY AND CORRECTLY COMPLETED IN ORDER FOR AN APPLICATION TO BE ACCEPTED.</p>
            <p class="text-center px-4">An applicant should NOT start training until they have recieved confirmation from the Pharmaceutical Society that their application has been accepted and have provided confirmation of their MPharm award.</p>

            <h4 class="primary text-center">Before Proceeding To Pre-registration Training</h4>

            <p>All applicants must hold a degree in pharmacy, from a UK-based University recognised by the Pharmaceutical Society NI or the General Pharmaceutical Council. The Pharmaceutical Society NI must have written evidence that you have been awarded a degree from a recognised University before any period of pre-registration training can commence. Not all universities provide this information to the Pharmaceutical Society NI unless YOU request it (only QUB and UU provide confirmation). It is YOUR RESPONSIBILITY to ensure that we have this written evidence before you begin your training; otherwise we will be unable to recognise your start date.</p>

            <p><b>Information for International students can be found on our website using the following link</b></p>

            <a href="http://www.psni.org.uk/pre-registration/applying-to-register-as-trainee-of-the-society/" class="primary">http://www.psni.org.uk/pre-registration/applying-to-register-as-trainee-of-the-society/</a>

            <h4 class="primary mt-2">1. Submitting my application?</h4>

            <p>Submit your application as soon as you can to ensure there are no delays.</br>
                The closing date for applications is 31st March 2020; applications will not be accepted after this date.</br>
                If you have failed your MPharm/OSPAP and will be re-sitting please note that your application should be submitted by the deadline (31st March 2020).</p>

            <h4 class="primary">2. How can I pay?</h4>
            <p>Payment can be made by Credit debit card.</p>
            <h4 class="primary">3. When can I start pre-registration training?</h4>
            <p>For the 2020-21 intake, pre-registration training may only start between 15 July 2020* and 14 September 2020.<br/> *If you start training before this date it will not count towards your 52 week total.</p>
            <h4 class="primary">4. Birth certificate?</h4>
            <p>The Pharmaceutical Society NI requires a solicitor’s certified photocopy of your original birth certificate to be uploaded during your online application.</p>
            <h4 class="primary">5. I have not yet passed my MPharm/OSPAP?</h4>
            <p>You can apply to start training before you know if you have passed your MPharm/OSPAP.</br>
            You cannot start training until you have passed your MPharm/OSPAP and the Pharmaceutical Society NI has been notified.</p>
            <h4 class="primary">6. I have failed my MPharm/OSPAP and will be re-sitting?</h4>
            <p>You cannot start training until you have passed your MPharm/OSPAP, therefore you will have to delay your start date. If you have failed you should contact your employer and make them aware and contact us to arrange an alternative start date within the designated period.</p>
            <h4 class="primary">7. Who can certify my degree certificate/OSPAP if already in my possession?</h4>
            <p>Information on who can certify your degree certificate and the requirements can be found via this link: <a href=" https://www.psni.org.uk/wp-content/uploads/2012/10/Who-can-sign-DC-requirements-Oct-2013-1.pdf" target="__blank">https://www.psni.org.uk/wp-content/uploads/2012/10/Who-can-sign-DC-requirements-Oct-2013-1.pdf</a> </p>
            <h4 class="primary">8. What are the training requirements/responsibilities of a Pre-registration Tutor?</h4>
            <p>The requirements/responsibilities are detailed in the Standards for Pre-registration Training (Sections 7 & 8)</p>
            <h4 class="primary">9. What do I do if I have been assigned two tutors?</h4>
            <p>Co-tutoring is permitted as long as, between the two tutors, the total hours worked meets the full-time requirement (30 hours over a minimum of four days). Both tutors must complete the ‘Tutor Details’ section and Learning Contract, they will share the responsibility and must co-sign the final declaration. A co-tutoring form must be completed and submitted with the application. The co-tutoring form can be accessed via link below: https://www.psni.org.uk/wp-content/uploads/2012/10/Co-tutor-Form-2018-1.pdf</p>
            <h4 class="primary">10.What do I need to submit if I have made a Fitness to Practise declaration?</h4>
            <p>If you have to ‘Yes’ to any of the questions in relation to charachter declaration you will need to provide a detailed account of the Fitness to Practise issues in the box provided.</p>
            <h4 class="primary">11.Who can certify my photograph?</h4>
            <p>All applicants must provide a recent passport photograph that has been certified on the reverse by an appropriate official.<br/>
            When accepting certified photographs, we follow the same standards of the UK Passport service. You will find details of who can certify your photo can be found on the <a href="https://gov.uk">Gov.uk</a> website:</br>
            Countersigning photographs</br>
            Further information on the photograph requirements will be available in this section</p>
            <div class="d-flex justify-content-around">
                <a href="{{ route('register') }}">
                    <button class="button">Register  >></button>
                </a>
                
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
