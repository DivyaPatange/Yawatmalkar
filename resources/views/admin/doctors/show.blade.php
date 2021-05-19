@extends('admin.admin_layout.main')
@section('title', 'Doctors')
@section('customcss')
<link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://use.fontawesome.com/d5c7b56460.js"></script>
<style>
td.details-control:before {
    font-family: 'FontAwesome';
    content: '\f105';
    display: block;
    text-align: center;
    font-size: 20px;
}
tr.shown td.details-control:before{
   font-family: 'FontAwesome';
    content: '\f107';
    display: block;
    text-align: center;
    font-size: 20px;
}
.switch_box{
	display: -webkit-box;
	display: -ms-flexbox;
	display: flex;
	/* max-width: 200px; */
	/* min-width: 200px; */
	/* height: 200px; */
	-webkit-box-pack: center;
	    -ms-flex-pack: center;
	        justify-content: center;
	-webkit-box-align: center;
	    -ms-flex-align: center;
	        align-items: center;
	-webkit-box-flex: 1;
	    -ms-flex: 1;
	        flex: 1;
}

/* Switch 1 Specific Styles Start */

.box_1{
	/* background: #eee; */
}

input[type="checkbox"].switch_1{
	font-size: 20px;
	-webkit-appearance: none;
	   -moz-appearance: none;
	        appearance: none;
	width: 2.5em;
	height: 1.2em;
	background: #dd0c0c;
	border-radius: 3em;
	position: relative;
	cursor: pointer;
	outline: none;
	-webkit-transition: all .2s ease-in-out;
	transition: all .2s ease-in-out;
  }
  
  input[type="checkbox"].switch_1:checked{
	background: green;
  }
  
  input[type="checkbox"].switch_1:after{
	position: absolute;
	content: "";
	width: 1.5em;
	height: 1.5em;
	border-radius: 50%;
	background: #fff;
	-webkit-box-shadow: 0 0 .25em rgba(0,0,0,.3);
	        box-shadow: 0 0 .25em rgba(0,0,0,.3);
	-webkit-transform: scale(.7);
	        transform: scale(.7);
	left: 0;
	-webkit-transition: all .2s ease-in-out;
	transition: all .2s ease-in-out;
    top:-3px;
  }
  
  input[type="checkbox"].switch_1:checked:after{
	left: calc(100% - 1.5em);
  }
</style>
@endsection
@section('page_title', 'Doctors Profile')
@section('breadcrumb1', 'Home')
@section('breadcrumb2')
<a href="{{ route('admin.doctors.show', $user->id) }}">Doctor Profile</a>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h5 class="mt-4">Doctor Profile</h5>
        <hr>
    </div>
    <?php 
        $userInfo = DB::table('user_infos')->where('user_id', $user->id)->first();
    ?>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header text-center"> 
                <img src="@if(!empty($userInfo)){{  URL::asset('UserPhoto/'.$userInfo->photo) }}@endif" alt="" class="img-fluid" width="100px">
                <h6 class="mt-3">{{ $user->employee_id }}</h6>
            </div>
            <div class="card-body">
            <?php 
                if(!empty($userInfo)){
                $category = DB::table('categories')->where('id', $userInfo->category_id)->first();
                $subCategory = DB::table('sub_categories')->where('id', $userInfo->sub_category_id)->first();
                }
            ?>
                <p><b>Category :</b>@if(!empty($userInfo)) @if(!empty($category)) {{ $category->category_name }} @endif @endif</p>
                <p><b>Sub-Category :</b>@if(!empty($userInfo)) @if(!empty($subCategory)) {{ $subCategory->sub_category }} @endif @endif</p>
                <p><b>Experience :</b>@if(!empty($userInfo)) {{ $userInfo->experience }} @endif</p>
                <p><b>Qualification :</b>@if(!empty($userInfo)) {{ $userInfo->qualification }} @endif</p>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Document Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">General Information</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row">
                    <div class="col-md-2">
                        <p><b>Doctor Name</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>: {{ $user->name }}</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Email</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>: {{ $user->email }}</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Category</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>:@if(!empty($userInfo)) @if(!empty($category)) {{ $category->category_name }} @endif @endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Sub Category</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>:@if(!empty($userInfo)) @if(!empty($subCategory)) {{ $subCategory->sub_category }} @endif @endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Contact No.</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>:@if(!empty($userInfo)) {{ $userInfo->contact_no }} @endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Alternate Contact No.</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>:@if(!empty($userInfo)) {{ $userInfo->alt_contact_no }} @endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Aadhar No.</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>:@if(!empty($userInfo)) {{ $userInfo->aadhar_no }} @endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Experience</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>:@if(!empty($userInfo)) {{ $userInfo->experience }} @endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Qualification</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>:@if(!empty($userInfo)) {{ $userInfo->qualification }} @endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Specialization</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>:@if(!empty($userInfo)) {{ $userInfo->specialization }} @endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Other Profession</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>:@if(!empty($userInfo)) {{ $userInfo->other_profession }} @endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Date Of Birth</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>:@if(!empty($userInfo)) {{ $userInfo->dob }} @endif</p>
                    </div>
                    <div class="col-md-3">
                        <p><b>Office Address</b></p>
                    </div>
                    <div class="col-md-9">
                        <p>:@if(!empty($userInfo)) {{ $userInfo->office_address }} @endif</p>
                    </div>
                    <div class="col-md-3">
                        <p><b>Residential Address</b></p>
                    </div>
                    <div class="col-md-9">
                        <p>:@if(!empty($userInfo)) {{ $userInfo->residential_address }} @endif</p>
                    </div>
                    <div class="col-md-3">
                        <p><b>Expectation</b></p>
                    </div>
                    <div class="col-md-9">
                        <p>:@if(!empty($userInfo)) {{ $userInfo->expectation }} @endif</p>
                    </div>
                    <div class="col-md-3">
                        <p><b>Achievement</b></p>
                    </div>
                    <div class="col-md-9">
                        <p>:@if(!empty($userInfo)) {{ $userInfo->achievements }} @endif</p>
                    </div>
                    <div class="col-md-3">
                        <p><b>About Yourself</b></p>
                    </div>
                    <div class="col-md-9">
                        <p>:@if(!empty($userInfo)) {{ $userInfo->about_urself }} @endif</p>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="row">
                    @if($userInfo->photo)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                Photo
                            </div>
                            <div class="card-body">
                                <img src="@if(!empty($userInfo)){{  URL::asset('UserPhoto/'.$userInfo->photo) }}@endif" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($userInfo->signature)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                Signature
                            </div>
                            <div class="card-body">
                                <img src="@if(!empty($userInfo)){{  URL::asset('UserSignature/'.$userInfo->signature) }}@endif" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($userInfo->declaration_signed)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                Declaration Signed
                            </div>
                            <div class="card-body">
                                <img src="@if(!empty($userInfo)){{  URL::asset('UserDeclareSign/'.$userInfo->declaration_signed) }}@endif" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($userInfo->mou_signed)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                MOU Signed
                            </div>
                            <div class="card-body">
                                <img src="@if(!empty($userInfo)){{  URL::asset('UserMouSign/'.$userInfo->mou_signed) }}@endif" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="row">
                    @if($userInfo->agreement)
                    <div class="col-md-3">
                        <p><b>Agreement</b></p>
                        <a href="@if(!empty($userInfo)){{  URL::asset('UserAgreement/'.$userInfo->agreement) }}@endif">Click to View</a>
                    </div>
                    @endif
                    @if($userInfo->bank_passbook)
                    <div class="col-md-3">
                        <p><b>Bank Passbook</b></p>
                        <a href="@if(!empty($userInfo)){{  URL::asset('UserPassbook/'.$userInfo->bank_passbook) }}@endif">Click to View</a>
                    </div>
                    @endif
                    <?php
                        $certificates = DB::table('user_certificates')->where('user_id', $user->id)->get();
                    ?>
                    @foreach($certificates as $c)
                    <div class="col-md-3">
                        <p><b>{{ $c->certificate_name }}</b></p>
                        <a href="{{  URL::asset('UserCertificate/'.$c->certificate_pdf) }}">Click to View</a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="row">
                    <div class="col-md-2">
                        <p><b>You Tube Link</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>: @if(!empty($userInfo)){{ $userInfo->youtube_link }}@endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Working Hour</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>: @if(!empty($userInfo)){{ $userInfo->working_hour }}@endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>License</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>: @if(!empty($userInfo)){{ $userInfo->license }}@endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Working Shifts</b></p>
                    </div>
                    <div class="col-md-4">
                        <?php 
                            $workingHour = DB::table('user_working_hours')->where('user_id', $user->id)->get();
                        ?>
                        <ul class="list-unstyled">
                            @foreach($workingHour as $w)
                            <li>{{ date("g:i A", strtotime($w->from)) }} - {{ date("g:i A", strtotime($w->to)) }}</li>
                            @endforeach 
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
@section('customjs')

<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script type=text/javascript>
</script>
@endsection`