<?php

namespace App\Http\Controllers;

use App\Models\Futami;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Futami_sampel_kimia;
use App\Models\Mikrobiologi_air;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class SuperadminController extends Controller
{
    //Controller Admin 
    public function admin()
    {
        $futamis = Futami::all();   
        $mikrobiologi_airs = Mikrobiologi_air::all();   
        return view('admin.admin', compact('futamis', 'mikrobiologi_airs'));
    }

    public function role()
    {
        return view('admin.role'); 
    }
   
    public function adduser()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin.adduser', compact('users', 'roles'));
    }

    public function inputUser(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:9|max:25',
            'nohp' => 'required|min:8|max:13|unique:users,nohp',
            'email' => 'required',
            'password' => 'required|min:6|max:13',
            'jabatan' => 'required',
            'alamat' => 'required',
        ],[
            'nama.required' => 'Kolom nama harus di isi',
            'nohp.unique' => 'no handphone ini telah ada!',
            'nohp.required' => 'no handphone ini harus di isi!',
            'email.unique' => 'enail ini telah ada!',
            'email.required' => 'enail ini harus di isi!',
            'password.required' => 'Kolom password harus di isi',
            'jabatan.required' => 'Kolom jabatan harus di isi',
            'alamat.required' => 'Kolom alamat harus di isi',
        ]);
        // tambah data ke db bagian table users
        User::create([ 
            'nama' => $request->nama,
            'nohp' => $request->nohp,
            'email' => $request->email,
            'password' => Hash::make($request->password), //request password itu adalah password  
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat, 
            'status' => 0, 
            'role_id' => $request->jabatan, 
        ]);
        return redirect('/admin/adduser')->with('createUser', 'Anda berhasil membuat akun User!'); //mereturn / lewat / , bukan lewat name yang diberikan 

        //return redirect('/cetakpdf')->with('success', 'Anda berhasil membuat akun!'); 
        // $ppdbs = User::latest()->first(); 
        // return view('dashboardStudent.cetakpdf', compact('ppdbs'));
    }

    public function userDestroy($id)
    {
        User::where('id', '=', $id)->delete(); 
        return redirect()->route('adduser')->with('successDelete', 'Berhasil menghapus data user!'); 
    }

    public function userEdit($id)
    {
        //menampilkan form edit data
        //ambil data dari db yang idnya sama dengan id yang dikirim dari routenya
        $users = User::Where('id', $id)->first();
        $roles = Role::all();
        // lalu tampilkan halaman dari view edit dengan mengirim data yang ada di variable todo
        return view('admin.editUser', compact('users', 'roles'));
    }
   
    public function userUpdate(Request $request, $id)
    {
        //validasi
        $request->validate([
            'nama' => 'required|min:3|max:25',
            'nohp' => 'required|min:10|max:13',
            'email' => 'required',
            // 'password' => 'required|min:6|max:13',
            'jabatan' => 'required',
            'alamat' => 'required',
        ]);
        User::where('id', $id)->update([
            'nama' => $request->nama,
            'nohp' => $request->nohp,
            'email' => $request->email,
            // 'password' => Hash::make($request->password), //request password itu adalah password  
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat, 
            'status' => 0, 
        ]);
        //redirect apabila berhasil bersama dengan alert-nya
        return redirect()->route('adduser')->with('successUpdate','Berhasil mengupdate data user!');
    }


    public function userReset(Request $request, $id)
    {
        User::where('id', $id)->update([
            'password' => Hash::make(1234567890), //request password itu adalah password  
        ]);
        //redirect apabila berhasil bersama dengan alert-nya
        return redirect()->route('adduser')->with('successReset','Berhasil Melakukan Reset data user!');
    }


    public function info(Request $request)
    {
        $futamis = Futami::where('delete', 0)->get();
        // if ($request->has('tanggal_uji') && $request->has('tanggal_selesai')) {
        //     $tanggal_uji = Carbon::parse($request->tanggal_uji)->toDateTimeString();
        //     $tanggal_selesai = Carbon::parse($request->tanggal_selesai)->toDateTimeString();
        //     $futamis->whereBetween('tanggal_uji', [$tanggal_uji, $tanggal_selesai]);
        // }

        // $futamis = $futamis->orderBy('id', 'desc')->paginate(5)->onEachSide(5); //desc adalah untuk mengurutkan data dari terahkir ke data paling awal 
        // $futamis = $futamis->orderBy('id', 'asc')->paginate(5)->onEachSide(5); //asc untuk mengurutkan data paling awal hingga ke data paling akhir 
        // return view('operator.history', compact('futamis'))->with('no', ($futamis->currentPage() - 1) * $futamis->perPage() + 1);
    
        // $futamis = Futami::all();   
        // $futami_sampel_kimia = Futami_sampel_kimia::all();
        return view('admin.info', compact('futamis'))->with('no');
    }


    public function history(Request $request)
    {
        $futamis = Futami::where('delete', 1)->get();
        return view('admin.history', compact('futamis'))->with('no');
    }
    public function superadmin_analisakimiapdf($id)
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
