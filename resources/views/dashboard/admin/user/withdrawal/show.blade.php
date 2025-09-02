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

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <dl class="row">
                            <h5 class="col-sm-12 text-primary">Withdrawal Details</h5>
                            <dt class="col-sm-4">Withdrawal Method:</dt>
                            <dd class="col-sm-8">{{ $transfer->type->label() }}</dd>
                            <dt class="col-sm-4">Withdrawal Amount:</dt>
                            <dd class="col-sm-8">
                                <strong>{{ currency($transfer->user->currency) . formatAmount($transfer->amount) }}</strong>
                                {{ currency($transfer->user->currency, 'code') }}
                            </dd>
                            <dt class="col-sm-4"> Completed Process:</dt>
                            <dd class="col-sm-8">
                                <span class="{{ $transfer->status->badge() }}">{{ $transfer->status->label() }}</span>
                            </dd>
                            <dt class="col-sm-4">Withdrawal Method:</dt>
                            <dd class="col-sm-8">{{ $transfer->type->label() }}</dd>
                            <dt class="col-sm-4">Date:</dt>
                            <dd class="col-sm-8">{{ $transfer->created_at->format('d M Y, h:i:s A') }}</dd>
                            </dd>

                            <h5 class="col-sm-12 text-primary">Beneficiary Details</h5>

                            <dt class="col-sm-4">Bank Name:</dt>
                            <dd class="col-sm-8">{{ $transfer->bank_name }}</dd>
                            <dt class="col-sm-4">Account Name:</dt>
                            <dd class="col-sm-8">{{ $transfer->account_name }}</dd>
                            <dt class="col-sm-4">Account Number:</dt>
                            <dd class="col-sm-8">{{ $transfer->account_number }}</dd>
                            <dt class="col-sm-4">Routing Number:</dt>
                            <dd class="col-sm-8">{{ $transfer->routing_number }}</dd>

                            <h5 class="col-sm-12 text-primary">Verification codes</h5>
                            @forelse ($transferCodes as $code)
                                <dt class="col-sm-4">{{ $code->name }}</dt>
                                <dd class="col-sm-8">{{ $code->code }}</dd>
                            @empty
                                <dd class="col-12">No verification codes</dd>
                            @endforelse
                        </dl>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.user.withdrawal.index', $user->uuid) }}"
                                class="btn btn-primary">Back</a>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
@endsection
