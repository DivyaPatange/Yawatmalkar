@extends('admin.admin_layout.main')
@section('title', 'Product Details')
@section('customcss')
<link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://use.fontawesome.com/d5c7b56460.js"></script>
<style>
td.details-control:before {
    font-family: 'FontAwesome';
    content: '\f105';
    display: block;
    text-align: center;
    font-size: 20px;
}
tr.shown td.details-control:before{
   font-family: 'FontAwesome';
    content: '\f107';
    display: block;
    text-align: center;
    font-size: 20px;
}
.switch_box{
	display: -webkit-box;
	display: -ms-flexbox;
	display: flex;
	/* max-width: 200px; */
	/* min-width: 200px; */
	/* height: 200px; */
	-webkit-box-pack: center;
	    -ms-flex-pack: center;
	        justify-content: center;
	-webkit-box-align: center;
	    -ms-flex-align: center;
	        align-items: center;
	-webkit-box-flex: 1;
	    -ms-flex: 1;
	        flex: 1;
}

/* Switch 1 Specific Styles Start */

.box_1{
	/* background: #eee; */
}

input[type="checkbox"].switch_1{
	font-size: 20px;
	-webkit-appearance: none;
	   -moz-appearance: none;
	        appearance: none;
	width: 2.5em;
	height: 1.2em;
	background: #dd0c0c;
	border-radius: 3em;
	position: relative;
	cursor: pointer;
	outline: none;
	-webkit-transition: all .2s ease-in-out;
	transition: all .2s ease-in-out;
  }
  
  input[type="checkbox"].switch_1:checked{
	background: green;
  }
  
  input[type="checkbox"].switch_1:after{
	position: absolute;
	content: "";
	width: 1.5em;
	height: 1.5em;
	border-radius: 50%;
	background: #fff;
	-webkit-box-shadow: 0 0 .25em rgba(0,0,0,.3);
	        box-shadow: 0 0 .25em rgba(0,0,0,.3);
	-webkit-transform: scale(.7);
	        transform: scale(.7);
	left: 0;
	-webkit-transition: all .2s ease-in-out;
	transition: all .2s ease-in-out;
    top:-3px;
  }
  
  input[type="checkbox"].switch_1:checked:after{
	left: calc(100% - 1.5em);
  }
</style>
@endsection
@section('page_title', 'Product Details')
@section('breadcrumb1', 'Home')
@section('breadcrumb2')
<a href="{{ route('admin.products.show', $product->id) }}">Product Details</a>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h5 class="mt-4">Product Details</h5>
        <hr>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header text-center"> 
                <img src="{{  URL::asset('ProductImg/'.$product->product_img) }}" alt="" class="img-fluid" width="100px">
                <h6 class="mt-3">{{ $product->product_name }}</h6>
            </div>
            <?php
                $category = DB::table('categories')->where('id', $product->category_id)->first();
                $subCategory = DB::table('sub_categories')->where('id', $product->sub_category_id)->first();
                $item = DB::table('items')->where('id', $product->item_id)->first();
            ?>
            <div class="card-body">
                <p><b>Category :</b> @if(!empty($category)) {{ $category->category_name }} @endif</p>
                <p><b>Sub-Category :</b>@if(!empty($subCategory)) {{ $subCategory->sub_category }} @endif</p>
                <p><b>Item Name :</b>@if(!empty($item)) {{ $item->item_name }} @endif</p>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p><b>Product Name</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $product->product_name }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Selling Price</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $product->selling_price }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Cost Price</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $product->cost_price }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Description</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $product->description }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Status</b></p>
                    </div>
                    <div class="col-md-8">
                        <p>: {{ $product->status }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
@section('customjs')

<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script type=text/javascript>
</script>
@endsection`