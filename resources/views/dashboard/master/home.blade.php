@extends('dashboard.master.layouts.master')
@section('content')
    <div class="page-container">

        <div class="page-title-head d-flex align-items-sm-center flex-sm-row flex-column gap-2">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold mb-0">{{ $title }}</h4>
            </div>

            <div class="text-end">
                @include('dashboard.master.layouts.components.breadcrumbs')

            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill fs-24 text-success me-2"></i>
                            <div class="flex-grow-1">
                                <h5 class="mb-0">Welcome {{ auth('master')->user()->name }}!</h5>
                                <p class="mb-0">This is the master admin dashboard, from here you can control all the
                                    activities of the system.</p>
                            </div>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
@endsection
