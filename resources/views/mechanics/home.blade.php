@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Mechanics</h4>
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
                                        <i data-feather="arrow-up-right" class="avatar-title font-18 text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $tool }}</span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <h6 class="text-uppercase">Registered Tools</h6>

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
                                        <i data-feather="truck" class="avatar-title font-18 text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $vehicle }}</span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <h6 class="text-uppercase">Vehicle</h6>

                            </div>
                        </div>
                    </div>
                    <!-- end card-->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <h4>
                                                Recently Registered Vehicles
                                            </h4>
                                        </div>
                                        <div class="col-sm-7">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="me-3">

                                    </div>
                                </div><!-- end col-->
                            </div>

                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap table-striped" id="products-datatable">
                                    <thead>
                                        <tr>
                                            <th style="width: 20px;">
                                                #
                                            </th>
                                            <th>Vehicle Name</th>
                                            <th>Reg #</th>
                                            <th>Plate #</th>
                                            <th>Condition</th>
                                            <th>Create Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($vehicles && $vehicles->count() > 0)
                                            @foreach ($vehicles as $key => $vehicle)
                                                <tr>
                                                    <td>
                                                        {{ $key + 1 }}
                                                    </td>
                                                    <td class="table-user">
                                                        {{ $vehicle->name }}
                                                    </td>
                                                    <td>
                                                        {{ $vehicle->reg_number }}
                                                    </td>
                                                    <td>
                                                        {{ $vehicle->platenumber }}
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-soft-success text-success">
                                                            {{ $vehicle->condition }}
                                                        </span>

                                                    </td>
                                                    <td>
                                                        {{ date('Y-m-d', strtotime($vehicle->updated_at)) }}
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td></td>
                                                <td>No Vehicle Info Found</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>


                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <h4>
                                                Garage Tools Registered Recently
                                            </h4>
                                        </div>
                                        <div class="col-sm-7">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">

                                </div><!-- end col-->
                            </div>

                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap table-striped" id="products-datatable">
                                    <thead>
                                        <tr>
                                            <th style="width: 20px;">
                                                #
                                            </th>
                                            <th>Tool Name</th>
                                            <th>Amount</th>
                                            <th>Condition</th>
                                            <th>Create Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($garages && $garages->count() > 0)
                                            @foreach ($garages as $key => $garage)
                                                <tr>
                                                    <td>
                                                        {{ $key + 1 }}
                                                    </td>
                                                    <td class="table-user">
                                                        {{ $garage->tool_name }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($garage->amount) }}
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-soft-success text-success">
                                                            {{ $garage->condition }}
                                                        </span>

                                                    </td>
                                                    <td>
                                                        {{ date('Y-m-d', strtotime($garage->updated_at)) }}
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td></td>
                                                <td>No Tool Info Found</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>


                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
        </div>
        <!-- container -->
    </div>
    <!-- content -->
@endsection
