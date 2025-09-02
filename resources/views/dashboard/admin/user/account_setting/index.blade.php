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

                @include('partials.validation_message')

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.user.account.setting.update', $user->uuid) }}" method="post">
                            @csrf
                            <!-- Account State -->
                            <div class="mb-3">
                                <label for="example-select" class="form-label">Account State</label>
                                <select id="example-select" name="account_state" class="form-select">
                                    @foreach ($userAccountStates as $userAccountState)
                                        <option value="{{ $userAccountState->value }}"
                                            {{ $user->account_state->value == $userAccountState->value ? 'selected' : '' }}>
                                            {{ $userAccountState->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted d-block">Frozen account users cannot make
                                    transfers</small>
                                <small class="text-muted d-block">Disabled users cannot login</small>
                                <small class="text-muted d-block">KYC users will be unable to make
                                    withdrawals</small>
                            </div>

                            <!-- Message -->
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label for="account_state_reason" class="form-label">Message</label>
                                    <textarea id="account_state_reason" name="account_state_reason" class="form-control" placeholder="Enter message">{{ $user->account_state_reason }}</textarea>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Save</button>
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
