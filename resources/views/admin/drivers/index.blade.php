@extends('admin.adminLayout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Drivers <small>Listing All The Drivers...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active"> Drivers</li>
            </ol>
        </section>

        <!--  content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="col-lg-6 form-inline" id="contact-form">
                                <form  name='registration' id="registration" class="registration" method="get" action="{{url('admin/drivers/filter')}}">
                                    <input type="hidden"  value="{{csrf_token()}}">
                                    <div class="input-group-form search-panel ">
                                        <select type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" name="FilterBy" id="FilterBy"  >
                                            <option value="" selected disabled hidden>Filter By</option>
                                            <option value="name" @if(isset($filter)) 
                                            @if  ($filter == "name") {{ 'selected' }}
                                            @endif 
                                            @endif>Name</option>
                                            <option value="email" @if(isset($filter)) 
                                            @if  ($filter == "email") {{ 'selected' }}
                                            @endif 
                                            @endif>Email</option>
                                        </select>
                                        <input type="text" class="form-control input-group-form " name="parameter" placeholder="Search term..." id="parameter" @if(isset($parameter)) value="{{$parameter}}" @endif >
                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        @if(isset($parameter,$filter))  <a class="btn btn-danger " href="{{url('admin/drivers/display')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>
                            <div class="box-tools pull-right">
                                <a href="{{ URL::to('admin/drivers/add')}}" type="button" style="display:inline-block; width: auto; margin-top: 0;" class="btn btn-block btn-primary">Add New</a>
                            </div>
                        </div>

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
                                </div>
                            </div>

                            <!-- <div class="row default-div hidden">
                                <div class="col-xs-12">
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        {{ trans('labels.DefaultLanguageChangedMessage') }}
                                    </div>
                                </div>
                            </div> -->

                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone No.</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($result['drivers'])>0)
                                            @foreach ($result['drivers'] as $key=>$drivers)
                                                <tr>
                                                    <td>
                                                        {{ $drivers->id }}
                                                    </td>
                                                    
                                                    <td>{{ $drivers->name }}</td>
                                                    <td>{{ $drivers->email }}</td>
                                                    <td>{{ $drivers->user_phone }}</td>
                                                    <td>
                                                        <a href="{{ URL::to('admin/drivers/details')}}/{{ $drivers->id }}" title="View" type="button" style="display:inline-block; width: auto; margin-top: 0;" class="badge bg-blue"><i class="fa fa-eye"></i></a>
                                                        
                                                        <a href="{{ URL::to('admin/drivers/edit')}}/{{ $drivers->id  }}" data-toggle="tooltip" data-placement="bottom" title=" {{ $drivers->name }}" class="badge bg-green"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        <button type="button" style="border-width: 0px;" class="badge bg-red" data-toggle="modal" data-target="#deleteDriversModal{{ $drivers->id }}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3">No Drivers exist.</td>
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

            @if(count($result['drivers'])>0)
            @foreach ($result['drivers'] as $key=>$drivers)
            <div class="modal fade" id="deleteDriversModal{{ $drivers->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteLanguagesModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteCustomer">Delete Driver</h4>
                        </div>
                        <form method="POST" action="{{ url('admin/drivers/delete') }}" class="form-horizontal form-validate">
                            @csrf
                            <input type="hidden" name="id" id="id"  value="{{ $drivers->id }}">
                        <div class="modal-body">
                            <p>Conferm!</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="deletepincode">Delete</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            <!-- deletelanguagesModal -->
            

            <!--  row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
