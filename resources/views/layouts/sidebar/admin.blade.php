<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="{{ Route::is('admin.home') ? 'menuitem-active' : '' }}">
                    <a href="{{ route('admin.home') }}">
                        <i data-feather="airplay"></i>
                        <span> Dashboard</span>
                    </a>
                </li>
                <li class="{{ Route::is('admin.routes') ? 'menuitem-active' : '' }} ">
                    <a class="active" href="{{ route('admin.routes') }}">
                        <i data-feather="corner-up-right"></i>
                        <span>Routes</span>
                    </a>
                </li>
                <li class="{{ Route::is('admin.vehicle') ? 'menuitem-active' : '' }} ">
                    <a class="active" href="{{ route('admin.vehicle') }}">
                        <i data-feather="truck"></i>
                        <span>Vehicle</span>
                    </a>
                </li>
                <li class="{{ Route::is('admin.driver') ? 'menuitem-active' : '' }} ">
                    <a class="active" href="{{ route('admin.driver') }}">
                        <i data-feather="user"></i>
                        <span>Drivers</span>
                    </a>
                </li>
                <li class="{{ Route::is('admin.staff') ? 'menuitem-active' : '' }} ">
                    <a class="active" href="{{ route('admin.staff') }}">
                        <i data-feather="users"></i>
                        <span>Staff Members</span>
                    </a>
                </li>



                <li class="{{ Route::is('admin.cargos') ? 'menuitem-active' : '' }} ">
                    <a class="active" href="{{ route('admin.cargos') }}">
                        <i data-feather="globe"></i>
                        <span>Cargos</span>
                    </a>
                </li>

                <li class="{{ Route::is('admin.garages') ? 'menuitem-active' : '' }} ">
                    <a class="active" href="{{ route('admin.garages') }}">
                        <i data-feather="tool"></i>
                        <span>Garage</span>
                    </a>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
