<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Futami Operator</title>
    <link href="{{asset('assets/img/logo-futami.jpg')}}" rel="icon" style="width: 50%; height:50%;">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{asset('assets/template/stisla/assets/modules/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/template/stisla/assets/modules/fontawesome/css/all.min.css')}}">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('assets/template/stisla/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/template/stisla/assets/css/components.css')}}">
    <!-- Start GA -->

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');

    </script>
    <!-- /END GA -->

    {{-- link untuk create multi form --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.js" integrity="sha512-nO7wgHUoWPYGCNriyGzcFwPSF+bPDOR+NvtOYy2wMcWkrnCNPKBcFEkU80XIN14UVja0Gdnff9EmydyLlOL7mQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- Sweet alert  --}}
    <script src="{{ asset('vendor/realrashid/sweet-alert/resources/js/sweetalert.all.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">
    
</head>
<body>




    
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
            @if (request()->is('operator'))
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                </form>

            @elseif (request()->is('operator/data'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('data') }}">
                        <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                        <input class="form-control" type="date" name="tanggal_uji" id="tanggal_uji" placeholder="Tanggal Uji" aria-label="Search" data-width="250"> 
                        <input class="form-control" type="date" name="tanggal_selesai" id="tanggal_selesai" placeholder="Tanggal Selesai Uji" aria-label="Search" data-width="250">
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>                
                    </form>
                    <a class="text-success btn" href="/operator/data" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>
    

            @elseif (request()->is('operator/mikrobiologi'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('mikrobiologi') }}"> 
                        <ul class="navbar-nav mr-3">
                          <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                          <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                          <input class="form-control" type="date" name="tgl_inokulasi" id="tgl_inokulasi" placeholder="Tanggal Uji" aria-label="Search" data-width="250"> 
                          <input class="form-control" type="date" name="tgl_pengamatan" id="tgl_pengamatan" placeholder="Tanggal Selesai Uji" aria-label="Search" data-width="250">
                          <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/operator/mikrobiologi" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>
                    
            @elseif (request()->is('operator/analisakimia'))
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                </form>
            

            @elseif (request()->is('operator/analisakimia/{{ $id }}'))
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                </form>
            
            @elseif (request()->is('operator/analisakimia/history'))
                <form class="form-inline mr-auto" method="GET" action="{{ route('analisakimia_history') }}">
                    <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                    <div class="search-element">
                    <input class="form-control" type="date" name="tanggal_uji" id="tanggal_uji" placeholder="Tanggal Uji" aria-label="Search" data-width="250"> 
                    <input class="form-control" type="date" name="tanggal_selesai" id="tanggal_selesai" placeholder="Tanggal Selesai Uji" aria-label="Search" data-width="250">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                    </div>                
                </form>
                <a class="text-success btn" href="/operator/analisakimia/history" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>
            
            @elseif (request()->is('operator/mikrobiologi_produk'))
            <ul class="navbar-nav mr-3">
                <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
            </ul>
            
                <form class="form-inline mr-auto" method="GET" action="{{ route('mikrobiologi_produk') }}">
                    <div class="search-element"> 
                        {{-- <select class="form-control" style="appearance: none; -webkit-appearance: none; -moz-appearance: none; background-color: white; border: 1px solid #ccc; border-radius: 10px; font-size: 16px; color: #333;">
                            <option hidden>-- Pilih Pencarian --</option> 
                            <option value="tgl_produk">Tanggal Produksi</option> 
                            <option value="tgl_inokulasi">Tanggal Inokulasi</option> 
                            <option value="tgl_pengamatan">Tanggal Pengamatan</option> 
                        </select> --}} 
                        <select name="pencarian" class="form-control" style="appearance: none; -webkit-appearance: none; -moz-appearance: none; background-color: white; border: 1px solid #ccc; border-radius: 10px; font-size: 16px; color: #333;" onchange="changeInputId(this)">
                            <option hidden>-- Pilih Pencarian --</option>
                            <option value="tgl_produksi">Tanggal Produksi</option> 
                            <option value="tgl_inokulasi">Tanggal Inokulasi</option> 
                            <option value="tgl_pengamatan">Tanggal Pengamatan</option> 
                        </select>
                          <input class="form-control" style="margin-left:10px;" type="date" name="tgl_mulai" id="tanggal_produksi" placeholder="Tanggal" aria-label="Search" data-width="200"> 
                          <input class="form-control" type="date" name="tgl_selesai" id="tanggal_selesai" placeholder="Tanggal Selesai Uji" aria-label="Search" data-width="200">
                          
                        {{-- <input style="margin-left:10px;" class="form-control" type="date" name="tanggal_uji" id="tanggal_uji" placeholder="Tanggal Uji" aria-label="Search" data-width="200">  --}}
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                    </div> 

                </form> 
                <a class="text-success btn" href="/operator/mikrobiologi_produk" style="margin-right:10%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

            @elseif (request()->is('operator/add_mikrobiologi_produk') || (request()->is('operator/sampel_mikrobiologi_produk/*')))
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                </form>
            
            







                {{-- STAFF SEARCH --}}
            @elseif (request()->is('staff'))
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                </form>
            @elseif (request()->is('staff/data'))
                <form class="form-inline mr-auto" method="GET" action="{{ route('datastaff') }}">
                    <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                    <div class="search-element">
                    <input class="form-control" type="date" name="tanggal_uji" placeholder="Tanggal Uji" aria-label="Search" data-width="250">
                    <input class="form-control" type="date" name="tanggal_selesai" placeholder="Tanggal Selesai Uji" aria-label="Search" data-width="250">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                <a class="text-success btn" href="/staff/data" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

            @elseif (request()->is('staff/mikrobiologi'))
                <form class="form-inline mr-auto" method="GET" action="{{ route('staff_mikrobiologi') }}"> 
                    <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                    <div class="search-element">
                    <input class="form-control" type="date" name="tgl_inokulasi" id="tgl_inokulasi" placeholder="Tanggal Uji" aria-label="Search" data-width="250"> 
                    <input class="form-control" type="date" name="tgl_pengamatan" id="tgl_pengamatan" placeholder="Tanggal Selesai Uji" aria-label="Search" data-width="250">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                <a class="text-success btn" href="/staff/mikrobiologi" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

            @elseif (request()->is('staff/mikrobiologi_produk'))
                <form class="form-inline mr-auto" method="GET" action="{{ route('staff_mikrobiologi_produk') }}">
                    <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                    <div class="search-element">
                    <input class="form-control" type="date" name="tanggal_uji" id="tanggal_uji" placeholder="Tanggal Uji" aria-label="Search" data-width="250"> 
                    <input class="form-control" type="date" name="tanggal_selesai" id="tanggal_selesai" placeholder="Tanggal Selesai Uji" aria-label="Search" data-width="250">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                    </div>                
                </form>
                <a class="text-success btn" href="/staff/mikrobiologi_produk" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>







             {{-- STAFF SEARCH --}}
            @elseif (request()->is('supervisor'))
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                </form>   
            @elseif (request()->is('supervisor/data'))
                <form class="form-inline mr-auto" method="GET" action="{{ route('datasupervisor') }}">
                    <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                    <div class="search-element">
                    <input class="form-control" type="date" name="tanggal_uji" placeholder="Tanggal Uji" aria-label="Search" data-width="250">
                    <input class="form-control" type="date" name="tanggal_selesai" placeholder="Tanggal Selesai Uji" aria-label="Search" data-width="250">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                <a class="text-success btn" href="/supervisor/data" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>
            
            @elseif (request()->is('supervisor/mikrobiologi_produk'))
                <form class="form-inline mr-auto" method="GET" action="{{ route('supervisor_mikrobiologi_produk') }}"> 
                    <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                    <div class="search-element">
                    <input class="form-control" type="date" name="tgl_inokulasi" id="tgl_inokulasi" placeholder="Tanggal Uji" aria-label="Search" data-width="250"> 
                    <input class="form-control" type="date" name="tgl_pengamatan" id="tgl_pengamatan" placeholder="Tanggal Selesai Uji" aria-label="Search" data-width="250">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                <a class="text-success btn" href="/supervisor/mikrobiologi_produk" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                    

            @endif






                <ul class="navbar-nav navbar-right">

                @if (request()->is('operator'))
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{asset('assets/template/stisla/assets/img/avatar/avatar-3.png')}}" class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;">

                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Hi, {{ Auth::user()->nama }}</div>
                            <a href="/profile" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="/logout" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>

                @elseif (request()->is('operator/data'))
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{asset('assets/template/stisla/assets/img/avatar/avatar-3.png')}}" class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;">

                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Hi, {{ Auth::user()->nama }}</div>
                            <a href="/profile" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="/logout" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                @elseif (request()->is('operator/analisakimia/history'))
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{asset('assets/template/stisla/assets/img/avatar/avatar-3.png')}}" class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;">

                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Hi, {{ Auth::user()->nama }}</div>
                            <a href="/profile" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="/logout" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                @elseif (request()->is('operator/mikrobiologi'))
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{asset('assets/template/stisla/assets/img/avatar/avatar-3.png')}}" class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;">

                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Hi, {{ Auth::user()->nama }}</div>
                            <a href="/profile" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="/logout" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                @elseif (request()->is('operator/mikrobiologi_produk') || request()->is('operator/add_mikrobiologi_produk') || (request()->is('operator/sampel_mikrobiologi_produk/*')))
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{asset('assets/template/stisla/assets/img/avatar/avatar-3.png')}}" class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;">

                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Hi, {{ Auth::user()->nama }}</div>
                            <a href="/profile" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="/logout" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>









                    {{-- STAFF PROFILE --}}
                @elseif (request()->is('staff') || request()->is('staff/data') || request()->is('staff/mikrobiologi') || request()->is('staff/mikrobiologi_produk'))
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{asset('assets/template/stisla/assets/img/avatar/avatar-3.png')}}" class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;">

                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Hi, {{ Auth::user()->nama }}</div>
                            <a href="/profile" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="/logout" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>



                     {{-- SUPERVISOR PROFILE --}}
                @elseif (request()->is('supervisor') || request()->is('supervisor/data') || request()->is('supervisor/mikrobiologi') || request()->is('supervisor/mikrobiologi_produk'))
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{asset('assets/template/stisla/assets/img/avatar/avatar-3.png')}}" class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;">

                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Hi, {{ Auth::user()->nama }}</div>
                            <a href="/profile" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="/logout" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>

                @endif


                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand mt-2">
                        {{-- <a href="#">Futami Operator</a> --}}
                        <img alt="image" src="{{asset('assets/img/futami bg.png')}}" class="rounded-medium justify-content-center" style="margin-top:5%; width:auto; height:70px; border-radius:50%;">
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm ">
                        {{-- <a href="index.html">FO</a> --}} 
                        <img alt="image" src="{{asset('assets/img/logo-futami-sidebar.png')}}" class="rounded-circle justify-content-center" style="margin-top:5%; width:auto; height:50px; border-radius:50%;">
                    </div>
                    
                    @if(Auth::user()->role_id == 1) {{-- hanya pengguna dengan role 1 yang bisa mengakses menu ini --}}
                        <ul class="sidebar-menu mt-5" style="margin-top:3%; ">
                            {{-- <li class="menu-header">Dashboard</li> --}}

                                <li class="dropdown {{ request()->is('operator') ? 'active' : '' }}">
                                    <a href="/operator" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                                </li>
                                <li class="dropdown {{ request()->is('operator/data') || request()->is('operator/analisakimia/history') ? 'active' : '' }}">
                                    <a href="/operator/data" class="nav-link"><i class="fas fa-flask"></i><span>Data Analisa Kimia</span></a>
                                </li>
                                

                                {{-- Mikrobiologi Air --}}
                                <li class="dropdown {{ request()->is('operator/mikrobiologi') ? 'active' : '' }}">
                                    <a href="/operator/mikrobiologi" class="nav-link"><i class="fas fa-bacterium"></i><span>Mikrobiologi Air</span></a>
                                </li>

                                {{-- Mikrobiologi Produk --}} 
                                <li class="dropdown {{ request()->is('operator/mikrobiologi_produk') || request()->is('operator/add_mikrobiologi_produk') || (request()->is('operator/sampel_mikrobiologi_produk/*')) ? 'active' : '' }}">
                                    <a href="/operator/mikrobiologi_produk" class="nav-link"><i class="fas fa-boxes-stacked"></i><span>Mikrobiologi Produk</span></a>
                                </li>


                        </ul> 
                    @elseif (Auth::user()->role_id == 2)
                        <ul class="sidebar-menu mt-5" style="margin-top:3%; ">
                            {{-- <li class="menu-header">Dashboard</li> --}}

                                <li class="dropdown {{ request()->is('staff') ? 'active' : '' }}">
                                    <a href="/staff" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                                </li>
                                <li class="dropdown {{ request()->is('staff/data') || request()->is('staff/analisakimia/history') ? 'active' : '' }}">
                                    <a href="/staff/data" class="nav-link"><i class="fas fa-flask"></i><span>Data Analisa Kimia</span></a>
                                </li>
                                

                                {{-- Mikrobiologi Air --}}
                                <li class="dropdown {{ request()->is('staff/mikrobiologi') ? 'active' : '' }}">
                                    <a href="/staff/mikrobiologi" class="nav-link"><i class="fas fa-bacterium"></i><span>Mikrobiologi Air</span></a>
                                </li>

                                {{-- Mikrobiologi Produk --}} 
                                <li class="dropdown {{ request()->is('staff/mikrobiologi_produk') || request()->is('staff/add_mikrobiologi_produk') || (request()->is('staff/sampel_mikrobiologi_produk/*')) ? 'active' : '' }}">
                                    <a href="/staff/mikrobiologi_produk" class="nav-link"><i class="fas fa-boxes-stacked"></i><span>Mikrobiologi Produk</span></a>
                                </li>

                        </ul> 

                    @elseif (Auth::user()->role_id == 3)
                        <ul class="sidebar-menu mt-5" style="margin-top:3%; ">
                            {{-- <li class="menu-header">Dashboard</li> --}}

                                <li class="dropdown {{ request()->is('supervisor') ? 'active' : '' }}">
                                    <a href="/supervisor" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                                </li>
                                <li class="dropdown {{ request()->is('supervisor/data') || request()->is('supervisor/analisakimia/history') ? 'active' : '' }}">
                                    <a href="/supervisor/data" class="nav-link"><i class="fas fa-flask"></i><span>Data Analisa Kimia</span></a>
                                </li>
                                

                                {{-- Mikrobiologi Air --}}
                                <li class="dropdown {{ request()->is('supervisor/mikrobiologi') ? 'active' : '' }}">
                                    <a href="/supervisor/mikrobiologi" class="nav-link"><i class="fas fa-bacterium"></i><span>Mikrobiologi Air</span></a>
                                </li>

                                {{-- Mikrobiologi Produk --}} 
                                <li class="dropdown {{ request()->is('supervisor/mikrobiologi_produk') || request()->is('supervisor/add_mikrobiologi_produk') || (request()->is('supervisor/sampel_mikrobiologi_produk/*')) ? 'active' : '' }}">
                                    <a href="/supervisor/mikrobiologi_produk" class="nav-link"><i class="fas fa-boxes-stacked"></i><span>Mikrobiologi Produk</span></a>
                                </li>

                        </ul> 

                    @endif
                    
                    <hr>
                </aside>
            </div>


            

            @yield('content')
            @include('sweetalert::alert')




            <footer class="main-footer">
                <div class="footer-left">
                    Futami Qa
                    {{-- Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a> --}}
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>








    <!-- General JS Scripts -->
    <script src="{{asset('assets/template/stisla/assets/modules/jquery.min.js')}}"></script>
    <script src="{{asset('assets/template/stisla/assets/modules/popper.js')}}"></script>
    <script src="{{asset('assets/template/stisla/assets/modules/tooltip.js')}}"></script>
    <script src="{{asset('assets/template/stisla/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/template/stisla/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('assets/template/stisla/assets/modules/moment.min.js')}}"></script>
    <script src="{{asset('assets/template/stisla/assets/js/stisla.js')}}"></script>

    <!-- JS Libraies sweetalert2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{asset('assets/template/stisla/assets/js/scripts.js')}}"></script>
    <script src="{{asset('assets/template/stisla/assets/js/custom.js')}}"></script>




    <script>
        function changeInputId(selectOption) {
          var selectedOptionValue = selectOption.value;
          var tanggalInput = document.getElementById("tanggal_produksi");
          
          if (selectedOptionValue === "tanggal_produksi") {
            tanggalInput.name = "tanggal_produksi";
            tanggalInput.id = "tanggal_produksi";
            tanggalInput.placeholder = "Tanggal Produksi";
          } else if (selectedOptionValue === "tanggal_inokulasi") {
            tanggalInput.name = "tanggal_inokulasi";
            tanggalInput.id = "tanggal_inokulasi";
            tanggalInput.placeholder = "Tanggal Inokulasi";
          } else if (selectedOptionValue === "tanggal_pengamatan") {
            tanggalInput.name = "tanggal_pengamatan";
            tanggalInput.id = "tanggal_pengamatan";
            tanggalInput.placeholder = "Tanggal Pengamatan";
          }
        }
    </script>
        
</html>
