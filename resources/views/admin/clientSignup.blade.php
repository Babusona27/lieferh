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
    <p class="login-box-msg">Sign up for Client</p>

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

    @if(Session::has('signUpError'))
      <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        {!! session('signUpError') !!}
      </div>
    @endif

    
    <form method="POST" action="{{ url('admin/signUp') }}" class="form-validate" id="form1">
      @csrf
      <div class="form-group has-feedback">
        <input id="company_name" type="text" class="form-control field-validate" name="company_name" value="">
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> Please enter your Company Name.</span>
        <span class="help-block hidden"> Please enter your Company Name.</span>
      </div>
      <div class="form-group has-feedback">
        <input id="sur_name" type="text" class="form-control field-validate" name="sur_name" value="">
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> Please enter your Family Name.</span>
        <span class="help-block hidden"> Please enter your Family Name.</span>
      </div>
      <div class="form-group has-feedback">
        <input id="name" type="text" class="form-control field-validate" name="name" value="">
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> Please enter your First Name.</span>
        <span class="help-block hidden"> Please enter your First Name.</span>
      </div>
      <div class="form-group has-feedback">
        <input id="middle_name" type="text" class="form-control" name="middle_name" value="">
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> Please enter your Middle Name (optional).</span>
        <span class="help-block hidden"> Please enter your Middle Name.</span>
      </div>
      <div class="form-group has-feedback">
        <input id="email" type="email" class="form-control email-validate" name="email" value="">
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> Please enter your valid email address.</span>
        <span class="help-block hidden"> Please enter your valid email address.</span>
      </div>
      <div class="form-group has-feedback">
        <input id="user_phone" type="text" class="form-control field-validate" name="user_phone" value="">
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> Please enter your Phone Number.</span>
        <span class="help-block hidden"> Please enter your Phone Number.</span>
      </div>
      <div class="form-group has-feedback">
        <input id="alt_mobile" type="text" class="form-control" name="alt_mobile" value="">
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> Please enter your Mobile Number (optional).</span>
        <span class="help-block hidden"> Please enter your Mobile Number.</span>
      </div>
      <div class="form-group has-feedback">
        <input id="alt_mobile" type="time" class="form-control field-validate" name="alt_mobile" value="">
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> Best Time to contact.</span>
        <span class="help-block hidden"> Best Time to contact.</span>
      </div>
      <div class="form-group has-feedback">
        <input id="regi_no" type="text" class="form-control field-validate" name="regi_no" value="">
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> Please enter your Lic. Registration No./Company Regi. No.</span>
        <span class="help-block hidden"> Please enter your Lic. Registration No./Company Regi. No.</span>
      </div>
      <div class="form-group has-feedback">
        <input id="vat_no" type="text" class="form-control field-validate" name="vat_no" value="">
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> Please enter your VAT No.</span>
        <span class="help-block hidden"> Please enter your VAT No.</span>
      </div>
      
      <div class="form-group has-feedback">
        <input type="text" name="user_address" id="pac-input" placeholder="Enter a location" class="form-control field-validate">
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> Pincode enter a location.</span>
        <span class="help-block hidden"> Please enter a location.</span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="user_city" id="user_city" class="form-control field-validate" readonly>
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> Your City.</span>
        <span class="help-block hidden"> Your City.</span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="user_pincode" id="user_pincode" class="form-control field-validate" readonly>
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> Your Pincode.</span>
        <span class="help-block hidden"> Your Pincode.</span>
      </div>
      <input type="hidden" name="latitude" id="cityLat" class="form-control field-validate">
      <input type="hidden" name="longitude" id="cityLng" class="form-control field-validate">
      <!-- Correspondence Address   -->
      
      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> Correspondence Address</span>

      <div class="form-group">
          
          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><input type="checkbox" name="same_like_above" id="same_like_above" value="1" style="margin-right: 10;"> Same like above.</span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="alt_adddress" id="alt_adddress" placeholder="Enter a location" class="form-control field-validate">
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> Pincode enter a location.</span>
        <span class="help-block hidden"> Please enter a location.</span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="alt_city" id="alt_city" class="form-control field-validate" readonly>
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> Your City.</span>
        <span class="help-block hidden"> Your City.</span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="alt_pincode" id="alt_pincode" class="form-control field-validate" readonly>
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> Your Pincode.</span>
        <span class="help-block hidden"> Your Pincode.</span>
      </div>
      <input type="hidden" name="alt_latitude" id="alt_latitude" class="form-control field-validate">
      <input type="hidden" name="alt_longitude" id="alt_longitude" class="form-control field-validate">
      <!-- Correspondence Address end --> 
      <div class="form-group has-feedback">
        <input type="password" name='password' class='form-control field-validate' value="">
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> Please enter your passwrod.</span>
        <span class="help-block hidden">Please enter your passwrod.</span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name='confirm_password' class='form-control field-validate' value="">
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> Please enter confirm password.</span>
        <span class="help-block hidden">Please enter your passwrod.</span>
      </div>
      <div class="form-group">
          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><input type="checkbox" name="t_and_c" id="t_and_c" value="1" class="field-validate" style="margin-right: 10;" required> Accept Terms and Conditions.</span>
      </div>
      <div class="form-group">
          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><input type="checkbox" name="newsletter" id="newsletter" value="1" class="field-validate" style="margin-right: 10;" required> Newsletter.</span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" id="signup">
            Sign Up
          </button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>

  <!-- /.login-box-body -->
</div>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="{!! asset('public/admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
    <script>
          $("#same_like_above").change(function() {
            console.log("same_like_above -change")
            if(this.checked) {
                if($("#pac-input").val() != ""){
                    $("#alt_adddress").val( $("#pac-input").val())
                    $("#alt_city").val( $("#user_city").val())
                    $("#alt_pincode").val( $("#user_pincode").val())
                    $("#alt_latitude").val( $("#cityLat").val())
                    $("#alt_longitude").val( $("#cityLng").val()) 
                }
            }else{
                $("#alt_adddress").val("")
                $("#alt_city").val("")
                $("#alt_pincode").val("")
                $("#alt_latitude").val("")
                $("#alt_longitude").val("")
            }
        });

       
    </script>
    <script>
        function initMap() {
            const input = document.getElementById("pac-input");
            const autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener("place_changed", () => {
                const place = autocomplete.getPlace();
                console.log(place);
                
                if (!place.geometry || !place.geometry.location) {
                window.alert("No details available for input: '" + place.name + "'");
                return;
                }
                document.getElementById('cityLat').value = place.geometry.location.lat();
                document.getElementById('cityLng').value = place.geometry.location.lng();
                for (var i = 0; i < place.address_components.length; i++) {
                    for (var j = 0; j < place.address_components[i].types.length; j++) {
                        if (place.address_components[i].types[j] == "postal_code") {
                        document.getElementById('user_pincode').value = place.address_components[i].long_name;
                        console.log(place.address_components[i].long_name);
                        }
                        if (place.address_components[i].types[j] == "locality") {
                        document.getElementById('user_city').value = place.address_components[i].long_name;
                        console.log(place.address_components[i].long_name);
                        }
                    }
                }

            });

            const alt_input = document.getElementById("alt_adddress");
            const alt_autocomplete = new google.maps.places.Autocomplete(alt_input);
            alt_autocomplete.addListener("place_changed", () => {
                const alt_place = alt_autocomplete.getPlace();
                console.log(alt_place);
                
                if (!alt_place.geometry || !alt_place.geometry.location) {
                window.alert("No details available for input: '" + alt_place.name + "'");
                return;
                }
                document.getElementById('alt_latitude').value = alt_place.geometry.location.lat();
                document.getElementById('alt_longitude').value = alt_place.geometry.location.lng();
                for (var i = 0; i < alt_place.address_components.length; i++) {
                    for (var j = 0; j < alt_place.address_components[i].types.length; j++) {
                        if (alt_place.address_components[i].types[j] == "postal_code") {
                        document.getElementById('alt_pincode').value = alt_place.address_components[i].long_name;
                        console.log(alt_place.address_components[i].long_name);
                        }
                        if (alt_place.address_components[i].types[j] == "locality") {
                        document.getElementById('alt_city').value = alt_place.address_components[i].long_name;
                        console.log(alt_place.address_components[i].long_name);
                        }
                    }
                }

            });
        }               
    </script>
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_EBi3vEsgmF0dQq25jJQ5M_Y_aMNfaU8&callback=initMap&libraries=places&v=weekly"
    async
  ></script>