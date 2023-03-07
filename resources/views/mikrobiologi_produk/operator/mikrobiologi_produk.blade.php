@extends('layout-operator')
@section('content')


        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Analisa Mikrobiologi Produk</h1>
                </div>

                <div class="section-body">
                    <h2 class="section-title">Analisa Mikrobiologi Produk</h2>

                    {{-- <p class="section-lead">Example of some Bootstrap table components.</p> --}}

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



                                <div class="button" style="margin-left:4%;">
                                    {{-- <button type="submit" name="submit" id="" class="btn btn-success">Tambah Data</button> --}}
                                    {{-- <a href="/operator/tambahdata" class="btn btn-success">Tambah Data</a> --}}

                                    {{-- button create multi form --}}
                                    <a href="/operator/add_mikrobiologi_produk" class="btn btn-success" style="margin-top: 20px;"><i class="fa fa-plus"></i> Tambah Data</a>
                                    
                                    <a href="/operator/mikrobiologi_produk/history" class="btn btn-danger" style="width:auto; text-align:center; float:right; margin:20px;"><i class="fa fa-history"></i> History Delete</a>
                                  </div>

                                {{-- <form action="{{route('operatorpdf')}}" method="POST" target="_blank">
                                  @csrf
                                  
                                  <div class="button_download" style="margin-left:84%; margin-top:-4%;">
                                    <div class="col-md-7 col-lg-5">
                                      <a href="/operator/data/pdf" target="_blank">
                                        <button type="button" class="btn btn-outline-primary">
                                          <i class="fa-solid fa-file-pdf fa-2x ml-5"></i>
                                        </button>
                                      </a>
                                    </div>
  
                                  </div>
                                </form> --}}

    
                                <div class="card-body mt-1 shadow">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-md">
                                            <tr>
                                                <th>No</th>
                                                <th>No.Dokumen</th>
                                                <th>Nama Produk</th>
                                                <th>Jumlah Batch</th>
                                                <th>Tgl. Produksi</th>
                                                <th>Tgl. Inokulasi</th>
                                                <th>Tgl. Pengamatan</th>
                                                <th>Tanda Tangan Operator</th>
                                                <th>Action</th>
                                            </tr>
                                            @forelse ($mikrobiologi_produk as $mikrobiologi)
                                                <tr>
                                                    <td>{{$no++}}</td>
                                                    <td>{{$mikrobiologi->nodokumen}}</td>
                                                    <td>{{$mikrobiologi->nama_produk}}</td>
                                                    <td>{{$mikrobiologi->jumlah}}</td>
                                                    <td>{{Carbon\Carbon::parse($mikrobiologi->tgl_produk)->translatedFormat('d F Y')}}</td>
                                                    <td>{{Carbon\Carbon::parse($mikrobiologi->tgl_inokulasi)->translatedFormat('d F Y')}}</td>
                                                    <td>{{Carbon\Carbon::parse($mikrobiologi->tgl_pengamatan)->translatedFormat('d F Y')}}</td>
                                                    <td align="center">
                                                        @if($mikrobiologi['statusOP'] == 0)
                                                            <form action="/operator/mikrobiologi_produk/ttd/{{$mikrobiologi['id']}}" method="POST" class="text-center">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-success btn" style="">TTD</button>
                                                            </form>
                                    
                                                            
                                                        @elseif($mikrobiologi['statusOP'] == 1)
                                                            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate($mikrobiologi->user_id_OP .'_'. $mikrobiologi->name_id_OP)) !!}" alt="">
                                                            
                                                        @endif

                                                    </td>
                                                    <td>
                                                        <form action="{{route('mikrobiologi_produk_Delete', $mikrobiologi['id'])}}" method="POST">
                                                            @csrf 
                                                            {{-- @method('DELETE')  --}}
                                                            @method('PATCH') 

                                                            <button class="text-danger btn"><i class="fa-solid fa-trash"></i></button>
                                                            
                                                            <br>
                                                            <a class="fa-solid fa-pen-to-square text-success btn" href="{{route('edit_mikrobiologi_produk', $mikrobiologi->id)}}"></a>
                                                            
                                                            <br>                                                   
                                                            <a class="fa-solid fa-file-pdf ml-1 btn" target="_blank" href="{{route('OP_mikrobiologi_produk_pdf', $mikrobiologi->id)}}"></a>
                                                            <br>
                                                            <a href="{{ route('mikrobiologi_produk_sampel', $mikrobiologi->id) }}" class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-table"></i> Data sampel</a>
                                                            
                                                        </form> 

                                                    </td>
                                                </tr>

                                                @empty
                                                    <tr>
                                                      <td class="text-center h5" colspan="8">Not Found</td>
                                                    </tr>
                                            @endforelse
                                            
                                          </table>
                                            {{ $mikrobiologi_produk->links('pagination::bootstrap-4') }}
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

@endsection


