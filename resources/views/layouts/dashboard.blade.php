<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Data Tables</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/skins/_all-skins.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
  <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    .main-header .navbar {
        background-color: #605ca8;
    }
  </style>
</head>
<body class="sidebar-mini skin-purple-light sidebar-open">
<input type="hidden" id="base_url" value="{{ url('/') }}" />
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      {{-- <span class="logo-mini"><b>A</b>LT</span> --}}
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>INVENTORY</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <li><a href="#" onclick="logout();"><b>Keluar</b><span class="sr-only"></span></a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
      </div>
      <!-- search form -->
      {{-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> --}}

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MASTER DATA</li>
        <li><a href="{{ route('tag.index') }}"><i class="fa fa-circle-o text-red"></i> <span>Tag</span></a></li>
        <li><a href="{{ route('category.index') }}"><i class="fa fa-circle-o text-red"></i> <span>Category</span></a></li>
        <li><a href="{{ route('photo.index') }}"><i class="fa fa-circle-o text-red"></i> <span>Photo</span></a></li>
        <li><a href="{{ route('video.index') }}"><i class="fa fa-circle-o text-red"></i> <span>Video</span></a></li>
        <li><a href="{{ route('slider.index') }}"><i class="fa fa-circle-o text-red"></i> <span>Slider</span></a></li>
        <li><a href="{{ route('post.index') }}"><i class="fa fa-circle-o text-red"></i> <span>Post</span></a></li>
        <li><a href="{{ route('event.index') }}"><i class="fa fa-circle-o text-red"></i> <span>Event</span></a></li>
      </ul>

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">SETTING</li>
        <li><a href="{{ route('permission.index') }}"><i class="fa fa-circle-o text-red"></i> <span>Permission</span></a></li>
        <li><a href="{{ route('role.index') }}"><i class="fa fa-circle-o text-red"></i> <span>Role</span></a></li>
        <li><a href="{{ route('user.index') }}"><i class="fa fa-circle-o text-red"></i> <span>User</span></a></li>
      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
    @yield('content')
  </div>
  
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2023
  </footer>

<script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- DataTables -->
<script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{ asset('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('assets/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/dist/js/demo.js')}}"></script>
<!-- page script -->

@stack('after-script')

<script>
  function logout() {
    Swal.fire({
    title: 'Apakah anda akan keluar dari aplikasi ini?',
    showDenyButton: true,
    //   showCancelButton: true,
    confirmButtonText: 'Ya',
    denyButtonText: `Tidak`,
    }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
        document.getElementById('logout-form').submit();
    } else if (result.isDenied) {
        // Swal.fire('Changes are not saved', '', 'info')
    }
    })
}
  </script>
</body>
</html>
