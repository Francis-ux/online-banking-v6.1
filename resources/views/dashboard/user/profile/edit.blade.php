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

            @include('partials.validation_message')

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First Name</label>
                                        <input type="text" id="first_name" name="first_name"
                                            class="form-control @error('first_name') is-invalid @enderror"
                                            value="{{ old('first_name', $user->first_name) }}" required>
                                        @error('first_name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Last Name</label>
                                        <input type="text" id="last_name" name="last_name"
                                            class="form-control @error('last_name') is-invalid @enderror"
                                            value="{{ old('last_name', $user->last_name) }}" required>
                                        @error('last_name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select id="gender" name="gender"
                                            class="form-select @error('gender') is-invalid @enderror" required>
                                            <option value="male"
                                                {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="female"
                                                {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female
                                            </option>
                                            <option value="other"
                                                {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other
                                            </option>
                                        </select>
                                        @error('gender')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="marital_status" class="form-label">Marital Status</label>
                                        <select id="marital_status" name="marital_status"
                                            class="form-select @error('marital_status') is-invalid @enderror" required>
                                            <option value="single"
                                                {{ old('marital_status', $user->marital_status) == 'single' ? 'selected' : '' }}>
                                                Single</option>
                                            <option value="married"
                                                {{ old('marital_status', $user->marital_status) == 'married' ? 'selected' : '' }}>
                                                Married</option>
                                            <option value="separated"
                                                {{ old('marital_status', $user->marital_status) == 'separated' ? 'selected' : '' }}>
                                                Separated</option>
                                            <option value="divorced"
                                                {{ old('marital_status', $user->marital_status) == 'divorced' ? 'selected' : '' }}>
                                                Divorced</option>
                                            <option value="widowed"
                                                {{ old('marital_status', $user->marital_status) == 'widowed' ? 'selected' : '' }}>
                                                Widowed</option>
                                        </select>
                                        @error('marital_status')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="dial_code" class="form-label">Dial Code</label>
                                        <select id="dial_code" name="dial_code"
                                            class="form-select @error('dial_code') is-invalid @enderror" required>
                                            @foreach (config('setting.dial_code') as $key => $dialCode)
                                                <option value="+{{ $key }}"
                                                    {{ $user->dial_code == '+' . $key ? 'selected' : '' }}>
                                                    {{ $dialCode }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('dial_code')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="tel" id="phone" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ old('phone', $user->phone) }}" required>
                                        @error('phone')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="professional_status" class="form-label">Professional Status</label>
                                        <input type="text" id="professional_status" name="professional_status"
                                            class="form-control @error('professional_status') is-invalid @enderror"
                                            value="{{ old('professional_status', $user->professional_status) }}" required>
                                        @error('professional_status')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="5"
                                            required>{{ old('address', $user->address) }}</textarea>
                                        @error('address')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="state" class="form-label">State</label>
                                        <input type="text" id="state" name="state"
                                            class="form-control @error('state') is-invalid @enderror"
                                            value="{{ old('state', $user->state) }}" required>
                                        @error('state')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="nationality" class="form-label">Nationality</label>
                                        <select id="nationality" name="nationality"
                                            class="form-select @error('nationality') is-invalid @enderror" required>
                                            @foreach (config('setting.nationality') as $key => $nationality)
                                                <option value="{{ $nationality }}"
                                                    {{ $user->nationality == $nationality ? 'selected' : '' }}>
                                                    {{ $nationality }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('nationality')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="image" class="form-label">Profile Image</label>
                                        <input type="file" id="image" name="image"
                                            class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                        @if ($user->image)
                                            <small class="text-muted">Current image: <a href="{{ asset($user->image) }}"
                                                    target="_blank">View</a></small>
                                        @endif
                                        @error('image')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('user.profile.index', $user->uuid) }}"
                                        class="btn btn-light">Cancel</a>
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
