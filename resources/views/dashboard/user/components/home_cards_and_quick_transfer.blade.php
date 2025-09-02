<div class="row">
    <div class="col-md-6 col-xxl-12">
        <div class="card">
            <div class="card-body">
                @if ($cards->isEmpty())
                    <div class="card bg-primary rounded-4">
                        <div class="card-body">
                            <span class="float-end text-white-50 display-5 mt-n1"><i class="ti ti-wifi"></i></span>
                            <h4 class="text-white">{{ $user->first_name }} {{ $user->last_name }}</h4>

                            <div class="row align-items-center mt-4">
                                <div class="col-3 text-white fs-10">
                                    <i class="ti ti-circle-filled"></i>
                                    <i class="ti ti-circle-filled"></i>
                                    <i class="ti ti-circle-filled"></i>
                                    <i class="ti ti-circle-filled"></i>
                                </div>
                                <div class="col-3 text-white fs-10">
                                    <i class="ti ti-circle-filled"></i>
                                    <i class="ti ti-circle-filled"></i>
                                    <i class="ti ti-circle-filled"></i>
                                    <i class="ti ti-circle-filled"></i>
                                </div>
                                <div class="col-3 text-white fs-10">
                                    <i class="ti ti-circle-filled"></i>
                                    <i class="ti ti-circle-filled"></i>
                                    <i class="ti ti-circle-filled"></i>
                                    <i class="ti ti-circle-filled"></i>
                                </div>
                                <div class="col-3 text-white fs-13 fw-bold">
                                    <span>0</span>
                                    <span>0</span>
                                    <span>0</span>
                                    <span>0</span>
                                </div>
                            </div>

                            <div class="row mt-4 align-items-center">
                                <div class="col-4">
                                    <p class="text-white-50 mb-1">Expiry Date</p>
                                    <h5 class="text-white my-0">00/00</h5>
                                </div>

                                <div class="col-4">
                                    <p class="text-white-50 mb-1">CVV</p>
                                    <h5 class="text-white my-0">XXX</h5>
                                </div>
                                <div class="col-4">
                                    <div class="text-end">
                                        <img src="/dashboard/assets/images/cards/visa-white.svg" alt=""
                                            height="20" class="me-1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <h5 class="text-muted">Balance:</h5>
                            <h4 class="fs-18">{{ currency($user->currency) }}{{ formatAmount($user->balance) }} <small
                                    class="text-muted">{{ currency($user->currency, 'code') }}</small>
                            </h4>
                        </div>
                        <a href="{{ route('user.card.create') }}"
                            class="link-reset text-decoration-underline link-offset-2 fw-semibold pb-2">
                            Get a Card
                        </a>
                    </div>
                @else
                    <div id="carouselExampleIndicators" class="carousel slide carousel-dark" data-bs-ride="carousel">
                        <div class="carousel-indicators mb-n2">
                            @foreach ($cards as $index => $card)
                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"
                                    aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                    aria-label="Slide {{ $index + 1 }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach ($cards as $index => $card)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <div
                                        class="card bg-{{ $card->type->value === 'virtual' ? 'primary' : 'success' }} shadow-none rounded-4">
                                        <div class="card-body">
                                            <span class="float-end text-white-50 display-5 mt-n1"><i
                                                    class="ti ti-wifi"></i></span>
                                            <h4 class="text-white">{{ $card->user->first_name }}
                                                {{ $card->user->last_name }}</h4>

                                            <div class="row align-items-center mt-4">
                                                <div class="col-3 text-white fs-10">
                                                    <i class="ti ti-circle-filled"></i>
                                                    <i class="ti ti-circle-filled"></i>
                                                    <i class="ti ti-circle-filled"></i>
                                                    <i class="ti ti-circle-filled"></i>
                                                </div>
                                                <div class="col-3 text-white fs-10">
                                                    <i class="ti ti-circle-filled"></i>
                                                    <i class="ti ti-circle-filled"></i>
                                                    <i class="ti ti-circle-filled"></i>
                                                    <i class="ti ti-circle-filled"></i>
                                                </div>
                                                <div class="col-3 text-white fs-10">
                                                    <i class="ti ti-circle-filled"></i>
                                                    <i class="ti ti-circle-filled"></i>
                                                    <i class="ti ti-circle-filled"></i>
                                                    <i class="ti ti-circle-filled"></i>
                                                </div>
                                                <div class="col-3 text-white fs-13 fw-bold">
                                                    @php
                                                        $lastFour = substr($card->card_number, -4);
                                                    @endphp
                                                    <span>{{ $lastFour[0] }}</span>
                                                    <span>{{ $lastFour[1] }}</span>
                                                    <span>{{ $lastFour[2] }}</span>
                                                    <span>{{ $lastFour[3] }}</span>
                                                </div>
                                            </div>

                                            <div class="row mt-4 align-items-center">
                                                <div class="col-4">
                                                    <p class="text-white-50 mb-1">Expiry Date</p>
                                                    <h5 class="text-white my-0">{{ $card->expiry_date }}</h5>
                                                </div>
                                                <div class="col-4">
                                                    <p class="text-white-50 mb-1">CVV</p>
                                                    <h5 class="text-white my-0">
                                                        {{ $card->status->value === 'active' ? $card->cvv : 'XXX' }}</h5>
                                                </div>
                                                <div class="col-4">
                                                    <div class="text-end">
                                                        @if ($card->type->value === 'virtual')
                                                            <img src="/dashboard/assets/images/cards/visa-white.svg"
                                                                alt="Visa" height="20" class="me-1">
                                                        @else
                                                            <img src="/dashboard/assets/images/cards/discover-white.svg"
                                                                alt="Discover" height="15" class="me-1">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            <h5 class="text-muted">Balance:</h5>
                                            <h4 class="fs-18">
                                                {{ currency($card->user->currency) }}{{ formatAmount($card->user->balance, 2) }}
                                                <small
                                                    class="text-muted">{{ currency($card->user->currency, 'code') }}</small>
                                            </h4>
                                        </div>
                                        <a href="{{ route('user.card.show', $card->uuid) }}"
                                            class="link-reset text-decoration-underline link-offset-2 fw-semibold pb-2">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>

    <div class="col-md-6 col-xxl-12">
        <div class="card">
            <div class="card">
                <div class="card-header d-flex border-bottom border-dashed align-items-center">
                    <h4 class="header-title me-auto">
                        Quick Transfer
                    </h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.international_transfer.store') }}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="account_number">Account Number *</label>
                                <input type="text" id="account_number" name="account_number"
                                    value="{{ old('account_number') }}"
                                    class="form-control @error('account_number') is-invalid @enderror">
                                @error('account_number')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="account_name">Account Name *</label>
                                <input type="text" id="account_name" name="account_name"
                                    value="{{ old('account_name') }}"
                                    class="form-control @error('account_name') is-invalid @enderror">
                                @error('account_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="bank_name">Bank Name *</label>
                                <input type="text" id="bank_name" name="bank_name"
                                    value="{{ old('bank_name') }}"
                                    class="form-control @error('bank_name') is-invalid @enderror">
                                @error('bank_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="swift_code">SWIFT Code</label>
                                <input type="text" id="swift_code" name="swift_code"
                                    value="{{ old('swift_code') }}"
                                    class="form-control @error('swift_code') is-invalid @enderror">
                                @error('swift_code')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="iban_code">IBAN Code</label>
                                <input type="text" id="iban_code" name="iban_code"
                                    value="{{ old('iban_code') }}"
                                    class="form-control @error('iban_code') is-invalid @enderror">
                                @error('iban_code')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="routing_number">Routing Number</label>
                                <input type="text" id="routing_number" name="routing_number"
                                    value="{{ old('routing_number') }}"
                                    class="form-control @error('routing_number') is-invalid @enderror">
                                @error('routing_number')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="amount">Amount *</label>
                                <input type="number" id="amount" name="amount" value="{{ old('amount') }}"
                                    class="form-control @error('amount') is-invalid @enderror" min="1">
                                @error('amount')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="transfer_pin">Transaction PIN *</label>
                            <input type="password" id="transfer_pin" name="transfer_pin"
                                class="form-control @error('transfer_pin') is-invalid @enderror" maxlength="6"
                                autocomplete="off">
                            @error('transfer_pin')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Transfer</button>
                    </form>
                </div> <!-- end card-body-->
            </div>
        </div> <!-- end card-->
    </div>
</div>
