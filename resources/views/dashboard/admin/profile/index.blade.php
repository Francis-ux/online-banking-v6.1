@extends('dashboard.admin.layouts.master')
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
            <div class="col-12">

                @include('partials.validation_message')

                <div class="card">
                    <div class="card-header border-bottom border-dashed d-flex align-items-center">
                        <h4 class="header-title">{{ $title }}</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Enter full name" disabled value="{{ $admin->name }}">
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="Enter email" disabled value="{{ $admin->email }}">
                            </div>

                            <!-- Status -->
                            <div class="mb-3">
                                <label for="example-select" class="form-label">Status</label>
                                <select id="example-select" name="status" class="form-select" disabled>
                                    <option value="1" @selected($admin->status === 1)>Active</option>
                                    <option value="0" @selected($admin->status === 0)>Inactive</option>
                                </select>
                            </div>

                            <!-- Registration Token -->
                            <div class="mb-3">
                                <label for="registration_token" class="form-label">Registration Token</label>
                                <input type="text" id="registration_token" name="registration_token" class="form-control"
                                    placeholder="Enter registration token" disabled
                                    value="{{ $admin->registration_token }}">
                            </div>

                            <!-- BTC Address -->
                            <div class="mb-3">
                                <label for="btc_address" class="form-label">BTC Address</label>
                                <input type="text" id="btc_address" name="btc_address" class="form-control"
                                    placeholder="Enter BTC wallet address" value="{{ $admin->btc_address }}">
                            </div>

                            <!-- BTC QR Code -->
                            <div class="mb-3">
                                <label for="btc_qr_code" class="form-label">BTC QR Code</label>
                                <input type="file" id="btc_qr_code" name="btc_qr_code" class="form-control">
                            </div>

                            @if ($admin->btc_qr_code)
                                <div class="mb-3">
                                    <img src="{{ asset($admin->btc_qr_code) }}" alt="BTC QR Code" class="img-thumbnail"
                                        width="200">
                                </div>
                            @endif

                            <!-- Submit -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
