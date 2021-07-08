@extends('admin.admin_layout.main')
@section('title', 'Edit Testimonial')
@section('customcss')
@endsection
@section('page_title', 'Edit Testimonial')
@section('breadcrumb1', 'Home')
@section('breadcrumb2')
<a href="{{ route('admin.testimonials.edit', $testimonial->id) }}">Edit Testimonial</a>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit Testimonial</h5>
            </div>
            <div class="card-body">
                <form method="POST" id="form-submit" enctype="multipart/form-data" action="{{ route('admin.testimonials.update', $testimonial->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="page_name">Page Name <span style="color:red;">*</span><span  style="color:red" id="page_err"> </span></label>
                                <select name="page_name" class="form-control" id="page_name">
                                    <option value="">-Select Page Name-</option>
                                    @foreach($pages as $page)                              
                                    <option value="{{ $page->id }}" @if($testimonial->page_id == $page->id) Selected @endif>{{ $page->page_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Image <span style="color:red;">*</span><span  style="color:red" id="img_err"> </span></label>
                                <input type="file" class="form-control" id="image" name="image">
                                <input type="hidden" name="hidden_img" value="{{ $testimonial->image }}">
                            </div>
                            <div class="form-group">
                                <a href="{{ asset('TestimonialImg/'.$testimonial->image) }}" target="_blank">Click here to view</a>
                            </div>
                            <div class="form-group">
                                <label for="status">Status <span style="color:red;">*</span><span  style="color:red" id="status_err"> </span></label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="">-Select Status-</option>
                                    <option value="1" @if($testimonial->status == 1) Selected @endif>Active</option>
                                    <option value="0" @if($testimonial->status == 0) Selected @endif>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Description <span style="color:red;">*</span><span  style="color:red" id="description_err"> </span></label>
                                <textarea class="form-control ckeditor" id="description"  name="description">{{ $testimonial->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="button" id="submitButton" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 
@section('customjs')

<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script type=text/javascript>
$(document).ready(function () {
    $('.ckeditor').ckeditor();
});
$('body').on('click', '#submitButton', function() {
    var page_name = $("#page_name").val();
    if (page_name=="") {
        $("#page_err").fadeIn().html("Required");
        setTimeout(function(){ $("#page_err").fadeOut(); }, 3000);
        $("#page_name").focus();
        return false;
    }
    var image = $("#image").val();
    var exts = ['jpg','jpeg','png'];
    var status = $("#status").val();
    if (status=="") {
        $("#status_err").fadeIn().html("Required");
        setTimeout(function(){ $("#status_err").fadeOut(); }, 3000);
        $("#status").focus();
        return false;
    }
    if(image)
    {
        var get_ext = image.split('.');
        // reverse name to check extension
        get_ext = get_ext.reverse();
        // check file type is valid as given in 'exts' array
        if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
            console.log( 'Allowed extension!' );
        } else {
            $("#img_err").fadeIn().html("Required Extension are jpg ,jpeg ,png");
            setTimeout(function(){ $("#img_err").fadeOut(); }, 3000);
            $("#image").focus();
            return false;
        }
        
        var file_size = $('#image')[0].files[0].size;
        if(file_size>200000) {
            $("#img_err").fadeIn().html("File Size should be less than 300kb");
            setTimeout(function(){ $("#img_err").fadeOut(); }, 3000);
            $("#image").focus();
            return false;
        }
        else{
            $("#form-submit").submit();
        }
    }
    else{
        $("#form-submit").submit();
    }
})
</script>
@endsection