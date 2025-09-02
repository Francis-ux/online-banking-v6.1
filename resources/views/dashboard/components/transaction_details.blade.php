<dl class="row">
    <dt class="col-sm-3">Reference ID</dt>
    <dd class="col-sm-9">{{ $transaction->reference_id }}</dd>

    <dt class="col-sm-3">Transaction Type</dt>
    <dd class="col-sm-9">
        {{ $transaction->type->label() }}
    </dd>

    <dt class="col-sm-3">Transaction Direction</dt>
    <dd class="col-sm-9">
        {!! $transaction->direction->badge() !!}
    </dd>

    <dt class="col-sm-3">Amount {{ $transaction->direction->label() }}ed</dt>
    <dd class="col-sm-9">
        {{ currency($transaction->user->currency) }}{{ formatAmount($transaction->amount) }}</dd>

    @if ($transaction->transfer)
        <dt class="col-sm-3">{{ $transaction->direction->label() }}ed Account</dt>
        <dd class="col-sm-9">
            {{ $transaction->transfer->account_number }}
        </dd>

        <dt class="col-sm-3">Beneficiary Name</dt>
        <dd class="col-sm-9">
            {{ $transaction->transfer->account_name }}
        </dd>

        <dt class="col-sm-3">Beneficiary Bank</dt>
        <dd class="col-sm-9">
            {{ $transaction->transfer->bank_name }}
        </dd>

        @if ($transaction->transfer->swift_code)
            <dt class="col-sm-3">Beneficiary SWIFT Code</dt>
            <dd class="col-sm-9">
                {{ $transaction->transfer->swift_code }}
            </dd>
        @endif

        @if ($transaction->transfer->iban_code)
            <dt class="col-sm-3">Beneficiary IBAN Code</dt>
            <dd class="col-sm-9">
                {{ $transaction->transfer->iban_code }}
            </dd>
        @endif

        @if ($transaction->transfer->routing_number)
            <dt class="col-sm-3">Beneficiary Routing Number</dt>
            <dd class="col-sm-9">
                {{ $transaction->transfer->routing_number }}
            </dd>
        @endif

        <dt class="col-sm-3">Transfer Type</dt>
        <dd class="col-sm-9">
            {{ $transaction->transfer->type->label() }}
        </dd>

        <dt class="col-sm-3">Sender</dt>
        <dd class="col-sm-9">
            {{ $transaction->transfer->user->first_name }}
            {{ $transaction->transfer->user->last_name }}
        </dd>
    @else
        <dt class="col-sm-3">{{ $transaction->direction->label() }}ed Account</dt>
        <dd class="col-sm-9">
            {{ $transaction->user->account_number }}
        </dd>

        <dt class="col-sm-3">Beneficiary Name</dt>
        <dd class="col-sm-9">
            {{ $transaction->user->first_name }} {{ $user->last_name }}
        </dd>
    @endif

    <dt class="col-sm-3">Description</dt>
    <dd class="col-sm-9">{{ $transaction->description ?? 'N/A' }}</dd>

    <dt class="col-sm-3">Status</dt>
    <dd class="col-sm-9">
        {!! $transaction->status->badge() !!}
    </dd>

    <dt class="col-sm-3">Balance After</dt>
    <dd class="col-sm-9">
        {{ currency($transaction->user->currency) }}{{ formatAmount($transaction->current_balance) }}
    </dd>

    <dt class="col-sm-3">Transaction Date</dt>
    <dd class="col-sm-9">{{ date('jS M Y h:i A', strtotime($transaction->transaction_at)) }}</dd>
</dl>
