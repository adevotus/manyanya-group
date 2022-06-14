<div id="delete-modal{{ $cargo->id }}" class="modal fade" tabindex="-1" aria-labelledby="standard-modalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title text-danger" id="myCenterModalLabel">
                    Delete
                    Cargo</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST"
                    action="@role('superadmin') {{ route('admin.cargos') }} @endrole @role('stokekeeper') {{ route('store.cargos') }} @endrole @role('manager') {{ route('manager.cargos') }} @endrole ">
                    @method('delete')
                    @csrf

                    <input type="number" hidden name="cargo_id" hidden value="{{ $cargo->id }}">

                    <p>
                        Are you sure want to delete cargo
                        <strong>{{ $cargo->name }}</strong>
                        with weight <strong> {{ $cargo->weight }}</strong> .
                    </p>

                    <div class="text-end">
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Delete Cargo</button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="update-modal{{ $cargo->id }}" tabindex="-1" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">
                    Update
                    Cargo</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST"
                    action="@role('superadmin') {{ route('admin.cargos') }} @endrole @role('stokekeeper') {{ route('store.cargos') }} @endrole @role('manager') {{ route('manager.cargos') }} @endrole "
                    enctype="multipart/form-data">
                    @method('put')
                    @csrf

                    <input type="number" hidden name="cargo_id" hidden value="{{ $cargo->id }}">

                    <div class="mb-3">
                        <label for="name" class="form-label">Customer Name</label>
                        <input type="text" name="customername" value="{{ $cargo->customername }}"
                            class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="Enter customer name ">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Customer phone</label>
                        <input type="tel" name="customerphone" value="{{ $cargo->customerphone }}"
                            class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="Enter customer phonenumber">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Customer email</label>
                        <input type="email" name="customeremail" value="{{ $cargo->customeremail }}"
                            class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="Enter customer email">
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Cargo Name</label>
                        <input type="text" value="{{ $cargo->name }}" name="name"
                            class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="Enter cargo name">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Cargo Amount</label>
                        <input type="number" value="{{ $cargo->amount }}" name="amount"
                            class="form-control @error('amount') is-invalid @enderror" id="name"
                            placeholder="Enter cargo amount">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Cargo Weight</label>
                        <input type="number" value="{{ $cargo->weight }}" name="weight"
                            class="form-control @error('weight') is-invalid @enderror" id="name"
                            placeholder="Enter cargo weight">
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Update Account</button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light"
                            data-bs-dismiss="modal">Close</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
