@extends('auth.layouts.master')
@section('content')
    <div class="auth-bg d-flex min-vh-100 justify-content-center align-items-center">
        <div class="row g-0 justify-content-center w-100 m-xxl-5 px-xxl-4 m-3">
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div class="card overflow-hidden text-center h-100 p-xxl-4 p-3 mb-0">
                    @include('auth.layouts.header')

                    <h3 class="fw-semibold mb-4">Logged Out</h3>

                    <div class="mb-3 text-start">
                        <div class="bg-success-subtle p-2 rounded fw-medium mb-0" role="alert">
                            <p class="mb-0 text-success">
                                You have successfully logged out. Please log in again to continue.
                            </p>
                        </div>
                    </div>

                    <p class="text-danger fs-14 my-3">
                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    </p>

                    @include('auth.layouts.footer')
                </div>
            </div>
        </div>
    </div>
@endsection
