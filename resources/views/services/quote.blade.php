@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Customer Quote</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Quote</h4>
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
                                        @if (Session::has('message'))
                                            <p class="text-success mt-2">{{ Session::get('message') }}</p>
                                        @endif
                                        @error('reply')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                        @error('price')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                        @error('name')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                        @error('phone_number')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                        @error('email')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="me-3">
                                    <div class="row text-end">
                                        <div class="col-sm-5">
                                            <input type="search" name="search" class="form-control my-1 my-md-0"
                                                id="search" placeholder="Search...">

                                        </div>
                                        <div class="col-sm-5">
                                            <input type="text" id="range-datepicker" class="form-control flatpickr-input"
                                                name="date" placeholder="2018-10-03 to 2018-10-10" readonly="readonly">
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-success waves-effect waves-light"><i
                                                    class="mdi mdi-arrow-right"></i></button>
                                        </div>
                                    </div>
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
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Customer Phone</th>
                                        <th>Message</th>
                                        <th>Reply</th>
                                        <th>Create Date</th>
                                        <th style="width: 85px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($quotas && $quotas->count() > 0)
                                        @foreach ($quotas as $key => $quota)
                                            <tr>
                                                <td>
                                                    {{ $quotas->firstItem() + $key }}
                                                </td>
                                                <td class="table-user">
                                                    {{ $quota->name }}
                                                </td>
                                                <td class="table-user">
                                                    {{ $quota->email }}
                                                </td>
                                                <td class="table-user">
                                                    {{ $quota->phone }}
                                                </td>
                                                <td class="table-user">
                                                    {{ $quota->message }}
                                                </td>

                                                <td class="table-user">
                                                    @if (is_null($quota->reply))
                                                        Not Yet
                                                    @else
                                                        {{ $quota->reply }}
                                                    @endif
                                                </td>

                                                <td>
                                                    {{ date('Y-m-d', strtotime($quota->updated_at)) }}
                                                </td>
                                                <td>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#update-modal{{ $quota->id }}"
                                                        class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#delete-modal{{ $quota->id }}"
                                                        class="action-icon"> <i class="mdi mdi-delete"></i></a>

                                                    @include('layouts.models.quote')
                                                </td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td></td>
                                            <td>No Data Info Found</td>
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
                                    Showing {{ $quotas->firstItem() }} to {{ $quotas->lastItem() }} of
                                    {{ $quotas->total() }} entries</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                {{ $quotas->links() }}
                            </div>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>

@endsection
