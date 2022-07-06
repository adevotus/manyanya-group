<!DOCTYPE html>
<html lang="en">

<head>
    @include('assets.css')
    @yield('css')
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

    <script>
        @if (Session::has('message'))
            @if (str_contains(Session::get('message'), ' successful '))
                toastr.success('{{ Session::get('message') }}', 'Success!', {
                    closeButton: true,
                    tapToDismiss: false,
                    progressBar: true,
                });
            @else
                @if (Session::get('message') === 'No changes were made!')

                    toastr.info('{{ Session::get('message') }}', 'Info!', {
                        closeButton: true,
                        tapToDismiss: false,
                        progressBar: true,
                    });
                @else
                    toastr.error('{{ Session::get('message') }}', 'Error!', {
                        closeButton: true,
                        tapToDismiss: false,
                        progressBar: true,
                    });
                @endif
            @endif
        @endif
    </script>
</body>

</html>
