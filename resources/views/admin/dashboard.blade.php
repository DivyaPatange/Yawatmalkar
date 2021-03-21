@extends('admin.admin_layout.main')
@section('title', 'Dashboard')
@section('customcss')

@endsection
@section('page_title', 'Dashboard')
@section('breadcrumb1', 'Home')
@section('breadcrumb2')
<a href="{{ url('/admin') }}">Dashboard</a>
@endsection
@section('content')
<div class="row">
    <!--[ daily sales section ] start-->
    <div class="col-md-6 col-xl-4">
        <div class="card daily-sales">
            <div class="card-block">
                <h6 class="mb-4">Doctors</h6>
                <div class="row d-flex align-items-center">
                    <div class="col-9">
                        <h3 class="f-w-300 d-flex align-items-center m-b-0"><i class="feather icon-arrow-up text-c-green f-30 m-r-10"></i>10</h3>
                    </div>

                    <div class="col-3 text-right">
                        <p class="m-b-0"></p>
                    </div>
                </div>
                <div class="progress m-t-30" style="height: 7px;">
                    <div class="progress-bar progress-c-theme" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <!--[ daily sales section ] end-->
    <!--[ Monthly  sales section ] starts-->
    <div class="col-md-6 col-xl-4">
        <div class="card Monthly-sales">
            <div class="card-block">
                <h6 class="mb-4">Appointment</h6>
                <div class="row d-flex align-items-center">
                    <div class="col-9">
                        <h3 class="f-w-300 d-flex align-items-center  m-b-0"><i class="feather icon-arrow-down text-c-red f-30 m-r-10"></i>30</h3>
                    </div>
                    <div class="col-3 text-right">
                        <p class="m-b-0"></p>
                    </div>
                </div>
                <div class="progress m-t-30" style="height: 7px;">
                    <div class="progress-bar progress-c-theme2" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <!--[ Monthly  sales section ] end-->
</div>
@endsection 
@section('customjs')

@endsection