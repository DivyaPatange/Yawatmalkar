@extends('admin.admin_layout.main')
@section('title', 'Doctors')
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
</style>
@endsection
@section('page_title', 'Add Doctor')
@section('breadcrumb1', 'Home')
@section('breadcrumb2')
<a href="{{ route('admin.doctors.create') }}">Add Doctor</a>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Add Doctor</h5>
            </div>
            <div class="card-body">
                <form method="POST" id="form-submit">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name of Doctor <span style="color:red;">*</span><span  style="color:red" id="doctor_err"> </span></label>
                                <input type="text" name="doctor_name" class="form-control" id="doctor_name" placeholder="Enter Doctor Name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category <span  style="color:red" id="cat_err"> </span></label>
                                <select class="form-control js-example" id="category_id" name="category_id">
                                    <option value="">-Select Category-</option>
                                    @foreach($category as $c)
                                    <option value="{{ $c->id }}">{{ $c->category_name }}</option>
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
                                <label>Contact No. <span  style="color:red" id="contact_err"> </span></label>
                                <input type="number" name="contact_no" class="form-control" id="contact_no" placeholder="Enter Contact No.">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Alternate Contact No. <span  style="color:red" id="alt_contact_err"> </span></label>
                                <input type="number" name="alt_contact_no" class="form-control" id="alt_contact_no" placeholder="Enter Alternate Contact No.">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Aadhar No. <span  style="color:red" id="aadhar_err"> </span></label>
                                <input type="number" name="aadhar_no" class="form-control" id="aadhar_no" placeholder="Enter Aadhar No.">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email Id <span  style="color:red" id="email_err"> </span></label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email Id">
                            </div>
                        </div>
                        <div class="col-md-12">
                        <hr>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Experience <span style="color:red;">*</span><span  style="color:red" id="experience_err"> </span></label>
                                <input type="text" name="experience" class="form-control" id="experience" placeholder="Enter Experience">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Qualification <span  style="color:red" id="qualification_err"> </span></label>
                                <input type="text" name="qualification" class="form-control" id="qualification" placeholder="Enter Qualification">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Specialization <span style="color:red;">*</span><span  style="color:red" id="specialization_err"> </span></label>
                                <input type="text" name="specialization" class="form-control" id="specialization" placeholder="Enter Specialization">
                            </div>
                        </div>
                        <div class="col-md-12">
                        <hr>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Office Address <span  style="color:red" id="office_err"> </span></label>
                                <textarea name="office_addr" class="form-control" id="office_addr"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Residential Address <span  style="color:red" id="residential_err"> </span></label>
                                <textarea name="residential_addr" class="form-control" id="residential_addr"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <hr>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Working Shifts <span style="color:red;">*</span><span  style="color:red" id="work_shift_err"> </span></label>
                                <table class="table table-hover" id="dynamic_field">
                                    <tr>
                                        <td><input type="time" name="from" class="form-control name_list" /></td>
                                        <td><input type="time" name="to" class="form-control name_email"/></td>
                                        <td><button type="button" name="add" id="add" class="btn btn-primary">Add More</button></td>  
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Working Hours <span style="color:red;">*</span><span  style="color:red" id="work_hour_err"> </span></label>
                                <input type="time" name="working_hour" class="form-control" id="working_hour" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Other Profession <span  style="color:red" id="profession_err"> </span></label>
                                <input type="text" name="other_profession" class="form-control" id="other_profession" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date of Birth <span  style="color:red" id="dob_err"> </span></label>
                                <input type="date" name="dob" class="form-control" id="dob" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Expectations From Yawatmalkar <span  style="color:red" id="expectation_err"> </span></label>
                                <input type="text" name="expectation" class="form-control" id="expectation" >
                            </div>
                        </div>
                        <div class="col-md-12">
                        <hr>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Achievements <span  style="color:red" id="achievement_err"> </span></label>
                                <textarea name="achievement" class="form-control" id="achievement"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>About Yourselves <span  style="color:red" id="urself_err"> </span></label>
                                <textarea name="urself" class="form-control" id="urself"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <hr>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Username <span style="color:red;">*</span><span  style="color:red" id="username_err"> </span></label>
                                <input type="text" name="username" class="form-control" id="username" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Password <span style="color:red;">*</span><span  style="color:red" id="password_err"> </span></label>
                                <input type="password" name="password" class="form-control" id="password" >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="button" id="submitForm" class="btn btn-primary">Submit</button>
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
        $("#sub_category_id").append('<option>Select Sub-Category</option>');
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
$(document).ready(function(){
    var i = 1;

    $("#add").click(function(){
    i++;
    $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="time" name="from" class="form-control name_list" /></td><td><input type="time" name="to" class="form-control name_email" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
    });

$(document).on('click', '.btn_remove', function(){  
  var button_id = $(this).attr("id");   
  $('#row'+button_id+'').remove();  
});

});
</script>
<script type=text/javascript>
$('body').on('click', '#submitForm', function () {
    var doctor_name = $("#doctor_name").val();
    var category_id = $("#category_id").val();
    var sub_category_id = $("#sub_category_id").val();
    var contact_no = $("#contact_no").val();
    var alt_contact_no = $("#alt_contact_no").val();
    var aadhar_no = $("#aadhar_no").val();
    var email = $("#email").val();
    var experience = $("#experience").val();
    var qualification = $("#qualification").val();
    var specialization = $("#specialization").val();
    var office_addr = $("#office_addr").val();
    var residential_addr = $("#residential_addr").val();
    var working_hour = $("#working_hour").val();
    var other_profession = $("#other_profession").val();
    var dob = $("#dob").val();
    var expectation = $("#expectation").val();
    var achievement = $("#achievement").val();
    var urself = $("#urself").val();
    var username = $("#username").val();
    var password = $("#password").val();
    var TableData = new Array();
    $('#dynamic_field tr').each(function(row, tr) {
        TableData[row] = {
        "from": $(tr).find("input[name='from']").val(),
        "to": $(tr).find("input[name='to']").val()
        }//tableData[row]
    });
    TableData.shift(); // first row will be empty - so remove
    var Data;
    Data = JSON.stringify(TableData);
    if (doctor_name=="") {
        $("#doctor_err").fadeIn().html("Required");
        setTimeout(function(){ $("#doctor_err").fadeOut(); }, 3000);
        $("#doctor_name").focus();
        return false;
    }
    if (experience=="") {
        $("#experience_err").fadeIn().html("Required");
        setTimeout(function(){ $("#experience_err").fadeOut(); }, 3000);
        $("#experience").focus();
        return false;
    }
    if (specialization=="") {
        $("#specialization_err").fadeIn().html("Required");
        setTimeout(function(){ $("#specialization_err").fadeOut(); }, 3000);
        $("#specialization").focus();
        return false;
    }
    if (Data == "") {
        $("#work_shift_err").fadeIn().html("Required");
        setTimeout(function(){ $("#work_shift_err").fadeOut(); }, 3000);
        return false;
    }
    if (working_hour=="") {
        $("#work_hour_err").fadeIn().html("Required");
        setTimeout(function(){ $("#work_hour_err").fadeOut(); }, 3000);
        $("#working_hour").focus();
        return false;
    }
    if (username=="") {
        $("#username_err").fadeIn().html("Required");
        setTimeout(function(){ $("#username_err").fadeOut(); }, 3000);
        $("#username").focus();
        return false;
    }
    if (password=="") {
        $("#password_err").fadeIn().html("Required");
        setTimeout(function(){ $("#password_err").fadeOut(); }, 3000);
        $("#password").focus();
        return false;
    }
    else
    { 
        $.ajax({
            type:"POST",
            url:"{{ route('admin.category.store') }}",
            data:{doctor_name:doctor_name, category_id:category_id, sub_category_id:sub_category_id, contact_no:contact_no, alt_contact_no:alt_contact_no, aadhar_no:aadhar_no, email:email, experience:experience, qualification:qualification, specialization:specialization, office_addr:office_addr, residential_addr:residential_addr, working_hour:working_hour, other_profession:other_profession, dob:dob, expectation:expectation, achievement:achievement, urself:urself, username:username, password:password, Data:Data},
            cache:false,        
            success:function(returndata)
            {
                document.getElementById("form-submit").reset();
                toastr.success(returndata.success);
            }
        });
    }
})
</script>
@endsection