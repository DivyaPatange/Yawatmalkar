<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Yawatmalkar - @yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  @include('frontEnd.frontLayout.stylesheet')
  @yield('customcss')
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <style>
    .category{
      background-color:#232f3e;
      color:white;
      border:none;
    }
    .category:focus{
      background-color:#232f3e;
      color:white;
      border:none;
      box-shadow:none;
    }

 .menu-wrapper {
	 position: relative;
	 max-width: 100%;
	 height: 50px;
	 /* margin: 1em auto; */
	 /* border: 1px solid black; */
	 overflow-x: hidden;
	 overflow-y: hidden;
}
 .menu {
	 height: 50px;
	 background: #232f3e;
	 box-sizing: border-box;
	 white-space: nowrap;
	 overflow-x: auto;
	 overflow-y: hidden;
	 -webkit-overflow-scrolling: touch;
}
.item a{
  color:white;
}
 .menu .item {
	 display: inline-block;
	 /* width: 100px; */
	 height: 50%;
	 /* outline: 1px dotted gray; */
	 padding: 5px;
	 box-sizing: border-box;
}
 .paddle {
	 position: absolute;
	 top: 0;
	 bottom: 0;
	 width: 3em;
}
 .left-paddle {
	 left: 0;
}
 .right-paddle {
	 right: 0;
}
 .hidden {
	 display: none;
}
 .print {
	 margin: auto;
	 max-width: 500px;
}
 .print span {
	 display: inline-block;
	 width: 100px;
}

/* horizontal scroll navbar */
.info{
  text-align: center;
  font-size: 24px;
  color: #212121;
  text-transform: capitalize;
}
.nav-header .logo {
  width: 25%;
}
.nav-header nav {
  width: 75%;
}
.nav-header {
  border-radius: 5px;
}
.logo {
  text-align: center;
  border-right: 1px solid #4d4d4d;
  /* padding: 12px 24px 13px; */
}
.logo select {
  width: 100%;
  display: inline-block;
  vertical-align: middle;
}
.item {
  padding: 0px 16px 0px;
}
.item:not(:last-child) {
  border-right: 1px solid #7e7e7e;
}
header,
nav {
  font-size: 0;
}
.item {
  font-size: 18px;
}
.logo,
.item,
.middle {
  display: inline-block;
  vertical-align: middle;
}
.scroll {
  white-space: nowrap;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  -ms-overflow-style: -ms-autohiding-scrollbar;
}
.scroll::-webkit-scrollbar {
  display: none;
}
@media (max-width: 765px) {
  .item {
    font-size: 14px;
  }
  .category{
    font-size:0.9rem;
    padding: 0.375rem 0px;
  }
}
  </style>
</head>

<body>
@include('frontEnd.frontLayout.navbar')
  
<main id="main">
  @yield('content')
</main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  @include('frontEnd.frontLayout.script')
  @yield('customjs')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
  <script>
$('#category').change(function(){
  var categoryID = $(this).val();  
  if(categoryID){
    $.ajax({
      type:"GET",
      url:"{{url('/get-subcategory-list')}}?category_id="+categoryID,
      success:function(res){        
        if(res){
          $("#navbarDiv").empty();
          $.each(res.subCategory,function(key,value){
            $("#navbarDiv").append('<span class="item"><a href="'+key+'" class="nav-link">'+value+'</a></li>');
          });   
          $('#main').load('/'+res.category_id);
        }else{
          $("#navbarDiv").empty();
        }
      }
    });
  }else{
    $("#navbarDiv").empty();
  }   
});
</script>
<script>
  @if(Session::has('message'))
  var type = "{{ Session::get('alert-type', 'info') }}";
  switch(type){
      case 'info':
          toastr.info("{{ Session::get('message') }}");
          break;
      
      case 'warning':
          toastr.warning("{{ Session::get('message') }}");
          break;

      case 'success':
          toastr.success("{{ Session::get('message') }}");
          break;

      case 'error':
          toastr.error("{{ Session::get('message') }}");
          break;
  }
  @endif
</script>
</body>

</html>