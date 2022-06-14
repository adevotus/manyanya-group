@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('muhasibu.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Accountant</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Accountant Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Weekly Invoice Chart</h4>
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
                        <h4 class="header-title">Expenses (Driver Price, Garage Tools & Other Prices)</h4>

                        <div class="mt-4 chartjs-chart">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="support-trackers-chart" style="display: block; height: 350px; width: 412px;"
                                class="chartjs-render-monitor" width="824" height="700"></canvas>
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
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">

                                    </div>
                                    <div class="col-sm-7">
                                        @if (Session::has('message'))
                                            <p
                                                class="@if (str_contains(Session::get('message'), 'successful')) text-success @else text-danger @endif mt-2">
                                                {{ Session::get('message') }}</p>
                                        @endif

                                        @error('payment_status')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                        @error('route_price')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="me-3">
                                    <form action="{{ route('muhasibu.home') }}" method="get">
                                        <div class="row text-end">
                                            <div class="col-sm-5">
                                                <input type="search" name="search" class="form-control my-1 my-md-0"
                                                    id="search" placeholder="Search...">

                                            </div>
                                            <div class="col-sm-5">
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
                                        <th>
                                            Price
                                        </th>
                                        <th>Driver Name</th>
                                        <th>Vehicle Model</th>
                                        <th>Cargo</th>
                                        <th>Status</th>
                                        <th>Create Date</th>
                                        <th style="width: 85px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($routes && $routes->count() > 0)
                                        @foreach ($routes as $key => $route)
                                            <tr>
                                                <td>
                                                    {{ $routes->firstItem() + $key }}
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
                                                <td>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#update-modal{{ $route->id }}"
                                                        class="action-icon"> <i
                                                            class="mdi mdi-square-edit-outline"></i></a>
                                                </td>

                                                <div class="modal fade" id="update-modal{{ $route->id }}"
                                                    tabindex="-1" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-light">
                                                                <h4 class="modal-title" id="myCenterModalLabel">
                                                                    Update
                                                                    route</h4>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-hidden="true"></button>
                                                            </div>
                                                            <div class="modal-body p-4">
                                                                <form method="POST"
                                                                    action="{{ route('muhasibu.home') }}">
                                                                    @csrf

                                                                    <input type="number" hidden name="route_id" hidden
                                                                        value="{{ $route->id }}">

                                                                    <div class="mb-3">
                                                                        <label for="name" class="form-label">Route
                                                                            Price</label>
                                                                        <input type="number" value="{{ $route->price }}"
                                                                            name="route_price"
                                                                            class="form-control @error('route_price') is-invalid @enderror"
                                                                            id="name" placeholder="Enter route price">
                                                                    </div>


                                                                    <div class="mb-3">
                                                                        <label for="example-select"
                                                                            class="form-label">Has Payment Made?</label>
                                                                        <select class="form-select" name="payment_status"
                                                                            id="example-select">
                                                                            <option value="pending">Pending</option>
                                                                            <option value="paid">Paid</option>
                                                                            <option value="expired">Expired</option>
                                                                        </select>
                                                                    </div>

                                                                    <h4>Route Details</h4>
                                                                    <ul>
                                                                        <li>
                                                                            Route: From : {{ $route->source }} - To:
                                                                            {{ $route->destination }}
                                                                        </li>
                                                                        <li>
                                                                            Driver Name: {{ $route->driver->name }} -
                                                                            Driver License
                                                                            {{ $route->driver->licence }}
                                                                        </li>
                                                                        <li>
                                                                            Vehicle: {{ $route->vehicle->name }} - Plate
                                                                            Number:
                                                                            {{ $route->vehicle->platenumber }}
                                                                        </li>
                                                                        <li>
                                                                            Cargo: {{ $route->cargo->name }} - Cargo
                                                                            Weight:
                                                                            {{ $route->cargo->weight }}
                                                                        </li>
                                                                    </ul>

                                                                    <div class="text-end">
                                                                        <button type="submit"
                                                                            class="btn btn-success waves-effect waves-light">Save</button>
                                                                        <button type="button"
                                                                            class="btn btn-secondary waves-effect waves-light"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div>
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

                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                @if ($routes && $routes->count() > 0)
                                    <div class="dataTables_info" id="basic-datatable_info" role="status" aria-live="polite">
                                        Showing {{ $routes->firstItem() }} to {{ $routes->lastItem() }} of
                                        {{ $routes->total() }} entries</div>
                                @endif
                            </div>
                            <div class="col-sm-12 col-md-7">
                                {{ $routes->links() }}
                            </div>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
@endsection

@section('js')
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


    <script>
        var data = [{
            data: [8000, 6000, 6000],
            labels: ["Garage Expense", "Driver Expense", "Other Expenses"],
            backgroundColor: ['#7367f0', '#ea5455', '#00cfe8'],
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
                labels: ["Garage Expense", "Driver Expense", "Other Expenses"],
                datasets: data,
            },
            options: options,

        });
    </script>
@endsection
