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
                        <dl>
                            <dt>Reference ID</dt>
                            <dd>{{ $card->reference_id }}</dd>
                            <dt>Type</dt>
                            <dd>{{ $card->type->label() }}</dd>
                            <dt>Card Number</dt>
                            {{-- <dd>**** **** **** {{ substr($card->card_number, -4) }}</dd> --}}
                            <dd>{{ $card->getCardNumberAttribute($card->card_number) }}</dd>
                            <dt>Expiry Date</dt>
                            <dd>{{ $card->expiry_date }}</dd>
                            <dt>CVV</dt>
                            <dd>{{ $card->cvv }}</dd>
                            <dt>Status</dt>
                            <dd>
                                <span class="{{ $card->status->badge() }}">
                                    {{ $card->status->label() }}
                                </span>

                            </dd>
                            <dt>Daily Limit</dt>
                            <dd>{{ $card->daily_limit ? currency($card->user->currency) . formatAmount($card->daily_limit) : 'No limit set' }}
                            </dd>
                            <dt>Issued At</dt>
                            <dd>{{ $card->issued_at ? $card->issued_at->format('d M Y') : 'N/A' }}</dd>
                        </dl>

                        <div class="d-flex justify-content-start gap-2">
                            <a href="{{ route('admin.user.card.issue', [$user->uuid, $card->uuid]) }}"
                                class="btn btn-primary">Issue</a>

                            <a href="{{ route('admin.user.card.block', [$user->uuid, $card->uuid]) }}"
                                class="btn btn-danger">Block</a>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.user.card.index', $user->uuid) }}" class="btn btn-primary">Back</a>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
@endsection
