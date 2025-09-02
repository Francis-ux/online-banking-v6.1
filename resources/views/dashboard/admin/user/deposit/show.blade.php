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
                        <!-- Invoice Logo-->
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div>

                            </div>
                            <div class="text-end">
                                @if ($deposit->status)
                                    <span class="badge bg-success-subtle text-success fs-12 mb-3">Confirmed</span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning fs-12 mb-3">Pending</span>
                                @endif
                                <h3 class="m-0 fw-bolder fs-20">Deposit: #{{ $deposit->reference_id }}</h3>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <h5 class="fw-bold fs-14">Deposit Date:</h5>
                                    <h6 class="fs-14 text-muted">{{ $deposit->created_at->format('d M Y') }}</h6>
                                </div>
                            </div>

                            <div class="col-lg-6 text-end">
                                @if ($deposit->method === 'bitcoin')
                                    @if ($admin->btc_qr_code)
                                        <img src="{{ asset($admin->btc_qr_code) }}" alt="Bitcoin QR Code"
                                            style="max-width: 200px;">
                                    @else
                                        {{ $qrCode }}
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="table-responsive">
                            <table class="table text-center table-nowrap align-middle mb-0">
                                <thead>
                                    <tr class="bg-light bg-opacity-50">
                                        <th class="text-start border-0" scope="col">Deposit Details</th>
                                        <th class="text-end border-0" scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="products-list">
                                    <tr>
                                        <td class="text-start">
                                            <div class="d-flex align-items-center gap-2">
                                                <iconify-icon
                                                    icon="{{ $deposit->method === 'bitcoin' ? 'logos:bitcoin' : 'mdi:credit-card' }}"
                                                    class="fs-22"></iconify-icon>
                                                <div>
                                                    <span class="fw-medium">{{ ucfirst($deposit->method) }} Deposit</span>
                                                    <p class="text-muted mb-0">
                                                        @if ($deposit->method === 'bitcoin')
                                                            Bitcoin Address: {{ $deposit->wallet_address ?? 'N/A' }}<br>
                                                            @if ($deposit->proof)
                                                                Proof: <a href="{{ asset($deposit->proof) }}"
                                                                    target="_blank">View</a>
                                                            @else
                                                                Proof: N/A
                                                            @endif
                                                        @else
                                                            Card Number: **** **** ****
                                                            {{ substr($deposit->card_number ?? '', -4) }}<br>
                                                            Expiry: {{ $deposit->card_expiry_date ?? 'N/A' }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            {{ currency($deposit->user->currency) }}{{ formatAmount($deposit->amount) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table><!--end table-->
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST"
                            action="{{ route('admin.user.deposit.confirm', [$user->uuid, $deposit->uuid]) }}"
                            class="mt-3">
                            @csrf
                            <div class="btn-group">
                                @if (!$deposit->status)
                                    <button name="status" value="1" class="btn btn-primary">Confirm</button>
                                @endif
                                <a onclick="return confirm('Are you sure?')"
                                    href="{{ route('admin.user.deposit.delete', [$user->uuid, $deposit->uuid]) }}"
                                    class="btn btn-danger">Delete</a>

                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.user.deposit.index', $user->uuid) }}"
                                    class="btn btn-primary">Back</a>
                            </div>
                        </form>
                    </div> <!-- end card-body-->
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
@endsection
