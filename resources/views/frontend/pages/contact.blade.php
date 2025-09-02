<!DOCTYPE html>
<html lang="en">

    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <link rel="shortcut icon" href="{{ env('APP_FAVICON') }}">

        <!-- Vendors Style-->
        <link rel="stylesheet" href="/frontend/assets/contact/resources/css/vendors_css.css">
        <!-- Style-->
        <link rel="stylesheet" href="/frontend/assets/contact/resources/css/style.css">
        <link rel="stylesheet" href="/frontend/assets/contact/resources/css/skin_color.css">
    </head>

    <body class="hold-transition theme-primary bg-img  text-primary">
        <div class="container">
            <div class="row">
                <section
                    style="height: 200px; background-image: url({{ asset('frontend/assets/bnkasset/images/slider-10-1920x1280.jpg') }}); margin-top:-100;">
                </section>

                <div class="col-sm-12 col-md-6 offset-md-3 mt-100">
                    <div class="text-center">
                        <a href="/"><img width="300" src="{{ asset(env('APP_LOGO')) }}" alt=""
                                srcset=""></a>
                        <h1 class="h4">Send us a message</h1>
                        <p class="mb-4">Having issues? and need assistance?, Send us a message, and we will get in
                            touch with you
                        </p>
                    </div>

                    @include('partials.validation_message')
                    @include('partials.theme_alert')

                    <form action="{{ route('contact.store') }}" method="post" class="user">
                        @csrf
                        <div class="form-group col-12">
                            <input type="text" name="full_name" placeholder="Your Name" required
                                value="{{ old('full_name') }}" class="form-control">
                        </div>
                        <div class="form-group col-12">
                            <input type="email" name="email" placeholder="Your email" required
                                value="{{ old('email') }}" class="form-control">
                        </div>
                        <div class="form-group col-12">
                            <input type="text" name="phone" required placeholder="Phone"
                                value="{{ old('phone') }}" class="form-control">
                        </div>
                        <div class="form-group col-12">
                            <input type="text" name="subject" required placeholder="Subject"
                                value="{{ old('subject') }}" class="form-control">
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <textarea name="message" placeholder="Type message" class="form-control">{{ old('message') }}</textarea>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 text-center">
                            <button class="btn btn-primary" type="submit" name="submit-form">Send Message</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- Vendor JS -->
        <script src="/frontend/assets/contact/resources/js/vendors.min.js"></script>
        <script src="/frontend/assets/contact/resources/js/pages/chat-popup.js"></script>
        <script src="/frontend/assets/contact/resources/assets/icons/feather-icons/feather.min.php"></script>

        <script src="/frontend/assets/contact/resources/js/themes/animated.js"></script>
        <script src="/frontend/assets/contact/resources/assets/vendor_components/Web-Ticker-master/jquery.webticker.min.js">
        </script>
        <script src="/frontend/assets/contact/resources/assets/vendor_components/moment/min/moment.min.php"></script>
        <script
            src="/frontend/assets/contact/resources/assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.php">
        </script>

        <!-- Specie Admin Admin App -->
        <script src="/frontend/assets/contact/resources/js/demo.js"></script>
        <script src="/frontend/assets/contact/resources/js/template.js"></script>
        <script src="/frontend/assets/contact/resources/js/pages/dashboard.js"></script>

        <script>
            var myModal = new bootstrap.Modal(document.getElementById('modal-center'), {
                keyboard: false
            })
            myModal.show();
        </script>
        @include('partials.live_chat')
    </body>

</html>
