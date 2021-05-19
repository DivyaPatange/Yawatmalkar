@extends('auth.auth_layout.main')
@section('title', 'Change Password')
@section('page_title', 'Change Password')
@section('customcss')


@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        @if ($message = Session::get('success'))
		<div class="alert alert-success alert-block mt-3">
			<button type="button" class="close" data-dismiss="alert">×</button>	
				<strong>{{ $message }}</strong>
		</div>
		@endif
		@if ($message = Session::get('danger'))
		<div class="alert alert-danger alert-block mt-3">
			<button type="button" class="close" data-dismiss="alert">×</button>	
				<strong>{{ $message }}</strong>
		</div>
		@endif
    </div>
</div>
<div class="row">
    <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-body">
            <form method="POST" action="{{ route('user.change-password.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" autocomplete="current_password">

                                @error('current_password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="password">
                                @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password Confirmation</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="password_confirmation">
                                @error('password_confirmation')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Change Password
                                </button>
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
@can('manage-users')
<script type=text/javascript>
$('body').on('click', '#submitForm', function () {
    var s_date = $("#s_date").val();
    var start_time = $("#start_time").val();
    var end_time = $("#end_time").val();
    var time = $("#time").val();
    
    if (s_date=="") {
        $("#date_err").fadeIn().html("Required");
        setTimeout(function(){ $("#date_err").fadeOut(); }, 3000);
        $("#s_date").focus();
        return false;
    }
    if (start_time == "") {
        $("#start_time_err").fadeIn().html("Required");
        setTimeout(function(){ $("#start_time_err").fadeOut(); }, 3000);
        $("start_time").focus();
        return false;
    }
    if (end_time == "") {
        $("#end_time_err").fadeIn().html("Required");
        setTimeout(function(){ $("#end_time_err").fadeOut(); }, 3000);
        $("end_time").focus();
        return false;
    }
    if (time=="") {
        $("#time_err").fadeIn().html("Required");
        setTimeout(function(){ $("#time_err").fadeOut(); }, 3000);
        $("#time").focus();
        return false;
    }
    else
    { 
        $("#form-submit").submit();
    }
})
</script>
@endcan 

@can('manage-beauty')
<script type=text/javascript>
$('body').on('click', '#submitForm', function () {
    var s_date = $("#s_date").val();
    var start_time = $("#start_time").val();
    var end_time = $("#end_time").val();
    var appointment = $("#appointment").val();
    
    if (s_date=="") {
        $("#date_err").fadeIn().html("Required");
        setTimeout(function(){ $("#date_err").fadeOut(); }, 3000);
        $("#s_date").focus();
        return false;
    }
    if (start_time == "") {
        $("#start_time_err").fadeIn().html("Required");
        setTimeout(function(){ $("#start_time_err").fadeOut(); }, 3000);
        $("start_time").focus();
        return false;
    }
    if (end_time == "") {
        $("#end_time_err").fadeIn().html("Required");
        setTimeout(function(){ $("#end_time_err").fadeOut(); }, 3000);
        $("end_time").focus();
        return false;
    }
    if (appointment=="") {
        $("#appointment_err").fadeIn().html("Required");
        setTimeout(function(){ $("#appointment_err").fadeOut(); }, 3000);
        $("#appointment").focus();
        return false;
    }
    else
    { 
        $("#form-submit").submit();
    }
})
</script>
@endcan
@endsection