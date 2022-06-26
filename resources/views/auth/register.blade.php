<!DOCTYPE html>
<html lang="en">

<head>
    @include('assets.css')
</head>

<body class="loading authentication-bg-pattern">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card bg-pattern">

                        <div class="card-body p-4"
                            style=" box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">

                            <div class="text-center w-75 m-auto">
                                <div class="auth-logo">
                                    <a href="/" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('assets/images/small.png') }}" w-50 alt=""
                                                style="width:150px; background:transparent;">
                                        </span>
                                        <h2 style="font-size:20px;font-weight:bold">Register here
                                        </h2>

                                    </a>

                                </div>
                            </div>

                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="mb-2">
                                    <label for="fullname" class="form-label">Full Name</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                        id="fullname" name="name" placeholder="Enter your name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-2">
                                        <label for="emailaddress" class="form-label">Email address</label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="email"
                                            id="emailaddress" name="email" required placeholder="Enter your email">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-2">
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group input-group-merge">
                                                <input type="password" id="password"
                                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                                    placeholder="Enter your password">
                                                <div class="input-group-text" data-password="false">
                                                    <span class="password-eye"></span>
                                                </div>
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <label for="password" class="form-label mt-1">Confirm Password</label>
                                            <div class="input-group input-group-merge">
                                                <input type="password" id="password" class="form-control"
                                                    name="password_confirmation" placeholder="Confirm your password">
                                                <div class="input-group-text" data-password="false">
                                                    <span class="password-eye"></span>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <div class="form-check">
                                                    <input type="checkbox" name="agreement"
                                                        class="form-check-input  @error('agreement') is-invalid @enderror"
                                                        id="checkbox-signup">
                                                    <label class="form-check-label" for="checkbox-signup">I accept <a
                                                            href="javascript: void(0);" class="text-dark">terms and
                                                            conditions</a></label>
                                                </div>
                                                @error('agreement')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @endif
                                                </div>

                                                <div class="text-center d-grid m-2">
                                                    <button class="btn btn-primary" type="submit"> Sign Up </button>
                                                </div>


                                                <div class="col-12 text-center">
                                                    <p class="text-black-50">Already have account? <a href="{{ route('login') }}"
                                                            class="text-black ms-1"><b>Sign
                                                                In</b></a></p>
                                                </div>



                                                <!-- end card -->
                                            </form>

                                        </div> <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                </div>
                                <!-- end container -->
                            </div>
                            <!-- end page -->

                            @include('assets.js')
                </body>

                </html>
