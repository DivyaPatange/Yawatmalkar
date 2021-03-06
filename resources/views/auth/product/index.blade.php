@extends('auth.auth_layout.main')
@section('title', 'Products')
@section('page_title', 'Products')
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
			<button type="button" class="close" data-dismiss="alert">??</button>	
				<strong>{{ $message }}</strong>
		</div>
		@endif
		@if ($message = Session::get('danger'))
		<div class="alert alert-danger alert-block mt-3">
			<button type="button" class="close" data-dismiss="alert">??</button>	
				<strong>{{ $message }}</strong>
		</div>
		@endif
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title float-left">Products List</h4>
                <a href="{{ route('user.products.create') }}"><button type="button" class="btn btn-outline-primary float-right" title="">Add New</button></a>
            </div>
            <div class="bootstrap-data-table-panel">
                <div class="table-responsive">
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Product Image</th>
                                <th>Item Name</th>
                                <th>Product Name</th>
                                <th>Sub-Category</th>
                                <th>Selling Price</th>
                                <th>Cost Price</th>
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
var SITEURL = '{{ route('user.products.index')}}';
function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; width:100%">'+
        '<tr>'+
            '<td style="text-align:center">Status</td>'+
            '<td style="text-align:center">'+d.status+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td style="text-align:center">Action</td>'+
            '<td style="text-align:center">'+d.action+'</td>'+
        '</tr>'+
    '</table>';
}
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
                {
                    "className":      'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
                { data: 'product_img', name: 'product_img' },
                { data: 'item_id', name: 'item_id' },
                { data: 'product_name', name: 'product_name' },
                { data: 'sub_category_id', name: 'sub_category_id'},
                { data: 'selling_price', name: 'selling_price'},
                { data: 'cost_price', name: 'cost_price'},
               ],
        order: [[0, 'desc']]
      });
      $('#bootstrap-data-table-export tbody').on('click', 'td.details-control', function () {
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

</script>
<script>
$('body').on('click', '#delete', function () {
    var id = $(this).data("id");

    if(confirm("Are You sure want to delete !")){
        $.ajax({
            type: "delete",
            url: "{{ url('user/schedule') }}"+'/'+id,
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