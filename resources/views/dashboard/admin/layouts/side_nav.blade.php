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
                <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                    <span class="menu-text"> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-title mt-2">Operations</li>

            <li class="side-nav-item">
                <a href="{{ route('admin.user.index') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-users"></i></span>
                    <span class="menu-text"> Users </span>
                </a>
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
                            <a href="{{ route('admin.setting.index') }}" class="side-nav-link">
                                <span class="menu-text">Setting</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.verification.code.index') }}" class="side-nav-link">
                                <span class="menu-text">Verification Codes</span>
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
