@extends('dashboard.user.layouts.master')
@section('content')
    <div class="page-container">

        <div class="page-title-head d-flex align-items-sm-center flex-sm-row flex-column gap-2">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold mb-0">{{ $title }}</h4>
            </div>

            <div class="text-end">
                @include('dashboard.user.layouts.components.breadcrumbs')

            </div>
        </div>

        <div class="row">
            @include('dashboard.user.components.menu')

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <p>We’ve sent a 6-digit code to your email address. Please enter it below.</p>
                        <form action="{{ route('user.email.verification.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="code">Verification Code</label>
                                <input type="text" name="code" id="code" class="form-control" required>
                                @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Verify</button>

                            <a href="{{ route('user.email.verification.resend') }}"
                                class="link-primary d-flex justify-content-center align-items-center">Resend
                                Verification</a>
                        </form>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
@endsection
