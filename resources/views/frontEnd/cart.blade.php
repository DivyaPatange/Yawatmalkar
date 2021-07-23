@extends('frontEnd.frontLayout.main')
@section('title', 'Cart')
@section('customcss')

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
			<a href="{{ url('/') }}" style="margin-bottom:20px">Continue Shopping</a>
			
		@endif
        <div class="row card-deck">
            <div class="col-md-12">
                <div class="table-responsive checkout-right animated wow slideInUp" data-wow-delay=".5s">
                    <table class="timetable_sub">
                        <thead>
                            <tr>
                                <th>Remove</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Sub-Total</th>
                            </tr>
                        </thead>
                            @foreach($cartCollection as $item)
                            <tr >
                                <td class="invert-closeb">
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                        <div class="rem">
                                            <button class="close1" style="border:none"></button>
                                        </div>
                                    </form>
                                    <!-- script trasfer to main layout -->
                                    
                                </td>
                                <td class="invert-image" width="36%"><a href="{{ url ('detail_view') }}"><img src="ProductImg/{{ $item->attributes->image }}" alt=" " class="img-responsive" /></a></td>
                                <td class="invert">
                                    <div class="quantity"> 
                                        <div class="quantity-select">  
                                        <form action="{{ route('cart.update') }}" method="POST">
                                            {{ csrf_field() }}       
                                            <input type="hidden" value="{{ $item->id}}" id="id" name="id">                  
                                            <div class="input-group">
                                                <input type="button" value="-" class="button-minus button" data-field="quantity">
                                                <input type="number" step="1" value="{{ $item->quantity }}" id="quantity" name="quantity" class="quantity-field">
                                                <input type="button" value="+" class="button-plus button" data-field="quantity">
                                                <button class="btn btn-secondary" style="margin-right: 25px;"><i class="glyphicon glyphicon-edit"></i></button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </td>
                                <td class="invert">{{ $item->name }}</td>
                                <td class="invert">&#8377;{{ $item->price }}</td>
                                <td class="invert">&#8377;{{ \Cart::get($item->id)->getPriceSum() }}</td>
                            </tr>
                            @endforeach
                            
                    </table>
                </div>    
            </div>
        </div>   
    </section> 
    <!-- blank bar -->
    <section class="container-fluid px-0" >
        <img src="{{ asset('frontAsset/img/daily needs/dailyBanner.jpg') }}"  alt="" width="100%">
    </section>               
    <!-- best deals -->
    <section class="container">
        <h3 class="pb-5 text-left">Best Deals</h3>
        <div class="row card-deck bestDeals">
            <div class="col card " style="width:100%;border-radius:8px;position: relative;">
                <img src="{{ asset('frontAsset/img/amulGhee.jpg') }}" alt="" width="100%">
                <div class="discountOffer">
                    <p>10% off</p>
                    <img src="{{ asset('frontAsset/img/offer.png') }}" alt="">
                </div>
                <div class="card-body px-0">
                    <h6>Amul Pure Ghee 1 L (pouch)</h6>
                    <h6 class="text-muted">M.R.P <s>485.00</s></h6>
                    <h6>&#x20B9; 444.00</h6>
                    <p style="padding-bottom:10px;color: #0bd60b;font-weight: bold;">Save &#x20B9; 41.00</p>
                    <h5 >Add to cart<button style="float:right;">+</button></h5>
                </div>
            </div>

            <div class="col card " style="width:100%;border-radius:8px;position: relative;">
                <img src="{{ asset('frontAsset/img/daily needs/ksPark.jpg') }}" alt="" width="100%">
                <div class="discountOffer">
                    <p>50% off</p>
                    <img src="{{ asset('frontAsset/img/offer.png') }}" alt="">
                </div>
                <div class="card-body px-0">
                    <h6>Kamasutra Spark Deodorant Spray for...</h6>
                    <h6 class="text-muted">M.R.P <s>329.00</s></h6>
                    <h6>&#x20B9; 164.50</h6>
                    <p style="padding-bottom:10px;color: #0bd60b;font-weight: bold;">Save &#x20B9; 164.50</p>
                    <h5 >Add to cart<button style="float:right;">+</button></h5>
                </div>
            </div>

            <div class="col card " style="width:100%;border-radius:8px;position: relative;">
                <img src="{{ asset('frontAsset/img/daily needs/dettol.jpg') }}" alt="" width="100%">
                <div class="discountOffer">
                    <p>13% off</p>
                    <img src="{{ asset('frontAsset/img/offer.png') }}" alt="">
                </div>
                <div class="card-body px-0">
                    <h6>Dettol Original Soap 125 g (Pack of..</h6>
                    <h6 class="text-muted">M.R.P <s>208.00</s></h6>
                    <h6>&#x20B9; 180.00</h6>
                    <p style="padding-bottom:10px;color: #0bd60b;font-weight: bold;">Save &#x20B9; 27.00</p>
                    <h5 >Add to cart<button style="float:right;">+</button></h5>
                </div>
            </div>

            <div class="col card " style="width:100%;border-radius:8px;position: relative;">
                <img src="{{ asset('frontAsset/img/daily needs/kissan.jpg') }}" alt="" width="100%">
                <div class="discountOffer">
                    <p>27% off</p>
                    <img src="{{ asset('frontAsset/img/offer.png') }}" alt="">
                </div>
                <div class="card-body px-0">
                    <h6>Kissan Fresh Tomato Ketchup 950 g</h6>
                    <h6 class="text-muted">M.R.P <s>120.00</s></h6>
                    <h6>&#x20B9; 87.00</h6>
                    <p style="padding-bottom:10px;color: #0bd60b;font-weight: bold;">Save &#x20B9; 33.00</p>
                    <h5 >Add to cart<button style="float:right;">+</button></h5>
                </div>
            </div>

            <div class="col card " style="width:100%;border-radius:8px;position: relative;">
                <img src="{{ asset('frontAsset/img/daily needs/amulCheese.jpg') }}" alt="" width="100%">
                <div class="discountOffer">
                    <p>8% off</p>
                    <img src="{{ asset('frontAsset/img/offer.png') }}" alt="">
                </div>
                <div class="card-body px-0">
                    <h6>Amul Cheese Block 200 g (Caton)</h6>
                    <h6 class="text-muted">M.R.P <s>105.00</s></h6>
                    <h6>&#x20B9; 97.50</h6>
                    <p style="padding-bottom:10px;color: #0bd60b;font-weight: bold;">Save &#x20B9; 8.50</p>
                    <h5 >Add to cart<button style="float:right;">+</button></h5>
                </div>
            </div>

            <div class="col card " style="width:100%;border-radius:8px;position: relative;">
                <img src="{{ asset('frontAsset/img/daily needs/monaco.jpg') }}" alt="" width="100%">
                <div class="discountOffer">
                    <p>25% off</p>
                    <img src="{{ asset('frontAsset/img/offer.png') }}" alt="">
                </div>
                <div class="card-body px-0">
                    <h6>Parle Monaco Classic Regular Salted..</h6>
                    <h6 class="text-muted">M.R.P <s>60.00</s></h6>
                    <h6>&#x20B9; 45.00</h6>
                    <p style="padding-bottom:10px;color: #0bd60b;font-weight: bold;">Save &#x20B9; 15.00</p>
                    <h5 >Add to cart<button style="float:right;">+</button></h5>
                </div>
            </div>

            <div class="col card " style="width:100%;border-radius:8px;position: relative;">
                <img src="{{ asset('frontAsset/img/daily needs/krackJack.jpg') }}" alt="" width="100%">
                <div class="discountOffer">
                    <p>25% off</p>
                    <img src="{{ asset('frontAsset/img/offer.png') }}" alt="">
                </div>
                <div class="card-body px-0">
                    <h6>Parle Krack Jack Crackers 400 g</h6>
                    <h6 class="text-muted">M.R.P <s>60.00</s></h6>
                    <h6>&#x20B9; 45.00</h6>
                    <p style="padding-bottom:10px;color: #0bd60b;font-weight: bold;">Save &#x20B9; 15.00</p>
                    <h5 >Add to cart<button style="float:right;">+</button></h5>
                </div>
            </div>

            <div class="col card " style="width:100%;border-radius:8px;position: relative;">
                <img src="{{ asset('frontAsset/img/daily needs/britania.jpg') }}" alt="" width="100%">
                <div class="discountOffer">
                    <p>25% off</p>
                    <img src="{{ asset('frontAsset/img/offer.png') }}" alt="">
                </div>
                <div class="card-body px-0">
                    <h6>Britannia Good Day Cashew Cookies 1..</h6>
                    <h6 class="text-muted">M.R.P <s>20.00</s></h6>
                    <h6>&#x20B9; 15.00</h6>
                    <p style="padding-bottom:10px;color: #0bd60b;font-weight: bold;">Save &#x20B9; 5.00</p>
                    <h5 >Add to cart<button style="float:right;">+</button></h5>
                </div>
            </div>
        </div>
    </section>

    <!-- offrs on essentials -->
    <section class="container">
        <h3 class="pb-5 text-left">Offers on Products</h3>
        <div class="row card-deck pb-5 productOffer">
            <div class="col-6 col-md-3 card text-center" >
                <div class="topBanner "><p>UP TO <i> 20%</i> OFF</p></div>
                <img src="{{ asset('frontAsset/img/daily needs/dal.png') }}" alt="" width="100%;">
                <p>Dals and Pulses</p>
            </div>
            <div class="col-6 col-md-3 card text-center" >
                <div class="topBanner "><p>UP TO <i> 50%</i> OFF</p></div>
                <img src="{{ asset('frontAsset/img/daily needs/atta.png') }}" alt="" width="100%;">
                <p>Atta, Flours & Sooji</p>
            </div>
            <div class="col-6 col-md-3 card text-center" >
                <div class="topBanner "><p>UP TO <i> 20%</i> OFF</p></div>
                <img src="{{ asset('frontAsset/img/daily needs/edibleOil.png') }}" alt="" width="100%;">
                <p>Edible Oils</p>
            </div>
            <div class="col-6 col-md-3 card text-center" >
                <div class="topBanner "><p>UP TO <i> 20%</i> OFF</p></div>
                <img src="{{ asset('frontAsset/img/daily needs/salt.png') }}" alt="" width="100%;">
                <p>Salt, Sugar & Jaggery</p>
            </div>
        </div>
        <div class="row card-deck pb-5 productOffer">
            <div class="col-6 col-md-3 card text-center" >
                <div class="topBanner "><p>UP TO <i> 20%</i> OFF</p></div>
                <img src="{{ asset('frontAsset/img/daily needs/bath.png') }}" alt="" width="100%;">
                <p>Bath & Hand Wash</p>
            </div>
            <div class="col-6 col-md-3 card text-center" >
                <div class="topBanner "><p>UP TO <i> 50%</i> OFF</p></div>
                <img src="{{ asset('frontAsset/img/daily needs/closeup.png') }}" alt="" width="100%;">
                <p>Toothpaste</p>
            </div>
            <div class="col-6 col-md-3 card text-center" >
                <div class="topBanner "><p>UP TO <i> 20%</i> OFF</p></div>
                <img src="{{ asset('frontAsset/img/daily needs/noodle.png') }}" alt="" width="100%;">
                <p>Noodle , Pasta , Vermcelli</p>
            </div>
            <div class="col-6 col-md-3 card text-center" >
                <div class="topBanner "><p>UP TO <i> 20%</i> OFF</p></div>
                <img src="{{ asset('frontAsset/img/daily needs/cookies.png') }}" alt="" width="100%;">
                <p>Biscuits & cookies</p>
            </div>
        </div>
        <h3 class="pb-5 text-left">Advertisements</h3>
        <div class="row py-5">
            <div class="col-6 col-md-4">
                <img class="card-img-top" src="{{ asset('frontAsset/img/daily needs/neviaOffer.jpg') }}" alt="Card image cap" width="100%;">
            </div>
            <div class="col-6  col-md-4">
                <img class="card-img-top" src="{{ asset('frontAsset/img/daily needs/palmolive.jpg') }}" alt="Card image cap" width="100%;">
            </div>
            <div class="col-6  col-md-4">
                <img class="card-img-top" src="{{ asset('frontAsset/img/daily needs/colgate.jpg') }}" alt="Card image cap" width="100%;">
            </div>
        </div>
        <div class="row py-5">
            <div class="col-6 col-md-4">
                <img class="card-img-top" src="{{ asset('frontAsset/img/daily needs/dove.jpg') }}" alt="Card image cap" width="100%;">
            </div>
            <div class="col-6  col-md-4">
                <img class="card-img-top" src="{{ asset('frontAsset/img/daily needs/homeDelivery.jpg') }}" alt="Card image cap" width="100%;">
            </div>
            <div class="col-6  col-md-4">
                <img class="card-img-top" src="{{ asset('frontAsset/img/daily needs/25Offer.jpg') }}" alt="Card image cap" width="100%;">
            </div>
        </div>
        <h3 class="pb-5 text-left">Flashings</h3>
        <div class="row py-5">
            <div class="col-6 col-md-6">
                <img class="card-img-top" src="{{ asset('frontAsset/img/daily needs/facewash.jpg') }}" alt="Card image cap" width="100%;">
            </div>
            <div class="col-6  col-md-6">
                <img class="card-img-top" src="{{ asset('frontAsset/img/daily needs/organic.jpg') }}" alt="Card image cap" width="100%;">
            </div>
        </div>
    </section>

    <!-- blank bar -->
    <section class="container-fluid px-0">
        <div class="container " style="width:100%;">
            <h3 class="pb-5 text-left">Basket</h3>
        </div>
        
        <img src="{{ asset('frontAsset/img/daily needs/33Offer.jpg') }}" alt="" width="100%;">
        
    </section>
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