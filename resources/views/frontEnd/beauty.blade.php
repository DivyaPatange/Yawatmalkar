@extends('frontEnd.frontLayout.main')
@section('title', 'Beauty')
@section('customcss')

@endsection
@section('content')
<main id="main">
    <section class="container-fluid py-0" style="background:#D6C2B9;border-bottom:40px solid gray;">
        <div class="row beautyHead">
            <div class="col-7 ">
                <h1 style="font-weight:bold;font-family: 'Playfair Display SC', serif;">Give New Look To Your <br> <span style="color:#E17890;">Personality</span> </h1>
            </div>
            <div class="col-5 pr-0">
                <img src="{{ asset('frontAsset/img/beautyMain.png') }}" alt="" width="100%;">
            </div>
        </div>
    </section>
    <!-- ladies beauty service -->
    <section class="container-fluid py-5" style="background:#FBEFEF;">
        <h2 style="font-weight:bold;text-align:center;"> <span style="color:#E17890">LADIES</span> BEAUTY <span style="color:#E17890">SERVICES</span> </h2>
        <div class="container py-5">
            <div class="row card-deck">
                <div class="col-md-7 card px-0">
                    <img src="{{ asset('frontAsset/img/beautyCard1.jpg') }}" alt="" width="100%;">
                </div>
                <div class="col-md-5 card text-center pt-2 beautyCard" style="background:#F2CFB3;border:none;">
                    <h2>Ladies Beauty Parlor</h2>
                    <button>Beauty Services 40</button> <br>
                    <button  style="color:#AC7442;">Explore</button>
                </div>
            </div>
            <div class="row card-deck py-5">
                <div class="col-md-5 card text-center beautyCard" style="background:#F2CFB3;border:none;">
                    <h2>Spa and Massage Parlor</h2>
                    <button>Beauty Services 40</button> <br>
                    <button style="color:#AC7442;">Explore</button>
                </div>
                <div class="col-md-7 card px-0">
                    <img src="{{ asset('frontAsset/img/beautyCard2.jpg') }}" alt="" width="100%;">
                </div>                
            </div>
            <div class="row card-deck pb-5">
                <div class="col-md-7 card px-0">
                    <img src="{{ asset('frontAsset/img/beautyCard2.jpg') }}" alt="" width="100%;">
                </div>
                <div class="col-md-5 card text-center beautyCard" style="background:#F2CFB3;border:none;">
                    <h2>Ladies Beauty Parlor</h2>
                    <button>Beauty Services 40</button> <br>
                    <button style="color:#AC7442;">Explore</button>
                </div>                                
            </div>
            <div class="row card-deck pb-5">
                <div class="col-md-5 card text-center beautyCard" style="background:#F2CFB3;border:none;">
                    <h2>Bridal Makup Suite</h2>
                    <button>Beauty Services 40</button> <br>
                    <button style="color:#AC7442;">Explore</button>
                </div>
                <div class="col-md-7 card px-0">
                    <img src="{{ asset('frontAsset/img/beautyCard3.jpg') }}" alt="" width="100%;">
                </div>                
            </div>
        </div>
    </section>

    <!-- mens section -->
    <section class="container-fluid py-5" style="background:#fff;">
        <h2 style="font-weight:bold;text-align:center;"> <span style="color:#5E6E73">MENS</span> HANDSOME <span style="color:#5E6E73">SERVICES</span> </h2>
        <div class="container py-5">
            <div class="row card-deck">
                <div class="col-md-5 card" style="background:#6C7E8A;">
                    <img src="{{ asset('frontAsset/img/men.png') }}" alt="">
                </div>
                <div class="col-md-7 card align-self-center" style="background:#A2B6C1;height:350px;">

                </div>
            </div>
            <div class="row card-deck pt-5">
                <div class="col-md-5 card" style="background:#6C7E8A;height:600px;">
                    
                </div>
                <div class="col-md-7 card align-self-center" style="background:#A2B6C1;height:350px;">

                </div>
            </div>
        </div>
    </section>

    <!-- cosmetics -->
    <section class="container-fluid">
        <h2 style="font-weight:bold;text-align:center;color:#E05B79;"> COSMETICS </h2>
        <div class="row">
            <div class="col  px-0">
                <img src="{{ asset('frontAsset/img/cosmetics.jpg') }}" alt="" width="100%;">
            </div>
        </div>       
    </section>

    <section class="container">
        <h2 style="font-weight:bold;text-align:center;">PROCESS OF <span style="color:#E05B79">APPOINTMENT</span> </h2>       
        <div class="row card-deck pt-5">
            <div class="col-md-4 card text-center py-5" style="background:#58C5BF;border:none;color:#000;font-weight:bold;">
                <i class='bx bx-search' style="font: size 48px;padding-bottom:30px;"></i>
                <h4>Search the Category of the Doctor that you looking for</h4>
            </div>
            <div class="col-md-4 card text-center py-5" style="background:#58C5BF;border:none;color:#000;font-weight:bold;">
                <i class='bx bxs-notepad' style="font: size 48px;padding-bottom:30px;"></i>
                <h4>Go through Portfolio of the Doctors to know more about them</h4>
            </div>
            <div class="col-md-4 card text-center py-5" style="background:#58C5BF;border:none;color:#000;font-weight:bold;">
                <img src="{{ asset('frontAsset/img/right.png') }}" style="width:30px;padding-bottom:30px;margin:0 auto;">
                <h4>Get the Appointment of the Doctor by Confirming the Details</h4>
            </div>
        </div>
    </section>

    <!-- flashes and upcoming -->
    <section class="container">
        <h2 style="font-weight:bold;text-align:center;">FLASHES OF <span style="color:#E05B79">UPCOMINGS</span> </h2>
        <div class="row card-deck py-5">
            <div class="col-md-6 card px-0" style="border:none;">
                <img src="{{ asset('frontAsset/img/flashCard1.jpg') }}" alt="" width="100%;">
            </div>
            <div class="col-md-6 card px-0" style="border:none;">
                <img src="{{ asset('frontAsset/img/flashCard2.jpg') }}" alt="" width="100%;">
            </div>
        </div>
    </section>

    <!-- offers -->
    <section class="container">
        <h2 style="font-weight:bold;text-align:center;">ADVERTISEMENTS <span style="color:#E05B79">AND OFFERS</span> </h2>
        <div class="row card-deck py-5">
            <div class="col-md-6 card px-0" style="border:none;">
                <img src="{{ asset('frontAsset/img/offerCard1.jpg') }}" alt="" width="100%;">
            </div>
            <div class="col-md-6 card px-0" style="border:none;">
                <img src="{{ asset('frontAsset/img/offerCard2.jpg') }}" alt="" width="100%;">
            </div>
        </div>
    </section>

    <!-- testimonials -->
    <section class="container">
        <h2 style="font-weight:bold;text-align:center;">TESTI<span style="color:#E05B79">MONIALS</span> </h2>
        <div class="row card-deck py-5">
            <div class="col-md-6 card px-0" style="border:none;">
                <div class="row">
                    <div class="col-5"> 
                        <img src="{{ asset('frontAsset/img/beautyMain.png') }}" alt="" width="100%;" style="border-radius:50%;">
                    </div>
                    <div class="col-7">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vero sequi nihil tenetur temporibus doloremque aut vel dicta fuga dolor, earum maiores asperiores laborum illo iste deleniti omnis. Impedit, doloremque nesciunt!</p>         
                    </div>
                </div>                
            </div>
            <div class="col-md-6 card px-0" style="border:none;">
                <div class="row">
                    <div class="col-5"> 
                        <img src="{{ asset('frontAsset/img/beautyMain.png') }}" alt="" width="100%;" style="border-radius:50%;">
                    </div>
                    <div class="col-7">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vero sequi nihil tenetur temporibus doloremque aut vel dicta fuga dolor, earum maiores asperiores laborum illo iste deleniti omnis. Impedit, doloremque nesciunt!</p>       
                    </div>
                </div>                
            </div>
        </div>
    </section>
</main>
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