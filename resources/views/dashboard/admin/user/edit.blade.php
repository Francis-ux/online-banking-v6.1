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

            @include('partials.validation_message')

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.user.update', $user->uuid) }}"
                            enctype="multipart/form-data">
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
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email', $user->email) }}" required>
                                        @error('email')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" id="new_password" name="password"
                                            class="form-control @error('password') is-invalid @enderror">
                                        @error('password')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <input type="date" id="dob" name="dob"
                                            class="form-control @error('dob') is-invalid @enderror"
                                            value="{{ old('dob', $user->dob) }}" required>
                                        @error('dob')
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
                                        <label for="currency" class="form-label">Currency</label>
                                        <select id="currency" name="currency"
                                            class="form-select @error('currency') is-invalid @enderror" required>
                                            @foreach (config('setting.currency') as $key => $currency)
                                                <option
                                                    value="{{ $currency['name'] }}-{{ $currency['code'] }}-{{ $currency['symbol'] }}"
                                                    {{ $user->currency == $currency['name'] . '-' . $currency['code'] . '-' . $currency['symbol'] ? 'selected' : '' }}>
                                                    {{ $currency['name'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('currency')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="account_type" class="form-label">Account Type</label>
                                        <select id="account_type" name="account_type"
                                            class="form-select @error('account_type') is-invalid @enderror" required>
                                            <option value="savings"
                                                {{ old('account_type', $user->account_type) == 'savings' ? 'selected' : '' }}>
                                                Savings</option>
                                            <option value="current"
                                                {{ old('account_type', $user->account_type) == 'current' ? 'selected' : '' }}>
                                                Current</option>
                                            <option value="corporate"
                                                {{ old('account_type', $user->account_type) == 'corporate' ? 'selected' : '' }}>
                                                Corporate</option>
                                        </select>
                                        @error('account_type')
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

                                    <div class="mb-3">
                                        <label for="id_front" class="form-label">ID Front</label>
                                        <input type="file" id="id_front" name="id_front"
                                            class="form-control @error('id_front') is-invalid @enderror"
                                            accept="image/*,application/pdf">
                                        @if ($user->id_front)
                                            <small class="text-muted">Current file: <a
                                                    href="{{ asset($user->id_front) }}" target="_blank">View</a></small>
                                        @endif
                                        @error('id_front')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="id_back" class="form-label">ID Back</label>
                                        <input type="file" id="id_back" name="id_back"
                                            class="form-control @error('id_back') is-invalid @enderror"
                                            accept="image/*,application/pdf">
                                        @if ($user->id_back)
                                            <small class="text-muted">Current file: <a href="{{ asset($user->id_back) }}"
                                                    target="_blank">View</a></small>
                                        @endif
                                        @error('id_back')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->

                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="should_login_require_code" class="form-label">Require Login
                                            Code</label>
                                        <select id="should_login_require_code" name="should_login_require_code"
                                            class="form-select @error('should_login_require_code') is-invalid @enderror">
                                            <option value="1"
                                                {{ old('should_login_require_code', $user->should_login_require_code) ? 'selected' : '' }}>
                                                Yes</option>
                                            <option value="0"
                                                {{ old('should_login_require_code', $user->should_login_require_code) ? '' : 'selected' }}>
                                                No</option>
                                        </select>
                                        @error('should_login_require_code')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="should_transfer_fail" class="form-label">Restrict Transfers</label>
                                        <select id="should_transfer_fail" name="should_transfer_fail"
                                            class="form-select @error('should_transfer_fail') is-invalid @enderror">
                                            <option value="1"
                                                {{ old('should_transfer_fail', $user->should_transfer_fail) ? 'selected' : '' }}>
                                                Yes</option>
                                            <option value="0"
                                                {{ old('should_transfer_fail', $user->should_transfer_fail) ? '' : 'selected' }}>
                                                No</option>
                                        </select>
                                        @error('should_transfer_fail')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="transfer_pin" class="form-label">Transfer PIN</label>
                                        <input type="text" id="new_transfer_pin" name="transfer_pin"
                                            class="form-control @error('transfer_pin') is-invalid @enderror">
                                        @error('transfer_pin')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('admin.user.show', $user->uuid) }}"
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
