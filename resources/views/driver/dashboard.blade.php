@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">{{ Auth::user()->name }}</h4>
                    </div>
                </div>
            </div>

            @include('driver.home')
        </div>
    </div>
@endsection
