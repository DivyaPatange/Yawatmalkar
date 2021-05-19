@extends('admin.admin_layout.main')
@section('title', 'Lawyer Schedule')
@section('customcss')
<link href="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<style>
.select2-container .select2-selection--single{
    height:45px;
    padding:10px 20px;
}
.hidden{
    display:none;
}
</style>
@endsection
@section('page_title', 'Add Lawyer Schedule Data')
@section('breadcrumb1', 'Home')
@section('breadcrumb2')
<a href="{{ route('admin.lawyer-schedule.create') }}">Add Lawyer Schedule Data</a>
@endsection
@section('content')
<div class="row" id="firstStep">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Add Lawyer Schedule Data</h5>
            </div>
            <div class="card-body">
                <form method="POST" id="form-submit" action="{{ route('admin.lawyer-schedule.store') }}">
                @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lawyer <span  style="color:red" id="name_err"> </span></label>
                                <select class="form-control js-example" id="name" name="name">
                                    <option value="">-Select Lawyer-</option>
                                    @foreach($users as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Schedule Date <span style="color:red;">*</span><span  style="color:red" id="date_err"> </span></label>
                                <input type="date" name="s_date" class="form-control" id="s_date" placeholder="Enter Schedule Date">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Start Time <span  style="color:red" id="start_time_err"> </span></label>
                                <input type="time" name="start_time" class="form-control" id="start_time" placeholder="Enter Start Time">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>End Time <span  style="color:red" id="end_time_err"> </span></label>
                                <input type="time" name="end_time" class="form-control" id="end_time" placeholder="Enter End Time">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Consulting Time <span  style="color:red" id="time_err"> </span></label>
                                <select class="form-control js-example" id="time" name="time">
                                    <option value="">-Select Consulting Time-</option>
                                    @for($i=30; $i <= 1800; $i = $i+30)
                                        <option value="{{ $i }}">{{ $i }} Minute</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
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
<script src="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function() {
    $('.js-example').select2();
});
</script>
<script type=text/javascript>
$('body').on('click', '#submitForm', function () {
    var name = $("#name").val();
    var s_date = $("#s_date").val();
    var start_time = $("#start_time").val();
    var end_time = $("#end_time").val();
    var time = $("#time").val();
    
    if (name=="") {
        $("#name_err").fadeIn().html("Required");
        setTimeout(function(){ $("#name_err").fadeOut(); }, 3000);
        $("#name").focus();
        return false;
    }
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
@endsection