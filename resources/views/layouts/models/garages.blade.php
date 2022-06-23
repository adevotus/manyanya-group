<div id="delete-modal{{ $garage->id }}" class="modal fade" tabindex="-1" aria-labelledby="standard-modalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title text-danger" id="myCenterModalLabel">
                    Delete
                    Garage Tool</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('garages') }}">
                    @method('delete')
                    @csrf

                    <input type="number" hidden name="garage_id" hidden value="{{ $garage->id }}">

                    <p>
                        Are you sure want to delete garage tool
                        <strong>{{ $garage->tool_name }}</strong>
                        with condition <strong> {{ $garage->condition }}</strong> .
                    </p>

                    <div class="text-end">
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Delete Tool</button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="update-modal{{ $garage->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">
                    Update
                    Garage Tool</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('garages') }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf

                    <input type="number" hidden name="garage_id" hidden value="{{ $garage->id }}">


                    <div class="mb-3">
                        <label for="name" class="form-label">Tool Name</label>
                        <input type="text" name="tool_name" value="{{ $garage->tool_name }}"
                            class="form-control @error('tool_name') is-invalid @enderror" id="name"
                            placeholder="Enter tool name">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Amount</label>
                        <input type="number" name="amount" value="{{ $garage->amount }}"
                            class="form-control @error('amount') is-invalid @enderror" id="name"
                            placeholder="Enter tool amount">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Condition</label>
                        <input type="text" name="tool_condition" value="{{ $garage->condition }}"
                            class="form-control @error('tool_condition') is-invalid @enderror" id="name"
                            placeholder="Enter tool condition">
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Tool Number</label>
                        <input type="text" name="tool_number" value="{{ $garage->tool_no }}"
                            class="form-control @error('tool_number') is-invalid @enderror" id="name"
                            placeholder="Enter tool number">
                    </div>

                    <div class="mb-3">
                        <label for="example-fileinput" class="form-label">Payment Slip</label>
                        <input type="file" id="example-fileinput" name="payment_slip"
                            placeholder="select doc, docx, pdf or image file"
                            class="form-control @error('payment_slip') is-invalid @enderror">
                    </div>


                    <div class="text-end">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Update Tool</button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light"
                            data-bs-dismiss="modal">Close</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
