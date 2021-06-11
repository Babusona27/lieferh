@extends('admin.adminLayout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Drivers <small>Add New Driver...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ URL::to('admin/drivers/display')}}"><i class="fa fa-map-pin"></i>Drivers</a></li>
                <li class="active">Add Driver</li>
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
                          <h3 class="box-title">Add Driver</h3>
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

                                            <form method="POST" action="{{ url('admin/drivers/add') }}" class="form-horizontal form-validate" enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Full Name<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="name" id="name" class="form-control field-validate">
                                                    
                                                    {{-- <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Pincode such as "123456"</span> --}}
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">email<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="drivers_email" id="customers_email" class="form-control field-validate">
                                                    
                                                    {{-- <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Pincode such as "123456"</span> --}}
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Phone<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="drivers_phone" id="customers_phone" class="form-control field-validate">
                                                    
                                                    {{-- <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Pincode such as "123456"</span> --}}
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Address<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="address" id="address" class="form-control field-validate">
                                                    
                                                    {{-- <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Pincode such as "123456"</span> --}}
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Password<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="password" id="password" class="form-control field-validate" >
                                                    
                                                    {{-- <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Pincode such as "123456"</span> --}}
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>
                                            
                                            <!-- /.box-body -->
                                            <div class="box-footer text-right">
                                                <div class="col-sm-offset-2 col-md-offset-3 col-sm-10 col-md-4">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <a href="{{ URL::to('admin/drivers/display')}}" type="button" class="btn btn-default">Back</a>
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
@endsection
