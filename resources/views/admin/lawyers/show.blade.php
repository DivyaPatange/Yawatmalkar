@extends('admin.admin_layout.main')
@section('title', 'Lawyers')
@section('customcss')
<link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://use.fontawesome.com/d5c7b56460.js"></script>
<style>

</style>
@endsection
@section('page_title', 'Lawyer Profile')
@section('breadcrumb1', 'Home')
@section('breadcrumb2')
<a href="{{ route('admin.lawyers.show', $lawyer->id) }}">Lawyer Profile</a>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h5 class="mt-4">Lawyer Profile</h5>
        <hr>
    </div>
    <?php 
        $lawyerInfo = DB::table('user_infos')->where('user_id', $lawyer->id)->first();
    ?>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header text-center"> 
                <img src="@if(!empty($lawyerInfo)){{  URL::asset('UserPhoto/'.$lawyerInfo->photo) }}@endif" alt="" class="img-fluid" width="100px">
                <h6 class="mt-3">{{ $lawyer->employee_id }}</h6>
            </div>
            <div class="card-body">
            <?php 
                if(!empty($lawyerInfo)){
                    $category = DB::table('categories')->where('id', $lawyerInfo->category_id)->first();
                    $subCategory = DB::table('sub_categories')->where('id', $lawyerInfo->sub_category_id)->first();
                }
            ?>
                <p><b>Category :</b>@if(!empty($lawyerInfo)) @if(!empty($category)) {{ $category->category_name }} @endif @endif</p>
                <p><b>Sub-Category :</b>@if(!empty($lawyerInfo)) @if(!empty($subCategory)) {{ $subCategory->sub_category }} @endif @endif</p>
                <p><b>Experience :</b>@if(!empty($lawyerInfo)) {{ $lawyerInfo->experience }} @endif</p>
                <p><b>Qualification :</b>@if(!empty($lawyerInfo)) {{ $lawyerInfo->qualification }} @endif</p>
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
                        <p><b>Lawyer Name</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>: {{ $lawyer->name }}</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Email</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>: {{ $lawyer->email }}</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Category</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>:@if(!empty($lawyerInfo)) @if(!empty($category)) {{ $category->category_name }} @endif @endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Sub Category</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>:@if(!empty($lawyerInfo)) @if(!empty($subCategory)) {{ $subCategory->sub_category }} @endif @endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Contact No.</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>:@if(!empty($lawyerInfo)) {{ $lawyerInfo->contact_no }} @endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Alternate Contact No.</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>:@if(!empty($lawyerInfo)) {{ $lawyerInfo->alt_contact_no }} @endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Aadhar No.</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>:@if(!empty($lawyerInfo)) {{ $lawyerInfo->aadhar_no }} @endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Experience</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>:@if(!empty($lawyerInfo)) {{ $lawyerInfo->experience }} @endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Qualification</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>:@if(!empty($lawyerInfo)) {{ $lawyerInfo->qualification }} @endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Specialization</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>:@if(!empty($lawyerInfo)) {{ $lawyerInfo->specialization }} @endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Other Profession</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>:@if(!empty($lawyerInfo)) {{ $lawyerInfo->other_profession }} @endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Date Of Birth</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>:@if(!empty($lawyerInfo)) {{ $lawyerInfo->dob }} @endif</p>
                    </div>
                    <div class="col-md-3">
                        <p><b>Office Address</b></p>
                    </div>
                    <div class="col-md-9">
                        <p>:@if(!empty($lawyerInfo)) {{ $lawyerInfo->office_address }} @endif</p>
                    </div>
                    <div class="col-md-3">
                        <p><b>Residential Address</b></p>
                    </div>
                    <div class="col-md-9">
                        <p>:@if(!empty($lawyerInfo)) {{ $lawyerInfo->residential_address }} @endif</p>
                    </div>
                    <div class="col-md-3">
                        <p><b>Expectation</b></p>
                    </div>
                    <div class="col-md-9">
                        <p>:@if(!empty($lawyerInfo)) {{ $lawyerInfo->expectation }} @endif</p>
                    </div>
                    <div class="col-md-3">
                        <p><b>Achievement</b></p>
                    </div>
                    <div class="col-md-9">
                        <p>:@if(!empty($lawyerInfo)) {{ $lawyerInfo->achievements }} @endif</p>
                    </div>
                    <div class="col-md-3">
                        <p><b>About Yourself</b></p>
                    </div>
                    <div class="col-md-9">
                        <p>:@if(!empty($lawyerInfo)) {{ $lawyerInfo->about_urself }} @endif</p>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="row">
                    @if($lawyerInfo->photo)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                Photo
                            </div>
                            <div class="card-body">
                                <img src="@if(!empty($lawyerInfo)){{  URL::asset('UserPhoto/'.$lawyerInfo->photo) }}@endif" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($lawyerInfo->signature)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                Signature
                            </div>
                            <div class="card-body">
                                <img src="@if(!empty($lawyerInfo)){{  URL::asset('UserSignature/'.$lawyerInfo->signature) }}@endif" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($lawyerInfo->declaration_signed)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                Declaration Signed
                            </div>
                            <div class="card-body">
                                <img src="@if(!empty($lawyerInfo)){{  URL::asset('UserDeclareSign/'.$lawyerInfo->declaration_signed) }}@endif" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($lawyerInfo->mou_signed)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                MOU Signed
                            </div>
                            <div class="card-body">
                                <img src="@if(!empty($lawyerInfo)){{  URL::asset('UserMouSign/'.$lawyerInfo->mou_signed) }}@endif" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="row">
                    @if($lawyerInfo->agreement)
                    <div class="col-md-3">
                        <p><b>Agreement</b></p>
                        <a href="@if(!empty($lawyerInfo)){{  URL::asset('UserAgreement/'.$lawyerInfo->agreement) }}@endif">Click to View</a>
                    </div>
                    @endif
                    @if($lawyerInfo->bank_passbook)
                    <div class="col-md-3">
                        <p><b>Bank Passbook</b></p>
                        <a href="@if(!empty($lawyerInfo)){{  URL::asset('UserPassbook/'.$lawyerInfo->bank_passbook) }}@endif">Click to View</a>
                    </div>
                    @endif
                    <?php
                        $certificates = DB::table('user_certificates')->where('user_id', $lawyer->id)->get();
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
                        <p>: @if(!empty($lawyerInfo)){{ $lawyerInfo->youtube_link }}@endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Working Hour</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>:@if(!empty($lawyerInfo)) {{ $lawyerInfo->working_hour }} @endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>License</b></p>
                    </div>
                    <div class="col-md-4">
                        <p>: @if(!empty($lawyerInfo)){{ $lawyerInfo->license }}@endif</p>
                    </div>
                    <div class="col-md-2">
                        <p><b>Working Shifts</b></p>
                    </div>
                    <div class="col-md-4">
                        <?php 
                            $workingHour = DB::table('user_working_hours')->where('user_id', $lawyer->id)->get();
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