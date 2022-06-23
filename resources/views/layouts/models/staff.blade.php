<div id="delete-modal{{ $staff->id }}" class="modal fade" tabindex="-1" aria-labelledby="standard-modalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title text-danger" id="myCenterModalLabel">
                    Delete
                    driver</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action=" {{ route('staff') }} ">
                    @method('delete')
                    @csrf

                    <input type="number" hidden name="staff_id" hidden value="{{ $staff->id }}">

                    <p>
                        Are you sure want to delete user
                        <strong>{{ $staff->name }}</strong>
                        with email <strong> {{ $staff->email }}</strong> .
                    </p>

                    <div class="text-end">
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Delete driver</button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="update-modal{{ $staff->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">
                    Update
                    driver</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action=" {{ route('staff') }} " enctype="multipart/form-data">
                    @method('put')
                    @csrf

                    <input type="number" hidden name="staff_id" hidden value="{{ $staff->id }}">

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="name" class="form-label">First Name</label>
                                <input type="text" name="first_name" required value="{{ $staff->fname }}"
                                    class="form-control @error('first_name') is-invalid @enderror" id="name"
                                    placeholder="Enter driver first name">
                            </div>
                            <div class="col-sm-6">
                                <label for="name" class="form-label">Last Name</label>
                                <input type="text" name="last_name" required value="{{ $staff->lname }}"
                                    class="form-control @error('last_name') is-invalid @enderror" id="name"
                                    placeholder="Enter driver last name">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Username</label>
                        <input type="text" value="{{ $staff->name }}" name="name"
                            class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="Enter driver name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" name="email" value="{{ $staff->email }}"
                            class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1"
                            placeholder="Enter driver email">
                    </div>

                    <div class="mb-3">
                        <label for="example-select" class="form-label">Select Role</label>
                        <select class="form-select  @error('role') is-invalid @enderror" name="role"
                            id="example-select">
                            @role('superadmin')
                                <option value="superadmin"
                                    @foreach ($staff->roles as $role) {{ $role->name === 'superadmin' ? 'selected' : '' }} @endforeach>
                                    Super
                                    Administrator</option>
                            @endrole
                            <option
                                @foreach ($staff->roles as $role) {{ $role->name === 'manager' ? 'selected' : '' }} @endforeach
                                value="manager">Manager</option>
                            <option
                                @foreach ($staff->roles as $role) {{ $role->name === 'mechanics' ? 'selected' : '' }} @endforeach
                                value="mechanics">Mechanics</option>
                            <option
                                @foreach ($staff->roles as $role) {{ $role->name === 'storekeeper' ? 'selected' : '' }} @endforeach
                                value="storekeeper">Store Keeper</option>
                            <option
                                @foreach ($staff->roles as $role) {{ $role->name === 'muhasibu' ? 'selected' : '' }} @endforeach
                                value="muhasibu">Accountant</option>
                        </select>
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
