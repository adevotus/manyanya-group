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
                 <li class="{{ Route::is('routes') ? 'menuitem-active' : '' }} ">
                     <a class="active" href="{{ route('routes') }}">
                         <i data-feather="corner-up-right"></i>
                         <span>Routes</span>
                     </a>
                 </li>

                 <li class="{{ Route::is('store.driver') ? 'menuitem-active' : '' }} ">
                     <a class="active" href="{{ route('store.driver') }}">
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

                 <li class="{{ Route::is('expense') ? 'menuitem-active' : '' }} ">
                     <a class="active" href="{{ route('expense') }}">
                         <i data-feather="sliders"></i>
                         <span>Expense</span>
                     </a>
                 </li>

                 <li class="{{ Route::is('cargos') ? 'menuitem-active' : '' }} ">
                     <a class="active" href="{{ route('cargos') }}">
                         <i data-feather="archive"></i>
                         <span>Slips</span>
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
