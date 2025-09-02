@extends('frontend.layouts.master')
@section('content')
    <!-- Swiper-->
    <section class="section swiper-container swiper-slider swiper-slider-2" data-loop="true" data-autoplay="5000"
        data-simulate-touch="false" data-slide-effect="fade">
        <div class="swiper-wrapper text-center">
            <div class="swiper-slide context-dark" data-slide-bg="/frontend/assets/bankAsset/images/slider-10-1920x1280.jpeg">
                <div class="swiper-slide-caption">
                    <div class="container">
                        <div class="row justify-content-lg-center">
                            <div class="col-md-12 col-xl-10">
                                <h1 data-caption-animate="fadeInUp" data-caption-delay="100">
                                    Where You Know Your Banker and Your Banker Knows You
                                </h1>
                                <a class="button button-lg button-primary" href="{{ route('login') }}"
                                    data-caption-animate="fadeInUp" data-caption-delay="450">Login</a>
                                <a class="button button-lg button-primary" href="{{ route('register') }}"
                                    data-caption-animate="fadeInUp" data-caption-delay="450">Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide context-dark" data-slide-bg="/frontend/assets/bankAsset/images/slider-8-1920x1328.jpeg"
                style="background-position: 50% 50%">
                <div class="swiper-slide-caption">
                    <div class="container">
                        <div class="row justify-content-lg-center">
                            <div class="col-md-12 col-xl-10">
                                <h1 data-caption-animate="fadeInUp" data-caption-delay="100">
                                    Our Quest to Make Banking Better Starts Here
                                </h1>
                                <a class="button button-lg button-primary" href="{{ route('login') }}"
                                    data-caption-animate="fadeInUp" data-caption-delay="450">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide context-dark" data-slide-bg="/frontend/assets/bankAsset/images/slider-9-1920x1328.jpg"
                style="background-position: 50% 50%">
                <div class="swiper-slide-caption">
                    <div class="container">
                        <div class="row justify-content-lg-center">
                            <div class="col-md-12 col-xl-10">
                                <h1 data-caption-animate="fadeInUp" data-caption-delay="100">
                                    The Fastest Way to Send Money Worldwide
                                </h1>
                                <a class="button button-lg button-primary" href="{{ route('login') }}"
                                    data-caption-animate="fadeInUp" data-caption-delay="450">Login</a>
                                <a class="button button-lg button-primary" href="{{ route('register') }}"
                                    data-caption-animate="fadeInUp" data-caption-delay="450">Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-meta">
            <ul class="links">
                <li><a class="fab fa-facebook" href="https://www.facebook.com"></a></li>
                <li><a class="fab fa-twitter" href="https://www.twitter.com"></a></li>
                <li><a class="fab fa-instagram" href="https://www.instagram.com"></a></li>
                <li>
                    <a class="fab fa-facebook-messenger" href="https://www.messenger.com"></a>
                </li>
                <li><a class="fab fa-linkedin" href="https://www.linkedin.com"></a></li>
                <li><a class="fab fa-snapchat" href="https://www.snapchat.com"></a></li>
            </ul>
            @if (env('APP_PHONE')) 
                <div class="contacts">
                    <a href="tel:+{{ env('APP_PHONE') }}" style="color:white !important">
                        <div class="fa fa-phone">
                        </div>
                    </a>
    
                </div>
            @endif
            <!-- Swiper Pagination-->
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <!-- Advantages-->
    <section class="section context-dark">
        <div class="row row-flex no-gutters">
            <div class="col-md-6 col-lg-3">
                <div class="blurb-boxed-2">
                    <div class="fa fa-credit-card"></div>
                    <h6 class="title">
                        More than <span class="font-weight-bold">23 754</span> Issued
                        Cards
                    </h6>
                    <p class="exeption">
                        Our bank is an acknowledged leader in credit card distribution. We
                        issue more than 5000 cards every year.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="blurb-boxed-2 blurb-boxed-dark">
                    <div class="fa fa-wallet"></div>
                    <h6 class="title">
                        Up to <span class="font-weight-bold">30%</span> Cashback
                    </h6>
                    <p class="exeption">
                        We offer an amazing amount of cashback for payments made with one
                        of our credit cards - Blue, Green, or Orange.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="blurb-boxed-2 blurb-boxed-darker">
                    <div class="fa fa-credit-card"></div>
                    <h6 class="title">
                        Up to <span class="font-weight-bold">25%</span> for Deposits
                    </h6>
                    <p class="exeption">
                        {{ env('APP_NAME') }} offers various deposits in all international
                        currencies with interest rate up to 25% for all regular clients.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="blurb-boxed-2 blurb-boxed-darkest">
                    <p class="exeption">The Best Choice {{ date('Y') }}</p>
                    <h5 class="title">
                        Reliable and Secure Credit Cards and Deposits for You
                    </h5>
                    <a class="button button-lg button-icon button-icon-left button-primary"
                        href="{{ route('login') }}"><span class="fa fa-credit-card"></span>Order a Card</a>
                </div>
            </div>
        </div>
    </section>
    <!-- The Best Banking Choise-->
    <section class="section section-lg">
        <div class="container">
            <div class="block-lg text-center">
                <h2>The Best Banking Choice</h2>
                <p>
                    Since our foundation, we have been #1 banking institution for lots
                    of individual and corporate customers, both in the USA and
                    internationally. We provide our clients with a number of benefits.
                </p>
            </div>
            <div class="row row-30 row-xxl-60">
                <div class="col-sm-6 col-md-4 wow fadeInLeft">
                    <div class="blurb-image">
                        <div class="fa fa-map-marker"></div>
                        <h6 class="title">Various Locations</h6>
                        <p class="exeption">
                            We have offices in many countries including the USA and the UK.
                        </p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="blurb-image">
                        <div class="fa fa-phone"></div>
                        <h6 class="title">Mobile Banking Apps</h6>
                        <p class="exeption">
                            Get instant access to your account on any device using our
                            banking apps.
                        </p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="blurb-image">
                        <div class="fa fa-users"></div>
                        <h6 class="title">Family &amp; Friends Programs</h6>
                        <p class="exeption">
                            Our Bank has special programs with benefits for family members.
                        </p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="blurb-image">
                        <div class="fa fa-headset"></div>
                        <h6 class="title">24/7 Support</h6>
                        <p class="exeption">
                            Our Support team is always ready to help you solve any banking
                            issues.
                        </p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="blurb-image">
                        <div class="fa fa-receipt"></div>
                        <h6 class="title">Personal Profile</h6>
                        <p class="exeption">
                            Register your free personal profile online to begin using our
                            services.
                        </p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 wow fadeInLeft" data-wow-delay="0.3s">
                    <div class="blurb-image">
                        <div class="fa fa-cogs"></div>
                        <h6 class="title">Settings</h6>
                        <p class="exeption">
                            Registered clients can edit the banking account settings in 2
                            clicks.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- A Few Words About Our Bank-->
    <section class="section section-lg bg-gray-100">
        <div class="container">
            <div class="block-lg text-center">
                <h2>A Few Words About Our Bank</h2>
                <p>
                    {{ env('APP_NAME') }} was founded in 1999 to introduce the new level
                    of financial services worldwide. We are still dedicated to the
                    success of our clients, both individual and corporate.
                </p>
            </div>
            <div class="row row-20 justify-content-center justify-content-lg-between">
                <div class="col-md-10 col-lg-6 wow fadeIn">
                    <img class="img-bordered" src="/frontend/assets/bankAsset/images/index-1-2-570x379.jpg"
                        alt="" width="570" height="379" />
                </div>
                <div class="col-md-10 col-lg-6 col-xl-5">
                    <div class="text-block-2">
                        <p>
                            At {{ env('APP_NAME') }}, we are guided by a common purpose to
                            help make financial lives better by connecting clients and
                            communities to the resource they need to be successful. We are
                            driving growth – helping to create jobs, develop communities,
                            foster economic mobility and address society’s biggest
                            challenges – while managing risk and providing a return to our
                            clients and our shareholders.
                        </p>
                        <div class="progress-linear-wrap">
                            <!-- Linear progress bar-->
                            <article class="progress-linear">
                                <div class="progress-header">
                                    <p>Financial Consulting</p>
                                    <span class="progress-value">75</span>
                                </div>
                                <div class="progress-bar-linear-wrap">
                                    <div class="progress-bar-linear"></div>
                                </div>
                            </article>
                            <!-- Linear progress bar-->
                            <article class="progress-linear">
                                <div class="progress-header">
                                    <p>Online Reporting</p>
                                    <span class="progress-value">50</span>
                                </div>
                                <div class="progress-bar-linear-wrap">
                                    <div class="progress-bar-linear"></div>
                                </div>
                            </article>
                        </div>
                        <a class="button button-lg button-primary" href="#">More Details</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Financial Statistics-->
    <section class="section section-lg bg-primary-dark">
        <div class="container">
            <h2 class="text-center">Financial Statistics</h2>
            <div class="row row-20 justify-content-center justify-content-lg-between">
                <div class="col-md-12 col-lg-4 wow fadeIn">
                    <blockquote class="quote quote-default">
                        <div class="quote-fa fa-format-quote"></div>
                        <div class="quote-body">
                            <q class="heading-6">At {{ env('APP_NAME') }}, we aim to provide top quality banking
                                services to a greater number of individual and corporate
                                customers than any other bank in the USA or abroad. Our
                                clients value data privacy and security of their banking
                                accounts 24/7.</q>
                        </div>
                        <div class="quote-meta">
                            <div class="author">
                                <cite>Samuel Chapman</cite>
                            </div>
                            <div class="position">
                                CEO &amp; Founder of {{ env('APP_NAME') }}
                            </div>
                        </div>
                    </blockquote>
                </div>
                <div class="col-md-8 col-lg-5 col-xxl-4 wow fadeIn">
                    <div class="d3-chart" id="spline-chart" style="width: 100%; margin: 0 auto"></div>
                    <p>
                        With the development of online banking, our number of customers
                        increased up to 6 million worldwide.
                    </p>
                </div>
                <div class="col-md-4 col-lg-3 col-xxl-2">
                    <div class="row row-fix row-40">
                        <div class="col-6 col-md-12">
                            <div class="progress-bar-circle-wrap text-center">
                                <div class="progress-bar-circle" data-value="0.9" data-gradient="#36f1f8"
                                    data-empty-fill="#fff" data-size="100" data-thickness="2">
                                    <span></span>
                                </div>
                                <p class="progress-bar-circle-title">Cashback</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-12">
                            <div class="progress-bar-circle-wrap text-center">
                                <div class="progress-bar-circle" data-value="1" data-gradient="#36f1f8"
                                    data-empty-fill="#fff" data-size="100" data-thickness="2">
                                    <span></span>
                                </div>
                                <p class="progress-bar-circle-title">Guarantee</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonials-->
    <section class="section section-lg bg-gray-100">
        <div class="container text-center">
            <h2>Testimonials</h2>
            <!-- Owl Carousel-->
            <div class="owl-carousel text-left" data-items="1" data-md-items="2" data-dots="true" data-nav="false"
                data-stage-padding="0" data-loop="true" data-margin="30" data-mouse-drag="false" data-autoplay="true">
                <blockquote class="quote quote-boxed">
                    <div class="quote-meta">
                        <ul class="list-icons">
                            <li>
                                <div class="fa fa-star"></div>
                            </li>
                            <li>
                                <div class="fa fa-star"></div>
                            </li>
                            <li>
                                <div class="fa fa-star"></div>
                            </li>
                            <li>
                                <div class="fa fa-star"></div>
                            </li>
                            <li>
                                <div class="fa fa-star-half"></div>
                            </li>
                        </ul>
                        <div class="time">2 days ago</div>
                    </div>
                    <q>I choose {{ env('APP_NAME') }} because I know they share my values
                        of putting community first. Not only do they make banking easy, I
                        see them out volunteering and investing in our community.</q>
                    <div class="quote-author">
                        <div class="author-media">
                            <img src="/frontend/assets/bankAsset/images/user-1-64x64.jpg" alt="" width="64"
                                height="64" />
                        </div>
                        <div class="author-body">
                            <div class="author">
                                <cite>Marie Hanson</cite>
                            </div>
                            <div class="position">Charity Organization Manager</div>
                        </div>
                    </div>
                </blockquote>
                <blockquote class="quote quote-boxed">
                    <div class="quote-meta">
                        <ul class="list-icons">
                            <li>
                                <div class="fa fa-star"></div>
                            </li>
                            <li>
                                <div class="fa fa-star"></div>
                            </li>
                            <li>
                                <div class="fa fa-star"></div>
                            </li>
                            <li>
                                <div class="fa fa-star"></div>
                            </li>
                            <li>
                                <div class="fa fa-star-half"></div>
                            </li>
                        </ul>
                        <div class="time">2 days ago</div>
                    </div>
                    <q>When I needed financial assistance to expand my shop, I went
                        directly to {{ env('APP_NAME') }}. Securing financing helped us
                        renovate and expand my jewelry shop and attract more clients.</q>
                    <div class="quote-author">
                        <div class="author-media">
                            <img src="/frontend/assets/bankAsset/images/user-2-64x64.jpg" alt="" width="64"
                                height="64" />
                        </div>
                        <div class="author-body">
                            <div class="author">
                                <cite>Mildred Bates</cite>
                            </div>
                            <div class="position">Jewelry Shop Owner</div>
                        </div>
                    </div>
                </blockquote>
                <blockquote class="quote quote-boxed">
                    <div class="quote-meta">
                        <ul class="list-icons">
                            <li>
                                <div class="fa fa-star"></div>
                            </li>
                            <li>
                                <div class="fa fa-star"></div>
                            </li>
                            <li>
                                <div class="fa fa-star"></div>
                            </li>
                            <li>
                                <div class="fa fa-star"></div>
                            </li>
                            <li>
                                <div class="fa fa-star-half"></div>
                            </li>
                        </ul>
                        <div class="time">2 days ago</div>
                    </div>
                    <q>I choose {{ env('APP_NAME') }} because I know they share my values
                        of putting community first. Not only do they make banking easy, I
                        see them out volunteering and investing in our community.</q>
                    <div class="quote-author">
                        <div class="author-media">
                            <img src="/frontend/assets/bankAsset/images/user-1-64x64.jpg" alt="" width="64"
                                height="64" />
                        </div>
                        <div class="author-body">
                            <div class="author">
                                <cite>Marie Hanson</cite>
                            </div>
                            <div class="position">Charity Organization Manager</div>
                        </div>
                    </div>
                </blockquote>
                <blockquote class="quote quote-boxed">
                    <div class="quote-meta">
                        <ul class="list-icons">
                            <li>
                                <div class="fa fa-star"></div>
                            </li>
                            <li>
                                <div class="fa fa-star"></div>
                            </li>
                            <li>
                                <div class="fa fa-star"></div>
                            </li>
                            <li>
                                <div class="fa fa-star"></div>
                            </li>
                            <li>
                                <div class="fa fa-star-half"></div>
                            </li>
                        </ul>
                        <div class="time">2 days ago</div>
                    </div>
                    <q>When I needed financial assistance to expand my shop, I went
                        directly to {{ env('APP_NAME') }}. Securing financing helped us
                        renovate and expand my jewelry shop and attract more clients.</q>
                    <div class="quote-author">
                        <div class="author-media">
                            <img src="/frontend/assets/bankAsset/images/user-2-64x64.jpg" alt="" width="64"
                                height="64" />
                        </div>
                        <div class="author-body">
                            <div class="author">
                                <cite>Mildred Bates</cite>
                            </div>
                            <div class="position">Jewelry Shop Owner</div>
                        </div>
                    </div>
                </blockquote>
                <blockquote class="quote quote-boxed">
                    <div class="quote-meta">
                        <ul class="list-icons">
                            <li>
                                <div class="fa fa-star"></div>
                            </li>
                            <li>
                                <div class="fa fa-star"></div>
                            </li>
                            <li>
                                <div class="fa fa-star"></div>
                            </li>
                            <li>
                                <div class="fa fa-star"></div>
                            </li>
                            <li>
                                <div class="fa fa-star-half"></div>
                            </li>
                        </ul>
                        <div class="time">2 days ago</div>
                    </div>
                    <q>I choose {{ env('APP_NAME') }} because I know they share my values
                        of putting community first. Not only do they make banking easy, I
                        see them out volunteering and investing in our community.</q>
                    <div class="quote-author">
                        <div class="author-media">
                            <img src="/frontend/assets/bankAsset/images/user-1-64x64.jpg" alt="" width="64"
                                height="64" />
                        </div>
                        <div class="author-body">
                            <div class="author">
                                <cite>Marie Hanson</cite>
                            </div>
                            <div class="position">Charity Organization Manager</div>
                        </div>
                    </div>
                </blockquote>
                <blockquote class="quote quote-boxed">
                    <div class="quote-meta">
                        <ul class="list-icons">
                            <li>
                                <div class="fa fa-star"></div>
                            </li>
                            <li>
                                <div class="fa fa-star"></div>
                            </li>
                            <li>
                                <div class="fa fa-star"></div>
                            </li>
                            <li>
                                <div class="fa fa-star"></div>
                            </li>
                            <li>
                                <div class="fa fa-star-half"></div>
                            </li>
                        </ul>
                        <div class="time">2 days ago</div>
                    </div>
                    <q>When I needed financial assistance to expand my shop, I went
                        directly to {{ env('APP_NAME') }}. Securing financing helped us
                        renovate and expand my jewelry shop and attract more clients.</q>
                    <div class="quote-author">
                        <div class="author-media">
                            <img src="/frontend/assets/bankAsset/images/user-2-64x64.jpg" alt="" width="64"
                                height="64" />
                        </div>
                        <div class="author-body">
                            <div class="author">
                                <cite>Mildred Bates</cite>
                            </div>
                            <div class="position">Jewelry Shop Owner</div>
                        </div>
                    </div>
                </blockquote>
            </div>
        </div>
    </section>
    <!-- How to Order a New Card-->
    <section class="section section-lg">
        <div class="container text-center">
            <h2>How to Order a New Card</h2>
            <div class="row row-40 justify-content-center number-counter">
                <div class="col-sm-6 col-lg-3 wow fadeInLeft">
                    <div class="blurb-icon-fill">
                        <div class="fa fa-globe"></div>
                        <h5 class="title">Online Registration</h5>
                        <p class="exeption">
                            Everything starts with free online registration. Only basic data
                            is needed - name, surname, age etc.
                        </p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="blurb-icon-fill">
                        <div class="fa fa-book"></div>
                        <h5 class="title">Filling Out a Form</h5>
                        <p class="exeption">
                            After the basic registration, you will need to fill out a form
                            to help us determine your financial goals.
                        </p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="blurb-icon-fill">
                        <div class="fa fa-check"></div>
                        <h5 class="title">Signing an Agreement</h5>
                        <p class="exeption">
                            This stage concludes the procedure of opening an account at
                            {{ env('APP_NAME') }} to start using your card.
                        </p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 wow fadeInLeft" data-wow-delay="0.3s">
                    <div class="blurb-icon-fill">
                        <div class="fa fa-credit-card"></div>
                        <h5 class="title">Using Your Card</h5>
                        <p class="exeption">
                            You can use your card to purchase the products you need or to
                            open a secure deposit with lots of benefits.
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
                        Choose Your <span class="font-weight-bold">Bank Card</span> Now!
                    </h3>
                </div>
                <div class="box-cta-inner">
                    <a class="button button-lg button-primary-dark" href="{{ route('login') }}">Order Card</a>
                </div>
            </div>

        </div>
    </section>
    <!-- Frequently Asked Questions-->
    <section class="section section-lg">
        <div class="container text-center">
            <h2>Frequently Asked Questions</h2>
            <div class="row row-flex row-40 number-counter text-left">
                <div class="col-sm-12 col-lg-4 wow fadeIn">
                    <div class="text-block-lined">
                        <h5 class="title">
                            What is the currency amount for the Blue Card?
                        </h5>
                        <p>
                            The minimum amount that can be loaded on the card is $100 or
                            equivalent amount in other currency. The maximum amount would be
                            as per {{ env('APP_NAME') }} guidelines applicable from time to
                            time. You can learn more about it by contacting our consultants
                            using the form on our website or by calling us directly.
                        </p>
                        <h5 class="title">What steps do I take if my card gets lost?</h5>
                        <p>
                            If you lose your card please immediately contact our customer
                            support center so that we could issue a new one as fast as
                            possible.
                        </p>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4 wow fadeIn">
                    <div class="text-block-lined">
                        <h5 class="title">Do I have to maintain any minimum balance?</h5>
                        <p>
                            It depends on the card you choose. For example, if you pick an
                            Orange Card, you get a special waiver on the minimum balance
                            requirement.
                        </p>
                        <h5 class="title">
                            What security features does the mobile banking have?
                        </h5>
                        <p>
                            Mobile browser-based banking is very similar to PC based
                            internet banking. The respective mobile handset browser replaces
                            a PC browser to access the banking services. Some of the
                            important security measures in place are 128 bit SSL from
                            VeriSign, https:// based access etc.
                        </p>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4 wow fadeIn">
                    <div class="text-block-lined">
                        <h5 class="title">
                            What kind of browser do I need for online banking?
                        </h5>
                        <p>
                            Our Banking System supports all browsers. Some of the most
                            popular ones are Chrome, Opera, Firefox, and Safari. If you are
                            using Internet Explorer make sure the version of your browser is
                            9.0 or higher.
                        </p>
                        <h5 class="title">
                            Can I make online payments to foreign recipients?
                        </h5>
                        <p>
                            Yes, you can! Our bank does not limit any payments to a certain
                            country so whether you are using our online banking system or an
                            app for your device, you can safely transfer any amount of money
                            or purchase services and products.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
