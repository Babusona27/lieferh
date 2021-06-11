@extends('admin.adminLayout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Tasks <small>Add New Task...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ URL::to('admin/task/display')}}"><i class="fa fa-map-pin"></i>Tasks</a></li>
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

                                            <input type="hidden" name="upload_customer_status" id="upload_customer_status" value="0">

                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="date" class="col-sm-2 col-md-1 control-label">Task Name<span style="color:red;">*</span>

                                                    </label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" class="form-control field-validate" id="task_name" name='task_name' value='' />
                                                        <span class="help-block hidden">This field is required.</span>
                                                    </div>
                                                    <div class="col-sm-2 col-md-1"></div>
                                                    

                                                    <label for="time" class="col-sm-2 col-md-1 control-label">Type<span style="color:red;">*</span>

                                                    </label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <select name="type" id="type" class="form-control field-validate">
                                                            <option value="1">Regular</option>
                                                            <option value="2">Delivery</option>
                                                            <option value="3">Pickup</option>
                                                        </select>
                                                        <span class="help-block hidden">This field is required.</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="date" class="col-sm-2 col-md-1 control-label">Date<span style="color:red;">*</span>

                                                    </label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="date" name="date" id="date" class="form-control field-validate">
                                                        <span class="help-block hidden">This field is required.</span>
                                                    </div>
                                                    <div class="col-sm-2 col-md-1"></div>

                                                    <label for="time" class="col-sm-2 col-md-1 control-label">Time<span style="color:red;">*</span>

                                                    </label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="time" name="time" id="time" class="form-control field-validate">
                                                        <span class="help-block hidden">This field is required.</span>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-1"></div>
                                                    <div class="col-sm-12 col-md-2">
                                                        <a class="btn btn-block btn-primary task_butn" data-toggle="modal" data-target="#customers" id="selectCustBtn">
                                                            <i class="fa fa-plus-circle chang_color" aria-hidden="true"></i>
                                                            Select Customer
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-12 col-md-2">
                                                        <a class="btn btn-block btn-primary task_butn" data-toggle="modal" data-target="#customersUpload" id="uploadCustBtn">
                                                            <i class="fa fa-plus-circle chang_color" aria-hidden="true"></i>
                                                            Upload Customer
                                                        </a>
                                                    </div>
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
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-1"></div>
                                                    <div class="col-sm-12 col-md-11">
                                                        <div class="input_fields_wrap">
                                                            <input type="hidden" name="" id="hiddenRank" value="1">
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- customer Data --}}

                                            {{-- Client --}}
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-1"></div>
                                                    <div class="col-sm-12 col-md-2">
                                                        <a class="btn btn-block btn-primary task_butn" data-toggle="modal" data-target="#clientsModal">
                                                            <i class="fa fa-plus-circle chang_color" aria-hidden="true"></i>
                                                            Select Client
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-12 col-md-2"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-1"></div>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" id="clients_name" name ="clients_name" class="form-control input_space" value='' readonly />
                                                    </div>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" id="clients_phone" class="form-control input_space" value='' disabled />
                                                    </div>
                                                    <div class="col-sm-10 col-md-3">
                                                        <input type="hidden" name="client_id" id="client_id" class=" field-validate" readonly >
                                                    </div>
                                                        <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>

                                            {{-- <div class="form-group">
                                                <div class="row">
                                                    

                                                    <label for="time" class="col-sm-2 col-md-1 control-label">Shop arrive time<span style="color:red;">*</span>

                                                    </label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="time" name="shop_arrive_time" id="shop_arrive_time" class="form-control field-validate">
                                                        <span class="help-block hidden">This field is required.</span>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            {{-- Client --}}

                                            {{-- Driver --}}
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-1"></div>
                                                    <div class="col-sm-12 col-md-2">
                                                        <a class="btn btn-block btn-primary task_butn" id="select_driver"><i class="fa fa-plus-circle chang_color" aria-hidden="true"></i>
                                                            Select Driver
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-12 col-md-2"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-1"></div>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" id="drivers_name" class="form-control input_space" value='' disabled />
                                                    </div>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" id="drivers_phone" class="form-control input_space" value='' disabled />
                                                    </div>
                                                    <div class="col-sm-10 col-md-3">
                                                        <input type="hidden" name="drivers_id" id="drivers_id" class=" field-validate" readonly >
                                                    </div>
                                                        <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>
                                            {{-- Driver --}}

                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="time" class="col-sm-2 col-md-1 control-label">Driver's Fare Type<span style="color:red;">*</span>

                                                    </label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <select name="fare_type" id="fare_type" class="form-control field-validate">
                                                            <option value="1">Per Delivery Amount</option>
                                                            <option value="2">Total Delivery Amount</option>
                                                        </select>
                                                        <span class="help-block hidden">This field is required.</span>
                                                    </div>
                                                    <div class="col-sm-5 col-md-7"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="time" class="col-sm-2 col-md-1 control-label">Driver's Fare<span style="color:red;">*</span>

                                                    </label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" class="form-control field-validate" id="amount" name='amount' value='40' />
                                                        <span class="help-block hidden">This field is required.</span>
                                                    </div>
                                                    <div class="col-sm-5 col-md-7"></div>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                            <div class="box-footer text-right">
                                                <div class="col-sm-offset-2 col-md-offset-3 col-sm-10 col-md-4">
                                                    <button type="submit" class="btn btn-primary">Submit</button>&nbsp;
                                                    <a href="{{ URL::to('admin/task/display')}}" type="button" class="btn btn-default">Back</a>
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
                                                         <td><input type="button" class="addButton" value="add" id="<?php echo $customers->customers_id; ?>"  onclick="addCustomer('<?php echo $customers->customers_id; ?>','<?php echo $customers->name; ?>','<?php echo $customers->customers_phone; ?>','<?php echo $customers->city; ?>','<?php echo $customers->pincode; ?>');" /></td>
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
            <div class="modal fade" id="customersUpload" tabindex="-1" role="dialog" aria-labelledby="deleteLanguagesModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="">Upload Excel</h4>
                        </div>
                        
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12">

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Upload File<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-8">
                                                    <input type="file" name="file" id="customerexcelfile" class="form-control" required="">
                                                    
                                                    <span class="help-block hidden" id="excelfiletext" style="color: red;">This field is required.</span>
                                                </div>
                                            </div><br>

                                            
                                            <!-- /.box-body -->
                                            <div class="box-footer text-right">
                                                <div class="col-sm-offset-2 col-md-offset-3 col-sm-10 col-md-4">
                                                    <a type="submit" class="btn btn-primary" id="excelSubmit">Upload</a>
                                                </div>
                                            </div>
                                            <!-- /.box-footer -->
                                         
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

            <!-- Main row -->
            <div class="modal fade" id="clientsModal" tabindex="-1" role="dialog" aria-labelledby="deleteLanguagesModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="">Choose Client</h4>
                        </div>
                        
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <table id="clientsTable" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Client Name</th>
                                                <th>Phone</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($result['clients'])>0)
                                                @foreach ($result['clients'] as $key=>$clients)
                                                
                                                    <tr>
                                                        <td>{{ $clients->id  }}</td>
                                                        <td>{{ $clients->name }}</td>
                                                        <td>{{ $clients->user_phone }}</td>
                                                        <td><input type="button" class="clientAdd" value="add" id="clientAdd<?php echo $clients->id; ?>" onclick="addClient('<?php echo $clients->id; ?>','<?php echo $clients->name; ?>','<?php echo $clients->user_phone; ?>');" /></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5">No client exist.</td>
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
            $("#clientsTable").dataTable();


            $("#excelSubmit").click(function(){
                var selectedtype = $("#type").val();

                var fd = new FormData();
                var files = $('#customerexcelfile')[0].files;
                $("#loader").show();
                $(".input_fields_wrap").html('');
                // Check file selected or not
                if(files.length > 0 ){
                   fd.append('file',files[0]);
                   fd.append('_token',"{{ csrf_token() }}");
                   $.ajax({
                      url: '{{ url('admin/task/taskCustomerUpload') }}',
                      type: 'post',
                      data: fd,
                      contentType: false,
                      processData: false,
                      success: function(response){
                         console.log(response);
                        if (response=="notFile") {
                            $('#excelfiletext').removeClass("hidden");
                            $('#excelfiletext').html("Sorry you are using a wrong format to upload files.");
                            $("#loader").hide();
                        }else{
                            var task_customers = response.task_customers;

                            if(selectedtype == 1){
                                $(".input_fields_wrap").append('<div class="addedCustomers" id="parent1" ><p>1. &nbsp;</p><input type="hidden" name="c_email[]" value="'+ task_customers[0][1] +'" readonly ><input type="hidden" name="c_address[]" value="'+ task_customers[0][3] +'" readonly ><input type="text"  class="input_space" name="c_name[]" value="'+ task_customers[0][0] +'" readonly ><input type="text" class="input_space" name="c_phone[]" value="'+ task_customers[0][2] +'" readonly ><input type="text" class="input_space" name="c_city[]" value="'+ task_customers[0][4] +'" readonly ><input type="text" class="input_space" name="c_pincode[]" value="'+ task_customers[0][5] +'" readonly ><a href="#" class="remove_field input_space badge bg-red"><i class="fa fa-trash"></i></a></div>');
                            }else{
                                $.each(task_customers, function(val, text) {
                                    //console.log(val+' '+text);
                                    var rank = val+1;
                                    $(".input_fields_wrap").append('<div class="addedCustomers" id="parent'+rank+'" ><p>'+ rank +'. &nbsp;</p><input type="hidden" name="c_email[]" value="'+ text[1] +'" readonly ><input type="hidden" name="c_address[]" value="'+ text[3] +'" readonly ><input type="text"  class="input_space" name="c_name[]" value="'+ text[0] +'" readonly ><input type="text" class="input_space" name="c_phone[]" value="'+ text[2] +'" readonly ><input type="text" class="input_space" name="c_city[]" value="'+ text[4] +'" readonly ><input type="text" class="input_space" name="c_pincode[]" value="'+ text[5] +'" readonly ><a href="#" class="remove_field input_space badge bg-red"><i class="fa fa-trash"></i></a></div>');
                                });
                            }

                            $('#selectCustBtn').prop('disabled', true);
                            $('#upload_customer_status').val('1');
                            $('#customersUpload').modal('toggle');
                            $("#loader").hide();
                        }
                      },
                   });
                }else{
                    $("#loader").hide();
                    $('#excelfiletext').removeClass("hidden");
                    return false;
                }
                

            });
            
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


        function addCustomer(customers_id,name,phone,city,pincode) {
            var noOfInput = $(".addedCustomers input");
            var hiddenRank = parseInt($("#hiddenRank").val());
            var selectedtype = $("#type").val();
            var id = "#"+customers_id;
            var isAdded = $(id).val();
            if(selectedtype == 1){
                if(noOfInput.length < 3 ){
                    console.log(noOfInput.length);
                        if(isAdded == "add"){
                            $(".input_fields_wrap").append('<div class="addedCustomers" id="parent'+customers_id+'" ><p>'+ hiddenRank +'. &nbsp;</p><input type="hidden" name="customersId[]" value="'+ customers_id +'" readonly ><input type="text"  class="input_space" value="'+ name +'" disabled ><input type="text" class="input_space" value="'+ phone +'" disabled ><input type="text" class="input_space" value="'+ city +'" disabled ><input type="text" class="input_space" value="'+ pincode +'" disabled ><a href="#" class="remove_field input_space badge bg-red"><i class="fa fa-trash"></i></a></div>');
                            $(id).val("added");
                        }
                }else{
                    alert("you already added one customer!");
                }
            }

            if(selectedtype == 2 || selectedtype == 3){
                if(isAdded == "add"){
                    $(".input_fields_wrap").append('<div class="addedCustomers" id="parent'+customers_id+'" ><p>'+ hiddenRank +'. &nbsp;</p><input type="hidden" name="customersId[]" value="'+ customers_id +'" readonly ><input type="text"  class="input_space" value="'+ name +'" disabled ><input type="text" class="input_space" value="'+ phone +'" disabled ><input type="text" class="input_space" value="'+ city +'" disabled ><input type="text" class="input_space" value="'+ pincode +'" disabled ><a href="#" class="remove_field input_space badge bg-red"><i class="fa fa-trash"></i></a></div>');
                    $(id).val("added");
                }
            }

            $("#hiddenRank").val(hiddenRank+1);
            $('#uploadCustBtn').prop('disabled', true);

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
        $("#select_driver").click(function(){
            var assigned_date = $("#date").val();
            if( !Date.parse(assigned_date) ){
                alert("please select task date!");
            }else{
                $('#driversModal').modal('toggle');
            }
            
        });
        function addDriver (driver_id,name,phone) {
            var tasks = <?php echo json_encode($result['tasks']); ?>;
            var id = "#driverAdd"+driver_id;
            // tasks = JSON.parse(tasks);
            var exist = 0;
            var assigned_date = $("#date").val();
            tasks.forEach(function(item, index) {
                if( item.task_date == assigned_date && item.drivers_id == driver_id){
                    exist++;
                    alert("The Driver is assigned for another Task !");
                }
            });
            if(exist == 0){
                $("#drivers_id").val(driver_id);
                $("#drivers_name").val(name);
                $("#drivers_phone").val(phone);
                $(".driverAdd").val("add");
                $(id).val("added");  
            }
        }
        
        // select drivers js
        function addClient (client_id,name,phone) {
            var id = "#clientAdd"+client_id;
            $("#client_id").val(client_id);
            $("#clients_name").val(name);
            $("#clients_phone").val(phone);
            $(".clientAdd").val("add");
            $(id).val("added");
        }
    </script>
@endsection
