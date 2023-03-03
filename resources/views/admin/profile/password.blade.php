<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Super Admin Futami</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/template/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/template/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto"> 

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
     <!-- Brand Logo -->
     <a href="/admin" class="brand-link">
        <img src="{{asset('assets/template/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        {{-- <img src="{{asset('assets/img/futami bg.png')}}" alt="AdminLTE Logo" class="brand-image img-circle-left" style="margin-left:-1%;"> --}}
        <span class="brand-text font-weight-light">Super Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <img alt="image" src="{{asset('assets/img/avatar_admin.png')}}" class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;">

            <div class="info">
                <a href="/admin" class="d-block">{{ Auth::user()->nama }}</a>
            </div>
        </div>


      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
                <a href="/admin" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard
                        
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/adduser" class="nav-link">
                    <i class="nav-icon fa-solid fa-user-plus"></i>
                    <p>
                        Users
                    </p>
                </a>
            </li> 
            
            <li class="nav-item">
                <a href="/superadmin/profile" class="nav-link active">
                    <i class="nav-icon fa-regular fa-user"></i>
                    <p>
                        Profile
                    </p>
                </a>
            </li>

            
            {{-- <li class="dropdown" style="margin-top: 70%;">
                <a href="/logout" class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
            </li> --}}
            <li class="nav-item" style="margin-top:70%;">
                <a href="/logout" class="nav-link text-danger">
                    <i class="fas fa-sign-out-alt"></i>
                    <p>
                        Logout
                    </p>
                </a>
            </li>
        </ul>
    </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ganti Password</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <section class="content mt-3">
            <div class="container-fluid">
                <center>
                    <div class="col justify-content-center">
                        <!-- left column -->
                        <div class="col-md-6" style="width: auto;">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                            <h3 class="card-title">Update Password</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" class="needs-validation" action="{{ route('superadmin_password.update', Auth::user()->id) }}">
                                @csrf
                                @method('PATCH')
                                @if ($errors->any())
                                    {{-- alert kalau tidak di isi, akan muncul alert denger  --}}
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if(Session::get('successUpdate'))
                                    <div class="alert alert-success w-70">
                                        {{Session::get('successUpdate')}}
                                    </div>
                                @endif
                                

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                        <!-- text input -->
                                            <div class="form-group">
                                                <label>Password Update</label>
                                                <input type="text" name="password" class="form-control" required="">
                                                <div class="invalid-feedback">
                                                    Kolom ini harus di isi
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary float-right">Simpan Perubahan</button>
                                    <a href="/superadmin/profile" class="btn btn-danger float-left">Kembali</a>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
            
                        </div>
                        <!--/.col (right) -->
                    </div>
                </center>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </section>
          <!-- /.col -->
        {{-- </div> --}}
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{asset('assets/template/plugins/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap 4 -->
    <script src="{{asset('assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/template/dist/js/adminlte.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{asset('assets/template/dist/js/demo.js')}}"></script> --}}
</body>
</html>
