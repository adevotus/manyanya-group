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

                        <div class="card-body p-3"
                            style=" box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px; width:100%;">
                            <div class="card-title text-center">
                                <a href="/">
                                    <h2 style="font-size:medium;font-weight:bold">MANYANYA ENTERPRISE <br>
                                        <span class="text-primary">Company Limited</span>
                                    </h2>
                                </a>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3 w-100 justify-content-center">
                                    <label for="emailaddress" class="form-label">Email address</label>
                                    <input class="form-control  @error('email') is-invalid @enderror" type="email"
                                        name="email" id="emailaddress" required="your email"
                                        placeholder="Enter your email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
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

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" {{ old('remember') ? 'checked' : '' }}
                                            class="form-check-input" name="remember" id="checkbox-signin" checked>
                                        <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                    </div>
                                </div>

                                <div class="text-center d-grid">
                                    <button class="btn btn-primary" type="submit"> Log In </button>
                                </div>

                            </form>
                            <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <p>
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}"
                                                class="text-black-50 ms-1">Forgot your password?</a>
                                        @endif
                                    </p>
                                    <p class="text-black-50">Don't have an account? <a href="{{ route('register') }}"
                                            class="text-black-ms-1"><b>Sign Up</b></a></p>
                                </div> <!-- end col -->
                            </div>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->


                    <!-- end row -->

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
