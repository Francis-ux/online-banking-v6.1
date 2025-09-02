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
                        <form method="POST" action="{{ route('user.international_transfer.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="account_number">Account Number *</label>
                                <input type="text" id="account_number" name="account_number"
                                    value="{{ old('account_number') }}"
                                    class="form-control @error('account_number') is-invalid @enderror">
                                @error('account_number')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="account_name">Account Name *</label>
                                <input type="text" id="account_name" name="account_name"
                                    value="{{ old('account_name') }}"
                                    class="form-control @error('account_name') is-invalid @enderror">
                                @error('account_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="bank_name">Bank Name *</label>
                                <input type="text" id="bank_name" name="bank_name" value="{{ old('bank_name') }}"
                                    class="form-control @error('bank_name') is-invalid @enderror">
                                @error('bank_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="swift_code">SWIFT Code</label>
                                <input type="text" id="swift_code" name="swift_code" value="{{ old('swift_code') }}"
                                    class="form-control @error('swift_code') is-invalid @enderror">
                                @error('swift_code')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="iban_code">IBAN Code</label>
                                <input type="text" id="iban_code" name="iban_code" value="{{ old('iban_code') }}"
                                    class="form-control @error('iban_code') is-invalid @enderror">
                                @error('iban_code')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="routing_number">Routing Number</label>
                                <input type="text" id="routing_number" name="routing_number"
                                    value="{{ old('routing_number') }}"
                                    class="form-control @error('routing_number') is-invalid @enderror">
                                @error('routing_number')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="amount">Amount *</label>
                                <input type="number" id="amount" name="amount" value="{{ old('amount') }}"
                                    class="form-control @error('amount') is-invalid @enderror" min="1">
                                @error('amount')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="transfer_pin">Transaction PIN *</label>
                                <input type="password" id="transfer_pin" name="transfer_pin"
                                    class="form-control @error('transfer_pin') is-invalid @enderror" maxlength="6"
                                    autocomplete="off">
                                @error('transfer_pin')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Submit Transfer</button>
                        </form>

                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>

        </div>

    </div>
@endsection
