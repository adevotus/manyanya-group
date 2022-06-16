<!DOCTYPE html>
<html lang="en">

<head>
    @include('assets.css')
</head>

<body class="loading">
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <div class="card-title text-center">
                                    <h2 style="font-size:medium;font-weight:bold">YARONGA ENTERPRISE <br>
                                        <span class="text-primary">Company Limited</span>
                                    </h2>
                                </div>
                                <p class="text-muted mb-4 mt-3">Enter your email address and we'll send you an email
                                    with instructions to reset your password.</p>
                                <p>
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                </p>
                            </div>

                            <form action="{{ route('password.email') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Email address</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email"
                                        name="email" value="{{ old('email') }}" id="emailaddress" autofocus
                                        required="" placeholder="Enter your email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="text-center d-grid">
                                    <button class="btn btn-primary" type="submit"> Reset Password </button>
                                </div>

                            </form>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-secondary-50">Back to<a href="{{ route('login') }}"
                                    class="text-primary ms-1"><b>login</b></a></p>
                        </div> <!-- end col -->
                    </div>
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
