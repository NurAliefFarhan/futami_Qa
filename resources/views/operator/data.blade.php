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
                                <a href="/operator/analisakimia" class="btn btn-success" style="margin-top: 20px;">Tambah Data</a>
                                
                                <a href="/operator/analisakimia/history" class="btn btn-danger" style="width:auto; text-align:center; float:right; margin:20px;"><i class="fa fa-history"></i> History Delete</a>
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
                                            <th>Pemberi sampel</th>
                                            {{-- <th>Parameter Pengujian</th> --}}
                                            {{-- <th>Jumlah sampel</th> --}}
                                            <th>Tanggal terima sampel</th>
                                            <th>Tanggal Uji</th>
                                            <th>Tanggal selesai uji</th>
                                            {{-- <th>Sampel</th>
                                            <th>Parameter dan Nilai Uji</th>
                                            <th>Spesifikasi</th>
                                            <th>Keterangan</th> --}}
                                            <th>Tanda Tangan Operator</th>
                                            <th>Action</th>
                                        </tr>
                                        @forelse ($futamis as $futami)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$futami->nodokumen}}</td>
                                                <td>{{$futami->pemberi_sampel}}</td>
                                                {{-- <td>{{$futami->parameter_pengujian}}</td> --}}
                                                {{-- <td>{{$futami->jumlah_sampel}}</td> --}}
                                                <td>{{Carbon\Carbon::parse($futami->tanggal_terima)->translatedFormat('d F Y')}}</td>
                                                <td>{{Carbon\Carbon::parse($futami->tanggal_uji)->translatedFormat('d F Y')}}</td>
                                                <td>{{Carbon\Carbon::parse($futami->tanggal_selesai)->translatedFormat('d F Y')}}</td>
                                                {{-- <td>{{$futami->sampel}}</td>
                                                <td>{{$futami->parameter_nulaiuji}}</td>
                                                <td>{{$futami->spesifikasi}}</td>
                                                <td>{{$futami->keterangan}}</td> --}}
                                                <td>
                                                  @if($futami['statusOP'] == 0)
                                                    <form action="/operatorttd/{{$futami['id']}}" method="POST" class="text-center">
                                                      @csrf
                                                      @method('PATCH')
                                                      <button type="submit" class="btn btn-success btn" style="">TTD</button>

                                                  
                                                    </form>
                              
                                                    
                                                  @elseif($futami['statusOP'] == 1)
                                                    {{-- {!! QrCode::size(100)->generate(Request::url('alief')) !!} --}}
                                                    {{-- <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate($futami->user_id_OP .'_'. $futami->name_id_OP)) !!}" alt=""> --}}
                                                    
                                                    {!! (QrCode::size(100)->generate($futami->user_id_OP ."_". $futami->name_id_OP)) !!}

                                                  @endif

                                                </td>
                                                <td>
                                                    <form action="{{route('delete', $futami['id'])}}" method="POST">
                                                        @csrf 
                                                        @method('PATCH') 
                                                        <button class="text-danger btn"><i class="fa-solid fa-trash"></i></button>
                                                        
                                                        <br>
                                                        <a class="fa-solid fa-pen-to-square text-success btn" href="{{route('edit_data_analisa_kimia', $futami->id)}}"></a>
                                                        
                                                        <br>                                                   
                                                        <a class="fa-solid fa-file-pdf ml-1 btn" target="_blank" href="{{route('operator_analisakimiapdf', $futami->id)}}"></a>
                                                        <br>
                                                        <a href="{{ route('sampel', $futami->id) }}" class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-table"></i> Data sampel</a>
                                                        
                                                    </form> 

                                                </td>
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
                    {{-- <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                      <div class="card-header">
                        <h4>Full Width</h4>
                      </div>
                      <div class="card-body p-0">
                        <div class="table-responsive">
                          <table class="table table-striped table-md">
                            <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Created At</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                            <tr>
                              <td>1</td>
                              <td>Irwansyah Saputra</td>
                              <td>2017-01-09</td>
                              <td><div class="badge badge-success">Active</div></td>
                              <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td>Hasan Basri</td>
                              <td>2017-01-09</td>
                              <td><div class="badge badge-success">Active</div></td>
                              <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            <tr>
                              <td>3</td>
                              <td>Kusnadi</td>
                              <td>2017-01-11</td>
                              <td><div class="badge badge-danger">Not Active</div></td>
                              <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            <tr>
                              <td>4</td>
                              <td>Rizal Fakhri</td>
                              <td>2017-01-11</td>
                              <td><div class="badge badge-success">Active</div></td>
                              <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            <tr>
                              <td>5</td>
                              <td>Isnap Kiswandi</td>
                              <td>2017-01-17</td>
                              <td><div class="badge badge-success">Active</div></td>
                              <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      <div class="card-footer text-right">
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
                      </div>
                    </div>
                  </div> --}}
                </div>
                {{-- <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h4>Advanced Table</h4>
                        <div class="card-header-form">
                          <form>
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="Search">
                              <div class="input-group-btn">
                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                      <div class="card-body p-0">
                        <div class="table-responsive">
                          <table class="table table-striped">
                            <tr>
                              <th>
                                <div class="custom-checkbox custom-control">
                                  <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                  <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                </div>
                              </th>
                              <th>Task Name</th>
                              <th>Progress</th>
                              <th>Members</th>
                              <th>Due Date</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                            <tr>
                              <td class="p-0 text-center">
                                <div class="custom-checkbox custom-control">
                                  <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                                  <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                </div>
                              </td>
                              <td>Create a mobile app</td>
                              <td class="align-middle">
                                <div class="progress" data-height="4" data-toggle="tooltip" title="100%">
                                  <div class="progress-bar bg-success" data-width="100"></div>
                                </div>
                              </td>
                              <td>
                                <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                              </td>
                              <td>2018-01-20</td>
                              <td><div class="badge badge-success">Completed</div></td>
                              <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            <tr>
                              <td class="p-0 text-center">
                                <div class="custom-checkbox custom-control">
                                  <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-2">
                                  <label for="checkbox-2" class="custom-control-label">&nbsp;</label>
                                </div>
                              </td>
                              <td>Redesign homepage</td>
                              <td class="align-middle">
                                <div class="progress" data-height="4" data-toggle="tooltip" title="0%">
                                  <div class="progress-bar" data-width="0"></div>
                                </div>
                              </td>
                              <td>
                                <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Nur Alpiana">
                                <img alt="image" src="assets/img/avatar/avatar-3.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Hariono Yusup">
                                <img alt="image" src="assets/img/avatar/avatar-4.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Bagus Dwi Cahya">
                              </td>
                              <td>2018-04-10</td>
                              <td><div class="badge badge-info">Todo</div></td>
                              <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            <tr>
                              <td class="p-0 text-center">
                                <div class="custom-checkbox custom-control">
                                  <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-3">
                                  <label for="checkbox-3" class="custom-control-label">&nbsp;</label>
                                </div>
                              </td>
                              <td>Backup database</td>
                              <td class="align-middle">
                                <div class="progress" data-height="4" data-toggle="tooltip" title="70%">
                                  <div class="progress-bar bg-warning" data-width="70"></div>
                                </div>
                              </td>
                              <td>
                                <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Rizal Fakhri">
                                <img alt="image" src="assets/img/avatar/avatar-2.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Hasan Basri">
                              </td>
                              <td>2018-01-29</td>
                              <td><div class="badge badge-warning">In Progress</div></td>
                              <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            <tr>
                              <td class="p-0 text-center">
                                <div class="custom-checkbox custom-control">
                                  <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-4">
                                  <label for="checkbox-4" class="custom-control-label">&nbsp;</label>
                                </div>
                              </td>
                              <td>Input data</td>
                              <td class="align-middle">
                                <div class="progress" data-height="4" data-toggle="tooltip" title="100%">
                                  <div class="progress-bar bg-success" data-width="100"></div>
                                </div>
                              </td>
                              <td>
                                <img alt="image" src="assets/img/avatar/avatar-2.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Rizal Fakhri">
                                <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Isnap Kiswandi">
                                <img alt="image" src="assets/img/avatar/avatar-4.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Yudi Nawawi">
                                <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Khaerul Anwar">
                              </td>
                              <td>2018-01-16</td>
                              <td><div class="badge badge-success">Completed</div></td>
                              <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> --}}
                {{-- <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h4>Sortable Table</h4>
                        <div class="card-header-action">
                          <form>
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="Search">
                              <div class="input-group-btn">
                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                      <div class="card-body p-0">
                        <div class="table-responsive">
                          <table class="table table-striped" id="sortable-table">
                            <thead>
                              <tr>
                                <th class="text-center">
                                  <i class="fas fa-th"></i>
                                </th>
                                <th>Task Name</th>
                                <th>Progress</th>
                                <th>Members</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <div class="sort-handler">
                                    <i class="fas fa-th"></i>
                                  </div>
                                </td>
                                <td>Create a mobile app</td>
                                <td class="align-middle">
                                  <div class="progress" data-height="4" data-toggle="tooltip" title="100%">
                                    <div class="progress-bar bg-success" data-width="100"></div>
                                  </div>
                                </td>
                                <td>
                                  <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                                </td>
                                <td>2018-01-20</td>
                                <td><div class="badge badge-success">Completed</div></td>
                                <td><a href="#" class="btn btn-secondary">Detail</a></td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="sort-handler">
                                    <i class="fas fa-th"></i>
                                  </div>
                                </td>
                                <td>Redesign homepage</td>
                                <td class="align-middle">
                                  <div class="progress" data-height="4" data-toggle="tooltip" title="0%">
                                    <div class="progress-bar" data-width="0"></div>
                                  </div>
                                </td>
                                <td>
                                  <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Nur Alpiana">
                                  <img alt="image" src="assets/img/avatar/avatar-3.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Hariono Yusup">
                                  <img alt="image" src="assets/img/avatar/avatar-4.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Bagus Dwi Cahya">
                                </td>
                                <td>2018-04-10</td>
                                <td><div class="badge badge-info">Todo</div></td>
                                <td><a href="#" class="btn btn-secondary">Detail</a></td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="sort-handler">
                                    <i class="fas fa-th"></i>
                                  </div>
                                </td>
                                <td>Backup database</td>
                                <td class="align-middle">
                                  <div class="progress" data-height="4" data-toggle="tooltip" title="70%">
                                    <div class="progress-bar bg-warning" data-width="70"></div>
                                  </div>
                                </td>
                                <td>
                                  <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Rizal Fakhri">
                                  <img alt="image" src="assets/img/avatar/avatar-2.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Hasan Basri">
                                </td>
                                <td>2018-01-29</td>
                                <td><div class="badge badge-warning">In Progress</div></td>
                                <td><a href="#" class="btn btn-secondary">Detail</a></td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="sort-handler">
                                    <i class="fas fa-th"></i>
                                  </div>
                                </td>
                                <td>Input data</td>
                                <td class="align-middle">
                                  <div class="progress" data-height="4" data-toggle="tooltip" title="100%">
                                    <div class="progress-bar bg-success" data-width="100"></div>
                                  </div>
                                </td>
                                <td>
                                  <img alt="image" src="assets/img/avatar/avatar-2.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Rizal Fakhri">
                                  <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Isnap Kiswandi">
                                  <img alt="image" src="assets/img/avatar/avatar-4.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Yudi Nawawi">
                                  <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Khaerul Anwar">
                                </td>
                                <td>2018-01-16</td>
                                <td><div class="badge badge-success">Completed</div></td>
                                <td><a href="#" class="btn btn-secondary">Detail</a></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> --}}
            </div>
        </section>
    </div>



@endsection
