@extends('auth.auth_layout.main')
@section('title', 'Edit Profile')
@section('page_title', 'Edit Profile')
@section('customcss')
<link href="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

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
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body p-b-0">
                <h4 class="card-title">Edit Profile</h4>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs customtab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home2" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Basic Info</span></a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile2" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Working Hour</span></a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages2" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Extra Info</span></a> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="home2" role="tabpanel">
                    <div class="p-20">
                        <form method="POST" id="form-submit">
                        @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Name of @if($user->acc_type == "doctor")Doctor @endif @if($user->acc_type == "lawyer")Lawyer @endif @if($user->acc_type == "beautician")Beautician @endif <span style="color:red;">*</span><span  style="color:red" id="name_err"> </span></label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Category <span  style="color:red" id="cat_err"> </span></label>
                                        <select class="form-control js-example" id="category_id" name="category_id">
                                            <option value="">-Select Category-</option>
                                            @foreach($category as $c)
                                            <option value="{{ $c->id }}" @if($userInfo->category_id == $c->id) Selected @endif>{{ $c->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sub-Category <span  style="color:red" id="sub_cat_err"> </span></label>
                                        <select class="form-control js-example" id="sub_category_id" name="sub_category_id">
                                            <option value="">-Select SubCategory-</option>
                                            @foreach($subCategory as $s)
                                            <option value="{{ $s->id }}" @if($s->id == $userInfo->sub_category_id) Selected @endif>{{ $s->sub_category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Contact No. <span  style="color:red" id="contact_err"> </span></label>
                                        <input type="number" name="contact_no" class="form-control" id="contact_no" placeholder="Enter Contact No." value="{{ $userInfo->contact_no }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Alternate Contact No. <span  style="color:red" id="alt_contact_err"> </span></label>
                                        <input type="number" name="alt_contact_no" class="form-control" id="alt_contact_no" placeholder="Enter Alternate Contact No." value="{{ $userInfo->alt_contact_no }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Aadhar No. <span  style="color:red" id="aadhar_err"> </span></label>
                                        <input type="number" name="aadhar_no" class="form-control" id="aadhar_no" placeholder="Enter Aadhar No." value="{{ $userInfo->aadhar_no }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email Id <span  style="color:red" id="email_err"> </span></label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email Id" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                <hr>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Experience <span style="color:red;">*</span><span  style="color:red" id="experience_err"> </span></label>
                                        <input type="text" name="experience" class="form-control" id="experience" placeholder="Enter Experience" value="{{ $userInfo->experience }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Qualification <span  style="color:red" id="qualification_err"> </span></label>
                                        <input type="text" name="qualification" class="form-control" id="qualification" placeholder="Enter Qualification" value="{{ $userInfo->qualification }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Specialization <span style="color:red;">*</span><span  style="color:red" id="specialization_err"> </span></label>
                                        <input type="text" name="specialization" class="form-control" id="specialization" placeholder="Enter Specialization" value="{{ $userInfo->specialization }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Working Hours <span style="color:red;">*</span><span  style="color:red" id="work_hour_err"> </span></label>
                                        <select name="working_hour" class="form-control js-example" id="working_hour" >
                                            <option value="">-Pick Working Hour-</option>
                                            @for($i=1; $i <=13; $i++)
                                            <option value="{{ $i }} hours" @if($userInfo->working_hour == $i." hours") Selected @endif>{{ $i }} hours</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                <hr>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Office Address <span  style="color:red" id="office_err"> </span></label>
                                        <textarea name="office_addr" class="form-control" id="office_addr">{{ $userInfo->office_address }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Residential Address <span  style="color:red" id="residential_err"> </span></label>
                                        <textarea name="residential_addr" class="form-control" id="residential_addr">{{ $userInfo->residential_address }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                <hr>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Other Profession <span  style="color:red" id="profession_err"> </span></label>
                                        <input type="text" name="other_profession" class="form-control" id="other_profession" value="{{ $userInfo->other_profession }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date of Birth <span  style="color:red" id="dob_err"> </span></label>
                                        <input type="date" name="dob" class="form-control" id="dob" value="{{ $userInfo->dob }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Expectations From Yawatmalkar <span  style="color:red" id="expectation_err"> </span></label>
                                        <input type="text" name="expectation" class="form-control" id="expectation" value="{{ $userInfo->expectation }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                <hr>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" id="submitForm" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane  p-20" id="profile2" role="tabpanel">2</div>
                <div class="tab-pane p-20" id="messages2" role="tabpanel">
                    <form method="POST" id="form-submit2" >
                    @csrf 
                    @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Achievements <span  style="color:red" id="achievement_err"> </span></label>
                                    <textarea name="achievement" class="form-control" id="achievement">{{ $userInfo->achievements }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>About Yourselves <span  style="color:red" id="urself_err"> </span></label>
                                    <textarea name="urself" class="form-control" id="urself">{{ $userInfo->about_urself }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                            <hr>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>License No. <span  style="color:red" id="license_err"> </span></label>
                                    <input type="text" name="license" class="form-control" id="license" value="{{ $userInfo->license }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date of Joining <span  style="color:red" id="date_err"> </span></label>
                                    <input type="date" name="joining_date" class="form-control" id="joining_date" value="{{ $userInfo->joining_date }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>You Tube Link <span class="text-danger">*</span><span  style="color:red" id="link_err"> </span></label>
                                    <input type="url" name="link" class="form-control" id="link" value="{{ $userInfo->youtube_link }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" id="submitForm2" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
@section('customjs')
<script src="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
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
      url:"{{url('/user/get-subcategory-list')}}?category_id="+categoryID,
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
</script>
<script type=text/javascript>
$('body').on('submit', '#form-submit', function (event) {
    event.preventDefault();
    var name = $("#name").val();
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
    
    // alert(formdata);
    if (name=="") {
        $("#name_err").fadeIn().html("Required");
        setTimeout(function(){ $("#name_err").fadeOut(); }, 3000);
        $("#name").focus();
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
    if (working_hour=="") {
        $("#work_hour_err").fadeIn().html("Required");
        setTimeout(function(){ $("#work_hour_err").fadeOut(); }, 3000);
        $("#working_hour").focus();
        return false;
    }
    else{
        $.ajax({
            url   :"{{ route('user.profile.update', $user->id) }}",
            type  :"PUT",
            data:{name:name, category_id:category_id, sub_category_id:sub_category_id, contact_no:contact_no, alt_contact_no:alt_contact_no, aadhar_no:aadhar_no, email:email, experience:experience, qualification:qualification, specialization:specialization, office_addr:office_addr, residential_addr:residential_addr, working_hour:working_hour, other_profession:other_profession, dob:dob, expectation:expectation},
            
            success:function(result){
            // alert(result);
            toastr.success(result.success);
            // $("#form-submit")[0].reset();
            }
        });
    }
})
</script>
@endsection