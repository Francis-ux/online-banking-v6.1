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
                        <form method="POST" action="{{ route('user.account_statement.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6 col-lg-12">
                                    <div class="mb-3">
                                        <label for="from" class="form-label">Start</label>
                                        <input type="date" name="from" id="from"
                                            class="form-control @error('from') is-invalid @enderror"
                                            value="{{ old('from') }}">
                                        @error('from')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-12">
                                    <div class="mb-3">
                                        <label for="to" class="form-label">End</label>
                                        <input type="date" name="to" id="to"
                                            class="form-control @error('to') is-invalid @enderror"
                                            value="{{ old('to') }}">
                                        @error('to')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                        </form>

                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>

        </div>

    </div>
@endsection
