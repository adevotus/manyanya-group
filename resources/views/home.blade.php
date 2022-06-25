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
                <a href="#about" class="nav-item nav-link">About</a>
                <a href="#service" class="nav-item nav-link">Services</a>
                <a href="#blogs" class="nav-item nav-link">Blogs</a>
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

    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5">
        <div class="owl-carousel header-carousel position-relative mb-5">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('home/img/carousel-2.jpg') }}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                    style="background: rgba(6, 3, 21, .5);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h5 class="text-white text-uppercase mb-3 animated slideInDown">Transport & Logistics
                                    Solution</h5>
                                <h1 class="display-3 text-white animated slideInDown mb-4">#1 Place For Your <span
                                        class="text-primary">Cargo Transport</span> Solution</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">
                                    <marquee behavior="" direction="right" style="width: 530px; font-size:20px;">
                                        Welcome to Manyanya
                                        Enterprises Company
                                        LTD. We deliver safely</marquee>

                                </p>
                                <a href="/contact"
                                    class="btn btn-secondary py-md-3 px-md-5 me-3 animated slideInLeft">Read More</a>
                                <a href="#requestTruck"
                                    class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Request Truck</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('home/img/carousel-2.jpg') }}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                    style="background: rgba(6, 3, 21, .5);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h5 class="text-white text-uppercase mb-3 animated slideInDown">Cargo Solution</h5>
                                <h1 class="display-3 text-white animated slideInDown mb-4">#2 Place For Your <span
                                        class="text-primary">Transport</span> Solution</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor
                                    at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea
                                    elitr.</p>
                                <a href="#about" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read
                                    More</a>
                                <a href="/contact"
                                    class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- About Start -->
    <div class="container-fluid overflow-hidden py-5 px-lg-0" id="about">
        <div class="container about py-5 px-lg-0">
            <div class="row g-5 mx-lg-0">
                <div class="col-lg-6 ps-lg-0 wow fadeInLeft" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100 ml-5">
                        <img class="position-absolute img-fluid w-100 h-100 rounded z-depth-2"
                            src="{{ asset('home/img/about.jpg') }}" style="object-fit: cover;" alt="">
                    </div>
                </div>
                <div class="col-lg-6 about-text wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="text-secondary text-uppercase mb-3">About Us</h6>
                    <h1 class="mb-5">Quick Transport and Logistics Service Delivery</h1>
                    <p class="mb-5">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam
                        amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna
                        dolore erat amet</p>
                    <div class="row g-4 mb-5">
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                            <i class="fa fa-globe fa-3x text-secondary mb-3"></i>
                            <h5>Global Coverage</h5>
                            <p class="m-0">Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem
                                diam justo.</p>
                        </div>
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.7s">
                            <i class="fa fa-shipping-fast fa-3x text-secondary mb-3"></i>
                            <h5>On Time Delivery</h5>
                            <p class="m-0">Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem
                                diam justo.</p>
                        </div>
                    </div>
                    <a href="" class="btn btn-secondary py-3 px-5" style="color:black;">Explore More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Service Start -->
    <div class="container-xxl py-5" id="service">
        <div class="container py-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase">Our Services</h6>
                <h1 class="mb-5">Explore Our Services to requerst Truck</h1>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item p-4">
                        <div class="overflow-hidden mb-4">
                            <img class="img-fluid" src="{{ asset('home/img/service-3.jpg') }}" alt="">
                        </div>
                        <h4 class="mb-3">Logistic Transportation</h4>
                        <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                        <a class="btn-slide mt-2" href="#requestTruck"><i
                                class="fa fa-arrow-right"></i><span>Request</span></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item p-4">
                        <div class="overflow-hidden mb-4">
                            <img class="img-fluid" src="{{ asset('home/img/service-3.jpg') }}" alt="">
                        </div>
                        <h4 class="mb-3">Cargo Transport</h4>
                        <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                        <a class="btn-slide mt-2" href="#requestTruck"><i
                                class="fa fa-arrow-right"></i><span>Request</span></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item p-4">
                        <div class="overflow-hidden mb-4">
                            <img class="img-fluid" src="{{ asset('home/img/service-3.jpg') }}" alt="">
                        </div>
                        <h4 class="mb-3">Routing Truck</h4>
                        <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                        <a class="btn-slide mt-2" href="#requestTruck"><i
                                class="fa fa-arrow-right"></i><span>Request</span></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item p-4">
                        <div class="overflow-hidden mb-4">
                            <img class="img-fluid" src="{{ asset('home/img/service-3.jpg') }}" alt="">
                        </div>
                        <h4 class="mb-3">Truck Service</h4>
                        <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                        <a class="btn-slide mt-2" href="#requestTruck"><i
                                class="fa fa-arrow-right"></i><span>Request</span></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item p-4">
                        <div class="overflow-hidden mb-4">
                            <img class="img-fluid" src="{{ asset('home/img/service-5.jpg') }}" alt="">
                        </div>
                        <h4 class="mb-3">Customs Clearance</h4>
                        <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                        <a class="btn-slide mt-2" href="#requestTruck"><i
                                class="fa fa-arrow-right"></i><span>Request</span></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item p-4">
                        <div class="overflow-hidden mb-4">
                            <img class="img-fluid" src="{{ asset('home/img/service-6.jpg') }}" alt="">
                        </div>
                        <h4 class="mb-3">Warehouse Solutions</h4>
                        <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                        <a class="btn-slide mt-2" href="#requestTruck"><i
                                class="fa fa-arrow-right"></i><span>Request</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Fact Start -->
    <div class="container-xxl py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="text-secondary text-uppercase mb-3">Some Facts</h6>
                    <h1 class="mb-5">#1 Place To Manage All Of Your Shipments</h1>
                    <p class="mb-5">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam
                        amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna
                        dolore erat amet</p>
                    <div class="d-flex align-items-center">
                        <i class="fa fa-headphones fa-2x flex-shrink-0 bg-primary p-3 text-white"></i>
                        <div class="ps-4">
                            <h6>Call for any query!</h6>
                            <h3 class="text-primary m-0">+012 345 6789</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row g-4 align-items-center">
                        <div class="col-sm-6">
                            <div class="bg-primary p-4 mb-4 wow fadeIn" data-wow-delay="0.3s">
                                <i class="fa fa-users fa-2x text-white mb-3"></i>
                                <h2 class="text-white mb-2" data-toggle="counter-up">1234</h2>
                                <p class="text-white mb-0">Happy Clients</p>
                            </div>
                            <div class="bg-secondary p-4 wow fadeIn" data-wow-delay="0.5s">
                                <i class="fa fa-ship fa-2x text-white mb-3"></i>
                                <h2 class="text-white mb-2" data-toggle="counter-up">1234</h2>
                                <p class="text-white mb-0">Complete Shipments</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="bg-success p-4 wow fadeIn" data-wow-delay="0.7s">
                                <i class="fa fa-star fa-2x text-white mb-3"></i>
                                <h2 class="text-white mb-2" data-toggle="counter-up">1234</h2>
                                <p class="text-white mb-0">Customer Reviews</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fact End -->



    <!-- blog start -->
    <div class="container-xxl py-5" id="blogs">
        <div class="container py-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase">Blogs & Event and News</h6>
                <h1 class="mb-5">Explore Our event that are accour to us</h1>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item p-4">
                        <div class="overflow-hidden mb-4">
                            <img class="img-fluid" src="{{ asset('home/img/service-3.jpg') }}" alt="">
                        </div>
                        <h4 class="mb-3"> Cargo Transport with Us</h4>
                        <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                        <a class="btn btn-secondary text-center mt-2" href="">
                            <span>Read More</span>
                            <i class="fa fa-arrow-right"></i>

                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service-item p-4">
                        <div class="overflow-hidden mb-4">
                            <img class="img-fluid" src="{{ asset('home/img/service-3.jpg') }}" alt="">
                        </div>
                        <h4 class="mb-3">Truk Management with care </h4>
                        <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                        <a class="btn btn-secondary text-center mt-2" href="">
                            <span>Read More</span>
                            <i class="fa fa-arrow-right"></i>

                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item p-4">
                        <div class="overflow-hidden mb-4">
                            <img class="img-fluid" src="{{ asset('home/img/service-3.jpg') }}" alt="">
                        </div>
                        <h4 class="mb-3">Do have problem of Logistic?</h4>
                        <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                        <a class="btn btn-secondary text-center mt-2" href="">
                            <span>Read More</span>
                            <i class="fa fa-arrow-right"></i>

                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- blog end End -->



    <!-- Quote Start -->
    <div class="container-xxl py-5" id="requestTruck">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="text-secondary text-uppercase mb-3">Request a Truck Here</h6>
                    <h1 class="mb-5">Request A Free Route with an Truck</h1>
                    <p class="mb-5">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam
                        amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo erat amet
                    </p>
                    <div class="d-flex align-items-center">
                        <i class="fa fa-headphones fa-2x flex-shrink-0 bg-secondary p-3 text-white"></i>
                        <div class="ps-4">
                            <h6>Call for any query!</h6>
                            <h3 class="text-dark m-0">+012 345 6789</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="bg-light text-center p-5 wow fadeIn" data-wow-delay="0.5s">

                        <form action="{{ route('home') }}" method="POST">
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
            </div>
        </div>
    </div>
    <!-- Quote End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 wow fadeIn" data-wow-delay="0.1s"
        style="margin-top: 6rem;">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-3">Address</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Dodoma City Tanzania</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+(255) 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@yarongo.com</p>
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
