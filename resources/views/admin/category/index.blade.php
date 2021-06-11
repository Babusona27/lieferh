@extends('admin.adminLayout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Categories <small>Listing All The Categories...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Categories</li>
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
                            <div class="col-lg-6 form-inline">
                                <form  name='registration' id="registration" class="registration" method="get" action="{{url('admin/categories/filter')}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="input-group-form search-panel ">
                                        <select type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="FilterBy" id="FilterBy" >
                                            <option value="" selected disabled hidden>Filter By</option>
                                            <option value="Name"  @if(isset($name)) @if  ($name == "Name") {{ 'selected' }} @endif @endif>Name</option>
                                            <!-- <option value="Main"  @if(isset($name)) @if  ($name == "Main") {{ 'selected' }} @endif @endif>Main Category</option> -->
                                        </select>
                                        <input type="text" class="form-control input-group-form " name="parameter" placeholder="Search..." id="parameter"  @if(isset($param)) value="{{$param}}" @endif >
                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        @if(isset($param,$name))  <a class="btn btn-danger " href="{{url('admin/categories/display')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>
                            <div class="box-tools pull-right">
                                <a href="{{ URL::to('admin/categories/add')}}" type="button" class="btn btn-block btn-primary">Add New</a>
                            </div>
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
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>@sortablelink('categories_id', 'ID' )</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Icon</th>
                                            <th>@sortablelink('created_at', 'Added/Last Modified Date' )</th>
                                            <th>@sortablelink('status', 'Status')</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($categories)>0)
                                            @php $categoriesunique = $categories->unique('id'); @endphp
                                            @foreach ($categories as $key=>$category)
                                                    <tr>
                                                        <td>@if($category->id == -1) 0 @else {{ $category->id }} @endif</td>
                                                        <td>
                                                            @if($category->parent_name)
                                                                {{$category->parent_name}} /
                                                            @endif
                                                            {{ $category->name }}</td>
                                                        <td><img src="{{asset('public').'/'.$category->imgpath}}" alt="" width=" 100px"></td>
                                                        <td><img src="{{asset('public').'/'.$category->iconpath}}" alt="" width=" 100px"></td>
                                                        <td>
                                                            <strong>Added Date: </strong> {{ $category->date_added }}<br>
                                                            <strong>Modified Date: </strong>{{ $category->last_modified }}
                                                        </td>
                                                        <td>
                                                          @if($category->categories_status==1)
                                                          <span class="label label-success">
                                                            Active
                                                          </span>
                                                          @elseif($category->categories_status==0)
                                                          <span class="label label-danger">
                                                            InActive
                                                          @endif
                                                        </td>
                                                        <td>
                                                            <a data-toggle="tooltip" data-placement="bottom" title="Edit" href="{{url('admin/categories/edit/'. $category->id) }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                            @if($category->id >0 )<a id="delete" category_id="{{$category->id}}" href="#" class="badge bg-red " ><i class="fa fa-trash" aria-hidden="true"></i></a>@endif
                                                        </td>
                                                    </tr>

                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7">No Record found.</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                    @if($categories != null)
                                      <div class="col-xs-12 text-right">
                                          {{$categories->links()}}
                                      </div>
                                    @endif
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

            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteModalLabel">Delete</h4>
                        </div>

                        <form method="POST" action="{{ url('admin/categories/delete') }}" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="category_id" value="">

                            <div class="modal-body">
                                <p>Are you sure you want to delete this record?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="deleteBanner">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
