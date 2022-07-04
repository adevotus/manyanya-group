@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">Drivers</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Registered Drivers</h4>
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
                                            Add Driver</button>
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
                                        @error('phone_number')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                        @error('verified')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                        @error('password')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                        @error('license')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                        @error('certificate')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="me-3">
                                    <form action="{{ route('driver') }}" method="get">
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
                                        <th>Phone</th>
                                        <th>License</th>
                                        <th>Certificate</th>
                                        <th>Create Date</th>
                                        <th style="width: 85px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($drivers && $drivers->count() > 0)
                                        @foreach ($drivers as $key => $driver)
                                            <tr>
                                                <td>
                                                    {{ $drivers->firstItem() + $key }}
                                                </td>
                                                <td class="table-user">
                                                    {{ $driver->name }}
                                                </td>
                                                <td class="table-user">
                                                    {{ $driver->fname }}
                                                </td>
                                                <td class="table-user">
                                                    {{ $driver->lname }}
                                                </td>
                                                <td>
                                                    {{ $driver->email }}
                                                </td>
                                                <td>
                                                    {{ $driver->phone }}
                                                </td>

                                                <td>
                                                    <a href="{{ route('license.download', ['id' => $driver->id]) }}"
                                                        class="action-icon">
                                                        <i data-feather="download"></i>
                                                </td>
                                                <td>
                                                    <a href="{{ route('certificate.download', ['id' => $driver->id]) }}"
                                                        class="action-icon">
                                                        <i data-feather="download"></i>
                                                </td>
                                                <td>
                                                    {{ date('Y-m-d', strtotime($driver->updated_at)) }}
                                                </td>
                                                <td>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#update-modal{{ $driver->id }}"
                                                        class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#delete-modal{{ $driver->id }}"
                                                        class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                    @include('layouts.models.drivers')
                                                </td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td></td>
                                            <td>No driver Info Found</td>
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
                                    Showing {{ $drivers->firstItem() }} to {{ $drivers->lastItem() }} of
                                    {{ $drivers->total() }} entries</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                {{ $drivers->links() }}
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
                    <h4 class="modal-title" id="myCenterModalLabel">Add New Driver</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body p-4">
                    <form method="POST" action="{{ route('driver') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" name="name" required
                                class="form-control @error('name') is-invalid @enderror" id="name"
                                placeholder="Enter driver name">
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
                            <label for="exampleInputEmail1" class="form-label">Phone Number</label>
                            <input type="tel" name="phone_number" required
                                class="form-control @error('phone_number') is-invalid @enderror" id="exampleInputPhone1"
                                placeholder="Enter driver phone">
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

                        <div class="mb-3">
                            <label for="example-fileinput" class="form-label">Birth Certificate*</label>
                            <input type="file" id="example-fileinput" name="certificate" required
                                placeholder="select doc, pdf or image file"
                                class="form-control @error('certificate') is-invalid @enderror">
                        </div>


                        <div class="mb-3">
                            <label for="example-fileinput" class="form-label">Licence Document*</label>
                            <input type="file" id="example-fileinput" name="license" required
                                placeholder="select doc, pdf or image file"
                                class="form-control @error('license') is-invalid @enderror">
                        </div>

                        <div class="mb-3">
                            <label for="example-select" class="form-label">Are Documents Verified?</label>
                            <select class="form-select" name="verified" id="example-select">
                                <option value="yes" selected>Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success waves-effect waves-light">Create
                                Account</button>
                            <button type="button" class="btn btn-secondary waves-effect waves-light"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection
