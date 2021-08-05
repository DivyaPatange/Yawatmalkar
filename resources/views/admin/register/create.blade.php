@extends('admin.admin_layout.main')
@section('title', 'Registration Form')
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
@section('page_title', 'Registration Form')
@section('breadcrumb1', 'Home')
@section('breadcrumb2')
<a href="{{ route('admin.register.create') }}">Registration Form</a>
@endsection
@section('content')
<div class="row" id="firstStep">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Registration Form</h5>
            </div>
            <div class="card-body">
                <form method="POST" id="form-submit">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Full Name <span style="color:red;">*</span><span  style="color:red" id="name_err"> </span></label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Full Name">
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
                        <input type="hidden" id="category_type">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Role Type <span  style="color:red" id="role_err"> </span></label>
                                <select name="role" class="form-control" id="role">
                                    <option value="">-Select Role-</option>
                                    <option value="doctor">Doctor</option>
                                    <option value="lawyer">Lawyer</option>
                                    <option value="beautician">Beautician</option>
                                    <option value="provider">Provider</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <hr>
                        </div>
                        <div class="col-md-4 doctorDiv">
                            <div class="form-group">
                                <label>Experience <span style="color:red;">*</span><span  style="color:red" id="experience_err"> </span></label>
                                <input type="text" name="experience" class="form-control" id="experience" placeholder="Enter Experience">
                            </div>
                        </div>
                        <div class="col-md-4 doctorDiv">
                            <div class="form-group">
                                <label>Qualification <span  style="color:red" id="qualification_err"> </span></label>
                                <input type="text" name="qualification" class="form-control" id="qualification" placeholder="Enter Qualification">
                            </div>
                        </div>
                        <div class="col-md-4 doctorDiv">
                            <div class="form-group">
                                <label>Specialization <span style="color:red;">*</span><span  style="color:red" id="specialization_err"> </span></label>
                                <input type="text" name="specialization" class="form-control" id="specialization" placeholder="Enter Specialization">
                            </div>
                        </div>
                        <div class="col-md-6 dailyNeed hidden">
                            <div class="form-group">
                                <label>Years in Business <span class="text-danger" id="busi_year_err"></span></label>
                                <input type="text" name="busi_year" class="form-control" id="busi_year">
                            </div>
                        </div>
                        <div class="col-md-6 dailyNeed hidden">
                            <div class="form-group">
                                <label>Products Served With Capacity</label>
                                <input type="text" name="serve_capacity" class="form-control" id="serve_capacity">
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
                                    <tr></tr>
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
                                <select name="working_hour" class="form-control js-example" id="working_hour" >
                                    <option value="">-Pick Working Hour-</option>
                                    @for($i=1; $i <=13; $i++)
                                    <option value="{{ $i }} hours">{{ $i }} hours</option>
                                    @endfor
                                </select>
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
                        <div class="col-md-6 doctorDiv">
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
                            <button type="button" id="submitForm" class="btn btn-primary">Save & Next</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row hidden" id="secondStep">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Upload Documents</h5>
            </div>
            <div class="card-body">
                <form method="POST" id="form-submit1" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Photo <span style="color:red;">*</span><span  style="color:red" id="photo_err"> </span></label>
                                <input type="file" name="photo" class="form-control" id="photo">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Signature <span  style="color:red" id="sign_err"> </span></label>
                                <input type="file" name="signature" class="form-control" id="signature">
                            </div>
                        </div>
                        <div class="col-md-12">
                        <hr>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <table class="table table-hover" id="dynamic_field1">
                                    <tr>
                                        <th>Certificate Name</th>
                                        <th>PDF File</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="certificate_name[]" class="form-control" placeholder="Enter Certificate Name"/></td>
                                        <td><input type="file" name="pdf_file[]" class="form-control"/></td>
                                        <td><button type="button" name="add" id="add1" class="btn btn-primary">Add More</button></td>  
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input type="hidden" name="user_id" id="user_id" value="">
                            <button type="submit" id="submitForm1" class="btn btn-primary">Save & Next</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row hidden" id="thirdStep">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>General Information</h5>
            </div>
            <div class="card-body">
                <form method="POST" id="form-submit2" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>License No. <span  style="color:red" id="license_err"> </span></label>
                                <input type="text" name="license" class="form-control" id="license">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Bank Passbook (Photo) <span  style="color:red" id="passbook_err"> </span></label>
                                <input type="file" name="passbook" class="form-control" id="passbook">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Agreements (PDF File)<span  style="color:red" id="agreement_err"> </span></label>
                                <input type="file" name="agreement" class="form-control" id="agreement">
                            </div>
                        </div>
                        <div class="col-md-12">
                        <hr>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date of Joining <span  style="color:red" id="date_err"> </span></label>
                                <input type="date" name="joining_date" class="form-control" id="joining_date">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Declaration Signed <span  style="color:red" id="declare_err"> </span></label>
                                <input type="file" name="declare_sign" class="form-control" id="declare_sign">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>MOU Signed <span  style="color:red" id="mou_err"> </span></label>
                                <input type="file" name="mou_sign" class="form-control" id="mou_sign">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>You Tube Link <span class="text-danger">*</span><span  style="color:red" id="link_err"> </span></label>
                                <input type="url" name="link" class="form-control" id="link">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input type="hidden" name="user_id" id="user_id1" value="">
                            <button type="submit" id="submitForm2" class="btn btn-primary">Submit</button>
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
$(document).ready(function(){
    var i = 10;

    $("#add1").click(function(){
    i++;
    $('#dynamic_field1').append('<tr id="row'+i+'"><td><input type="text" name="certificate_name[]" class="form-control" placeholder="Enter Certificate Name"/></td><td><input type="file" name="pdf_file[]" class="form-control" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
    });

    $(document).on('click', '.btn_remove', function(){  
    var button_id = $(this).attr("id");   
    $('#row'+button_id+'').remove();  
    });
});
</script>
<script type=text/javascript>
$('body').on('click', '#submitForm', function () {
    var name = $("#name").val();
    var category_id = $("#category_id").val();
    var sub_category_id = $("#sub_category_id").val();
    var contact_no = $("#contact_no").val();
    var alt_contact_no = $("#alt_contact_no").val();
    var aadhar_no = $("#aadhar_no").val();
    var email = $("#email").val();
    var role = $("#role").val();
    var experience = $("#experience").val();
    var qualification = $("#qualification").val();
    var specialization = $("#specialization").val();
    var busi_year = $("#busi_year").val();
    var serve_capacity = $("#serve_capacity").val();
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
    var from = $("input[name=from]").val();
    var to = $("input[name=to]").val();
    var category_type = $("#category_type").val();
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
    if (name=="") {
        $("#name_err").fadeIn().html("Required");
        setTimeout(function(){ $("#name_err").fadeOut(); }, 3000);
        $("#name").focus();
        return false;
    }
    if (category_id=="") {
        $("#cat_err").fadeIn().html("Required");
        setTimeout(function(){ $("#cat_err").fadeOut(); }, 3000);
        $("#category_id").focus();
        return false;
    }
    if (sub_category_id=="") {
        $("#sub_cat_err").fadeIn().html("Required");
        setTimeout(function(){ $("#sub_cat_err").fadeOut(); }, 3000);
        $("#sub_category_id").focus();
        return false;
    }
    if (role=="") {
        $("#role_err").fadeIn().html("Required");
        setTimeout(function(){ $("#role_err").fadeOut(); }, 3000);
        $("#role").focus();
        return false;
    }
    if(category_type == "Service")
    {
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
    }
    if(category_type == "Product")
    {
        if (busi_year=="") {
            $("#busi_year_err").fadeIn().html("Required");
            setTimeout(function(){ $("#busi_year_err").fadeOut(); }, 3000);
            $("#busi_year").focus();
            return false;
        }
    }
    if(from == "") {
        $("#work_shift_err").fadeIn().html("Required");
        setTimeout(function(){ $("#work_shift_err").fadeOut(); }, 3000);
        $("input[name=from]").focus();
        return false;
    }
    if (to == "") {
        $("#work_shift_err").fadeIn().html("Required");
        setTimeout(function(){ $("#work_shift_err").fadeOut(); }, 3000);
        $("input[name=to]").focus();
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
            url:"{{ route('admin.register.store') }}",
            data:{name:name, category_id:category_id, sub_category_id:sub_category_id, contact_no:contact_no, alt_contact_no:alt_contact_no, aadhar_no:aadhar_no, email:email, experience:experience, qualification:qualification, specialization:specialization, office_addr:office_addr, residential_addr:residential_addr, working_hour:working_hour, other_profession:other_profession, dob:dob, expectation:expectation, achievement:achievement, urself:urself, username:username, password:password, Data:Data, busi_year:busi_year, serve_capacity:serve_capacity, role:role},
            cache:false,        
            success:function(returndata)
            {
                // alert(returndata);
                if(returndata.success){
                    document.getElementById("form-submit").reset();
                    toastr.success(returndata.success);
                    $("#user_id").val(returndata.id);
                    $("#firstStep").addClass('hidden');
                    $("#secondStep").removeClass('hidden');
                }
                else{
                    toastr.error(returndata.error);
                }
            }
        });
    }
})
$('body').on('submit', '#form-submit1', function (event) {
    event.preventDefault();
    var photo = $("#photo").val();
    
    var exts = ['jpg','jpeg','png'];
    var formdata = new FormData(this);
    // alert(file_size);
    if (photo=="") {
        $("#photo_err").fadeIn().html("Required");
        setTimeout(function(){ $("#photo_err").fadeOut(); }, 3000);
        $("#photo").focus();
        return false;
    }
    if(photo)
    {
        var get_ext = photo.split('.');
        // reverse name to check extension
        get_ext = get_ext.reverse();
        // check file type is valid as given in 'exts' array
        if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
            console.log( 'Allowed extension!' );
        } else {
            $("#photo_err").fadeIn().html("Required Extension are jpg ,jpeg ,png");
            setTimeout(function(){ $("#photo_err").fadeOut(); }, 3000);
            $("#photo").focus();
            return false;
        }
        
        var file_size = $('#photo')[0].files[0].size;
    }
    if(file_size>300000) {
        $("#photo_err").fadeIn().html("File Size should be less than 300kb");
        setTimeout(function(){ $("#photo_err").fadeOut(); }, 3000);
        $("#photo").focus();
        return false;
    }
    else{
        $.ajax({
            url   :"{{ route('admin.register.upload-document') }}",
            type  :"POST",
            data  :formdata,
            cache :false,
            processData: false,
            contentType: false,
            success:function(result){
            // alert(result);
            toastr.success(result.success);
            $("#form-submit1")[0].reset();
            $("#user_id1").val(result.id);
            $("#firstStep").addClass('hidden');
            $("#secondStep").addClass('hidden');
            $("#thirdStep").removeClass('hidden');
            }
        });
    }
});


$('body').on('submit', '#form-submit2', function (event) {
    event.preventDefault();
    var passbook = $("#passbook").val();
    var agreement = $("#agreement").val();
    var declare_sign = $("#declare_sign").val();
    var mou_sign = $("#mou_sign").val();
    var exts1 = ['pdf'];
    var exts = ['jpg','jpeg','png'];
    var formdata = new FormData(this);
    // alert(file_size);
    if (passbook) {
        var get_ext = passbook.split('.');
        // reverse name to check extension
        get_ext = get_ext.reverse();
        // check file type is valid as given in 'exts' array
        if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
            console.log( 'Allowed extension!' );
        } else {
            $("#passbook_err").fadeIn().html("Required Extension are jpg ,jpeg ,png");
            setTimeout(function(){ $("#passbook_err").fadeOut(); }, 3000);
            $("#passbook").focus();
            return false;
        }
        var file_size = $('#passbook')[0].files[0].size;    
        if(file_size>300000) {
            $("#passbook_err").fadeIn().html("File Size should be less than 300kb");
            setTimeout(function(){ $("#passbook_err").fadeOut(); }, 3000);
            $("#passbook").focus();
            return false;
        }
    }
    if (agreement) {
        var get_ext = agreement.split('.');
        // reverse name to check extension
        get_ext = get_ext.reverse();
        // check file type is valid as given in 'exts' array
        if ( $.inArray ( get_ext[0].toLowerCase(), exts1 ) > -1 ){
            console.log( 'Allowed extension!' );
        } else {
            $("#agreement_err").fadeIn().html("Required Extension is pdf");
            setTimeout(function(){ $("#agreement_err").fadeOut(); }, 3000);
            $("#agreement").focus();
            return false;
        }
    }
    if (declare_sign) {
        var get_ext = declare_sign.split('.');
        // reverse name to check extension
        get_ext = get_ext.reverse();
        // check file type is valid as given in 'exts' array
        if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
            console.log( 'Allowed extension!' );
        } else {
            $("#declare_err").fadeIn().html("Required Extension are jpg ,jpeg ,png");
            setTimeout(function(){ $("#declare_err").fadeOut(); }, 3000);
            $("#declare_sign").focus();
            return false;
        }
        var file_size1 = $('#declare_sign')[0].files[0].size;
        if(file_size1>300000) {
            $("#declare_err").fadeIn().html("File Size should be less than 300kb");
            setTimeout(function(){ $("#declare_err").fadeOut(); }, 3000);
            $("#declare_sign").focus();
            return false;
        }
    }
    if (mou_sign) {
        var get_ext = mou_sign.split('.');
        // reverse name to check extension
        get_ext = get_ext.reverse();
        // check file type is valid as given in 'exts' array
        if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
            console.log( 'Allowed extension!' );
        } else {
            $("#mou_err").fadeIn().html("Required Extension are jpg ,jpeg ,png");
            setTimeout(function(){ $("#mou_err").fadeOut(); }, 3000);
            $("#mou_sign").focus();
            return false;
        }
        var file_size2 = $('#mou_sign')[0].files[0].size;
        if(file_size2>300000) {
            $("#mou_err").fadeIn().html("File Size should be less than 300kb");
            setTimeout(function(){ $("#mou_err").fadeOut(); }, 3000);
            $("#mou_sign").focus();
            return false;
        }
    }
    else{
        $.ajax({
            url   :"{{ route('admin.register.general-info') }}",
            type  :"POST",
            data  :formdata,
            cache :false,
            processData: false,
            contentType: false,
            success:function(result){
            // alert(result);
            toastr.success(result.success);
            $("#form-submit2")[0].reset();
            $("#firstStep").removeClass('hidden');
            $("#secondStep").addClass('hidden');
            $("#thirdStep").addClass('hidden');
            }
        });
    }
});
$('#category_id').change(function(){
  var categoryID = $(this).val();  
  if(categoryID){
        $.ajax({
            url   :"{{ route('admin.get-category-type') }}",
            type  :"POST",
            data  :{categoryID:categoryID},
            success:function(result){
                $("#category_type").val(result.type);
                if(result.type == "Product"){
                    $(".dailyNeed").removeClass("hidden");
                    $(".doctorDiv").addClass("hidden");
                }
                else{
                    $(".doctorDiv").removeClass("hidden");
                    $(".dailyNeed").addClass("hidden");
                }
            }
        })
  }
});
</script>
@endsection