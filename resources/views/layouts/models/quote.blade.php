<div id="update-modal{{ $quota->id }}" class="modal fade" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-right">
        <div class="modal-content">
            <div class="modal-header border-0">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="{{ route('update', ['id' => $quota->id]) }}" method="post">
                        @method('put')
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Customer Name</label>
                            <input type="text" name="description" value="{{ $quota->name }}"
                                class="form-control @error('description') is-invalid @enderror" id="name"
                                placeholder="Enter description">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Customer Email</label>
                            <input type="email" name="email" value="{{ $quota->email }}"
                                class="form-control @error('email') is-invalid @enderror" id="name"
                                placeholder="Enter email">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Customer Phone</label>
                            <input type="text" name="phone_number" value="{{ $quota->phone }}"
                                class="form-control @error('phone_number') is-invalid @enderror" id="name"
                                placeholder="Enter phone number">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Reply</label>
                            <textarea rows="15" type="text" name="reply" value="{{ $quota->name }}"
                                class="form-control @error('reply') is-invalid @enderror" id="name" placeholder="Enter reply message"></textarea>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success waves-effect waves-light">Send Email</button>
                            <button type="button" class="btn btn-secondary waves-effect waves-light"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<div id="delete-modal{{ $quota->id }}" class="modal fade" tabindex="-1" aria-labelledby="standard-modalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title text-danger" id="myCenterModalLabel">
                    Delete Message</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('destroy', ['id' => $quota->id]) }}">
                    @method('delete')
                    @csrf

                    <p>
                        Are you sure want to delete
                        <strong>{{ $quota->message }}</strong>
                        from <strong> {{ $quota->name }}</strong> .
                    </p>

                    <div class="text-end">
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Yes, Delete</button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
