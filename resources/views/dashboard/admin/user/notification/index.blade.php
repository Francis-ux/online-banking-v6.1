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
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <a href="{{ route('admin.user.notification.send', $user->uuid) }}"
                                class="btn btn-primary btn-sm"> <i class="ti ti-send"></i> Send Notification</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Type</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notifications as $index => $notification)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                {{ $notification->type->label() }}
                                            </td>
                                            <td>{{ $notification->message }}
                                            </td>
                                            <td>
                                                @if ($notification->is_read)
                                                    <span class="badge bg-success-subtle text-success fs-12 p-1">Read</span>
                                                @else
                                                    <span
                                                        class="badge bg-warning-subtle text-warning fs-12 p-1">Unread</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.user.notification.show', [$user->uuid, $notification->uuid]) }}"
                                                    class="btn btn-soft-primary btn-icon btn-sm rounded-circle m-2"> <i
                                                        class="ti ti-eye"></i></a>
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ route('admin.user.notification.delete', [$user->uuid, $notification->uuid]) }}"
                                                    class="btn btn-soft-danger btn-icon btn-sm rounded-circle m-2"> <i
                                                        class="ti ti-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
@endsection
