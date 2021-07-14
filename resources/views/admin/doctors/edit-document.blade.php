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
.hidden{
    display:none;
}
</style>
@endsection
@section('page_title', 'Edit Doctor Document')
@section('breadcrumb1', 'Home')
@section('breadcrumb2')
<a href="{{ route('admin.doctors.edit-document', $userInfo->user_id) }}">Edit Doctor Document</a>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Upload Documents</h5>
            </div>
            <div class="card-body">
                <form method="POST" id="form-submit1" enctype="multipart/form-data" action="{{ route('admin.doctors.update-document', $userInfo->user_id) }}">
                @csrf
                @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Photo <span style="color:red;">*</span><span  style="color:red" id="photo_err"> </span></label>
                                <input type="file" name="photo" class="form-control" id="photo">
                            </div>
                            <input type="hidden" class="form-control-file" name="hidden_photo" value="{{ $userInfo->photo }}">
                            @if($userInfo->photo)
                            <a href="{{  URL::asset('UserPhoto/' . $userInfo->photo) }}" target="_blank">Click Here to View</a>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Signature <span  style="color:red" id="sign_err"> </span></label>
                                <input type="file" name="signature" class="form-control" id="signature">
                            </div>
                            <input type="hidden" class="form-control-file" name="hidden_signature" value="{{ $userInfo->signature }}">
                            @if($userInfo->signature)
                            <a href="{{  URL::asset('UserSignature/' . $userInfo->signature) }}" target="_blank">Click Here to View</a>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Bank Passbook (Photo) <span  style="color:red" id="passbook_err"> </span></label>
                                <input type="file" name="passbook" class="form-control" id="passbook">
                            </div>
                            <input type="hidden" class="form-control-file" name="hidden_passbook" value="{{ $userInfo->bank_passbook }}">
                            @if($userInfo->bank_passbook)
                            <a href="{{  URL::asset('UserPassbook/' . $userInfo->bank_passbook) }}" target="_blank">Click Here to View</a>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Agreements (PDF File)<span  style="color:red" id="agreement_err"> </span></label>
                                <input type="file" name="agreement" class="form-control" id="agreement">
                            </div>
                            <input type="hidden" class="form-control-file" name="hidden_agreement" value="{{ $userInfo->agreement }}">
                            @if($userInfo->agreement)
                            <a href="{{  URL::asset('UserAgreement/' . $userInfo->agreement) }}" target="_blank">Click Here to View</a>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Declaration Signed <span  style="color:red" id="declare_err"> </span></label>
                                <input type="file" name="declare_sign" class="form-control" id="declare_sign">
                            </div>
                            <input type="hidden" class="form-control-file" name="hidden_declare" value="{{ $userInfo->declaration_signed }}">
                            @if($userInfo->declaration_signed)
                            <a href="{{  URL::asset('UserDeclareSign/' . $userInfo->declaration_signed) }}" target="_blank">Click Here to View</a>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>MOU Signed <span  style="color:red" id="mou_err"> </span></label>
                                <input type="file" name="mou_sign" class="form-control" id="mou_sign">
                            </div>
                            <input type="hidden" class="form-control-file" name="hidden_mou" value="{{ $userInfo->mou_signed }}">
                            @if($userInfo->mou_signed)
                            <a href="{{  URL::asset('UserMouSign/' . $userInfo->mou_signed) }}" target="_blank">Click Here to View</a>
                            @endif
                        </div>
                        <div class="col-md-12">
                        <hr>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                @if(count($certificates) == 0)
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
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="button" id="submitForm1" class="btn btn-primary">Update</button>
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
$('body').on('click', '#submitForm1', function (event) {
    event.preventDefault();
    var photo = $("#photo").val();
    
    var exts = ['jpg','jpeg','png'];
    var passbook = $("#passbook").val();
    var agreement = $("#agreement").val();
    var declare_sign = $("#declare_sign").val();
    var mou_sign = $("#mou_sign").val();
    var exts1 = ['pdf'];
    // var formdata = new FormData(this);
    // alert(file_size);
    // if (photo=="") {
    //     $("#photo_err").fadeIn().html("Required");
    //     setTimeout(function(){ $("#photo_err").fadeOut(); }, 3000);
    //     $("#photo").focus();
    //     return false;
    // }
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
        if(file_size>300000) {
            $("#photo_err").fadeIn().html("File Size should be less than 300kb");
            setTimeout(function(){ $("#photo_err").fadeOut(); }, 3000);
            $("#photo").focus();
            return false;
        }
    }
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
        var file_size3 = $('#passbook')[0].files[0].size;    
        if(file_size3>300000) {
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
        $("#form-submit1").submit();
    }
});

</script>
@endsection