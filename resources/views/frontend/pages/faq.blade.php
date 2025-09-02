@extends('layouts.master')
@section('content')
    <!-- page-title -->
    <section class="page-title centred">
        <div class="bg-layer" style="background-image: url(/assets/images/background/page-title.jpg);"></div>
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url(/assets/images/shape/shape-18.png);"></div>
            <div class="pattern-2" style="background-image: url(/assets/images/shape/shape-17.png);"></div>
        </div>
        <div class="auto-container">
            <div class="content-box">
                <h1>{{ $title }}</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="/">Home</a></li>
                    <li>{{ $title }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- page-title end -->

    <section class="faq-section pt_120 pb_100">
        <div class="auto-container">
            <div class="sec-title centred mb_70">
                <h6>Common Questions</h6>
                <h2>Find Answers Here</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 accordion-column">
                    <ul class="accordion-box">
                        <li class="accordion block active-block">
                            <div class="acc-btn active">
                                <div class="icon-box"></div>
                                <h4>How do I open a bank account?</h4>
                            </div>
                            <div class="acc-content current">
                                <div class="text">
                                    <p>To open a bank account, visit any of our branches with a valid form of identification
                                        (e.g., passport or driver's license) and proof of address (e.g., utility bill or
                                        rental agreement).</p>
                                </div>
                            </div>
                        </li>
                        <li class="accordion block">
                            <div class="acc-btn">
                                <div class="icon-box"></div>
                                <h4>What are your operating hours?</h4>
                            </div>
                            <div class="acc-content">
                                <div class="text">
                                    <p>Our branches are open from Monday to Friday, 9:00 AM to 5:00 PM. We also offer 24/7
                                        customer support through our helpline.</p>
                                </div>
                            </div>
                        </li>
                        <li class="accordion block">
                            <div class="acc-btn">
                                <div class="icon-box"></div>
                                <h4>How can I apply for a loan?</h4>
                            </div>
                            <div class="acc-content">
                                <div class="text">
                                    <p>You can apply for a loan by visiting our website and filling out the online
                                        application form. Alternatively, you can visit any of our branches for assistance.
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="accordion block">
                            <div class="acc-btn">
                                <div class="icon-box"></div>
                                <h4>What security measures do you have in place?</h4>
                            </div>
                            <div class="acc-content">
                                <div class="text">
                                    <p>We employ state-of-the-art security measures to protect your account information,
                                        including encryption, multi-factor authentication, and regular security audits.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 accordion-column">
                    <ul class="accordion-box">
                        <li class="accordion block">
                            <div class="acc-btn">
                                <div class="icon-box"></div>
                                <h4>How do I report a lost or stolen card?</h4>
                            </div>
                            <div class="acc-content">
                                <div class="text">
                                    <p>If your card is lost or stolen, please contact our customer support helpline
                                        immediately to report it. We will deactivate your card to prevent unauthorized use
                                        and issue a replacement.</p>
                                </div>
                            </div>
                        </li>
                        <li class="accordion block">
                            <div class="acc-btn">
                                <div class="icon-box"></div>
                                <h4>What fees are associated with your accounts?</h4>
                            </div>
                            <div class="acc-content">
                                <div class="text">
                                    <p>Our accounts may have various fees associated with them, such as monthly maintenance
                                        fees or transaction fees. Please refer to our fee schedule or speak with a
                                        representative for details.</p>
                                </div>
                            </div>
                        </li>
                        <li class="accordion block">
                            <div class="acc-btn">
                                <div class="icon-box"></div>
                                <h4>How can I access online banking?</h4>
                            </div>
                            <div class="acc-content">
                                <div class="text">
                                    <p>To access online banking, visit our website and log in with your username and
                                        password. If you haven't registered for online banking yet, you can do so by
                                        clicking the "Register" button and following the prompts.</p>
                                </div>
                            </div>
                        </li>
                        <li class="accordion block">
                            <div class="acc-btn">
                                <div class="icon-box"></div>
                                <h4>What options do you offer for saving?</h4>
                            </div>
                            <div class="acc-content">
                                <div class="text">
                                    <p>We offer a variety of savings options, including regular savings accounts, high-yield
                                        savings accounts, certificates of deposit (CDs), and retirement accounts. Speak with
                                        a representative to find the best option for you.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section><!-- faq-section end -->
@endsection
