@extends('layout-operator')
@section('content')


<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
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


            <ul class="navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="{{asset('assets/template/stisla/assets/img/avatar/avatar-3.png')}}" class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;">

                        {{-- <img alt="image" src="{{asset('assets/img/admin.jpg')}}" class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;"> --}}
                        {{-- <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->nama }} </div> --}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-title">{{ Auth::user()->nama }}</div>
                        <div class="dropdown-divider"></div>
                        <a href="/profile" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> Profile
                        </a>
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
                    {{-- <a href="#">Futami Staff</a> --}}
                    <img alt="image" src="{{asset('assets/img/futami bg.png')}}" class="rounded-medium justify-content-center" style="margin-top:5%; width:auto; height:70px; border-radius:50%;">
                </div>
                <div class="sidebar-brand sidebar-brand-sm ">
                    {{-- <a href="index.html">FS</a> --}}
                    <img alt="image" src="{{asset('assets/img/logo-futami-sidebar.png')}}" class="rounded-circle justify-content-center" style="margin-top:5%; width:auto; height:50px; border-radius:50%;">
                </div>
                <ul class="sidebar-menu mt-5" style="margin-top:3%; ">
                    {{-- <li class="menu-header">Dashboard</li> --}}
                    <li class="dropdown">
                        <a href="/staff" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                    </li>
                    <li class="dropdown">
                        <a href="/staff/data" class="nav-link"><i class="fas fa-flask"></i><span>Data Analisa Kimia</span></a>
                    </li>

                    {{-- Mikrobiologi Air --}}
                    <li class="dropdown active">
                        <a href="/staff/mikrobiologi" class="nav-link"><i class="fas fa-bacterium"></i><span>Mikrobiologi Air</span></a>
                    </li>
                    {{-- <li class="dropdown">
                        <a href="/staff/analisakimia/history" class="nav-link"><i class="fas fa-history"></i><span>History Delete</span></a>
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
                    <h1>Data Analisa Mikrobiologi Air</h1>
                </div>

                <div class="section-body">
                    <h2 class="section-title">Data Analisa Mikrobiologi Air</h2>
                    {{-- <p class="section-lead">Example of some Bootstrap table components.</p> --}}

                    <div class="row">
                        <div class="col-12">
                            <div class="card">



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

                                @if(Session::get('staffttd'))
                                    <div class="alert alert-success w-70">
                                        {{Session::get('staffttd')}}
                                    </div>
                                @endif

                                @if(Session::get('declinettd'))
                                    <div class="alert alert-danger w-70">
                                        {{Session::get('declinettd')}}
                                    </div>
                                @endif


                                <div class="card-body mt-4">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-md">
                                            <tr>
                                                <th>No</th>
                                                <th>No.Dokumen</th>
                                                <th>Tanggal Inokulasi</th>
                                                <th>Tanggal Pengamatan</th>
                                                <th>Tanda Tangan Operator</th>
                                                <th>Tanda Tangan Staff</th>
                                                <th>Action</th>
                                            </tr>
                                            @forelse ($mikrobiologi_airs as $mikrobiologi_air)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$mikrobiologi_air->nodokumen}}</td>
                                                <td>{{Carbon\Carbon::parse($mikrobiologi_air->tgl_inokulasi)->translatedFormat('d F Y')}}</td>
                                                <td>{{Carbon\Carbon::parse($mikrobiologi_air->tgl_pengamatan)->translatedFormat('d F Y')}}</td>
                                                <td align="center">
                                                    @if($mikrobiologi_air['statusOP'] == 0)
                                                        {{-- <form action="/operatorttd/{{$mikrobiologi_air['id']}}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="badge badge-success btn">TTD</button>
                                                        
                                                        </form> --}}
                                                        Data Belum Ditandatangani
                                
                                                        
                                                        @elseif($mikrobiologi_air['statusOP'] == 1)
                                                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate($mikrobiologi_air->user_id_OP .'_'. $mikrobiologi_air->name_id_OP)) !!}" alt="">

                                                        {{-- {!! QrCode::size(100)->generate($mikrobiologi_air->user_id_OP ."_". $mikrobiologi_air->name_id_OP) !!} --}}
                                                    @endif
                                                </td>
                                                <td align="center">
                                                    @if($mikrobiologi_air['statusST'] == 0)
                                                        <form action="/staff/mikrobiologi/ttd/{{$mikrobiologi_air['id']}}" method="POST" class="text-center">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success btn">TTD</button>
                                                        </form>
                                
                                                        <form action="/staff/mikrobiologi/declinettd/{{$mikrobiologi_air['id']}}" method="POST" style="margin-top:5%;" class="text-center">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-danger btn">Tolak</button>
                                                        </form>
                                                    

                                                    @elseif($mikrobiologi_air['statusST'] == 1)
                                                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate($mikrobiologi_air->user_id_ST ."_". $mikrobiologi_air->name_id_ST)) !!}" alt="">
                                                    @elseif($mikrobiologi_air['statusST'] == 2)
                                                        <div class="alert alert-danger">Data Ditolak</div>
                                                    @endif

                                                </td>
                                                <td>
                                                    <form action="{{route('delete', $mikrobiologi_air['id'])}}" method="POST" style="text-center">
                                                        @csrf 
                                                        @method('DELETE') 
                                                        {{-- <button class="text-danger btn"><i class="fa-solid fa-trash"></i></button>
                                                        <br>
                                                        <a class="fa-solid fa-pen-to-square text-success btn" href="{{route('edit', $mikrobiologi_air->id)}}"></a>
                                                        <br>--}}
                                                        
                                                        {{-- <a class="fa-solid fa-file-pdf ml-1 btn" target="_blank" href="{{route('staff_analisakimiapdf', $mikrobiologi_air->id)}}"></a> --}}
                                                        <a href="{{route('staff_mikrobiologi_pdf', $mikrobiologi_air->id)}}" target="_blank"><i class="fa-solid fa-file-pdf ml-1 fa-lg"></i></a>
                                                        
                                                    </form>              
                                                </td>
                                            </tr>

                                            @empty
                                                <tr>
                                                  <td class="text-center h5" colspan="9">Not Found</td>
                                                </tr>
                                        @endforelse
                                        </table>
                                        {{ $mikrobiologi_airs->links('pagination::bootstrap-4') }}
                                    </div>
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
