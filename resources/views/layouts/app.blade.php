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
        @include('layouts.sidebar')

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
