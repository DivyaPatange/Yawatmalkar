@extends('auth.auth_layout.main')
@section('title', 'Schedule')
@section('page_title', 'Add Schedule Data')
@section('customcss')


@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" id="form-submit" action="{{ route('user.schedule.store') }}">
                @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Schedule Date <span style="color:red;">*</span><span  style="color:red" id="date_err"> </span></label>
                                <input type="date" name="s_date" class="form-control" id="s_date" placeholder="Enter Schedule Date">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Start Time <span  style="color:red" id="start_time_err"> </span></label>
                                <input type="time" name="start_time" class="form-control" id="start_time" placeholder="Enter Start Time">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>End Time <span  style="color:red" id="end_time_err"> </span></label>
                                <input type="time" name="end_time" class="form-control" id="end_time" placeholder="Enter End Time">
                            </div>
                        </div>
                        @can('manage-users')
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Consulting Time <span  style="color:red" id="time_err"> </span></label>
                                <select class="form-control js-example" id="time" name="time">
                                    <option value="">-Select Consulting Time-</option>
                                    @for($i=5; $i <= 30; $i = $i+5)
                                        <option value="{{ $i }}">{{ $i }} Minute</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        @endcan
                        @can('manage-beauty')
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Max. Appointment <span  style="color:red" id="appointment_err"> </span></label>
                                <input type="number" class="form-control" id="appointment" name="appointment" placeholder="Max. Appointment">
                            </div>
                        </div>
                        @endcan
                        <div class="col-md-12">
                        <hr>
                        </div>
                        <div class="col-md-12">
                            <button type="button" id="submitForm" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 
@section('customjs')
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
@can('manage-users')
<script type=text/javascript>
$('body').on('click', '#submitForm', function () {
    var s_date = $("#s_date").val();
    var start_time = $("#start_time").val();
    var end_time = $("#end_time").val();
    var time = $("#time").val();
    
    if (s_date=="") {
        $("#date_err").fadeIn().html("Required");
        setTimeout(function(){ $("#date_err").fadeOut(); }, 3000);
        $("#s_date").focus();
        return false;
    }
    if (start_time == "") {
        $("#start_time_err").fadeIn().html("Required");
        setTimeout(function(){ $("#start_time_err").fadeOut(); }, 3000);
        $("start_time").focus();
        return false;
    }
    if (end_time == "") {
        $("#end_time_err").fadeIn().html("Required");
        setTimeout(function(){ $("#end_time_err").fadeOut(); }, 3000);
        $("end_time").focus();
        return false;
    }
    if (time=="") {
        $("#time_err").fadeIn().html("Required");
        setTimeout(function(){ $("#time_err").fadeOut(); }, 3000);
        $("#time").focus();
        return false;
    }
    else
    { 
        $("#form-submit").submit();
    }
})
</script>
@endcan 

@can('manage-beauty')
<script type=text/javascript>
$('body').on('click', '#submitForm', function () {
    var s_date = $("#s_date").val();
    var start_time = $("#start_time").val();
    var end_time = $("#end_time").val();
    var appointment = $("#appointment").val();
    
    if (s_date=="") {
        $("#date_err").fadeIn().html("Required");
        setTimeout(function(){ $("#date_err").fadeOut(); }, 3000);
        $("#s_date").focus();
        return false;
    }
    if (start_time == "") {
        $("#start_time_err").fadeIn().html("Required");
        setTimeout(function(){ $("#start_time_err").fadeOut(); }, 3000);
        $("start_time").focus();
        return false;
    }
    if (end_time == "") {
        $("#end_time_err").fadeIn().html("Required");
        setTimeout(function(){ $("#end_time_err").fadeOut(); }, 3000);
        $("end_time").focus();
        return false;
    }
    if (appointment=="") {
        $("#appointment_err").fadeIn().html("Required");
        setTimeout(function(){ $("#appointment_err").fadeOut(); }, 3000);
        $("#appointment").focus();
        return false;
    }
    else
    { 
        $("#form-submit").submit();
    }
})
</script>
@endcan
@endsection