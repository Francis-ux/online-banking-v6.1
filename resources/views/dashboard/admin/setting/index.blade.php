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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.setting.update') }}" method="POST" class="row">
                            @csrf
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="loan_interest_rate">Loan Interest Rate *</label>
                                    <input type="number" id="loan_interest_rate" name="loan_interest_rate"
                                        value="{{ old('loan_interest_rate', $setting->loan_interest_rate) }}"
                                        class="form-control @error('loan_interest_rate') is-invalid @enderror" required>
                                    @error('loan_interest_rate')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="virtual_card_fee">Virtual Card Fee *</label>
                                    <input type="number" id="virtual_card_fee" name="virtual_card_fee"
                                        value="{{ old('virtual_card_fee', $setting->virtual_card_fee) }}"
                                        class="form-control @error('virtual_card_fee') is-invalid @enderror" required>
                                    @error('virtual_card_fee')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="physical_card_fee">Physical Card Fee *</label>
                                    <input type="number" id="physical_card_fee" name="physical_card_fee"
                                        value="{{ old('physical_card_fee', $setting->physical_card_fee) }}"
                                        class="form-control @error('physical_card_fee') is-invalid @enderror" required>
                                    @error('physical_card_fee')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="d-flex gap-2">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>

                            </div>
                        </form>

                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
@endsection
