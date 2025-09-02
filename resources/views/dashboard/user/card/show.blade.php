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

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('user.card.index') }}" class="btn btn-primary">Back</a>
                        </div>

                        @if ($card->status->value === 'inactive')
                            <form action="{{ route('user.card.activate', $card->uuid) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-primary">Activate Card</button>
                            </form>
                        @elseif ($card->status->value === 'active')
                            <form action="{{ route('user.card.deactivate', $card->uuid) }}" method="POST"
                                class="d-inline mt-5">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-warning">Deactivate Card</button>
                            </form>
                            <form action="{{ route('user.card.setLimit', $card->uuid) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <div class="mb-3 mt-3">
                                    <label for="daily_limit" class="form-label">Set Daily Limit</label>
                                    <input type="number" id="daily_limit" name="daily_limit" class="form-control"
                                        min="0" step="0.01" value="{{ $card->daily_limit }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Update Limit</button>
                            </form>
                        @endif
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>

        </div>

    </div>
@endsection
