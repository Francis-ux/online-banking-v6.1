@extends('auth.layouts.master')
@section('content')
    <div class="auth-bg d-flex min-vh-100 justify-content-center align-items-center">
        <div class="row g-0 justify-content-center w-100 m-xxl-5 px-xxl-4 m-3">
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div class="card overflow-hidden text-center h-100 p-xxl-4 p-3 mb-0">
                    @include('auth.layouts.header')

                    <h3 class="fw-semibold mb-2">Welcome to {{ env('APP_NAME') }}</h3>

                    <p class="text-muted mb-4">Complete the form below to open your account and start banking with us.</p>

                    <form action="{{ route('register') }}" method="POST" class="text-start mb-3">
                        @csrf
                        <div class="row">
                            <!-- First Name -->
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}"
                                    class="form-control @error('first_name') is-invalid @enderror"
                                    placeholder="Enter your first name" required>
                                @error('first_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Last Name -->
                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}"
                                    class="form-control @error('last_name') is-invalid @enderror"
                                    placeholder="Enter your last name" required>
                                @error('last_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email"
                                    required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Registration Token -->
                            <div class="col-md-6 mb-3">
                                <label for="registration_token" class="form-label">Registration Token</label>
                                <input type="text" id="registration_token" name="registration_token"
                                    value="{{ old('registration_token') }}"
                                    class="form-control @error('registration_token') is-invalid @enderror"
                                    placeholder="Enter your registration token" required>
                                @error('registration_token')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Date of Birth -->
                            <div class="col-md-6 mb-3">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" id="dob" name="dob" value="{{ old('dob') }}"
                                    class="form-control @error('dob') is-invalid @enderror" required>
                                @error('dob')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Gender -->
                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select id="gender" name="gender"
                                    class="form-select @error('gender') is-invalid @enderror" required>
                                    <option value="">Select</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                                    </option>
                                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other
                                    </option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Marital Status -->
                            <div class="col-md-6 mb-3">
                                <label for="marital_status" class="form-label">Marital Status</label>
                                <select id="marital_status" name="marital_status"
                                    class="form-select @error('marital_status') is-invalid @enderror" required>
                                    <option value="">Select</option>
                                    <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>
                                        Single</option>
                                    <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>
                                        Married</option>
                                    <option value="separated" {{ old('marital_status') == 'separated' ? 'selected' : '' }}>
                                        Separated</option>
                                    <option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>
                                        Divorced</option>
                                    <option value="widowed" {{ old('marital_status') == 'widowed' ? 'selected' : '' }}>
                                        Widowed</option>
                                </select>
                                @error('marital_status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Dial Code -->
                            <div class="col-md-6 mb-3">
                                <label for="dial_code" class="form-label">Dial Code</label>
                                <select id="dial_code" name="dial_code"
                                    class="form-select @error('dial_code') is-invalid @enderror" required>
                                    <option value="">Select</option>
                                    @foreach (config('setting.dial_code') as $key => $dialCode)
                                        <option value="+{{ $key }}"
                                            {{ old('dial_code') == '+' . $key ? 'selected' : '' }}>
                                            {{ $dialCode }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('dial_code')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="Enter your phone number" required>
                                @error('phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Professional Status -->
                            <div class="col-md-6 mb-3">
                                <label for="professional_status" class="form-label">Professional Status</label>
                                <input type="text" id="professional_status" name="professional_status"
                                    value="{{ old('professional_status') }}"
                                    class="form-control @error('professional_status') is-invalid @enderror"
                                    placeholder="Enter your professional status">
                                @error('professional_status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="col-md-6 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" id="address" name="address" value="{{ old('address') }}"
                                    class="form-control @error('address') is-invalid @enderror"
                                    placeholder="Enter your address" required>
                                @error('address')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- State -->
                            <div class="col-md-6 mb-3">
                                <label for="state" class="form-label">State</label>
                                <input type="text" id="state" name="state" value="{{ old('state') }}"
                                    class="form-control @error('state') is-invalid @enderror"
                                    placeholder="Enter your state" required>
                                @error('state')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Nationality -->
                            <div class="col-md-6 mb-3">
                                <label for="nationality" class="form-label">Nationality</label>
                                <select id="nationality" name="nationality"
                                    class="form-select @error('nationality') is-invalid @enderror" required>
                                    <option value="">Select</option>
                                    @foreach (config('setting.nationality') as $key => $nationality)
                                        <option value="{{ $nationality }}"
                                            {{ old('nationality') == $nationality ? 'selected' : '' }}>
                                            {{ $nationality }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('nationality')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Currency -->
                            <div class="col-md-6 mb-3">
                                <label for="currency" class="form-label">Currency</label>
                                <select id="currency" name="currency"
                                    class="form-select @error('currency') is-invalid @enderror" required>
                                    <option value="">Select</option>
                                    @foreach (config('setting.currency') as $key => $currency)
                                        <option
                                            value="{{ $currency['name'] }}-{{ $currency['code'] }}-{{ $currency['symbol'] }}"
                                            {{ old('currency') == $currency['name'] . '-' . $currency['code'] . '-' . $currency['symbol'] ? 'selected' : '' }}>
                                            {{ $currency['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('currency')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Account Type -->
                            <div class="col-md-6 mb-3">
                                <label for="account_type" class="form-label">Account Type</label>
                                <select id="account_type" name="account_type"
                                    class="form-select @error('account_type') is-invalid @enderror" required>
                                    <option value="">Select</option>
                                    <option value="savings" {{ old('account_type') == 'savings' ? 'selected' : '' }}>
                                        Savings</option>
                                    <option value="current" {{ old('account_type') == 'current' ? 'selected' : '' }}>
                                        Current</option>
                                    <option value="corporate" {{ old('account_type') == 'corporate' ? 'selected' : '' }}>
                                        Corporate</option>
                                </select>
                                @error('account_type')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter your password" required>
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Confirm your password" required>
                                @error('password_confirmation')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit">Sign Up</button>
                        </div>
                    </form>

                    <p class="text-danger fs-14 mb-4">Already have an account? <a href="{{ route('login') }}"
                            class="fw-semibold text-dark ms-1">Login !</a></p>

                    @include('auth.layouts.footer')
                </div>
            </div>
        </div>
    </div>
@endsection
