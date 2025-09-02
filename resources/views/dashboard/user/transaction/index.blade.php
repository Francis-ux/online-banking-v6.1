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
                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Reference ID</th>
                                        <th>Direction</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $index => $transaction)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $transaction->reference_id }}</td>
                                            <td>
                                                {!! $transaction->direction->badge() !!}
                                            </td>
                                            <td>
                                                {{ $transaction->type->label() }}
                                            </td>
                                            <td>{{ currency($transaction->user->currency) }}{{ formatAmount($transaction->amount) }}
                                            </td>
                                            <td>
                                                {{ date('d M Y, h:i:s A', strtotime($transaction->transaction_at)) }}
                                            </td>
                                            <td>
                                                {!! $transaction->status->badge() !!}
                                            </td>
                                            <td>
                                                <a href="{{ route('user.transaction.show', $transaction->uuid) }}"
                                                    class="btn btn-soft-primary btn-icon btn-sm rounded-circle m-1">
                                                    <i class="ti ti-eye"></i></a>
                                                <a onclick="return confirm('Download PDF?')"
                                                    href="{{ route('user.transaction_receipt.download', $transaction->uuid) }}"
                                                    target="_blank"
                                                    class="btn btn-soft-primary btn-icon btn-sm rounded-circle m-1">
                                                    <i class="ti ti-pdf"></i></a>
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
