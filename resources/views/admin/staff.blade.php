@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Staff</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Registered Staff Members</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <button type="button" class="btn btn-success waves-effect waves-light"
                                            data-bs-toggle="modal" data-bs-target="#custom-modal"><i
                                                class="mdi mdi-plus-circle me-1"></i> Add
                                            New Staff</button>
                                    </div>
                                    <div class="col-sm-7">
                                        @if (Session::has('message'))
                                            <p
                                                class="@if (str_contains(Session::get('message'), 'successful')) text-success @else text-danger @endif mt-2">
                                                {{ Session::get('message') }}</p>
                                        @endif

                                        @error('name')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                        @error('email')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                        @error('password')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                        @error('role')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="me-3">
                                    <form action="{{ route('admin.staff') }}" method="get">
                                        <div class="row text-end">
                                            <div class="col-sm-5">
                                                <input type="search" name="search" class="form-control my-1 my-md-0"
                                                    id="search" placeholder="Search...">

                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" id="range-datepicker"
                                                    class="form-control flatpickr-input" name="date"
                                                    placeholder="2018-10-03 to 2018-10-10" readonly="readonly">
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="submit" class="btn btn-success waves-effect waves-light"><i
                                                        class="mdi mdi-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-striped" id="products-datatable">
                                <thead>
                                    <tr>
                                        <th style="width: 20px;">
                                            #
                                        </th>
                                        <th>Username</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Create Date</th>
                                        <th style="width: 85px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($staffs && $staffs->count() > 0)
                                        @foreach ($staffs as $key => $staff)
                                            <tr>
                                                <td>
                                                    {{ $staffs->firstItem() + $key }}
                                                </td>
                                                <td class="table-user">
                                                    {{ $staff->name }}
                                                </td>
                                                <td class="table-user">
                                                    {{ $staff->fname }}
                                                </td>
                                                <td class="table-user">
                                                    {{ $staff->lname }}
                                                </td>
                                                <td>
                                                    {{ $staff->email }}
                                                </td>
                                                <td>
                                                    @foreach ($staff->roles as $role)
                                                        {{ $role->display_name }}
                                                    @endforeach
                                                </td>

                                                <td>
                                                    {{ date('Y-m-d', strtotime($staff->updated_at)) }}
                                                </td>
                                                <td>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#update-modal{{ $staff->id }}"
                                                        class="action-icon"> <i
                                                            class="mdi mdi-square-edit-outline"></i></a>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#delete-modal{{ $staff->id }}"
                                                        class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                </td>

                                                @include('layouts.models.staff')
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td></td>
                                            <td>No staff Info Found</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="basic-datatable_info" role="status" aria-live="polite">
                                    Showing {{ $staffs->firstItem() }} to {{ $staffs->lastItem() }} of
                                    {{ $staffs->total() }} entries</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                {{ $staffs->links() }}
                            </div>
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
                    <h4 class="modal-title" id="myCenterModalLabel">Add New Staff Member</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body p-4">
                    <form method="POST" action="{{ route('admin.staff') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" name="name" required class="form-control @error('name') is-invalid @enderror"
                                id="name" placeholder="Enter driver name">
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="name" class="form-label">First Name</label>
                                    <input type="text" name="first_name" required
                                        class="form-control @error('first_name') is-invalid @enderror" id="name"
                                        placeholder="Enter driver first name">
                                </div>
                                <div class="col-sm-6">
                                    <label for="name" class="form-label">Last Name</label>
                                    <input type="text" name="last_name" required
                                        class="form-control @error('last_name') is-invalid @enderror" id="name"
                                        placeholder="Enter driver last name">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" name="email" required
                                class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1"
                                placeholder="Enter driver email">
                        </div>

                        <div class="mb-3">
                            <label for="example-select" class="form-label">Select Role</label>
                            <select class="form-select  @error('role') is-invalid @enderror" name="role"
                                id="example-select">
                                <option value="superadmin">Super Administrator</option>
                                <option value="manager">Manager</option>
                                <option value="storekeeper">Store Keeper</option>
                                <option value="muhasibu">Accountant</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" required id="password" name="password"
                                    class="form-control  @error('password') is-invalid @enderror" required="your password"
                                    placeholder="Enter your password">
                                <div class="input-group-text" data-password="false">
                                    <span class="password-eye"></span>
                                </div>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success waves-effect waves-light">Create Account</button>
                            <button type="button" class="btn btn-secondary waves-effect waves-light"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection
