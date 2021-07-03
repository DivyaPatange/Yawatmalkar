@extends('frontEnd.frontLayout.main')
@section('title', 'Electricals')
@section('customcss')

@endsection
@section('content')

<main id="main">
    <!-- slider section -->
    <div class="container-fluid px-0">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img class="d-block w-100" src="{{ asset('frontAsset/img/electrical/slider.jpg') }}" alt="First slide">
            </div>        
        </div>
        </div>
    </div>

    <!-- our main categories -->
    <section class="container mainCategories mainDailyCategories">
        <h3 class="pb-5 text-center">Featured Products</h3>
        <div class="row card-deck">
        <div class="col">
            <a href="doctors">
            <div class="card">
                <img class="card-img-top" src="{{ asset('frontAsset/img/electrical/1.jpg') }}" alt="Card image cap" width="100%;">
                <div class="card-body p-0 text-center">
                <!-- <h5 class="card-title">Doctors and Medicine</h5> -->
                </div>
            </div>
            </a>
        </div>
        <div class="col">
            <div class="card">
            <img class="card-img-top" src="{{ asset('frontAsset/img/electrical/2.jpg') }}" alt="Card image cap" width="100%;">
            <div class="card-body p-0 text-center">
                <!-- <h5 class="card-title">Legal Services</h5>             -->
            </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
            <img class="card-img-top" src="{{ asset('frontAsset/img/electrical/3.jpg') }}" alt="Card image cap" width="100%;">
            <div class="card-body p-0 text-center">
                <!-- <h5 class="card-title">Hospitality and Security Services</h5>             -->
            </div>
            </div>
            </div>
        <div class="col">
            <a href="beauty">
            <div class="card">
                <img class="card-img-top" src="{{ asset('frontAsset/img/electrical/4.jpg') }}" alt="Card image cap" width="100%;">
                <div class="card-body p-0 text-center">
                <!-- <h5 class="card-title">  Beauty Services</h5>             -->
                </div>
            </div>
            </a>
        </div>
        <div class="col">
            <div class="card">
            <img class="card-img-top" src="{{ asset('frontAsset/img/electrical/5.jpg') }}" alt="Card image cap" width="100%;">
            <div class="card-body p-0 text-center">
                <!-- <h5 class="card-title">Function and Events</h5>             -->
            </div>
            </div>
            </div>
        <div class="col">
            <div class="card">
            <img class="card-img-top" src="{{ asset('frontAsset/img/electrical/6.jpg') }}" alt="Card image cap" width="100%;">
            <div class="card-body p-0 text-center">
                <!-- <h5 class="card-title">Home and Home Decore</h5>             -->
            </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
            <img class="card-img-top" src="{{ asset('frontAsset/img/electrical/1.jpg') }}" alt="Card image cap" width="100%;">
            <div class="card-body p-0 text-center">
                <!-- <h5 class="card-title">Home and Home Decore</h5>             -->
            </div>
            </div>
        </div>
        
        </div>

    
    </section>

    <section class="container-fluid py-5" style="background:#404040;">
        <h3 class="pb-5 text-center text-white">Offers On Products</h3>
        <div class="row  eleCategories">
        <div class="col text-center">
            
        </div>
        <div class="col text-center">
        
        </div>
        <div class="col text-center">
        
        </div>
        <div class="col text-center">
            
        </div>
        <div class="col text-center">
            
        </div>
        <div class="col text-center">
            
        </div>
        <div class="col text-center">
            
        </div>
        <div class="col text-center">
            
        </div>
        
        </div>
        <h4 class="py-4 text-center text-white">Select From the Best offers to get the Best Deals</h4>
    </section>
    <!-- offrs on essentials -->
    <section class="container">
        <h3 class="pb-5 text-center">Seasonal Offers</h3>    
        <div class="row py-5">
        <div class="col-12 col-md-6">
            <img class="card-img-top" src="{{ asset('frontAsset/img/electrical/80Off.jpg') }}" alt="Card image cap" width="100%;">
        </div>
        <div class="col-12 col-md-6">
            <img class="card-img-top" src="{{ asset('frontAsset/img/electrical/appliances.jpg') }}" alt="Card image cap" width="100%;">
        </div>
        
        </div>
    </section>
    <!-- blank bar -->
    <section class="container-fluid px-0">
        <div class="container " style="width:100%;">
        <h3 class="pb-5 text-center">Best deals on the Electronics</h3>
        </div>    
        <img src="{{ asset('frontAsset/img/electrical/midBanner.jpg') }}" alt="" width="100%;">
        
    </section>

    <section class="container">
        <h3 class="pb-5 text-center">Advertisements</h3>
        <div class="row py-5">
            <div class="col-12 col-md-6">
                <img class="card-img-top" src="{{ asset('frontAsset/img/electrical/offer1.jpg') }}" alt="Card image cap" width="100%;">
            </div>
            <div class="col-12 col-md-6">
                <img class="card-img-top" src="{{ asset('frontAsset/img/electrical/brandOffer.jpg') }}" alt="Card image cap" width="100%;">
            </div>      
        </div>

        
        <div class="row py-5">
        <div class="col-6 col-md-6">
            <img class="card-img-top" src="{{ asset('frontAsset/img/electrical/diwaliOffer.jpg') }}" alt="Card image cap" width="100%;">
        </div>
        <div class="col-6  col-md-6">
            <img class="card-img-top" src="{{ asset('frontAsset/img/electrical/offer2.jpg') }}" alt="Card image cap" width="100%;">
        </div>
        </div>
    </section>
    <h3 class="pb-5 text-center">Upcomings and Openings</h3>
    <!-- blank bar -->
    <section class="container-fluid" style="background:#232F3E;height:200px;width:100%;">

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