@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
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
                                        <button type="button" class="btn btn-success waves-effect waves-light"
                                            data-bs-toggle="modal" data-bs-target="#custom-modal"><i
                                                class="mdi mdi-plus-circle me-1"></i> Add
                                            Add Route</button>
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
                                    <form action="{{ route('admin.routes') }}" method="get">
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

    <div class="modal fade" id="custom-modal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title" id="myCenterModalLabel">Add New Route</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body p-4">
                    <form method="POST" action="{{ route('admin.routes') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Route Source</label>
                            <input type="text" name="source" class="form-control @error('source') is-invalid @enderror"
                                id="name" placeholder="Enter route source">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Route Destination</label>
                            <input type="text" name="destination"
                                class="form-control @error('destination') is-invalid @enderror" id="name"
                                placeholder="Enter route destination">
                        </div>

                        <div class="mb-3">
                            <label for="example-select" class="form-label">Select Driver</label>
                            <select class="form-select" name="driver_id" id="example-select">
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="example-select" class="form-label">Select Vehicle</label>
                            <select class="form-select" name="vehicle_id" id="example-select">
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="example-select" class="form-label">Select Cargo</label>
                            <select class="form-select" name="cargo_id" id="example-select">
                                @foreach ($cargos as $cargo)
                                    <option value="{{ $cargo->id }}">{{ $cargo->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success waves-effect waves-light">Create Route</button>
                            <button type="button" class="btn btn-secondary waves-effect waves-light"
                                data-bs-dismiss="modal">Close</button>
                        </div>

                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection
