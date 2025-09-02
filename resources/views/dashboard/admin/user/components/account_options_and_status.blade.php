<div class="col-12">
    <div class="d-flex gap-2 justify-content-end mb-2">
        <div class="dropdown">
            <button class="btn btn-danger btn-sm dropdown-toggle " type="button" id="dropdownMenuButton"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                ACCOUNT OPTIONS
            </button>
            <div class="dropdown-menu " aria-labelledby="dropdownMenuButton"
                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);"
                data-popper-placement="bottom-start">
                <a class="dropdown-item" href="{{ route('admin.user.show', $user->uuid) }}">View Profile</a>
                <a class="dropdown-item" href="{{ route('admin.user.transaction.index', $user->uuid) }}">Fund
                    Account</a>
                <a class="dropdown-item" href="{{ route('admin.user.withdrawal.index', $user->uuid) }}">View
                    Withdrawals</a>
                <a class="dropdown-item" href="{{ route('admin.user.deposit.index', $user->uuid) }}">Deposits</a>
                <a class="dropdown-item" href="{{ route('admin.user.loan.index', $user->uuid) }}">Loan Application</a>
                <a class="dropdown-item" href="{{ route('admin.user.card.index', $user->uuid) }}">Card Application</a>
                <a class="dropdown-item" href="{{ route('admin.user.notification.index', $user->uuid) }}">View
                    Notifications</a>
            </div>
        </div>

        <div class="dropdown">
            <button class="btn btn-primary btn-sm dropdown-toggle " type="button" id="dropdownMenuButton"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                STATUS
            </button>
            <div class="dropdown-menu " aria-labelledby="dropdownMenuButton"
                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);"
                data-popper-placement="bottom-start">
                @if ($user->is_account_verified == 0)
                    <a class="dropdown-item" href="{{ route('admin.user.verification.skip', $user->uuid) }}">Skip
                        Verification</a>
                @else
                    <a class="dropdown-item" href="{{ route('admin.user.verification.set', $user->uuid) }}">Set
                        Verification</a>
                @endif
                <a class="dropdown-item" href="{{ route('admin.user.identity.verification.index', $user->uuid) }}">ID
                    Verification</a>
                <a class="dropdown-item" href="{{ route('admin.user.account.setting.index', $user->uuid) }}">Account
                    Setting</a>
                <a class="dropdown-item" href="{{ route('admin.user.delete', $user->uuid) }}">Delete Account</a>
            </div>
        </div>
    </div>
</div>
