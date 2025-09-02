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
                        @foreach ($transferCodes as $transferCode)
                            @if ($transferCode->reference_id == $referenceId && $transferCode->order_no == request()->segment(6))
                                <div class="col-sm-12 col-md-12">
                                    <h4>Transfer in progress.....</h4>
                                    <div class="d-flex justify-content-center">
                                        <div class="progress" role="progressbar" aria-label="Success example"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
                                            style="height: 20px; width: 100%;">
                                            <div class="progress-bar bg-success" id="myProgressBar">
                                            </div>
                                        </div>

                                    </div>
                                    <div id="code_area" class="d-none text-center">
                                        <form
                                            action="{{ route('user.international_transfer.verify_code', [$transfer->reference_id, $orderNo]) }}"
                                            class="code_form" method="POST">
                                            @csrf
                                            <div id="message-area">
                                                <h5 class="text-center mt-2 mb-2">Transfer State:
                                                    {{ env('APP_NAME') }}
                                                    {{ $transferCode->name }} CODE</h5>
                                                <h4 class="text-center mt-2 mb-2">Kindly insert your
                                                    {{ $transferCode->name }} Code to facilitate the
                                                    transfer
                                                    of
                                                    your
                                                    funds to <span
                                                        class="text-uppercase text-success">{{ $transfer->account_name }}</span>
                                                    or contact {{ env('APP_EMAIL') }}</h4>
                                            </div>

                                            <div class="form-group mt-2 col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                                                <input type="hidden" name="verification_code_id"
                                                    value="{{ $transferCode->verification_code_id }}">
                                                <input type="hidden" name="code_name" value="{{ $transferCode->name }}">

                                                <div class="mb-3">
                                                    <label for="{{ $transferCode->name }}"
                                                        class="d-none">{{ $transferCode->name }}({{ $transferCode->description }})</label>

                                                    <input type="text" id="{{ $transferCode->name }}" name="code"
                                                        placeholder="Enter {{ ucwords($transferCode->name) }} Code"
                                                        class="form-control @error('code') is-invalid @enderror">
                                                    @error('code')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-success" type="submit">VALIDATE</button>
                                            </div>

                                        </form>

                                    </div>
                                    <h6 class="mt-4 mb-4">Reference ID:
                                        <code>{{ $transferCode->reference_id }}</code>
                                    </h6>
                                </div>
                            @endif
                        @endforeach
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>

        </div>

    </div>
    <script>
        let transferCodeCount = {{ count($transferCodes) }};
        let transferSegment = {{ (int) request()->segment(6) }};
        console.log(transferSegment)
        var i = 0;

        function move(width, widthLimit) {
            if (i == 0) {
                i = 1;
                var elem = document.getElementById("myProgressBar");
                elem.style.width = width + "%";
                elem.innerText = width + "%";

                var id = setInterval(frame, 500);

                function frame() {
                    if (width >= widthLimit) {
                        clearInterval(id);
                        i = 0;
                        $("#code_area").removeClass('d-none')
                    } else {
                        width++;
                        elem.style.width = width + "%";
                        elem.innerHTML = width + "%";
                    }
                }
            }
        }
        if (transferCodeCount == 1) {
            if (transferSegment == 1) {
                move(1, 99);
            }
        }
        if (transferCodeCount == 2) {
            if (transferSegment == 1) {
                move(1, 40);
            }

            if (transferSegment == 2) {
                move(40, 75);
            }
        }
        if (transferCodeCount == 3) {
            if (transferSegment == 1) {
                move(1, 50);
            }

            if (transferSegment == 2) {
                move(50, 75);
            }
            if (transferSegment == 3) {
                move(75, 99);
            }
        }
        if (transferCodeCount == 4) {
            if (transferSegment == 1) {
                move(1, 25);
            }

            if (transferSegment == 2) {
                move(25, 50);
            }
            if (transferSegment == 3) {
                move(50, 75);
            }
            if (transferSegment == 4) {
                move(75, 99);
            }
        }
        if (transferCodeCount == 5) {
            if (transferSegment == 1) {
                move(1, 25);
            }

            if (transferSegment == 2) {
                move(25, 50);
            }
            if (transferSegment == 3) {
                move(50, 75);
            }
            if (transferSegment == 4) {
                move(75, 85);
            }
            if (transferSegment == 5) {
                move(85, 99);
            }
        }
        if (transferCodeCount == 6) {
            if (transferSegment == 1) {
                move(1, 25);
            }

            if (transferSegment == 2) {
                move(25, 45);
            }
            if (transferSegment == 3) {
                move(45, 65);
            }
            if (transferSegment == 4) {
                move(65, 75);
            }
            if (transferSegment == 5) {
                move(75, 85);
            }
            if (transferSegment == 6) {
                move(85, 99);
            }
        }

        setTimeout(() => {
            $("#myProgressBar").css('opacity', '1');
            move();
        }, 3000);
    </script>
@endsection
