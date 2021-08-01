@extends('customer.layout.main')
@section('title', 'Order Details')
@section('customcss')

@endsection
@section('content')
<div class="main-page">
    <div class="typography">
        <h2 class="title1">Order Details</h2>
        <div class="grid_3 grid_4 widget-shadow">
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
        </div>
    </div>
</div>
@endsection
@section('customjs')

@endsection