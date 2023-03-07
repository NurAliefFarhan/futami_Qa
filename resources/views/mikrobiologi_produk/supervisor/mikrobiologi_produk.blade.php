@extends('layout-operator')
@section('content')


<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Analisa Kimia</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Data Analisa Kimia</h2>
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
                        <div class="alert alert-danger w-70">
                            {{Session::get('successUpdate')}}
                        </div>
                        @endif

                        @if(Session::get('supervisorttd'))
                        <div class="alert alert-success w-70">
                            {{Session::get('supervisorttd')}}
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
                                        <th>Tanda Tangan Supervisor</th>
                                        <th>Action</th>
                                    </tr>
                                    @forelse ($mikrobiologi_produks as $mikrobiologi_produk)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$mikrobiologi_produk->nodokumen}}</td>
                                            <td>{{Carbon\Carbon::parse($mikrobiologi_produk->tgl_inokulasi)->translatedFormat('d F Y')}}</td>
                                            <td>{{Carbon\Carbon::parse($mikrobiologi_produk->tgl_pengamatan)->translatedFormat('d F Y')}}</td>
                                            <td align="center">
                                                @if($mikrobiologi_produk['statusOP'] == 0)
                                                    {{-- <form action="/operatorttd/{{$mikrobiologi_produk['id']}}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="badge badge-success btn">TTD</button>
                                                        
                                                    </form> --}}
                                                    Data Belum Ditandatangani
                                                
                                                    @elseif($mikrobiologi_produk['statusOP'] == 1)
                                                    {{-- {!! QrCode::size(100)->generate($mikrobiologi_produk->user_id_OP ."_". $mikrobiologi_produk->name_id_OP) !!} --}}
                                                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($mikrobiologi_produk->user_id_OP ."_". $mikrobiologi_produk->name_id_OP)) !!}" alt="">

                                                @endif
                                            </td>
                                            <td>
                                                @if($mikrobiologi_produk['statusST'] == 0)
                                                    {{-- <form action="/staffttd/{{$mikrobiologi_produk['id']}}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="badge badge-success btn">TTD</button>

                                                    </form>
                            
                                                    <form action="/declinettd/{{$mikrobiologi_produk['id']}}" method="POST" style="margin-top:5%;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="badge badge-danger btn">Tolak</button>

                                                    </form> --}}

                                                    <p>Data Belum Ditandatangani</p>

                                                
                                                @elseif($mikrobiologi_produk['statusST'] == 1)
                                                    {{-- {!! QrCode::size(80)->generate($mikrobiologi_produk->user_id_ST ."_". $mikrobiologi_produk->name_id_ST) !!} --}}
                                                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($mikrobiologi_produk->user_id_ST ."_". $mikrobiologi_produk->name_id_ST)) !!}" alt="">


                                                @elseif($mikrobiologi_produk['statusST'] == 2)
                                                    <div class="alert alert-danger">Data Ditolak</div>
                                                @endif
                                            </td>
                                            <td>
                                                @if($mikrobiologi_produk['statusSP'] == 0)
                                                <form action="/supervisor/mikrobiologi_produk/ttd/{{$mikrobiologi_produk['id']}}" method="POST" class="text-center">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success btn">TTD</button>

                                                    {{-- <button type="submit" class="badge badge-success btn">TTD</button> --}}

                                                </form>
                           
                                                
                                              @elseif($mikrobiologi_produk['statusSP'] == 1)
                                                {{-- {!! QrCode::size(80)->generate($mikrobiologi_produk->user_id_SP ."_". $mikrobiologi_produk->name_id_SP) !!} --}}
                                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($mikrobiologi_produk->user_id_SP ."_". $mikrobiologi_produk->name_id_SP)) !!}" alt="">

                                              @endif
                                            </td>
                                            <td>
                                                <form action="{{route('delete', $mikrobiologi_produk['id'])}}" method="POST">
                                                    @csrf 
                                                    @method('DELETE') 
                                                    {{-- <button class="text-danger btn"><i class="fa-solid fa-trash"></i></button>
                                                    <br>
                                                    <a class="fa-solid fa-pen-to-square text-success btn" href="{{route('edit', $mikrobiologi_produk->id)}}"></a>
                                                    <br>--}}
                                                    
                                                    {{-- <a class="fa-solid fa-file-pdf ml-1 btn" target="_blank" href="{{route('supervisor_analisakimiapdf', $mikrobiologi_produk->id)}}"></a> --}}
                                                    <a href="{{route('SP_mikrobiologi_produk_pdf', $mikrobiologi_produk->id)}}" target="_blank"><i class="fa-solid fa-file-pdf ml-1 fa-lg"></i></a>

                                                </form> 
                                            </td>
                                        </tr>

                                        @empty
                                            <tr>
                                                <td class="text-center h5" colspan="10" align="center">Not Found</td>
                                            </tr>
                                    @endforelse
                                </table>
                                {{ $mikrobiologi_produks->links('pagination::bootstrap-4') }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection
