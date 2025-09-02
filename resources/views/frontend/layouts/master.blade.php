<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

    <head>
        <meta charset="UTF-8" />
        <meta name="description" content="" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport"
            content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

        <title>{{ $title }} &mdash; {{ env('APP_NAME') }}</title>

        <!-- Description -->
        <meta
            content="Online Banking, Internet Banking, Secure Banking, Financial Management, Fund Transfer, Bill Payments, 24/7 Access, Digital Banking, Personalized Banking"
            name="keywords">
        <meta
            content="Experience secure and convenient online banking with our platform. Manage your finances, transfer funds, and enjoy 24/7 access to your accounts. Explore our advanced features for a seamless and personalized banking experience."
            name="description">
        <meta property="og:title" content="{{ env('APP_NAME') }} - Secure Online Banking" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:image" content="{{ asset(env('APP_OG_IMAGE')) }}" />

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset(env('APP_FAVICON')) }}">

        <!-- Stylesheets-->
        <link rel="stylesheet" type="text/css"
            href="http://fonts.googleapis.com/css?family=Roboto:100,300,300i,400,700,900" />
        <link rel="stylesheet" href="/frontend/assets/bankAsset/css/bootstrap.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="/frontend/assets/bankAsset/css/style.css" id="main-styles-link" />
        <link rel="stylesheet"
            href="/cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/4.5.95/css/materialdesignicons.min.css"
            integrity="sha512-EhtFgx6fGa2B3UNje2rTcPBgryWKx7TVkcGuOsCkybAbAaWEGrWDjsMFPqJUwXf2u1qmz6BxocZvcXVmTfMG9g=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="{{ asset('assets/js/sweet_alert2.js') }}"></script>
        @include('partials.google_translator')

        <style>
            .fixed {
                position: fixed;
                bottom: 10px;
                right: 40px;
                background-color: #fff;
                border-radius: 50%;
                width: fit-content;
                padding: 1rem;
                z-index: 11111111111;
                cursor: pointer;
                box-shadow: 0 0 5px 0px #000;
                /* display: none; */
            }

            /* .fixed:hover {
            background-color: #eee;
        } */
        </style>
    </head>

    <body>
        @include('frontend.layouts.header')

        @include('partials.sweet_alert')
        @yield('content')

        @include('frontend.layouts.footer')
        <!-- Global Mailform Output-->
        <div class="snackbars" id="form-output-global"></div>
        <!-- Javascript-->

        <!-- Alertify JS -->
        <script src="/frontend/assets/bankAsset/js/core.min.js"></script>
        <script src="/frontend/assets/bankAsset/js/script.js"></script>
        @include('partials.live_chat')
    </body>

</html>
