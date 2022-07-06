<div class="container-xxl py-5" id="requestTruck">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase mb-3">Request a Truck Here</h6>
                <h1 class="mb-5">Request a Route with a Truck</h1>
                <p class="mb-5">To ensure that goods arrive safely and on time, and that the company is
                    constantly aware of the whereabouts of their vehicles.We ensure that the performance of the
                    drivers and vehicles are continuously monitored using multiple surveillance devices that have
                    been installed in all vehicles. Details of each trip are tabulated in order to ensure the safety
                    of the driver, the assistants, the vehicle and the goods that are being transported.
                </p>
                <div class="d-flex align-items-center">
                    <i class="fa fa-headphones fa-2x flex-shrink-0 bg-secondary p-3 text-white"></i>
                    <div class="ps-4">
                        <h6>Please feel free to call us</h6>
                        <h3 class="text-dark m-0">+255 715 307 770</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <h3 class="text-center">Request Quote</h3>
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
                                <input type="text" class="form-control  @error('name') is-invalid @enderror border-0"
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
