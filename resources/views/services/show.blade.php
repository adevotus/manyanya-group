@extends('layouts.app')

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Route</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Route Detail</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div id="details" class="col-xl-8 col-lg-7">
                <!-- project card -->
                <div class="card d-block">
                    <div class="card-body">

                        <div class="float-sm-end mb-2 mb-sm-0">
                            <div class="row g-2">
                                <div class="col-auto">

                                </div>
                                <div class="col-auto">

                                </div>
                            </div>
                        </div> <!-- end dropdown-->

                        <div class="clerfix"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Ticket type -->
                                <label class="mt-2 mb-1">Route Name:</label>
                                <p>
                                    <i class="mdi mdi-truck font-18 text-info me-1 align-middle"></i>
                                    <strong>{{ $route->route }}</strong>
                                </p>
                                <!-- end Ticket Type -->
                            </div>

                            <div class="col-md-6">
                                <!-- Ticket type -->
                                <label class="mt-2 mb-1">Route Invoice:</label>
                                <p>
                                    <i class="mdi mdi-credit-card font-18 text-info me-1 align-middle"></i>
                                    <strong>{{ $route->cargo->invoice }}</strong>
                                </p>
                                <!-- end Ticket Type -->
                            </div>
                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-md-6">
                                <!-- assignee -->
                                <label class="mt-2 mb-1">Customer Name:</label>
                                <div class="d-flex align-items-start">
                                    <div class="w-100">
                                        <p><strong>{{ $route->cargo->customername }}</strong></p>
                                    </div>
                                </div>
                                <!-- end assignee -->
                            </div> <!-- end col -->

                            <div class="col-md-6">
                                <!-- Reported by -->
                                <label class="mt-2 mb-1">Customer phone:</label>
                                <div class="d-flex align-items-start">
                                    <div class="w-100">
                                        <p><strong>{{ $route->cargo->customerphone }}</strong></p>
                                    </div>
                                </div>
                                <!-- end Reported by -->
                            </div> <!-- end col -->

                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-md-6">
                                <!-- assignee -->
                                <label class="mt-2 mb-1">Customer Email:</label>
                                <div class="d-flex align-items-start">
                                    <div class="w-100">
                                        <p><strong>{{ $route->cargo->customeremail }}</strong></p>
                                    </div>
                                </div>
                                <!-- end assignee -->
                            </div> <!-- end col -->

                            <div class="col-md-6">
                                <!-- Reported by -->
                                <label class="mt-2 mb-1">Vehicle Details:</label>
                                <div class="d-flex align-items-start">
                                    <div class="w-100">
                                        <p><strong>{{ $route->vehicle->name }} -
                                                {{ $route->vehicle->platenumber }}</strong></p>
                                    </div>
                                </div>
                                <!-- end Reported by -->
                            </div> <!-- end col -->

                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-md-6">
                                <!-- assignee -->
                                <label class="mt-2 mb-1">Created Date :</label>
                                <p> <strong>{{ date('d-m-Y', strtotime($route->created_at)) }}</strong></p>
                                <!-- end assignee -->
                            </div> <!-- end col -->

                            <div class="col-md-6">
                                <!-- assignee -->
                                <label class="mt-2 mb-1">Departure Date :</label>
                                <p> <strong>{{ date('d-m-Y', strtotime($route->date)) }}</strong></p>
                                <!-- end assignee -->
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Status -->
                                <label class="mt-2 form-label">Status :</label>
                                <div class="row">
                                    <div class="col-auto">
                                        <p><strong>{{ ucfirst($route->status) }}</strong></p>
                                    </div>
                                </div>
                                <!-- end Status -->
                            </div> <!-- end col -->

                            <div class="col-md-6">
                                <!-- Priority -->
                                <label class="mt-2 mb-1">Price :</label>
                                <div class="row">
                                    <div class="col-auto">
                                        <p><strong>{{ number_format($route->price) }}</strong></p>
                                    </div>
                                </div>
                                <!-- end Priority -->
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        <label class="mt-4 mb-1">Payment Overview :</label>
                        <div class="row mt-2">
                            <div class="col-md-2">
                                <strong>#</strong>
                            </div>
                            <div class="col-md-4">
                                <strong>Description</strong>
                            </div>
                            <div class="col-md-2">
                                <strong>Method</strong>
                            </div>
                            <div class="col-md-2">
                                <strong>Installed</strong>
                            </div>
                            <div class="col-md-2">
                                <strong>Remaining</strong>
                            </div>
                        </div>
                        <hr>
                        @foreach ($route->payment as $key => $payment)
                            <div class="row mt-2">
                                <div class="col-md-2">
                                    {{ $key + 1 }}
                                </div>
                                <div class="col-md-4">
                                    {{ $payment->description }}
                                </div>
                                <div class="col-md-2">
                                    {{ ucfirst($payment->payment_method) }}
                                </div>
                                <div class="col-md-2">
                                    {{ number_format($payment->installed) }}
                                </div>
                                <div class="col-md-2">
                                    {{ number_format($payment->remaining) }}
                                </div>
                            </div>
                        @endforeach
                        <hr>
                    </div> <!-- end card-body-->

                </div> <!-- end card-->
                <!-- end card-->
            </div> <!-- end col -->

            <div class="col-xl-4 col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 d-grid">
                                <button type="button" class="btn btn-success waves-effect waves-light"
                                    data-bs-toggle="modal" data-bs-target="#con-close-modal">
                                    Send Remainder
                                </button>

                                <div id="con-close-modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                                    style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Send Remainder For Payment</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('route.show', ['id' => $route->id]) }}" method="post">
                                                @csrf
                                                <div class="modal-body p-4">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="">
                                                                <label for="field-7" class="form-label">Message</label>
                                                                <textarea class="form-control @error('message') is-invalid @enderror" rows="13" name="message" id="field-7"
                                                                    placeholder="Write message">Dear {{ $route->cargo->customername }},

It is always a pleasure to have you as our customer!

This email is for remainder of your unfinished installment for item {{ $route->cargo->name }} and the remaining balance to be paid is 100,000

We would appreciate payment of this invoice by 05/11/2019

Thank you,

Manyanya Bursor
                                                                </textarea>
                                                                @error('message')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit"
                                                        class="btn btn-success waves-effect waves-light">Send
                                                        Remainder
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-2 d-grid">
                                <a href="{{ route('route.print', ['id' => $route->id]) }}"
                                    class="btn btn-outline-secondary waves-effect waves-light">
                                    Print Invoice
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
@endsection
