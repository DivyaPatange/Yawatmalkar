@extends('admin.admin_layout.main')
@section('title', 'Beautician Schedule')
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
.btn{
    padding:1px 8px;
}
.btn > i {
    margin-right: 0px;
}
</style>
@endsection
@section('page_title', 'Beautician Schedule Management')
@section('breadcrumb1', 'Home')
@section('breadcrumb2')
<a href="{{ route('admin.beautician-schedule.index') }}">Beautician Schedule Management</a>
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
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Beautician Schedule List</h5>
                <a href="{{ route('admin.beautician-schedule.create') }}"><button type="button" class="btn btn-outline-primary float-right" title="" style="padding:10px 20px">Add New</button></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Beautician Name</th>
                                <th>Schedule Date</th>
                                <th>Schedule Day</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Max Appointment</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Doctor Name</th>
                                <th>Schedule Date</th>
                                <th>Schedule Day</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Max Appointment</th>
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
          <h4 class="modal-title">Edit Beautician Schedule</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="POST" >
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label>Beautician <span  style="color:red" id="name_err"> </span></label>
                    <select class="form-control js-example" id="name" name="name">
                        <option value="">-Select Beautician-</option>
                        @foreach($users as $u)
                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Schedule Date <span style="color:red;">*</span><span  style="color:red" id="date_err"> </span></label>
                    <input type="date" name="s_date" class="form-control" id="s_date" placeholder="Enter Schedule Date">
                </div>
                <div class="form-group">
                    <label>Start Time <span  style="color:red" id="start_time_err"> </span></label>
                    <input type="time" name="start_time" class="form-control" id="start_time" placeholder="Enter Start Time">
                </div>
                <div class="form-group">
                    <label>End Time <span  style="color:red" id="end_time_err"> </span></label>
                    <input type="time" name="end_time" class="form-control" id="end_time" placeholder="Enter End Time">
                </div>
                <div class="form-group">
                    <label>Max Appointment <span  style="color:red" id="appointment_err"> </span></label>
                    <input type="number" name="appointment" class="form-control" id="appointment" placeholder="Enter No. of Appointment">
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

<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script type=text/javascript>
var SITEURL = '{{ route('admin.beautician-schedule.index')}}';
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
    var table =$('#zero_config').DataTable({
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
                { data: 'name', name: 'name' },
                { data: 'schedule_date', name: 'schedule_date' },
                { data: 'schedule_day', name: 'schedule_day' },
                { data: 'start_time', name: 'start_time'},
                { data: 'end_time', name: 'end_time'},
                { data: 'max_appointment', name: 'max_appointment'},
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
        url:"{{ route('admin.get.beautician-schedule') }}",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
            // alert(returndata);
        if (returndata!="0") {
            $("#myModal").modal('show');
            var json = JSON.parse(returndata);
            $("#id").val(json.id);
            $("#name").val(json.name);
            $("#s_date").val(json.schedule_date);
            $("#start_time").val(json.start_time);
            $("#end_time").val(json.end_time);
            $("#appointment").val(json.max_appointment);
            // $("#adv_amt").val(json.advance_amt);
            // $("#total_amt").val(json.total_pay);
        }
        }
    });
}
function checkSubmit()
{
    var name = $("#name").val();
    var s_date = $("#s_date").val();
    var start_time = $("#start_time").val();
    var end_time = $("#end_time").val();
    var appointment = $("#appointment").val();
    var id = $("#id").val();
    if (name=="") {
        $("#name_err").fadeIn().html("Required");
        setTimeout(function(){ $("#name_err").fadeOut(); }, 3000);
        $("#name").focus();
        return false;
    }
    if (s_date=="") {
        $("#date_err").fadeIn().html("Required");
        setTimeout(function(){ $("#date_err").fadeOut(); }, 3000);
        $("#s_date").focus();
        return false;
    }
    if (start_time == "") {
        $("#start_time_err").fadeIn().html("Required");
        setTimeout(function(){ $("#start_time_err").fadeOut(); }, 3000);
        $("start_time").focus();
        return false;
    }
    if (end_time == "") {
        $("#end_time_err").fadeIn().html("Required");
        setTimeout(function(){ $("#end_time_err").fadeOut(); }, 3000);
        $("end_time").focus();
        return false;
    }
    if (appointment=="") {
        $("#appointment_err").fadeIn().html("Required");
        setTimeout(function(){ $("#appointment_err").fadeOut(); }, 3000);
        $("#appointment").focus();
        return false;
    }
    else
    { 
        $('#editBrand').attr('disabled',true);
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ url('/admin/beautician-schedule/update') }}",
            data:{id:id, name:name, s_date:s_date, start_time:start_time, end_time:end_time, appointment:appointment},
            cache:false,        
            success:function(returndata)
            {
            $('#editBrand').attr('disabled',false);
            $("#myModal").modal('hide');
            var oTable = $('#zero_config').dataTable(); 
            oTable.fnDraw(false);
            toastr.success(returndata.success);
            
            // location.reload();
            // $("#pay").val("");
            }
        });
    }
}

$('body').on('click', '#delete', function () {
    var id = $(this).data("id");

    if(confirm("Are You sure want to delete !")){
        $.ajax({
            type: "delete",
            url: "{{ url('admin/beautician-schedule') }}"+'/'+id,
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

$('body').on('click', '.switch_1', function () {
    var id = $(this).data("id");
    // alert(id);
    if(id != ''){
        $.ajax({
            type: "get",
            url: "{{ url('admin/beautician-schedule/status') }}"+'/'+id,
            success: function (data) {
                // alert(data.teacher);
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
</script>
@endsection