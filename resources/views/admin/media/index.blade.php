

@extends('admin.adminLayout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Media Setting<small>Media Setting...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Image Size</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Image Size</h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <!--<div class="box-header with-border">
                                          <h3 class="box-title">Setting</h3>
                                        </div>-->
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">
                                            @if (session('update'))
                                                <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    <strong> {{ session('update') }} </strong>
                                                </div>
                                            @endif

                                        @if( count($errors) > 0)
                                            @foreach($errors->all() as $error)
                                                <div class="alert alert-success" role="alert">
                                                    <span class="icon fa fa-check" aria-hidden="true"></span>
                                                    <span class="sr-only">Image Size:</span>
                                                    {{ $error }}</div>
                                            @endforeach
                                        @endif

                                        <form method="POST" action="{{ url('admin/media/updatemediasetting') }}" class="form-horizontal form-validate" enctype="multipart/form-data">
                                            @csrf

                                            <h4>Thumbnail Setting</h4>
                                            <hr>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Thumbnail Height</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input id="thumbnail_height" type="text" class="form-control number-validate" name="thumbnail_height" value="{{$media_setting->thumbnail_height}}">
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">Thumbnail Height</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Thumbnail Width</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input id="thumbnail_width" type="text" class="form-control number-validate" name="thumbnail_width" value="{{$media_setting->thumbnail_width}}">
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">Thumbnail Width</span>
                                                    </div>
                                              </div>

                                                <h4>Medium Setting</h4>
                                                <hr>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Medium Height</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input id="medium_height" type="text" class="form-control number-validate" name="medium_height" value="{{$media_setting->medium_height}}">
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">Medium Height</span>
                                                    </div>

                                                </div>

                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Medium Width</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input id="medium_width" type="text" class="form-control number-validate" name="medium_width" value="{{$media_setting->medium_width}}">
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">Medium Width</span>
                                                    </div>

                                                </div>
                                                <h4>Large Setting</h4>
                                                <hr>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Large Height</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input id="large_height" type="text" class="form-control number-validate" name="large_height" value="{{$media_setting->large_height}}">
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">Large Height</span>
                                                    </div>

                                                </div>

                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Large Width</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input id="large_width" type="text" class="form-control number-validate" name="large_width" value="{{$media_setting->large_width}}">
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">Large Width</span>
                                                    </div>

                                                </div>

                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="submit" class="btn btn-success" id="regenrate" name="regenrate" value="yes">Save & Regenerate</button>
                                                <a href="{{ URL::to('admin/dashboard')}}" type="button" class="btn btn-default">Back</a>
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

    <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>
@endsection
