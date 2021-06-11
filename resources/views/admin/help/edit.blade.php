@extends('admin.adminLayout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Help <small>Edit Help...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
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
                        <h3 class="box-title">Edit Help </h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <!--<div class="box-header with-border">
                                          <h3 class="box-title">Edit category</h3>
                                        </div>-->
                                    <!-- /.box-header -->
                                    <br>
                                    @if (count($errors) > 0)
                                      @if($errors->any())
                                      <div class="alert alert-success alert-dismissible" role="alert">
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                          {{$errors->first()}}
                                      </div>
                                      @endif
                                    @endif

                                    @if(session()->has('message'))
                                    <div class="alert alert-success" role="alert">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      {{ session()->get('message') }}
                                                  </div>
                                              @endif


                                    <!-- form start -->
                                    <div class="box-body">

                                        
                                        <form method="POST" action="{{ url('admin/content/updatehelp') }}" class="form-horizontal form-validate" enctype='multipart/form-data'>
                                            @csrf

                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">Help Content</label>
                                          <div class="col-sm-10 col-md-8">
                                              <textarea id="editor1" name="help" class="form-control"
                                                rows="5">{{stripslashes($help[0]->page_text)}}</textarea>

                                              <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                Help</span> 
                                            </div>
                                        </div>                                      

                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary">Submit </button>
                                            <!-- <a href="#" type="button" class="btn btn-default">back</a> -->
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


<script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
<script type="text/javascript">
  $(function() {

        
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();

    });
</script>






@endsection
