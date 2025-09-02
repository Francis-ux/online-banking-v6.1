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
                        @if ($deposit == 'Card')
                            {{-- MARK: CARD DEPOSIT --}}
                            <p class="text-muted">
                                Enter your card details to make a deposit. All fields marked with an asterisk (*) are
                                required.
                            </p>
                            <form method="POST" action="{{ route('user.deposit.card.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Amount
                                                ({{ currency($user->currency) }})
                                                *</label>
                                            <input type="number" id="amount" name="amount"
                                                class="form-control @error('amount') is-invalid @enderror"
                                                value="{{ old('amount') }}" min="1" step="0.01" required>
                                            @error('amount')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <input type="hidden" id="method" name="method" class="form-control"
                                                value="card" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label for="card_number" class="form-label">Card Number *</label>
                                            <input type="text" id="card_number" name="card_number"
                                                class="form-control @error('card_number') is-invalid @enderror"
                                                value="{{ old('card_number') }}" placeholder="1234 5678 9012 3456" required>
                                            @error('card_number')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="cvv" class="form-label">CVV *</label>
                                            <input type="text" id="cvv" name="cvv"
                                                class="form-control @error('cvv') is-invalid @enderror"
                                                value="{{ old('cvv') }}" placeholder="123" required>
                                            @error('cvv')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="card_expiry_date" class="form-label">Card Expiry Date (MM/YY)
                                                *</label>
                                            <input type="text" id="card_expiry_date" name="card_expiry_date"
                                                class="form-control @error('card_expiry_date') is-invalid @enderror"
                                                value="{{ old('card_expiry_date') }}" placeholder="12/25" required>
                                            @error('card_expiry_date')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Submit Deposit</button>
                                        <a href="{{ route('user.deposit.index') }}" class="btn btn-light">Cancel</a>
                                    </div>
                                </div>
                            </form>
                            {{-- MARK: END CARD DEPOSIT --}}
                        @else
                            {{-- MARK: BITCOIN DEPOSIT --}}
                            <p class="text-muted">
                                Send your Bitcoin payment to the address below or scan the QR code with your wallet. Enter
                                the deposit amount and optionally upload proof of the transaction (e.g., transaction ID or
                                screenshot). All fields marked with an asterisk (*) are required.
                            </p>
                            <form method="POST" action="{{ route('user.deposit.bitcoin.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="wallet_address" class="form-label">Bitcoin Wallet Address *</label>
                                            <div class="input-group">
                                                <input type="text" id="wallet_address" name="wallet_address"
                                                    class="form-control" value="{{ $admin->btc_address }}" readonly>
                                                <button type="button" class="btn btn-outline-secondary"
                                                    onclick="copyToClipboard('wallet_address')" title="Copy address">
                                                    <i class="ti ti-copy"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">QR Code</label><br>
                                            @if ($admin->btc_qr_code)
                                                <img src="{{ asset($admin->btc_qr_code) }}" alt="Bitcoin QR Code"
                                                    style="max-width: 200px;">
                                            @else
                                                {{ $qrCode }}
                                            @endif

                                        </div>

                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Amount
                                                ({{ currency($user->currency) }}) *</label>
                                            <input type="number" id="amount" name="amount"
                                                class="form-control @error('amount') is-invalid @enderror"
                                                value="{{ old('amount') }}" min="1" step="0.01" required>
                                            @error('amount')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <input type="hidden" id="method" name="method" class="form-control"
                                                value="bitcoin" readonly>
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="proof" class="form-label">Transaction Proof (JPG,
                                                PNG)</label>
                                            <input type="file" id="proof" name="proof"
                                                class="form-control @error('proof') is-invalid @enderror"
                                                accept=".jpg,.jpeg,.png">
                                            @error('proof')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Submit Deposit</button>
                                        <a href="{{ route('user.deposit.index') }}" class="btn btn-light">Cancel</a>
                                    </div>
                                </div>
                            </form>
                            {{-- MARK: END BITCOIN DEPOSIT --}}
                        @endif
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>

        </div>

    </div>

    <script>
        function copyToClipboard(elementId) {
            const input = document.getElementById(elementId);
            navigator.clipboard.writeText(input.value).then(() => {
                alert('Bitcoin address copied to clipboard!');
            }).catch(err => {
                console.error('Failed to copy: ', err);
                alert('Failed to copy address. Please try again.');
            });
        }
    </script>
@endsection
