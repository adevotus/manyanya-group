@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Posts</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Posts & News</h4>
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
                                    <div class="col-sm-5">
                                        <a href="{{ route('posts.create') }}" type="button"
                                            class="btn btn-success waves-effect waves-light"><i
                                                class="mdi mdi-plus-circle me-1"></i> Add
                                            New Post</a>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-6">

                                        <div class="col-6">

                                            @error('tool_name')
                                                <p class="text-danger mt-2">{{ $message }}</p>
                                            @enderror
                                            @error('amount')
                                                <p class="text-danger mt-2">{{ $message }}</p>
                                            @enderror
                                            @error('tool_condition')
                                                <p class="text-danger mt-2">{{ $message }}</p>
                                            @enderror
                                            @error('tool_number')
                                                <p class="text-danger mt-2">{{ $message }}</p>
                                            @enderror
                                            @error('payment_slip')
                                                <p class="text-danger mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="me-3">
                                    <form action="{{ route('posts') }}" method="get">
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
                                        <th>Title</th>
                                        <th>Create Date</th>
                                        <th style="width: 85px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($posts && $posts->count() > 0)
                                        @foreach ($posts as $key => $post)
                                            <tr>
                                                <td>
                                                    {{ $posts->firstItem() + $key }}
                                                </td>
                                                <td class="table-user">
                                                    {{ $post->title }}
                                                </td>
                                                <td>
                                                    {{ date('Y-m-d', strtotime($post->updated_at)) }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('posts.show', ['slug' => $post->slug]) }}"
                                                        class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                    <a href="{{ route('posts.edit', ['slug' => $post->slug]) }}"
                                                        class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#delete-modal{{ $post->id }}"
                                                        class="action-icon"> <i class="mdi mdi-delete"></i></a>

                                                    <div id="delete-modal{{ $post->id }}" class="modal fade"
                                                        tabindex="-1" aria-labelledby="standard-modalLabel"
                                                        style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-light">
                                                                    <h4 class="modal-title text-danger"
                                                                        id="myCenterModalLabel">
                                                                        Delete
                                                                        Post</h4>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-hidden="true"></button>
                                                                </div>
                                                                <div class="modal-body p-4">
                                                                    <form method="POST"
                                                                        action="{{ route('posts.delete', ['slug' => $post->slug]) }}">
                                                                        @method('delete')
                                                                        @csrf

                                                                        <p>
                                                                            Are you sure want to delete post? <br>
                                                                            {{ $post->title }}
                                                                        </p>

                                                                        <div class="text-end">
                                                                            <button type="submit"
                                                                                class="btn btn-danger waves-effect waves-light">Delete
                                                                            </button>
                                                                            <button type="button"
                                                                                class="btn btn-secondary waves-effect waves-light"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td></td>
                                            <td>No Post Info Found</td>
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
                                    Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of
                                    {{ $posts->total() }} entries</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                {{ $posts->links() }}
                            </div>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
@endsection
