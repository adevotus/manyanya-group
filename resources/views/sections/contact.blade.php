<!DOCTYPE html>
<html lang="en">

<head>
    @include('assets.homecss')
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-info" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <!-- Navbar Start -->
    @include('sections.navbar')
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
    <div class="container overflow-hidden py-5 px-lg-0">
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
                <div class="col-md-6 pe-lg-0 wow fadeInRight" data-wow-delay="0.1s">
                    <div class="position-relative h-100">
                        <iframe class="position-absolute w-100 h-100"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125992.91674582715!2d32.73154224349461!3d-9.308559633065016!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19073f2845891f95%3A0x84267d0fb6dd7246!2sTunduma!5e0!3m2!1sen!2stz!4v1657200124416!5m2!1sen!2stz"
                            frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
    @include('sections.footer')
    @include('assets.homejs')
</body>

</html>
