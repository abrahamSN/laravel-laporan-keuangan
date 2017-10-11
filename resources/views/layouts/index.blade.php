<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('adminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('adminLTE/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('adminLTE/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Css Content -->
  @yield('css')
  <!-- End Css Content -->
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminLTE/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('adminLTE/dist/css/skins/skin-blue-light.min.css')}}">
  <!-- Sweetalert -->
  <link rel="stylesheet" href="{{asset('adminLTE/plugins/sweetalert/sweetalert.css')}}">
  <style>
      .dropdown-caret {
        display: inline-block;
        width: 0;
        height: 0;
        vertical-align: middle;
        content: "";
        border: 4px solid;
        border-right-color: transparent;
        border-bottom-color: transparent;
        border-left-color: transparent;
    }
  </style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- Scripts -->
  @yield('chart')
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body class="hold-transition skin-blue-light sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <!-- Header Menu -->
    @include('layouts.header')
  <!-- End Header Menu -->

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->

  <!-- Sidebar Menu -->
    @include('layouts.sidebar')
  <!-- End Sidebar Menu -->

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
    @yield('content')
  <!-- /.content-wrapper -->

  <footer class="main-footer" style="text-align: center;">
    <strong>Copyright &copy; {{ date('Y') }} <a href="https://softwarehouselampung.com">Software House Lampung</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('adminLTE/bower_components/jquery/dist/jquery.min.js')}}"></script>

<!-- Bootstrap 3.3.7 -->
<script src="{{asset('adminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('adminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminLTE/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminLTE/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminLTE/dist/js/demo.js')}}"></script>
<!-- Sweetalert -->
<script src="{{asset('adminLTE/plugins/sweetalert/sweetalert.min.js')}}"></script>
<!-- JS Index -->
<script>
//pesan alert
$(window).on("load", function (e){
    var x;
    x = $(".pesan-alert").fadeIn(1000);
    if (x) {
      $(".pesan-alert").delay(4000).fadeOut(500);
    }
});

function hapus(url){
    swal({
    title: "Pemberitahuan!",
    text: "<h4>Apakah anda ingin menghapus data ini ?</h4>",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#3c8dbc',
    confirmButtonText: 'Hapus',
    cancelButtonText: "Tidak",
    html: true,
    closeOnConfirm: false
    },
    function(){
      location.href=url;
    });
}
</script>
<!-- JS Content -->
  @yield('js')
  <!-- End JS Content -->
</body>
</html>
