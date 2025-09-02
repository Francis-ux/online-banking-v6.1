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
                    <div class="card-header border-bottom border-dashed">
                        <h4 class="card-title mb-0 flex-grow-1">Deposit Via:</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <a href="{{ route('user.deposit.create', 'card') }}"><img class="img-fluid w-50"
                                        src="{{ asset('assets/images/card.jpg') }}"></a>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('user.deposit.create', 'bitcoin') }}"><img class="img-fluid w-50"
                                        src="{{ asset('assets/images/bitcoin.png') }}"></a>
                            </div>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->

                <div class="card">
                    <div class="card-header border-bottom border-dashed">
                        <h4 class="card-title mb-0 flex-grow-1">Deposit History</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Reference ID</th>
                                        <th>Amount</th>
                                        <th>Proof</th>
                                        <th>Method</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($deposits as $index => $deposit)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $deposit->reference_id }}</td>
                                            <td>{{ currency($deposit->user->currency) }}{{ formatAmount($deposit->amount) }}
                                            </td>
                                            <td>
                                                @if ($deposit->proof)
                                                    <a href="{{ asset($deposit->proof) }}" target="_blank">View
                                                        Proof</a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ ucfirst($deposit->method) }}</td>
                                            <td>
                                                @if ($deposit->status)
                                                    <span
                                                        class="badge bg-success-subtle text-success fs-12 p-1">Confirmed</span>
                                                @else
                                                    <span
                                                        class="badge bg-warning-subtle text-warning fs-12 p-1">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('user.deposit.show', $deposit->uuid) }}"
                                                    class="btn btn-soft-primary btn-icon btn-sm rounded-circle"> <i
                                                        class="ti ti-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>

        </div>

    </div>
@endsection
