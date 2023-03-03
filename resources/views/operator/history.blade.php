@extends('layout-operator')
@section('content')


    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>History Analisa Kimia</h1>
            </div>

            <div class="section-body">
                <h2 class="section-title">History Analisa Kimia</h2>

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
                          <div class="button" style="margin-left:4%; margin-top:3%;">
                              <a href="/operator/data" class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-house"></i> Back</a>

                          </div>

                          <div class="card-body mt-3 shadow">
                              <div class="table-responsive">
                                  <table class="table table-bordered table-md">
                                      <tr>
                                          <th>No</th>
                                          <th>No.Dokumen</th>
                                          <th>Pemberi sampel</th>
                                          <th>Tanggal terima sampel</th>
                                          <th>Tanggal Uji</th>
                                          <th>Tanggal selesai uji</th>
                                          {{-- <th>Action</th> --}}
                                      </tr>
                                      @forelse ($futamis as $futami)
                                          <tr>
                                              <td>{{$no++}}</td>
                                              <td>{{$futami->nodokumen}}</td>
                                              <td>{{$futami->pemberi_sampel}}</td>
                                              <td>{{Carbon\Carbon::parse($futami->tanggal_terima)->translatedFormat('d F Y')}}</td>
                                              <td>{{Carbon\Carbon::parse($futami->tanggal_uji)->translatedFormat('d F Y')}}</td>
                                              <td>{{Carbon\Carbon::parse($futami->tanggal_selesai)->translatedFormat('d F Y')}}</td>
                                              {{-- <td>
                                                  <a href="{{ route('sampel', $futami->id) }}" class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-table"></i> Data sampel</a>
                                              </td> --}}
                                            </tr>
                                          @empty
                                              <tr>
                                                <td class="text-center h5" colspan="8">Not Found</td>
                                              </tr>
                                      @endforelse
                                      
                                    </table>
                                    {{ $futamis->links('pagination::bootstrap-4') }}
                                  </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
