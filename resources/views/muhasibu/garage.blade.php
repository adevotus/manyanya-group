@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('manager.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Garage</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Garage Tools</h4>
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
                                            <p class="text-success mt-2">{{ Session::get('message') }}</p>
                                        @endif
                                        @error('tool_name')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                        @error('amount')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                        @error('tool_condition')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="me-3">
                                    <form action="{{ route('manager.garages') }}" method="get">
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
                                        <th>Tool Name</th>
                                        <th>Amount</th>
                                        <th>Condition</th>
                                        <th>Create Date</th>
                                        <th style="width: 85px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($garages && $garages->count() > 0)
                                        @foreach ($garages as $key => $garage)
                                            <tr>
                                                <td>
                                                    {{ $garages->firstItem() + $key }}
                                                </td>
                                                <td class="table-user">
                                                    {{ $garage->tool_name }}
                                                </td>
                                                <td>
                                                    {{ number_format($garage->amount) }}
                                                </td>
                                                <td>
                                                    {{ $garage->condition }}
                                                </td>
                                                <td>
                                                    @if ($garage->payment === 'paid')
                                                        Paid
                                                    @else
                                                        Unpaid
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ date('Y-m-d', strtotime($garage->updated_at)) }}
                                                </td>
                                                <td>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#update-modal{{ $garage->id }}"
                                                        class="action-icon"> <i
                                                            class="mdi mdi-square-edit-outline"></i></a>

                                                </td>

                                                <div class="modal fade" id="update-modal{{ $garage->id }}"
                                                    tabindex="-1" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-light">
                                                                <h4 class="modal-title" id="myCenterModalLabel">
                                                                    Update
                                                                    Garage Tool</h4>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-hidden="true"></button>
                                                            </div>
                                                            <div class="modal-body p-4">
                                                                <form method="POST"
                                                                    action="{{ route('muhasibu.garage') }}"
                                                                    enctype="multipart/form-data">
                                                                    @csrf

                                                                    <input type="number" hidden name="garage_id" hidden
                                                                        value="{{ $garage->id }}">


                                                                    <div class="mb-3">
                                                                        <label for="name" class="form-label">Tool
                                                                            Name</label>
                                                                        <input type="text" name="tool_name"
                                                                            value="{{ $garage->tool_name }}" disabled
                                                                            class="form-control @error('tool_name') is-invalid @enderror"
                                                                            id="name" placeholder="Enter tool name">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="name"
                                                                            class="form-label">Amount</label>
                                                                        <input type="number" name="amount"
                                                                            value="{{ $garage->amount }}"
                                                                            class="form-control @error('amount') is-invalid @enderror"
                                                                            id="name" placeholder="Enter tool amount">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="name"
                                                                            class="form-label">Condition</label>
                                                                        <input type="text" name="tool_condition"
                                                                            value="{{ $garage->condition }}" disabled
                                                                            class="form-control @error('tool_condition') is-invalid @enderror"
                                                                            id="name" placeholder="Enter tool condition">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="name" class="form-label">Payment
                                                                            made through?</label>
                                                                        <select class="form-select" name="payment"
                                                                            id="example-select">
                                                                            <option value="paid" selected>Paid
                                                                            </option>
                                                                            <option value="unpaid">Unpaid</option>
                                                                        </select>
                                                                    </div>


                                                                    <div class="text-end">
                                                                        <button type="submit"
                                                                            class="btn btn-success waves-effect waves-light">Update
                                                                            Tool</button>
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
                                            <td>No Tool Info Found</td>
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
                                    Showing {{ $garages->firstItem() }} to {{ $garages->lastItem() }} of
                                    {{ $garages->total() }} entries</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                {{ $garages->links() }}
                            </div>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>

@endsection
