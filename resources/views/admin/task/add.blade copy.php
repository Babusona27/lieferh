@extends('admin.adminLayout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Tasks <small>Add New Task...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ URL::to('admin/drivers/display')}}"><i class="fa fa-map-pin"></i>Tasks</a></li>
                <li class="active">Add Task</li>
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
                          <h3 class="box-title">Add Task</h3>
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

                                            <form method="POST" action="{{ url('admin/task/add') }}" class="form-horizontal form-validate" enctype="multipart/form-data">
                                            @csrf

                                            

                                            <div class="form-group">
                                                <label for="date" class="col-sm-2 col-md-3 control-label">Date<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="date" name="date" id="date" class="form-control field-validate">
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="time" class="col-sm-2 col-md-3 control-label">Time<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="time" name="time" id="time" class="form-control field-validate">
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="time" class="col-sm-2 col-md-3 control-label">Type<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select name="type" id="type" class="form-control field-validate">
                                                        <option value="1">Regular</option>
                                                        <option value="2">Delivery</option>
                                                        <option value="3">Pickup</option>
                                                    </select>
                                                    {{-- <button type="button"  class="btn btn-block btn-primary" data-toggle="modal" data-target="#customers" >Select Customer</button> --}}
                                                    <button type="button"  class="btn btn-block btn-primary" data-toggle="modal" data-target="#customers" >Select Customer</button>
                                                    <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>
                                            

                                            {{-- <div class="form-group">
                                                <label for="time" class="col-sm-2 col-md-3 control-label">Customer Name<span style="color:red;">*</span>
                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="name" id="name" class="form-control field-validate" disabled>
                                                </div>
                                            </div> --}}

                                            {{-- customer Data --}}
                                            <div class="input_fields_wrap">
                                                <div class="addedCustomers" id="parent'+customers_id+'" >
                                                    <input type="hidden" name="customersId[]" value='' readonly />
                                                    <input type="text" value='' disabled />
                                                    <input type="text" name="" value='' disabled />
                                                    <a href="#" class="remove_field">Remove</a>
                                                </div>
                                            </div>
                                            {{-- customer Data --}}

                                            <div class="form-group">
                                                <label for="time" class="col-sm-2 col-md-3 control-label">Select Driver<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <button type="button"  class="btn btn-block btn-primary" data-toggle="modal" data-target="#driversModal" >Select Driver</button>
                                                    
                                                    <input type="hidden" name="drivers_id" id="drivers_id" class=" field-validate" readonly >

                                                    <label for="drivers_id" class="col-sm-2 col-md-3 control-label">Driver Name</label>
                                                    <input type="text" id="drivers_name" class="form-control" disabled >
                                                    
                                                    <label for="drivers_id" class="col-sm-2 col-md-3 control-label">Driver Phone</label>
                                                    <input type="text" id="drivers_phone" class="form-control" disabled >

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
            <div class="modal fade" id="customers" tabindex="-1" role="dialog" aria-labelledby="deleteLanguagesModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="">Choose Customer</h4>
                        </div>
                        
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <table id="customersTable" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Customer Name</th>
                                                <th>Phone</th>
                                                <th>City</th>
                                                <th>Pincode</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($result['customers'])>0)
                                                @foreach ($result['customers'] as $key=>$customers)
                                                
                                                    <tr>
                                                        <td>{{ $customers->customers_id  }}</td>
                                                        <td>{{ $customers->name }}</td>
                                                        <td>{{ $customers->customers_phone }}</td>
                                                        <td>{{ $customers->city }}</td>
                                                        <td>{{ $customers->pincode }}</td>
                                                         <td><input type="button" class="addButton" value="add" id="<?php echo $customers->customers_id; ?>"  onclick="addCustomer('<?php echo $customers->customers_id; ?>','<?php echo $customers->name; ?>','<?php echo $customers->customers_phone; ?>');" /></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5">No task exist.</td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                           
                                    </div>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- Main row -->
            <div class="modal fade" id="driversModal" tabindex="-1" role="dialog" aria-labelledby="deleteLanguagesModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="">Choose Driver</h4>
                        </div>
                        
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <table id="diversTable" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Driver Name</th>
                                                <th>Phone</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($result['drivers'])>0)
                                                @foreach ($result['drivers'] as $key=>$drivers)
                                                
                                                    <tr>
                                                        <td>{{ $drivers->id  }}</td>
                                                        <td>{{ $drivers->name }}</td>
                                                        <td>{{ $drivers->user_phone }}</td>
                                                        <td><input type="button" class="driverAdd" value="add" id="driverAdd<?php echo $drivers->id; ?>" onclick="addDriver('<?php echo $drivers->id; ?>','<?php echo $drivers->name; ?>','<?php echo $drivers->user_phone; ?>');" /></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5">No task exist.</td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                           
                                    </div>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#customersTable").dataTable();
            $("#diversTable").dataTable();
            
        });
        // select customers js
        $("#type").change(function () {
            var noOfInput = $(".addedCustomers input");
            var selectedtype = $("#type").val();
            console.log(selectedtype);
            if(noOfInput.length > 0 ){
                $(".addedCustomers").remove();
                $(".addButton").val("add");
            }
            
        });


        function addCustomer(customers_id,name,phone) {
            var noOfInput = $(".addedCustomers input");
            var selectedtype = $("#type").val();
            var id = "#"+customers_id;
            var isAdded = $(id).val();
            
            if(selectedtype == 1 || selectedtype == 3){
                if(noOfInput.length < 3 ){
                    console.log(noOfInput.length);
                        if(isAdded == "add"){
                            $(".input_fields_wrap").append('<div class="addedCustomers" id="parent'+customers_id+'" ><input type="text" name="customersId[]" value='+ customers_id +' readonly /><input type="text" value='+ name +' disabled /><input type="text" name="mytext[]" value='+ phone +' disabled /><a href="#" class="remove_field">Remove</a></div>');
                            $(id).val("added");
                        }
                }else{
                    alert("you already added one customer!");
                }
            }

            if(selectedtype == 2){
                if(isAdded == "add"){
                    $(".input_fields_wrap").append('<div class="addedCustomers" id="parent'+customers_id+'" ><input type="text" name="customersId[]" value='+ customers_id +' readonly /><input type="text" value='+ name +' disabled /><input type="text" name="mytext[]" value='+ phone +' disabled /><a href="#" class="remove_field">Remove</a></div>');
                    $(id).val("added");
                }
            }

        };

        $(".input_fields_wrap").on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); 
                var parentId = $(this).parent('div').attr("id");
                parentId = parentId.substring(6);
                var id = "#"+parentId;
                $(id).val("add");
                $(this).parent('div').remove();
            })
        // select customers js

        // select drivers js
        function addDriver (driver_id,name,phone) {
            var id = "#driverAdd"+driver_id;
            $("#drivers_id").val(driver_id);
            $("#drivers_name").val(name);
            $("#drivers_phone").val(phone);
            $(".driverAdd").val("add");
            $(id).val("added");
        }
    </script>
@endsection
