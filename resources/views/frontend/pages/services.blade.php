@extends('frontend.layouts.master')
@section('content')
    <!-- Breadcrumbs -->
    <section class="section section-bredcrumbs">
        <div class="container context-dark breadcrumb-wrapper">
            <h1>Services</h1>
        </div>
    </section>
    <!-- A Wide Range of Banking & Financial Services-->
    <section class="section section-lg">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-md-12 col-xl-10">
                    <h2>A Wide Range of Banking & Financial Services</h2>
                    <div class="heading-6 block-lg">
                        We empower individuals, families and small businesses in
                        underserved areas with the financial support, knowledge, products
                        and services that contribute to financial self-sufficiency and
                        drive sustainable economic growth.
                    </div>
                    <a class="button button-lg button-primary" href="{{ route('services') }}">Read more</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Services-->
    <section class="section section-lg bg-gray-100">
        <div class="container">
            <div class="service-list">
                <div class="row row-20 service-item">
                    <div class="col-md-6">
                        <img src="/frontend/assets/bankAsset/images/services-1-540x327.jpg" alt="" width="540"
                            height="327" />
                    </div>
                    <div class="col-md-6">
                        <h3 class="title">Personal Solutions</h3>
                        <p class="exeption">
                            We are committed to helping you achieve your personal financial
                            goals. When you bank with us, you get access to our full suite
                            of services and the support of our expert financial advisors.
                        </p>
                        <p>
                            We provides an unparalleled variety of account options that
                            clients can select to enjoy a tailored trading experience that
                            perfectly suits their needs
                        </p>
                    </div>
                </div>
                <div class="row row-20 service-item">
                    <div class="col-md-6">
                        <h3 class="title">Corporate and Institutional Banking</h3>
                        <p class="exeption">
                            We draw on a deep knowledge of our clients' businesses and our
                            own in-depth industry research to develop sustainable strategies
                            for corporate and institutional
                        </p>
                        <p>
                            We have convenient, low cost, online money transfer that is made
                            avaliable through our vast network in over 50 countries.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <img src="/frontend/assets/bankAsset/images/services-2-540x327.jpg" alt="" width="540"
                            height="327" />
                    </div>
                </div>
                <div class="row row-20 service-item">
                    <div class="col-md-6">
                        <img src="/frontend/assets/bankAsset/images/services-3-540x327.jpg" alt="" width="540"
                            height="327" />
                    </div>
                    <div class="col-md-6">
                        <h3 class="title">Commercial Solutions</h3>
                        <p class="exeption">
                            Corporations come to us because we remain steadfast in helping
                            them meet their business objectives. Our range of commercial
                            banking services will ensure your company's financial assets are
                            in good hands.
                        </p>
                        <p>
                            We draw on a deep knowledge of our clients' businesses and our
                            own in-depth industry research to develop sustainable strategies
                            for corporate and institutional
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Call to action-->
    <section class="section section-xs bg-primary-gradient">
        <div class="container">
            <div class="box-cta">
                <div class="box-cta-inner">
                    <h3>
                        Choose Your <span class="font-weight-bold">Bank </span> Now!
                    </h3>
                </div>
                <div class="box-cta-inner">
                    <a class="button button-lg button-primary-dark" href="{{ route('register') }}">Register</a>
                </div>
            </div>
        </div>
    </section>
@endsection
