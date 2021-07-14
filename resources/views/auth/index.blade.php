@extends('auth.auth_layout.main')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('customcss')


@endsection
@section('content')
@can('manage-roles')
<div class="row">
    <div class="col-lg-3">
        <div class="card">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="ti-clipboard color-success border-success"></i>
                </div>
                <div class="stat-content dib">
                    <div class="stat-text">Today Appointment</div>
                    <div class="stat-digit">10</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="ti-user color-primary border-primary"></i>
                </div>
                <div class="stat-content dib">
                    <div class="stat-text">Total Patient</div>
                    <div class="stat-digit">961</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="ti-layout-grid2 color-pink border-pink"></i>
                </div>
                <div class="stat-content dib">
                    <div class="stat-text">Weekly Appointment</div>
                    <div class="stat-digit">200</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="ti-link color-danger border-danger"></i></div>
                <div class="stat-content dib">
                    <div class="stat-text">Monthly Appointment</div>
                    <div class="stat-digit">681</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endcan
@can('manage-provider')
<div class="row">
    <div class="col-lg-3">
        <div class="card">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="ti-clipboard color-success border-success"></i>
                </div>
                <div class="stat-content dib">
                    <div class="stat-text">Today Products</div>
                    <div class="stat-digit">10</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="ti-user color-primary border-primary"></i>
                </div>
                <div class="stat-content dib">
                    <div class="stat-text">Total Users</div>
                    <div class="stat-digit">961</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="ti-layout-grid2 color-pink border-pink"></i>
                </div>
                <div class="stat-content dib">
                    <div class="stat-text">Order Placed</div>
                    <div class="stat-digit">200</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="ti-link color-danger border-danger"></i></div>
                <div class="stat-content dib">
                    <div class="stat-text">Product Payment</div>
                    <div class="stat-digit">100</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endcan
@endsection 
@section('customjs')

@endsection