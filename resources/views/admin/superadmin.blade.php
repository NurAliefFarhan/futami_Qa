@extends('layout-operator')
@section('content')


<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                </ul>
            </form>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown"><a href="#" data-toggle="dropdown"
                        class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        {{-- <img alt="image" src="{{asset('assets/img/admin.jpg')}}" class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;"> --}}
                        <img alt="image" src="{{asset('assets/template/stisla/assets/img/avatar/avatar-3.png')}}" class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;">
                        {{-- <img class="img-profile rounded-circle" src="{{asset('assets/img/admin.jpg')}}"> --}}

                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-title">Hi, {{ Auth::user()->nama }}</div>
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
                    <li class="dropdown active">
                        <a href="/operator" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                    </li>
                    <li class="dropdown">
                        <a href="/operator/data" class="nav-link"><i class="fa-solid fa-flask"></i><span>Data Analisa Kimia</span></a>
                    </li>
                    <li class="dropdown">
                        <a href="/operator/analisakimia/history" class="nav-link"><i class="fas fa-history"></i><span>History Delete</span></a>
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
                    <h1>Dashboard</h1>
                </div>

                
                    {{-- disesuaikan dengan halaman Middleware, sehingga harus login untuk akses perpus, tidak bisa http://127.0.0.1:8000/dashboardUser/user --}}
                    @if(Session::get('notAllowed'))
                        <div class="alert alert-danger w-70">
                            {{Session::get('notAllowed')}} 
                        </div>
                    @endif
                    
                    @if(Session::get('successLogin'))
                        <div class="alert alert-success w-70">
                            {{Session::get('successLogin')}} 
                        </div>
                    @endif



                <div class="section-body">
                    <h2 class="section-title">Hi' {{ Auth::user()->nama }}</h2>
                    {{-- <p class="section-lead">This page is just an example for you to create your own page.</p> --}}
                    <div class="card">
                        {{-- <div class="card-header">
                            <h4>{{ Auth::user()->nama }}</h4> 
                        </div> --}}

                        <div class="card-body">
                            <p>Hallo,  
                                {{-- {{ Auth::user()->id }} --}}
                                {{ Auth::user()->nama }}
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <footer class="main-footer">
            <div class="footer-left">
                Futami Super Admin
                {{-- Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a> --}}
            </div>
            <div class="footer-right">

            </div>
        </footer>
    </div>
</div>



@endsection
