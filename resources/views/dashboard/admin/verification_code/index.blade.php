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
                    <div class="card-header">
                        <a class="btn btn-primary" href="{{ route('admin.verification.code.create') }}">Register Verification
                            Code</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Length</th>
                                        <th>Nature Of Code</th>
                                        <th>Applicable To</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($verificationCodes as $index => $verificationCode)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $verificationCode->name }}</td>
                                            <td>{{ $verificationCode->description }}</td>
                                            <td>{{ $verificationCode->length }}</td>
                                            <td>{{ ucfirst($verificationCode->nature_of_code) }}</td>
                                            <td>
                                                @if ($verificationCode->applicable_to == 'All')
                                                    {{ $verificationCode->applicable_to }} Users
                                                @else
                                                    {{ $verificationCode->user->first_name . ' ' . $verificationCode->user->last_name }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.verification.code.show', $verificationCode->uuid) }}"
                                                    class="btn btn-soft-warning btn-icon btn-sm rounded-circle m-2"> <i
                                                        class="ti ti-eye"></i></a>
                                                <a href="{{ route('admin.verification.code.edit', $verificationCode->uuid) }}"
                                                    class="btn btn-soft-primary btn-icon btn-sm rounded-circle m-2"> <i
                                                        class="ti ti-edit"></i></a>
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ route('admin.verification.code.delete', $verificationCode->uuid) }}"
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
