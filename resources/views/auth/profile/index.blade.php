@extends('auth.auth_layout.main')
@section('title', 'Profile')
@section('page_title', 'Profile')
@section('customcss')


@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="user-profile">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="user-photo m-b-30">
                                <img class="img-fluid" src="@if(!empty($userInfo)){{  URL::asset('UserPhoto/'.$userInfo->photo) }}@endif" alt="" />
                            </div>
                            <div class="user-work">
                                <h4>Work</h4>
                                <div class="work-content">
                                <h3>Office Address </h3>
                                <p>@if(!empty($userInfo)) {{ $userInfo->office_address }} @endif</p>
                                </div>
                                <div class="work-content">
                                <h3>Working Hour</h3>
                                <p>@if(!empty($userInfo)) {{ $userInfo->working_hour }} @endif</p>
                                </div>
                            </div>
                            <div class="user-skill">
                                <h4>Working Shifts</h4>
                                <ul class="mb-2">
                                    @foreach($workingHour as $w)
                                    <li>
                                    {{ date("g:i A", strtotime($w->from)) }} - {{ date("g:i A", strtotime($w->to)) }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="user-skill">
                                <h4>Documents</h4>
                                <p><b>Photo: </b>&nbsp; @if(!empty($userInfo->photo))<a href="{{  URL::asset('UserPhoto/'.$userInfo->photo) }}" target="_blank">Click to View</a>@endif</p>
                                <p><b>Signature: </b>&nbsp; @if(!empty($userInfo->signature))<a href="{{  URL::asset('UserSignature/'.$userInfo->signature) }}" target="_blank">Click to View</a>@endif</p>
                                <p><b>Bank Passbook: </b>&nbsp; @if(!empty($userInfo->bank_passbook))<a href="{{  URL::asset('UserPassbook/'.$userInfo->bank_passbook) }}" target="_blank">Click to View</a>@endif</p>
                                <p><b>Agreement: </b>&nbsp; @if(!empty($userInfo->agreement))<a href="{{  URL::asset('UserAgreement/'.$userInfo->agreement) }}" target="_blank">Click to View</a>@endif</p>
                                <p><b>Declaration Signed: </b>&nbsp; @if(!empty($userInfo->declaration_signed))<a href="{{  URL::asset('UserDeclareSign/'.$userInfo->declaration_signed) }}" target="_blank">Click to View</a>@endif</p>
                                <p><b>Mou Signed: </b>&nbsp; @if(!empty($userInfo->mou_signed))<a href="{{  URL::asset('UserMouSign/'.$userInfo->mou_signed) }}" target="_blank">Click to View</a>@endif</p>

                            </div>
                            <div class="user-skill">
                                <h4>Certificates </h4>
                                @foreach($certificates as $c)
                                <p><b>{{ $c->certificate_name }}: </b>&nbsp; <a href="{{  URL::asset('UserCertificate/'.$c->certificate_pdf) }}" target="_blank">Click to View</a></p>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="user-profile-name">@if(!empty($user)) {{ $user->name }} @endif</div>
                            <div class="user-Location">
                                <i class="ti-location-pin"></i> @if(!empty($userInfo)) {{ $userInfo->residential_address }} @endif
                            </div>
                            <div class="user-job-title">@if(!empty($userInfo)) {{ $userInfo->specialization }} @endif</div>
                            <div class="user-send-message">
                                <a href="{{ route('user.profile.edit', $user->id) }}"><button class="btn btn-primary" type="button">Edit Profile</button></a>
                            </div>
                            <div class="custom-tab user-profile-tab">
                                <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#1" aria-controls="1" role="tab" data-toggle="tab">About</a>
                                </li>
                                </ul>
                                <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="1">
                                    <div class="contact-information">
                                    <h4>General information</h4>
                                    <?php 
                                        if(!empty($userInfo)){
                                        $category = DB::table('categories')->where('id', $userInfo->category_id)->first();
                                        $subCategory = DB::table('sub_categories')->where('id', $userInfo->sub_category_id)->first();
                                        }
                                    ?>
                                    <div class="phone-content">
                                        <span class="contact-title">Category:</span>
                                        <span class="phone-number">@if(!empty($userInfo)) @if(!empty($category)) {{ $category->category_name }} @endif @endif</span>
                                    </div>
                                    <div class="address-content">
                                        <span class="contact-title">Sub-Category:</span>
                                        <span class="mail-address">@if(!empty($userInfo)) @if(!empty($subCategory)) {{ $subCategory->sub_category }} @endif @endif</span>
                                    </div>
                                    <div class="phone-content">
                                        <span class="contact-title">Contact No.:</span>
                                        <span class="phone-number">@if(!empty($userInfo)) {{ $userInfo->contact_no }} @endif</span>
                                    </div>
                                    <div class="phone-content">
                                        <span class="contact-title">Alternate Contact No.:</span>
                                        <span class="phone-number">@if(!empty($userInfo)) {{ $userInfo->alt_contact_no }} @endif</span>
                                    </div>
                                    <div class="email-content">
                                        <span class="contact-title">Email:</span>
                                        <span class="contact-email">@if(!empty($user)) {{ $user->email }} @endif</span>
                                    </div>
                                    <div class="website-content">
                                        <span class="contact-title">Aadhar No.:</span>
                                        <span class="contact-website">@if(!empty($userInfo)) {{ $userInfo->aadhar_no }} @endif</span>
                                    </div>
                                    <div class="skype-content">
                                        <span class="contact-title">Experience:</span>
                                        <span class="contact-skype">@if(!empty($userInfo)) {{ $userInfo->experience }} @endif</span>
                                    </div>
                                    <div class="skype-content">
                                        <span class="contact-title">Qualification:</span>
                                        <span class="contact-skype">@if(!empty($userInfo)) {{ $userInfo->qualification }} @endif</span>
                                    </div>
                                    <div class="skype-content">
                                        <span class="contact-title">Other Profession:</span>
                                        <span class="contact-skype">@if(!empty($userInfo)) {{ $userInfo->other_profession }} @endif</span>
                                    </div>
                                    <div class="skype-content">
                                        <span class="contact-title">Expectation:</span>
                                        <span class="contact-skype">@if(!empty($userInfo)) {{ $userInfo->expectation }} @endif</span>
                                    </div>
                                    <div class="skype-content">
                                        <span class="contact-title">License:</span>
                                        <span class="contact-skype">@if(!empty($userInfo)) {{ $userInfo->license }} @endif</span>
                                    </div>
                                    <div class="skype-content">
                                        <span class="contact-title">Joining Date:</span>
                                        <span class="contact-skype">@if(!empty($userInfo)) {{ $userInfo->joining_date }} @endif</span>
                                    </div>
                                    </div>
                                    <div class="basic-information">
                                    <h4>Basic information</h4>
                                    <div class="skype-content">
                                        <span class="contact-title">DOB:</span>
                                        <span class="contact-skype">@if(!empty($userInfo)) {{ $userInfo->dob }} @endif</span>
                                    </div>
                                    <div class="skype-content">
                                        <span class="contact-title">About Yourself:</span>
                                        <span class="contact-skype">@if(!empty($userInfo)) {{ $userInfo->about_urself }} @endif</span>
                                    </div>
                                    <div class="skype-content">
                                        <span class="contact-title">Achievements:</span>
                                        <span class="contact-skype">@if(!empty($userInfo)) {{ $userInfo->achievements }} @endif</span>
                                    </div>
                                    <div class="skype-content">
                                        <span class="contact-title">Youtube Link:</span>
                                        <span class="contact-skype">@if(!empty($userInfo)) {{ $userInfo->youtube_link }} @endif</span>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
@section('customjs')

@endsection