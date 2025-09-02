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
                        <form action="{{ route('admin.verification.code.store') }}" method="POST" class="row">
                            @csrf
                            <div class="col-12">

                                <h4 class="mb-3">New Verification Code</h4>

                                <div class="mb-3">
                                    <label for="name">Name *</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror" required>
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <input type="text" id="description" name="description"
                                        value="{{ old('description') }}"
                                        class="form-control @error('description') is-invalid @enderror">
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <small class="text-muted d-block mt-1">What this code is all about</small>
                                </div>

                                <div class="mb-3">
                                    <label for="length">Length *</label>
                                    <input type="number" id="length" name="length" value="{{ old('length', 7) }}"
                                        class="form-control @error('length') is-invalid @enderror" min="1" required>
                                    @error('length')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <small class="text-muted d-block mt-1">How long do you want this code to be when
                                        generated?</small>
                                </div>

                                <div class="mb-3">
                                    <label for="nature_of_code">Nature of code *</label>
                                    <select id="nature_of_code" name="nature_of_code"
                                        class="form-control @error('nature_of_code') is-invalid @enderror" required>
                                        <option value="alnum"
                                            {{ old('nature_of_code', 'alnum') === 'alnum' ? 'selected' : '' }}>Alphanumeric
                                        </option>
                                        <option value="numeric" {{ old('nature_of_code') === 'numeric' ? 'selected' : '' }}>
                                            Numeric</option>
                                    </select>
                                    @error('nature_of_code')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <small class="text-muted d-block mt-1">
                                        Do you want this code to be a mixture of letters and numbers (alphanumeric) or just
                                        numbers (numeric)?
                                    </small>
                                </div>

                                <div class="mb-3">
                                    <label for="applicable_to">Applicable to user *</label>
                                    <select id="applicable_to" name="applicable_to"
                                        class="form-control @error('applicable_to') is-invalid @enderror" required>
                                        <option value="All"
                                            {{ old('applicable_to', 'All') === 'All' ? 'selected' : '' }}>ALL USERS
                                        </option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ old('applicable_to') == $user->id ? 'selected' : '' }}>
                                                {{ $user->first_name . ' ' . $user->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('applicable_to')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="d-flex gap-2">
                                    <button class="btn btn-primary btn-sm" type="submit">SAVE</button>
                                    <button class="btn btn-warning btn-sm" type="reset">RESET</button>
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
