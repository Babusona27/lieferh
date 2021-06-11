@extends('admin.adminLayout')
@section('content')

<?php
  $adminUserDetails = session('adminUserDetails');
?>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Tasks <small>Listing All The Tasks...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active"> Tasks</li>
            </ol>
        </section>

        <!--  content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">

                        <?php if($adminUserDetails->role_type==1){ ?>
                        <div class="box-header">                            
                            <div class="box-tools pull-right">
                                <a href="{{ URL::to('admin/task/add')}}" type="button" style="display:inline-block; width: auto; margin-top: 0;" class="btn btn-block btn-primary">Add New</a>
                            </div>
                        </div>
                        <?php } ?>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    @if ($errors)
                                        @if($errors->any())
                                            <div @if ($errors->first()=='Default can not Deleted!!') class="alert alert-danger alert-dismissible" @else class="alert alert-success alert-dismissible" @endif role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                {{$errors->first()}}
                                            </div>
                                        @endif
                                    @endif

                                    <!-- Alert Messages -->
                                    @if (session('success_msg'))
                                        <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong> {{ session('success_msg') }} </strong>
                                        </div>
                                    @endif
                                    <!-- alert success END-->
                                </div>
                            </div>

                            <!-- <div class="row default-div hidden">
                                <div class="col-xs-12">
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        {{ trans('labels.DefaultLanguageChangedMessage') }}
                                    </div>
                                </div>
                            </div> -->
                            <br>

                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th> 
                                            <th>Task Name</th> 
                                            <th>Task Type</th>
                                            <th>Asigned Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($result['tasks'])>0)
                                            @foreach ($result['tasks'] as $key=>$tasks)
                                                <tr>
                                                    
                                                    <td>{{ $tasks->task_id }}</td>
                                                    <td>{{ $tasks->task_name }}</td>
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
                                                    <td>{{ $tasks->task_status == 1 ? "Active" : "Inactive" }}</td>
                                                    <td>
                                                        <a href="{{ URL::to('admin/task/details')}}/{{ $tasks->task_id }}" title="View" type="button" style="display:inline-block; width: auto; margin-top: 0;" class="badge bg-blue"><i class="fa fa-eye"></i></a>

                                                        <?php if($adminUserDetails->role_type==1){ ?>
                                                        <a href="{{ URL::to('admin/task/edit')}}/{{ $tasks->task_id }}" title="Edit" type="button" style="display:inline-block; width: auto; margin-top: 0;" class="badge bg-green"><i class="fa fa-pencil"></i></a>

                                                        <a data-toggle="tooltip" data-placement="bottom" title="Delete" id="deleteTask" task_id="{{$tasks->task_id}}" href="javascript:void(0);" class="badge bg-red" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        <?php } ?>
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


    <div class="modal fade" id="deleteTaskModal" tabindex="-1" role="dialog" aria-labelledby="deleteVendorModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="deleteVendorModalLabel">Delete Task</h4>
          </div>
      <form method="POST" action="{{ url('admin/task/delete') }}" class="form-horizontal" enctype="multipart/form-data">
        @csrf
            
        <input type="hidden" name="task_id" id="task_id" value="">
                
          <div class="modal-body">
              <p>Are you sure you want to delete this record?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Delete</button>
          </div>
          </form>
        </div>
      </div>
    </div>

@endsection
