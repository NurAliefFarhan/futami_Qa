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
                                            <th>Pemberi sampel</th>
                                            {{-- <th>Parameter Pengujian</th>
                                            <th>Jumlah sampel</th> --}}
                                            <th>Tanggal terima sampel</th>
                                            <th>Tanggal Uji</th>
                                            <th>Tanggal selesai uji</th>
                                            {{-- <th>Sampel</th>
                                            <th>Parameter dan Nilai Uji</th>
                                            <th>Spesifikasi</th>
                                            <th>Keterangan</th> --}}
                                            <th>Tanda Tangan Operator</th>
                                            <th>Tanda Tangan Staff</th>
                                            <th>Action</th>
                                        </tr>
                                        @forelse ($futamis as $futami)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$futami->nodokumen}}</td>
                                                <td>{{$futami->pemberi_sampel}}</td>
                                                {{-- <td>{{$futami->parameter_pengujian}}</td>
                                                <td>{{$futami->jumlah_sampel}}</td> --}}
                                                <td>{{$futami->tanggal_terima}}</td>
                                                <td>{{$futami->tanggal_uji}}</td>
                                                <td>{{$futami->tanggal_selesai}}</td>
                                                {{-- <td>{{$futami->sampel}}</td>
                                                <td>{{$futami->parameter_nulaiuji}}</td>
                                                <td>{{$futami->spesifikasi}}</td>
                                                <td>{{$futami->keterangan}}</td> --}}
                                                <td>
                                                    @if($futami['statusOP'] == 0)
                                                        {{-- <form action="/operatorttd/{{$futami['id']}}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="badge badge-success btn">TTD</button>
                                                        
                                                        </form> --}}
                                                        Data Belum Ditandatangani
                                
                                                        
                                                        @elseif($futami['statusOP'] == 1)
                                                        {{-- {{ $futami->user_id_OP }} _ {{ $futami->name_id_OP }} --}}
                                                        {{-- <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate($futami->user_id_OP .'_'. $futami->name_id_OP)) !!}" alt=""> --}}

                                                        {!! QrCode::size(100)->generate($futami->user_id_OP ."_". $futami->name_id_OP) !!}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($futami['statusST'] == 0)
                                                    <form action="/staffttd/{{$futami['id']}}" method="POST" class="text-center">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-success btn">TTD</button>

                                                        
                                                        {{-- <button type="submit" class="badge badge-success btn">TTD</button> --}}

                                                    </form>
                            
                                                    <form action="/declinettd/{{$futami['id']}}" method="POST" style="margin-top:5%;" class="text-center">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-danger btn">Tolak</button>

                                                    </form>

                                                    
                                                    @elseif($futami['statusST'] == 1)
                                                    {{-- {{ $futami->user_id_ST }} _ {{ $futami->name_id_ST }} --}}

                                                        {{-- <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate($futami->user_id_ST ."_". $futami->name_id_ST)) !!}" alt=""> --}}
                                                        {!! QrCode::size(100)->generate($futami->user_id_ST ."_". $futami->name_id_ST) !!}

                                                    @elseif($futami['statusST'] == 2)
                                                        <div class="alert alert-danger">Data Ditolak</div>
                                                @endif

                                                </td>
                                                <td>
                                                    <form action="{{route('delete', $futami['id'])}}" method="POST" style="text-center">
                                                        @csrf 
                                                        @method('DELETE') 
                                                        {{-- <button class="text-danger btn"><i class="fa-solid fa-trash"></i></button>
                                                        <br>
                                                        <a class="fa-solid fa-pen-to-square text-success btn" href="{{route('edit', $futami->id)}}"></a>
                                                        <br>--}}
                                                        
                                                        {{-- <a class="fa-solid fa-file-pdf ml-1 btn" target="_blank" href="{{route('staff_analisakimiapdf', $futami->id)}}"></a> --}}
                                                        <a href="{{route('staff_analisakimiapdf', $futami->id)}}" target="_blank"><i class="fa-solid fa-file-pdf ml-1 fa-lg"></i></a>
                                                        
                                                    </form>              
                                                </td>
                                            </tr>

                                            @empty
                                                <tr>
                                                <td class="text-center h5" colspan="9">Not Found</td>
                                                </tr>
                                        @endforelse
                                    </table>
                                    {{ $futamis->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                            {{-- <div class="card-footer text-right">
                            <nav class="d-inline-block">
                            <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                                <li class="page-item">
                                <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                </li>
                            </ul>
                            </nav>
                        </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
