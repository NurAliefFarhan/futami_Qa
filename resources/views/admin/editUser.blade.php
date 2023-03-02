<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | General Form Elements</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/template/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/template/dist/css/adminlte.min.css')}}">


    {{-- Tables User  --}}
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('assets/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
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

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/admin" class="brand-link">
                <img src="{{asset('assets/template/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Super Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <img alt="image" src="{{asset('assets/img/avatar_admin.png')}}" class="rounded-circle mr-1"
                        style="width:40px; height:40px; border-radius:50%;">

                    <div class="info">
                        <a href="/admin" class="d-block">{{ Auth::user()->nama }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="/admin" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/adduser" class="nav-link active">
                                <i class="nav-icon fa-solid fa-user-plus"></i>
                                <p>
                                    Users
                                </p>
                            </a>
                        </li> 
                        
                        <li class="nav-item">
                            <a href="/superadmin/profile" class="nav-link">
                                <i class="nav-icon fa-regular fa-user"></i>
                                <p>
                                    Profile
                                </p>
                            </a>
                        </li>
                        <li class="dropdown" style="margin-top: 70%;">
                            <a href="/logout" class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
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
                            <h1>Edit Data User</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        {{-- <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Form Tambah Data User</h3>
                                </div>
                            
                                <form>
                                    <div class="col-md-12 card-body">
                                        <div class="col-md-6 form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">File input</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->

                        </div> --}}
                        <!--/.col (left) -->
                        <!-- right column -->
                        <div class="col-md-12">
                            <!-- general form elements disabled -->
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Form Edit Data User</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form action="{{route('user.update', $users['id'])}}" method="POST">
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

                                        @if(Session::get('createUser'))
                                            <div class="alert alert-success w-70">
                                                {{Session::get('createUser')}}
                                            </div>
                                        @endif

                                        @if(Session::get('successDelete'))
                                            <div class="alert alert-danger w-70">
                                                {{Session::get('successDelete')}}
                                            </div>
                                        @endif


                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Nama Lengkap</label>
                                                    <input type="text" name="nama" class="form-control" value="{{$users['nama']}}" placeholder="Masukkan Nama Lengkap">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>No.Handphone</label>
                                                    <input type="number" name="nohp" class="form-control" value="{{$users['nohp']}}" placeholder="Masukkan No.Handphone">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Email Address</label>
                                                    <input type="email" name="email" class="form-control" value="{{$users['email']}}" placeholder="Masukkan Email Address">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Password (hasil enkripsi data)</label>
                                                    <input type="password" name="password" class="form-control" value="{{$users['password']}}" placeholder="Masukkan Password" disabled>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Pilih Jenis Jabatan</label>
                                                    <select class="form-control" name="jabatan" value="{{$users['jabatan']}}">
                                                        <option hidden value="{{$users['jabatan']}}">
                                                            {{-- {{$users['jabatan']}} --}}
                                                            @if ($users['jabatan'] == 1)
                                                                Operator
                                                            @elseif ($users['jabatan'] == 2)
                                                                Staff
                                                            @elseif ($users['jabatan'] == 3)
                                                                Supervisor
                                                            @elseif ($users['jabatan'] == 4)
                                                                Superadmin
                                                            @endif
                                                        
                                                        </option>
                                                        {{-- <option hidden>-- Pilih Jenis Jabatan --</option> --}}
                                                                                                            
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <!-- textarea -->
                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    <textarea class="form-control" name="alamat" rows="1" placeholder="Masukkan Alamat">{{$users['alamat']}}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-success float-right">Submit</button>
                                            <a href="/admin/adduser" class="btn btn-primary" style="width:auto; text-align:center;">Back</a>

                                        </div>

                                        <!-- input states -->
                                        {{-- <div class="form-group">
                                            <label class="col-form-label" for="inputSuccess"><i class="fas fa-check"></i> Input with success</label>
                                            <input type="text" class="form-control is-valid" id="inputSuccess" placeholder="Enter ...">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i>Input with warning</label>
                                            <input type="text" class="form-control is-warning" id="inputWarning" placeholder="Enter ...">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i> Input with error</label>
                                            <input type="text" class="form-control is-invalid" id="inputError" placeholder="Enter ...">
                                        </div> --}}

                                        {{-- <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox">
                                                        <label class="form-check-label">Checkbox</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" checked>
                                                        <label class="form-check-label">Checkbox checked</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" disabled>
                                                        <label class="form-check-label">Checkbox disabled</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <!-- radio -->
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="radio1">
                                                        <label class="form-check-label">Radio</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="radio1"
                                                            checked>
                                                        <label class="form-check-label">Radio checked</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" disabled>
                                                        <label class="form-check-label">Radio disabled</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                        {{-- <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Select</label>
                                                    <select class="form-control">
                                                        <option>option 1</option>
                                                        <option>option 2</option>
                                                        <option>option 3</option>
                                                        <option>option 4</option>
                                                        <option>option 5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Select Disabled</label>
                                                    <select class="form-control" disabled>
                                                        <option>option 1</option>
                                                        <option>option 2</option>
                                                        <option>option 3</option>
                                                        <option>option 4</option>
                                                        <option>option 5</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> --}}

                                        {{-- <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Select Multiple</label>
                                                    <select multiple class="form-control">
                                                        <option>option 1</option>
                                                        <option>option 2</option>
                                                        <option>option 3</option>
                                                        <option>option 4</option>
                                                        <option>option 5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Select Multiple Disabled</label>
                                                    <select multiple class="form-control" disabled>
                                                        <option>option 1</option>
                                                        <option>option 2</option>
                                                        <option>option 3</option>
                                                        <option>option 4</option>
                                                        <option>option 5</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </form>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <!-- general form elements disabled -->
                            {{-- <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Custom Elements</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- checkbox -->
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox"
                                                            id="customCheckbox1" value="option1">
                                                        <label for="customCheckbox1" class="custom-control-label">Custom
                                                            Checkbox</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox"
                                                            id="customCheckbox2" checked>
                                                        <label for="customCheckbox2" class="custom-control-label">Custom
                                                            Checkbox checked</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox"
                                                            id="customCheckbox3" disabled>
                                                        <label for="customCheckbox3" class="custom-control-label">Custom
                                                            Checkbox disabled</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input custom-control-input-danger"
                                                            type="checkbox" id="customCheckbox4" checked>
                                                        <label for="customCheckbox4" class="custom-control-label">Custom
                                                            Checkbox with custom color</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input
                                                            class="custom-control-input custom-control-input-danger custom-control-input-outline"
                                                            type="checkbox" id="customCheckbox5" checked>
                                                        <label for="customCheckbox5" class="custom-control-label">Custom
                                                            Checkbox with custom color outline</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <!-- radio -->
                                                <div class="form-group">
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio"
                                                            id="customRadio1" name="customRadio">
                                                        <label for="customRadio1" class="custom-control-label">Custom
                                                            Radio</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio"
                                                            id="customRadio2" name="customRadio" checked>
                                                        <label for="customRadio2" class="custom-control-label">Custom
                                                            Radio checked</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio"
                                                            id="customRadio3" disabled>
                                                        <label for="customRadio3" class="custom-control-label">Custom
                                                            Radio disabled</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input custom-control-input-danger"
                                                            type="radio" id="customRadio4" name="customRadio2" checked>
                                                        <label for="customRadio4" class="custom-control-label">Custom
                                                            Radio with custom color</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input
                                                            class="custom-control-input custom-control-input-danger custom-control-input-outline"
                                                            type="radio" id="customRadio5" name="customRadio2">
                                                        <label for="customRadio5" class="custom-control-label">Custom
                                                            Radio with custom color outline</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- select -->
                                                <div class="form-group">
                                                    <label>Custom Select</label>
                                                    <select class="custom-select">
                                                        <option>option 1</option>
                                                        <option>option 2</option>
                                                        <option>option 3</option>
                                                        <option>option 4</option>
                                                        <option>option 5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Custom Select Disabled</label>
                                                    <select class="custom-select" disabled>
                                                        <option>option 1</option>
                                                        <option>option 2</option>
                                                        <option>option 3</option>
                                                        <option>option 4</option>
                                                        <option>option 5</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- Select multiple-->
                                                <div class="form-group">
                                                    <label>Custom Select Multiple</label>
                                                    <select multiple class="custom-select">
                                                        <option>option 1</option>
                                                        <option>option 2</option>
                                                        <option>option 3</option>
                                                        <option>option 4</option>
                                                        <option>option 5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Custom Select Multiple Disabled</label>
                                                    <select multiple class="custom-select" disabled>
                                                        <option>option 1</option>
                                                        <option>option 2</option>
                                                        <option>option 3</option>
                                                        <option>option 4</option>
                                                        <option>option 5</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                                <label class="custom-control-label" for="customSwitch1">Toggle this
                                                    custom switch element</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div
                                                class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch3">
                                                <label class="custom-control-label" for="customSwitch3">Toggle this
                                                    custom switch element with custom colors danger/success</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" disabled id="customSwitch2">
                                                <label class="custom-control-label" for="customSwitch2">Disabled custom
                                                    switch element</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="customRange1">Custom range</label>
                                            <input type="range" class="custom-range" id="customRange1">
                                        </div>
                                        <div class="form-group">
                                            <label for="customRange2">Custom range (custom-range-danger)</label>
                                            <input type="range" class="custom-range custom-range-danger" id="customRange2">
                                        </div>
                                        <div class="form-group">
                                            <label for="customRange3">Custom range (custom-range-teal)</label>
                                            <input type="range" class="custom-range custom-range-teal" id="customRange3">
                                        </div>
                                        <div class="form-group">
                                            <!-- <label for="customFile">Custom File</label> -->

                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-body -->
                            </div> --}}
                            <!-- /.card -->
                        </div>
                        <!--/.col (right) -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

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
    <!-- bs-custom-file-input -->
    <script src="{{asset('assets/template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/template/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{asset('assets/template/dist/js/demo.js')}}"></script> --}}
    <!-- Page specific script -->
    <script>
        $(function () {
            bsCustomFileInput.init();
        });

    </script>


    {{-- Tables User  --}}
    <!-- jQuery -->
    <script src="{{asset('assets/template/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{asset('assets/template/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/template/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/template/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/template/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('assets/template/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/template/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/template/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/template/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/template/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/template/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- Page specific script -->
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

    </script>


<!-- Bootstrap 4 -->
<script src="{{asset('assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('assets/template/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('assets/template/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('assets/template/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('assets/template/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('assets/template/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('assets/template/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/template/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('assets/template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}">
</script>
<!-- Summernote -->
<script src="{{asset('assets/template/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('assets/template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/template/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('assets/template/dist/js/pages/dashboard.js')}}"></script>

</body>

</html>
