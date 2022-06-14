 <div class="left-side-menu">
     <div class="h-100" data-simplebar>
         <div id="sidebar-menu">
             <ul id="side-menu">
                 <li class="{{ Route::is('store.home') ? 'menuitem-active' : '' }}">
                     <a href="{{ route('store.home') }}">
                         <i data-feather="airplay"></i>
                         <span> Dashboard</span>
                     </a>
                 </li>
                 <li class="{{ Route::is('store.routes') ? 'menuitem-active' : '' }} ">
                     <a class="active" href="{{ route('store.routes') }}">
                         <i data-feather="corner-up-right"></i>
                         <span>Routes</span>
                     </a>
                 </li>
                 <li class="{{ Route::is('store.vehicle') ? 'menuitem-active' : '' }} ">
                     <a class="active" href="{{ route('store.vehicle') }}">
                         <i data-feather="truck"></i>
                         <span>Vehicle</span>
                     </a>
                 </li>
                 <li class="{{ Route::is('store.driver') ? 'menuitem-active' : '' }} ">
                     <a class="active" href="{{ route('store.driver') }}">
                         <i data-feather="user"></i>
                         <span>Driver</span>
                     </a>
                 </li>

                 <li class="{{ Route::is('store.cargos') ? 'menuitem-active' : '' }} ">
                     <a class="active" href="{{ route('store.cargos') }}">
                         <i data-feather="globe"></i>
                         <span>Cargos</span>
                     </a>
                 </li>

                 <li class="{{ Route::is('store.garages') ? 'menuitem-active' : '' }} ">
                     <a class="active" href="{{ route('store.garages') }}">
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
