<!-- Page Footer -->
<footer class="section footer-2">
    <div class="container">
        <div class="row row-40">
            <div class="col-md-6 col-lg-4">
                <a class="footer-logo" href="/"><img src="{{ asset(env('APP_LOGO_LIGHT')) }}" alt=""
                        width="200" height="45" /></a>
                <p>
                    {{ env('APP_NAME') }} is the leading financial establishment
                    providing high-quality international banking services. We are
                    always ready to partner with you by offering full financial
                    support to individuals and companies worldwide.
                </p>
            </div>

            <div class="col-md-6 col-lg-3">
                <h5 class="title">Contact Information</h5>
                <ul class="contact-box">
                    @if (env('APP_ADDRESS'))
                        <li>
                            <div class="unit unit-horizontal unit-spacing-xxs">
                                <div class="unit-left">
                                    <span class="fa fa-map-marker"></span>
                                </div>
                                <div class="unit-body">
                                    <ul class="list-phones">
                                        {{ env('APP_ADDRESS') }}
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endif
                    @if (env('APP_PHONE'))
                        <li>
                            <div class="unit unit-horizontal unit-spacing-xxs">
                                <div class="unit-left">
                                    <span class="fa fa-phone"></span>
                                </div>
                                <div class="unit-body">
                                    <ul class="list-phones">
                                        {{ env('APP_PHONE') }}
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endif
                    @if (env('APP_EMAIL'))
                        <li>
                            <div class="unit unit-horizontal unit-spacing-xxs">
                                <div class="unit-left">
                                    <span class="fa fa-message"></span>
                                </div>
                                <div class="unit-body">
                                    {{ env('APP_EMAIL') }}
                                </div>
                            </div>
                        </li>
                    @endif
                </ul>
                <div class="group-md group-middle social-items">
                    <a class="fab fa-facebook" href="https://www.facebook.com"></a>
                    <a class="fab fa-twitter" href="https://www.twitter.com"></a>
                    <a class="fab fa-instagram" href="https://www.instagram.com"></a>
                    <a class="fab fa-facebook-messenger" href="https://www.messenger.com"></a>
                    <a class="fab fa-linkedin" href="https://www.linkedin.com"></a>
                    <a class="fab fa-snapchat" href="https://www.snapchat.com"></a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <h5 class="title">Newsletter</h5>
                <p>
                    Keep up with our always upcoming news and updates. Enter your
                    e-mail and subscribe to our newsletter.
                </p>
                <!-- RD Mailform-->
                <form class="rd-form form-sm rd-mailform" data-form-output="form-output-global" data-form-type="contact"
                    method="post" action="#">
                    <div class="form-wrap">
                        <input class="form-input" id="newsletter-email" type="email" name="email" />
                        <label class="form-label" for="newsletter-email">Enter your e-mail</label>
                    </div>
                    <button class="button button-primary" type="submit">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
        <!-- Rights-->
        <p class="rights">
            <span>&copy;&nbsp; </span><span class="copyright-year"></span><span>&nbsp;</span><span>All rights
                reserved</span><span>.&nbsp;</span>
        </p>
    </div>
</footer>
