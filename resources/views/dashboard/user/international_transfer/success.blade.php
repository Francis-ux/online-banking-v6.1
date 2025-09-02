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
                        <div class="alert alert-success shadow-sm rounded-3 p-4">
                            <h4 class="alert-heading mb-3">
                                <i class="ti ti-circle-check"></i> Transfer Successful
                            </h4>
                            <p class="mb-2">
                                Your transfer of
                                <strong>{{ currency($user->currency) }}{{ formatAmount($transfer->amount) }}</strong>
                                to <strong>{{ $transfer->account_name }}</strong>
                                ({{ $transfer->account_number }}) was completed successfully.
                            </p>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small">
                                    Transaction Ref: <strong>{{ $transaction->reference_id }}</strong>
                                </span>
                            </div>
                        </div>

                    </div><!-- end card-body -->
                    <div class="card-footer">
                        <a href="{{ route('user.international_transfer.index') }}" class="btn btn-info mb-2">
                            <i class="ti ti-transfer"></i> Make Another Transfer
                        </a>
                        <a href="{{ route('user.transaction_receipt.download', $transaction->uuid) }}"
                            class="btn btn-primary mb-2" target="_blank">
                            <i class="ti ti-download"></i> Save Receipt
                        </a>
                    </div>
                </div><!-- end card -->
            </div>

        </div>

    </div>
@endsection
