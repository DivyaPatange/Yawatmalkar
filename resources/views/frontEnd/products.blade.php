@extends('frontEnd.frontLayout.main')
@section('title', 'Products')
@section('customcss')

@endsection
@section('content')
<main id="main">
    <section class="container">
        <h3 class="pb-5 text-left">Our Products</h3>
        <div class="row card-deck bestDeals">
            @foreach($products as $p)
            <div class="col-md-3" style="border-radius:8px;">
                <div class="card">
                    <img src="{{ asset('ProductImg/'.$p->product_img) }}" alt="" width="100%">
                    <!-- <div class="discountOffer">
                        <img src="{{ asset('ProductImg/'.$p->product_img) }}" alt="">
                    </div> -->
                    <div class="card-body px-0" style="height:135px">
                        <h6>{{ $p->product_name }}</h6>
                        <h6 class="text-muted">M.R.P <s>{{ $p->cost_price }}</s></h6>
                        <h6>&#x20B9; {{ $p->selling_price }}</h6>
                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $p->id }}" id="id" name="id">
                            <input type="hidden" value="{{ $p->product_name }}" id="name" name="name">
                            <input type="hidden" value="{{ $p->selling_price }}" id="price" name="price">
                            <input type="hidden" value="{{ $p->product_img }}" id="img" name="img">
                            <input type="hidden" value="1" id="quantity" name="quantity">
                            <h5 >Add to cart<button style="float:right;">+</button></h5>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- offrs on essentials -->
    <!-- <section class="container">
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
    </section> -->

    <!-- blank bar -->
    <!-- <section class="container-fluid px-0">
        <div class="container " style="width:100%;">
            <h3 class="pb-5 text-left">Basket</h3>
        </div>
        
        <img src="{{ asset('frontAsset/img/daily needs/33Offer.jpg') }}" alt="" width="100%;">
        
    </section> -->
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