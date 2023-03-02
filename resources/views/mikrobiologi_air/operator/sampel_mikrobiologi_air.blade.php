@extends('layout-operator')
@section('content')


    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto" method="GET" action="{{ route('data') }}">
                    <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{asset('assets/template/stisla/assets/img/avatar/avatar-3.png')}}" class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;">
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
                        <img alt="image" src="{{asset('assets/img/futami bg.png')}}" class="rounded-medium justify-content-center" style="margin-top:5%; width:auto; height:70px; border-radius:50%;">
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm ">
                        {{-- <a href="index.html">FO</a> --}}
                        <img alt="image" src="{{asset('assets/img/logo-futami-sidebar.png')}}" class="rounded-circle justify-content-center" style="margin-top:5%; width:auto; height:50px; border-radius:50%;">
                    </div>
                    <ul class="sidebar-menu mt-5" style="margin-top:3%; ">
                        {{-- <li class="menu-header">Dashboard</li> --}}
                        <li class="dropdown">
                            <a href="/operator" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                        </li>
                        <li class="dropdown active">
                            <a href="/operator/mikrobiologi" class="nav-link"><i class="fas fa-bacterium"></i><span>Analisa Mikrobiologi Air</span></a>
                        </li>
                        {{-- <li class="dropdown">
                            <a href="/operator/analisakimia/history" class="nav-link"><i class="fas fa-history"></i><span>History Delete</span></a>
                        </li> --}}

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
                        <h1>Data Sampel Analisa Mikrobiologi Air</h1>
                    </div>
                    <div class="section-body">
                        <h2 class="section-title">Data Sampel Analisa Mikrobiologi Air</h2>
                        <div class="row">
                            <div class="col-12">
                                <div class="card shadow">
                            
                                    @if(Session::get('successAdd'))
                                        <div class="alert alert-success w-70">
                                            {{Session::get('successAdd')}} 
                                        </div>
                                    @endif

                                    @if(Session::get('successDelete'))
                                        <div class="alert alert-danger w-70">
                                            {{Session::get('successDelete')}} 
                                        </div>
                                    @endif

                                    @if(Session::get('successUpdate'))
                                        <div class="alert alert-success w-70">
                                            {{Session::get('successUpdate')}} 
                                        </div>
                                    @endif

                                    @if(Session::get('operatorttd'))
                                        <div class="alert alert-success w-70">
                                            {{Session::get('operatorttd')}} 
                                        </div>
                                    @endif

                                    @if(Session::get('successAddSampel'))
                                        <div class="alert alert-success w-70">
                                            {{Session::get('successAddSampel')}} 
                                        </div>
                                    @endif


  
                                    <div class="button" style="margin-left:4%; margin-top:3%;">
                                        {{-- <a href="/operator/analisakimia" class="btn btn-success" style="margin-left: ;">Tambah Data</a> --}}
                                        {{-- <a href="#" class="btn btn-icon icon-left btn-danger" id="deleteAllSelectRecord" style="align-content: flex-end; align-items:end;"><i class="fas fa-trash"></i> Hapus sampel all</a> --}}
                                        <a href="/operator/mikrobiologi" class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-house"></i> Back</a>

                                    </div>
        
                                    <div class="card-body mt-3 shadow">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-md">
                                                <tr>
                                                    {{-- <th scope="col"><input type="checkbox" id="chkCheckAll"></th>  --}}
                                                    
                                                    <th scope="col">No</th>
                                                    <th scope="col">Sampel Air</th>
                                                    <th scope="col">TPC (cfu/ml)</th>
                                                    <th scope="col">Yeast & Mold (cfu/ml)</th>
                                                    <th scope="col">Coliform (MPN/100ml)</th>
                                                    <th scope="col">Keterangan</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                <tr>
                                                    @forelse ($sampel_mikrobiologis as $sampel_mikrobiologi)
                                                        <tr id="{{ $sampel_mikrobiologi->id }}">

                                                            <th scope="row">{{ ++$no }}</th>
                                                            <td>{{ $sampel_mikrobiologi->sampel_air }}</td>
                                                            <td>{{ $sampel_mikrobiologi->tpc }}</td>
                                                            <td>{{ $sampel_mikrobiologi->yeast_mold }}</td>
                                                            <td>{{ $sampel_mikrobiologi->coliform }}</td>
                                                            <td>{{ $sampel_mikrobiologi->keterangan }}</td>
                                                            <td>
                                                                <form action="{{route('sampel_mikrobiologi_Delete', $sampel_mikrobiologi['id'])}}" method="POST">
                                                                    @csrf 
                                                                    @method('DELETE') 
                                                                    <button class="text-danger btn"><i class="fa-solid fa-trash"></i></button>
                                                                </form> 
                                                            </td>
                                                        </tr>

                                                        @empty
                                                        <tr>
                                                            <td class="text-center h5" colspan="9">Not Found</td>
                                                        </tr>
                                                    @endforelse
                                                </tr>
                                              </table>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Futami Operator
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>





@endsection
