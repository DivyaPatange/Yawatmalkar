<!DOCTYPE HTML>
<html>
<head>
<title>Yawatmalkar - Customer - @yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />

@include('customer.layout.stylesheet')
@yield('customcss')
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
	<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
		<!--left-fixed -navigation-->
		@include('customer.layout.sidebar')
	</div>
		<!--left-fixed -navigation-->
		
		<!-- header-starts -->
		@include('customer.layout.header')
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			@yield('content')
		</div>
	<!--footer-->
	<div class="footer">
	   <p>&copy; <?php echo date('Y');?> Yawatmalkar. All Rights Reserved | Design by <a href="https://w3layouts.com/" target="_blank">Iceico Technologies Pvt. Ltd.</a></p>		
	</div>
    <!--//footer-->
	</div>
		
	@include('customer.layout.scripts')
	@yield('customjs')
</body>
</html>