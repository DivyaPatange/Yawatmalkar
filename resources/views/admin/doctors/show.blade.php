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
<a href="{{ route('admin.doctors.show', $doctor->id) }}">Doctor Profile</a>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h5 class="mt-4">Doctor Profile</h5>
        <hr>
    </div>
    <?php 
        $doctorInfo = DB::table('doctor_infos')->where('doctor_id', $doctor->id)->first();
    ?>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header text-center"> 
                <img src="@if(!empty($doctorInfo)){{  URL::asset('DoctorPhoto/'.$doctorInfo->photo) }}@endif" alt="" class="img-fluid" width="100px">
                <h6 class="mt-3">{{ $doctor->doctor_id }}</h6>
            </div>
            <div class="card-body">
            <?php 
                $category = DB::table('categories')->where('id', $doctor->category_id)->first();
                $subCategory = DB::table('sub_categories')->where('id', $doctor->sub_category_id)->first();
            ?>
                <p><b>Category :</b> @if(!empty($category)) {{ $category->category_name }} @endif</p>
                <p><b>Sub-Category :</b> @if(!empty($subCategory)) {{ $subCategory->sub_category }} @endif</p>
                <p><b>Experience :</b> {{ $doctor->experience }}</p>
                <p><b>Qualification :</b> {{ $doctor->qualification }}</p>
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
                        <p>: {{ $doctor->doctor_name }}</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Email</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>: {{ $doctor->email }}</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Category</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>: @if(!empty($category)) {{ $category->category_name }} @endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Sub Category</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>: @if(!empty($subCategory)) {{ $subCategory->sub_category }} @endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Contact No.</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>: {{ $doctor->contact_no }}</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Alternate Contact No.</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>: {{ $doctor->alt_contact_no }}</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Aadhar No.</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>: {{ $doctor->aadhar_no }}</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Experience</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>: {{ $doctor->experience }}</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Qualification</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>: {{ $doctor->qualification }}</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Specialization</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>: {{ $doctor->specialization }}</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Other Profession</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>: {{ $doctor->other_profession }}</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Date Of Birth</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>: {{ $doctor->dob }}</p>
                    </div>
                    <div class="col-md-3">
                        <p><b>Office Address</b></p>
                    </div>
                    <div class="col-md-9">
                        <p>: {{ $doctor->office_address }}</p>
                    </div>
                    <div class="col-md-3">
                        <p><b>Residential Address</b></p>
                    </div>
                    <div class="col-md-9">
                        <p>: {{ $doctor->residential_address }}</p>
                    </div>
                    <div class="col-md-3">
                        <p><b>Expectation</b></p>
                    </div>
                    <div class="col-md-9">
                        <p>: {{ $doctor->expectation }}</p>
                    </div>
                    <div class="col-md-3">
                        <p><b>Achievement</b></p>
                    </div>
                    <div class="col-md-9">
                        <p>: {{ $doctor->achievements }}</p>
                    </div>
                    <div class="col-md-3">
                        <p><b>About Yourself</b></p>
                    </div>
                    <div class="col-md-9">
                        <p>: {{ $doctor->about_urself }}</p>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <p class="mb-0">Ad pariatur nostrud pariatur exercitation ipsum ipsum culpa mollit commodo mollit ex. Aute sunt incididunt amet commodo est sint nisi deserunt pariatur do. Aliquip ex eiusmod voluptate exercitation cillum id incididunt elit sunt. Qui minim sit magna Lorem id et dolore velit Lorem amet exercitation duis deserunt. Anim id labore elit adipisicing ut in id occaecat pariatur ut ullamco ea tempor duis.
                </p>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <p class="mb-0">Est quis nulla laborum officia ad nisi ex nostrud culpa Lorem excepteur aliquip dolor aliqua irure ex. Nulla ut duis ipsum nisi elit fugiat commodo sunt reprehenderit laborum veniam eu veniam. Eiusmod minim exercitation fugiat irure ex labore incididunt do fugiat commodo aliquip sit id deserunt reprehenderit aliquip nostrud. Amet ex cupidatat excepteur aute veniam incididunt mollit cupidatat esse irure officia elit do ipsum ullamco Lorem. Ullamco ut ad minim do mollit labore ipsum laboris ipsum commodo sunt tempor enim incididunt. Commodo quis sunt dolore aliquip aute tempor irure magna enim minim reprehenderit. Ullamco consectetur culpa veniam sint cillum aliqua incididunt velit ullamco sunt ullamco quis quis commodo voluptate. Mollit nulla nostrud adipisicing aliqua cupidatat aliqua pariatur mollit voluptate voluptate consequat non.</p>
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