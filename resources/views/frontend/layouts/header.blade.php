 <!-- Page Header -->
 <header class="section page-header">
     <!-- RD Navbar-->
     <div class="rd-navbar-wrap rd-navbar-absolute">
         <nav class="rd-navbar rd-navbar-creative" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed"
             data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static"
             data-lg-device-layout="rd-navbar-static" data-xl-layout="rd-navbar-static"
             data-xl-device-layout="rd-navbar-static" data-lg-stick-up-offset="20px" data-xl-stick-up-offset="20px"
             data-xxl-stick-up-offset="20px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
             <div class="rd-navbar-main-outer">
                 <div class="rd-navbar-main">
                     <!-- RD Navbar Panel-->
                     <div class="rd-navbar-panel">
                         <!-- RD Navbar Toggle-->
                         <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap">
                             <span></span>
                         </button>
                         <!-- RD Navbar Brand-->
                         <div class="rd-navbar-brand">
                             <a class="brand" href="/">
                                 <img class="brand-logo-dark" src="{{ asset(env('APP_LOGO_LIGHT')) }}"
                                     alt="logo" width="200" height="45" />
                                 <img class="brand-logo-light" src="{{ asset(env('APP_LOGO_LIGHT')) }}"
                                     alt="logo" width="200" height="45" /></a>
                         </div>
                     </div>
                     <div class="rd-navbar-main-element">
                         <div class="rd-navbar-nav-wrap">
                             <!-- RD Navbar Nav-->
                             <ul class="rd-navbar-nav">
                                 <li class="rd-nav-item">
                                     <a class="rd-nav-link" href="/">Home</a>
                                 </li>
                                 <li class="rd-nav-item">
                                     <a class="rd-nav-link" href="{{ route('about') }}">About us</a>
                                 </li>
                                 <li class="rd-nav-item">
                                     <a class="rd-nav-link" href="{{ route('services') }}">Services</a>
                                 </li>
                                 <li class="rd-nav-item">
                                     <a class="rd-nav-link" href="{{ route('user.loan.index') }}">Loan Application</a>
                                 </li>
                                 <li class="rd-nav-item">
                                     <a class="rd-nav-link" href="{{ route('contact') }}">Contact</a>
                                 </li>
                                 <li class="rd-nav-item">
                                     <a class="rd-nav-link" href="{{ route('login') }}">Login</a>
                                 </li>
                                 <li class="rd-nav-item">
                                     <a class="rd-nav-link" href="{{ route('register') }}">Create
                                         Account</a>
                                 </li>
                             </ul>
                         </div>
                         <!-- RD Navbar Search-->
                         <div class="rd-navbar-search">
                             <button class="rd-navbar-search-toggle rd-navbar-fixed-element-1"
                                 data-rd-navbar-toggle=".rd-navbar-search">
                                 <i class="fa fa-language fa-3x d-lg-none" aria-hidden="true"></i>
                                 <i class="fa fa-language fa-1x d-none d-lg-block" aria-hidden="true"></i>
                                 <!-- <span></span> -->
                             </button>
                             <div class="rd-search" data-search-live="rd-search-results-live" method="GET">
                                 <div class="form-wrap">
                                     <p style="color: black">Select language</p>
                                     <div id="google_translate_element"></div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </nav>
     </div>
 </header>
 <!-- Page Header-->
