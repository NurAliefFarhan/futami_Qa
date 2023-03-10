@extends('layout-operator')
@section('content')


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



@endsection
