<?php

namespace App\Http\Controllers;

use App\Models\Futami;
use App\Models\Futami_sampel_kimia;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SupervisorController extends Controller
{
    //Controller Supervisor
    public function supervisor()
    {
        return view('supervisor.supervisor');
    }

    public function datasupervisor(Request $request)
    {
        // if(request()->tanggal_uji || request()->tanggal_selesai){
        //     $tanggal_uji = Carbon::parse(request()->tanggal_uji)->toDateTimeString();
        //     $tanggal_selesai = Carbon::parse(request()->tanggal_selesai)->toDateTimeString();

        //     $futamis = Futami::orderBy('id', 'desc')->whereBetween('tanggal_uji', [$tanggal_uji, $tanggal_selesai])->get();
        // }
        // else {
        //     // $futamis = Futami::all();  
        //     $futamis = Futami::paginate(5)->onEachSide(5);  
        // }
        $futamis = Futami::where('delete', 0);
        if ($request->has('tanggal_uji') && $request->has('tanggal_selesai')) {
            $tanggal_uji = Carbon::parse($request->tanggal_uji)->toDateTimeString();
            $tanggal_selesai = Carbon::parse($request->tanggal_selesai)->toDateTimeString();
            $futamis->whereBetween('tanggal_uji', [$tanggal_uji, $tanggal_selesai]);
        }

        $futamis = $futamis->orderBy('id', 'asc')->paginate(5)->onEachSide(5);
        return view('supervisor.data', compact('futamis'))->with('no', ($futamis->currentPage() - 1) * $futamis->perPage() + 1);
    }

    public function supervisorttd($id)
    {
        //$id pada paramater mengambil data dari path dinamis {id}
        //cari data yan memiliki value column yang id yang sama dengan data id yang dikirim ke route, maka update baris data tersebut 
        Futami::where('id', $id)->update([
            'statusSP' => 1,
            'user_id_SP' => auth::user()->id, 
            'name_id_SP' => auth::user()->nama,
            'created_at_SP' => Carbon::now()->format('Y M D'), 
 
            // 'done_time' => Carbon::now(),  //carbon=mengambil data terbaru sekarang 
        ]);
        //kalau berhasil akan diarahkan ke halaman list todo yang complated dengan pemberitahuan 
        return redirect()->route('datasupervisor')->with('supervisorttd', 'Data telah ditandatangani oleh Supervisor!'); 
    }


    public function supervisor_analisakimia_history(Request $request)
    {
        // $query = Futami::orderBy('id', 'desc');

        // if ($request->has('tanggal_uji') && $request->has('tanggal_selesai')) {
        //     $tanggal_uji = Carbon::parse($request->tanggal_uji)->toDateTimeString();
        //     $tanggal_selesai = Carbon::parse($request->tanggal_selesai)->toDateTimeString();

        //     $query->whereBetween('tanggal_uji', [$tanggal_uji, $tanggal_selesai]);
        // }

        // $futamis = $query->paginate(5)->onEachSide(5);
        // $futamis = Futami::where([
        //     ['delete', '=', 1], 
        // ])->paginate(5)->onEachSide(5);

        $futamis = Futami::where('delete', 1);
        if ($request->has('tanggal_uji') && $request->has('tanggal_selesai')) {
            $tanggal_uji = Carbon::parse($request->tanggal_uji)->toDateTimeString();
            $tanggal_selesai = Carbon::parse($request->tanggal_selesai)->toDateTimeString();
            $futamis->whereBetween('tanggal_uji', [$tanggal_uji, $tanggal_selesai]);
        }

        $futamis = $futamis->orderBy('id', 'desc')->paginate(5)->onEachSide(5);
        return view('supervisor.history', compact('futamis'))->with('no', ($futamis->currentPage() - 1) * $futamis->perPage() + 1);
    }

    public function supervisor_analisakimiapdf($id)
    {
        $futami_sampel_kimia = Futami_sampel_kimia::where('id_analisa_kimia', $id)->get(); 
        $futami = Futami::where('id', $id)->first();

        // $options = new Options();
        // $options->set('isRemoteEnabled',true);

        // $options = new Options();
        // $options->set('isRemoteEnabled', true);
        // $options->set('chroot', realpath(base_path()));
        // $options->set('enable_font_subsetting', false);
        // $options->set('pdf_backend', 'CPDF');
        // $options->set('default_media_type', 'screen');
        // $dompdf = new Dompdf($options);

        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]); 
        $pdf = PDF::loadView('pdf.analisa_kimia_pdf', array('futami' => $futami, 'futami_sampel_kimia'=>$futami_sampel_kimia))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream();
    }
}
