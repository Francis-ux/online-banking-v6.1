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
                        @if ($user->is_ID_verified == 1)
                            <p class="text-success">✅ Your ID has been approved.</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Front:</strong></p>
                                    <img src="{{ asset($user->id_front) }}" class="img-fluid rounded border">
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Back:</strong></p>
                                    <img src="{{ asset($user->id_back) }}" class="img-fluid rounded border">
                                </div>
                            </div>
                        @elseif($user->is_ID_verified == 2)
                            <p class="text-danger">❌ Your ID was rejected. Please resubmit valid documents.</p>

                            <form method="POST" action="{{ route('user.identity_verification.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="id_front">Upload ID Front *</label>
                                    <input type="file" id="id_front" name="id_front"
                                        class="form-control @error('id_front') is-invalid @enderror" accept="image/*"
                                        required>
                                    @error('id_front')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="id_back">Upload ID Back *</label>
                                    <input type="file" id="id_back" name="id_back"
                                        class="form-control @error('id_back') is-invalid @enderror" accept="image/*"
                                        required>
                                    @error('id_back')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Submit Verification</button>
                            </form>
                        @elseif($user->is_ID_verified == 3)
                            <p class="text-warning">⏳ Your ID verification is under review.</p>
                        @else
                            <form method="POST" action="{{ route('user.identity_verification.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="id_front">Upload ID Front *</label>
                                    <input type="file" id="id_front" name="id_front"
                                        class="form-control @error('id_front') is-invalid @enderror" accept="image/*"
                                        required>
                                    @error('id_front')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="id_back">Upload ID Back *</label>
                                    <input type="file" id="id_back" name="id_back"
                                        class="form-control @error('id_back') is-invalid @enderror" accept="image/*"
                                        required>
                                    @error('id_back')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Submit Verification</button>
                            </form>
                        @endif

                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
@endsection
