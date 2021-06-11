@extends('admin.adminLayout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Image Detail <small>Image Detail...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ URL::to('admin/media/add') }}"> Add New Image</a></li>
            <li class="active">Image Detail</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->

        <!-- /.row -->
        <!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                @if(session()->has('success'))
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                                {{ session()->get('success') }}
                                    </div>
                                @endif

                                @if (count($errors) > 0)
                                @if($errors->any())
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    {{$errors->first()}}
                                </div>
                                @endif
                                @endif
                            </div>
                        </div>    
                        
                            @if(isset($image_details))
                                @foreach($image_details as $key=>$image)
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                        <div class="caption">
                                            <h2>{{$image->images_type}}  ({{$image->images_height}} X {{$image->images_width}})</h2>
                                        </div>
                                      <div class="thumbnail">
                                      <img src="{{asset('public').'/'.$image->images_path}}" alt="{{$image->images_height}} X {{$image->images_width}}">
                                      <div class="col-md-6 col-md-offset-3">
                                            <div class="caption">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Path</span>
                                                    <input type="text" class="form-control" name="images_path" value="{{asset('public').'/'.$image->images_path}}">                                                
                                                </div>
                                            </div>
                                        @if($image->images_type !='ACTUAL')

                                        <form method="POST" action="{{ url('admin/media/regenerateImage') }}" class="form-horizontal form-validate" enctype="multipart/form-data">
                                            @csrf
                                            
                                            <input type="hidden" name="images_id" value="{{$image->images_id}}">
                                            <input type="hidden" name="image_categories_id" value="{{$image->image_categories_id}}">
                                            
                                            <div class="caption">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Size</span>
                                                    <input required type="text" class="form-control" name="images_height" value="{{$image->images_height}}">
                                                    <span class="input-group-addon">X</span>
                                                    <input required type="text" class="form-control" name="images_width" value="{{$image->images_width}}">
                                                    <span class="input-group-addon" style="padding: 0">
                                                        <button type="submit" class="btn btn-primary"> Regenerate</button>
                                                    </span>                                                
                                                </div>
                                            </div>
                                        </form>
                                        @endif

                                    </div>
                                  </div>
                                </div>
                              </div>
                            @endforeach
                        @endif

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <p id="demo"></p>

            <!-- /.col -->
        </div>
        <!-- /.row -->


        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
