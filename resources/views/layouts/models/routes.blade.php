<div id="delete-modal{{ $route->id }}" class="modal fade" tabindex="-1" aria-labelledby="standard-modalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title text-danger" id="myCenterModalLabel">
                    Delete
                    route</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('routes') }}">
                    @method('delete')
                    @csrf

                    <input type="number" hidden name="route_id" hidden value="{{ $route->id }}">

                    <p>
                        Are you sure want to delete route
                        {{ $route->source }}
                        to {{ $route->destination }}.
                    </p>

                    <div class="text-end">
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Delete route</button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="update-modal{{ $route->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">
                    Update
                    route</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('routes') }}">
                    @method('put')
                    @csrf

                    <input type="number" hidden name="route_id" hidden value="{{ $route->id }}">

                    <div class="mb-3">
                        <label for="name" class="form-label">Route Source</label>
                        <input type="text" value="{{ $route->source }}" name="source"
                            class="form-control @error('source') is-invalid @enderror" id="name"
                            placeholder="Enter route source">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Route Destination</label>
                        <input type="text" name="destination" value="{{ $route->destination }}"
                            class="form-control @error('destination') is-invalid @enderror" id="name"
                            placeholder="Enter route destination">
                    </div>

                    <div class="mb-3">
                        <label for="example-select" class="form-label">Select Driver</label>
                        <select class="form-select" name="driver_id" id="example-select">
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}"
                                    {{ $driver->id == $route->driver_id ? 'selected' : '' }}>
                                    {{ $driver->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="example-select" class="form-label">Select Vehicle</label>
                        <select class="form-select" name="vehicle_id" id="example-select">
                            @foreach ($vehicles as $ve)
                                <option value="{{ $ve->id }}"
                                    {{ $ve->id === $route->vehicle_id ? 'selected' : '' }}>
                                    {{ $ve->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="example-select" class="form-label">Select Vehicle</label>
                        <select class="form-select" name="cargo_id" id="example-select">
                            @foreach ($cargos as $car)
                                <option {{ $car->id == $route->cargo_id ? 'selected' : '' }}
                                    value="{{ $car->id }}">
                                    {{ $car->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="text-end">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
