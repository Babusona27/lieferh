@extends('admin.adminLayout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Customers <small>Add New Customer...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ URL::to('admin/Customers/display')}}"><i class="fa fa-map-pin"></i>Customers</a></li>
                <li class="active">Add Pincode</li>
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
                          <h3 class="box-title">Add Customers</h3>
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

                                            <form method="POST" action="{{ url('admin/customers/update') }}" class="form-horizontal form-validate" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="customers_id" id="customers_id" value="{{$result['customers'][0]->customers_id }}">
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Full Name<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="name" id="name" class="form-control field-validate" value="{{$result['customers'][0]->name }}">
                                                    
                                                    {{-- <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Pincode such as "123456"</span> --}}
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">email<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="customers_email" id="customers_email" class="form-control field-validate" value="{{$result['customers'][0]->customers_email}}" >
                                                    
                                                    {{-- <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Pincode such as "123456"</span> --}}
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Phone<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="customers_phone" id="customers_phone" class="form-control field-validate" value="{{$result['customers'][0]->customers_phone}}" >
                                                    
                                                    {{-- <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Pincode such as "123456"</span> --}}
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Address<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="address" id="pac-input" placeholder="Enter a location" class="form-control field-validate" value="{{$result['customers'][0]->address }}" >
                                                    
                                                    {{-- <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Pincode such as "123456"</span> --}}
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">City<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="city" id="city" class="form-control field-validate" value="{{$result['customers'][0]->city }}" readonly>
                                                    
                                                    {{-- <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Pincode such as "123456"</span> --}}
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Pincode<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="pincode" id="pincode" class="form-control field-validate" value="{{$result['customers'][0]->pincode }}" readonly>
                                                    
                                                    {{-- <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Pincode such as "123456"</span> --}}
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>
                                            <input type="hidden" name="latitude" id="cityLat" class="form-control field-validate" value="{{$result['customers'][0]->latitude }}">
                                            <input type="hidden" name="longitude" id="cityLng" class="form-control field-validate" value="{{$result['customers'][0]->longitude }}">
                                            <!-- /.box-body -->
                                            <div class="box-footer text-right">
                                                <div class="col-sm-offset-2 col-md-offset-3 col-sm-10 col-md-4">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <a href="{{ URL::to('admin/customers/display')}}" type="button" class="btn btn-default">Back</a>
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
                        document.getElementById('pincode').value = place.address_components[i].long_name;
                        console.log(place.address_components[i].long_name);
                        }
                        if (place.address_components[i].types[j] == "locality") {
                        document.getElementById('city').value = place.address_components[i].long_name;
                        console.log(place.address_components[i].long_name);
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
@endsection
