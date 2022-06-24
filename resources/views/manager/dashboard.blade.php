@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Manager</h4>
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
                                        <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $route }}</span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <h6 class="text-uppercase">Registered Route</h6>

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

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-sm bg-warning rounded">
                                        <i data-feather="user" class="avatar-title font-18 text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $driver }}</span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <h6 class="text-uppercase">Driver</h6>

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
                                        <i data-feather="globe" class="avatar-title font-18 text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $cargo }}</span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <h6 class="text-uppercase">Cargos</h6>

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
                                                Recently Registed Routes
                                            </h4>

                                        </div>
                                        <div class="col-sm-7">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 text-end">
                                    <a href="{{ route('routes') }}"
                                        class="btn btn-success text-end waves-effect waves-light"><i
                                            class="mdi mdi-plus-circle me-1"></i>View More</a>
                                </div><!-- end col-->
                            </div>

                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap table-striped" id="products-datatable">
                                    <thead>
                                        <tr>
                                            <th style="width: 20px;">
                                                #
                                            </th>
                                            <th>Route Source</th>
                                            <th>Route Destination</th>
                                            <th>Price</th>
                                            <th>Driver Name</th>
                                            <th>Vehicle Model</th>
                                            <th>Cargo</th>
                                            <th>Status</th>
                                            <th>Create Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($routes && $routes->count() > 0)
                                            @foreach ($routes as $key => $route)
                                                <tr>
                                                    <td>
                                                        {{ $key + 1 }}
                                                    </td>
                                                    <td class="table-user">
                                                        {{ $route->source }}
                                                    </td>
                                                    <td class="table-user">
                                                        {{ $route->destination }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($route->price) }}
                                                    </td>
                                                    <td>
                                                        {{ $route->driver->name }}
                                                    </td>
                                                    <td>
                                                        {{ $route->vehicle->name }}
                                                    </td>
                                                    <td>
                                                        {{ $route->cargo->name }}
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge @if ($route->status === 'paid') bg-soft-success text-success @elseif ($route->status === 'pending')  bg-soft-info text-info @else bg-soft-danger text-danger @endif">
                                                            {{ $route->status }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        {{ date('Y-m-d', strtotime($route->updated_at)) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td></td>
                                                <td>No Route Info Found</td>
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
                                                Recently Registered Drivers
                                            </h4>
                                        </div>
                                        <div class="col-sm-7">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 text-end">
                                    <a href="{{ route('driver') }}"
                                        class="btn btn-success text-end waves-effect waves-light"><i
                                            class="mdi mdi-plus-circle me-1"></i>View More</a>
                                </div><!-- end col-->
                            </div>

                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap table-striped" id="products-datatable">
                                    <thead>
                                        <tr>
                                            <th style="width: 20px;">
                                                #
                                            </th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>status</th>
                                            <th>License</th>
                                            <th>Certificate</th>
                                            <th>Create Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($drivers && $drivers->count() > 0)
                                            @foreach ($drivers as $key => $driver)
                                                <tr>
                                                    <td>
                                                        {{ $key + 1 }}
                                                    </td>
                                                    <td class="table-user">
                                                        {{ $driver->name }}
                                                    </td>
                                                    <td>
                                                        {{ $driver->email }}
                                                    </td>
                                                    <td>
                                                        @foreach ($driver->roles as $role)
                                                            {{ $role->display_name }}
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-soft-success text-success">
                                                            verified
                                                        </span>

                                                    </td>
                                                    <td>
                                                        <a href="{{ route('license.download', ['id' => $driver->id]) }}"
                                                            class="action-icon">
                                                            <i data-feather="download"></i>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('certificate.download', ['id' => $driver->id]) }}"
                                                            class="action-icon">
                                                            <i data-feather="download"></i>
                                                    </td>
                                                    <td>
                                                        {{ date('Y-m-d', strtotime($driver->updated_at)) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td></td>
                                                <td>No driver Info Found</td>
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
                                                Recent registered cargo
                                            </h4>
                                        </div>
                                        <div class="col-sm-7">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 text-end">
                                    <a href="{{ route('cargos') }}"
                                        class="btn btn-success text-end waves-effect waves-light"><i
                                            class="mdi mdi-plus-circle me-1"></i>View More</a>
                                </div><!-- end col-->
                            </div>

                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap table-striped" id="products-datatable">
                                    <thead>
                                        <tr>
                                            <th style="width: 20px;">
                                                #
                                            </th>
                                            <th>Name</th>
                                            <th>Amount</th>
                                            <th>weight</th>
                                            <th>Create Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($cargos && $cargos->count() > 0)
                                            @foreach ($cargos as $key => $cargo)
                                                <tr>
                                                    <td>
                                                        {{ $key + 1 }}
                                                    </td>
                                                    <td class="table-user">
                                                        {{ $cargo->name }}
                                                    </td>

                                                    <td>
                                                        {{ number_format($cargo->amount) }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($cargo->weight) }}
                                                    </td>
                                                    <td>
                                                        {{ date('Y-m-d', strtotime($cargo->updated_at)) }}
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td></td>
                                                <td>No Cargo Info Found</td>
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
                                                Recently Registered Vehicles
                                            </h4>
                                        </div>
                                        <div class="col-sm-7">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 text-end">
                                    <a href="{{ route('vehicle') }}"
                                        class="btn btn-success text-end waves-effect waves-light"><i
                                            class="mdi mdi-plus-circle me-1"></i>View More</a>
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
                                <div class="col-sm-4 text-end">
                                    <a href="{{ route('garages') }}"
                                        class="btn btn-success text-end waves-effect waves-light"><i
                                            class="mdi mdi-plus-circle me-1"></i>View More</a>
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
