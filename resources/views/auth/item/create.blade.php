@extends('auth.auth_layout.main')
@section('title', 'Items')
@section('page_title', 'Add Item')
@section('customcss')


@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" id="form-submit" action="{{ route('user.items.store') }}" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category<span style="color:red;">*</span><span  style="color:red" id="cat_err"> </span></label>
                                <select name="category_id" class="form-control" id="category_id">
                                    <option value="">Choose</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->sub_category }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Item Name <span  style="color:red" id="item_err"> </span></label>
                                <input type="text" name="item_name" class="form-control" id="item_name" placeholder="Enter Item Name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Status <span  style="color:red" id="status_err"> </span></label>
                                <select name="status" class="form-control" id="status">
                                    <option value="">-Select Status-</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
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
    var category_id = $("#category_id").val();
    var item_name = $("#item_name").val();
    var status = $("#status").val();
    
    if (category_id=="") {
        $("#cat_err").fadeIn().html("Required");
        setTimeout(function(){ $("#cat_err").fadeOut(); }, 3000);
        $("#category_id").focus();
        return false;
    }
    if (item_name == "") {
        $("#name_err").fadeIn().html("Required");
        setTimeout(function(){ $("#name_err").fadeOut(); }, 3000);
        $("item_name").focus();
        return false;
    }
    if (status == "") {
        $("#status_err").fadeIn().html("Required");
        setTimeout(function(){ $("#status_err").fadeOut(); }, 3000);
        $("status").focus();
        return false;
    }
    else
    { 
        $("#form-submit").submit();
    }
})
</script>
@endsection