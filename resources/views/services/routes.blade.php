@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Routes</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Registered Routes</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="row">
                                    @role('muhasibu')
                                        <div class="col-sm-4">
                                            <div class="dropdown mt-sm-0 mt-2">
                                                <a class="btn btn-light dropdown-toggle" href="https://example.com"
                                                    id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Export<i class="mdi mdi-chevron-down"></i>
                                                </a>

                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="">
                                                    <a class="dropdown-item"
                                                        href="{{ route('routes.downloadc', ['search' => request()->get('search'), 'date' => request()->get('date')]) }}">CSV</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('routes.downloadx', ['search' => request()->get('search'), 'date' => request()->get('date')]) }}">Excel</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('routes.downloadp', ['search' => request()->get('search'), 'date' => request()->get('date')]) }}">PDF</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endrole
                                    @role('storekeeper')
                                        <div class="col-sm-5">
                                            <a href={{ route('routes.add') }}
                                                class="btn btn-success waves-effect waves-light"><i
                                                    class="mdi mdi-plus-circle me-1"></i> Add
                                                Add Route</a>
                                        </div>
                                    @endrole
                                    @role('manager')
                                        <div class="col-sm-5">
                                            <a href={{ route('routes.add') }}
                                                class="btn btn-success waves-effect waves-light"><i
                                                    class="mdi mdi-plus-circle me-1"></i> Add
                                                Add Route</a>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="dropdown mt-sm-0 mt-2">
                                                <a class="btn btn-light dropdown-toggle" href="https://example.com"
                                                    id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Export<i class="mdi mdi-chevron-down"></i>
                                                </a>

                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="">
                                                    <a class="dropdown-item"
                                                        href="{{ route('routes.downloadc', ['search' => request()->get('search'), 'date' => request()->get('date')]) }}">CSV</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('routes.downloadx', ['search' => request()->get('search'), 'date' => request()->get('date')]) }}">Excel</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('routes.downloadp', ['search' => request()->get('search'), 'date' => request()->get('date')]) }}">PDF</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endrole
                                    @role('superadmin')
                                        <div class="col-sm-5">
                                            <a href={{ route('routes.add') }}
                                                class="btn btn-success waves-effect waves-light"><i
                                                    class="mdi mdi-plus-circle me-1"></i> Add
                                                Add Route</a>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="dropdown mt-sm-0 mt-2">
                                                <a class="btn btn-light dropdown-toggle" href="https://example.com"
                                                    id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Export<i class="mdi mdi-chevron-down"></i>
                                                </a>

                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="">
                                                    <a class="dropdown-item"
                                                        href="{{ route('routes.downloadc', ['search' => request()->get('search'), 'date' => request()->get('date')]) }}">CSV</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('routes.downloadx', ['search' => request()->get('search'), 'date' => request()->get('date')]) }}">Excel</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('routes.downloadp', ['search' => request()->get('search'), 'date' => request()->get('date')]) }}">PDF</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endrole
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h4>Total amount: <strong
                                                class="text-success">{{ number_format($total) }}</strong></h4>
                                        <div class="col-6">
                                            @if (Session::has('message'))
                                                <p class="text-success mt-2">{{ Session::get('message') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="me-3">
                                    <form action="{{ route('routes') }}" method="get">
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
                                        <th>Date</th>
                                        <th>Route Name</th>
                                        <th>Fuel</th>
                                        <th>Trip</th>
                                        <th>Item</th>
                                        <th>Tons</th>
                                        @role('muhasibu')
                                            <th>Total</th>
                                            <th>Method</th>
                                            <th>Mode</th>
                                            <th>Installed</th>
                                            <th>Remaining</th>
                                        @endrole
                                        @role('manager')
                                            <th>
                                                Price
                                            </th>
                                        @endrole
                                        @role('superadmin')
                                            <th>
                                                Price
                                            </th>
                                        @endrole

                                        <th>Driver Name</th>
                                        <th>Allowance</th>
                                        <th>Vehicle Model</th>
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
                                                <td>
                                                    {{ date('Y-m-d', strtotime($route->date)) }}
                                                </td>
                                                <td class="table-user">
                                                    {{ $route->route }}
                                                </td>
                                                <td class="table-user">
                                                    {{ $route->fuel }}
                                                </td>
                                                <td class="table-user">
                                                    {{ ucfirst(trans($route->trip)) }}
                                                </td>
                                                <td>
                                                    {{ ucfirst($route->cargo->name) }}
                                                </td>
                                                <td>
                                                    {{ $route->cargo->weight }}
                                                </td>
                                                @role('muhasibu')
                                                    <td>
                                                        {{ number_format($route->price) }}
                                                    </td>
                                                    <td>
                                                        {{ ucfirst($route->payment_method) }}
                                                    </td>
                                                    <td>
                                                        {{ ucfirst($route->mode) }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($route->i_price) }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($route->r_price) }}
                                                    </td>
                                                @endrole
                                                @role('manager')
                                                    <td>
                                                        {{ number_format($route->price) }}
                                                    </td>
                                                @endrole
                                                @role('superadmin')
                                                    <td>
                                                        {{ number_format($route->price) }}
                                                    </td>
                                                @endrole
                                                <td>
                                                    {{ $route->driver->name }}
                                                </td>
                                                <td>
                                                    {{ number_format($route->drive_allowance) }}
                                                </td>
                                                <td>
                                                    {{ $route->vehicle->name }}
                                                </td>

                                                <td>
                                                    <a href="{{ route('route.edit', ['id' => $route->id]) }}"
                                                        class="action-icon"> <i
                                                            class="mdi mdi-square-edit-outline"></i></a>
                                                    @role('superadmin')
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete-modal{{ $route->id }}"
                                                            class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                        @include('layouts.models.routes')
                                                    @endrole
                                                    @role('manager')
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete-modal{{ $route->id }}"
                                                            class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                        @include('layouts.models.routes')
                                                    @endrole
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

                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                @if ($routes && $routes->count() > 0)
                                    <div class="dataTables_info" id="basic-datatable_info" role="status"
                                        aria-live="polite">
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
