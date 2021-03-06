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
                            <li class="breadcrumb-item active">Vehicles</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Registered Vehicles</h4>
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
                                            Add Vehicle</button>
                                    </div>
                                    <div class="col-sm-7">

                                        @error('vehicle_name')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                        @error('registration_no')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                        @error('plate_no')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                        @error('vehicle_condition')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="me-3">
                                    <form action="{{ route('vehicle') }}" method="get">
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
                                        <th>Vehicle Name</th>
                                        <th>Reg #</th>
                                        <th>Plate #</th>
                                        <th>Condition</th>
                                        <th>Create Date</th>
                                        <th style="width: 85px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($vehicles && $vehicles->count() > 0)
                                        @foreach ($vehicles as $key => $vehicle)
                                            <tr>
                                                <td>
                                                    {{ $vehicles->firstItem() + $key }}
                                                </td>
                                                <td class="table-user">
                                                    {{ $vehicle->name }}
                                                </td>
                                                <td>
                                                    {{ $vehicle->reg_number }}
                                                </td>
                                                <td>
                                                    {{ $vehicle->platenumber }}
                                                </td>
                                                <td>
                                                    <span class="badge bg-soft-success text-success">
                                                        {{ $vehicle->condition }}
                                                    </span>

                                                </td>

                                                <td>
                                                    {{ date('Y-m-d', strtotime($vehicle->updated_at)) }}
                                                </td>
                                                <td>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#update-modal{{ $vehicle->id }}"
                                                        class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#delete-modal{{ $vehicle->id }}"
                                                        class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                </td>

                                                @include('layouts.models.vehicles')
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td></td>
                                            <td>No Vehicle Info Found</td>
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
                                    Showing {{ $vehicles->firstItem() }} to {{ $vehicles->lastItem() }} of
                                    {{ $vehicles->total() }} entries</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                {{ $vehicles->links() }}
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
                    <h4 class="modal-title" id="myCenterModalLabel">Add New Vehicle</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body p-4">
                    <form method="POST" action="{{ route('vehicle') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Vehicle Name</label>
                            <input type="text" name="vehicle_name"
                                class="form-control @error('vehicle_name') is-invalid @enderror" id="name"
                                placeholder="Enter vehicle name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Registration Number</label>
                            <input type="text" name="registration_no"
                                class="form-control @error('registration_no') is-invalid @enderror"
                                id="exampleInputEmail1" placeholder="Enter registration number">
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Plate Number</label>
                            <input type="text" name="plate_no"
                                class="form-control @error('plate_no') is-invalid @enderror" id="plate number"
                                placeholder="Enter plate number">
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Condition</label>
                            <input type="text" name="vehicle_condition"
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
@endsection
