<!DOCTYPE html>
<html lang="en">

<head>
    @include('./assets.css')


</head>

<!-- body start -->

<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

    <!-- Begin page -->
    <div id="wrapper">

        @include('layouts.partials.adminheader')
        @include('layouts.partials.admnavi')
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
                                <h4 class="page-title">Director</h4>
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
                                    <div class="mt-3  justify-content-center">
                                        <h3 class="text-uppercase btn btn-info text-sm-center" style="font-size: small;" data-bs-toggle="modal" data-bs-target="#listofdriver">Driver</h3>
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
                                    <h3 class="text-uppercase btn btn-info text-sm-center" style="font-size: small;" data-bs-toggle="modal" data-bs-target="#listofdriver">Report incoming</h3>

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
                                    <h3 class="text-uppercase btn btn-info text-sm-center" style="font-size: small;" data-bs-toggle="modal" data-bs-target="#listofdriver">Cargo transport</h3>

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
                                    <h3 class="text-uppercase btn btn-info text-sm-center" style="font-size: small;" data-bs-toggle="modal" data-bs-target="#listofdriver">Enquaries</h3>

                                    </div>
                                </div>
                            </div>
                            <!-- end card-->
                        </div>
                        <!-- end col -->

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

    <!-- Modal -->
    <div class="modal fade" id="listofdriver" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="col-md-12 col-lg-12" style="width: 80%;">
        <div class="modal-dialog modal-dialog-centered">
                           <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h4 class="modal-title" id="myCenterModalLabel">List of Driver </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-striped" id="products-datatable">
                                <thead>
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>Customer</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Location</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck2">
                                                <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td class="table-user">
                                            <img src="../assets/images/users/user-4.jpg" alt="table-user" class="me-2 rounded-circle">
                                            <a href="javascript:void(0);" class="text-body fw-semibold">Paul J. Friend</a>
                                        </td>
                                        <td>
                                            937-330-1634
                                        </td>
                                        <td>
                                            pauljfrnd@jourrapide.com
                                        </td>
                                        <td>
                                            New York
                                        </td>
                                       
                                        
                                    </tr>
    
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck3">
                                                <label class="form-check-label" for="customCheck3">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td class="table-user">
                                            <img src="../assets/images/users/user-3.jpg" alt="table-user" class="me-2 rounded-circle">
                                            <a href="javascript:void(0);" class="text-body fw-semibold">Bryan J. Luellen</a>
                                        </td>
                                        <td>
                                            215-302-3376
                                        </td>
                                        <td>
                                            bryuellen@dayrep.com
                                        </td>
                                        <td>
                                            New York
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck4">
                                                <label class="form-check-label" for="customCheck4">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td class="table-user">
                                            <img src="../assets/images/users/user-3.jpg" alt="table-user" class="me-2 rounded-circle">
                                            <a href="javascript:void(0);" class="text-body fw-semibold">Kathryn S. Collier</a>
                                        </td>
                                        <td>
                                            828-216-2190
                                        </td>
                                        <td>
                                            collier@jourrapide.com
                                        </td>
                                        <td>
                                            Canada
                                        </td>
                                       
                                    </tr>
                                    
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
        
        </div>
        </div>
        <!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @include('./assets.js')
</body>

</html>