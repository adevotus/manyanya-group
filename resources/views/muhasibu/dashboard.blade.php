@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('muhasibu.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Accountant</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Accountant Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <!-- end row -->
    </div>
@endsection
