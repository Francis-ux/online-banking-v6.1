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
                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Reference ID</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transfers as $index => $transfer)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $transfer->reference_id }}</td>
                                            <td>
                                                {{ $transfer->type->label() }}
                                            </td>
                                            <td>
                                                {{ currency($transfer->user->currency) }}{{ formatAmount($transfer->amount) }}
                                            </td>
                                            <td>
                                                {{ $transfer->created_at->format('d M Y, h:i:s A') }}
                                            </td>
                                            <td>
                                                <span class="{{ $transfer->status->badge() }}">
                                                    {{ $transfer->status->label() }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.user.withdrawal.show', [$user->uuid, $transfer->uuid]) }}"
                                                    class="btn btn-soft-primary btn-icon btn-sm rounded-circle m-2">
                                                    <i class="ti ti-eye"></i></a>
                                                <a onclick="return confirm('Are you sure?')" href="#"
                                                    class="btn btn-soft-danger btn-icon btn-sm rounded-circle m-2">
                                                    <i class="ti ti-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
@endsection
