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
                        <form method="POST" action="{{ route('user.card.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="type" class="form-label">Card Type *</label>
                                <select id="type" name="type"
                                    class="form-control @error('type') is-invalid @enderror" required>
                                    <option value="">-- Select Type --</option>
                                    <option value="virtual">Virtual Card
                                        ({{ currency($user->currency) }}{{ $setting->virtual_card_fee }} fee)</option>
                                    <option value="physical">Physical Card
                                        ({{ currency($user->currency) }}{{ $setting->physical_card_fee }} fee)</option>
                                </select>
                                @error('type')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Apply</button>
                        </form>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>

        </div>

    </div>
@endsection
