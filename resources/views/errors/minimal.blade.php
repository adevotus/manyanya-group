<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> @yield('title') | @yield('code')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    @include('assets.css')

</head>

<body class="loading ">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="auth-logo">
                                <div class="card-title text-center">
                                    <a href="/">
                                        <h2 style="font-size:medium;font-weight:bold">YARONGA ENTERPRISE <br>
                                            <span class="text-primary">Company Limited</span>
                                        </h2>
                                    </a>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <h1 class="text-error">@yield('code')</h1>
                                <h3 class="mt-3 mb-2">@yield('message')</h3>
                                <p class="text-muted mb-3">Why not try refreshing your page? or you can contact <a
                                        href="" class="text-dark"><b> Support</b></a></p>

                                <a href="/" class="btn btn-success waves-effect waves-light">Back to Home</a>
                            </div>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

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
