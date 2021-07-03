@extends('frontEnd.frontLayout.main')
@section('title', 'Index')
@section('customcss')

@endsection
@section('content') 
<main id="main">
    <div class="container">
        <div class="row  categories">
            <div class="col text-center">
                <img src="{{ asset('frontAsset/img/grocery.png') }}" alt="" width="100%;">
                <p>Grocery</p>
            </div>
            <div class="col text-center">
                <img src="{{ asset('frontAsset/img/mobiles.png') }}" alt="" width="100%;">
                <p>Mobiles</p>
            </div>
            <div class="col text-center">
                <img src="{{ asset('frontAsset/img/fashion.png') }}" alt="" width="100%;">
                <p>Fashion</p>
            </div>
            <div class="col text-center">
                <img src="{{ asset('frontAsset/img/electronics.png') }}" alt="" width="100%;">
                <p>Electronics</p>
            </div>
            <div class="col text-center">
                <img src="{{ asset('frontAsset/img/home.png') }}" alt="" width="100%;">
                <p>Home</p>
            </div>
            <div class="col text-center">
                <img src="{{ asset('frontAsset/img/appliances.png') }}" alt="" width="100%;">
                <p>Appliances</p>
            </div>
            <div class="col text-center">
                <img src="{{ asset('frontAsset/img/travel.png') }}" alt="" width="100%;">
                <p>Travel</p>
            </div>
            <div class="col text-center">
                <img src="{{ asset('frontAsset/img/beauty.png') }}" alt="" width="100%;">
                <p>Beauty, Toys & more</p>
            </div>       
        </div>
    </div>
    <!-- slider section -->
    <div class="container-fluid px-0">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('frontAsset/img/slider-1.jpg') }}" alt="First slide">
                </div>
            </div>
        </div>
    </div>
    <!-- our main categories -->
    <section class="container mainCategories">
        <h3 class="pb-5">Our Main Categories</h3>
        <div class="row card-deck">
            <div class="col">
                <a href="doctors">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('frontAsset/img/doctor.jpg') }}" alt="Card image cap" width="100%;">
                        <div class="card-body px-1 text-center">
                            <h5 class="card-title">Doctors and Medicine</h5>            
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('frontAsset/img/law.jpg') }}" alt="Card image cap" width="100%;">
                    <div class="card-body px-1 text-center">
                        <h5 class="card-title">Legal Services</h5>            
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('frontAsset/img/hospitality.jpg') }}" alt="Card image cap" width="100%;">
                    <div class="card-body px-1 text-center">
                        <h5 class="card-title">Hospitality and Security Services</h5>            
                    </div>
                </div>
            </div>
            <div class="col">
                <a href="beauty">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('frontAsset/img/beauty.jpg') }}" alt="Card image cap" width="100%;">
                        <div class="card-body px-1 text-center">
                            <h5 class="card-title">  Beauty Services</h5>            
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('frontAsset/img/function.jpg') }}" alt="Card image cap" width="100%;">
                    <div class="card-body px-1 text-center">
                        <h5 class="card-title">Function and Events</h5>            
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('frontAsset/img/homeDecor.jpg') }}" alt="Card image cap" width="100%;">
                    <div class="card-body px-1 text-center">
                        <h5 class="card-title">Home and Home Decore</h5>            
                    </div>
                </div>
            </div> 
        </div>
        <div class="row card-deck">
            <div class="col">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('frontAsset/img/tyre.jpg') }}" alt="Card image cap" width="100%;">
                    <div class="card-body px-1 text-center">
                        <h5 class="card-title">Car and Car Services</h5>            
                    </div>
                </div>
            </div>
            <div class="col">
                <a href="dailyneeds">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('frontAsset/img/grocery.jpg') }}" alt="Card image cap" width="100%;">
                        <div class="card-body px-1 text-center">
                            <h5 class="card-title">Daily Needs and Groceries</h5>            
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('frontAsset/img/globe.jpg') }}" alt="Card image cap" width="100%;">
                    <div class="card-body px-1 text-center">
                        <h5 class="card-title">Tours and Travels</h5>            
                    </div>
                </div>
            </div>
            <div class="col">
                <a href="electricals">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('frontAsset/img/electronics.jpg') }}" alt="Card image cap" width="100%;">
                        <div class="card-body px-1 text-center">
                            <h5 class="card-title">Electronics and Consuable</h5>            
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('frontAsset/img/mobile1.jpg') }}" alt="Card image cap" width="100%;">
                    <div class="card-body px-1 text-center">
                        <h5 class="card-title">Electronics and Consumable</h5>            
                    </div>
                </div>
            </div>       
            <div class="col">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('frontAsset/img/gym.jpg') }}" alt="Card image cap" width="100%;">
                    <div class="card-body px-1 text-center">
                        <h5 class="card-title">Gym and Fitness</h5>            
                    </div>
                </div>
            </div>   
        </div>
    </section> 
    <!-- blank bar -->
    <section class="container-fluid" style="background:#232F3E;height:200px;width:100%;">
    </section>

    <!-- our top deals -->
    <section class="container">
        <h3 class="pb-5">Our Top Deals</h3>
        <div class="row card-deck topDeals">
            <div class="col card" style="background:#232F3E;border-radius:8px;height:150px;"></div>
            <div class="col card" style="background:#232F3E;border-radius:8px;height:150px;"></div>
            <div class="col card" style="background:#232F3E;border-radius:8px;height:150px;"></div>
            <div class="col card" style="background:#232F3E;border-radius:8px;height:150px;"></div>
            <div class="col card" style="background:#232F3E;border-radius:8px;height:150px;"></div>
            <div class="col card" style="background:#232F3E;border-radius:8px;height:150px;"></div>
            <div class="col card" style="background:#232F3E;border-radius:8px;height:150px;"></div>
            <div class="col card" style="background:#232F3E;border-radius:8px;height:150px;"></div>
        </div>

        <div class="row py-5">
            <div class="col-md-6 mt-3">
                <img class="card-img-top" src="{{ asset('frontAsset/img/rbl.jpg') }}" alt="Card image cap" width="100%;">
            </div>
            <div class="col-md-6 mt-3">
                <img class="card-img-top" src="{{ asset('frontAsset/img/simpl.jpg') }}" alt="Card image cap" width="100%;">
            </div>
        </div>
    </section>
    <!-- offrs on essentials -->
    <section class="container">
        <h3 class="pb-5">Offers on Essentials</h3>
        <div class="row card-deck pb-5">
            <div class="col-6 col-md-3  card" style="width:90%;background:#232F3E;border-radius:8px;height:300px;"></div>
            <div class="col-6 col-md-3 card" style="width:90%;background:#232F3E;border-radius:8px;height:300px;"></div>
            <div class="col-6 col-md-3 card" style="width:90%;background:#232F3E;border-radius:8px;height:300px;"></div>
            <div class="col-6 col-md-3 card" style="width:90%;background:#232F3E;border-radius:8px;height:300px;"></div>
        </div>

        <h3 class="pb-5">Offers on Daily Essentials</h3>
        <div class="row py-5">
            <div class="col-6">
                <img class="card-img-top" src="{{ asset('frontAsset/img/offer1.jpg') }}" alt="Card image cap" width="95%;">
            </div>
            <div class="col-6">
                <img class="card-img-top" src="{{ asset('frontAsset/img/offer2.jpg') }}" alt="Card image cap" width="95%;">
            </div>
        </div>
    </section>

    <!-- blank bar -->
    <section class="container-fluid" style="background:#232F3E;height:200px;width:100%;">
        <h3 class="pb-5 text-white">Seasonals</h3>
    </section>

    <section class="container">
        <div class="row">
            <div class="col-6">
                <img class="card-img-top" src="{{ asset('frontAsset/img/shorts.jpg') }}" alt="Card image cap" width="100%;">
            </div>
            <div class="col-6">
                <img class="card-img-top" src="{{ asset('frontAsset/img/tshirts.jpg') }}" alt="Card image cap" width="100%;">
            </div>
        </div>

        <div class="row py-5">
            <div class="col-6">
                <img class="card-img-top" src="{{ asset('frontAsset/img/trackPants.jpg') }}" alt="Card image cap" width="100%;">
            </div>
            <div class="col-6">
                <img class="card-img-top" src="{{ asset('frontAsset/img/kurtas.jpg') }}" alt="Card image cap" width="100%;">
            </div>
        </div>
    </section>

    <!-- news and flashes -->
    <section class="container">
        <h3 class="pb-5 ">News and Flashes</h3>
        <div class="row card-deck pb-5">
            <div class="col-6 card" style="width:100%;background:#232F3E;border-radius:8px;height:300px;"></div>
            <div class="col-6 card" style="width:100%;background:#232F3E;border-radius:8px;height:300px;"></div>
        </div>
        <div class="row card-deck pb-5">
            <div class="col-6 card" style="width:100%;background:#232F3E;border-radius:8px;height:300px;"></div>
            <div class="col-6 card" style="width:100%;background:#232F3E;border-radius:8px;height:300px;"></div>
        </div>
    </section>
    <!-- customize your basket -->
    <h3 class="pb-5 text-white">Customize Your Basket</h3>
    <section class="container-fluid pt-0" style="background:#DBB578;width:100%;">
        <div class="row">
            <div class="col-3 col-md-3 align-self-center">
                <img src="{{ asset('frontAsset/img/basket.jpg') }}" alt="" width="50%;">
            </div>
            <div class="col-9 col-md-7 pt-5">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo adipisci eligendi, similique amet itaque illo aliquid modi alias unde officia nesciunt tempore voluptas nam. Unde, pariatur veritatis. Earum, voluptatem dolorum.</p>
            </div>
            <div class="col-12 col-md-2 pt-5 align-self-end">
                <button style="padding:10px 30px;color:#fff;background:#232F3E;border:none;">Upload Pic</button>
            </div>
        </div>
    </section>
    <!-- offers on service -->
    <section class="container">
        <h3 class="pb-5">Offers on Service</h3>
        <div class="row card-deck pb-5">
            <div class="col-6 col-md-3 card" style="width:100%;background:#BDEDE6;border-radius:8px;height:300px;"></div>
            <div class="col-6 col-md-3 card" style="width:100%;background:#BDEDE6;border-radius:8px;height:300px;"></div>
            <div class="col-6 col-md-3 card" style="width:100%;background:#BDEDE6;border-radius:8px;height:300px;"></div>
            <div class="col-6 col-md-3 card" style="width:100%;background:#BDEDE6;border-radius:8px;height:300px;"></div>
        </div>
    </section>
</main><!-- End #main -->
@endsection
@section('customjs')
<script>
    AOS.init();
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
@endsection