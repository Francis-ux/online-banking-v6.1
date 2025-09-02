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
                        @if (!$user->transfer_pin || ($user->transfer_pin && $user->transfer_pin_reset_by_admin === 1))
                            <form method="POST" action="{{ route('user.transfer_pin.store') }}" autocomplete="off">
                                @csrf
                                <div class="mb-3">
                                    <label for="transfer_pin">Transfer PIN (4-6 characters) *</label>
                                    <input type="password" id="transfer_pin" name="transfer_pin"
                                        class="form-control @error('transfer_pin') is-invalid @enderror" required>
                                    @error('transfer_pin')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="transfer_pin_confirmation">Confirm PIN *</label>
                                    <input type="password" id="transfer_pin_confirmation" name="transfer_pin_confirmation"
                                        class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Set PIN</button>
                            </form>
                        @else
                            Your transfer PIN is already set. Please contact our support team to request a reset.
                        @endif
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
@endsection
