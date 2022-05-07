<!DOCTYPE html>
<html lang="en">

<head>
    @include('./assets.css')


</head>

<!-- body start -->

<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

    <!-- Begin page -->
    <div id="wrapper">

        @include('layouts.muhasibu.headermuhasibu')
        @include('layouts.muhasibu.navmuhasibu')
       <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                              <h4 class="page-title">Accountant</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-sm bg-blue rounded">
                                                <i class="fe-aperture avatar-title font-22 text-white"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-end">
                                                <h3 class="text-dark my-1"><span data-plugin="counterup">12</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h6 class="text-uppercase">Recent Invoices</h6>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- end card-->
                        </div>
                        <!-- end col -->

                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-sm bg-success rounded">
                                                <i class="fe-shopping-cart avatar-title font-22 text-white"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-end">
                                                <h3 class="text-dark my-1"><span data-plugin="counterup">15</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h6 class="text-uppercase">Total Orders</h6>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- end card-->
                        </div>
                        <!-- end col -->

                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-sm bg-warning rounded">
                                                <i class="fe-bar-chart-2 avatar-title font-22 text-white"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-end">
                                                <h3 class="text-dark my-1"><span data-plugin="counterup">8</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h6 class="text-uppercase">Total Expenses</h6>
                                       
                                    </div>
                                </div>
                            </div>
                            <!-- end card-->
                        </div>
                        <!-- end col -->

                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-sm bg-info rounded">
                                                <i class="fe-cpu avatar-title font-22 text-white"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-end">
                                                <h3 class="text-dark my-1"><span data-plugin="counterup">178</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h6 class="text-uppercase">Checked Receipts</h6>
                                       
                                    </div>
                                </div>
                            </div>
                            <!-- end card-->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

               

                </div>
                <!-- container -->
            </div>
            <!-- content -->
            @include('layouts.footer')
        </div>
       
           </div>
    <!-- END wrapper -->
    @include('./assets.js')
</body>

</html>