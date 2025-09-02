<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>{{ $title }} &mdash; {{ env('APP_NAME') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="{{ env('APP_KEYWORDS') }}" name="keywords">
        <meta content="{{ env('APP_DESCRIPTION') }}" name="description">
        <meta property="og:title" content="{{ env('APP_NAME') }} - {{ env('APP_SLOGAN ') }}" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:image" content="{{ asset(env('APP_OG_IMAGE')) }}" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset(env('APP_FAVICON')) }}">

        <!-- Theme Config Js -->
        <script src="/dashboard/assets/js/config.js"></script>

        <!-- Vendor css -->
        <link href="/dashboard/assets/css/vendor.min.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="/dashboard/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons css -->
        <link href="/dashboard/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

        @include('partials.google_translator')

        <script src="/assets/js/sweet_alert2.js"></script>
    </head>

    <body>
        @include('partials.sweet_alert')

        @yield('content')

        <!-- Vendor js -->
        <script src="/dashboard/assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="/dashboard/assets/js/app.js"></script>

    </body>

</html>
