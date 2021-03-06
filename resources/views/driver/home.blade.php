<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-head bg-white">
                <h4 class="" style="margin-left: 20px;">

                </h4>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-7">
                                <h4>
                                    Total Price: Tsh {{ number_format($price) }}
                                </h4>
                            </div>
                            <div class="col-sm-7">
                                @if (Session::has('message'))
                                    <p
                                        class="@if (str_contains(Session::get('message'), 'successful')) text-success @else text-danger @endif mt-2">
                                        {{ Session::get('message') }}</p>
                                @endif
                                @error('cargo_delivered')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                                @error('driver_status')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="me-3">
                            <form action="{{ route('driver.home') }}" method="get">
                                <div class="row text-end">
                                    <div class="col-sm-5">
                                        <input type="search" name="search" class="form-control my-1 my-md-0"
                                            id="search" placeholder="Search...">
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text" id="range-datepicker" class="form-control flatpickr-input"
                                            name="date" placeholder="2018-10-03 to 2018-10-10" readonly="readonly">
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-success waves-effect waves-light"><i
                                                class="mdi mdi-arrow-right"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- end col-->
                </div>

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap table-striped" id="products-datatable">
                        <thead>
                            <tr>
                                <th style="width: 20px;">
                                    #
                                </th>
                                <th>Route</th>
                                <th>Allowance</th>
                                <th>Vehicle</th>
                                <th>Cargo Name</th>
                                <th>Tons</th>
                                <th>Status</th>
                                <th>Create Date</th>
                                <th style="width: 85px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($routes && $routes->count() > 0)
                                @foreach ($routes as $key => $route)
                                    <tr>
                                        <td>
                                            {{ $routes->firstItem() + $key }}
                                        </td>
                                        <td class="table-user">
                                            {{ $route->route }}
                                        </td>

                                        <td>
                                            {{ number_format($route->drive_allowance) }}
                                        </td>
                                        <td>
                                            {{ $route->vehicle->name }}
                                        </td>
                                        <td>
                                            {{ $route->cargo->name }}
                                        </td>
                                        <td>
                                            {{ $route->cargo->weight }}
                                        </td>
                                        <td>
                                            {{ $route->status }}
                                        </td>
                                        <td>
                                            {{ date('Y-m-d', strtotime($route->updated_at)) }}
                                        </td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#update-modal{{ $route->id }}" class="action-icon">
                                                <i class="mdi mdi-square-edit-outline"></i></a>

                                        </td>

                                        <div id="update-modal{{ $route->id }}" class="modal fade" tabindex="-1"
                                            aria-labelledby="standard-modalLabel" style="display: none;"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light">
                                                        <h4 class="modal-title text-success" id="myCenterModalLabel">
                                                            Driver Status Updates</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-hidden="true"></button>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        <form method="POST"
                                                            action="{{ route('driver.deliver', ['id' => $route->id]) }}">
                                                            @csrf

                                                            <p>
                                                                Please change status to yes if you have already
                                                                delivered the cargo
                                                                <strong>{{ $route->source }}</strong>
                                                                to <strong>{{ $route->destination }}</strong>
                                                                and you are available for the next
                                                                trip

                                                            </p>

                                                            <div class="mb-3">
                                                                <label for="example-select" class="form-label">Have
                                                                    you delivered the cargo?</label>
                                                                <select
                                                                    class="form-select  @error('confirm_delivered') is-invalid @enderror"
                                                                    name="confirm_delivered" id="example-select">
                                                                    <option value="yes" selected>Yes</option>
                                                                    <option value="no">No</option>
                                                                </select>
                                                            </div>

                                                            <div class="text-end">
                                                                <button type="submit"
                                                                    class="btn btn-success waves-effect waves-light">Save
                                                                    Changes</button>
                                                                <button type="button"
                                                                    class="btn btn-secondary waves-effect waves-light"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td></td>
                                    <td>No Route Info Found</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        @if ($routes && $routes->count() > 0)
                            <div class="dataTables_info" id="basic-datatable_info" role="status" aria-live="polite">
                                Showing {{ $routes->firstItem() }} to {{ $routes->lastItem() }} of
                                {{ $routes->total() }} entries</div>
                        @endif
                    </div>
                    <div class="col-sm-12 col-md-7">
                        {{ $routes->links() }}
                    </div>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>
