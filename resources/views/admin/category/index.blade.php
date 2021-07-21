@extends('admin.admin_layout.main')
@section('title', 'Category')
@section('customcss')
<link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@endsection
@section('page_title', 'Category')
@section('breadcrumb1', 'Home')
@section('breadcrumb2')
<a href="{{ route('admin.category.index') }}">Category</a>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Add Category</h5>
            </div>
            <div class="card-body">
                <form method="POST" id="form-submit" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category_name">Category <span style="color:red;">*</span><span  style="color:red" id="category_err"> </span></label>
                                <input type="text" name="category_name" class="form-control" id="category_name" placeholder="Enter Category">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category_img">Category Image<span style="color:red;">*</span><span  style="color:red" id="img_err"> </span></label>
                                <input type="file" name="category_img" class="form-control" id="category_img">
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
                <h5>Category List</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Image</th>
                                <th>Category</th>
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
          <h4 class="modal-title">Edit Category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="POST" id="form-submit1" enctype="multipart/form-data">
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Category Name<span style="color:red;">*</span></label><span  style="color:red" id="edit_category_err"> </span>
                    <input type="text" name="category_name" id="edit_category_name" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label for="category_img">Category Image<span style="color:red;">*</span><span  style="color:red" id="edit_img_err"> </span></label>
                    <input type="file" name="category_img" class="form-control" id="edit_category_img">
                    <input type="hidden" name="hidden_img" id="hidden_img" value="">
                </div>
                <div class="form-group">
                    <label for="">Status<span style="color:red;">*</span></label><span  style="color:red" id="edit_status_err"> </span>
                    <select name="status" id="edit_status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
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
  var SITEURL = '{{ URL::to('/admin/category')}}';
    // var brand = "brand";
    // alert(brand);
    $('#zero_config').DataTable({
         processing: true,
         serverSide: true,
         ajax: {
          url: SITEURL,
          type: 'GET',
         },
         columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                  { data: 'category_img', name: 'category_img' },
                  { data: 'category_name', name: 'category_name' },
                  { data: 'status', name: 'status' },
                  {data: 'action', name: 'action', orderable: false},
               ],
        order: [[0, 'desc']]
      });

    function EditModel(obj,bid)
    {
        var datastring="bid="+bid;
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ route('admin.get.category') }}",
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
                $("#edit_status").val(json.status);
                $("#hidden_img").val(json.category_img);
                // $("#adv_amt").val(json.advance_amt);
                // $("#total_amt").val(json.total_pay);
            }
            }
        });
    }
    $('body').on('submit', '#form-submit1', function (event) {
        event.preventDefault();
        var formdata = new FormData(this);
        var category_name = $("#edit_category_name").val();
        var status = $("#edit_status").val();
        var id = $("#id").val().trim();
        var photo = $("#edit_category_img").val();
        var exts = ['jpg','jpeg','png'];
        if (category_name=="") {
            $("#edit_category_err").fadeIn().html("Required");
            setTimeout(function(){ $("#edit_category_err").fadeOut(); }, 3000);
            $("#edit_category_name").focus();
            return false;
        }
        if (status=="") {
            $("#edit_status_err").fadeIn().html("Required");
            setTimeout(function(){ $("#edit_status_err").fadeOut(); }, 3000);
            $("#edit_status").focus();
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
                $("#edit_category_img").focus();
                return false;
            }
            
            // var file_size = $('#edit_category_img')[0].files[0].size;     
            // if(file_size>200000) {
            //     $("#edit_img_err").fadeIn().html("File Size should be less than 200kb");
            //     setTimeout(function(){ $("#edit_img_err").fadeOut(); }, 3000);
            //     $("#edit_category_img").focus();
            //     return false;
            // }
        }
        else
        { 
            $('#editBrand').attr('disabled',true);
            var datastring="category_name="+category_name+"&status="+status+"&id="+id;
            // alert(datastring);
            $.ajax({
                type:"POST",
                url:"{{ url('/admin/category/update') }}",
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

    $('body').on('click', '#delete', function () {
        var id = $(this).data("id");
  
        if(confirm("Are You sure want to delete !")){
            $.ajax({
                type: "delete",
                url: "{{ url('admin/category') }}"+'/'+id,
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
        var status = $("#status").val();
        var photo = $("#category_img").val();
        var exts = ['jpg','jpeg','png'];
        if (category_name=="") {
            $("#category_err").fadeIn().html("Required");
            setTimeout(function(){ $("#category_err").fadeOut(); }, 3000);
            $("#category_name").focus();
            return false;
        }
        if (photo=="") {
            $("#img_err").fadeIn().html("Required");
            setTimeout(function(){ $("#img_err").fadeOut(); }, 3000);
            $("#category_img").focus();
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
                $("#category_img").focus();
                return false;
            }
            
            var file_size = $('#category_img')[0].files[0].size;
        }
        if(file_size>200000) {
            $("#img_err").fadeIn().html("File Size should be less than 200kb");
            setTimeout(function(){ $("#img_err").fadeOut(); }, 3000);
            $("#category_img").focus();
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
            var datastring="category_name="+category_name+"&status="+status;
            // alert(datastring);
            $.ajax({
                type:"POST",
                url:"{{ route('admin.category.store') }}",
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
</script>
@endsection