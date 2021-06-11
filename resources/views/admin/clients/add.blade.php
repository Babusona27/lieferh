@extends('admin.adminLayout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Clients <small>Add New Client...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ URL::to('admin/client/display')}}"><i class="fa fa-map-pin"></i>Clients</a></li>
                <li class="active">Add Client</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">

                    <div class="box">
                      <div class="box-header">
                          <h3 class="box-title">Add Client</h3>
                      </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    @if (count($errors) > 0)
                                        @if($errors->any())
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                {{$errors->first()}}
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <br>                       
                        
                        <!-- Alert Messages -->
                        @if (session('success_msg'))
                            <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong> {{ session('success_msg') }} </strong>
                            </div>
                        @endif
                        <!-- alert success END-->
                        
                        @if(session()->has('errorMessage'))
                            <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ session()->get('errorMessage') }}
                            </div>
                        @endif
                                        <!-- form start -->
                                        <div class="box-body">

                                            <form method="POST" action="{{ url('admin/client/add') }}" class="form-horizontal form-validate" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Company Name<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="company_name" id="company_name" class="form-control field-validate">
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Family Name<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="sur_name" id="sur_name" class="form-control field-validate">
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">First Name<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="name" id="name" class="form-control field-validate">
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Middle Name

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="middle_name" id="middle_name" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">email<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="email" id="email" class="form-control field-validate">
                                                    
                                                    {{-- <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Pincode such as "123456"</span> --}}
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Phone<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="user_phone" id="user_phone" class="form-control field-validate">
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Mobile

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="alt_mobile" id="alt_mobile" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Best Time to contact 

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="time" name="best_time_to_contact" id="best_time_to_contact" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Lic. Registration No./Company Regi. No. <span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="regi_no" id="regi_no" class="form-control field-validate">
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">VAT No.<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="vat_no" id="vat_no" class="form-control field-validate">
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Address<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="user_address" id="pac-input" placeholder="Enter a location" class="form-control field-validate">
                                                    
                                                    {{-- <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Pincode such as "123456"</span> --}}
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">City<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="user_city" id="user_city" class="form-control field-validate" readonly>
                                                    
                                                    {{-- <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Pincode such as "123456"</span> --}}
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Pincode<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="user_pincode" id="user_pincode" class="form-control field-validate" readonly>
                                                    
                                                    {{-- <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Pincode such as "123456"</span> --}}
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>
                                            <input type="hidden" name="latitude" id="cityLat" class="form-control field-validate">
                                            <input type="hidden" name="longitude" id="cityLng" class="form-control field-validate">
                                            <!-- Correspondence Address   -->
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">
                                                    <input type="checkbox" name="same_like_above" id="same_like_above" value="1">
                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <span class="help-block">same like above</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Correspondence Address<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="alt_adddress" id="alt_adddress" placeholder="Enter a location" class="form-control field-validate">
                                                    
                                                    {{-- <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Pincode such as "123456"</span> --}}
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">City<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="alt_city" id="alt_city" class="form-control field-validate" readonly>
                                                    
                                                    {{-- <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Pincode such as "123456"</span> --}}
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Pincode<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="alt_pincode" id="alt_pincode" class="form-control field-validate" readonly>
                                                    
                                                    {{-- <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Pincode such as "123456"</span> --}}
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>
                                            <input type="hidden" name="alt_latitude" id="alt_latitude" class="form-control field-validate">
                                            <input type="hidden" name="alt_longitude" id="alt_longitude" class="form-control field-validate">
                                            <!-- Correspondence Address end -->
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Password<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="password" name="password" id="password" class="form-control field-validate">
                                                    
                                                    {{-- <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Pincode such as "123456"</span> --}}
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Confirm Password <span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="password " name="confirm_password" id="confirm_password" class="form-control field-validate">
                                                    
                                                    {{-- <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Pincode such as "123456"</span> --}}
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->

                                            <div class="box-footer text-right">
                                                <div class="col-sm-offset-2 col-md-offset-3 col-sm-10 col-md-4">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <a href="{{ URL::to('admin/client/display')}}" type="button" class="btn btn-default">Back</a>
                                                </div>
                                            </div>
                                            <!-- /.box-footer -->
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        

                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

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
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_EBi3vEsgmF0dQq25jJQ5M_Y_aMNfaU8&callback=initMap&libraries=places&v=weekly"
    async
  ></script>
@endsection
