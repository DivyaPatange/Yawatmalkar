@extends('auth.auth_layout.main')
@section('title', 'Products')
@section('page_title', 'Add Product')
@section('customcss')


@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" id="form-submit" action="{{ route('user.products.store') }}" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category<span style="color:red;">*</span><span  style="color:red" id="cat_err"> </span></label>
                                <select name="sub_category_id" class="form-control" id="sub_category_id">
                                    <option value="">Choose</option>
                                    @foreach($subCategory as $s)
                                    <option value="{{ $s->id }}">{{ $s->sub_category }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Item Name<span style="color:red;">*</span><span  style="color:red" id="item_err"> </span></label>
                                <select name="item_id" class="form-control" id="item_id">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Product Name <span  style="color:red" id="name_err"> </span></label>
                                <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Enter Product Name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Product Image<span  style="color:red" id="img_err"> </span></label>
                                <input type="file" name="product_img" class="form-control" id="product_img">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Selling Price <span  style="color:red" id="selling_err"> </span></label>
                                <input type="number" name="selling_price" class="form-control" id="selling_price" placeholder="Enter Selling Price">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Cost Price <span  style="color:red" id="cost_err"> </span></label>
                                <input type="number" name="cost_price" class="form-control" id="cost_price" placeholder="Enter Cost Price">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Status <span  style="color:red" id="status_err"> </span></label>
                                <select name="status" class="form-control" id="status">
                                    <option value="">-Select Status-</option>
                                    <option value="In-Stock">In-Stock</option>
                                    <option value="Out of Stock">Out of Stock</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Product Description <span  style="color:red" id="description_err"> </span></label>
                                <textarea name="description" class="form-control" id="description" placeholder="Enter Description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <hr>
                        </div>
                        <div class="col-md-12">
                            <button type="button" id="submitForm" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 
@section('customjs')
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script type=text/javascript>
$('body').on('click', '#submitForm', function () {
    var sub_category_id = $("#sub_category_id").val();
    var item_id = $("#item_id").val();
    var product_name = $("#product_name").val();
    var product_img = $("#product_img").val();
    var selling_price = $("#selling_price").val();
    var cost_price = $("#cost_price").val();
    var status = $("#status").val();

    if (sub_category_id=="") {
        $("#cat_err").fadeIn().html("Required");
        setTimeout(function(){ $("#cat_err").fadeOut(); }, 3000);
        $("#sub_category_id").focus();
        return false;
    }
    if (item_id == "") {
        $("#item_err").fadeIn().html("Required");
        setTimeout(function(){ $("#item_err").fadeOut(); }, 3000);
        $("item_id").focus();
        return false;
    }
    if (product_name == "") {
        $("#name_err").fadeIn().html("Required");
        setTimeout(function(){ $("#name_err").fadeOut(); }, 3000);
        $("product_name").focus();
        return false;
    }
    if (product_img == "") {
        $("#img_err").fadeIn().html("Required");
        setTimeout(function(){ $("#img_err").fadeOut(); }, 3000);
        $("product_img").focus();
        return false;
    }
    if (selling_price=="") {
        $("#selling_err").fadeIn().html("Required");
        setTimeout(function(){ $("#selling_err").fadeOut(); }, 3000);
        $("#selling_price").focus();
        return false;
    }
    if (cost_price=="") {
        $("#cost_err").fadeIn().html("Required");
        setTimeout(function(){ $("#cost_err").fadeOut(); }, 3000);
        $("#cost_price").focus();
        return false;
    }
    if (status=="") {
        $("#status_err").fadeIn().html("Required");
        setTimeout(function(){ $("#status_err").fadeOut(); }, 3000);
        $("#status").focus();
        return false;
    }
    else
    { 
        $("#form-submit").submit();
    }
})

$('#sub_category_id').change(function(){
  var subCategoryID = $(this).val();  
  if(subCategoryID){
    $.ajax({
      type:"GET",
      url:"{{url('/user/get-items-list')}}?sub_category_id="+subCategoryID,
      success:function(res){        
      if(res){
        $("#item_id").empty();
        $("#item_id").append('<option value="">Select Item Name</option>');
        $.each(res,function(key,value){
          $("#item_id").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#item_id").empty();
      }
      }
    });
  }else{
    $("#item_id").empty();
  }   
});
</script>
@endsection