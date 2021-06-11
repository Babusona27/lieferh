@extends('admin.loginLayout')
@section('content')
<style>
	.wrapper{
		display:  none !important;
	}
</style>
<div class="login-box">
  <div class="login-logo">

  	<!-- <img src="{{asset('public/images/admin/admin_logo.png')}}" class="website-hide"> -->

    <div style="font-size: 25px;"><b> Welcome</b>To Admin Panel</div>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <!-- if email or password are not correct -->
    @if( count($errors) > 0)
    	@foreach($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
          <span class="sr-only">Error:</span>
          {{ $error }}
        </div>
      @endforeach
    @endif

    @if(Session::has('loginError'))
      <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        {!! session('loginError') !!}
      </div>
    @endif

    @if(Session::has('signUpSuccess'))
      <div class="alert alert-success" role="alert">
        {{-- <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span> --}}
        {!! session('signUpSuccess') !!}
      </div>
    @endif

    <form method="POST" action="{{ url('admin/checkLogin') }}" class="form-validate">
      @csrf
      <div class="form-group has-feedback">
        <input id="email" type="email" class="form-control email-validate" name="email" value="">
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> Please enter your valid email address.</span>
        <span class="help-block hidden"> Please enter your valid email address.</span>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" name='password' class='form-control field-validate' value="">
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> Please enter your passwrod.</span>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span class="help-block hidden">This field is required.</span>
      </div>

      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" id="login">
            Login
          </button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <p class="login-box-msg">don't have an account <a href="{{ URL::to('admin/signUp')}}" ><b>sign up</b></a> here</p>
  </div>

  <!-- /.login-box-body -->
</div>
