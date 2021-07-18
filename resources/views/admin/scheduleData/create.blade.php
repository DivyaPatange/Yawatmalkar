@extends('admin.admin_layout.main')
@section('title', 'Add Schedule Date')
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
@section('page_title', 'Add Schedule Data')
@section('breadcrumb1', 'Home')
@section('breadcrumb2')
<a href="{{ route('admin.schedule-data.create') }}">Add Schedule Data</a>
@endsection
@section('content')
<div class="row" id="firstStep">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Add Schedule Data</h5>
            </div>
            <div class="card-body">
                <form method="POST" id="form-submit" action="{{ route('admin.schedule-data.store') }}">
                @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category <span  style="color:red" id="category_err"> </span></label>
                                <select class="form-control js-example" id="category_id" name="category_id">
                                    <option value="">-Select Category-</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sub-Category <span  style="color:red" id="sub_cat_err"> </span></label>
                                <select class="form-control js-example" id="sub_category_id" name="sub_category_id">
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Users <span  style="color:red" id="name_err"> </span></label>
                                <select class="form-control js-example" id="name" name="name">
                                
                                </select>
                            </div>
                        </div>
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
                        <div class="col-md-3 serviceDiv hidden">
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
                        <div class="col-md-3 beautyDiv hidden">
                            <div class="form-group">
                                <label>Max Appointment <span  style="color:red" id="appointment_err"> </span></label>
                                <input type="number" name="appointment" class="form-control" id="appointment" placeholder="Enter No. of Appointment">
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
$('#category_id').change(function(){
  var categoryID = $(this).val();  
  if(categoryID){
    $.ajax({
      type:"GET",
      url:"{{url('/admin/get-subcategory-list')}}?category_id="+categoryID,
      success:function(res){        
      if(res){
        $("#sub_category_id").empty();
        $("#sub_category_id").append('<option value="">Select Sub-Category</option>');
        $.each(res,function(key,value){
          $("#sub_category_id").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#sub_category_id").empty();
      }
      }
    });
  }else{
    $("#sub_category_id").empty();
  }   
});

$('#sub_category_id').change(function(){
  var subCategoryID = $(this).val();  
  if(subCategoryID){
    $.ajax({
      type:"GET",
      url:"{{url('/admin/get-users-list')}}?sub_category_id="+subCategoryID,
      success:function(res){        
      if(res){
        $("#name").empty();
        $("#name").append('<option value="">Select User Name</option>');
        $.each(res,function(key,value){
          $("#name").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#name").empty();
      }
      }
    });
  }else{
    $("#name").empty();
  }   
});

$('#category_id').change(function(){
  var categoryID = $(this).val();  
  if(categoryID == 4)
  {
    $('.beautyDiv').removeClass('hidden');
    $('.serviceDiv').addClass('hidden');
  }
  else{
    $('.serviceDiv').removeClass('hidden');
    $('.beautyDiv').addClass('hidden');
  }
})
</script>
<script type=text/javascript>
$('body').on('click', '#submitForm', function () {
    var category_id = $("#category_id").val();
    var sub_category_id = $("#sub_category_id").val();
    var name = $("#name").val();
    var s_date = $("#s_date").val();
    var start_time = $("#start_time").val();
    var end_time = $("#end_time").val();
    var time = $("#time").val();
    
    if (category_id=="") {
        $("#category_err").fadeIn().html("Required");
        setTimeout(function(){ $("#category_err").fadeOut(); }, 3000);
        $("#category_id").focus();
        return false;
    }
    if (sub_category_id=="") {
        $("#sub_cat_err").fadeIn().html("Required");
        setTimeout(function(){ $("#sub_cat_err").fadeOut(); }, 3000);
        $("#sub_category_id").focus();
        return false;
    }
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