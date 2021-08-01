@extends('customer.layout.main')
@section('title', 'Dashboard')
@section('customcss')

@endsection
@section('content')
<div class="main-page">
    <div class="tables">
        <h2 class="title1">Dashboard</h2>
        @if(count($cartCollection) > 0)
        <div class="panel-body widget-shadow">
            <h4>{{ \Cart::getTotalQuantity()}} Product(s) In Your Cart</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th width="35%">Image</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        // dd($cartCollection);
                    ?>
                    @foreach($cartCollection as $key => $item)
                    <tr>
                        <th scope="row">{{ ++$key }}</th>
                        <td><img src="ProductImg/{{ $item->attributes->image }}" alt="" width="25%"></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td><i class="fa fa-inr"></i>{{ \Cart::get($item->id)->getPriceSum() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        <form action="{{ route('customer.placed.order') }}" method="POST" style="display:inline-flex">
            @csrf
            <button type="submit" class="btn btn-success">Placed Order</button>
        </form>
        <a href="{{ url('/') }}"><button type="button" class="btn btn-primary" style="margin-left:20px;">Continue Shopping</button></a>
        </div>
        @endif
    </div>
</div>
@endsection
@section('customjs')

@endsection