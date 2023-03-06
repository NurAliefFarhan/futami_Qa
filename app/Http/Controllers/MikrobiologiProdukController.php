<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Futami_sampel_kimia;
use App\Models\Mikrobiologi_air;
use App\Models\Sampel_mikrobiologi_air;
use App\Models\Mikrobiologi_produk;
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
        $mikrobiologi_produk = Mikrobiologi_produk::all(); 
        // $mikrobiologi_produk = Mikrobiologi_air::where('delete', 0);

        // if ($request->has('tgl_inokulasi') && $request->has('tgl_pengamatan')) {
        //     $tgl_inokulasi = Carbon::parse($request->tgl_inokulasi)->toDateTimeString();
        //     $tgl_pengamatan = Carbon::parse($request->tgl_pengamatan)->toDateTimeString();
        //     $mikrobiologi_produk->whereBetween('tgl_inokulasi', [$tgl_inokulasi, $tgl_pengamatan]);
        // }

        // $mikrobiologi_produk = $mikrobiologi_produk->orderBy('id', 'asc')->paginate(10)->onEachSide(5)->appends(request()->except('page')); //asc dari awal ke akhir 
        // return view('mikrobiologi_produk.operator.mikrobiologi_produk', compact('mikrobiologi_produk'))->with('no', ($mikrobiologi_produk->currentPage() - 1) * $mikrobiologi_produk->perPage() + 1); 
        return view('mikrobiologi_produk.operator.mikrobiologi_produk', compact('mikrobiologi_produk'))->with('no'); 
    }

    public function add_mikrobiologi_produk(Request $request)
    {
        return view('mikrobiologi_produk.operator.add_mikrobiologi_produk');
    }

    public function input_mikrobiologi_produk(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|min:3',
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
       
        $get_last_no_dokumen = Mikrobiologi_air::latest()->first();

        if(is_null($get_last_no_dokumen) || $get_last_no_dokumen->created_at->format('y') !== $get_tahun) {
            $get_last_no_dokumen = 0;
        } else {
            $get_last_no_dokumen = $get_last_no_dokumen->nodokumen;
        }
        
        $nodokumen_get_num = explode("/", $get_last_no_dokumen)[0]+1; //membagi angka dengan axplode    
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

            'inputSampel.*.sampel_air' => 'required',
            'inputSampel.*.tpc' => 'required',
            'inputSampel.*.yeast_mold' => 'required',
            'inputSampel.*.coliform' => 'required',
            'inputSampel.*.keterangan' => 'required|min:5',
        ],[
            'inputSampel.required' => 'Kolom sampel_air harus di isi',
            'inputSampel.array' => 'Kolom sampel_air harus berupa array',
            'inputSampel.min' => 'Minimal satu sampel_air harus diisi',

            'inputSampel.*.sampel_air.required' => 'Kolom sampel_air harus di isi',
            'inputSampel.*.tpc.required' => 'Kolom TPC harus di isi',
            'inputSampel.*.yeast_mold.required' => 'Kolom Yeast & Mold harus di isi',
            'inputSampel.*.coliform.required' => 'Kolom Coliform harus di isi',
            'inputSampel.*.keterangan.required' => 'Kolom keterangan harus di isi',
            'inputSampel.*.keterangan.min' => 'Kolom keterangan harus memiliki panjang minimal 5 karakter',
        ]);
    
        foreach($request->inputSampel as $key => $value){ 
            DB::table('sampel_mikrobiologi_airs')->insert([ 
                'sampel_air' => $value['sampel_air'],
                'tpc' => $value['tpc'],
                'yeast_mold' => $value['yeast_mold'],
                'coliform' => $value['coliform'],
                'keterangan' => $value['keterangan'],
                'id_mikrobiologi' => $id, 
            ]);
        }

        return redirect('/operator/mikrobiologi')->with('successAddSampel', 'Berhasil membuat Data Sampel Mikrobiologi Baru!');
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
