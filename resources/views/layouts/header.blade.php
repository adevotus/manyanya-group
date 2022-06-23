<!-- Topbar Start -->
<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-end mb-0">
            <li class="dropdown notification-list topbar-dropdown">

                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    @if (is_null(Auth::user()->profile))
                        <img src="{{ Auth::user()->default_url }}" alt="user-image" class="rounded-circle">
                    @else
                        <img src="/storage/profile/{{ Auth::user()->profile }}" alt="user-image"
                            class="rounded-circle">
                    @endif
                    <span class="pro-user-name ms-1">
                        {{ Auth::user()->name }}
                        <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>

                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                    <a href="{{ route('settings') }}" class="dropdown-item notify-item">
                        <i class="fe-settings"></i>
                        <span>Settings</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a class="dropdown-item notify-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                             this.closest('form').submit();">
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </a>
                    </form>

                </div>
            </li>


        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="index.html" class="logo logo-dark text-center">
                <span class="logo-sm">
                    <!-- <img src="../assets/images/logo-sm.png" alt="" height="22"> -->
                    <span class="logo-lg-text-light">Transport</span>
                </span>
                <span class="logo-lg">
                    <!-- <img src="../assets/images/logo-dark.png" alt="" height="20"> -->
                    <span class="logo-lg-text-light">T</span>
                </span>
            </a>

            <!-- <a href="index.html" class="logo logo-light text-center">
                        <span class="logo-sm">
                            <img src="../assets/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="../assets/images/logo-light.png" alt="" height="20">
                        </span>
                    </a> -->
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>

            @role('superadmin')
                @include('layouts.dropdown')
            @endrole
            @role('manager')
                @include('layouts.dropdown')
            @endrole
            @role('storekeeper')
                {{-- @include('layouts.dropdown') --}}
            @endrole

        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!-- end Topbar -->
