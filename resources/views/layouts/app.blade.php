<!DOCTYPE html>
<html lang="en">

<head>
    @include('assets.css')

</head>

<!-- body start -->

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

    <!-- Begin page -->
    <div id="wrapper">

        @include('layouts.header')
        @role('superadmin')
            @include('layouts.sidebar.admin')
        @endrole
        @role('manager')
            @include('layouts.sidebar.manager')
        @endrole
        @role('storekeeper')
            @include('layouts.sidebar.store')
        @endrole
        @role('driver')
            @include('layouts.sidebar.driver')
        @endrole
        @role('muhasibu')
            @include('layouts.sidebar.accountant')
        @endrole
        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            @yield('content')
            @include('layouts.footer')
        </div>

    </div>
    <!-- END wrapper -->
    @include('assets.js')
    @yield('js')
</body>

</html>
