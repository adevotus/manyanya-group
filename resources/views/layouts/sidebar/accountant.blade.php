 <!-- ========== Left Sidebar Start ========== -->
 <div class="left-side-menu">

     <div class="h-100" data-simplebar>

         <!--- Sidemenu -->
         <div id="sidebar-menu">

             <ul id="side-menu">
                 <li class="{{ Route::is('muhasibu.home') ? 'menuitem-active' : '' }}">
                     <a href="{{ route('muhasibu.home') }}">
                         <i data-feather="airplay"></i>
                         <span> Dashboard</span>
                     </a>
                 </li>
                 <li class="{{ Route::is('muhasibu.home') ? 'menuitem-active' : '' }}">
                     <a href="{{ route('muhasibu.home') }}">
                         <i data-feather="credit-card"></i>
                         <span> Payment</span>
                     </a>
                 </li>
                 <li class="{{ Route::is('muhasibu.invoice') ? 'menuitem-active' : '' }}">
                     <a href="{{ route('muhasibu.invoice') }}">
                         <i data-feather="globe"></i>
                         <span>Invoce</span>
                     </a>
                 </li>
                 <li class="{{ Route::is('muhasibu.invoice') ? 'menuitem-active' : '' }}">
                     <a href="{{ route('muhasibu.invoice') }}">
                         <i data-feather="message-circle"></i>
                         <span>Requests</span>
                     </a>
                 </li>
                 <li class="{{ Route::is('muhasibu.garage') ? 'menuitem-active' : '' }}">
                     <a href="{{ route('muhasibu.garage') }}">
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
