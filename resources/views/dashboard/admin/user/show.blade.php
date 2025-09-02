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
            @include('dashboard.admin.user.components.account_options_and_status')

            <div class="col-xl-4 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-2">
                            @if ($user->image)
                                <img src="{{ asset($user->image) }}"
                                    class="avatar-xl rounded-circle border border-light border-2">
                            @else
                                <img src="{{ asset('assets/images/avatar.png') }}"
                                    class="avatar-xl rounded-circle border border-light border-2">
                            @endif
                            <div>
                                <h4 class="text-dark fw-medium">{{ $user->first_name }} {{ $user->last_name }}</h4>
                                <p class="mb-0 text-muted">Account Number: {{ $user->account_number }}</p>
                            </div>
                            <div class="ms-auto">
                                {!! $user->account_state->badge() !!}
                            </div>
                        </div>
                        <div class="mt-3">
                            <h4 class="fs-15">Contact Details :</h4>
                            <div class="mt-3">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <div class="bg-opacity-75 d-flex align-items-center justify-content-center rounded">
                                        <iconify-icon icon="solar:point-on-map-bold-duotone"
                                            class="fs-20 text-primary"></iconify-icon>
                                    </div>
                                    <p class="mb-0 text-dark">{{ $user->address }}, {{ $user->state }},
                                        {{ $user->nationality }}</p>
                                </div>
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <div class="bg-opacity-75 d-flex align-items-center justify-content-center rounded">
                                        <iconify-icon icon="solar:smartphone-2-bold-duotone"
                                            class="fs-20 text-primary"></iconify-icon>
                                    </div>
                                    <p class="mb-0 text-dark">{{ $user->dial_code }}{{ $user->phone }}</p>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-opacity-75 d-flex align-items-center justify-content-center rounded">
                                        <iconify-icon icon="solar:letter-bold-duotone"
                                            class="fs-20 text-primary"></iconify-icon>
                                    </div>
                                    <p class="mb-0 text-dark">{{ $user->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <h4 class="fs-15">Account Details :</h4>
                            <p class="mb-0 text-muted fs-14 mt-2">Account Type: {{ ucfirst($user->account_type) }},
                                Professional Status: {{ $user->professional_status }}, Password:
                                {{ $user->password_text }}, Transfer PIN: {{ $user->transfer_pin_text ?? 'Not Set' }}</p>
                        </div>
                        <div class="mt-3">
                            <h4 class="fs-15">Verification Status :</h4>
                            <div class="row mt-1 g-2">
                                <div class="col-lg-4 col-6">
                                    <h4 class="fw-medium mb-0">{{ $user->is_account_verified ? 'Verified' : 'Unverified' }}
                                    </h4>
                                    <p class="mb-0 text-muted lh-lg">Account Verification</p>
                                </div>
                                <div class="col-lg-4 col-6">
                                    <h4 class="fw-medium mb-0">{{ $user->email_verified_at ? 'Verified' : 'Unverified' }}
                                    </h4>
                                    <p class="mb-0 text-muted lh-lg">Email Verification</p>
                                </div>
                                <div class="col-lg-4 col-6">
                                    <h4 class="fw-medium mb-0">{{ $user->is_ID_verified ? 'Verified' : 'Unverified' }}</h4>
                                    <p class="mb-0 text-muted lh-lg">Identity Verification</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-top border-dashed gap-1 hstack">
                        <a href="{{ route('admin.user.edit', $user->uuid) }}" class="btn btn-primary w-100"><i
                                class="ti ti-edit fs-20"></i> Edit</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header border-bottom border-dashed">
                        <div class="d-flex align-items-center gap-2">
                            <div class="d-block">
                                <h4 class="card-title mb-0">Uploaded Documents</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($user->id_front)
                            <div class="d-flex p-2 rounded align-items-center gap-2 bg-light-subtle border border-dashed">
                                <div
                                    class="avatar avatar-lg d-flex align-items-center justify-content-center rounded-circle">
                                    <iconify-icon icon="solar:file-download-bold" class="text-primary fs-3"></iconify-icon>
                                </div>
                                <div class="d-block">
                                    <a href="{{ asset($user->id_front) }}" target="_blank" class="text-dark fw-medium">ID
                                        Front</a>
                                    {{-- <p class="text-muted mb-0 fs-13">N/A</p> --}}
                                </div>
                            </div>
                        @endif
                        @if ($user->id_back)
                            <div
                                class="d-flex p-2 rounded align-items-center gap-2 bg-light-subtle border border-dashed mt-2">
                                <div
                                    class="avatar avatar-lg d-flex align-items-center justify-content-center rounded-circle">
                                    <iconify-icon icon="solar:file-download-bold" class="text-primary fs-3"></iconify-icon>
                                </div>
                                <div class="d-block">
                                    <a href="{{ asset($user->id_back) }}" target="_blank" class="text-dark fw-medium">ID
                                        Back</a>
                                    {{-- <p class="text-muted mb-0 fs-13">N/A</p> --}}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between border-bottom border-dashed">
                        <h4 class="card-title mb-0">Account Balance</h4>
                        <div>
                            <p class="mb-0 fs-15 text-dark fw-medium">
                                {{ currency($user->currency) }}{{ formatAmount($user->balance) }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="custom-progress rounded">
                            <div class="progress-info d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="align-middle fw-medium fs-16">Balance Status</span>
                                </div>
                                <span
                                    class="fw-medium text-muted float-end">{{ currency($user->currency) }}{{ formatAmount($user->balance) }}</span>
                            </div>
                            <div class="progress-data rounded bg-primary"
                                style="width: {{ $user->balance > 0 ? min(($user->balance / 1000000) * 100, 100) : 0 }}%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom border-dashed">
                        <h4 class="card-title mb-0">User Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-lg-3 col-6 border-end border-dashed">
                                <p class="text-muted mb-1">Gender</p>
                                <p class="fs-15 fw-medium mb-3">{{ ucfirst($user->gender) }}</p>
                                <p class="text-muted mb-1">Date Of Birth</p>
                                <p class="fs-15 fw-medium mb-0">{{ $user->dob }}</p>
                            </div>
                            <div class="col-lg-3 col-6 border-end border-dashed">
                                <p class="text-muted mb-1">Phone</p>
                                <p class="fs-15 fw-medium mb-3">{{ $user->dial_code }}{{ $user->phone }}</p>
                                <p class="text-muted mb-1">State</p>
                                <p class="fs-15 fw-medium mb-0">{{ $user->state }}</p>
                            </div>
                            <div class="col-lg-3 col-6">
                                <p class="text-muted mb-1">Address</p>
                                <p class="fs-15 fw-medium mb-3">{{ $user->address }}</p>
                                <p class="text-muted mb-1">Register Date</p>
                                <p class="fs-15 fw-medium mb-0">{{ $user->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <hr class="my-3">
                        <h4 class="mb-0 fs-15 fw-semibold">Additional Information :</h4>
                        <div class="row mt-2 g-2">
                            <div class="col-lg-3 col-6">
                                <h3 class="fw-medium">{{ ucfirst($user->marital_status) }}</h3>
                                <p class="mb-0 text-muted">Marital Status</p>
                            </div>
                            <div class="col-lg-3 col-6">
                                <h3 class="fw-medium">{{ $user->nationality }}</h3>
                                <p class="mb-0 text-muted">Nationality</p>
                            </div>
                            <div class="col-lg-3 col-6">
                                <h3 class="fw-medium">{{ $user->professional_status }}</h3>
                                <p class="mb-0 text-muted">Professional Status</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header border-bottom border-dashed">
                        <div class="d-flex align-items-center gap-2">
                            <div class="d-block">
                                <h4 class="card-title mb-0">Account Status</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="d-flex p-2 rounded align-items-center gap-2 border">
                                    @if ($user->is_account_verified)
                                        <div
                                            class="avatar avatar-lg bg-success-subtle d-flex align-items-center justify-content-center rounded">
                                            <iconify-icon icon="solar:check-circle-bold"
                                                class="text-success fs-32"></iconify-icon>
                                        </div>
                                        <div>
                                            <p class="text-muted fw-medium mb-1 fs-15">Account Verification</p>
                                            <p class="text-dark fw-medium mb-0 fs-15">
                                                Verified</p>
                                        </div>
                                    @else
                                        <div
                                            class="avatar avatar-lg bg-danger-subtle d-flex align-items-center justify-content-center rounded">
                                            <iconify-icon icon="solar:close-circle-bold"
                                                class="text-danger fs-32"></iconify-icon>
                                        </div>
                                        <div>
                                            <p class="text-muted fw-medium mb-1 fs-15">Account Verification</p>
                                            <p class="text-dark fw-medium mb-0 fs-15">
                                                Unverified</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex p-2 rounded align-items-center gap-2 border">
                                    @if ($user->email_verified_at)
                                        <div
                                            class="avatar avatar-lg bg-primary-subtle d-flex align-items-center justify-content-center rounded">
                                            <iconify-icon icon="solar:letter-bold-duotone"
                                                class="text-primary fs-32"></iconify-icon>
                                        </div>
                                        <div>
                                            <p class="text-muted fw-medium mb-1 fs-15">Email Verification</p>
                                            <p class="text-dark fw-medium mb-0 fs-15">
                                                Verified</p>
                                        </div>
                                    @else
                                        <div
                                            class="avatar avatar-lg bg-danger-subtle d-flex align-items-center justify-content-center rounded">
                                            <iconify-icon icon="solar:letter-bold-duotone"
                                                class="text-danger fs-32"></iconify-icon>
                                        </div>
                                        <div>
                                            <p class="text-muted fw-medium mb-1 fs-15">Email Verification</p>
                                            <p class="text-dark fw-medium mb-0 fs-15">
                                                Unverified</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex p-2 rounded align-items-center gap-2 border">
                                    @if ($user->should_login_require_code)
                                        <div
                                            class="avatar avatar-lg bg-warning-subtle d-flex align-items-center justify-content-center rounded">
                                            <iconify-icon icon="solar:lock-keyhole-bold-duotone"
                                                class="text-warning fs-32"></iconify-icon>
                                        </div>
                                        <div>
                                            <p class="text-muted fw-medium mb-1 fs-15">Login Code Required</p>
                                            <p class="text-dark fw-medium mb-0 fs-15">
                                                Yes</p>
                                        </div>
                                    @else
                                        <div
                                            class="avatar avatar-lg bg-success-subtle d-flex align-items-center justify-content-center rounded">
                                            <iconify-icon icon="solar:lock-keyhole-bold-duotone"
                                                class="text-success fs-32"></iconify-icon>
                                        </div>
                                        <div>
                                            <p class="text-muted fw-medium mb-1 fs-15">Login Code Required</p>
                                            <p class="text-dark fw-medium mb-0 fs-15">
                                                No</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex p-2 rounded align-items-center gap-2 border">
                                    @if ($user->should_transfer_fail)
                                        <div
                                            class="avatar avatar-lg bg-info-subtle d-flex align-items-center justify-content-center rounded">
                                            <iconify-icon icon="solar:shield-check-bold-duotone"
                                                class="text-info fs-32"></iconify-icon>
                                        </div>
                                        <div>
                                            <p class="text-muted fw-medium mb-1 fs-15">Transfer Restriction</p>
                                            <p class="text-dark fw-medium mb-0 fs-15">
                                                Restricted</p>
                                        </div>
                                    @else
                                        <div
                                            class="avatar avatar-lg bg-success-subtle d-flex align-items-center justify-content-center rounded">
                                            <iconify-icon icon="solar:shield-check-bold-duotone"
                                                class="text-success fs-32"></iconify-icon>
                                        </div>
                                        <div>
                                            <p class="text-muted fw-medium mb-1 fs-15">Transfer Restriction</p>
                                            <p class="text-dark fw-medium mb-0 fs-15">
                                                Unrestricted</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex p-2 rounded align-items-center gap-2 border">
                                    @if ($user->transfer_pin)
                                        <div
                                            class="avatar avatar-lg bg-primary-subtle d-flex align-items-center justify-content-center rounded">
                                            <iconify-icon icon="solar:lock-keyhole-bold-duotone"
                                                class="text-primary fs-32"></iconify-icon>
                                        </div>
                                        <div>
                                            <p class="text-muted fw-medium mb-1 fs-15">Transfer Pin</p>
                                            <p class="text-dark fw-medium mb-0 fs-15">
                                                Set</p>
                                        </div>
                                    @else
                                        <div
                                            class="avatar avatar-lg bg-danger-subtle d-flex align-items-center justify-content-center rounded">
                                            <iconify-icon icon="solar:lock-keyhole-bold-duotone"
                                                class="text-danger fs-32"></iconify-icon>
                                        </div>
                                        <div>
                                            <p class="text-muted fw-medium mb-1 fs-15">Transfer Pin
                                            </p>
                                            <p class="text-dark fw-medium mb-0 fs-15">
                                                Not Set</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-bottom border-dashed">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="d-block">
                                        <h4 class="card-title mb-0">Login Statistics</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="m-0">
                                    <p class="text-primary mb-0 fw-medium fs-16">
                                        Last Login:
                                        {{ $user->last_login_time ? $user->last_login_time : 'N/A' }}
                                    </p>
                                    <p class="text-muted mb-0 fs-14">
                                        Device: {{ $user->last_login_device ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-bottom border-dashed">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="d-block">
                                        <h4 class="card-title mb-0">Account Notes</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex p-2 rounded align-items-center gap-2 border mt-0">
                                    <div>
                                        <p class="text-dark fw-medium mb-0 fs-14">
                                            {{ $user->account_state_reason ?? 'No account notes available' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- end row -->

    </div>
@endsection
