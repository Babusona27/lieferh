<?php
  $adminUserDetails = session('adminUserDetails');
?>
@extends('admin.adminLayout')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Tasks <small>Task Details...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ URL::to('admin/drivers/display')}}"><i class="fa fa-map-pin"></i>Tasks</a></li>
                <li class="active">Task Details</li>
            </ol>
        </section>

        <!--  content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">

                        <!-- /.box-header -->
                        <div class="box_main">

                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="border_box_header">
                                            <h2>Task Date :</h2>
                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <p><?php echo date("d-m-Y",strtotime($result['task_details']->task_date)); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="border_box_header">
                                            <h2>Task Time :</h2>
                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <p><?php echo date("H:i",strtotime($result['task_details']->task_time)); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="border_box_header">
                                            <h2>Task Type :</h2>
                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <p><?php if( $result['task_details']->type == 1 ){
                                            echo "Regular";
                                         }elseif ( $result['task_details']->type == 2 ) {
                                            echo "Delevery";
                                         }elseif ( $result['task_details']->type == 3 ) {
                                            echo "Pickup";
                                         }else{
                                            echo "";
                                         }?></p>
                                    </div>
                                </div>
                            </div>
                            <?php if($adminUserDetails->role_type==1){ ?>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="border_box_header">
                                            <h2>Driver's Fare Type :</h2>
                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <p>
                                        <?php if( $result['task_details']->drivers_fare_type == 1 ){
                                            echo "Per Delivery Amount";
                                         }elseif ( $result['task_details']->drivers_fare_type == 2 ) {
                                            echo "Total Delivery Amount";
                                         }else{
                                            echo "";
                                         }?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="border_box_header">
                                            <h2>Driver's Fare :</h2>
                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <p>{{$result['task_details']->drivers_fare}}</p>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="border_box_header">
                                            <h2>Task Status :</h2>
                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <p>{{ $result['task_details']->task_status == 1 ? "Active" : "Inactive" }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                        <div class="box_main">
                            <!-- /.box-header -->
                                <div class="box-body" style="padding: 0;">

                                    <div class="row">

                                        <div class="col-xs-12">
                                            <div class="table_header"> 
                                                <h2> Driver Details</h2>
                                            </div>
                                            <div class="table_table"> 
                                                <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th> 
                                                        <th>Name</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>Address</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo !empty($result['driver_details'])?'1':''; ?></td>
                                                            <td><?php echo !empty($result['driver_details'])?$result['driver_details']->name:''; ?></td>
                                                            <td><?php echo !empty($result['driver_details'])?$result['driver_details']->user_phone:''; ?></td>
                                                            <td><?php echo !empty($result['driver_details'])?$result['driver_details']->email:''; ?></td>
                                                            <td><?php echo !empty($result['driver_details'])?$result['driver_details']->user_address:''; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                            
                                </div>
                                
                                <!-- /.box-body -->
                            
                        </div>


                        <div class="box_main">
                            <!-- /.box-header -->
                                <div class="box-body" style="padding: 0;">

                                    <div class="row">

                                        <div class="col-xs-12">
                                            <div class="table_header"> 
                                                <h2> Client Details</h2>
                                            </div>
                                            <div class="table_table"> 
                                                <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th> 
                                                        <th>Name</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>Address</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo !empty($result['client_details'])?'1':''; ?></td>
                                                            <td><?php echo !empty($result['client_details'])?$result['client_details']->name:''; ?></td>
                                                            <td><?php echo !empty($result['client_details'])?$result['client_details']->user_phone:''; ?></td>
                                                            <td><?php echo !empty($result['client_details'])?$result['client_details']->email:''; ?></td>
                                                            <td><?php echo !empty($result['client_details'])?$result['client_details']->user_address:''; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                            
                                </div>
                                
                                <!-- /.box-body -->
                            
                        </div>


                        <div class="box_main">
                            <!-- /.box-header -->
                                <div class="box-body" style="padding: 0;">

                                    <div class="row">

                                        <div class="col-xs-12">
                                            <div class="table_header"> 
                                                <h2> Customer List</h2>
                                            </div>
                                            <div class="table_table"> 
                                                <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th> 
                                                        <th>Name</th>
                                                        <th>Phone</th>
                                                        <th>City</th>
                                                        <th>Pincode</th>
                                                        <th>Address</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $cnt=1; ?>
                                                        @if(count($result['customer_list'])>0)
                                                        @foreach ($result['customer_list'] as $key=>$customer_list)
                                                        <tr>
                                                            <td>{{$cnt}}</td>
                                                            <td>{{$customer_list->name}}</td>
                                                            <td>{{$customer_list->customers_phone}}</td>
                                                            <td>{{$customer_list->city}}</td>
                                                            <td>{{$customer_list->pincode}}</td>
                                                            <td>{{$customer_list->address}}</td>
                                                        </tr>
                                                        <?php $cnt++; ?>
                                                        @endforeach
                                                        @else
                                                        <tr>
                                                            <td colspan="6">Empty record..</td>
                                                        </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                            
                                </div>
                                
                                <!-- /.box-body -->
                            
                        </div>




                        
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->


            
        
                    
                


            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
