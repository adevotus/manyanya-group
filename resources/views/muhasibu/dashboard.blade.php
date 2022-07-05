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
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $r_count }}</span></h3>
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
            {{-- <div class="col-md-6 col-xl-3">
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
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">78.41</span>k</h3>
                                    <p class="text-muted mb-1 text-truncate">Today's </p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div>
            </div> --}}
        </div>
        <!-- end row -->

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
                            <canvas id="support-trackers-chart" style="display: block; height: 350px; width: 412px;"
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
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route('muhasibu.home') }}" method="get">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <input type="text" id="range-datepicker" class="form-control flatpickr-input"
                                                name="date" placeholder="2018-10-03 to 2018-10-10" readonly="readonly">
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <h4>
                                            Recently Registered Routes
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
                                        <th>Route Fuel</th>
                                        <th>Price</th>
                                        <th>Driver Name</th>
                                        <th>Vehicle</th>
                                        <th>Cargo</th>
                                        <th>Allowance</th>
                                        <th>Date</th>
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
                                                    {{ number_format($route->drive_allowance) }}
                                                </td>
                                                <td>
                                                    {{ date('Y-m-d', strtotime($route->date)) }}
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
@endsection
