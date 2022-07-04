<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Screen</title>

    <link href="{{ asset('assets/css/config/default/bootstrap.min.css') }}" rel="stylesheet" type="text/css"
        media="all" />
    <link href="{{ asset('assets/css/config/default/app.min.css') }}" rel="stylesheet" type="text/css"
        media="all" />

    <style>
        @media screen {
            #wrapper {
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>

<!-- body start -->

<body>
    <!-- Begin page -->
    <div id="wrapper" style="margin-top: 30px;">
        <!-- Start Content-->
        <div class="container">
            <div class="row">
                <!-- project card -->
                <div class="card d-block">
                    <div class="card-body">

                        <div class="float-sm-end mb-2 mb-sm-0">
                            <div class="row g-2">
                                <div class="col-auto">

                                </div>
                                <div class="col-auto">

                                </div>
                            </div>
                        </div> <!-- end dropdown-->

                        <div class="clerfix"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Ticket type -->
                                <label class="mt-2 mb-1">Route Name:</label>
                                <p>
                                    <i class="mdi mdi-truck font-18 text-info me-1 align-middle"></i>
                                    <strong>{{ $route->route }}</strong>
                                </p>
                                <!-- end Ticket Type -->
                            </div>

                            <div class="col-md-6">
                                <!-- Ticket type -->
                                <label class="mt-2 mb-1">Route Invoice:</label>
                                <p>
                                    <i class="mdi mdi-credit-card font-18 text-info me-1 align-middle"></i>
                                    <strong>{{ $route->cargo->invoice }}</strong>
                                </p>
                                <!-- end Ticket Type -->
                            </div>
                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-md-6">
                                <!-- assignee -->
                                <label class="mt-2 mb-1">Customer Name:</label>
                                <div class="d-flex align-items-start">
                                    <div class="w-100">
                                        <p><strong>{{ $route->cargo->customername }}</strong></p>
                                    </div>
                                </div>
                                <!-- end assignee -->
                            </div> <!-- end col -->

                            <div class="col-md-6">
                                <!-- Reported by -->
                                <label class="mt-2 mb-1">Customer phone:</label>
                                <div class="d-flex align-items-start">
                                    <div class="w-100">
                                        <p><strong>{{ $route->cargo->customerphone }}</strong></p>
                                    </div>
                                </div>
                                <!-- end Reported by -->
                            </div> <!-- end col -->

                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-md-6">
                                <!-- assignee -->
                                <label class="mt-2 mb-1">Customer Email:</label>
                                <div class="d-flex align-items-start">
                                    <div class="w-100">
                                        <p><strong>{{ $route->cargo->customeremail }}</strong></p>
                                    </div>
                                </div>
                                <!-- end assignee -->
                            </div> <!-- end col -->

                            <div class="col-md-6">
                                <!-- Reported by -->
                                <label class="mt-2 mb-1">Customer phone:</label>
                                <div class="d-flex align-items-start">
                                    <div class="w-100">
                                        <p><strong>{{ $route->vehicle->name }} -
                                                {{ $route->vehicle->platenumber }}</strong></p>
                                    </div>
                                </div>
                                <!-- end Reported by -->
                            </div> <!-- end col -->

                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-md-6">
                                <!-- assignee -->
                                <label class="mt-2 mb-1">Created On :</label>
                                <p> <strong>{{ date('d-m-Y', strtotime($route->created_at)) }}</strong></p>
                                <!-- end assignee -->
                            </div> <!-- end col -->

                            <div class="col-md-6">
                                <!-- assignee -->
                                <label class="mt-2 mb-1">departure On :</label>
                                <p> <strong>{{ date('d-m-Y', strtotime($route->date)) }}</strong></p>
                                <!-- end assignee -->
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Status -->
                                <label class="mt-2 form-label">Status :</label>
                                <div class="row">
                                    <div class="col-auto">
                                        <p><strong>{{ ucfirst($route->status) }}</strong></p>
                                    </div>
                                </div>
                                <!-- end Status -->
                            </div> <!-- end col -->

                            <div class="col-md-6">
                                <!-- Priority -->
                                <label class="mt-2 mb-1">Price :</label>
                                <div class="row">
                                    <div class="col-auto">
                                        <p><strong>{{ number_format($route->price) }}</strong></p>
                                    </div>
                                </div>
                                <!-- end Priority -->
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        <label class="mt-4 mb-1">Payment Overview :</label>
                        <div class="row mt-2">
                            <div class="col-md-2">
                                <strong>#</strong>
                            </div>
                            <div class="col-md-4">
                                <strong>Description</strong>
                            </div>
                            <div class="col-md-2">
                                <strong>Method</strong>
                            </div>
                            <div class="col-md-2">
                                <strong>Installed</strong>
                            </div>
                            <div class="col-md-2">
                                <strong>Remaining</strong>
                            </div>
                        </div>
                        <hr>
                        @foreach ($route->payment as $key => $payment)
                            <div class="row mt-2">
                                <div class="col-md-2">
                                    {{ $key + 1 }}
                                </div>
                                <div class="col-md-4">
                                    {{ $payment->description }}
                                </div>
                                <div class="col-md-2">
                                    {{ ucfirst($payment->payment_method) }}
                                </div>
                                <div class="col-md-2">
                                    {{ number_format($payment->installed) }}
                                </div>
                                <div class="col-md-2">
                                    {{ number_format($payment->remaining) }}
                                </div>
                            </div>
                        @endforeach
                        <hr>
                    </div> <!-- end card-body-->

                </div> <!-- end card-->
                <!-- end card-->
            </div>
            <!-- end row -->
        </div>
    </div>
    <!-- END wrapper -->

    <!-- Plugins js-->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <script>
        $(function() {
            window.print();
        });
    </script>
</body>

</html>
