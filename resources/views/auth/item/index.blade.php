@extends('auth.auth_layout.main')
@section('title', 'Items')
@section('page_title', 'Items')
@section('customcss')
<link href="{{ asset('userAssets/assets/css/lib/data-table/buttons.bootstrap.min.css') }}" rel="stylesheet" />
<script src="https://use.fontawesome.com/d5c7b56460.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
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
thead tr th:last-child{
    text-align:left;
}
tbody tr td:last-child{
    text-align:left;
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
@section('content')
<div class="row">
    <div class="col-md-12">
        @if ($message = Session::get('success'))
		<div class="alert alert-success alert-block mt-3">
			<button type="button" class="close" data-dismiss="alert">×</button>	
				<strong>{{ $message }}</strong>
		</div>
		@endif
		@if ($message = Session::get('danger'))
		<div class="alert alert-danger alert-block mt-3">
			<button type="button" class="close" data-dismiss="alert">×</button>	
				<strong>{{ $message }}</strong>
		</div>
		@endif
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title float-left">Items List</h4>
                <a href="{{ route('user.items.create') }}"><button type="button" class="btn btn-outline-primary float-right" title="">Add New</button></a>
            </div>
            <div class="bootstrap-data-table-panel">
                <div class="table-responsive">
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Category</th>
                                <th>Sub-Category</th>
                                <th>Item Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
        <!-- /# card -->
    </div>
    <!-- /# column -->
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Schedule</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="POST" >
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label>Category<span style="color:red;">*</span><span  style="color:red" id="cat_err"> </span></label>
                    <select name="category_id" class="form-control" id="category_id">
                        <option value="">Choose</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->sub_category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Item Name <span  style="color:red" id="item_err"> </span></label>
                    <input type="text" name="item_name" class="form-control" id="item_name" placeholder="Enter Item Name">
                </div>
                <div class="form-group">
                    <label>Status <span  style="color:red" id="status_err"> </span></label>
                    <select name="status" class="form-control" id="status">
                        <option value="">-Select Status-</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>   
            <!-- Modal footer -->
            <div class="modal-footer">
                <input type="hidden" name="id" id="id" value="">
                <button type="button" class="btn btn-success" id="editBrand" onclick="return checkSubmit()" style="padding:10px 20px">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" style="padding:10px 20px">Close</button>
            </div>
        </form>
        
      </div>
    </div>
</div>
@endsection 
@section('customjs')
<!-- scripit init-->
<script src="{{ asset('userAssets/assets/js/lib/data-table/datatables.min.js') }}"></script>
<script src="{{ asset('userAssets/assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('userAssets/assets/js/lib/data-table/buttons.flash.min.js') }}"></script>
<script src="{{ asset('userAssets/assets/js/lib/data-table/jszip.min.js') }}"></script>
<script src="{{ asset('userAssets/assets/js/lib/data-table/pdfmake.min.js') }}"></script>
<script src="{{ asset('userAssets/assets/js/lib/data-table/vfs_fonts.js') }}"></script>
<script src="{{ asset('userAssets/assets/js/lib/data-table/buttons.html5.min.js') }}"></script>
<script src="{{ asset('userAssets/assets/js/lib/data-table/buttons.print.min.js') }}"></script>
<script src="{{ asset('userAssets/assets/js/lib/data-table/datatables-init.js') }}"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var SITEURL = '{{ route('user.items.index')}}';

$(document).ready(function(){
    var table =$('#bootstrap-data-table-export').DataTable({
        dom: 'lBfrtip',
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        processing: true,
        serverSide: true,
        ajax: {
        url: SITEURL,
        type: 'GET',
        },
        columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false },
                { data: 'category_id', name: 'category_id' },
                { data: 'sub_category_id', name: 'sub_category_id' },
                { data: 'item_name', name: 'item_name'},
                { data: 'status', name: 'status'},
                { data: 'action', name: 'action'},
               ],
        order: [[0, 'desc']]
    });
})


function EditModel(obj,bid)
{
    var datastring="bid="+bid;
    // alert(datastring);
    $.ajax({
        type:"POST",
        url:"{{ route('user.get.item') }}",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
            // alert(returndata);
        if (returndata!="0") {
            $("#myModal").modal('show');
            var json = JSON.parse(returndata);
            $("#id").val(json.id);
            $("#category_id").val(json.sub_category_id);
            $("#item_name").val(json.item_name);
            $("#status").val(json.status);
        }
        }
    });
}
</script>
<script>

function checkSubmit()
{
    var category_id = $("#category_id").val();
    var item_name = $("#item_name").val();
    var status = $("#status").val();
    var id = $("#id").val();
    if (category_id=="") {
        $("#cat_err").fadeIn().html("Required");
        setTimeout(function(){ $("#cat_err").fadeOut(); }, 3000);
        $("#category_id").focus();
        return false;
    }
    if (item_name == "") {
        $("#name_err").fadeIn().html("Required");
        setTimeout(function(){ $("#name_err").fadeOut(); }, 3000);
        $("item_name").focus();
        return false;
    }
    if (status == "") {
        $("#status_err").fadeIn().html("Required");
        setTimeout(function(){ $("#status_err").fadeOut(); }, 3000);
        $("status").focus();
        return false;
    }
    else
    { 
        $('#editBrand').attr('disabled',true);
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ url('/user/items/update') }}",
            data:{id:id, category_id:category_id, item_name:item_name, status:status},
            cache:false,        
            success:function(returndata)
            {
                $('#editBrand').attr('disabled',false);
                $("#myModal").modal('hide');
                var oTable = $('#bootstrap-data-table-export').dataTable(); 
                oTable.fnDraw(false);
                toastr.success(returndata.success);
            }
        });
    }
}

$('body').on('click', '#delete', function () {
    var id = $(this).data("id");

    if(confirm("Are You sure want to delete !")){
        $.ajax({
            type: "delete",
            url: "{{ url('user/items') }}"+'/'+id,
            success: function (data) {
            var oTable = $('#bootstrap-data-table-export').dataTable(); 
            oTable.fnDraw(false);
            toastr.success(data.success);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
});

</script>
@endsection