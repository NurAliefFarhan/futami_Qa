<?php

namespace App\Http\Controllers;

use App\Models\Parameter_pengujian; 
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

class ParameterPengujianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function add(Request $request)
    {
        $parameter = Parameter_pengujian::all();
        return view('parameter_pengujian.add', compact('parameter'))->with('no'); 
    }
    
    public function inputParameter(Request $request)
    {
        $request->validate([
            'nama_parameter' => 'required',
        ],[
            'nama_parameter.required' => 'Kolom nama parameter harus di isi',
        ]);
        $parameter_pengujian = Parameter_pengujian::create([
           'nama_parameter' => $request->nama_parameter,
           'catatan' => $request->catatan, 
        ]);
         
       return redirect('/operator/parameter_pengujian')->with('successAdd', 'Berhasil membuat Parameter Baru!'); //mereturn / lewat / , bukan lewat name yang diberikan 
    }

    public function parameterDestroy(Request $request, $id)
    {
        Parameter_pengujian::where('id', '=', $id)->delete(); 
        // return redirect()->route('data')->with('successDelete', 'Berhasil menghapus data!'); 
        return redirect()->back()->with('successDelete', 'Berhasil menghapus data parameter!'); 
        
    } 

    public function editParameter(Request $request, $id)
    {
        $parameter = Parameter_pengujian::where('id', '=', $id)->first();
        return view('parameter_pengujian.edit', compact('parameter'))->with('no'); 
    }


    public function udpateParameter(Request $request, $id)
    {
        $request->validate([
            'nama_parameter' => 'required',
        ],[
            'nama_parameter.required' => 'Kolom nama parameter harus di isi',
        ]);

        $parameter = Parameter_pengujian::where('id', $id)->update([
           'nama_parameter' => $request->nama_parameter,
           'catatan' => $request->catatan, 
        ]);
         
       return redirect('/operator/parameter_pengujian')->with('successAdd', 'Berhasil membuat Parameter Baru!'); //mereturn / lewat / , bukan lewat name yang diberikan 
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
     * @param  \App\Models\Parameter_pengujian  $parameter_pengujian
     * @return \Illuminate\Http\Response
     */
    public function show(Parameter_pengujian $parameter_pengujian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Parameter_pengujian  $parameter_pengujian
     * @return \Illuminate\Http\Response
     */
    public function edit(Parameter_pengujian $parameter_pengujian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parameter_pengujian  $parameter_pengujian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parameter_pengujian $parameter_pengujian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parameter_pengujian  $parameter_pengujian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parameter_pengujian $parameter_pengujian)
    {
        //
    }
}
