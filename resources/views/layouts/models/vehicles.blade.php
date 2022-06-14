<div id="delete-modal{{ $vehicle->id }}" class="modal fade" tabindex="-1" aria-labelledby="standard-modalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title text-danger" id="myCenterModalLabel">
                    Delete
                    Vehicle</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST"
                    action="@role('superadmin') {{ route('admin.vehicle') }} @endrole @role('stokekeeper') {{ route('store.vehicle') }} @endrole @role('manager') {{ route('manager.vehicle') }} @endrole ">
                    @method('delete')
                    @csrf

                    <input type="number" hidden name="vehicle_id" hidden value="{{ $vehicle->id }}">

                    <p>
                        Are you sure want to delete vehicle
                        {{ $vehicle->name }}
                        with plate number {{ $vehicle->platenumber }}.
                    </p>

                    <div class="text-end">
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Delete Vehicle</button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="update-modal{{ $vehicle->id }}" tabindex="-1" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">
                    Update
                    Vehicle</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST"
                    action="@role('superadmin') {{ route('admin.vehicle') }} @endrole @role('stokekeeper') {{ route('store.vehicle') }} @endrole @role('manager') {{ route('manager.vehicle') }} @endrole ">
                    @method('put')
                    @csrf

                    <input type="number" hidden name="vehicle_id" hidden value="{{ $vehicle->id }}">

                    <div class="mb-3">
                        <label for="name" class="form-label">Vehicle
                            Name</label>
                        <input type="text" name="vehicle_name" value="{{ $vehicle->name }}"
                            class="form-control @error('vehicle_name') is-invalid @enderror" id="name"
                            placeholder="Enter vehicle name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Registration
                            Number</label>
                        <input type="text" name="registration_no" value="{{ $vehicle->reg_number }}"
                            class="form-control @error('registration_no') is-invalid @enderror" id="exampleInputEmail1"
                            placeholder="Enter registration number">
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label">Plate
                            Number</label>
                        <input type="text" name="plate_no" value="{{ $vehicle->platenumber }}"
                            class="form-control @error('plate_no') is-invalid @enderror" id="plate number"
                            placeholder="Enter plate number">
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Condition</label>
                        <input type="text" name="vehicle_condition" value="{{ $vehicle->condition }}"
                            class="form-control @error('vehicle_condition') is-invalid @enderror" id="category"
                            placeholder="Enter vehicle condition">
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
