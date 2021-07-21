@extends('admin.admin_layout.main')
@section('title', 'Flashes & Upcomings')
@section('customcss')
<link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@endsection
@section('page_title', 'Flashes & Upcomings')
@section('breadcrumb1', 'Home')
@section('breadcrumb2')
<a href="{{ route('admin.flashes-upcoming.index') }}">Flashes & Upcomings</a>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Add Flashes & Upcoming</h5>
            </div>
            <div class="card-body">
                <form method="POST" id="form-submit" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category_id">Category <span style="color:red;">*</span><span  style="color:red" id="cat_err"> </span></label>
                                <select name="category_id" class="form-control" id="category_id">
                                    <option value="">-Select Category-</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="image">Image<span style="color:red;">*</span><span  style="color:red" id="img_err"> </span></label>
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
                <h5>Flashes & Upcoming List</h5>
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
          <h4 class="modal-title">Edit Flashes & Upcoming</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="POST" id="editForm" enctype="multipart/form-data">
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit_category_id">Category<span style="color:red;">*</span></label><span  style="color:red" id="edit_cat_err"> </span>
                    <select name="category_id" id="edit_category_id" class="form-control">
                        <option value="">-Select Category-</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Image<span style="color:red;">*</span></label><span  style="color:red" id="edit_img_err"> </span>
                    <input type="file" name="image" id="edit_image" class="form-control">
                    <input type="hidden" name="hidden_img" id="hidden_img" value="">
                </div>
                <div class="form-group">
                    <a href="" target="_blank" id="viewImg">Click Here To View</a>
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
  var SITEURL = '{{ URL::to('/admin/flashes-upcoming')}}';
    $('#zero_config').DataTable({
         processing: true,
         serverSide: true,
         ajax: {
          url: SITEURL,
          type: 'GET',
         },
         columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                  { data: 'image', name: 'image' },
                  { data: 'category_id', name: 'category_id' },
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
            url:"{{ route('admin.get.flashes-upcoming') }}",
            data:datastring,
            cache:false,        
            success:function(returndata)
            {
                // alert(returndata);
                if (returndata!="0") {
                    $("#myModal").modal('show');
                    var json = JSON.parse(returndata);
                    $("#id").val(json.id);
                    $("#edit_category_id").val(json.category_id);
                    $("#edit_status").val(json.status);
                    $("#hidden_img").val(json.hidden_img);
                    $("#viewImg").attr("href", json.image);
                    // $("#total_amt").val(json.total_pay);
                }
            }
        });
    }
    $('body').on('submit', '#editForm', function (event) {
        event.preventDefault();
        var formdata = new FormData(this);
        var category_id = $("#edit_category_id").val();
        var status = $("#edit_status").val();
        var id = $("#id").val().trim();
        var hidden_img = $("#hidden_img").val();
        if (category_id == "") {
            $("#edit_cat_err").fadeIn().html("Required");
            setTimeout(function(){ $("#edit_cat_err").fadeOut(); }, 3000);
            $("#edit_category_id").focus();
            return false;
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
            $.ajax({
                type:"POST",
                url:"{{ url('/admin/flashes-upcoming/update') }}",
                data:formdata,
                cache:false,     
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
                url: "{{ url('admin/flashes-upcoming') }}"+'/'+id,
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
        var category_id = $("#category_id").val();
        if (category_id=="") {
            $("#cat_err").fadeIn().html("Required");
            setTimeout(function(){ $("#cat_err").fadeOut(); }, 3000);
            $("#category_id").focus();
            return false;
        }
        var _URL = window.URL || window.webkitURL;
        var image = $("#image").val();
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
        else
        { 
            // alert(datastring);
            $.ajax({
                type:"POST",
                url:"{{ route('admin.flashes-upcoming.store') }}",
                data:formdata,
                cache:false,     
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