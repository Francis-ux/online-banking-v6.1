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
                        <dl class="row">
                            <dt class="col-sm-3">Name</dt>
                            <dd class="col-sm-9">{{ $verificationCode->name }}</dd>

                            <dt class="col-sm-3">Description</dt>
                            <dd class="col-sm-9">
                                {{ $verificationCode->description }}
                            </dd>

                            <dt class="col-sm-3">Length</dt>
                            <dd class="col-sm-9">
                                {{ $verificationCode->length }}
                            </dd>

                            <dt class="col-sm-3">Nature Of Code</dt>
                            <dd class="col-sm-9">{{ ucfirst($verificationCode->nature_of_code) }}</dd>

                            <dt class="col-sm-3">Applicable To</dt>
                            <dd class="col-sm-9">
                                @if ($verificationCode->applicable_to == 'All')
                                    {{ $verificationCode->applicable_to }} Users
                                @else
                                    {{ $verificationCode->user->first_name . ' ' . $verificationCode->user->last_name }}
                                @endif
                            </dd>
                        </dl>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.verification.code.index') }}" class="btn btn-primary">Back</a>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
@endsection
