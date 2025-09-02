@extends('auth.layouts.master')
@section('content')
    <div class="auth-bg d-flex min-vh-100 justify-content-center align-items-center">
        <div class="row g-0 justify-content-center w-100 m-xxl-5 px-xxl-4 m-3">
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div class="card overflow-hidden text-center h-100 p-xxl-4 p-3 mb-0">
                    @include('auth.layouts.header')

                    <h3 class="fw-semibold mb-2">Login With Code</h3>

                    <p class="text-muted mb-4">We sent you a code , please enter it below to verify your email <span
                            class="text-primary fw-medium">{{ $user->email }}</span></p>

                    @include('partials.validation_message')

                    <form action="{{ route('login.verification.store', ['uuid' => $user->uuid]) }}" class="text-start mb-3"
                        method="POST">
                        @csrf
                        <label class="form-label" for="code">Enter 6 Digit Code</label>
                        <div class="d-flex gap-2 mt-1 mb-3">
                            @for ($i = 0; $i < 6; $i++)
                                <input type="text" name="code[]" maxlength="1"
                                    class="form-control text-center @error('code') is-invalid @enderror" required
                                    value="{{ old('code.' . $i) }}">
                            @endfor
                        </div>

                        @error('code')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mb-3 d-grid">
                            <button class="btn btn-primary" type="submit">Continue</button>
                        </div>
                        <p class="mb-0 text-center">Don't received code yet? <a
                                href="{{ route('login.verification.resend', ['uuid' => $user->uuid]) }}"
                                class="link-primary fw-semibold text-decoration-underline">Send Again</a></p>
                    </form>

                    <p class="text-danger fs-14 mb-4">Back To <a href="/" class="fw-semibold text-dark ms-1">Home
                            !</a></p>

                    @include('auth.layouts.footer')
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('input[name="code[]"]').forEach((input, index, inputs) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });
            input.addEventListener('keydown', (e) => {
                if (e.key === "Backspace" && index > 0 && !input.value) {
                    inputs[index - 1].focus();
                }
            });
        });
    </script>
@endsection
