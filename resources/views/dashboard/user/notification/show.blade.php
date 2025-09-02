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
                        <dl class="row">
                            <dt class="col-sm-3">Message</dt>
                            <dd class="col-sm-9">{{ $notification->message }}</dd>

                            <dt class="col-sm-3">Type</dt>
                            <dd class="col-sm-9">
                                {{ $notification->type->label() }}
                            </dd>

                            <dt class="col-sm-3">Status</dt>
                            <dd class="col-sm-9">
                                @if ($notification->is_read)
                                    <span class="badge bg-success-subtle text-success fs-12 p-1">Read</span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning fs-12 p-1">Unread</span>
                                @endif
                            </dd>

                            <dt class="col-sm-3">Date</dt>
                            <dd class="col-sm-9">{{ $notification->created_at->format('jS M Y h:i A') }}</dd>
                        </dl>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('user.notification.index') }}" class="btn btn-primary">Back</a>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>

        </div>

    </div>
@endsection
