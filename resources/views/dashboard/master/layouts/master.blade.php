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

        <!-- DataTables CSS -->
        <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    </head>

    <body>
        <!-- Begin page -->
        <div class="wrapper">

            <!-- Sidenav Menu Start -->
            @include('dashboard.master.layouts.side_nav')
            <!-- Sidenav Menu End -->

            <!-- Topbar Start -->
            @include('dashboard.master.layouts.header')
            <!-- Topbar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <div class="page-content">

                @include('partials.sweet_alert')

                @yield('content')
                <!-- container -->

                <!-- Footer Start -->
                @include('dashboard.master.layouts.footer')
                <!-- end Footer -->

            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        <!-- Vendor js -->
        <script src="/dashboard/assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="/dashboard/assets/js/app.js"></script>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
                    // Optional settings
                    pageLength: 10,
                    lengthMenu: [
                        [5, 10, 25, -1],
                        [5, 10, 25, "All"]
                    ],
                    ordering: true,
                    responsive: true
                });
            });
        </script>

        @include('partials.live_chat')
    </body>

</html>
