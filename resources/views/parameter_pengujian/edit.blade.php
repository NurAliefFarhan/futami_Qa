@extends('layout-operator')
@section('content')

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
                        </li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('assets/template/stisla/assets/img/avatar/avatar-3.png') }}"class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">{{ Auth::user()->nama }}</div>
                            <a href="/profile" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="/logout" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand mt-2">
                        {{-- <a href="#">Futami Operator</a> --}}
                        <img alt="image" src="{{ asset('assets/img/futami bg.png') }}" class="rounded-medium justify-content-center" style="margin-top:5%; width:auto; height:70px; border-radius:50%;">
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm ">
                        {{-- <a href="index.html">FO</a> --}}
                        <img alt="image" src="{{ asset('assets/img/logo-futami-sidebar.png') }}" class="rounded-circle justify-content-center" style="margin-top:5%; width:auto; height:50px; border-radius:50%;">
                    </div>
                    <ul class="sidebar-menu mt-5" style="margin-top:3%; ">
                        {{-- <li class="menu-header">Dashboard</li> --}}
                        <li class="dropdown">
                            <a href="/operator" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                        </li>
                        <li class="dropdown active">
                            <a href="/operator/data" class="nav-link"><i class="fas fa-flask"></i><span>Mikrobiologi Produk</span></a>
                        </li>

                        {{-- <li class="dropdown" style="margin-top: 130%;">
                    <a href="/logout" class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
                </li> --}}


                    </ul>
                    <hr>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Edit Data Parameter Pengujian</h1>
                    </div>


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

                    @if(Session::get('successAdd'))
                        <div class="alert alert-success w-70">
                            {{Session::get('successAdd')}} 
                        </div>
                    @endif



                    <div class="section-body">
                        <h2 class="section-title">Edit Data Parameter Pengujian</h2>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card">
                                        <form action="{{ route('updateParameter', $parameter->id)}}" method="POST">

                                            @csrf
                                            @method('PATCH') 

                                            <div class="card-body">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="nama_parameter">Nama Parameter</label>
                                                        <input type="string" name="nama_parameter" value="{{ $parameter->nama_parameter }}" class="form-control" id="nama_parameter" placeholder="Masukkan Nama Parameter">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="catatan">Catatan</label>
                                                        <input type="string" name="catatan" value="{{ $parameter->catatan }}" class="form-control" id="catatan" placeholder="Catatan (optional)">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button class="btn btn-success" style="width:30%; text-align:center; margin-left:70%; margin-top:-2%;">Update Data</button>
                                                <a href="/operator/parameter_pengujian" class="btn btn-primary" style="width:30%; text-align:center; margin-top:-5%;">Back</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>




@endsection
