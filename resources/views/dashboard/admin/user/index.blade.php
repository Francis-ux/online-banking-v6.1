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
                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Account Number</th>
                                        <th>Balance</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $index => $user)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><a
                                                    href="{{ route('admin.user.show', $user->uuid) }}">{{ $user->first_name }}</a>
                                            </td>
                                            <td>{{ $user->last_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->dial_code }} {{ $user->phone }}</td>
                                            <td>{{ $user->account_number }}</td>
                                            <td>{{ currency($user->currency) }}{{ formatAmount($user->balance) }}</td>
                                            <td>
                                                {!! $user->account_state->badge() !!}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.user.show', $user->uuid) }}"
                                                    class="btn btn-soft-warning btn-icon btn-sm rounded-circle m-2"> <i
                                                        class="ti ti-eye"></i></a>
                                                <a href="{{ route('admin.user.edit', $user->uuid) }}"
                                                    class="btn btn-soft-primary btn-icon btn-sm rounded-circle m-2"> <i
                                                        class="ti ti-edit"></i></a>
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ route('admin.user.delete', $user->uuid) }}"
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
