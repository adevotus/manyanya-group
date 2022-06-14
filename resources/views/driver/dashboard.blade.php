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

            @if (is_null(Auth::user()->fname) || is_null(Auth::user()->lname) || is_null(Auth::user()->licence))
                @include('driver.register')
            @else
                @include('driver.home')
            @endif
        </div>
    </div>
@endsection
