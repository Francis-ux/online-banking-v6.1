@extends('dashboard.master.layouts.master')
@section('content')
    <div class="page-container">

        <div class="page-title-head d-flex align-items-sm-center flex-sm-row flex-column gap-2">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold mb-0">{{ $title }}</h4>
            </div>

            <div class="text-end">
                @include('dashboard.master.layouts.components.breadcrumbs')

            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                @include('partials.validation_message')

                <div class="card">
                    <div class="card-header border-bottom border-dashed">
                        <h4 class="card-title mb-0 flex-grow-1">{{ $title }}</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <form action="{{ route('master.admin.update', $admin->uuid) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $admin->name) }}"
                                    class="form-control">
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email"
                                    value="{{ old('email', $admin->email) }}" class="form-control">
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password (Leave blank to keep current)</label>
                                <input type="password" id="new_password" name="password" class="form-control">
                            </div>

                            <!-- Status -->
                            <div class="mb-3">
                                <label for="example-select" class="form-label">Status</label>
                                <select id="example-select" name="status" class="form-select">
                                    <option value="1" @selected(old('status', $admin->status) == 1)>Active
                                    </option>
                                    <option value="0" @selected(old('status', $admin->status) == 0)>
                                        Inactive</option>
                                </select>
                            </div>

                            <!-- Registration Token -->
                            <div class="mb-3">
                                <label for="registration_token" class="form-label">Registration Token</label>
                                <input type="text" id="registration_token" name="registration_token"
                                    value="{{ old('registration_token', $admin->registration_token) }}"
                                    class="form-control">
                            </div>

                            <!-- BTC Address -->
                            <div class="mb-3">
                                <label for="btc_address" class="form-label">BTC Address</label>
                                <input type="text" id="btc_address" name="btc_address"
                                    value="{{ old('btc_address', $admin->btc_address) }}" class="form-control">
                            </div>

                            <!-- BTC QR Code -->
                            <div class="mb-3">
                                <label for="btc_qr_code" class="form-label">BTC QR Code</label>
                                <input type="file" id="btc_qr_code" name="btc_qr_code" class="form-control">
                            </div>

                            <!-- BTC QR Code Preview -->
                            @if ($admin->btc_qr_code)
                                <div class="mb-3">
                                    <img src="{{ asset($admin->btc_qr_code) }}" alt="BTC QR Code" class="img-thumbnail"
                                        width="200">
                                </div>
                            @endif

                            <!-- Save Button -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('master.admin.index') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Admin</button>
                            </div>
                        </form>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
@endsection
