@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('muhasibu.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Cargos</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Registered Cargos</h4>
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
                                        @error('amount')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                        @error('weight')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="me-3">
                                    <form action="{{ route('manager.cargos') }}" method="get">
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
                                        <th>Custome Name</th>
                                        <th>Phone Number</th>
                                        <th>Cargo Details</th>
                                        <th>Amount</th>
                                        <th>Weight</th>
                                        <th>Payment</th>
                                        <th>Create Date</th>
                                        <th style="width: 85px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($cargos && $cargos->count() > 0)
                                        @foreach ($cargos as $key => $cargo)
                                            <tr>
                                                <td>
                                                    {{ $cargos->firstItem() + $key }}
                                                </td>
                                                <td class="table-user">
                                                    {{ $cargo->customername }}
                                                </td>
                                                <td class="table-user">
                                                    {{ $cargo->customername }}
                                                </td>

                                                <td class="table-user">
                                                    {{ $cargo->name }}
                                                </td>

                                                <td>
                                                    {{ number_format($cargo->amount) }}
                                                </td>
                                                <td>
                                                    {{ number_format($cargo->weight) }}
                                                </td>
                                                <td>
                                                    @if ($cargo->payment === 'bank')
                                                        Via Bank
                                                    @elseif ($cargo->payment === 'office')
                                                        Via Office
                                                    @else
                                                        Unpaid
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ date('Y-m-d', strtotime($cargo->updated_at)) }}
                                                </td>
                                                <td>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#update-modal{{ $cargo->id }}"
                                                        class="action-icon"> <i
                                                            class="mdi mdi-square-edit-outline"></i></a>

                                                </td>

                                                <div class="modal fade" id="update-modal{{ $cargo->id }}"
                                                    tabindex="-1" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-light">
                                                                <h4 class="modal-title" id="myCenterModalLabel">
                                                                    Update
                                                                    Cargo Payment</h4>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-hidden="true"></button>
                                                            </div>
                                                            <div class="modal-body p-4">
                                                                <form method="POST"
                                                                    action="{{ route('muhasibu.invoice') }}"
                                                                    enctype="multipart/form-data">
                                                                    @csrf

                                                                    <input type="number" hidden name="cargo_id" hidden
                                                                        value="{{ $cargo->id }}">

                                                                    <div class="mb-3">
                                                                        <label for="name" class="form-label">Customer
                                                                            Name</label>
                                                                        <input type="text" name="customername"
                                                                            value="{{ $cargo->customername }}" disabled
                                                                            class="form-control @error('name') is-invalid @enderror"
                                                                            id="name" placeholder="Enter customer name ">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="name" class="form-label">Customer
                                                                            phone</label>
                                                                        <input type="tel" name="customerphone"
                                                                            value="{{ $cargo->customerphone }}" disabled
                                                                            class="form-control @error('name') is-invalid @enderror"
                                                                            id="name"
                                                                            placeholder="Enter customer phonenumber">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="name" class="form-label">Customer
                                                                            email</label>
                                                                        <input type="email" name="customeremail" disabled
                                                                            value="{{ $cargo->customeremail }}"
                                                                            class="form-control @error('name') is-invalid @enderror"
                                                                            id="name" placeholder="Enter customer email">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="name" class="form-label">Payment
                                                                            made through?</label>
                                                                        <select class="form-select" name="payment_via"
                                                                            id="example-select">
                                                                            <option value="office" selected>Via Office
                                                                            </option>
                                                                            <option value="bank">Via Bank</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="text-end">
                                                                        <button type="submit"
                                                                            class="btn btn-success waves-effect waves-light">Update
                                                                            Account</button>
                                                                        <button type="button"
                                                                            class="btn btn-secondary waves-effect waves-light"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                    </div>

                                                                </form>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div>

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td></td>
                                            <td>No Cargo Info Found</td>
                                            <td></td>
                                            <td></td>
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
                                    Showing {{ $cargos->firstItem() }} to {{ $cargos->lastItem() }} of
                                    {{ $cargos->total() }} entries</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                {{ $cargos->links() }}
                            </div>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>

@endsection
