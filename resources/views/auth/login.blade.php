@extends('auth.layouts.master')
@section('content')
    <div class="auth-bg d-flex min-vh-100 justify-content-center align-items-center">
        <div class="row g-0 justify-content-center w-100 m-xxl-5 px-xxl-4 m-3">
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div class="card overflow-hidden text-center h-100 p-xxl-4 p-3 mb-0">
                    @include('auth.layouts.header')

                    <h3 class="fw-semibold mb-2">Login your account</h3>

                    <p class="text-muted mb-4">Enter your email address or account number, along with your password, to
                        securely access your account.</p>

                    @if (session('status'))
                        <p class="text-success"> {{ session('status') }}</p>
                    @endif
                    <form method="POST" action="{{ route('login') }}" class="text-start mb-3">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="email_or_account_number">Email or Account Number</label>
                            <input type="text" id="email_or_account_number" name="email_or_account_number"
                                class="form-control" placeholder="Enter your email or account number"
                                value="{{ old('email_or_account_number') }}" autocomplete="email_or_account_number">

                            @if ($errors->has('email_or_account_number'))
                                <p class="text-danger">{{ $errors->first('email_or_account_number') }}</p>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Enter your password" autocomplete="current-password">

                            @if ($errors->has('password'))
                                <p class="text-danger">{{ $errors->first('password') }}</p>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember_me">
                                <label class="form-check-label" for="remember_me" name="remember">Remember me</label>
                            </div>

                            <a href="{{ route('password.request') }}" class="text-muted border-bottom border-dashed">Forgot
                                Password?</a>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit">Login</button>
                        </div>
                    </form>

                    <p class="text-danger fs-14 mb-4">Don't have an account? <a href="{{ route('register') }}"
                            class="fw-semibold text-dark ms-1">Sign Up !</a></p>

                    @include('auth.layouts.footer')
                </div>
            </div>
        </div>
    </div>
@endsection
