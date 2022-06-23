<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="{{ Route::is('manager.home') ? 'menuitem-active' : '' }}">
                    <a href="{{ route('manager.home') }}">
                        <i data-feather="airplay"></i>
                        <span> Dashboard</span>
                    </a>
                </li>
                <li class="{{ Route::is('routes') ? 'menuitem-active' : '' }} ">
                    <a class="active" href="{{ route('routes') }}">
                        <i data-feather="corner-up-right"></i>
                        <span>Routes</span>
                    </a>
                </li>
                <li class="{{ Route::is('vehicle') ? 'menuitem-active' : '' }} ">
                    <a class="active" href="{{ route('vehicle') }}">
                        <i data-feather="truck"></i>
                        <span>Vehicle</span>
                    </a>
                </li>
                <li class="{{ Route::is('manager.driver') ? 'menuitem-active' : '' }} ">
                    <a class="active" href="{{ route('manager.driver') }}">
                        <i data-feather="user"></i>
                        <span>Driver</span>
                    </a>
                </li>

                <li class="{{ Route::is('cargos') ? 'menuitem-active' : '' }} ">
                    <a class="active" href="{{ route('cargos') }}">
                        <i data-feather="globe"></i>
                        <span>Cargos</span>
                    </a>
                </li>

                <li class="{{ Route::is('garages') ? 'menuitem-active' : '' }} ">
                    <a class="active" href="{{ route('garages') }}">
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
