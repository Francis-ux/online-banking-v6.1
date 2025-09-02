<div class="col-12">
    <div class="d-flex justify-content-end mb-2">
        <div class="dropdown">
            <button class="btn btn-primary btn-sm dropdown-toggle " type="button" id="dropdownMenuButton"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                MENU
            </button>
            <div class="dropdown-menu " aria-labelledby="dropdownMenuButton"
                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);"
                data-popper-placement="bottom-start">
                <a class="dropdown-item" href="{{ route('user.dashboard') }}">Dashboard</a>
                <a class="dropdown-item" href="{{ route('user.profile.index') }}">Profile</a>
                <a class="dropdown-item" href="{{ route('user.transfer_pin.index') }}">Set Transfer PIN</a>
                <a class="dropdown-item" href="{{ route('user.identity_verification.index') }}">ID Verification</a>
                <a class="dropdown-item" href="{{ route('user.transaction.index') }}">Transactions</a>
                <a class="dropdown-item" href="{{ route('user.loan.index') }}">Loan Application</a>
                <a class="dropdown-item" href="{{ route('user.card.index') }}">Card Application</a>
                <a class="dropdown-item" href="{{ route('user.international_transfer.index') }}">International
                    Transfer</a>
                <a class="dropdown-item" href="{{ route('user.local_transfer.index') }}">Local
                    Transfer</a>
                <a class="dropdown-item" href="{{ route('user.deposit.index') }}">Deposit</a>
                <a class="dropdown-item" href="{{ route('user.notification.index') }}">Notifications</a>
            </div>
        </div>
    </div>
</div>
