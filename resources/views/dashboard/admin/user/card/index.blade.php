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
                        <h4 class="card-title mb-0">
                            <a href="{{ route('user.card.create') }}" class="btn btn-primary btn-sm">Apply for Card</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Reference ID</th>
                                        <th>Card</th>
                                        <th>Number</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cards as $index => $card)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                #{{ $card->reference_id }}
                                            </td>
                                            <td>
                                                {{ $card->type->label() }}
                                            </td>
                                            <td>
                                                **** **** **** {{ substr($card->card_number, -4) }}
                                            </td>
                                            <td>
                                                <span class="{{ $card->status->badge() }}">
                                                    {{ $card->status->label() }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.user.card.show', [$user->uuid, $card->uuid]) }}"
                                                    title="View Card"
                                                    class="btn btn-soft-primary btn-sm btn-icon rounded-circle"><i
                                                        class="ti ti-eye"></i></a>
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
