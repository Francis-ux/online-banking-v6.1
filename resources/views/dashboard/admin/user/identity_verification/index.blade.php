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
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Front:</strong></p>
                                <img src="{{ asset($user->id_front) }}" class="img-fluid rounded border">
                            </div>
                            <div class="col-md-6">
                                <p><strong>Back:</strong></p>
                                <img src="{{ asset($user->id_back) }}" class="img-fluid rounded border">
                            </div>
                        </div>

                        <p class="mt-2">
                            <strong>Status:</strong>
                            @if ($user->is_ID_verified === 1)
                                <span class="badge bg-success">Approved</span>
                            @elseif($user->is_ID_verified === 2)
                                <span class="badge bg-danger">Rejected</span>
                            @elseif($user->is_ID_verified === 3)
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-dark">Unknown</span>
                            @endif
                        </p>

                        <form method="POST" action="{{ route('admin.user.identity.verification.store', $user->uuid) }}"
                            class="mt-3">
                            @csrf
                            <div class="btn-group">
                                <button name="status" value="1" class="btn btn-success">Approve</button>
                                <button name="status" value="2" class="btn btn-danger">Reject</button>
                                <button name="status" value="3" class="btn btn-warning">Mark Pending</button>
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
