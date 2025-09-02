<div class="sidenav-menu">

    <!-- Brand Logo -->
    <a href="/" class="logo">
        <img src="{{ asset(env('APP_LOGO')) }}" width="200" alt="logo">
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <button class="button-sm-hover">
        <i class="ti ti-circle align-middle"></i>
    </button>

    <!-- Full Sidebar Menu Close Button -->
    <button class="button-close-fullsidebar">
        <i class="ti ti-x align-middle"></i>
    </button>

    <div data-simplebar>

        <!--- Sidenav Menu -->
        <ul class="side-nav">
            <li class="side-nav-title">Dashboard</li>

            <li class="side-nav-item">
                <a href="{{ route('user.dashboard') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                    <span class="menu-text"> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-title mt-2">Operations</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarAccounts" aria-expanded="false"
                    aria-controls="sidebarAccounts" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-user"></i></span>
                    <span class="menu-text"> Accounts</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarAccounts">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{ route('user.deposit.index') }}" class="side-nav-link">
                                <span class="menu-text">Deposit</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('user.transaction.index') }}" class="side-nav-link">
                                <span class="menu-text">Transactions</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('user.account_statement.index') }}" class="side-nav-link">
                                <span class="menu-text">Account Statement</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarTransfers" aria-expanded="false"
                    aria-controls="sidebarTransfers" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-transfer"></i></span>
                    <span class="menu-text"> Transfer</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarTransfers">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{ route('user.international_transfer.index') }}" class="side-nav-link">
                                <span class="menu-text">International Transfer</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('user.local_transfer.index') }}" class="side-nav-link">
                                <span class="menu-text">Local Transfer</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarApplications" aria-expanded="false"
                    aria-controls="sidebarApplications" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-apps"></i></span>
                    <span class="menu-text"> Applications</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarApplications">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{ route('user.loan.index') }}" class="side-nav-link">
                                <span class="menu-text">Loans</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('user.card.index') }}" class="side-nav-link">
                                <span class="menu-text">Cards</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarSettings" aria-expanded="false"
                    aria-controls="sidebarSettings" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-settings"></i></span>
                    <span class="menu-text"> Settings</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarSettings">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{ route('user.profile.index') }}" class="side-nav-link">
                                <span class="menu-text">Profile</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('user.notification.index') }}" class="side-nav-link">
                                <span class="menu-text">Notifications</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('user.transfer_pin.index') }}" class="side-nav-link">
                                <span class="menu-text">Set Transfer PIN</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('user.identity_verification.index') }}" class="side-nav-link">
                                <span class="menu-text">ID Verification</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('logout') }}" class="side-nav-link">
                                <span class="menu-text">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
