<li class="dropdown d-none d-xl-block">
    <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button"
        aria-haspopup="false" aria-expanded="false">
        Create New
        <i class="mdi mdi-chevron-down"></i>
    </a>
    <div class="dropdown-menu">

        <!-- item-->
        <a href="@role('superadmin') {{ route('admin.driver') }} @endrole @role('manager') {{ route('manager.driver') }} @endrole @role('storekeeper') {{ route('store.driver') }} @endrole"
            class="dropdown-item">
            <i class="fe-user me-1"></i>
            <span>Register Driver</span>
        </a>

        @role('superadmin')
            <a href="{{ route('admin.staff') }}" class="dropdown-item">
                <i class="fe-users me-1"></i>
                <span>Register staff</span>
            </a>
        @endrole


        <!-- item-->
        <a href="@role('superadmin') {{ route('admin.routes') }} @endrole @role('manager') {{ route('manager.routes') }} @endrole @role('storekeeper') {{ route('store.routes') }} @endrole"
            class="dropdown-item">
            <i class="fe-repeat me-1"></i>
            <span>New Route</span>
        </a>

        <!-- item-->
        <a href="@role('superadmin') {{ route('admin.vehicle') }} @endrole @role('manager') {{ route('manager.vehicle') }} @endrole @role('storekeeper') {{ route('store.vehicle') }} @endrole"
            class="dropdown-item">
            <i class="fe-truck me-1"></i>
            <span>New Vehicle</span>
        </a>

        <!-- item-->
        <a href="@role('superadmin') {{ route('admin.cargos') }} @endrole @role('manager') {{ route('manager.cargos') }} @endrole @role('storekeeper') {{ route('store.cargos') }} @endrole"
            class="dropdown-item">
            <i class="fe-layers me-1"></i>
            <span>New Cargo</span>
        </a>

        <!-- item-->
        <a href="@role('superadmin') {{ route('admin.garages') }} @endrole @role('manager') {{ route('manager.garages') }} @endrole @role('storekeeper') {{ route('store.garages') }} @endrole"
            class="dropdown-item">
            <i class="fe-shuffle me-1"></i>
            <span>New Cargo</span>
        </a>



    </div>
</li>
