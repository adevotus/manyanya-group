@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">{{ Auth::user()->name }}</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-head bg-dark">
                            <h4 class="text-white ml-2" style="margin-left: 20px;">Provide Addition Details</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('driver.home') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">First name</label>
                                            <input type="text" class="form-control" id="firstname" name="first_name"
                                                value="{{ Auth::user()->fname }}" placeholder="Enter first name">
                                            @error('first_name')
                                                <span class="form-text text-danger">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Last name</label>
                                            <input type="text" class="form-control" id="firstname" name="last_name"
                                                value="{{ Auth::user()->lname }}" placeholder="Enter last name">
                                            @error('last_name')
                                                <span class="form-text text-danger">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- end row -->

                                <div class="mb-3">
                                    <label for="firstname" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                                        value="{{ Auth::user()->phone }}" placeholder="Enter last name">
                                    @error('phone_number')
                                        <span class="form-text text-danger">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="mb-3">
                                        <label for="example-fileinput" class="form-label">Driver License</label>
                                        <input type="file" id="license" name="license" placeholder="select image file"
                                            class="form-control @error('license') is-invalid @enderror">
                                        @error('license')
                                            <span class="form-text text-danger">
                                                <small>{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="example-fileinput" class="form-label">Birth Certificate</label>
                                        <input type="file" id="certificate" name="certificate"
                                            placeholder="select image file"
                                            class="form-control @error('certificate') is-invalid @enderror">
                                        @error('certificate')
                                            <span class="form-text text-danger">
                                                <small>{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-home">
                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                            class="mdi mdi-content-save"></i>Save changes</button>
                                </div>

                            </form>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
    </div>
@endsection

</div>
