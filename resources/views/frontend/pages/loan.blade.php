<!DOCTYPE html>
<html lang="en">

    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title }} &mdash; {{ config('app.name') }}</title>
        <!-- Description -->
        <meta
            content="Online Banking, Internet Banking, Secure Banking, Financial Management, Fund Transfer, Bill Payments, 24/7 Access, Digital Banking, Personalized Banking"
            name="keywords">
        <meta
            content="Experience secure and convenient online banking with our platform. Manage your finances, transfer funds, and enjoy 24/7 access to your accounts. Explore our advanced features for a seamless and personalized banking experience."
            name="description">
        <meta property="og:title" content="{{ config('app.name') }} - Secure Online Banking" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:image"
            content="{{ asset('dashboard/resources/images/istockphoto-1304484797-612x612.jpg') }}" />

        <!-- Favicon -->
        <link rel="shortcut icon" href="/dashboard/resources/images/favicon.png">

        <!-- Vendors Style-->
        <link rel="stylesheet" href="/dashboard/resources/css/vendors_css.css">
        <!-- Style-->
        <link rel="stylesheet" href="/dashboard/resources/css/style.css">
        <link rel="stylesheet" href="/dashboard/resources/css/skin_color.css">
    </head>

    <body class="hold-transition theme-primary bg-img text-primary">

        <div class="container">
            @include('partials.theme_alert')
            <div class="row">
                <div class="" style="padding:50px">
                    <div class="d-md-flex justify-content-between align-items-start">
                        <div>
                            <h1 class="mb-1">Loan application</h1>
                            <p class="mb-1">Fill and submit Loan Application form</p>
                        </div>
                        <a href="/" class="btn-info btn">
                            <i class="fas fa-backward" aria-hidden="true"></i>
                            Cancel</a>
                    </div>

                    <form action="{{ route('loan.store') }}" class="row" method="post">
                        @csrf
                        <div class="col-sm-12 col-md-6">
                            @include('partials.validation_message')
                            @include('partials.theme_alert')
                            <div class="form-group">
                                <label for="" class="text-left">Full name</label>
                                <input type="text" required name="name" value="<?= old('name') ?>"
                                    class="form-control" aria-describedby="emailHelp" placeholder="Enter Full name..."
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="" class="text-left">Residential Address</label>
                                <input type="text" required name="address" value="<?= old('address') ?>"
                                    class="form-control" aria-describedby="emailHelp"
                                    placeholder="Enter Residential Address..." required />
                            </div>
                            <div class="form-group">
                                <label for="" class="text-left">Phone number</label>
                                <input type="text" required name="phone" value="<?= old('phone') ?>"
                                    class="form-control" aria-describedby="emailHelp"
                                    placeholder="Enter Phone number..." />
                            </div>
                            <div class="form-group">
                                <label for="" class="text-left">Email</label>
                                <input type="text" required name="email" value="<?= old('email') ?>"
                                    class="form-control" aria-describedby="emailHelp" placeholder="Enter Email..."
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="">Occupation</label>
                                <input type="text" required name="occupation" value="<?= old('occupation') ?>"
                                    class="form-control" aria-describedby="emailHelp" placeholder="Enter Occupation..."
                                    required />
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="" class="text-left">Type of Loan</label>
                                <select name="type" id="" class="form-control">
                                    <option value="Student loan">Student loan</option>
                                    <option value="Car loan">Car loan</option>
                                    <option value="Small Business Loan ">
                                        Small Business Loan
                                    </option>
                                    <option value="Micro Business loan">
                                        Micro Business loan
                                    </option>
                                    <option value="Large Business Loan">
                                        Large Business Loan
                                    </option>
                                    <option value="Housing loan">Housing loan</option>
                                    <option value="Insurance">Insurance</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="text-left">Reference id</label>
                                <input type="text" required name="reference_id" value="<?= old('reference_id') ?>"
                                    class="form-control" aria-describedby="referenceIDHelp"
                                    placeholder="Enter Reference id..." />
                                <small></small>
                            </div>
                            <div class="form-group">
                                <label for="" class="text-left">Annual Income Rate</label>
                                <select name="income" id="" class="form-control" required>
                                    <option>0$ – $1000</option>
                                    <option>$1,000 – $9,000</option>
                                    <option>$10,000 – $49,000</option>
                                    <option>$50,000 – $99,000</option>
                                    <option>$100,000 – Above</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="text-left">Short Note of Loan Reason:
                                </label>
                                <textarea class="form-control" name="reason" rows="4" required><?= old('reason') ?></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success btn-user btn-xs">
                                Submit Application
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Vendor JS -->
        <script src="/dashboard/resources/js/vendors.min.js"></script>
        <script src="/dashboard/resources/js/pages/chat-popup.js"></script>
        <script src="/dashboard/resources/assets/icons/feather-icons/feather.min.php"></script>

        <script src="/dashboard/resources/js/themes/animated.js"></script>
        <script src="/dashboard/resources/assets/vendor_components/Web-Ticker-master/jquery.webticker.min.js"></script>
        <script src="/dashboard/resources/assets/vendor_components/moment/min/moment.min.php"></script>
        <script src="/dashboard/resources/assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.php">
        </script>

        <!-- Specie Admin Admin App -->
        <script src="/dashboard/resources/js/demo.js"></script>
        <script src="/dashboard/resources/js/template.js"></script>
        <script src="/dashboard/resources/js/pages/dashboard.js"></script>

        <script>
            var myModal = new bootstrap.Modal(document.getElementById('modal-center'), {
                keyboard: false
            })
            myModal.show();
        </script>
        @include('partials.live_chat')
    </body>

</html>
