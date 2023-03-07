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
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
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
                    <a href="/operator/mikrobiologi_produk" class="nav-link"><i class="fas fa-boxes-stacked"></i><span>Mikrobiologi Produk</span></a>
                </li>

              </ul>
            <hr>
        </aside>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Data Dokumen Mikrobiologi Produk</h1>
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


            @if(Session::get('successDelete'))
                <div class="alert alert-danger w-70">
                    {{Session::get('successDelete')}} 
                </div>
            @endif



            <form action="{{route('update_mikrobiologi_produk.post', $mikrobiologi_produk['id'])}}" method="POST">
                @csrf
                @method('PATCH')

                <div class="section-body">
                    <h2 class="section-title">Edit Data Dokumen</h2>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card">
                                    {{-- <form action="{{route('update_data_analisa_kimia', $futamis['id'])}}" method="POST">
                                        @csrf
                                        @method('PATCH') --}}

                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">No.Dokumen</label>
                                                    <input type="text" name="nodokumen" value="{{$mikrobiologi_produk['nodokumen']}}" class="form-control" id="inputEmail4" placeholder="Masukkan No.Dokumen (4/LAK/V1/21)" disabled>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="nama_produk">Nama Produk</label>
                                                    <input type="string" name="nama_produk" value="{{ $mikrobiologi_produk['nama_produk'] }}" class="form-control" id="nama_produk" placeholder="Masukkan Nama Produk">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="jumlah_batch">Jumlah Batch</label>
                                                    <input type="number" name="jumlah" value="{{ $mikrobiologi_produk['jumlah'] }}" class="form-control" id="jumlah_batch" placeholder="Masukkan Jumlah Batch">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="tgl_produksi">Tanggal Produksi</label>
                                                    <input type="date" name="tgl_produk" value="{{ $mikrobiologi_produk['tgl_produk'] }}" class="form-control" id="tgl_produksi" placeholder="Masukkan Tanggal Produksi">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="tgl_inokulasi">Tanggal Inokulasi (Tanggal Pemindahan)</label>
                                                    <input type="date" name="tgl_inokulasi" value="{{ $mikrobiologi_produk['tgl_inokulasi'] }}" class="form-control" id="tgl_inokulasi" placeholder="Masukkan Tanggal Inokulasi (waktu pemindahan)">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="tgl_pengamatan">Tanggal Pengamatan</label>
                                                    <input type="date" name="tgl_pengamatan" value="{{ $mikrobiologi_produk['tgl_pengamatan'] }}" class="form-control" id="tgl_pengamatan" placeholder="Masukkan Tanggal Pengamatan">
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="card-footer">
                                            <button class="btn btn-success" style="width:30%; text-align:center; margin-left:70%; margin-top:-2%;">Simpan Data</button>
                                            <a href="/operator/data" class="btn btn-primary" style="width:30%; text-align:center; margin-left:1%; margin-top:-5%;">Back</a>
                                        </div> --}}
                                    {{-- </form> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-body">
                    <h2 class="section-title">Edit Data Sampel Mikrobiologi Produk</h2> 
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card">
                                    <span class="d-none" style="display: none; ">{{ $i=0 }}</span> 

                                    {{-- @foreach ($sampel_mikrobiologis as $sampel_mikrobiologi) --}}
                                        <span class="d-none">{{ $i++ }} </span>
                                        
                                        <div class="card-body">
                                            <div class="form-row" style="margin-top:-3%;">
                                                <div class="form-group col-md-2" align="center">
                                                    <label for="inputEmail4">Kode Sampling</label>
                                                </div> 
                                                <div class="form-group col-md-2" align="center">
                                                    <label for="inputEmail4">Jam pada Exp Date</label>
                                                </div> 
                                                <div class="form-group col-md-2" align="center"> 
                                                    <label for="inputEmail4">TPC</label>
                                                </div>
                                                <div class="form-group col-md-2" align="center">
                                                    <label for="inputEmail4">Yeast & Mold</label>
                                                </div>
                                                <div class="form-group col-md-2" align="center">
                                                    <label for="inputEmail4">Coliform</label>
                                                </div>
                                                <div class="form-group col-md-2" align="center">
                                                    <label for="inputEmail4">Keterangan</label>
                                                </div>
                                            </div>

                                            @foreach ($sampel_mikrobiologi_produk as $sampel_mikrobiologi)
                                                <div class="form-row" style="margin-top:-2%;">
                                                    <div class="form-group col-md-2">
                                                        <input type="text" name="inputSampel[{{ $i }}][kode_sampling]" value="{{$sampel_mikrobiologi['kode_sampling']}}" class="form-control" id="inputEmail4" placeholder="Masukkan nama sampel">
                                                    </div> 
                                                    <div class="form-group col-md-2">
                                                        <input type="time" name="inputSampel[{{ $i }}][exp_date]" value="{{$sampel_mikrobiologi['exp_date']}}" class="form-control" id="inputEmail4" placeholder="Masukkan nama sampel">
                                                    </div> 
                                                    <div class="form-group col-md-2">
                                                        <input type="text" name="inputSampel[{{ $i }}][tpc]" value="{{$sampel_mikrobiologi['tpc']}}" class="form-control" id="inputEmail4" placeholder="Masukkan nama sampel">
                                                    </div> 
                                                    <div class="form-group col-md-2">
                                                        <input type="text" name="inputSampel[{{ $i }}][yeast_mold]" value="{{$sampel_mikrobiologi['yeast_mold']}}" class="form-control" id="inputEmail4" placeholder="Masukkan nama sampel">
                                                    </div> 
                                                    <div class="form-group col-md-2">
                                                        <input type="text" name="inputSampel[{{ $i }}][coliform]" value="{{$sampel_mikrobiologi['coliform']}}" class="form-control" id="inputEmail4" placeholder="Masukkan nama sampel">
                                                    </div> 
                                                    <div class="form-group col-md-2">
                                                        <input type="text" name="inputSampel[{{ $i }}][keterangan]" value="{{$sampel_mikrobiologi['keterangan']}}" class="form-control" id="inputEmail4" placeholder="Masukkan nama sampel">
                                                    </div> 
                                                </div>
                                            @endforeach


                                        </div>
                                    {{-- @endforeach --}}
                                        {{-- <div class="card-footer">
                                            <button class="btn btn-success" style="width:30%; text-align:center; margin-left:70%; margin-top:-2%;">Simpan Data</button>
                                            <a href="/operator/data" class="btn btn-primary" style="width:30%; text-align:center; margin-left:1%; margin-top:-5%;">Back</a>
                                        </div> --}}
                                    {{-- </form> --}}
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success" style="width:35%; text-align:center; margin-left:64%; margin-top:20px;">Simpan Data</button>
                                    <a href="/operator/mikrobiologi_produk" class="btn btn-primary" style="width:30%; text-align:center; margin-top:-60px;">Back</a>
                                </div>
                            </div>       
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>




        <div class="main-content" style="margin-top:-6%;">
            <section class="section">
                <form action="{{route('sampel_mikrobiologi_produk.post', $mikrobiologi_produk['id'])}}" method="POST">
                    @csrf

                    <div class="section-body">
                        <h2 class="section-title">Tambah Data Sampel</h2>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card d-flex justify-content-right" style="">
                                        <div class="card-body">
                                            {{-- <form action="{{route('sampel_analisa_kimia.post', $futamis['id'])}}" method="POST">
                                                @csrf --}}
              
                                                <div class="card-body" id="sampel"> 
                                                    <div class="form-row" style="margin-top:-1%;">
                                                        <div class="form-group col-md-2" align="center">
                                                            <label for="kode-sampling">Kode Sampling</label>
                                                        </div> 
                                                        <div class="form-group col-md-2" align="center">
                                                            <label for="exp_date">jam pada Exp Date</label>
                                                        </div> 
                                                        <div class="form-group col-md-1" align="center"> 
                                                            <label for="tpc">TPC (cfu/ml)</label>
                                                        </div>
                                                        <div class="form-group col-md-2" align="center"> 
                                                            <label for="yeast_mold">Yeast & Mold (cfu/ml)</label>
                                                        </div>
                                                        <div class="form-group col-md-2" align="center"> 
                                                            <label for="coliform">Coliform (MPN/100ml)</label>
                                                        </div>
                                                        <div class="form-group col-md-2" align="center">
                                                            <label for="keterangan">Keterangan</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row" style="margin-top:-3%;">
                                                        <div class="form-group col-md-2"> 
                                                            <input type="text" name="inputSampel[0][kode_sampling]" class="form-control" id="kode_sampling" placeholder="Masukkan Kode Sampling">
                                                        </div> 
                                                        <div class="form-group col-md-2">
                                                            <input type="time" name="inputSampel[0][exp_date]" class="form-control" id="exp_date" placeholder="Masukkan Exp Date">
                                                        </div> 
                                                        <div class="form-group col-md-1">
                                                            <input type="text" name="inputSampel[0][tpc]" class="form-control" id="tpc" placeholder="TPC">
                                                        </div> 
                                                        <div class="form-group col-md-2">
                                                            <input type="text" name="inputSampel[0][yeast_mold]" class="form-control" id="yeast_mold" placeholder="Masukkan Yeast & Mold">
                                                        </div> 
                                                        <div class="form-group col-md-2"> 
                                                            <input type="text" name="inputSampel[0][coliform]" class="form-control" id="coliform" placeholder="Masukkan Coliform">
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <input type="text" name="inputSampel[0][keterangan]" class="form-control" id="keterangan" placeholder="keterangan (Optional)">
                                                        </div>
                                                        <div class="form-group col-md-1">
                                                            <button type="button" name="addSampel" id="addSampel" class="btn btn-primary"><i class="fa-solid fa-plus"></i></button>
                                                        </div>
                                                        {{-- <div class="form-group col-md-1">
                                                            <button type="button" name="remove" id="remove" class="btn btn-danger" style="margin-left:-5%;"><i class="fa-solid fa-trash"></i></button>
                                                        </div> --}}
                                                    </div>
                                                </div>

                                              {{-- </form> --}}
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success" style="width:80%; text-align:center; margin-left:7%; margin-top:-2%;">Simpan Data</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
            </section>
        </div>
        
    </form>
    {{-- </form> --}}

    {{-- <footer class="main-footer">
        <div class="footer-left">
            Futami Qa 
        </div>
        <div class="footer-right">
        </div>
    </footer> --}}
</div>
</div>


{{-- Script multiple input data sampel  --}}
<script>
    var i = 0;
    var maxInput = 28; 
    $('#addSampel').click(function(){
        if(i < maxInput){
            ++i;
            $('#sampel').append(`  

            <div class="card-body removeSampel" id="removeSampel" style="margin-top: -5%; margin-left:-25px;">

                <div class="form-row" style="margin-top:1%;">
                    <div class="form-group col-md-2">
                        <input type="text" name="inputSampel[${i}][kode_sampling]" class="form-control" id="kode_sampling" placeholder="Masukkan Kode sampling">
                    </div>
                    <div class="form-group col-md-2">
                        <input type="time" name="inputSampel[${i}][exp_date]" class="form-control" id="exp_date" placeholder="Masukkan Exp Date">
                    </div>
                    <div class="form-group col-md-1">
                        <input type="text" name="inputSampel[${i}][tpc]" class="form-control" id="tpc" placeholder="Masukkan TPC">
                    </div>
                    <div class="form-group col-md-2">
                        <input type="text" name="inputSampel[${i}][yeast_mold]" class="form-control" id="yeast_mold" placeholder="Masukkan Yeast & Mold">
                    </div>
                    <div class="form-group col-md-2"> 
                        <input type="text" name="inputSampel[${i}][coliform]" class="form-control" id="coliform" placeholder="Masukkan Coliform">
                    </div>
                    <div class="form-group col-md-2">
                        <input type="text" name="inputSampel[${i}][keterangan]" class="form-control" id="keterangan" placeholder="Keterangan (optional)">
                    </div>
                    <div class="form-group col-md-1" align="center">
                        <button type="button" name="remove" id="remove" class="btn btn-danger" style=""><i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
            </div>

        `); 

        }else{
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
            icon: 'warning',
            title: 'Input sampel telah mencapai batas maksimal!'
            })
        }
        
       
    });

    $(document).on('click','#remove', function(){ //#remove name nya, dalam jquery hapus sampel kita menggunakan name nya 
        // $(this).parent('div').remove(); 
        $(this).closest('.removeSampel').remove(); 
        i--;
    })
</script>



@endsection
