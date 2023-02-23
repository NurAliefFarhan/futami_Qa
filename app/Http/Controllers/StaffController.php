<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Futami;
use App\Models\Futami_sampel_kimia;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;

class StaffController extends Controller
{
      //Controller Staff 
      public function staff()
      {
          return view('staff.staff');
      }
  
  
    public function datastaff(Request $request)
    {
    //   if(request()->tanggal_uji || request()->tanggal_selesai){
    //       $tanggal_uji = Carbon::parse(request()->tanggal_uji)->toDateTimeString();
    //       $tanggal_selesai = Carbon::parse(request()->tanggal_selesai)->toDateTimeString();
    //       $futamis = Futami::orderBy('id', 'desc')->whereBetween('tanggal_uji', [$tanggal_uji, $tanggal_selesai])->get();
    //   }
    //   else {
    //   //    $futamis = Futami::all();  
    //       $futamis = Futami::paginate(5)->onEachSide(5); 
    //   }
        $futamis = Futami::where('delete', 0);
        if ($request->has('tanggal_uji') && $request->has('tanggal_selesai')) {
            $tanggal_uji = Carbon::parse($request->tanggal_uji)->toDateTimeString();
            $tanggal_selesai = Carbon::parse($request->tanggal_selesai)->toDateTimeString();
            $futamis->whereBetween('tanggal_uji', [$tanggal_uji, $tanggal_selesai]);
        }

        $futamis = $futamis->orderBy('id', 'asc')->paginate(5)->onEachSide(5);
        return view('staff.data', compact('futamis'))->with('no', ($futamis->currentPage() - 1) * $futamis->perPage() + 1);
    }
  
      
      public function staffttd($id)
      {
          //$id pada paramater mengambil data dari path dinamis {id}
          //cari data yan memiliki value column yang id yang sama dengan data id yang dikirim ke route, maka update baris data tersebut 
          Futami::where('id', $id)->update([
              'statusST' => 1,
              'user_id_ST' => auth::user()->id, 
              'name_id_ST' => auth::user()->nama, 
              'created_at_ST' => Carbon::now()->format('Y M D'), 
              // 'done_time' => Carbon::now(),  //carbon=mengambil data terbaru sekarang 
          ]);
          //kalau berhasil akan diarahkan ke halaman list todo yang complated dengan pemberitahuan 
          return redirect()->route('datastaff')->with('staffttd', 'Data telah ditandatangani oleh Staff!'); 
      }
  
      public function declinettd($id)
      {
          //$id pada paramater mengambil data dari path dinamis {id}
          //cari data yan memiliki value column yang id yang sama dengan data id yang dikirim ke route, maka update baris data tersebut 
          Futami::where('id', $id)->update([
              'statusST' => 2,
              // 'done_time' => Carbon::now(),  //carbon=mengambil data terbaru sekarang 
          ]);
          //kalau berhasil akan diarahkan ke halaman list todo yang complated dengan pemberitahuan 
          return redirect()->route('datastaff')->with('declinettd', 'Data Staff ditolak!'); 
      }
  
      public function staff_analisakimia_history(Request $request)
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
        return view('staff.history', compact('futamis'))->with('no', ($futamis->currentPage() - 1) * $futamis->perPage() + 1);
    }
  
    public function staff_analisakimiapdf($id)
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
