@extends('admin.adminLayout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Edit Category <small>Edit Category...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ URL::to('admin/categories/display')}}"><i class="fa fa-database"></i> Categories</a></li>
            <li class="active">Edit Category</li>
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
                        <h3 class="box-title">Edit Category </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <br>
                                    @if (count($errors) > 0)
                                      @if($errors->any())
                                      <div class="alert alert-success alert-dismissible" role="alert">
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
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <div class="box-body">

                                        <form method="POST" action="{{ url('admin/categories/update') }}" class="form-horizontal form-validate" enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="id" id="id" value="{{$result['editSubCategory'][0]->id}}">

                                        <input type="hidden" name="oldImage" id="oldImage" value="{{$result['editSubCategory'][0]->image}}">
                                        
                                        <input type="hidden" name="oldIcon" id="oldIcon" value="{{$result['editSubCategory'][0]->icon}}">

                                        @if($result['editSubCategory'][0]->id >0 )
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Category</label>
                                            <div class="col-sm-10 col-md-4">
                                                <select class="form-control" name="parent_id">
                                                    {{print_r($result['categories'])}}
                                                </select>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Choose main category.</span>
                                            </div>
                                        </div>
                                        @else
                                        <select hidden name="parent_id">
                                            <option value="0">Leave As Parent</option>1
                                        </select>
                                        @endif

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Name</label>
                                            <div class="col-sm-10 col-md-4">
                                                <input type="text" name="categoryName" class="form-control field-validate" value="{{$result['editSubCategory'][0]->categories_name}}">
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please enter name.</span>
                                                <span class="help-block hidden">This field is required.</span>
                                            </div>
                                        </div>                                        

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Image</label>
                                            <div class="col-sm-10 col-md-4">
                                                <!-- Modal -->
                                                <div class="modal fade" id="Modalmanufactured" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <h3 class="modal-title text-primary" id="myModalLabel">Choose Image </h3>
                                                            </div>
                                                            <div class="modal-body manufacturer-image-embed">
                                                                @if(isset($allimage))
                                                                <select class="image-picker show-html " name="image_id" id="select_img">
                                                                    <option value=""></option>
                                                                    @foreach($allimage as $key=>$image)
                                                                    <option data-img-src="{{asset('public').'/'.$image->images_path}}" class="imagedetail" data-img-alt="{{$key}}" value="{{$image->images_id}}"> {{$image->images_id}} </option>
                                                                    @endforeach
                                                                </select>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                              <a href="{{url('admin/media/add')}}" target="_blank" class="btn btn-primary pull-left" >Add Image</a>
                                                              <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                                                              <button type="button" class="btn btn-primary" id="selected" data-dismiss="modal">Done</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                    <button type="button" name="" id="newImage" class="btn btn-primary" data-toggle="modal" data-target="#Modalmanufactured" >Add Image</button>
                                                  
                                                  <br>
                                                  <div id="selectedthumbnail" class="selectedthumbnail col-md-5"> </div>
                                                  <div class="closimage">
                                                      <button type="button" class="close pull-left image-close " id="image-close"
                                                        style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Upload sub category image</span>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"></label>
                                            <div class="col-sm-10 col-md-4">
                                              <span class="help-block " style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Old Image</span>
                                              <br>
                                              <img src="{{asset('public').'/'.$result['editSubCategory'][0]->imgpath}}" alt="" width=" 100px">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Icon</label>
                                            <div class="col-sm-10 col-md-4">
                                                {{--{!! Form::file('newIcon', array('id'=>'newIcon')) !!}--}}

                                                <!-- Modal -->
                                                <div class="modal fade" id="ModalmanufacturedICone" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <h3 class="modal-title text-primary" id="myModalLabel">Choose Image </h3>
                                                            </div>
                                                            <div class="modal-body manufacturer-image-embed">
                                                                @if(isset($allimage))
                                                                <select class="image-picker show-html " name="image_icone" id="select_img">
                                                                    <option value=""></option>
                                                                    @foreach($allimage as $key=>$image)
                                                                    <option data-img-src="{{asset('public').'/'.$image->images_path}}" class="imagedetail" data-img-alt="{{$key}}" value="{{$image->images_id}}"> {{$image->images_id}} </option>
                                                                    @endforeach
                                                                </select>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                              <a href="{{url('admin/media/add')}}" target="_blank" class="btn btn-primary pull-left" >Add Image</a>
                                                              <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                                                                <button type="button" class="btn btn-primary" id="selectedICONE" data-dismiss="modal">Done</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="imageselected">
                                                    <button type="button" name="" id="newIcon" class="btn btn-primary" data-toggle="modal" data-target="#ModalmanufacturedICone" >Add Icon</button>
                                                    
                                                    <br>
                                                    <div id="selectedthumbnailIcon" class="selectedthumbnail col-md-5"> </div>
                                                    <div class="closimage">
                                                        <button type="button" class="close pull-left image-close " id="image-Icone"
                                                          style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Upload category icon.</span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"></label>
                                            <div class="col-sm-10 col-md-4">
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Old Image</span>
                                                <br>
                                                <img src="{{asset('public').'/'.$result['editSubCategory'][0]->iconpath}}" alt="" width=" 100px">

                                            </div>
                                        </div>

                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">Status </label>
                                          <div class="col-sm-10 col-md-4">
                                            <select class="form-control" name="categories_status">
                                                  <option value="1" @if($result['editSubCategory'][0]->categories_status=='1') selected @endif>Active</option>
                                                  <option value="0" @if($result['editSubCategory'][0]->categories_status=='0') selected @endif>Inactive</option>
                                            </select>
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                          Please choose active to show.</span>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- /.box-body -->
                            <div class="box-footer text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ URL::to('admin/categories/display')}}" type="button" class="btn btn-default">Back</a>
                            </div>
                            <!-- /.box-footer -->

                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- /.box-body -->

        <!-- /.box -->

        <!-- /.col -->

        <!-- /.row -->

        <!-- Main row -->

        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
