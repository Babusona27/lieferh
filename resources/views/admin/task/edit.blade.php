@extends('admin.adminLayout')
@section('content')

<style type="text/css">
    .input_space {
        margin-bottom: 0px;
        margin-right: 4px;
    }
</style>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Tasks <small>Edit Task...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ URL::to('admin/task/display')}}"><i class="fa fa-map-pin"></i>Tasks</a></li>
                <li class="active">Edit Task</li>
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
                          <h3 class="box-title">Edit Task</h3>
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

                                            <form method="POST" action="{{ url('admin/task/update') }}" class="form-horizontal form-validate" enctype="multipart/form-data">
                                            @csrf

                                            <input type="hidden" name="task_id" value="{{$result['task_details']->task_id }}">
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="date" class="col-sm-2 col-md-1 control-label">Task Name<span style="color:red;">*</span>

                                                    </label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" class="form-control field-validate" id="task_name" name='task_name'  value="<?php echo !empty($result['task_details'])?$result['task_details']->task_name:''; ?>" />
                                                        <span class="help-block hidden">This field is required.</span>
                                                    </div>
                                                    <div class="col-sm-2 col-md-1"></div>

                                                    <label for="time" class="col-sm-2 col-md-1 control-label">Type<span style="color:red;">*</span>

                                                    </label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <select name="type" id="type" class="form-control field-validate">
                                                            <option value="1" <?php if(!empty($result['task_details'])){echo $result['task_details']->type=='1'?"selected":''; } ?> >Regular</option>
                                                            <option value="2" <?php if(!empty($result['task_details'])){echo $result['task_details']->type=='2'?"selected":''; } ?> >Delivery</option>
                                                            <option value="3" <?php if(!empty($result['task_details'])){echo $result['task_details']->type=='3'?"selected":''; } ?> >Pickup</option>
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
                                                        <input type="date" name="date" id="date" class="form-control field-validate" value="<?php echo !empty($result['task_details'])?$result['task_details']->task_date:''; ?>" >
                                                        <span class="help-block hidden">This field is required.</span>
                                                    </div>
                                                    <div class="col-sm-2 col-md-1"></div>

                                                    <label for="time" class="col-sm-2 col-md-1 control-label">Time<span style="color:red;">*</span>

                                                    </label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="time" name="time" id="time" class="form-control field-validate" value="<?php echo !empty($result['task_details'])?date("H:i",strtotime($result['task_details']->task_time)):''; ?>">
                                                        <span class="help-block hidden">This field is required.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                            <input id="sortable_val" type="hidden" name="sortable_val" value="0">

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-1"></div>
                                                    <div class="col-sm-12 col-md-2">
                                                        <a class="btn btn-block btn-primary task_butn" data-toggle="modal" data-target="#customers">
                                                            <i class="fa fa-plus-circle chang_color" aria-hidden="true"></i>
                                                            Select Customer
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-12 col-md-2"></div>
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
                                                        <input type="text" id="clients_name" class="form-control input_space" value='<?php echo !empty($result['client_details'])?$result['client_details']->name:''; ?>' disabled />
                                                    </div>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" id="clients_phone" class="form-control input_space" value='<?php echo !empty($result['client_details'])?$result['client_details']->user_phone:''; ?>' disabled />
                                                    </div>
                                                    <div class="col-sm-10 col-md-3">
                                                        <input type="hidden" name="client_id" id="client_id" value="<?php echo !empty($result['client_details'])?$result['client_details']->id:''; ?>" class=" field-validate" readonly >
                                                    </div>
                                                        <span class="help-block hidden">This field is required.</span>
                                                </div>
                                            </div>

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
                                                        <input type="text" id="drivers_name" class="form-control input_space" value='<?php echo !empty($result['driver_details'])?$result['driver_details']->name:''; ?>' disabled />
                                                    </div>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" id="drivers_phone" class="form-control input_space" value='<?php echo !empty($result['driver_details'])?$result['driver_details']->user_phone:''; ?>' disabled />
                                                    </div>
                                                    <div class="col-sm-10 col-md-3">
                                                        <input type="hidden" name="drivers_id" id="drivers_id" class=" field-validate" readonly value="<?php echo !empty($result['driver_details'])?$result['driver_details']->id:''; ?>" >
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
                                                            <option value="1" <?php if(!empty($result['task_details'])){echo $result['task_details']->drivers_fare_type=='1'?"selected":''; } ?> >Per Delivery Amount</option>
                                                            <option value="2" <?php if(!empty($result['task_details'])){echo $result['task_details']->drivers_fare_type=='2'?"selected":''; } ?> >Total Delivery Amount</option>
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
                                                        <input type="text" class="form-control field-validate" id="amount" name='amount' value='<?php echo !empty($result['task_details'])?$result['task_details']->drivers_fare:''; ?>' />
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

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>

        $(document).ready(function() {
            $("#customersTable").dataTable();
            $("#diversTable").dataTable();
            $("#clientsTable").dataTable();

            $(".input_fields_wrap").sortable({
                change: function(event, ui) {
                    $("#sortable_val").val('1');
                },
                
                stop: function () {
                    var inputs = $('input.currentposition');
                    var nbElems = inputs.length;
                    $('input.currentposition').each(function(idx) {
                        $(this).val(idx+1);
                    });
                }
            });

            var taskDetail = <?php echo json_encode($result['task_details']); ?>;
            var dr_id = "#driverAdd"+taskDetail.drivers_id;
            $(dr_id).val("added");

            var cl_id = "#clientAdd"+taskDetail.client_id;
            $(cl_id).val("added");

            var tasktype = taskDetail.type;
            var customerList = <?php echo json_encode($result['customer_list']); ?>;

            if(tasktype == 1){
                for (i = 0; i < customerList.length; i++) {

                    var customers_id = customerList[i].customers_id;
                    var name = customerList[i].name;
                    var phone = customerList[i].customers_phone;
                    var city = customerList[i].city;
                    var pincode = customerList[i].pincode;
                    var task_order = customerList[i].task_order;

                    var edit_id = "#"+customers_id;
                    $(".input_fields_wrap").append('<div class="addedCustomers" id="parent'+customers_id+'" ><input type="hidden" name="customersId[]" value="'+ customers_id +'" readonly > <input class="currentposition" readonly type="hidden" name="task_order[]" value="'+ task_order +'"> <input type="text"  class="input_space" value="'+ name +'" disabled ><input type="text" class="input_space" value="'+ phone +'" disabled ><input type="text" class="input_space" value="'+ city +'" disabled ><input type="text" class="input_space" value="'+ pincode +'" disabled ><a href="#" class="remove_field input_space badge bg-red"><i class="fa fa-trash"></i></a></div>');
                    $(edit_id).val("added");

                }
            }

            if(tasktype == 2 || tasktype == 3){
                for (i = 0; i < customerList.length; i++) {

                    var customers_id = customerList[i].customers_id;
                    var name = customerList[i].name;
                    var phone = customerList[i].customers_phone;
                    var city = customerList[i].city;
                    var pincode = customerList[i].pincode;
                    var task_order = customerList[i].task_order;

                    var edit_id = "#"+customers_id;
                    $(".input_fields_wrap").append('<li class="addedCustomerslist" id="parentLi'+customers_id+'" ><div class="addedCustomers" id="parent'+customers_id+'" ><span class="ui-icon ui-icon-arrowthick-2-n-s input_space"></span><input type="hidden" name="customersId[]" value="'+ customers_id +'" readonly > <input class="currentposition" readonly type="text" name="task_order[]" value="'+ task_order +'"> <input type="text"  class="input_space" value="'+ name +'" disabled ><input type="text" class="input_space" value="'+ phone +'" disabled ><input type="text" class="input_space" value="'+ city +'" disabled ><input type="text" class="input_space" value="'+ pincode +'" disabled ><a href="#" class="remove_field input_space badge bg-red"><i class="fa fa-trash"></i></a></div></li>');
                    $(edit_id).val("added");

                }
            }

            
                        
            

            
        });
        // select customers js
        $("#type").change(function () {
            var noOfInput = $(".addedCustomers input");
            var selectedtype = $("#type").val();
            console.log(selectedtype);
            if(noOfInput.length > 0 ){
                $(".addedCustomerslist").remove();
                $(".addedCustomers").remove();
                $(".addButton").val("add");
            }
            
        });


        function addCustomer(customers_id,name,phone,city,pincode) {
            var noOfInput = $(".addedCustomers input");
            var selectedtype = $("#type").val();
            var id = "#"+customers_id;
            var isAdded = $(id).val();

            var rowNo = $("input[name='customersId[]']")
              .map(function(){return $(this).val();}).get();

            //console.log(rowNo.length);

            var task_order = rowNo.length+1;

            if(selectedtype == 1){
                if(noOfInput.length < 3 ){
                    console.log(noOfInput.length);
                        if(isAdded == "add"){
                            $(".input_fields_wrap").append('<div class="addedCustomers" id="parent'+customers_id+'" ><input type="hidden" name="customersId[]" value="'+ customers_id +'" readonly > <input class="currentposition" readonly type="hidden" name="task_order[]" value="'+ task_order +'"> <input type="text"  class="input_space" value="'+ name +'" disabled ><input type="text" class="input_space" value="'+ phone +'" disabled ><input type="text" class="input_space" value="'+ city +'" disabled ><input type="text" class="input_space" value="'+ pincode +'" disabled ><a href="#" class="remove_field input_space badge bg-red"><i class="fa fa-trash"></i></a></div>');
                            $(id).val("added");
                        }
                }else{
                    alert("you already added one customer!");
                }
            }

            if(selectedtype == 2 || selectedtype == 3){
                if(isAdded == "add"){
                    $(".input_fields_wrap").append('<li class="addedCustomerslist" id="parentLi'+customers_id+'" ><div class="addedCustomers" id="parent'+customers_id+'" ><span class="ui-icon ui-icon-arrowthick-2-n-s input_space"></span><input type="hidden" name="customersId[]" value="'+ customers_id +'" readonly > <input class="currentposition" readonly type="text" name="task_order[]" value="'+ task_order +'"> <input type="text"  class="input_space" value="'+ name +'" disabled ><input type="text" class="input_space" value="'+ phone +'" disabled ><input type="text" class="input_space" value="'+ city +'" disabled ><input type="text" class="input_space" value="'+ pincode +'" disabled ><a href="#" class="remove_field input_space badge bg-red"><i class="fa fa-trash"></i></a></div></li>');
                    $(id).val("added");
                }
            }

        };

        $(".input_fields_wrap").on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); 
                var parentId = $(this).parent('div').attr("id");
                parentId = parentId.substring(6);
                console.log(parentId);
                var id = "#"+parentId;
                $(id).val("add");
                $(this).parent('div').remove();
                $('#parentLi'+parentId).remove();
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
