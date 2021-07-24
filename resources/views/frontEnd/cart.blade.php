@extends('frontEnd.frontLayout.main')
@section('title', 'Cart')
@section('customcss')
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<style>
.img-cart {
    display: block;
    max-width: 85px;
    height: auto;
    /* margin-left: auto; */
    margin-right: auto;
}
table tr td{
    border:1px solid #FFFFFF;    
}

table tr th {
    background:#eee;    
}

.panel-shadow {
    box-shadow: rgba(0, 0, 0, 0.3) 7px 7px 7px;
}
</style>
@endsection
@section('content')
<main id="main">
    <!-- our main categories -->
    <section class="container mainCategories mainDailyCategories">
        <h3 class="text-left">My Shopping Bag</h3>
        @if(\Cart::getTotalQuantity()>0)
			<h4>{{ \Cart::getTotalQuantity()}} Product(s) In Your Cart</h4><br>
		@else
			<h4>No Product(s) In Your Cart</h4><br>
			<a href="{{ url('/') }}">Continue Shopping</a>
			
		@endif
        <div class="row card-deck mt-2">
            <div class="col-md-12">
                <div class="panel panel-info panel-shadow">
                    <div class="panel-body"> 
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartCollection as $item)
                                    <tr>
                                        <td><img src="ProductImg/{{ $item->attributes->image }}" class="img-cart"></td>
                                        <td><strong>{{ $item->name }}</strong></td>
                                        <td>
                                        <form class="form-inline" action="{{ route('cart.update') }}" method="POST">
                                            @csrf
                                            <input class="form-control" type="text" value="{{ $item->quantity }}" id="quantity" name="quantity">
                                            <button rel="tooltip" class="btn btn-primary ml-2"><i class="fa fa-pencil"></i></button>
                                            <input type="hidden" value="{{ $item->id}}" id="id" name="id">
                                        </form>
                                        </td>
                                        <td>&#8377;{{ $item->price }}</td>
                                        <td>&#8377;{{ \Cart::get($item->id)->getPriceSum() }}</td>
                                        <td>        
                                            <form action="{{ route('cart.remove') }}" method="POST" class="form-inline"> 
								                {{ csrf_field() }}
                                                <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                                <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="7">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-right">Total Product</td>
                                        <td colspan="3">&#8377; {{ \Cart::getTotal() }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-right"><strong>Total</strong></td>
                                        <td colspan="3">&#8377; {{ \Cart::getTotal() }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>  
            </div>
        </div> 
        <div class="row card-deck mt-4">
            <div class="col-md-12">
            <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
				{{ csrf_field() }}
                <button class="btn btn-success"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Clear Cart</button>
            </form>
                <a href="#" class="btn btn-primary pull-right">Proceed to Checkout<span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </div>  
    </section> 
    <!-- blank bar -->
</main>
<!-- End #main -->
@endsection
@section('customjs')
<script>
    AOS.init();
</script>   
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">      
$(document).ready(function() {
    var s = skrollr.init();
})
</script>
@endsection