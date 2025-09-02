@extends('frontend.layouts.master')
@section('content')
    <!-- Breadcrumbs -->
    <section class="section section-bredcrumbs">
        <div class="container context-dark breadcrumb-wrapper">
            <h1>About us</h1>
        </div>
    </section>
    <!-- Join Our Team-->
    <section class="section section-lg custom-image-section">
        <div class="container relative-container">
            <div class="row row-30 row-md-60 justify-content-between">
                <div class="col-md-12">
                    <h2>Overview</h2>
                </div>
                <div class="col-md-6">
                    <div class="heading-6">
                        {{ env('APP_NAME') }} was designed for those who demand banking
                        that's dramatically better than what they’ve experienced in the
                        past. Our innovative methods and products keep pace with your life
                        and your business. Our hyper-focused associates respond with the
                        resources you need.
                    </div>

                    <h3>Our Vision</h3>
                    <p>To be one of the top performing banks in the nation.</p>

                    <h3>Our Mission</h3>
                    <p>
                        To deliver a better banking experience for every client. We will
                        design for our customers, respond to them and learn from them. We
                        will ignite our talented team to relentlessly pursue the most
                        innovative products and best services and practices in all we do.
                        We will utilize technology to deliver timely and superior
                        solutions for our customers. We will be a bank our customers are
                        proud of. We will be the bank to get it right.
                    </p>
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="progress-linear-wrap">
                        <!-- Linear progress bar-->
                        <article class="progress-linear">
                            <div class="progress-header">
                                <p>Financial Consulting</p>
                                <span class="progress-value">99</span>
                            </div>
                            <div class="progress-bar-linear-wrap">
                                <div class="progress-bar-linear"></div>
                            </div>
                        </article>
                        <!-- Linear progress bar-->
                        <article class="progress-linear">
                            <div class="progress-header">
                                <p>Online Reporting</p>
                                <span class="progress-value">95</span>
                            </div>
                            <div class="progress-bar-linear-wrap">
                                <div class="progress-bar-linear"></div>
                            </div>
                        </article>
                        <!-- Linear progress bar-->
                        <article class="progress-linear">
                            <div class="progress-header">
                                <p>Online Banking</p>
                                <span class="progress-value">99</span>
                            </div>
                            <div class="progress-bar-linear-wrap">
                                <div class="progress-bar-linear"></div>
                            </div>
                        </article>
                        <!-- Linear progress bar-->
                        <article class="progress-linear">
                            <div class="progress-header">
                                <p>24/7 Support</p>
                                <span class="progress-value">100</span>
                            </div>
                            <div class="progress-bar-linear-wrap">
                                <div class="progress-bar-linear"></div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container mb-5">
        <!-- ##### Call To Action Start ###### -->
        <section class="col-sm-12 col-md-8 offset-md-2 d-flex flex-wrap">
            <!-- Cta Content -->
            <div class="cta-content mb-3">
                <!-- Section Heading -->
                <div class="section-heading white">
                    <div class="line"></div>
                    <h2>Empowering Local Economies</h2>
                </div>
                <h6 class="mb-0">
                    {{ env('APP_NAME') }}, we empower individuals, families and small
                    businesses in undeserved areas with the financial support,
                    knowledge, products and services that contribute to financial
                    self-sufficiency and drive sustainable economic growth.
                </h6>
                <h4 class="text-secondary">We do this by:</h4>

                <p class="text-secondary">
                    Providing loans and investments to local small businesses so they
                    may contribute to economic revitalization Offering affordable
                    housing lending options to help ensure the availability of safe,
                    comfortable housing Joining forces with non-profits, community
                    developers and others to promote neighborhood revitalization through
                    loans, grants and direct investments Connecting our employees with
                    community organizations to provide solutions and resources that meet
                    the long-term needs of our communities
                </p>

                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <!-- Single Cool Facts -->
                    <div class="single-cool-fact white d-flex align-items-center mt-50">
                        <div class="scf-icon mr-15">
                            <i class="icon-piggy-bank"></i>
                        </div>
                        <div class="scf-text">
                            <h2><span class="counter">88710</span></h2>
                            <p>Clients</p>
                        </div>
                    </div>
                    <!-- Single Cool Facts -->
                    <div class="single-cool-fact white d-flex align-items-center mt-50">
                        <div class="scf-icon mr-15">
                            <i class="icon-coin"></i>
                        </div>
                        <div class="scf-text">
                            <h2><span class="counter">1000</span></h2>
                            <p>Creditors</p>
                        </div>
                    </div>
                    <!-- Single Cool Facts -->
                    <div class="single-cool-fact white d-flex align-items-center mt-50">
                        <div class="scf-icon mr-15">
                            <i class="icon-diamond"></i>
                        </div>
                        <div class="scf-text">
                            <h2><span class="counter">12</span></h2>
                            <p>awards</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Cta Thumbnail -->
            <div class="cta-thumbnail bg-img jarallax">
            </div>
        </section>
        <!-- ##### Call To Action End ###### -->

        <!-- ##### Call To Action Start ###### -->
        <section class="cta-2-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Cta Content -->
                        <div class="cta-content d-flex flex-wrap align-items-center justify-content-between">
                            <div class="cta-text">
                                <h4>Want to know more?</h4>
                                <p>
                                    Our Mission is To Provide the Best Customer Service to our
                                    Clients by maintaining a Superb Client Centric Culture. In
                                    this way we will achieve our Vision of maintaining our
                                    position as a Market Leader known for our Superior Customer
                                    Services
                                </p>
                            </div>
                            <div class="mt-2">
                                <a href="{{ route('about') }}" class="button button-lg button-primary-dark">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ##### Call To Action End ###### -->
    </div>
@endsection
