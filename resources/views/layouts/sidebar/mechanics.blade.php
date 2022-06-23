 <!-- ========== Left Sidebar Start ========== -->
 <div class="left-side-menu">

     <div class="h-100" data-simplebar>

         <!--- Sidemenu -->
         <div id="sidebar-menu">

             <ul id="side-menu">
                 <li class="{{ Route::is('mechanics.home') ? 'menuitem-active' : '' }}">
                     <a href="{{ route('mechanics.home') }}">
                         <i data-feather="airplay"></i>
                         <span> Dashboard</span>
                     </a>
                 </li>
                 <li class="{{ Route::is('vehicle') ? 'menuitem-active' : '' }}">
                     <a href="{{ route('vehicle') }}">
                         <i data-feather="credit-card"></i>
                         <span> Vehicle</span>
                     </a>
                 </li>
                 <li class="{{ Route::is('garages') ? 'menuitem-active' : '' }}">
                     <a href="{{ route('garages') }}">
                         <i data-feather="globe"></i>
                         <span>Garage</span>
                     </a>
                 </li>
                 {{-- <li class="{{ Route::is('muhasibu.invoice') ? 'menuitem-active' : '' }}">
                     <a href="{{ route('muhasibu.invoice') }}">
                         <i data-feather="message-circle"></i>
                         <span>Acknowledgement</span>
                     </a>
                 </li> --}}
                 <li class="{{ Route::is('expense') ? 'menuitem-active' : '' }}">
                     <a href="{{ route('expense') }}">
                         <i data-feather="tool"></i>
                         <span>Expenses</span>
                     </a>
                 </li>
                 {{-- <li class="{{ Route::is('muhasibu.garage') ? 'menuitem-active' : '' }}">
                     <a href="{{ route('muhasibu.garage') }}">
                         <i data-feather="tool"></i>
                         <span>Report</span>
                     </a>
                 </li> --}}

             </ul>

         </div>
         <!-- End Sidebar -->

         <div class="clearfix"></div>

     </div>
     <!-- Sidebar -left -->

 </div>
 <!-- Left Sidebar End -->
