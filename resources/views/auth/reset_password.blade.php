@extends('auth.layouts.master')
@section('content')
    <div class="auth-bg d-flex min-vh-100 justify-content-center align-items-center">
        <div class="row g-0 justify-content-center w-100 m-xxl-5 px-xxl-4 m-3">
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div class="card overflow-hidden text-center h-100 p-xxl-4 p-3 mb-0">
                    @include('auth.layouts.header')

                    <h3 class="fw-semibold mb-2">Create New Password</h3>

                    <p class="text-muted mb-2">Secure your account by setting a new password.</p>

                    <form class="text-start mb-3" method="POST" action="{{ route('password.store') }}">
                        @csrf
                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Enter your email" value="{{ old('email', $request->email) }}" required
                                autofocus autocomplete="username">
                            @if ($errors->has('email'))
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password">Create New Password <small
                                    class="text-primary ms-1">Must be at least 8 characters</small></label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="New Password"required autocomplete="new-password">
                            @if ($errors->has('password'))
                                <p class="text-danger">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password_confirmation">Reenter New Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" placeholder="Reenter Password"required autocomplete="new-password">
                            @if ($errors->has('password_confirmation'))
                                <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                            @endif
                        </div>
                        <div class="mb-2 d-grid">
                            <button class="btn btn-primary" type="submit">Create New Password</button>
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
