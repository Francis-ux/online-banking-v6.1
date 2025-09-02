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
                <a href="{{ route('master.dashboard') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                    <span class="menu-text"> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-title mt-2">Operations</li>

            <li class="side-nav-item">
                <a href="{{ route('master.admin.index') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-users"></i></span>
                    <span class="menu-text"> Admins</span>
                </a>
            </li>
        </ul>
    </div>
</div>
