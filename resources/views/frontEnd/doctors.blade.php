@extends('frontEnd.frontLayout.main')
@section('title', 'Doctors')
@section('customcss')

@endsection
@section('content')

<main id="main">
    <section class="container-fluid py-0" style="height:70vh;background-image: linear-gradient(45deg, #4fbcc6c7, #4fbcc6c7), url({{ ('frontAsset/img/doctorMain.jpg') }});width: 100%;background-size: cover;">
        <div class="row justify-content-center">
            <div class="col-12 col-md-9 py-5 px-5 text-center">
                <h1 style="font-size:60px;font-weight:bold;color:#fff;padding-top:82px;">Looking for an  <span style="color:#000;">EXPERT DOCTORS</span> </h1>
                <p style="font-weight:bold;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt ut deserunt odio id, vero provident hic iure quod labore et magni optio nihil. Magni quam molestias fuga fugiat maxime placeat!</p>
            </div>
        </div>
    </section>
    <!-- ladies beauty service -->
    <section class="container-fluid py-5">
        <h2 style="font-size:48px;font-weight:bold;text-align:center;color#000;">  OUR <span style="color:#4FBCC6">SPECIALIST</span> </h2>
        <div class="container py-5">
            <div class="row card-deck">
                <div class="col-12 col-md-3 card text-center px-0" style="background:#F7F7F7;border:none;">
                    <img src="{{ ('frontAsset/img/dentist.png') }}" alt="">
                    <div class="card-body px-1 pt-0">
                        <h4>DENTIST</h4>
                        <p>It is long established fact that a reader will be distracted by the readable content </p>
                    </div>
                </div>
                <div class="col-12 col-md-3 card text-center px-0" style="border:none;">
                    <img src="{{ ('frontAsset/img/eye.jpg') }}" alt="">
                    <div class="card-body px-1 pt-0">
                        <h4>EYE SPECIALIST</h4>
                        <p>It is long established fact that a reader will be distracted by the readable content </p>
                    </div>
                </div>
                <div class="col-12 col-md-3 card text-center px-0" style="background:#F7F7F7;border:none;">
                    <img src="{{ ('frontAsset/img/ortho.jpg') }}" alt="">
                    <div class="card-body px-1 pt-0">
                        <h4>ORTHO</h4>
                        <p>It is long established fact that a reader will be distracted by the readable content </p>
                    </div>
                </div>
                <div class="col-12 col-md-3 card text-center px-0" style="border:none;">
                    <img src="{{ ('frontAsset/img/heart.png') }}" alt="">
                    <div class="card-body px-1 pt-0">
                        <h4>CARDIOLOGIST</h4>
                        <p>It is long established fact that a reader will be distracted by the readable content </p>
                    </div>
                </div>
            </div> 

            <div class="row card-deck pt-5">
                <div class="col-12 col-md-3 card text-center px-0" style="background:#F7F7F7;border:none;">
                    <img src="{{ ('frontAsset/img/dentist.png') }}" alt="">
                    <div class="card-body px-1 pt-0">
                        <h4>DENTIST</h4>
                        <p>It is long established fact that a reader will be distracted by the readable content </p>
                    </div>
                </div>
                <div class="col-12 col-md-3 card text-center px-0" style="border:none;">
                    <img src="{{ ('frontAsset/img/eye.jpg') }}" alt="">
                    <div class="card-body px-1 pt-0">
                        <h4>EYE SPECIALIST</h4>
                        <p>It is long established fact that a reader will be distracted by the readable content </p>
                    </div>
                </div>
                <div class="col-12 col-md-3 card text-center px-0" style="background:#F7F7F7;border:none;">
                    <img src="{{ ('frontAsset/img/ortho.jpg') }}" alt="">
                    <div class="card-body px-1 pt-0">
                        <h4>ORTHO</h4>
                        <p>It is long established fact that a reader will be distracted by the readable content </p>
                    </div>
                </div>
                <div class="col-12 col-md-3 card text-center px-0" style="border:none;">
                    <img src="{{ ('frontAsset/img/heart.png') }}" alt="">
                    <div class="card-body px-1 pt-0">
                        <h4>CARDIOLOGIST</h4>
                        <p>It is long established fact that a reader will be distracted by the readable content </p>
                    </div>
                </div>
            </div> 
        </div>
    </section>

    <!-- process of appoinment -->
    <section class="container">
        <h2 style="font-size:48px;font-weight:bold;text-align:center;">PROCESS OF <span style="color:#4FBCC6;">APPOINTMENT</span> </h2>       
        <div class="row card-deck pt-5">
            <div class="col-md-4 card text-center py-5" style="background:#58C5BF;border:none;color:#000;font-weight:bold;">
                <i class='bx bx-search' style="font-size:140px;padding-bottom:30px;"></i>
                <h4>Search the Category of the Doctor that you looking for</h4>
            </div>
            <div class="col-md-4 card text-center py-5" style="background:#58C5BF;border:none;color:#000;font-weight:bold;">
                <i class='bx bxs-notepad'style="font-size:140px;padding-bottom:30px;"></i>
                <h4>Go through Portfolio of the Doctors to know more about them</h4>
            </div>
            <div class="col-md-4 card text-center py-5" style="background:#58C5BF;border:none;color:#000;font-weight:bold;">
                <img src="{{ ('frontAsset/img/right.png') }}" style="width:130px;padding-bottom:30px;margin:0 auto;">
                <h4>Get the Appointment of the Doctor by Confirming the Details</h4>
            </div>
        </div>
    </section>

    <!-- testimonials -->
    <section class="container">
        <h2 style="font-size:48px;font-weight:bold;text-align:center;">TESTI<span style="color:#4FBCC6;">MONIALS</span> </h2>
        <div class="row card-deck py-5">
            <div class="col-md-6 card px-0" style="border:none;">
                <div class="row">
                    <div class="col-5"> 
                        <img src="{{ ('frontAsset/img/beautyMain.png') }}" alt="" width="100%;" style="border-radius:50%;">
                    </div>
                    <div class="col-7">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vero sequi nihil tenetur temporibus doloremque aut vel dicta fuga dolor, earum maiores asperiores laborum illo iste deleniti omnis. Impedit, doloremque nesciunt!</p>      
                    </div>
                </div>                
            </div>
            <div class="col-md-6 card px-0" style="border:none;">
                <div class="row">
                    <div class="col-5"> 
                        <img src="{{ ('frontAsset/img/beautyMain.png') }}" alt="" width="100%;" style="border-radius:50%;">
                    </div>
                    <div class="col-7">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vero sequi nihil tenetur temporibus doloremque aut vel dicta fuga dolor, earum maiores asperiores laborum illo iste deleniti omnis. Impedit, doloremque nesciunt!</p>  
                    </div>
                </div>                
            </div>
        </div>
    </section>

    <!-- flashes and upcoming -->
    <section class="container">
        <h2 style="font-size:48px;font-weight:bold;text-align:center;">FLASHES OF <span style="color:#4FBCC6;">UPCOMINGS</span> </h2>
        <div class="row card-deck py-5">
            <div class="col-md-6 card px-0" style="border:none;">
                <img src="{{ ('frontAsset/img/blood.jpg') }}" alt="" width="100%;">
            </div>
            <div class="col-md-6 card px-0" style="border:none;">
                <img src="{{ ('frontAsset/img/eyeCheck.jpg') }}" alt="" width="100%;">
            </div>
        </div>
    </section>

    <!-- offers -->
    <section class="container">
        <h2 style="font-size:48px;font-weight:bold;text-align:center;">ADVERTISEMENTS <span style="color:#4FBCC6;">AND OFFERS</span> </h2>
        <div class="row card-deck py-5">
            <div class="col-md-6 card px-0" style="border:none;">
                <img src="{{ ('frontAsset/img/offerD1.jpg') }}" alt="" width="100%;">
            </div>
            <div class="col-md-6 card px-0" style="border:none;">
                <img src="{{ ('frontAsset/img/offerD2.jpg') }}" alt="" width="100%;">
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