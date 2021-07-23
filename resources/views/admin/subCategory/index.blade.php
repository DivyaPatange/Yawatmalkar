@extends('admin.admin_layout.main')
@section('title', 'Sub-Category')
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
</style>
@endsection
@section('page_title', 'Sub-Category')
@section('breadcrumb1', 'Home')
@section('breadcrumb2')
<a href="{{ route('admin.sub-category.index') }}">Sub-Category</a>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Add Sub-Category</h5>
            </div>
            <div class="card-body">
                <form method="POST" id="form-submit" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category_name">Category <span style="color:red;">*</span><span  style="color:red" id="category_err"> </span></label>
                                <select name="category_name" class="form-control" id="category_name">
                                    <option value="">-Select Category-</option>
                                    @foreach($categories as $c)
                                    <option value="{{ $c->id }}">{{ $c->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sub_category">Sub-Category <span style="color:red;">*</span><span  style="color:red" id="sub_category_err"> </span></label>
                                <input type="text" name="sub_category" class="form-control" id="sub_category" placeholder="Enter Sub-Category">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="image">Image <span style="color:red;">*</span><span  style="color:red" id="img_err"> </span></label>
                                <input type="file" name="image" class="form-control" id="image">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category_name">Status <span style="color:red;">*</span><span  style="color:red" id="status_err"> </span></label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="">-Select Status-</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="description">Description <span style="color:red;">*</span><span  style="color:red" id="description_err"> </span></label>
                                <textarea name="description" class="form-control" id="description" placeholder="Description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" id="submitForm" class="btn btn-primary">Submit</button>
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
                <h5>Sub-Category List</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Sub-Category</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Sub-Category</th>
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
<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Sub-Category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="POST" enctype="multipart/form-data" id="editform">
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Category Name<span style="color:red;">*</span></label><span  style="color:red" id="edit_category_err"> </span>
                    <select name="category_name" class="form-control" id="edit_category_name">
                        <option value="">-Select Category-</option>
                        @foreach($categories as $c)
                        <option value="{{ $c->id }}">{{ $c->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Sub-Category <span style="color:red;">*</span><span  style="color:red" id="edit_sub_category_err"> </span></label>
                    <input type="text" name="sub_category" class="form-control" id="edit_sub_category" placeholder="Enter Sub-Category">
                </div>
                <div class="form-group">
                    <label for="">Image <span class="text-danger" id="edit_img_err"></span></label>
                    <input type="file" name="image" id="edit_img" class="form-control">
                    <input type="hidden" name="hidden_img" id="hidden_img">
                </div>
                <div class="form-group">
                    <label for="">Status<span style="color:red;">*</span></label><span  style="color:red" id="edit_status_err"> </span>
                    <select name="status" id="edit_status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Status </label>
                    <textarea name="description" id="edit_description" class="form-control"></textarea>
            </div>
        
            <!-- Modal footer -->
            <div class="modal-footer">
                <input type="hidden" name="id" id="id" value="">
                <button type="submit" class="btn btn-success" id="editBrand">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </form>
        
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
  var SITEURL = '{{ URL::to('/admin/sub-category')}}';
    // var brand = "brand";
    // alert(brand);
function format ( d ) {
// `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; width:100%">'+
        '<tr>'+
            '<td style="text-align:center">Description</td>'+
            '<td style="text-align:center">'+d.description+'</td>'+
        '</tr>'+
    '</table>';
}
$(document).ready(function(){
    var table =
    $('#zero_config').DataTable({
         processing: true,
         serverSide: true,
         ajax: {
          url: SITEURL,
          type: 'GET',
         },
         columns: [
                  {
                        "className":      'details-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ''
                  },
                  { data: 'image', name: 'image' },
                  { data: 'category_id', name: 'category_id' },
                  { data: 'sub_category', name: 'sub_category' },
                  { data: 'status', name: 'status' },
                  {data: 'action', name: 'action', orderable: false},
               ],
        order: [[0, 'desc']]
    });
    $('#zero_config tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });
})

function EditModel(obj,bid)
{
    var datastring="bid="+bid;
    // alert(datastring);
    $.ajax({
        type:"POST",
        url:"{{ route('admin.get.sub-category') }}",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
            // alert(returndata);
        if (returndata!="0") {
            $("#myModal").modal('show');
            var json = JSON.parse(returndata);
            $("#id").val(json.id);
            $("#edit_category_name").val(json.category_name);
            $("#edit_sub_category").val(json.sub_category);
            $("#edit_status").val(json.status);
            $("#hidden_img").val(json.image);
            $("#edit_description").val(json.description);
            // $("#total_amt").val(json.total_pay);
        }
        }
    });
}

$('body').on('click', '#delete', function () {
    var id = $(this).data("id");

    if(confirm("Are You sure want to delete !")){
        $.ajax({
            type: "delete",
            url: "{{ url('admin/sub-category') }}"+'/'+id,
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
    var category_name = $("#category_name").val();
    var sub_category = $("#sub_category").val();
    var status = $("#status").val();
    var photo = $("#image").val();
    var exts = ['jpg','jpeg','png'];
    if (category_name=="") {
        $("#category_err").fadeIn().html("Required");
        setTimeout(function(){ $("#category_err").fadeOut(); }, 3000);
        $("#category_name").focus();
        return false;
    }
    if (sub_category=="") {
        $("#sub_category_err").fadeIn().html("Required");
        setTimeout(function(){ $("#sub_category_err").fadeOut(); }, 3000);
        $("#sub_category").focus();
        return false;
    }
    if (photo=="") {
        $("#img_err").fadeIn().html("Required");
        setTimeout(function(){ $("#img_err").fadeOut(); }, 3000);
        $("#image").focus();
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
            $("#img_err").fadeIn().html("Required Extension are jpg ,jpeg ,png");
            setTimeout(function(){ $("#img_err").fadeOut(); }, 3000);
            $("#image").focus();
            return false;
        }
        
        var file_size = $('#image')[0].files[0].size;
    }
    if(file_size>200000) {
        $("#img_err").fadeIn().html("File Size should be less than 200kb");
        setTimeout(function(){ $("#img_err").fadeOut(); }, 3000);
        $("#image").focus();
        return false;
    }
    if (status=="") {
        $("#status_err").fadeIn().html("Required");
        setTimeout(function(){ $("#status_err").fadeOut(); }, 3000);
        $("#status").focus();
        return false;
    }
    else
    { 
        var datastring="category_name="+category_name+"&status="+status+"&sub_category="+sub_category;
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ route('admin.sub-category.store') }}",
            data  :formdata,
            cache :false,
            processData: false,
            contentType: false,     
            success:function(returndata)
            {
                document.getElementById("form-submit").reset();
                var oTable = $('#zero_config').dataTable(); 
                oTable.fnDraw(false);
                toastr.success(returndata.success);
            }
        });
    }
})

$('body').on('submit', '#editform', function (event) {
    event.preventDefault();
    var formdata = new FormData(this);
    var category_name = $("#edit_category_name").val();
    var sub_category = $("#edit_sub_category").val();
    var status = $("#edit_status").val();
    var id = $("#id").val().trim();
    var photo = $("#edit_img").val();
    var exts = ['jpg','jpeg','png'];
    if (category_name=="") {
        $("#edit_category_err").fadeIn().html("Required");
        setTimeout(function(){ $("#edit_category_err").fadeOut(); }, 3000);
        $("#edit_category_name").focus();
        return false;
    }
    if (sub_category=="") {
        $("#edit_sub_category_err").fadeIn().html("Required");
        setTimeout(function(){ $("#edit_sub_category_err").fadeOut(); }, 3000);
        $("#edit_sub_category").focus();
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
            $("#edit_img_err").fadeIn().html("Required Extension are jpg ,jpeg ,png");
            setTimeout(function(){ $("#edit_img_err").fadeOut(); }, 3000);
            $("#edit_img").focus();
            return false;
        }      
        var file_size = $('#edit_img')[0].files[0].size;     
        if(file_size>200000) {
            $("#edit_img_err").fadeIn().html("File Size should be less than 200kb");
            setTimeout(function(){ $("#edit_img_err").fadeOut(); }, 3000);
            $("#edit_img").focus();
            return false;
        }
    }
    if (status=="") {
        $("#edit_status_err").fadeIn().html("Required");
        setTimeout(function(){ $("#edit_status_err").fadeOut(); }, 3000);
        $("#edit_status").focus();
        return false;
    }
    else
    { 
        $('#editBrand').attr('disabled',true);
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ url('/admin/sub-category/update') }}",
            data  :formdata,
            cache :false,
            processData: false,
            contentType: false,         
            success:function(returndata)
            {
                $('#editBrand').attr('disabled',false);
                $("#myModal").modal('hide');
                var oTable = $('#zero_config').dataTable(); 
                oTable.fnDraw(false);
                toastr.success(returndata.success);
            }
        });
    }

})
</script>
@endsection