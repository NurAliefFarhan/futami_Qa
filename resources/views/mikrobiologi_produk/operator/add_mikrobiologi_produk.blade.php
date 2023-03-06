@extends('layout-operator')
@section('content')


    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Dokumen Mikrobiologi Produk</h1>
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



            <div class="section-body">
                <h2 class="section-title">Tambah Dokumen Mikrobiologi Produk</h2> 

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card">
                                <form action="{{route('mikrobiologi_produk.post')}}" method="POST">
                                  @csrf
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nama_produk">Nama Produk</label>
                                                <input type="string" name="nama_produk" class="form-control" id="nama_produk" placeholder="Masukkan Nama Produk">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="jumlah_batch">Jumlah Batch</label>
                                                <input type="number" name="jumlah" class="form-control" id="jumlah_batch" placeholder="Masukkan Jumlah Batch">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="tgl_produksi">Tanggal Produksi</label>
                                                <input type="date" name="tgl_produk" class="form-control" id="tgl_produksi" placeholder="Masukkan Tanggal Produksi">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="tgl_inokulasi">Tanggal Inokulasi (Tanggal Pemindahan)</label>
                                                <input type="date" name="tgl_inokulasi" class="form-control" id="tgl_inokulasi" placeholder="Masukkan Tanggal Inokulasi (waktu pemindahan)">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="tgl_pengamatan">Tanggal Pengamatan</label>
                                                <input type="date" name="tgl_pengamatan" class="form-control" id="tgl_pengamatan" placeholder="Masukkan Tanggal Pengamatan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                      <button class="btn btn-success" style="width:30%; text-align:center; margin-left:70%; margin-top:-2%;">Simpan Data</button>
                                      <a href="/operator/mikrobiologi_produk" class="btn btn-primary" style="width:30%; text-align:center; margin-top:-5%;">Back</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
