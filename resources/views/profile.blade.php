@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            @role('storekeeper')
                                <li class="breadcrumb-item"><a href="{{ route('store.home') }}">Home</a></li>
                            @endrole
                            <li class="breadcrumb-item active">Profile & Settings</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Profile & Settings</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="card text-center">
                    <div class="card-body">
                        @if (is_null(Auth::user()->profile))
                            <img src="{{ Auth::user()->default_url }}" class="rounded-circle avatar-xxl img-responsive"
                                alt="profile-image" id="imgShow" srcset="">
                        @else
                            <img src="storage/profile/{{ Auth::user()->profile }}"
                                class="rounded-circle avatar-xxl img-responsive" alt="profile-image" id="imgShow" srcset="">
                        @endif

                        <h4 class="mb-0">{{ Auth::user()->name }}</h4>
                        <p class="text-muted">{{ Auth::user()->email }}</p>

                        {{-- <div class="text-start mt-3">
                            <h4 class="font-13 text-uppercase">About Me :</h4>
                            <p class="text-danger font-13 mb-3">
                            <p class="text-danger mb-2 font-13"><strong>UserName :</strong> <span
                                    class="ms-2">Geneva D. McKnight</span></p>

                            <p class="text-danger mb-2 font-13"><strong>Mobile :</strong><span class="ms-2">(123)
                                    123 1234</span></p>

                            <p class="text-danger mb-2 font-13"><strong>Email :</strong> <span
                                    class="ms-2">user@email.domain</span></p>

                            <p class="text-danger mb-1 font-13"><strong>Location :</strong> <span
                                    class="ms-2">USA</span></p>
                        </div> --}}

                    </div>
                </div> <!-- end card -->
            </div> <!-- end col-->

            <div class="col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-body">

                        <div class="tab-content">

                            <div class="tab-pane active" id="settings">
                                <form method="POST" action="{{ route('settings') }}" enctype="multipart/form-data">
                                    @csrf

                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Personal
                                        Info</h5>
                                    @if (Session::has('message'))
                                        <p
                                            class="@if (str_contains(Session::get('message'), 'successful')) text-success @else text-danger @endif mt-2">
                                            {{ Session::get('message') }}</p>
                                    @endif
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="example-fileinput" class="form-label">Profile Picture</label>
                                            <input type="file" id="imgload" accept="image/*" name="profile_picture"
                                                placeholder="select image file"
                                                class="form-control @error('profile_picture') is-invalid @enderror">
                                            @error('profile_picture')
                                                <span class="form-text text-danger">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

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

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="firstname" name="name"
                                                    value="{{ Auth::user()->name }}" placeholder="Enter first name">
                                                @error('name')
                                                    <span class="form-text text-danger">
                                                        <small>{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> <!-- end row -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="useremail" class="form-label">Email Address</label>
                                                <input type="email" class="form-control" id="useremail" name="email"
                                                    placeholder="Enter email" value="{{ Auth::user()->email }}">
                                                @error('email')
                                                    <span class="form-text text-danger">
                                                        <small>{{ $message }}</small>
                                                    </span>
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="text-end">
                                            <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                    class="mdi mdi-content-save"></i>Save changes</button>
                                        </div>
                                </form>

                                <div style="margin-top: 70px;">
                                    <form method="POST" action="{{ route('settings') }}">
                                        @method('put')
                                        @csrf

                                        <h5 class="mb-4 text-uppercase">
                                            <i class="mdi mdi-lock-open-check-outline me-1"></i>
                                            Change Password
                                        </h5>
                                        @if (Session::has('password'))
                                            <p
                                                class="@if (str_contains(Session::get('password'), 'successful')) text-success @else text-danger @endif mt-2">
                                                {{ Session::get('password') }}</p>
                                        @endif
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="useremail" class="form-label">Current Password</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="password" id="password" name="current_password"
                                                            class="form-control  @error('current_password') is-invalid @enderror"
                                                            required="your password"
                                                            placeholder="Enter your current password">
                                                        <div class="input-group-text" data-password="false">
                                                            <span class="password-eye"></span>
                                                        </div>
                                                    </div>
                                                    @error('current_password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="firstname" class="form-label">New Password</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="password" id="password" name="password"
                                                            class="form-control  @error('password') is-invalid @enderror"
                                                            required="your password" placeholder="Enter your password">
                                                        <div class="input-group-text" data-password="false">
                                                            <span class="password-eye"></span>
                                                        </div>
                                                        @error('password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="lastname" class="form-label">Confirm New
                                                        Password</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="password" id="password" name="password_confirmation"
                                                            class="form-control  @error('password') is-invalid @enderror"
                                                            required="your password" placeholder="Confirm your password">
                                                        <div class="input-group-text" data-password="false">
                                                            <span class="password-eye"></span>
                                                        </div>
                                                        @error('password_confirmation')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->


                                        <div class="text-end">
                                            <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                    class="mdi mdi-content-save"></i>Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>


                        </div> <!-- end tab-content -->
                    </div>
                </div> <!-- end card-->

            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div>
@endsection

@section('js')
    <script>
        $('document').ready(function() {
            $("#imgload").change(function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imgShow').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
@endsection
