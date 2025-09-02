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
                        <h4 class="card-title mb-0 flex-grow-1">{{ $title }}</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.loan.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="amount">Amount *</label>
                                <input type="number" id="amount" name="amount"
                                    class="form-control @error('amount') is-invalid @enderror" min="100">
                                @error('amount')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="duration_months">Duration (Months) *</label>
                                <input type="number" id="duration_months" name="duration_months"
                                    class="form-control @error('duration_months') is-invalid @enderror" min="1"
                                    max="60">
                                @error('duration_months')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="purpose">Purpose</label>
                                <textarea id="purpose" name="purpose" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Apply</button>
                        </form>
                    </div><!-- end card-body -->
                </div><!-- end card -->

                <div class="card">
                    <div class="card-header border-bottom border-dashed">
                        <h4 class="card-title mb-0 flex-grow-1">Loan History</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($loans as $index => $loan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ currency($loan->user->currency) }}{{ formatAmount($loan->amount) }}</td>
                                            <td>
                                                <span class="{{ $loan->status->badge() }}">
                                                    {{ $loan->status->label() }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('user.loan.show', $loan->uuid) }}"
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
