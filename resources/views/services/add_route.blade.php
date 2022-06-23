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
                        <div class="row">
                            <form method="POST" action="{{ route('routes.add') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Route Name</label>
                                    <input type="text" name="route_name"
                                        class="form-control @error('route_name') is-invalid @enderror" id="name"
                                        placeholder="Enter route name">
                                    @error('route_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Departure Date</label>
                                    <input type="date" name="departure_date"
                                        class="form-control @error('departure_date') is-invalid @enderror" id="name"
                                        placeholder="Enter route departure date">
                                    @error('departure_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label">Route Fuel</label>
                                    <input type="number" name="fuel"
                                        class="form-control @error('fuel') is-invalid @enderror" id="name"
                                        placeholder="Enter route fuel">
                                    @error('fuel')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Trip</label>
                                    <select class="form-select" name="trip" id="example-select">
                                        <option value="go">Go</option>
                                        <option value="return">Return</option>
                                    </select>
                                    @error('trip')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Select Driver</label>
                                    <select class="form-select" name="driver_id" id="example-select">
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('driver_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Select Vehicle</label>
                                    <select class="form-select" name="vehicle_id" id="example-select">
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('vehicle_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Select Cargo</label>
                                    <div class="row">
                                        <div class="col-md-8 col-xl-8 col-12">
                                            <select class="form-select" name="cargo_id" id="example-select">
                                                @foreach ($cargos as $cargo)
                                                    <option value="{{ $cargo->id }}">{{ $cargo->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('cargo_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-xl-4 col-12">
                                            <button type="button" class="btn btn-success waves-effect waves-light"
                                                data-bs-toggle="modal" data-bs-target="#custom-modal"><i
                                                    class="mdi mdi-plus-circle me-1"></i> Add Cargo</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-success waves-effect waves-light">Create
                                        Route</button>
                                    <button type="button" class="btn btn-secondary waves-effect waves-light"
                                        data-bs-dismiss="modal">Close</button>
                                </div>

                            </form>
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
                    <h4 class="modal-title" id="myCenterModalLabel">Add New Cargo</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body p-4">
                    <form method="POST" action="{{ route('cargos') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Customer Name</label>
                            <input type="text" name="customername"
                                class="form-control @error('name') is-invalid @enderror" id="name"
                                placeholder="Enter customer name ">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Customer phone</label>
                            <input type="tel" name="customerphone"
                                class="form-control @error('name') is-invalid @enderror" id="name"
                                placeholder="Enter customer phonenumber">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Customer email</label>
                            <input type="email" name="customeremail"
                                class="form-control @error('name') is-invalid @enderror" id="name"
                                placeholder="Enter customer email">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Items</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="name" placeholder="Enter cargo item">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Cargo Weight</label>
                            <input type="number" name="weight"
                                class="form-control @error('weight') is-invalid @enderror" id="name"
                                placeholder="Enter cargo weight">
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success waves-effect waves-light">Save Cargo</button>
                            <button type="button" class="btn btn-secondary waves-effect waves-light"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection
