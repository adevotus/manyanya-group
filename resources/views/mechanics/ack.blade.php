@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Routes</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Registered Routes</h4>
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
                                    <div class="col-sm-6">
                                    </div>
                                    <div class="col-sm-7">
                                        @if (Session::has('message'))
                                            <p
                                                class="@if (str_contains(Session::get('message'), 'successful')) text-success @else text-danger @endif mt-2">
                                                {{ Session::get('message') }}</p>
                                        @endif


                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="me-3">
                                    <form action="{{ route('routes') }}" method="get">
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
                                        <th>Date</th>
                                        <th>Route Name</th>
                                        <th>Fuel</th>
                                        <th>Item</th>
                                        <th>Tons</th>
                                        <th>Driver Name</th>
                                        <th>Vehicle</th>
                                        <th>Description</th>
                                        <th style="width: 85px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($routes && $routes->count() > 0)
                                        @foreach ($routes as $key => $route)
                                            <tr>
                                                <td>
                                                    {{ $routes->firstItem() + $key }}
                                                </td>
                                                <td>
                                                    {{ date('Y-m-d', strtotime($route->date)) }}
                                                </td>
                                                <td class="table-user">
                                                    {{ $route->route }}
                                                </td>
                                                <td class="table-user">
                                                    {{ $route->fuel }}
                                                </td>

                                                <td>
                                                    {{ ucfirst($route->cargo->name) }}
                                                </td>
                                                <td>
                                                    {{ $route->cargo->weight }}
                                                </td>

                                                <td>
                                                    {{ $route->driver->name }}
                                                </td>

                                                <td>
                                                    {{ $route->vehicle->name }}
                                                </td>

                                                <td>
                                                    {{ $route->vehicle_description }}
                                                </td>

                                                <td>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#update-modal{{ $route->id }}"
                                                        class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                </td>


                                                <div class="modal fade" id="update-modal{{ $route->id }}" tabindex="-1"
                                                    style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-light">
                                                                <h4 class="modal-title" id="myCenterModalLabel">
                                                                    Update Vehicle Status</h4>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-hidden="true"></button>
                                                            </div>
                                                            <div class="modal-body p-4">
                                                                <form method="POST"
                                                                    action="{{ route('mechanics.check', ['id' => $route->id]) }}"
                                                                    enctype="multipart/form-data">
                                                                    @csrf

                                                                    <div class="mb-3">
                                                                        <label for="name"
                                                                            class="form-label">Description</label>
                                                                        <textarea type="text" name="description" value="{{ $route->vehicle_description }}" rows="10"
                                                                            class="form-control @error('description') is-invalid @enderror" id="name"
                                                                            placeholder="Enter description of condition on how vehicle was found"></textarea>
                                                                    </div>

                                                                    <div class="text-end">
                                                                        <button type="submit"
                                                                            class="btn btn-success waves-effect waves-light">Update
                                                                            Details</button>
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
                                            <td>No Route Info Found</td>
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
                                @if ($routes && $routes->count() > 0)
                                    <div class="dataTables_info" id="basic-datatable_info" role="status"
                                        aria-live="polite">
                                        Showing {{ $routes->firstItem() }} to {{ $routes->lastItem() }} of
                                        {{ $routes->total() }} entries</div>
                                @endif
                            </div>
                            <div class="col-sm-12 col-md-7">
                                {{ $routes->links() }}
                            </div>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>

@endsection
