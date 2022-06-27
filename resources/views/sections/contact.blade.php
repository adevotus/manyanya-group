<!DOCTYPE html>
<html lang="en">

<head>
    @include('assets.homecss')
</head>

<body>
    <!-- Spinner Start -->
    <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> -->
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <!-- Navbar Start -->
    <nav
        class="navbar navbar-expand-lg bg-white navbar-light shadow border-top border-2 border-secondary sticky-top p-0">
        <a href="#" class="navbar-brand bg-secondary d-flex align-items-center px-4 px-lg-5">
            <h2 class="mb-2 text-white text-break text-small" style="font-size: small; color:black;">Manyanya
                Enterprises
            </h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="/" class="nav-item nav-link">Home</a>
                <a href="/" class="nav-item nav-link">About</a>
                <a href="/" class="nav-item nav-link">Services</a>
                <a href="/" class="nav-item nav-link">Blogs</a>
                <a href="/contact" class="nav-item nav-link">Contact</a>
            </div>
            <div class="text-center text-secondary p-3 mr-2  text-black"
                style=" margin-right: 5%; background-color:rgb(245, 246, 248); font-weight:bold; margin-left:5%;box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 2px, rgba(0, 0, 0, 0.07) 0px 2px 4px, rgba(0, 0, 0, 0.07) 0px 4px 8px, rgba(0, 0, 0, 0.07) 0px 8px 16px, rgba(0, 0, 0, 0.07) 0px 16px 32px, rgba(0, 0, 0, 0.07) 0px 32px 64px;">
                <a href="{{ route('login') }}" type="button" class="text-uppercase  p-2" style="font-size: small; ">
                    Login <i class="fas fa-sign-in-alt"></i></a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5" style="margin-bottom: 6rem;">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Contact Us</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-fluid overflow-hidden py-5 px-lg-0">
        <div class="container contact-page py-5 px-lg-0">
            <div class="row g-5 mx-lg-0">
                <div class="col-md-6 contact-form wow fadeIn" data-wow-delay="0.1s">
                    <h6 class="text-secondary text-uppercase">Send your message Here</h6>
                    <h1 class="mb-4">Contact For Any enquery</h1>
                    <p class="mb-4">The contact form is currently. Get a functional and working Just e code and you're
                        done.
                    </p>
                    <div class="bg-light p-4">
                        <form method="POST" action="{{ route('home') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    @if (Session::has('message'))
                                        <p
                                            class="@if (str_contains(Session::get('message'), 'successful')) text-success @else text-danger @endif mt-2">
                                            {{ Session::get('message') }}</p>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <input type="text"
                                        class="form-control  @error('name') is-invalid @enderror border-0"
                                        name="name" placeholder="Your Name" style="height: 55px;">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <input type="email" name="email"
                                        class="form-control  @error('email') is-invalid @enderror border-0"
                                        placeholder="Your Email" style="height: 55px;">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <input type="text" name="phone_number"
                                        class="form-control  @error('phone_number') is-invalid @enderror border-0"
                                        placeholder="Your Mobile" style="height: 55px;">
                                    @error('phone_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <textarea rows="6" class="form-control  @error('message') is-invalid @enderror border-0" name="message"
                                        placeholder="Message"></textarea>
                                    @error('message')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-secondary w-100 py-3" type="submit">Request here</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- <div class="col-md-6 pe-lg-0 wow fadeInRight" data-wow-delay="0.1s">
                    <div class="position-relative h-100">
                        <iframe class="position-absolute w-100 h-100" style="object-fit: cover;"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                            frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0">
                        </iframe>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Contact End -->
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 wow fadeIn" data-wow-delay="0.1s"
        style="margin-top: 6rem;">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-3">Address</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Songwe Tanzania</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+(255) 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@manyanyasgroup.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-3">Services</h4>
                    <a class="btn btn-link" href="#">Logistic Solutions</a>
                    <a class="btn btn-link" href="#">Industry solutions</a>
                    <a class="btn btn-link" href="">Cargo Transportation</a>
                    <a class="btn btn-link" href="">Truck Request</a>


                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-3">Quick Links</h4>
                    <a class="btn btn-link" href="#">About Us</a>
                    <a class="btn btn-link" href="#">Contact Us</a>
                    <a class="btn btn-link" href="#">Our Services</a>
                    <a class="btn btn-link" href="#">Terms & Condition</a>
                    <a class="btn btn-link" href="#">Support</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-3">Manyanya Enterprises</h4>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est Lorem ipsum dolor sit amet consectetur
                        adipisicing
                        expedita tempor.</p>

                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        Designed and mentained by <a class="border-bottom" href="#">Manyanya Enterprises</a>
                        &copy;
                        2022 All Right Reserved.
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"><i
            class="bi bi-arrow-up"></i></a>

    @include('assets.homejs')
</body>

</html>
