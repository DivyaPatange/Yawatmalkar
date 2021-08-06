@extends('customer.layout.main')
@section('title', 'Order Details')
@section('customcss')
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<style>
.error{
    color:red;
}
</style>
@endsection
@section('content')
<div class="main-page">
    <div class="typography">
        <h2 class="title1">Order Details</h2>
        <div class="grid_3 grid_4 widget-shadow">
            <div class="row">
                <div class="col-md-12">         
                    <p><span class="error" id="payment_err"></span></p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">User Details</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="well">
                        <div class="row">
                            <div class="col-md-4">
                                <p><b>Order Number</b></p>
                            </div> 
                            <div class="col-md-8">
                                <p>: {{ $order->order_number }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <p><b>Total</b></p>
                            </div> 
                            <div class="col-md-8">
                                <p>: {{ $order->grand_total }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <p><b>Quantity</b></p>
                            </div> 
                            <div class="col-md-8">
                                <p>: {{ $order->item_count }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="well">
                        <table class="table">
							<thead>
								<tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
								</tr>
							</thead>
							<tbody>
								@foreach($orderItems as $orderItem)
                                    <?php
                                        $product = DB::table('products')->where('id', $orderItem->product_id)->first();
                                    ?>
                                    <td width="40%"><img src="{{ asset('ProductImg/'.$product->product_img) }}" alt="" width="25%"></td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $orderItem->quantity }}</td>
                                    <td>{{ $orderItem->price }}</td>
                                @endforeach
							</tbody>
						</table>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('customer.payment', $order->id) }}" id="paymentForm">
                        @csrf
                        <button type="button" class="btn btn-success" id="paymentButton">Placed Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">User Details</h4>
        </div>
        <form method="POST" id="submitForm">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <span class="error" id="name_err"></span>
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="Fullname" name="fullname" id="fullname" value="@if(!empty($customerInfo)) {{ $customerInfo->fullname }} @endif">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <span class="error" id="mobile_err"></span>
                            <div class="form-line">
                                <input type="number" class="form-control" placeholder="Mobile No." name="mobile_no" id="mobile_no" value="@if(!empty($customerInfo)){{ $customerInfo->mobile_no }}@endif">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <span class="error" id="address_err"></span>
                            <div class="form-line">
                                <textarea class="form-control" placeholder="Address" name="address" id="address">@if(!empty($customerInfo)) {{ $customerInfo->address }} @endif</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <span class="error" id="country_err"></span>
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="Country" name="country" id="country" value="@if(!empty($customerInfo)) {{ $customerInfo->country }} @endif">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <span class="error" id="city_err"></span>
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="City" name="city" id="city" value="@if(!empty($customerInfo)) {{ $customerInfo->city }} @endif">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <span class="error" id="pin_err"></span>
                            <div class="form-line">
                                <input type="number" class="form-control" placeholder="Pin Code" name="pin_code" id="pin_code" value="@if(!empty($customerInfo)){{ $customerInfo->pin_code }}@endif">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary waves-effect" type="button" id="submitButton">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection
@section('customjs')
<script>

$('body').on('click', '#submitButton', function () {
    var country = $("#country").val();
    var fullname = $("#fullname").val();
    var mobile_no = $("#mobile_no").val();
    var address = $("#address").val();
    var city = $("#city").val();
    var pin_code = $("#pin_code").val();
    if (fullname=="") {
        $("#name_err").fadeIn().html("Required");
        setTimeout(function(){ $("#name_err").fadeOut(); }, 3000);
        $("#fullname").focus();
        return false;
    }
    if (mobile_no=="") {
        $("#mobile_err").fadeIn().html("Required");
        setTimeout(function(){ $("#mobile_err").fadeOut(); }, 3000);
        $("#mobile_no").focus();
        return false;
    }
    if (address=="") {
        $("#address_err").fadeIn().html("Required");
        setTimeout(function(){ $("#address_err").fadeOut(); }, 3000);
        $("#address").focus();
        return false;
    }
    if (country=="") {
        $("#country_err").fadeIn().html("Required");
        setTimeout(function(){ $("#country_err").fadeOut(); }, 3000);
        $("#country").focus();
        return false;
    }
    if (city=="") {
        $("#city_err").fadeIn().html("Required");
        setTimeout(function(){ $("#city_err").fadeOut(); }, 3000);
        $("#city").focus();
        return false;
    }
    if (pin_code=="") {
        $("#pin_err").fadeIn().html("Required");
        setTimeout(function(){ $("#pin_err").fadeOut(); }, 3000);
        $("#pin_code").focus();
        return false;
    }
    else
    { 
        // alert('hello');
        $.ajax({
            type:"POST",
            url:"{{ route('customer.save-customer-info') }}",
            data:{country:country,fullname:fullname,mobile_no:mobile_no,address:address,city:city,pin_code:pin_code},
            cache:false,        
            success:function(returndata)
            {
                toastr.success(returndata.success);
                $("#myModal").modal('hide');
            }
        });
    }
})

$('body').on('click', '#paymentButton', function () {
    var country = $("#country").val();
    var fullname = $("#fullname").val();
    var mobile_no = $("#mobile_no").val();
    var address = $("#address").val();
    var city = $("#city").val();
    var pin_code = $("#pin_code").val();
    if (country=="") {
        $("#payment_err").fadeIn().html("Please Complete Address Details");
        setTimeout(function(){ $("#payment_err").fadeOut(); }, 3000);
        return false;
    }
    if (fullname=="") {
        $("#payment_err").fadeIn().html("Please Complete Address Details");
        setTimeout(function(){ $("#payment_err").fadeOut(); }, 3000);
        return false;
    }
    if (mobile_no=="") {
        $("#payment_err").fadeIn().html("Please Complete Address Details");
        setTimeout(function(){ $("#payment_err").fadeOut(); }, 3000);
        return false;
    }
    if (address=="") {
        $("#payment_err").fadeIn().html("Please Complete Address Details");
        setTimeout(function(){ $("#payment_err").fadeOut(); }, 3000);
        return false;
    }
    if (city=="") {
        $("#payment_err").fadeIn().html("Please Complete Address Details");
        setTimeout(function(){ $("#payment_err").fadeOut(); }, 3000);
        return false;
    }
    if (pin_code=="") {
        $("#payment_err").fadeIn().html("Please Complete Address Details");
        setTimeout(function(){ $("#payment_err").fadeOut(); }, 3000);
        return false;
    }
    else
    { 
        $("#paymentForm").submit();   
    }
})
</script>
@endsection