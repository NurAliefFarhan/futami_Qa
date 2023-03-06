<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <title>Analisa Mikrobiologi Air</title>
    <style>
        @page {
            margin-left: 0.1in;
            margin-right: 0.1in;
            margin-top: 0.1in;
            margin-bottom: 0.1in;
        }

        body {
            margin-left: 0.1in;
            margin-right: 0.1in;
            margin-top: 0.1in;
            margin-bottom: 0.1in;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }


    </style>
</head>
<body>
    <table cellpadding="3" style="border:solid;">

        {{-- table kop surat --}}
        <table width="auto" style="border:solid; margin:10px;">
            <tr>
                <td rowspan="4" colspan="" align="center">
                    {{-- logo futami  --}}
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/img/futami bg.png'))) }}" style="width: 4cm; ">
                </td>
                <td colspan="" align="center">PT FUTAMI FOOD & BEVERAGES</td>
                <td colspan="" align="center">Document No.</td>
                <td colspan="" align="center">:</td>
                <td colspan="" align="center">FFB/FRM/QA/18/17</td>
            </tr>
            <tr>
                <td colspan="" rowspan="2" align="center">FORMULIR</td>
                <td colspan="" align="center">Issued Date</td>
                <td colspan="" align="center">:</td>
                <td colspan="" align="center">18/05/2022</td>
            </tr>
            <tr>
                <td colspan="" align="center">Revission No.</td>
                <td colspan="" align="center">:</td>
                <td colspan="" align="center">000</td>
            </tr>
            <tr>
                <td colspan="" align="center">LAPORAN ANALISA MIKROBIOLOGI AIR</td>
                <td colspan="" align="center">Page</td>
                <td colspan="" align="center">:</td>
                <td colspan="" align="center">1 of 1</td>
            </tr>
        </table>
    
        
        <pre style="font-family: Times New Roman; text-align: left;">
            No. Dokumen               : {{ $mikrobiologi_airs->nodokumen }}
            Tanggal Inokulasi         : {{ $mikrobiologi_airs->tgl_inokulasi }}
            Tanggal Pengamatan   : {{Carbon\Carbon::parse($mikrobiologi_airs->tgl_pengamatan)->translatedFormat('d F Y')}}
        </pre>
                
         
        <table class="table" border="0" width="95%" cellpadding="0" cellspacing="0" style="margin:10px auto;  border:solid;">
            <tr style="">
            <td rowspan="0" align="center">No</td>
            <td rowspan="0" align="center">Sampel Air</td>
            <td colspan="0" align="center">TPC (cfu/ml)</td>
            <td rowspan="0" align="center">Yeast & Mold (cfu/ml)</td>
            <td rowspan="0" align="center">Coliform (MPN/100ml)</td>
            <td rowspan="0" align="center">Keterangan</td>
            </tr>
            @foreach ($sampel_mikrobiologi_airs as $sampel_mikrobiologi_air)
                <tr align="center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $sampel_mikrobiologi_air->sampel_air }}</td>
                    <td>{{ $sampel_mikrobiologi_air->tpc }}</td>
                    <td>{{ $sampel_mikrobiologi_air->yeast_mold }}</td>
                    <td>{{ $sampel_mikrobiologi_air->coliform }}</td>
                    <td>{{ $sampel_mikrobiologi_air->keterangan }}</td>
                </tr>
            @endforeach
        </table> 

        <table border="0" width="auto" cellpadding="0" cellspacing="0" style="margin:10px; margin-left:auto; border:solid; margin-top:10%; align:center;">
            <tr align="center" style="">
                <td style="border-top-style:hidden; border-left-style:hidden;"></td>
                <td style="border-left:solid;">Dibuat oleh</td>
                <td>Diperiksa oleh</td>
                <td>Disetujui oleh</td>
            </tr>
            <tr align="center">
                <td style="border-top:solid;">Tanda tangan</td>
                <td>
                    @if($mikrobiologi_airs['statusOP'] == 0)
                        Belum ditandatangani
                    
                    @elseif($mikrobiologi_airs['statusOP'] == 1)
                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($mikrobiologi_airs->user_id_OP .'_'. $mikrobiologi_airs->name_id_OP)) !!}" alt="">                            
                    @endif
                </td>
                <td>
                    @if($mikrobiologi_airs['statusST'] == 0)
                        Belum ditandatangani
                    @elseif($mikrobiologi_airs['statusST'] == 1)
                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($mikrobiologi_airs->user_id_ST .'_'. $mikrobiologi_airs->name_id_ST)) !!}" alt="">
                    @elseif ($mikrobiologi_airs['statusST'] == 2)    
                        Ditolak
                    @endif
                </td>
                <td>
                    @if($mikrobiologi_airs['statusSP'] == 0)
                        Belum ditandatangani
                    @elseif($mikrobiologi_airs['statusSP'] == 1)
                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($mikrobiologi_airs->user_id_SP .'_'. $mikrobiologi_airs->name_id_SP)) !!}" alt="">                            
                    @endif
                </td>
            </tr>
            <tr align="center">
                <td colspan="" align="center">Jabatan</td>
                <td colspan="" align="center">QA Lab. Technician</td>
                <td colspan="" align="center">QA Staff</td>
                <td colspan="" align="center">QA Supervisor</td>
            </tr>
            <tr align="center">
                <td colspan="" align="center">Nama</td>
                <td colspan="" align="center">
                    @if($mikrobiologi_airs->name_id_OP == null)
                        Belum dibaca
                    @elseif($mikrobiologi_airs->name_id_OP)
                        {{ $mikrobiologi_airs->name_id_OP }}
                    @endif
                </td>
                <td colspan="" align="center">
                    @if ($mikrobiologi_airs->statusST == 2)    
                        Ditolak
                    @elseif($mikrobiologi_airs->name_id_ST == null)
                        Belum dibaca
                    @elseif($mikrobiologi_airs->name_id_ST)
                        {{ $mikrobiologi_airs->name_id_ST }}
                    @endif
                </td>
                <td colspan="" align="center">
                    @if($mikrobiologi_airs->name_id_SP == null)
                        Belum dibaca
                    @elseif($mikrobiologi_airs->name_id_SP)
                        {{ $mikrobiologi_airs->name_id_SP }}
                    @endif
                </td>
            </tr>
            <tr align="center">
                <td colspan="" align="center">Tanggal</td>
                <td colspan="" align="center">
                  @if ($mikrobiologi_airs->created_at_OP == null)
                      Data kosong
                  @else ()
                      {{Carbon\Carbon::parse($mikrobiologi_airs->created_at_OP)->translatedFormat('d F Y')}}
                  @endif
                </td>
                <td colspan="" align="center">
                  @if ($mikrobiologi_airs->statusST == 2)
                      Ditolak
                  @elseif ($mikrobiologi_airs->created_at_ST == null)
                      Data kosong
                  @elseif ($mikrobiologi_airs->statusST == 1)
                      {{Carbon\Carbon::parse($mikrobiologi_airs->created_at_ST)->translatedFormat('d F Y')}}
                  @endif
                </td>
                <td colspan="" align="center">
                  @if ($mikrobiologi_airs->created_at_SP == null)
                      Data kosong
                  @else ()
                      {{Carbon\Carbon::parse($mikrobiologi_airs->created_at_SP)->translatedFormat('d F Y')}}
                  @endif
                </td>
            </tr>
        </table>
    </table>

    
</body>
</html>