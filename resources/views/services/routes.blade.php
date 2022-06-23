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
                                    <div class="col-sm-6">
                                        <a href={{ route('routes.add') }}
                                            class="btn btn-success waves-effect waves-light"><i
                                                class="mdi mdi-plus-circle me-1"></i> Add
                                            Add Route</a>
                                    </div>
                                    <div class="col-sm-7">
                                        @if (Session::has('message'))
                                            <p
                                                class="@if (str_contains(Session::get('message'), 'successful')) text-success @else text-danger @endif mt-2">
                                                {{ Session::get('message') }}</p>
                                        @endif

                                        @error('source')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                        @error('destination')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                        @error('cargo_id')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                        @error('vehicle_id')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                        @error('driver_id')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
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
                                        <th>Route Name</th>
                                        <th>Route Fuel</th>
                                        <th>Route Trip</th>
                                        @role('muhasibu')
                                            <th>
                                                Price
                                            </th>
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
                                        <th>Vehicle Model</th>
                                        <th>Item</th>
                                        <th>Weight</th>
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
                                                    {{ $route->route }}
                                                </td>
                                                <td class="table-user">
                                                    {{ $route->fuel }}
                                                </td>
                                                <td class="table-user">
                                                    {{ $route->trip }}
                                                </td>
                                                @role('muhasibu')
                                                    <td>
                                                        {{ number_format($route->price) }}
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
                                                    {{ $route->vehicle->name }}
                                                </td>
                                                <td>
                                                    {{ $route->cargo->name }}
                                                </td>
                                                <td>
                                                    {{ $route->cargo->weight }}
                                                </td>

                                                <td>
                                                    {{ date('Y-m-d', strtotime($route->updated_at)) }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('route.edit', ['id' => $route->id]) }}"
                                                        class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#delete-modal{{ $route->id }}"
                                                        class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                </td>

                                                @include('layouts.models.routes')

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
