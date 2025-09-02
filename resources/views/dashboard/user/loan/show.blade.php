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
                        <dl class="row">
                            <dt class="col-sm-3">Amount</dt>
                            <dd class="col-sm-9">{{ currency($loan->user->currency) }}{{ formatAmount($loan->amount) }}</dd>

                            <dt class="col-sm-3">Status</dt>
                            <dd class="col-sm-9">
                                <span class="{{ $loan->status->badge() }}">
                                    {{ $loan->status->label() }}
                                </span>
                            </dd>

                            <dt class="col-sm-3">Total Repayable</dt>
                            <dd class="col-sm-9">
                                {{ currency($loan->user->currency) }}{{ formatAmount($loan->total_repayable) }}
                            </dd>

                            <dt class="col-sm-3">Disbursed At</dt>
                            <dd class="col-sm-9">{{ $loan->disbursed_at ? $loan->disbursed_at->format('d M Y') : 'N/A' }}
                            </dd>

                            <dt class="col-sm-3">Due At</dt>
                            <dd class="col-sm-9">{{ $loan->due_at ? $loan->due_at->format('d M Y') : 'N/A' }}</dd>

                            @if ($loan->loanRepayments)
                                @foreach ($loan->loanRepayments as $loanRepayment)
                                    <dt class="col-sm-3">Loan Repayment Status</dt>
                                    <dd class="col-sm-9">
                                        Amount:
                                        {{ currency($loan->user->currency) }}{{ formatAmount($loanRepayment->amount) }}<br>
                                        Status: {!! $loanRepayment->status->badge() !!}<br>
                                        Repaid At:
                                        {{ $loanRepayment->repaid_at ? $loanRepayment->repaid_at->format('d M Y') : 'N/A' }}
                                    </dd>
                                @endforeach
                            @endif
                        </dl>
                        @if ($loan->status->value === 'active')
                            <a href="{{ route('user.loan.repay', $loan->uuid) }}" class="btn btn-primary">Repay Full Amount
                                ({{ currency($loan->user->currency) }}{{ formatAmount($loanRepayment->amount) }})</a>
                        @endif

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('user.loan.index') }}" class="btn btn-primary">Back</a>
                        </div>

                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>

        </div>

    </div>
@endsection
