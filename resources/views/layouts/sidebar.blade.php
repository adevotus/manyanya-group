<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <ul id="side-menu">
                @role('superadmin')
                    <li class="{{ Route::is('admin.home') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('admin.home') }}">
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
                    <li class="{{ Route::is('driver') ? 'menuitem-active' : '' }} ">
                        <a class="active" href="{{ route('driver') }}">
                            <i data-feather="user"></i>
                            <span>Drivers</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('staff') ? 'menuitem-active' : '' }} ">
                        <a class="active" href="{{ route('staff') }}">
                            <i data-feather="users"></i>
                            <span>Staff Members</span>
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

                    <li class="{{ Route::is('expense') ? 'menuitem-active' : '' }} ">
                        <a class="active" href="{{ route('expense') }}">
                            <i data-feather="sliders"></i>
                            <span>Expenses</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('quotes') ? 'menuitem-active' : '' }} ">
                        <a class="active" href="{{ route('quotes') }}">
                            <i data-feather="gift"></i>
                            <span>Quote</span>
                        </a>
                    </li>
                @endrole
                @role('manager')
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
                    <li class="{{ Route::is('driver') ? 'menuitem-active' : '' }} ">
                        <a class="active" href="{{ route('driver') }}">
                            <i data-feather="user"></i>
                            <span>Drivers</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('staff') ? 'menuitem-active' : '' }} ">
                        <a class="active" href="{{ route('staff') }}">
                            <i data-feather="users"></i>
                            <span>Staff Members</span>
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

                    <li class="{{ Route::is('expense') ? 'menuitem-active' : '' }} ">
                        <a class="active" href="{{ route('expense') }}">
                            <i data-feather="sliders"></i>
                            <span>Expenses</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('quotes') ? 'menuitem-active' : '' }} ">
                        <a class="active" href="{{ route('quotes') }}">
                            <i data-feather="gift"></i>
                            <span>Quote</span>
                        </a>
                    </li>
                @endrole
                @role('mechanics')
                    <li class="{{ Route::is('mechanics.home') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('mechanics.home') }}">
                            <i data-feather="airplay"></i>
                            <span> Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('vehicle') ? 'menuitem-active' : '' }} ">
                        <a class="active" href="{{ route('vehicle') }}">
                            <i data-feather="truck"></i>
                            <span>Vehicle</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('garages') ? 'menuitem-active' : '' }} ">
                        <a class="active" href="{{ route('garages') }}">
                            <i data-feather="tool"></i>
                            <span>Garage</span>
                        </a>
                    </li>

                    <li class="{{ Route::is('expense') ? 'menuitem-active' : '' }} ">
                        <a class="active" href="{{ route('expense') }}">
                            <i data-feather="sliders"></i>
                            <span>Expenses</span>
                        </a>
                    </li>
                @endrole
                @role('storekeeper')
                    <li class="{{ Route::is('store.home') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('store.home') }}">
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

                    <li class="{{ Route::is('driver') ? 'menuitem-active' : '' }} ">
                        <a class="active" href="{{ route('driver') }}">
                            <i data-feather="user"></i>
                            <span>Drivers</span>
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

                    <li class="{{ Route::is('expense') ? 'menuitem-active' : '' }} ">
                        <a class="active" href="{{ route('expense') }}">
                            <i data-feather="sliders"></i>
                            <span>Expenses</span>
                        </a>
                    </li>
                @endrole
                @role('muhasibu')
                    <li class="{{ Route::is('muhasibu.home') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('muhasibu.home') }}">
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

                    <li class="{{ Route::is('expense') ? 'menuitem-active' : '' }} ">
                        <a class="active" href="{{ route('expense') }}">
                            <i data-feather="sliders"></i>
                            <span>Expenses</span>
                        </a>
                    </li>

                    <li class="{{ Route::is('quotes') ? 'menuitem-active' : '' }} ">
                        <a class="active" href="{{ route('quotes') }}">
                            <i data-feather="gift"></i>
                            <span>Quote</span>
                        </a>
                    </li>
                @endrole

                @role('driver')
                    <li class="{{ Route::is('driver.home') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('driver.home') }}">
                            <i data-feather="airplay"></i>
                            <span> Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('driver.profile') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('driver.profile') }}">
                            <i data-feather="user"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('expense') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('expense') }}">
                            <i data-feather="archive"></i>
                            <span> Expenses</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('driver.ack') ? 'menuitem-active' : '' }} ">
                        <a class="active" href="{{ route('driver.ack') }}">
                            <i data-feather="check"></i>
                            <span>Acknowledgement</span>
                        </a>
                    </li>
                @endrole

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
