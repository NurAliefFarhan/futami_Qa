<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Futami_sampel_kimia;
use App\Models\Mikrobiologi_air;
use App\Models\Sampel_mikrobiologi_air;
use App\Models\Mikrobiologi_produk;
use App\Models\Sampel_mikrobiologi_produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class MikrobiologiProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function mikrobiologi_produk(Request $request)
    {
        // $mikrobiologi_produk = Mikrobiologi_produk::all(); 
        $mikrobiologi_produk = Mikrobiologi_produk::where('delete', 0); 

        if ($request->pencarian == "tgl_produksi") 
            if ($request->has('tgl_mulai') && $request->has('tgl_selesai')) {
                $tgl_mulai = Carbon::parse($request->tgl_mulai)->toDateTimeString();
                $tgl_selesai = Carbon::parse($request->tgl_selesai)->toDateTimeString();
                $mikrobiologi_produk->whereBetween('tgl_produk', [$tgl_mulai, $tgl_selesai]);
            }
        
        elseif ($request->pencarain == "tgl_inokulasi")
            if ($request->has('tgl_mulai') && $request->has('tgl_selesai')) {
                $tgl_mulai = Carbon::parse($request->tgl_mulai)->toDateTimeString();
                $tgl_selesai = Carbon::parse($request->tgl_selesai)->toDateTimeString();
                $mikrobiologi_produk->whereBetween('tgl_inokulasi', [$tgl_mulai, $tgl_selesai]);
            }
        
        elseif ($request->pencarain == "tgl_pengamatan") 
            if ($request->has('tgl_mulai') && $request->has('tgl_selesai')) {
                $tgl_mulai = Carbon::parse($request->tgl_mulai)->toDateTimeString();
                $tgl_selesai = Carbon::parse($request->tgl_selesai)->toDateTimeString();
                $mikrobiologi_produk->whereBetween('tgl_pengamatan', [$tgl_mulai, $tgl_selesai]);
            }

        $mikrobiologi_produk = $mikrobiologi_produk->orderBy('id', 'asc')->paginate(10)->onEachSide(5)->appends(request()->except('page')); //asc dari awal ke akhir     
        return view('mikrobiologi_produk.operator.mikrobiologi_produk', compact('mikrobiologi_produk'))->with('no', ($mikrobiologi_produk->currentPage() - 1) * $mikrobiologi_produk->perPage() + 1); 
        // return view('mikrobiologi_produk.operator.mikrobiologi_produk', compact('mikrobiologi_produk'))->with('no'); 
    }

    public function add_mikrobiologi_produk(Request $request)
    {
        return view('mikrobiologi_produk.operator.add_mikrobiologi_produk');
    }

    public function input_mikrobiologi_produk(Request $request)
    {
        // $request->validate([
        //     'nama_produk' => 'required|min:3',
        //     'jumlah' => 'required',
        //     'tgl_produk' => 'required',
        //     'tgl_inokulasi' => 'required',
        //     'tgl_pengamatan' => 'required',
        // ],[
        //     'nama_produk.required' => 'Kolom nama produk harus di isi',
        //     'jumlah.required' => 'Kolom jumlah batch harus di isi',
        //     'tgl_produk.required' => 'Kolom tanggal produk harus di isi',
        //     'tgl_inokulasi.required' => 'Kolom tanggal inokulasi harus di isi',
        //     'tgl_pengamatan.required' => 'Kolom tanggal pengamatan harus di isi',
        // ]);

        $get_now = Carbon::now()->translatedFormat('d-m-y h:i:s');
        $get_tahun = Carbon::now()->translatedFormat('y');
        $get_bulan = Carbon::now()->translatedFormat('m'); 
        $get_menit = Carbon::now()->translatedFormat('i'); 

        function numberToRoman($num)  
        { 
            // Be sure to convert the given parameter into an integer
            $n = intval($num);
            $result = ''; 
         
            // Declare a lookup array that we will use to traverse the number: 
            $lookup = array(
                'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 
                'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 
                'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
            ); 
         
            foreach ($lookup as $roman => $value)  
            {
                // Look for number of matches
                $matches = intval($n / $value); 
         
                // Concatenate characters
                $result .= str_repeat($roman, $matches); 
         
                // Substract that from the number 
                $n = $n % $value; 
            } 
        
            return $result; 
        } 
       
        $get_last_no_dokumen = Mikrobiologi_produk::latest()->first();

        if(is_null($get_last_no_dokumen) || $get_last_no_dokumen->created_at->format('y') !== $get_tahun) {
            $nodokumen_get_num = 0;
        } else {
            $nodokumen_get_num = (int)explode("/", $get_last_no_dokumen->nodokumen)[0] + 1;
        }
        $nodokumen = $nodokumen_get_num."/LAMP/".numberToRoman($get_bulan)."/".$get_tahun;
        

        // dd($nodokumen); 
    
        //get tahun "sudah"
        //get bulan -> setelah get bulan konversi bulan ke romawi ""sudah
        //get nomor dokumen terakhir dengan cara 
        //get nomor dokumen dari database dari record paling terakhir, 
        // $get_last_no_dokumen = Futami::latest()->first()->nodokumen;
        //setelah dapat nomor dokumen parsing hanya nomor saja
        //setelah dapat nomornya saja + 1 
        //setelah dapat semua formatnya gabung jadi 1 variable nodokumen
        
        $mikrobiologiProduk = Mikrobiologi_produk::create([
            'nodokumen' => $nodokumen,
            'nama_produk' => $request->nama_produk, 
            'jumlah' => $request->jumlah, 
            'tgl_produk' => $request->tgl_produk,
            'tgl_inokulasi' => $request->tgl_inokulasi,
            'tgl_pengamatan' => $request->tgl_pengamatan,


            'statusOP' => 0,
            'statusST' => 0,
            'statusSP' => 0, 
            'delete' => 0,
        ]);

        // dd($mikrobiologiProduk);
        return redirect('/operator/sampel_mikrobiologi_produk/' .$mikrobiologiProduk->id)->with('successAdd', 'Berhasil membuat Dokumen Baru!'); //mereturn / lewat / , bukan lewat name yang diberikan 
    }

    public function sampel_mikrobiologi_produk(Request $request, $id)
    {
        $mikrobiologi = Mikrobiologi_produk::Where('id', $id)->first();
        // $futami_sampel_kimia = Futami_sampel_kimia::where('id_analisa_kimia', '=', $id)->get(); 
 
        return view('mikrobiologi_produk.operator.sampel_mikrobiologi_produk', compact('id', 'mikrobiologi'));
    }


    public function input_sampel_mikrobiologi_produk(Request $request, $id)
    {
        $request->validate([
            'inputSampel' => 'required|array|min:1',

            'inputSampel.*.kode_sampling' => 'required',
            'inputSampel.*.exp_date' => 'required',
            'inputSampel.*.tpc' => 'required',
            'inputSampel.*.yeast_mold' => 'required',
            'inputSampel.*.coliform' => 'required',
            // 'inputSampel.*.keterangan' => 'required|min:5',
        ],[
            'inputSampel.required' => 'Kolom sampel_air harus di isi',
            'inputSampel.array' => 'Kolom sampel_air harus berupa array',
            'inputSampel.min' => 'Minimal satu sampel_air harus diisi',

            'inputSampel.*.kode_sampling.required' => 'Kolom sampel_air harus di isi',
            'inputSampel.*.exp_date.required' => 'Kolom Exp Date harus di isi',
            'inputSampel.*.tpc.required' => 'Kolom TPC harus di isi',
            'inputSampel.*.yeast_mold.required' => 'Kolom Yeast & Mold harus di isi',
            'inputSampel.*.coliform.required' => 'Kolom Coliform harus di isi',
            // 'inputSampel.*.keterangan.required' => 'Kolom keterangan harus di isi',
            // 'inputSampel.*.keterangan.min' => 'Kolom keterangan harus memiliki panjang minimal 5 karakter',
        ]);
    
        foreach($request->inputSampel as $key => $value){ 
            DB::table('sampel_mikrobiologi_produks')->insert([ 
                'kode_sampling' => $value['kode_sampling'],
                'exp_date' => $value['exp_date'],
                'tpc' => $value['tpc'],
                'yeast_mold' => $value['yeast_mold'],
                'coliform' => $value['coliform'],
                'keterangan' => $value['keterangan'],
                'id_produk' => $id, 
            ]);
        }

        return redirect('/operator/mikrobiologi_produk')->with('successAddSampel', 'Berhasil membuat Data Sampel Mikrobiologi Produk Baru!');
    }

    public function mikrobiologi_produk_operatorttd($id)
    {
        //$id pada paramater mengambil data dari path dinamis {id}
        //cari data yan memiliki value column yang id yang sama dengan data id yang dikirim ke route, maka update baris data tersebut 
        // $mikrobiologis = Mikrobiologi_produk::all(); 
        Mikrobiologi_produk::where('id', $id)->update([
            'statusOP' => 1,
            'user_id_OP' => auth::user()->id, 
            'name_id_OP' => auth::user()->nama, 
            'created_at_OP' => Carbon::now()->format('Y M D'),  
        ]);
       
        return redirect()->route('mikrobiologi_produk')->with('operatorttd', 'Data telah ditandatangani oleh Operator!'); 
   } 

    public function mikrobiologi_produk_Destroy($id)
    {
        // Futami::where('id', '=', $id)->delete(); 
        // Futami_sampel_kimia::where('id_analisa_kimia', '=', $id)->delete(); 
        
        Mikrobiologi_produk::where('id',$id)->update([
            'delete' => 1,
        ]);

        return redirect()->route('mikrobiologi_produk')->with('successDelete', 'Berhasil menghapus data!'); 
    }


    public function mikrobiologi_produk_history(Request $request)
    {
        $mikrobiologi_produks = Mikrobiologi_produk::where('delete', 1);

        if ($request->has('tgl_inokulasi') && $request->has('tgl_pengamatan')) {
            $tgl_inokulasi = Carbon::parse($request->tgl_inokulasi)->toDateTimeString();
            $tgl_pengamatan = Carbon::parse($request->tgl_pengamatan)->toDateTimeString();
            $mikrobiologi_produks->whereBetween('tgl_inokulasi', [$tgl_inokulasi, $tgl_pengamatan]);
        }

        $mikrobiologi_produks = $mikrobiologi_produks->orderBy('id', 'asc')->get(); //asc dari awal ke akhir 
        // $mikrobiologi_produks = $mikrobiologi_produks->orderBy('id', 'asc')->paginate(5)->onEachSide(5)->appends(request()->except('page')); //asc dari awal ke akhir 
        // return view('operator.data', compact('mikrobiologi_produks'))->with('no', ($mikrobiologi_produks->currentPage() - 1) * $mikrobiologi_produks->perPage() + 1); 

        
        return view('mikrobiologi_produk.operator.history', compact('mikrobiologi_produks'))->with('no');
    }

    public function mikrobiologi_produk_sampel(Request $request, $id)
    {
        $mikrobiologi_produks = Mikrobiologi_produk::Where('id', $id)->first();
        $sampel_mikrobiologi_produks = Sampel_mikrobiologi_produk::where('id_produk', '=', $id)->get(); 

        return view('mikrobiologi_produk.operator.dataSampel_mikrobiologi_produk', compact('mikrobiologi_produks', 'sampel_mikrobiologi_produks'))->with('no'); 
    }

    public function sampel_mikrobiologi_produk_Destroy(Request $request, $id)
    {
        // Sampel_mikrobiologi_air::where('id', '=', $id)->delete(); 
        // Mikrobiologi_produk::where('id', '=', $id)->delete(); 
        Sampel_mikrobiologi_produk::where('id_produk', '=', $id)->delete(); 
        return redirect()->back()->with('successDelete', 'Berhasil menghapus data sampel mikrobiologi produk!'); 
    } 

    public function edit_mikrobiologi_produk($id)
    {
        $mikrobiologi_produk = Mikrobiologi_produk::Where('id', $id)->first();
        $sampel_mikrobiologi_produk = Sampel_mikrobiologi_produk::where('id_produk', '=', $id)->get(); 
 
        return view('mikrobiologi_produk.operator.edit_mikrobiologi_produk', compact('mikrobiologi_produk', 'sampel_mikrobiologi_produk'));
    }

    public function update_mikrobiologi_produk(Request $request, $id)
    {
        //validasi
        $request->validate([
            'nama_produk' => 'required',
            'jumlah' => 'required',
            'tgl_produk' => 'required',
            'tgl_inokulasi' => 'required',
            'tgl_pengamatan' => 'required',
        ],[
            'nama_produk.required' => 'Kolom nama produk harus di isi',
            'jumlah.required' => 'Kolom jumlah batch harus di isi',
            'tgl_produk.required' => 'Kolom tanggal produk harus di isi',
            'tgl_inokulasi.required' => 'Kolom tanggal inokulasi harus di isi',
            'tgl_pengamatan.required' => 'Kolom tanggal pengamatan harus di isi',
        ]);
        $validasiData = Mikrobiologi_produk::where('id', $id)->update([
            'nama_produk' => $request->nama_produk, 
            'jumlah' => $request->jumlah, 
            'tgl_produk' => $request->tgl_produk,
            'tgl_inokulasi' => $request->tgl_inokulasi,
            'tgl_pengamatan' => $request->tgl_pengamatan,
        ]); 


        //Validasi edit sampel kimia 
        $validasiSampel = $request->validate([
            'inputSampel.*.kode_sampling' => 'required',
            'inputSampel.*.exp_date' => 'required',
            'inputSampel.*.tpc' => 'required',
            'inputSampel.*.yeast_mold' => 'required',
            'inputSampel.*.coliform' => 'required',
        ],[
            'inputSampel.*.kode_sampling.required' => 'Kolom kode_sampling harus di isi',
            'inputSampel.*.exp_date.required' => 'Kolom Jam pada Exp Date harus di isi',
            'inputSampel.*.tpc.required' => 'Kolom TPC harus di isi',
            'inputSampel.*.yeast_mold.required' => 'Kolom Yeast & Mold harus di isi',
            'inputSampel.*.coliform.required' => 'Kolom Coliform harus di isi',
            // 'inputSampel.*.keterangan.required' => 'Kolom keterangan harus di isi',
            // 'inputSampel.*.keterangan.min' => 'Kolom keterangan harus memiliki panjang minimal 5 karakter',
        ]);

        $sampel_data = [];
        foreach ($request->inputSampel as $input) {
            $sampel = new Sampel_mikrobiologi_produk();
            $sampel->kode_sampling = $input['kode_sampling'];
            $sampel->exp_date = $input['exp_date'];
            $sampel->tpc = $input['tpc'];
            $sampel->yeast_mold = $input['yeast_mold'];
            $sampel->coliform = $input['coliform'];
            $sampel->keterangan = $input['keterangan'];
            $sampel_data[] = $sampel;
        }
        Mikrobiologi_produk::find($id)->Sampel_mikrobiologi_produk()->delete();
        Mikrobiologi_produk::find($id)->Sampel_mikrobiologi_produk()->saveMany($sampel_data);

    
        return redirect('/operator/mikrobiologi_produk')->with('successUpdate','Berhasil mengupdate data Dokumen!');
    }

    public function OP_mikrobiologi_produk_pdf($id)
    {
        $sampel_mikrobiologi_produks = Sampel_mikrobiologi_produk::where('id_produk', $id)->get(); 
        $mikrobiologi_produks = Mikrobiologi_produk::where('id', $id)->first();

        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]); 
        $pdf = PDF::loadView('pdf.mikrobiologi_produk_pdf', array('mikrobiologi_produks' => $mikrobiologi_produks, 'sampel_mikrobiologi_produks'=>$sampel_mikrobiologi_produks))->setOptions(['defaultFont' => 'sans-serif']);
        // $pdf = PDF::loadView('pdf.mikrobiologi_air_pdf', array('mikrobiologi_airs' => $mikrobiologi_airs, 'sampel_mikrobiologi_airs'=>$sampel_mikrobiologi_airs))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream();
    }
















    



    ///////Function Staff 
    public function staff_mikrobiologi_produk(Request $request)
    {
        // $mikrobiologi_airs = Mikrobiologi_air::all();
        $mikrobiologi_produks = Mikrobiologi_produk::where('delete', 0);

        if ($request->has('tgl_inokulasi') && $request->has('tgl_pengamatan')) {
            $tgl_inokulasi = Carbon::parse($request->tgl_inokulasi)->toDateTimeString();
            $tgl_pengamatan = Carbon::parse($request->tgl_pengamatan)->toDateTimeString();
            $mikrobiologi_produks->whereBetween('tgl_inokulasi', [$tgl_inokulasi, $tgl_pengamatan]);
        }

        // $mikrobiologi_produks = $mikrobiologi_produks->orderBy('id', 'asc')->get(); //asc dari awal ke akhir 
        // return view('mikrobiologi_air.staff.mikrobiologi_air', compact('mikrobiologi_produks'))->with('no');
        
        $mikrobiologi_produks = $mikrobiologi_produks->orderBy('id', 'asc')->paginate(10)->onEachSide(5)->appends(request()->except('page')); //asc dari awal ke akhir 
        return view('mikrobiologi_produk.staff.mikrobiologi_produk', compact('mikrobiologi_produks'))->with('no', ($mikrobiologi_produks->currentPage() - 1) * $mikrobiologi_produks->perPage() + 1);         
    }

    public function mikrobiologi_produk_staffttd($id) 
    {
        //$id pada paramater mengambil data dari path dinamis {id}
        //cari data yan memiliki value column yang id yang sama dengan data id yang dikirim ke route, maka update baris data tersebut 
        Mikrobiologi_produk::where('id', $id)->update([
            'statusST' => 1,
            'user_id_ST' => auth::user()->id, 
            'name_id_ST' => auth::user()->nama, 
            'created_at_ST' => Carbon::now()->format('Y M D'), 
            // 'done_time' => Carbon::now(),  //carbon=mengambil data terbaru sekarang 
        ]);
        //kalau berhasil akan diarahkan ke halaman list todo yang complated dengan pemberitahuan 
        return redirect()->route('staff_mikrobiologi_produk')->with('staffttd', 'Data Mikrobiologi Produk telah ditandatangani oleh Staff!'); 
    }

    public function mikrobiologi_produk_declinettd($id)
    {
        //$id pada paramater mengambil data dari path dinamis {id}
        //cari data yan memiliki value column yang id yang sama dengan data id yang dikirim ke route, maka update baris data tersebut 
        Mikrobiologi_produk::where('id', $id)->update([
            'statusST' => 2,
            // 'done_time' => Carbon::now(),  //carbon=mengambil data terbaru sekarang 
        ]);
        //kalau berhasil akan diarahkan ke halaman list todo yang complated dengan pemberitahuan 
        return redirect()->route('staff_mikrobiologi_produk')->with('declinettd', 'Data Mikrobiologi Produk telah ditolak oleh Staff!'); 
    }

    
    public function ST_mikrobiologi_produk_pdf($id)
    {
        $sampel_mikrobiologi_produks = Sampel_mikrobiologi_produk::where('id_produk', $id)->get(); 
        $mikrobiologi_produks = Mikrobiologi_produk::where('id', $id)->first();

        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]); 
        $pdf = PDF::loadView('pdf.mikrobiologi_produk_pdf', array('mikrobiologi_produks' => $mikrobiologi_produks, 'sampel_mikrobiologi_produks'=>$sampel_mikrobiologi_produks))->setOptions(['defaultFont' => 'sans-serif']);
        // $pdf = PDF::loadView('pdf.mikrobiologi_air_pdf', array('mikrobiologi_airs' => $mikrobiologi_airs, 'sampel_mikrobiologi_airs'=>$sampel_mikrobiologi_airs))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream();
    }


















    
    ////Function Supervisor
    public function supervisor_mikrobiologi_produk(Request $request)
    {
        // $mikrobiologi_airs = Mikrobiologi_produk::all();
        $mikrobiologi_produks = Mikrobiologi_produk::where('delete', 0);

        if ($request->has('tgl_inokulasi') && $request->has('tgl_pengamatan')) {
            $tgl_inokulasi = Carbon::parse($request->tgl_inokulasi)->toDateTimeString();
            $tgl_pengamatan = Carbon::parse($request->tgl_pengamatan)->toDateTimeString();
            $mikrobiologi_produks->whereBetween('tgl_inokulasi', [$tgl_inokulasi, $tgl_pengamatan]);
        }

        // $mikrobiologi_produks = $mikrobiologi_produks->orderBy('id', 'asc')->get(); //asc dari awal ke akhir 
        // return view('mikrobiologi_air.supervisor.mikrobiologi_air', compact('mikrobiologi_produks'))->with('no');

        $mikrobiologi_produks = $mikrobiologi_produks->orderBy('id', 'asc')->paginate(10)->onEachSide(5)->appends(request()->except('page')); //asc dari awal ke akhir 
        return view('mikrobiologi_produk.supervisor.mikrobiologi_produk', compact('mikrobiologi_produks'))->with('no', ($mikrobiologi_produks->currentPage() - 1) * $mikrobiologi_produks->perPage() + 1);         
    }
    public function mikrobiologi_produk_supervisorttd($id)
    {
        //$id pada paramater mengambil data dari path dinamis {id}
        //cari data yan memiliki value column yang id yang sama dengan data id yang dikirim ke route, maka update baris data tersebut 
        Mikrobiologi_produk::where('id', $id)->update([
            'statusSP' => 1,
            'user_id_SP' => auth::user()->id, 
            'name_id_SP' => auth::user()->nama, 
            'created_at_SP' => Carbon::now()->format('Y M D'), 
            // 'done_time' => Carbon::now(),  //carbon=mengambil data terbaru sekarang 
        ]);
        //kalau berhasil akan diarahkan ke halaman list todo yang complated dengan pemberitahuan 
        return redirect()->route('supervisor_mikrobiologi_produk')->with('supervisorttd', 'Data Mikrobiologi Produk telah ditandatangani oleh Supervisor!'); 
    }

    public function SP_mikrobiologi_produk_pdf($id)
    {
        $sampel_mikrobiologi_produks = Sampel_mikrobiologi_produk::where('id_produk', $id)->get(); 
        $mikrobiologi_produks = Mikrobiologi_produk::where('id', $id)->first();

        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]); 
        $pdf = PDF::loadView('pdf.mikrobiologi_produk_pdf', array('mikrobiologi_produks' => $mikrobiologi_produks, 'sampel_mikrobiologi_produks'=>$sampel_mikrobiologi_produks))->setOptions(['defaultFont' => 'sans-serif']);
        // $pdf = PDF::loadView('pdf.mikrobiologi_air_pdf', array('mikrobiologi_airs' => $mikrobiologi_airs, 'sampel_mikrobiologi_airs'=>$sampel_mikrobiologi_airs))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream();
    }












    ////Function Superadmin
    public function superadmin_mikrobiologi_produk(Request $request)
    {
        $mikrobiologi_produks = Mikrobiologi_produk::where('delete', 0)->get();
        // if ($request->has('tanggal_uji') && $request->has('tanggal_selesai')) {
        //     $tanggal_uji = Carbon::parse($request->tanggal_uji)->toDateTimeString();
        //     $tanggal_selesai = Carbon::parse($request->tanggal_selesai)->toDateTimeString();
        //     $mikrobiologi_airs->whereBetween('tanggal_uji', [$tanggal_uji, $tanggal_selesai]);
        // }

        // $mikrobiologi_airs = $mikrobiologi_airs->orderBy('id', 'asc')->paginate(5)->onEachSide(5)->appends(request()->except('page')); //asc dari awal ke akhir 
        // return view('operator.data', compact('mikrobiologi_airs'))->with('no', ($mikrobiologi_airs->currentPage() - 1) * $mikrobiologi_airs->perPage() + 1); 
        
        return view('mikrobiologi_produk.superadmin.mikrobiologi_produk_info', compact('mikrobiologi_produks'))->with('no');
    }

    public function superadmin_mikrobiologi_produk_sampel(Request $request)
    {
        // $mikrobiologi_airs = Mikrobiologi_air::all();
        $sampel_mikrobiologi_produks = Sampel_mikrobiologi_produk::all(); 
        // if ($request->has('tanggal_uji') && $request->has('tanggal_selesai')) {
        //     $tanggal_uji = Carbon::parse($request->tanggal_uji)->toDateTimeString();
        //     $tanggal_selesai = Carbon::parse($request->tanggal_selesai)->toDateTimeString();
        //     $mikrobiologi_airs->whereBetween('tanggal_uji', [$tanggal_uji, $tanggal_selesai]);
        // }

        // $mikrobiologi_airs = $mikrobiologi_airs->orderBy('id', 'asc')->paginate(5)->onEachSide(5)->appends(request()->except('page')); //asc dari awal ke akhir 
        // return view('operator.data', compact('mikrobiologi_airs'))->with('no', ($mikrobiologi_airs->currentPage() - 1) * $mikrobiologi_airs->perPage() + 1); 

        
        return view('mikrobiologi_produk.superadmin.mikrobiologi_produk_sampel', compact('sampel_mikrobiologi_produks'))->with('no');
    }


    public function superadmin_mikrobiologi_produk_history(Request $request)
    {
        // $mikrobiologi_airs = Mikrobiologi_air::all();
        $mikrobiologi_produks = Mikrobiologi_produk::where('delete', 1)->get(); 
        $sampel_mikrobiologi_produks = Sampel_mikrobiologi_produk::all(); 
        return view('mikrobiologi_produk.superadmin.history', compact('mikrobiologi_produks'))->with('no');
    }
 
 


    public function SA_mikrobiologi_produk_pdf($id)
    {
        $sampel_mikrobiologi_produks = Sampel_mikrobiologi_produk::where('id_produk', $id)->get(); 
        $mikrobiologi_produks = Mikrobiologi_produk::where('id', $id)->first();

        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]); 
        $pdf = PDF::loadView('pdf.mikrobiologi_produk_pdf', array('mikrobiologi_produks' => $mikrobiologi_produks, 'sampel_mikrobiologi_produks'=>$sampel_mikrobiologi_produks))->setOptions(['defaultFont' => 'sans-serif']);
        // $pdf = PDF::loadView('pdf.mikrobiologi_air_pdf', array('mikrobiologi_airs' => $mikrobiologi_airs, 'sampel_mikrobiologi_airs'=>$sampel_mikrobiologi_airs))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream();
    }













     public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mikrobiologi_produk  $mikrobiologi_produk
     * @return \Illuminate\Http\Response
     */
    public function show(Mikrobiologi_produk $mikrobiologi_produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mikrobiologi_produk  $mikrobiologi_produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Mikrobiologi_produk $mikrobiologi_produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mikrobiologi_produk  $mikrobiologi_produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mikrobiologi_produk $mikrobiologi_produk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mikrobiologi_produk  $mikrobiologi_produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mikrobiologi_produk $mikrobiologi_produk)
    {
        //
    }
}
