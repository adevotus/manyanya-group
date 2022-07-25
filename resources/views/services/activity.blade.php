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
                            <li class="breadcrumb-item active">Activies</li>
                        </ol>
                    </div>
                    <h4 class="page-title">All Activies</h4>
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
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="me-3">
                                    <form action="{{ route('activity') }}" method="get">
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
                                        <th>Action</th>
                                        <th>Description</th>
                                        <th>User</th>
                                        <th>Create Date</th>
                                        <th style="width: 85px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($activities && $activities->count() > 0)
                                        @foreach ($activities as $key => $activity)
                                            <tr>
                                                <td>
                                                    {{ $activities->firstItem() + $key }}
                                                </td>

                                                <td class="table-user">
                                                    {{ $activity->action }}
                                                </td>
                                                <td class="table-user">
                                                    {{ $activity->description }}
                                                </td>
                                                <td class="table-user">
                                                    {{ $activity->users->name }}
                                                </td>

                                                <td>
                                                    {{ date('Y-m-d', strtotime($activity->updated_at)) }}
                                                </td>
                                                <td>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#delete-modal{{ $activity->id }}"
                                                        class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                    @include('layouts.models.activity')
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td></td>
                                            <td>No Activities Info Found</td>
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
                                    Showing {{ $activities->firstItem() }} to {{ $activities->lastItem() }} of
                                    {{ $activities->total() }} entries</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                {{ $activities->links() }}
                            </div>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
@endsection
