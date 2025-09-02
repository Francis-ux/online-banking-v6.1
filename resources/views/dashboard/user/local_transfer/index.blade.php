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
                        <form method="POST" action="{{ route('user.local_transfer.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="account_number">Recipient Account Number *</label>
                                <input type="number" id="account_number" name="account_number"
                                    class="form-control @error('account_number') is-invalid @enderror"
                                    value="{{ old('account_number') }}" maxlength="10" required>
                                @error('account_number')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="account_name">Recipient Account Name *</label>
                                <input type="text" id="account_name" name="account_name"
                                    class="form-control @error('account_name') is-invalid @enderror"
                                    value="{{ old('account_name') }}" readonly required>
                                @error('account_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">
                                    This field will be filled automatically if the account number is found.
                                </small>
                            </div>

                            <div class="mb-3">
                                <label for="amount">Amount *</label>
                                <input type="number" id="amount" name="amount"
                                    class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}"
                                    required>
                                @error('amount')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description">Description *</label>
                                <input type="text" id="description" name="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    value="{{ old('description') }}" maxlength="30">
                                @error('description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="transfer_pin">Transfer Pin *</label>
                                <input type="password" id="transfer_pin" name="transfer_pin"
                                    class="form-control @error('transfer_pin') is-invalid @enderror" required>
                                @error('transfer_pin')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Submit Transfer</button>
                        </form>

                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>

        </div>

    </div>

    <script>
        let accountNumber = document.querySelector('#account_number');

        accountNumber.addEventListener('input', function(e) {
            console.log(e.target.value);
            if (e.target.value.length == 10) {
                $.ajax({
                    url: "{{ route('user.local_transfer.get_account_number') }}",
                    method: 'GET',
                    data: {
                        accountNumber: e.target.value
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            Swal.fire({
                                icon: "success",
                                title: "",
                                text: "Account Found",
                            });
                            $('#account_name').val(data.account_name);
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "",
                                text: data.message,
                            });
                            $('#account_name').val('');
                        }
                    }
                });
            }
        });
    </script>
@endsection
