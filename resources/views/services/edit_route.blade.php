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
                            <form method="POST" action="{{ route('route.edit', ['id' => $route->id]) }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Route Name</label>
                                    <input type="text" name="route_name" value="{{ $route->route }}"
                                        @role('muhasibu') disabled @endrole
                                        class="form-control @error('route_name') is-invalid @enderror" id="name"
                                        placeholder="Enter route name">
                                    @error('route_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Departure Date</label>
                                    <input type="date" name="departure_date" value="{{ $route->date }}"
                                        @role('muhasibu') disabled @endrole
                                        class="form-control @error('departure_date') is-invalid @enderror" id="name"
                                        placeholder="Enter route departure date">
                                    @error('departure_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label">Route Fuel</label>
                                    <input type="number" name="fuel" value="{{ $route->fuel }}"
                                        @role('muhasibu') disabled @endrole
                                        class="form-control @error('fuel') is-invalid @enderror" id="name"
                                        placeholder="Enter route fuel">
                                    @error('fuel')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                @role('muhasibu')
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Driver Allowance</label>
                                        <input type="number" name="driver_allowance" value="{{ $route->drive_allowance }}"
                                            class="form-control @error('driver_allowance') is-invalid @enderror" id="name"
                                            placeholder="Enter driver allowance">
                                        @error('fuel')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Cargo Name</label>
                                        <input type="text" name="drive_allowance" value="{{ $route->cargo->name }}"
                                            disabled class="form-control @error('drive_allowance') is-invalid @enderror"
                                            id="name" placeholder="Enter driver allowance">
                                        @error('fuel')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Cargo Weight</label>
                                        <input type="number" name="weight" disabled id="weight"
                                            value="{{ $route->cargo->weight }}"
                                            class="form-control toAdd @error('drive_allowance') is-invalid @enderror"
                                            id="name" placeholder="Enter driver allowance">
                                        @error('fuel')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Price Per Tone</label>
                                        <input type="number" id="price" name="price"
                                            value="{{ $route->cargo->amount }}"
                                            class="form-control toAdd @error('price') is-invalid @enderror" id="name"
                                            placeholder="Enter item price per ton">
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Total</label>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input type="number" id="total" name="total"
                                                    value="{{ $route->cargo->total }}" disabled
                                                    class="form-control @error('total') is-invalid @enderror" id="name">
                                                @error('total')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" onclick="calculateTotal();"
                                                    class="btn btn-success">Calculate
                                                    Total</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-select" class="form-label">Payment Mode</label>
                                        <select id="payment_mode" class="form-select" name="payment_mode"
                                            id="example-select">
                                            <option value="full">Full</option>
                                            <option value="installment">Installment</option>
                                        </select>
                                        @error('payment_mode')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3 hideiffull" style="display: none;">
                                        <label for="name" class="form-label">Advance Payment</label>
                                        <input type="number" id="advanced_payment" name="advanced_payment" min="0"
                                            class="form-control toAdd @error('advanced_payment') is-invalid @enderror"
                                            id="name" placeholder="Enter advanced payment">
                                        @error('advanced_payment')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-select" class="form-label">Paid Through</label>
                                        <select class="form-select" name="payment_mode" id="example-select">
                                            <option value="cash">Cash</option>
                                            <option value="bank">Bank</option>
                                            <option value="agent">Agent</option>
                                        </select>
                                        @error('payment_mode')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endrole

                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Trip</label>
                                    <select class="form-select" @role('muhasibu') disabled @endrole name="trip"
                                        id="example-select">
                                        <option value="go" {{ $route->trip == 'go' ? 'selected' : '' }}>Go
                                        </option>
                                        <option value="return" {{ $route->trip == 'return' ? 'selected' : '' }}>
                                            Return</option>
                                    </select>
                                    @error('trip')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Select Driver</label>
                                    <select @role('muhasibu') disabled @endrole class="form-select" name="driver_id"
                                        id="example-select">
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id }}"
                                                {{ $driver->id == $route->driver_id ? 'selected' : '' }}>
                                                {{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('driver_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Select Vehicle</label>
                                    <select @role('muhasibu') disabled @endrole class="form-select" name="vehicle_id"
                                        id="example-select">
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}"
                                                {{ $vehicle->id == $route->vehicle_id ? 'selected' : '' }}>
                                                {{ $vehicle->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('vehicle_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-success waves-effect waves-light">Update
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
@endsection

@section('js')
    <script>
        function calculateTotal() {
            var weight = $('#weight').val();
            var price = $('#price').val()

            $('#total').val(weight * price);
        }
    </script>

    <script>
        $('#payment_mode').change(function() {
            if ($('#payment_mode').val() == 'full') {
                $('.hideiffull').css('display', 'none');
            } else {
                $('.hideiffull').css('display', 'block');
            }
        });
    </script>
@endsection
