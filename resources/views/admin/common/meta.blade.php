<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Admin Panel | lieferh</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="Themescoder" content="">
  <!-- Bootstrap 3.3.6 -->
  <link href="{!! asset('public/admin/bootstrap/css/bootstrap.min.css') !!}" media="all" rel="stylesheet" type="text/css" />
  <link href="{!! asset('public/admin/bootstrap/css/styles.css') !!} " media="all" rel="stylesheet" type="text/css" />
  <link href="{!! asset('public/admin/css/dropzone.css') !!}" media="all" rel="stylesheet" type="text/css" />
  <link href="{!! asset('public/admin/css/custom.ilyas.css') !!}" media="all" rel="stylesheet" type="text/css" />
  {{--fancybox--}}

  <link href="{!! asset('public/admin/css/jquery.fancybox.min.css') !!}" media="all" rel="stylesheet" type="text/css" />

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />

  <!-- Select2 -->
  <link rel="stylesheet" href="{!! asset('public/admin/plugins/select2/select2.min.css') !!} ">

    <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{!! asset('public/admin/plugins/colorpicker/bootstrap-colorpicker.min.css') !!} ">
    <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{!! asset('public/admin/plugins/timepicker/bootstrap-timepicker.min.css') !!} ">
  <!-- Ionicons -->
  <link href="{!! asset('public/admin/css/ionicons.min.css') !!}" media="all" rel="stylesheet" type="text/css" />
  <link href="{!! asset('public/admin/css/image-picker.css') !!}" media="all" rel="stylesheet" type="text/css" />
  <!-- daterange picker -->
  <link rel="stylesheet" href="{!! asset('public/admin/plugins/daterangepicker/daterangepicker-bs3.css') !!} ">
   <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{!! asset('public/admin/plugins/datepicker/datepicker3.css') !!} ">
  <!-- jvectormap -->
  <link href="{!! asset('public/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css') !!} " media="all" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="{!! asset('public/admin/dist/css/AdminLTE.min.css')  !!} " media="all" rel="stylesheet" type="text/css" />
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link href="{!! asset('public/admin/dist/css/skins/_all-skins.min.css') !!} " media="all" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="{!! asset('public/admin/plugins/iCheck/all.css')  !!} " media="all" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
      window.csrf_token = "{{ csrf_token() }}"
    </script>

  <!-- Ionicons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" media="all" rel="stylesheet" type="text/css" />

  {{-- datatable --}}
  <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">

  <link href="{!! asset('public/admin/css/style.css')  !!} " media="all" rel="stylesheet" type="text/css" />

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="{!! asset('public/admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>

</head>
<style>
.dragable-box-cursor img{
  cursor: move;
}

.input_space {
    margin-right: 10px;
    margin-bottom: 12px;
}

</style>
