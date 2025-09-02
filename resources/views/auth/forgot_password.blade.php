@extends('auth.layouts.master')
@section('content')
    <div class="auth-bg d-flex min-vh-100 justify-content-center align-items-center">
        <div class="row g-0 justify-content-center w-100 m-xxl-5 px-xxl-4 m-3">
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div class="card overflow-hidden text-center h-100 p-xxl-4 p-3 mb-0">
                    @include('auth.layouts.header')

                    <h3 class="fw-semibold mb-2">Forgot Your Password?</h3>

                    <p class="text-muted mb-4">We get it, stuff happens. Just enter your email address below and we'll
                        send you a link to reset your password!</p>

                    <form method="POST" action="{{ route('password.email') }}" class="text-start mb-3">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Enter your email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit">Email Password Reset Link</button>
                        </div>
                    </form>

                    <p class="text-danger fs-14 mb-4">Back To <a href="{{ route('login') }}"
                            class="fw-semibold text-dark ms-1">Login !</a></p>

                    @include('auth.layouts.footer')
                </div>
            </div>
        </div>
    </div>
@endsection
