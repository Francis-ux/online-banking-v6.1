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
                    <div class="card-header">
                        <a onclick="return confirm('Download PDF?')"
                            href="{{ route('user.account_statement.download', [$fromDate, $toDate]) }}" target="_blank"
                            class="btn btn-success"> <i class="ti ti-download"></i> Download</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Reference ID</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Direction</th>
                                        <th>Balance</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $transaction->reference_id }}</td>
                                            <td>{{ currency($transaction->user->currency) }}{{ formatAmount($transaction->amount) }}
                                            </td>
                                            <td>{{ $transaction->type->label() }}</td>
                                            <td>
                                                {!! $transaction->direction->badge() !!}
                                            </td>
                                            <td>{{ currency($user->currency) }}{{ formatAmount($transaction->current_balance) }}
                                            </td>
                                            <td>{{ $transaction->description }}</td>
                                            <td>{{ date('d M Y, h:i:s A', strtotime($transaction->transaction_at)) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="thead-dark">
                                    <tr>
                                        <td colspan="5"><strong>*** Totals ***</strong></td>
                                        <td>{{ currency($user->currency) }}{{ formatAmount($totalAmount) }}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>

        </div>

    </div>
@endsection
