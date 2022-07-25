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
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                        <i class="fe-heart font-22 avatar-title text-primary"></i>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1"><span
                                                data-plugin="counterup">{{ number_format($r_sum) }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Today's Revenue</p>
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
                                <div class="col-4">
                                    <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                        <i class="fe-shopping-cart font-22 avatar-title text-success"></i>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $r_count }}</span>
                                        </h3>
                                        <p class="text-muted mb-1 text-truncate">Today's Routes</p>
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
                                <div class="col-4">
                                    <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                        <i class="fe-bar-chart-line- font-22 avatar-title text-info"></i>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1"><span
                                                data-plugin="counterup">{{ number_format($e_sum + $g_sum) }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Today's Expenses</p>
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
                                <div class="col-4">
                                    <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                        <i class="fe-eye font-22 avatar-title text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $t_cargo }}</span>
                                        </h3>
                                        <p class="text-muted mb-1 text-truncate">Today's Cargo</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Weekly Route Invoice Chart</h4>
                            <div class="mt-4 chartjs-chart">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="singleLineChart" style="display: block; height: 350px; width: 412px;"
                                    class="chartjs" width="824" height="700"></canvas>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Weekly Expenses & Route Revenue</h4>

                            <div class="mt-4 chartjs-chart">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="support-trackers-chart" style="display: block; height: 150px; width: 412px;"
                                    class="chartjs-render-monitor" width="824" height="700"></canvas>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="header-title">Monthly Invoice Chart</h4>
                                    <p>{{ 'Monthly Total is ' . number_format($m_total) }}</p>
                                </div>
                                <div class="col-md-6">
                                    <form action="{{ route('manager.home') }}" method="get">
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <input type="text" id="range-datepicker"
                                                    class="form-control flatpickr-input" name="date"
                                                    placeholder="2018-10-03 to 2018-10-10" readonly="readonly">
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="submit" class="btn btn-success waves-effect waves-light"><i
                                                        class="mdi mdi-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="mt-4 chartjs-chart">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="monthlyLineChart" style="display: block; height: 150px; width: 412px;"
                                    class="chartjs" width="824" height="400"></canvas>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="header-title">Yearly Revenue Chart</h4>
                                    <p>{{ 'Total ' . $fromY . ' is ' . number_format($l_total) . ' & ' . 'Total ' . $fromT . ' is ' . number_format($y_total) }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <form action="{{ route('manager.home') }}" method="get">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <select class="form-select" name="yearFrom" id="example-select">
                                                    <option value="2015" {{ (int) $fromY === 2015 ? 'selected' : '' }}>
                                                        2015
                                                    </option>
                                                    <option value="2016" {{ (int) $fromY === 2016 ? 'selected' : '' }}>
                                                        2016
                                                    </option>
                                                    <option value="2017" {{ (int) $fromY === 2017 ? 'selected' : '' }}>
                                                        2017
                                                    </option>
                                                    <option value="2018" {{ (int) $fromY === 2018 ? 'selected' : '' }}>
                                                        2018
                                                    </option>
                                                    <option value="2019" {{ (int) $fromY === 2019 ? 'selected' : '' }}>
                                                        2019</option>
                                                    <option value="2020" {{ (int) $fromY === 2020 ? 'selected' : '' }}>
                                                        2020</option>
                                                    <option value="2021" {{ (int) $fromY === 2021 ? 'selected' : '' }}>
                                                        2021</option>
                                                    <option value="2022" {{ (int) $fromY === 2022 ? 'selected' : '' }}>
                                                        2022</option>
                                                    <option value="2023" {{ (int) $fromY === 2023 ? 'selected' : '' }}>
                                                        2023</option>
                                                    <option value="2024" {{ (int) $fromY === 2024 ? 'selected' : '' }}>
                                                        2024</option>
                                                    <option value="2025" {{ (int) $fromY === 2025 ? 'selected' : '' }}>
                                                        2025</option>
                                                    <option value="2026" {{ (int) $fromY === 2026 ? 'selected' : '' }}>
                                                        2026</option>
                                                    <option value="2027" {{ (int) $fromY === 2027 ? 'selected' : '' }}>
                                                        2027</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-5">
                                                <select class="form-select" name="yearTo" id="example-select">
                                                    <option value="2015" {{ (int) $fromT === 2015 ? 'selected' : '' }}>
                                                        2015
                                                    </option>
                                                    <option value="2016" {{ (int) $fromT === 2016 ? 'selected' : '' }}>
                                                        2016
                                                    </option>
                                                    <option value="2017" {{ (int) $fromT === 2017 ? 'selected' : '' }}>
                                                        2017
                                                    </option>
                                                    <option value="2018" {{ (int) $fromT === 2018 ? 'selected' : '' }}>
                                                        2018
                                                    </option>
                                                    <option value="2019" {{ (int) $fromT === 2019 ? 'selected' : '' }}>
                                                        2019</option>
                                                    <option value="2020" {{ (int) $fromT === 2020 ? 'selected' : '' }}>
                                                        2020</option>
                                                    <option value="2021" {{ (int) $fromT === 2021 ? 'selected' : '' }}>
                                                        2021</option>
                                                    <option value="2022" {{ (int) $fromT === 2022 ? 'selected' : '' }}>
                                                        2022</option>
                                                    <option value="2023" {{ (int) $fromT === 2023 ? 'selected' : '' }}>
                                                        2023</option>
                                                    <option value="2024" {{ (int) $fromT === 2024 ? 'selected' : '' }}>
                                                        2024</option>
                                                    <option value="2025" {{ (int) $fromT === 2025 ? 'selected' : '' }}>
                                                        2025</option>
                                                    <option value="2026" {{ (int) $fromT === 2026 ? 'selected' : '' }}>
                                                        2026</option>
                                                    <option value="2027" {{ (int) $fromT === 2027 ? 'selected' : '' }}>
                                                        2027</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="submit" class="btn btn-success waves-effect waves-light"><i
                                                        class="mdi mdi-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="mt-4 chartjs-chart">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="yearlyLineChart" style="display: block; height: 150px; width: 412px;"
                                    class="chartjs" width="824" height="400"></canvas>
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
                                            <th>Route Name</th>
                                            <th>Fuel</th>
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
                                                        {{ $route->route }}
                                                    </td>
                                                    <td class="table-user">
                                                        {{ $route->fuel }}
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
                                                        {{ $route->status }}
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


@section('js')
    {{-- Weekly --}}
    <script>
        nAxis = {!! json_encode($xAxis, JSON_HEX_TAG) !!};
        mAxis = {!! json_encode($yAxis, JSON_HEX_TAG) !!};

        const DATA_COUNT_2 = 7;
        const NUMBER_CFG_2 = {
            count: DATA_COUNT_2,
            min: 0,
            max: 100
        };

        const data2 = {
            labels: nAxis,
            datasets: [{
                label: 'Amount',
                data: mAxis,
                borderColor: '#7367f0',
                fill: false,
                pointRadius: 2,
                borderWidth: 2,
                backgroundColor: '#7367f0',
                tension: 0.4,
            }]
        };

        const config2 = {
            type: 'line',
            data: data2,
            options: {
                animations: {
                    radius: {
                        duration: 400,
                        easing: 'linear',
                        loop: (context) => context.active
                    }
                },
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Min and Max Settings'
                    }
                },
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                hover: {
                    mode: 'index',
                },
                legend: {
                    display: false,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 50,
                    }
                },
                tooltips: {
                    mode: 'index',
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return "Tsh " + Number(tooltipItem.yLabel).toFixed(0).replace(/./g,
                                function(c, i, a) {
                                    return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," +
                                        c : c;
                                });
                        }
                    },
                    stepped: true,
                    enabled: true,
                    intersect: false,
                    padding: 20,
                    position: "nearest",
                    backgroundColor: "#FAFAFA",
                    borderColor: "#7367f0",
                    borderWidth: 1,
                    titleFontColor: "black",
                    titleFontStyle: "bold",
                    displayColors: false,
                    bodyFontColor: "black"
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            padding: 20,
                            fontFamily: "Montserrat",
                            callback: function(value, index, values) {
                                if (value >= 1000000000 || value <= -1000000000) {
                                    return value / 1e9 + 'B';
                                } else if (value >= 1000000 || value <= -1000000) {
                                    return value / 1e6 + 'M';
                                } else if (value >= 1000 || value <= -1000) {
                                    return value / 1e3 + 'K';
                                } else {
                                    return value;
                                }
                            }
                        },
                        gridLines: {
                            drawBorder: false,
                            zeroLineColor: 'transparent',
                        },
                    }],
                    xAxes: [{
                        ticks: {
                            padding: 20,
                            fontFamily: "Montserrat",
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false,
                            zeroLineColor: 'transparent',
                        },
                    }],
                }
            },
        };


        const myChart2 = new Chart(
            document.getElementById('singleLineChart'),
            config2
        );
    </script>

    {{-- Monthly --}}
    <script>
        pAxis = {!! json_encode($sAxis, JSON_HEX_TAG) !!};
        qAxis = {!! json_encode($rAxis, JSON_HEX_TAG) !!};

        const DATA_COUNT_3 = {!! $counts_month !!};
        const NUMBER_CFG_3 = {
            count: DATA_COUNT_3,
            min: 0,
            max: 100
        };

        const data3 = {
            labels: pAxis,
            datasets: [{
                label: 'Amount',
                data: qAxis,
                borderColor: '#7367f0',
                fill: false,
                pointRadius: 2,
                borderWidth: 2,
                backgroundColor: '#7367f0',
                tension: 0.4,
            }]
        };

        const config3 = {
            type: 'line',
            data: data3,
            options: {
                animations: {
                    radius: {
                        duration: 400,
                        easing: 'linear',
                        loop: (context) => context.active
                    }
                },
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Min and Max Settings'
                    }
                },
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                hover: {
                    mode: 'index',
                },
                legend: {
                    display: false,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 50,
                    }
                },
                tooltips: {
                    mode: 'index',
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return "Tsh " + Number(tooltipItem.yLabel).toFixed(0).replace(/./g,
                                function(c, i, a) {
                                    return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," +
                                        c : c;
                                });
                        }
                    },
                    stepped: true,
                    enabled: true,
                    intersect: false,
                    padding: 20,
                    position: "nearest",
                    backgroundColor: "#FAFAFA",
                    borderColor: "#7367f0",
                    borderWidth: 1,
                    titleFontColor: "black",
                    titleFontStyle: "bold",
                    displayColors: false,
                    bodyFontColor: "black"
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            padding: 20,
                            fontFamily: "Montserrat",
                            callback: function(value, index, values) {
                                if (value >= 1000000000 || value <= -1000000000) {
                                    return value / 1e9 + 'B';
                                } else if (value >= 1000000 || value <= -1000000) {
                                    return value / 1e6 + 'M';
                                } else if (value >= 1000 || value <= -1000) {
                                    return value / 1e3 + 'K';
                                } else {
                                    return value;
                                }
                            }
                        },
                        gridLines: {
                            drawBorder: false,
                            zeroLineColor: 'transparent',
                        },
                    }],
                    xAxes: [{
                        ticks: {
                            padding: 20,
                            fontFamily: "Montserrat",
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false,
                            zeroLineColor: 'transparent',
                        },
                    }],
                }
            },
        };


        const myChart3 = new Chart(
            document.getElementById('monthlyLineChart'),
            config3
        );
    </script>

    {{-- Pie Chart --}}
    <script>
        var data = [{
            data: [{!! $g_w_sum + $e_w_sum !!}, {!! $r_w_sum !!}],
            labels: ["Garage Tools & Other Expense", "Route Revenue"],
            backgroundColor: ['#7367f0', '#00cfe8'],
            borderColor: "#fff",
            borderWidth: 8,
            datalabels: {
                color: '#000',
            },
        }];

        var options = {
            tooltips: {
                mode: 'index',
                stepped: true,
                enabled: true,
                intersect: false,
                padding: 20,
                position: "nearest",
                backgroundColor: "#FAFAFA",
                borderColor: "#7367f0",
                borderWidth: 1,
                titleFontColor: "black",
                titleFontStyle: "bold",
                displayColors: false,
                bodyFontColor: "black",
                callbacks: {
                    label: function(tooltipItem, data) {
                        return "Tsh " + Number(data['datasets'][0]['data'][tooltipItem['index']]).toFixed(0)
                            .replace(
                                /./g,
                                function(c, i, a) {
                                    return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," +
                                        c : c;
                                });
                    }
                },
            },
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    usePointStyle: true,
                    padding: 50,
                }
            },
            animations: {
                radius: {
                    duration: 400,
                    easing: 'linear',
                    loop: (context) => context.active
                }
            },
            responsive: true,

            plugins: {
                datalabels: {
                    formatter: (value, ctx) => {
                        let sum = 0;
                        let dataArr = ctx.chart.data.datasets[0].data;
                        dataArr.map(data => {
                            sum += data;
                        });
                        let percentage = (value * 100 / sum).toFixed(2) + "%";
                        return percentage;
                    },
                    color: '#fff',
                }
            }
        };

        var ctx = document.getElementById("support-trackers-chart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["Garage Tools & Other Expense", "Route Revenue"],
                datasets: data,
            },
            options: options,

        });
    </script>

    {{-- Year --}}
    <script>
        aAxis = {!! json_encode($aAxis, JSON_HEX_TAG) !!};
        bAxis = {!! json_encode($bAxis, JSON_HEX_TAG) !!};

        const DATA_COUNT5 = 12;
        const NUMBER_CFG5 = {
            count: DATA_COUNT5,
            min: 0,
            max: 100
        };

        const data5 = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mar', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct',
                'Nov', 'Dec'
            ],
            datasets: [{
                    label: 'This Year',
                    data: aAxis,
                    borderColor: '#7367f0',
                    pointRadius: 4,
                    borderWidth: 3,
                    fill: false,
                    backgroundColor: '#7367f0',
                    tension: 0.2,
                },
                {
                    label: 'Last Year',
                    data: bAxis,
                    borderColor: '#e1e1e1',
                    fill: false,
                    borderDash: [5, 5],
                    pointRadius: 4,
                    borderWidth: 3,
                    backgroundColor: '#e1e1e1',
                    tension: 0.4,
                },

            ]
        };

        const config5 = {
            type: 'line',
            data: data5,
            options: {
                animations: {
                    radius: {
                        duration: 400,
                        easing: 'linear',
                        loop: (context) => context.active
                    }
                },
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Min and Max Settings'
                    }
                },
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                hover: {
                    mode: 'index',
                },
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 50,
                    }
                },
                tooltips: {
                    mode: 'index',
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return "Tsh " + Number(tooltipItem.yLabel).toFixed(0).replace(/./g,
                                function(c, i, a) {
                                    return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," +
                                        c : c;
                                });
                        }
                    },
                    stepped: true,
                    enabled: true,
                    intersect: false,
                    padding: 20,
                    position: "nearest",
                    backgroundColor: "#FAFAFA",
                    borderColor: "#7367f0",
                    borderWidth: 1,
                    titleFontColor: "black",
                    titleFontStyle: "bold",
                    displayColors: false,
                    bodyFontColor: "black"
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            padding: 20,
                            fontFamily: "Montserrat",
                            callback: function(value, index, values) {
                                if (value >= 1000000000 || value <= -1000000000) {
                                    return value / 1e9 + 'B';
                                } else if (value >= 1000000 || value <= -1000000) {
                                    return value / 1e6 + 'M';
                                } else if (value >= 1000 || value <= -1000) {
                                    return value / 1e3 + 'K';
                                } else {
                                    return value;
                                }
                            }
                        },
                        gridLines: {
                            drawBorder: false,
                            zeroLineColor: 'transparent',
                        },
                    }],
                    xAxes: [{
                        ticks: {
                            padding: 20,
                            fontFamily: "Montserrat",
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false,
                            zeroLineColor: 'transparent',
                        },
                    }],
                }
            },
        };

        const myChart5 = new Chart(
            document.getElementById('yearlyLineChart'),
            config5
        );
    </script>
@endsection
