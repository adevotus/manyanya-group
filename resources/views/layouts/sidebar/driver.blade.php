 <!-- ========== Left Sidebar Start ========== -->
 <div class="left-side-menu">

     <div class="h-100" data-simplebar>

         <!--- Sidemenu -->
         <div id="sidebar-menu">

             <ul id="side-menu">
                 <li class="{{ Route::is('driver.home') ? 'menuitem-active' : '' }}">
                     <a href="{{ route('driver.home') }}">
                         <i data-feather="airplay"></i>
                         <span> Dashboard</span>
                     </a>
                 </li>
                 <li class="{{ Route::is('driver.home') ? 'menuitem-active' : '' }}">
                     <a href="{{ route('driver.home') }}">
                         <i data-feather="archive"></i>
                         <span>Expences</span>
                     </a>
                 </li>
                 <li class="{{ Route::is('driver.home') ? 'menuitem-active' : '' }}">
                     <a href="{{ route('driver.home') }}">
                         <i data-feather="upload-cloud"></i>
                         <span>Uploads</span>
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
