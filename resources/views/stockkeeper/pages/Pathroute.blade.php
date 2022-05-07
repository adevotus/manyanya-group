<!DOCTYPE html>
<html lang="en">

<head>
    @include('./assets.css')

</head>

<!-- body start -->

<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

    <!-- Begin page -->
    <div id="wrapper">

        @include('layouts.header')
        @include('layouts.navi-store')


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
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Route</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Route</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
  <!-- status row -->
                    <div class="row">
                        <div class="col-md-6 col-xl-3">
                            <div class="widget-rounded-circle card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-lg rounded-circle bg-primary">
                                                <i class="fe-tag font-22 avatar-title text-white"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-end">
                                                <h3 class="text-dark mt-1"><span data-plugin="counterup">7</span></h3>
                                                <p class="text-dark mb-1">Comments</p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div>
                            </div> <!-- end widget-rounded-circle-->
                        </div> <!-- end col-->

                        <div class="col-md-6 col-xl-3">
                            <div class="widget-rounded-circle card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-lg rounded-circle bg-warning">
                                                <i class="fe-clock font-22 avatar-title text-white"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-end">
                                                <h3 class="text-dark mt-1"><span data-plugin="counterup">10</span></h3>
                                                <p class="text-dark text-bold mb-1">Pending Route</p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div>
                            </div> <!-- end widget-rounded-circle-->
                        </div> <!-- end col-->

                        <div class="col-md-6 col-xl-3">
                            <div class="widget-rounded-circle card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-lg rounded-circle bg-success">
                                                <i class="fe-check-circle font-22 avatar-title text-white"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-end">
                                                <h3 class="text-dark mt-1"><span data-plugin="counterup">10</span></h3>
                                                <p class="text-dark text-bold font-weight-bold temb-1 ">Approved Route</p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div>
                            </div> <!-- end widget-rounded-circle-->
                        </div> <!-- end col-->

                        <div class="col-md-6 col-xl-3">
                            <div class="widget-rounded-circle card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-lg rounded-circle bg-danger">
                                                <i class="fe-trash-2 font-22 avatar-title text-white"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-end">
                                                <h3 class="text-dark mt-1"><span data-plugin="counterup">128</span></h3>
                                                <p class="text-muted mb-1">Deleted Route</p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div>
                            </div> <!-- end widget-rounded-circle-->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->




                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="col-md-4">
                                            <div class="text-md-end mt-3 mt-md-0 text-center" >
                                                <button type="button" class="btn btn-success waves-effect waves-light me-1"><i class="mdi mdi-cog"></i></button>
                                                <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#routepath"><i class="mdi mdi-plus-circle me-1"></i> Add New Route</button>
                                            </div>
                                        </div><!-- end col-->
                                    </div> <!-- end row -->
                                </div>
                            </div> <!-- end card -->
                        </div><!-- end col-->
                    </div>
                    <!-- end row -->

                    <!-- end row -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    
                                    <h4 class="header-title mb-4">Manage Route</h4>

                                    <div class="table-responsive">
                                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Route ID 
                                                    </th>
                                                    <th>Drive ID</th>
                                                    <th>Driver Name</th>
                                                    <th>From - To</th>
                                                    <th>Status</th>
                                                    <th>Created Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td><b>#1256</b></td>
                                                    <td>
                                                       <b>T-1234-32123-23</b>
                                                    </td>

                                                    <td>
                                                        ATANUS EMMANUEL
                                                    </td>

                                                    <td>
                                                        MWANZA - DODOMA
                                                    </td>

                                                    <td>
                                                        <span class="badge bg-soft-secondary text-secondary">proved</span>
                                                    </td>
                                                    <td>
                                                        2017/04/28
                                                    </td>

                                                    <td>
                                                        <div class="btn-group dropdown">
                                                            <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-pencil me-2 text-muted font-18 vertical-middle"></i>Edit Ticket</a>
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-check-all me-2 text-muted font-18 vertical-middle"></i>Close</a>
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-delete me-2 text-muted font-18 vertical-middle"></i>Remove</a>
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-star me-2 font-18 text-muted vertical-middle"></i>Mark as Unread</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td><b>#2542</b></td>
                                                    <td>
                                                       <b>T-1234-32123-23</b>
                                                    </td>

                                                    <td>
                                                        ATANUS EMMANUEL
                                                    </td>

                                                    <td>
                                                        MWANZA - DODOMA
                                                    </td>

                                                    <td>
                                                        <span class="badge bg-soft-warning text-warning">Send</span>
                                                    </td>

                                                    <td>
                                                        2008/04/25
                                                    </td>

                                                    <td>
                                                        <div class="btn-group dropdown">
                                                            <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-pencil me-2 text-muted font-18 vertical-middle"></i>Edit Ticket</a>
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-check-all me-2 text-muted font-18 vertical-middle"></i>Close</a>
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-delete me-2 text-muted font-18 vertical-middle"></i>Remove</a>
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-star me-2 font-18 text-muted vertical-middle"></i>Mark as Unread</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td><b>#320</b></td>
                                                    <td>
                                                        <a href="javascript: void(0);" class="text-body">
                                                            <img src="../assets/images/users/user-5.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-xs" />
                                                            <span class="ms-2">Phyllis K. Maciel</span>
                                                        </a>
                                                    </td>

                                                    <td>
                                                        Verify your new email address!
                                                    </td>

                                                    <td>
                                                        <a href="javascript: void(0);">
                                                            <img src="../assets/images/users/user-10.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-xs" />
                                                        </a>
                                                    </td>

                                                    <td>
                                                        <span class="badge bg-soft-danger text-danger">High</span>
                                                    </td>

                                                   
                                                    <td>
                                                        2017/04/25
                                                    </td>

                                                    <td>
                                                        <div class="btn-group dropdown">
                                                            <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-pencil me-2 text-muted font-18 vertical-middle"></i>Edit Ticket</a>
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-check-all me-2 text-muted font-18 vertical-middle"></i>Close</a>
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-delete me-2 text-muted font-18 vertical-middle"></i>Remove</a>
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-star me-2 font-18 text-muted vertical-middle"></i>Mark as Unread</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td><b>#1254</b></td>
                                                    <td>
                                                        <a href="javascript: void(0);" class="text-body">
                                                            <img src="../assets/images/users/user-8.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-xs" />
                                                            <span class="ms-2">Margeret V. Ligon</span>
                                                        </a>
                                                    </td>

                                                    <td>
                                                        Your application has been received!
                                                    </td>

                                                    <td>
                                                        <a href="javascript: void(0);">
                                                            <img src="../assets/images/users/user-10.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-xs" />
                                                        </a>
                                                    </td>

                                                    <td>
                                                        <span class="badge bg-soft-danger text-danger">High</span>
                                                    </td>

                                                     <td>
                                                        21/05/2017
                                                    </td>

                                                    <td>
                                                        <div class="btn-group dropdown">
                                                            <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-pencil me-2 text-muted font-18 vertical-middle"></i>Edit Ticket</a>
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-check-all me-2 text-muted font-18 vertical-middle"></i>Close</a>
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-delete me-2 text-muted font-18 vertical-middle"></i>Remove</a>
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-star me-2 font-18 text-muted vertical-middle"></i>Mark as Unread</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>                                             
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->
                </div> <!-- container -->
            </div> <!-- content -->
            @include('layouts.footer')
        </div>
    </div>
    <!-- END wrapper -->
    <!-- Modal -->
    <div class="modal fade" id="routepath" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title" id="myCenterModalLabel">Add New Route</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body p-4">
                    <form method="POST" action="#">
                        <div class="mb-3">
                            <label for="name" class="form-label">Start Point</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter place">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Ending Point</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter place">
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Date</label>
                            <input type="date" class="form-control" id="position" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Cargo</label>
                            <input type="text" class="form-control" id="position" placeholder="name">
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Kilogram</label>
                            <input type="number" class="form-control" id="position" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="position" placeholder="amount of the cargo">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Driver</label> <br />
                            <select id="selectize-select" class="form-control">
                                <option data-display="Select">select registered</option>
                                <option value="1">name 1</option>
                                <option value="2">name 2</option>
                                <option value="3">name 3</option>
                                <option value="4">name 4</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Vehicle</label> <br />
                            <select id="selectize-select" class="form-control">
                                <option data-display="Select">select registered</option>
                                <option value="1">name 1</option>
                                <option value="2">name 2</option>
                                <option value="3">name 3</option>
                                <option value="4">name 4</option>
                            </select>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success waves-effect waves-light">Send to Approve</button>
                            <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-dismiss="modal">Continue</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->




    @include('./assets.js')


</body>

</html>