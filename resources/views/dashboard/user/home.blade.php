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
            <div class="col-xxl-9">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="d-flex card-header justify-content-between align-items-center">
                                <h4 class="header-title">Total Balance</h4>
                            </div>

                            <div class="card-body pt-0">
                                <h2 class="fw-bold">{{ currency($user->currency) }}{{ formatAmount($user->balance) }} <a
                                        href="{{ route('user.profile.index') }}" class="text-muted"></a></h2>

                                <div class="row g-2 mt-2 pt-1">
                                    <div class="col">
                                        <a href="{{ route('user.international_transfer.index') }}" class="btn btn-primary w-100"><i class="ti ti-coin me-1"></i>
                                            Transfer</a>
                                    </div>
                                    <div class="col">
                                        <a href="{{ route('user.deposit.index') }}" class="btn btn-info w-100"><i
                                                class="ti ti-coin me-1"></i>
                                            Deposit</a>
                                    </div>
                                </div>
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">

                                <div class="row justify-content-between">
                                    <div class="col-sm-5">
                                        <iconify-icon icon="material-symbols-light:account-child-outline"
                                            class="fs-36 text-muted"></iconify-icon>
                                        <h3 class="mb-0 fw-bold mt-2 mb-1">
                                            {{ ucfirst($user->account_type) }}
                                        </h3>
                                        <p class="text-muted">Account Type</p>
                                    </div> <!-- end col -->
                                </div>

                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">

                                <div class="row justify-content-between">
                                    <div class="col-sm-5">
                                        <iconify-icon icon="mdi:account-check-outline"
                                            class="fs-36 text-muted"></iconify-icon>
                                        <h3 class="mb-0 fw-bold mt-2 mb-1">
                                            @if ($user->account_state->value == 1)
                                                Active
                                            @elseif($user->account_state->value == 2)
                                                Disabled
                                            @elseif($user->account_state->value == 3)
                                                KYC Pending
                                            @else
                                                Frozen
                                            @endif
                                        </h3>
                                        <p class="text-muted">Account State</p>
                                    </div> <!-- end col -->
                                </div>
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div> <!-- end row -->

                @include('dashboard.user.components.home_transactions')

            </div> <!-- end col -->

            <div class="col-xxl-3">
                @include('dashboard.user.components.home_cards_and_quick_transfer')
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
@endsection
