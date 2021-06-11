@extends('admin.adminLayout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Driver <small>Driver Details...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ URL::to('admin/drivers/display')}}"><i class="fa fa-map-pin"></i>Drivers</a></li>
                <li class="active">Driver Details</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-12">
                  <!-- MAP & BOX PANE -->
                  <div class="box box-success" style="padding-bottom: 0;">
                    <div class="box-header with-border">
                      <h3 class="box-title">Filter</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                      </div>
                    </div>

                    <div class="box-body no-padding">
                      <form  name='registration' method="get" action="{{ URL::to('admin/drivers/details/'.$result['driver_details']->id)}}">

                        <input type="hidden" name="type" value="all">
                      
                      <div class="box-body">
                        <div class="col-xs-3">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Choose start and end date</label>
                            <input class="form-control reservation dateRange" placeholder="Choose start and end date" readonly value="{{app('request')->input('dateRange')}}" name="dateRange" aria-label="Text input with multiple buttons ">
                          </div>
                        </div>                       

                        <div class="col-xs-2" style="padding-top: 25px">                  
                          <div class="form-group">
                            <button class="btn btn-primary" id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                            @if(app('request')->input('type') and app('request')->input('type') == 'all')  <a class="btn btn-danger " href="{{ URL::to('admin/drivers/details/'.$result['driver_details']->id)}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                          </div>
                        </div>       
                    </div>
                      <!-- /.box-body -->

                    </form> 

                    <div class="col-xs-3">
                        <form  name='' method="post" action="{{ URL::to('admin/drivers/exportDetails/'.$result['driver_details']->id)}}">
                            @csrf
                            <input type="hidden" name="date_range" value="{{app('request')->input('dateRange')}}">

                            <button class="btn btn-primary" id="submit" type="submit"><i class="fa fa-empire chang_color" aria-hidden="true"></i>
                                <span> Export</span> </button>
                        </form>
                    </div>


                  </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="box" style="padding-bottom: 3px;">
                        <div class="box_main">
                            <div class="box-body">

                                <div class="row">
                                    <div class="col-md-6" style="padding-bottom: 2px;">
                                        <div class="col-sm-3">
                                            <div class="border_box_header">
                                                <h2>Name :</h2>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <p>{{$result['driver_details']->name}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="padding-bottom: 2px;">
                                        <div class="col-sm-3">
                                            <div class="border_box_header">
                                                <h2>Email :</h2>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <p>{{$result['driver_details']->email}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="padding-bottom: 2px;">
                                        <div class="col-sm-3">
                                            <div class="border_box_header">
                                                <h2>Phone :</h2>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <p>{{$result['driver_details']->user_phone}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="padding-bottom: 2px;">
                                        <div class="col-sm-3">
                                            <div class="border_box_header">
                                                <h2>Address :</h2>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <p>{{$result['driver_details']->user_address}}</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>                  
                </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="box">
                  <div class="box-header">
                        {{--<div class="col-lg-9 form-inline" id="contact-form">
                            
                            <form method="get" action="{{url('admin/customers-orders-report')}}">
                                <input type="hidden" name="type"  value="id">
                                <input type="hidden"  value="{{csrf_token()}}">
                                <div class="input-group-form search-panel ">
                                    <input class="form-control" placeholder="{{ trans('labels.Please enter order ID') }}" value="{{app('request')->input('orderid')}}" name="orderid" aria-label="Text input with multiple buttons ">
                                                             
                                    <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                    @if(app('request')->input('type') and app('request')->input('type') == 'id')   <a class="btn btn-danger " href="{{url('admin/customers-orders-report')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                                </div>
                            </form>

                          </div>--}}
                          
                        </div>
                        

                  <!-- /.box-header -->
                  <div class="box-body">

                    <!-- <div class="row">
                      <div class="col-xs-12"> 

                      <div class="box-tools pull-right">
                        <h2><small>Total Earning Price:</small>  </h2>
                      </div>

                      </div>
                    </div> -->
                    <div class="row">
                        <div class="col-xs-12">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th> 
                                    <th>Task Type</th>
                                    <th>Task Date</th>
                                    <th>Fare Type</th>
                                    <th>Driver's Fare</th>
                                    <th>Earning</th>
                                    {{--<th>Status</th>--}}
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($result['tasks'])>0)
                                    @foreach ($result['tasks'] as $key=>$tasks)
                                        <tr>
                                            
                                            <td>{{ $tasks->task_id }}</td>
                                            <td><?php if( $tasks->type == 1 ){
                                                    echo "Regular";
                                                 }elseif ( $tasks->type == 2 ) {
                                                    echo "Delevery";
                                                 }elseif ( $tasks->type == 3 ) {
                                                    echo "Pickup";
                                                 }else{
                                                    echo "no type found";
                                                 }?></td>
                                            <td><?php echo date("d-m-Y",strtotime($tasks->task_date)); ?></td>

                                            <td>
                                                <?php if( $tasks->drivers_fare_type == 1 ){
                                                    echo "Per Delivery Amount";
                                                }elseif ( $tasks->drivers_fare_type == 2 ) {
                                                    echo "Total Delivery Amount";
                                                }else{
                                                    echo "";
                                                }?>
                                            </td>

                                            <td>{{ $tasks->drivers_fare }}</td>
                                            <td>{{ $tasks->totalEarn }}</td>

                                            {{--<td>{{ $tasks->task_status == 1 ? "Active" : "Inactive" }}</td>--}}
                                            <td>
                                                <a href="{{ URL::to('admin/task/details')}}/{{ $tasks->task_id }}" target="_blank" title="View" type="button" style="display:inline-block; width: auto; margin-top: 0;" class="badge bg-blue"><i class="fa fa-eye"></i></a>
                                            </td>
                                        
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
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
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
