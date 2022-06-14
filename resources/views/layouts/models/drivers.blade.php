<div id="delete-modal{{ $driver->id }}" class="modal fade" tabindex="-1" aria-labelledby="standard-modalLabel"
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
                <form method="POST"
                    action="@role('superadmin') {{ route('admin.driver') }} @endrole @role('stokekeeper') {{ route('store.drivers') }} @endrole @role('manager') {{ route('manager.driver') }} @endrole ">
                    @method('delete')
                    @csrf

                    <input type="number" hidden name="driver_id" hidden value="{{ $driver->id }}">

                    <p>
                        Are you sure want to delete driver
                        <strong>{{ $driver->name }}</strong>
                        with email <strong> {{ $driver->email }}</strong> .
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

<div class="modal fade" id="update-modal{{ $driver->id }}" tabindex="-1" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">
                    Update
                    driver</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST"
                    action="@role('superadmin') {{ route('admin.driver') }} @endrole @role('stokekeeper') {{ route('store.drivers') }} @endrole @role('manager') {{ route('manager.driver') }} @endrole "
                    enctype="multipart/form-data">
                    @method('put')
                    @csrf

                    <input type="number" hidden name="driver_id" hidden value="{{ $driver->id }}">

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="name" class="form-label">First Name</label>
                                <input type="text" name="first_name" required value="{{ $driver->fname }}"
                                    class="form-control @error('first_name') is-invalid @enderror" id="name"
                                    placeholder="Enter driver first name">
                            </div>
                            <div class="col-sm-6">
                                <label for="name" class="form-label">Last Name</label>
                                <input type="text" name="last_name" required value="{{ $driver->lname }}"
                                    class="form-control @error('last_name') is-invalid @enderror" id="name"
                                    placeholder="Enter driver last name">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Username</label>
                        <input type="text" value="{{ $driver->name }}" name="name"
                            class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="Enter driver name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" name="email" value="{{ $driver->email }}"
                            class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1"
                            placeholder="Enter driver email">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Phone Number</label>
                        <input type="tel" name="phone_number" value="{{ $driver->phone }}"
                            class="form-control @error('phone_number') is-invalid @enderror" id="exampleInputPhone1"
                            placeholder="Enter driver phone">
                    </div>

                    <div class="mb-3">
                        <label for="example-select" class="form-label">Are Documents Verified?</label>
                        <select class="form-select @error('verified') is-invalid @enderror" name="verified"
                            id="example-select">
                            <option value="yes" {{ $driver->verified === true ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ $driver->verified === false ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="example-fileinput" class="form-label">Birth Certificate*</label>
                        <input type="file" id="example-fileinput" name="certificate"
                            placeholder="select doc, pdf or image file"
                            class="form-control @error('certificate') is-invalid @enderror">
                    </div>


                    <div class="mb-3">
                        <label for="example-fileinput" class="form-label">Licence Document*</label>
                        <input type="file" id="example-fileinput" name="license"
                            placeholder="select doc, pdf or image file"
                            class="form-control @error('license') is-invalid @enderror">
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
