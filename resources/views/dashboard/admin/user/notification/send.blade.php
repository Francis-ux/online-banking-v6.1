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
                        <form method="POST" action="{{ route('admin.user.notification.send.store', $user->uuid) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="type" class="form-label">Notification Type</label>
                                <select name="type" id="type" class="form-select" required>
                                    <option value="">-- Choose Type --</option>
                                    @foreach ($notificationTypes as $notificationType)
                                        <option value="{{ $notificationType->value }}"
                                            {{ old('type') == $notificationType->value ? 'selected' : '' }}>
                                            {{ $notificationType->name }}</option>
                                    @endforeach

                                    {{-- <option value="deposit">Deposit</option>
                                    <option value="withdrawal">Withdrawal</option>
                                    <option value="transfer">Transfer</option>
                                    <option value="payment">Payment</option>
                                    <option value="account_update">Account Update</option> --}}
                                </select>
                                @error('type')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control" required
                                    value="{{ old('title') }}" placeholder="Enter title">
                                @error('title')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea name="message" id="message" class="form-control" rows="4" placeholder="Enter message" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Send</button>
                                <a href="{{ route('admin.user.notification.index', $user->uuid) }}"
                                    class="btn btn-secondary">Cancel</a>
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
