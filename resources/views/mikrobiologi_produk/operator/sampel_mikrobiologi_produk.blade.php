@extends('layout-operator')
@section('content')
@include('sweetalert::alert')


    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data Sampel Mikrobiologi Produk</h1>
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

            @if(Session::get('successAdd'))
                <div class="alert alert-success w-70">
                    {{Session::get('successAdd')}} 
                </div>
            @endif

            @if(Session::get('successAddSampel'))
                <div class="alert alert-success w-70">
                    {{Session::get('successAddSampel')}} 
                </div>
            @endif



            <div class="section-body">
                <h2 class="section-title">Tambah Data Sampel Mikrobiologi Produk</h2> 
                <div class="row shadow">
                    <div class="col-12">
                        <div class="card">
                            <div class="card">
                                <form action="{{route('sampel_mikrobiologi.post', $id)}}" method="POST">
                                  @csrf 
                                        
                                        <div class="form-row" style="margin-top:1%;">
                                            <div class="form-group col-md-3" align="center">
                                                <label for="inputEmail4">Sampel Air</label>
                                            </div> 
                                            <div class="form-group col-md-2" align="center"> 
                                                <label for="inputEmail4">TPC (cfu/ml)</label>
                                            </div>
                                            <div class="form-group col-md-2" align="center"> 
                                                <label for="inputEmail4">Yeast & Mold (cfu/ml)</label>
                                            </div>
                                            <div class="form-group col-md-2" align="center"> 
                                                <label for="inputEmail4">Coliform (MPN/100ml)</label>
                                            </div>
                                            <div class="form-group col-md-2" align="center">
                                                <label for="inputEmail4">Keterangan</label>
                                            </div>
                                        </div>
                                    <div class="card-body" id="sampel">
                                        <div class="form-row" style="margin-top:-3%;">
                                            <div class="form-group col-md-3">
                                                <input type="text" name="inputSampel[0][sampel_air]" class="form-control" id="inputEmail4" placeholder="Masukkan nama sampel air">
                                            </div> 
                                            <div class="form-group col-md-2">
                                                <input type="text" name="inputSampel[0][tpc]" class="form-control" id="inputEmail4" placeholder="Masukkan TPC">
                                            </div> 
                                            <div class="form-group col-md-2">
                                                <input type="text" name="inputSampel[0][yeast_mold]" class="form-control" id="inputEmail4" placeholder="Masukkan Yeast & Mold">
                                            </div> 
                                            <div class="form-group col-md-2"> 
                                                <input type="text" name="inputSampel[0][coliform]" class="form-control" id="inputEmail4" placeholder="Masukkan Coliform">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <input type="text" name="inputSampel[0][keterangan]" rows="1" class="form-control" id="inputEmail4" placeholder="Masukkan keterangan">
                                            </div>
                                            <div class="form-group col-md-1">
                                                <button type="button" name="addSampel" id="addSampel" class="btn btn-primary"><i class="fa-solid fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        {{-- <a href="/operator/analisakimia" class="btn btn-primary" style="width:30%; text-align:center; margin-left:1%; margin-top:-5%;">Back</a> --}}
                                        {{-- <a href="/operator/data" class="btn btn-primary" style="width:30%; text-align:center; margin-left:70%; margin-top:-9%;">Simpan data sampel</a> --}}
                                        <button type="submit" class="btn btn-primary" style="width:30%; text-align:center; margin-left:70%; margin-top:-9%;">Simpan sampel</button>
                                        {{-- <a href="/operator/data" class="btn btn-success" style="width:30%; text-align:center; margin-left:1%; margin-top:-12%;">Selesai Simpan Data</a> --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

{{-- Script multiple input data sampel  --}}
<script>
    var i = 0;
    var maxInput = 30; 
    $('#addSampel').click(function(){
        if(i < maxInput){
            ++i;
            $('#sampel').append(`  

            <div class="card-body removeSampel" id="removeSampel" style="margin-top: -5%; margin-left:-25px;">

                <div class="form-row" style="margin-top:1%;">
                    <div class="form-group col-md-3">
                        <input type="text" name="inputSampel[${i}][sampel_air]" class="form-control" id="inputEmail4" placeholder="Masukkan nama sampel air">
                    </div>
                    <div class="form-group col-md-2">
                        <input type="text" name="inputSampel[${i}][tpc]" class="form-control" id="inputEmail4" placeholder="Masukkan TPC">
                    </div>
                    <div class="form-group col-md-2">
                        <input type="text" name="inputSampel[${i}][yeast_mold]" class="form-control" id="inputEmail4" placeholder="Masukkan Yeast & Mold">
                    </div>
                    <div class="form-group col-md-2"> 
                        <input type="text" name="inputSampel[${i}][coliform]" class="form-control" id="inputEmail4" placeholder="Masukkan Coliform">
                    </div>
                    <div class="form-group col-md-2">
                        <input type="text" name="inputSampel[${i}][keterangan]" rows="1" class="form-control" id="inputEmail4" placeholder="Masukkan keterangan">
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
