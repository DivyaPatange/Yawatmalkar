@extends('admin.admin_layout.main')
@section('title', 'Testimonial')
@section('customcss')
<link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@endsection
@section('page_title', 'Testimonial')
@section('breadcrumb1', 'Home')
@section('breadcrumb2')
<a href="{{ route('admin.testimonials.index') }}">Testimonial</a>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
        </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Add Testimonial</h5>
            </div>
            <div class="card-body">
                <form method="POST" id="form-submit" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="page_name">Page Name <span style="color:red;">*</span><span  style="color:red" id="page_err"> </span></label>
                                <select name="page_name" class="form-control" id="page_name">
                                    <option value="">-Select Page Name-</option>
                                    @foreach($pages as $p)
                                    <option value="{{ $p->id }}">{{ $p->page_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="image">Image <span style="color:red;">*</span><span  style="color:red" id="img_err"> </span></label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">Status <span style="color:red;">*</span><span  style="color:red" id="status_err"> </span></label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="">-Select Status-</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description <span style="color:red;">*</span><span  style="color:red" id="description_err"> </span></label>
                                <textarea class="form-control ckeditor" id="description"  name="description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" id="submitButton" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Testimonial List</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Page Name</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Page Name</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
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

function CKupdate(){
    for ( instance in CKEDITOR.instances ){
        CKEDITOR.instances[instance].updateElement();
        CKEDITOR.instances[instance].setData('');
    }
}
  var SITEURL = '{{ URL::to('/admin/testimonials')}}';
    $('#zero_config').DataTable({
         processing: true,
         serverSide: true,
         ajax: {
          url: SITEURL,
          type: 'GET',
         },
         columns: [
                  { data: 'page_name', name: 'page_name' },
                  { data: 'image', name: 'image' },
                  { data: 'description', name: 'description' },
                  { data: 'status', name: 'status' },
                  {data: 'action', name: 'action', orderable: false},
               ],
        order: [[0, 'desc']]
    });

    $('body').on('click', '#delete', function () {
        var id = $(this).data("id");
  
        if(confirm("Are You sure want to delete !")){
            $.ajax({
                type: "delete",
                url: "{{ url('admin/testimonials') }}"+'/'+id,
                success: function (data) {
                var oTable = $('#zero_config').dataTable(); 
                oTable.fnDraw(false);
                toastr.success(data.success);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });

    $('body').on('submit', '#form-submit', function (event) {
        event.preventDefault();
        var formdata = new FormData(this);
        // alert(formdata);
        var page_name = $("#page_name").val();
        if (page_name=="") {
            $("#page_err").fadeIn().html("Required");
            setTimeout(function(){ $("#page_err").fadeOut(); }, 3000);
            $("#page_name").focus();
            return false;
        }
        var image = $("#image").val();
        var exts = ['jpg','jpeg','png'];
        if(image == "")
        {
            $("#img_err").fadeIn().html("Required");
            setTimeout(function(){ $("#img_err").fadeOut(); }, 3000);
            $("#image").focus();
            return false;
        }   
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
        }
        if(file_size>200000) {
            $("#img_err").fadeIn().html("File Size should be less than 300kb");
            setTimeout(function(){ $("#img_err").fadeOut(); }, 3000);
            $("#image").focus();
            return false;
        }
        else{
            $.ajax({
                type:"POST",
                url:"{{ route('admin.testimonials.store') }}",
                data:formdata,
                cache:false,     
                processData: false,
                contentType: false,        
                success:function(returndata)
                {
                    document.getElementById("form-submit").reset();
                    CKupdate();
                    var oTable = $('#zero_config').dataTable(); 
                    oTable.fnDraw(false);
                    toastr.success(returndata.success);
                }
            });
        }
    })
</script>
@endsection