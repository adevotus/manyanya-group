<div id="delete-modal{{ $expense->id }}" class="modal fade" tabindex="-1" aria-labelledby="standard-modalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title text-danger" id="myCenterModalLabel">
                    Delete
                    Expense Spent</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('mechanics.expense') }}">
                    @method('delete')
                    @csrf

                    <input type="number" hidden name="expense_id" hidden value="{{ $expense->id }}">

                    <p>
                        Are you sure want to delete
                        <strong>{{ $expense->description }}</strong>
                        with condition <strong> {{ $expense->amount }}</strong> .
                    </p>

                    <div class="text-end">
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Delete Expense
                            Spent</button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="update-modal{{ $expense->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">
                    Update
                    Expense Spent</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('mechanics.expense') }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf

                    <input type="number" hidden name="expense_id" hidden value="{{ $expense->id }}">


                    <div class="mb-3">
                        <label for="name" class="form-label">Description</label>
                        <input type="text" name="description" value="{{ $expense->description }}"
                            class="form-control @error('description') is-invalid @enderror" id="name"
                            placeholder="Enter description">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Amount Spent</label>
                        <input type="number" name="amount" value="{{ $expense->amount }}"
                            class="form-control @error('amount') is-invalid @enderror" id="name"
                            placeholder="Enter  amount">
                    </div>

                    <div class="mb-3">
                        <label for="example-fileinput" class="form-label">Payment Slip</label>
                        <input type="file" id="example-fileinput" name="payment_slip"
                            placeholder="select doc, pdf or image file"
                            class="form-control @error('payment_slip') is-invalid @enderror">
                    </div>


                    <div class="text-end">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Update Expense</button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light"
                            data-bs-dismiss="modal">Close</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
