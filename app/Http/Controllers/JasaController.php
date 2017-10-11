<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Jasa;

class JasaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mengambil data tabel jasa dari database
        $datas = Jasa::orderBy('nama_jasa', 'ASC')->paginate(2);
        //mengambil view tampilan di resource/modules/jasa/read.blade.php
        return view('modules.jasa.read')->with('datas', $datas);
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $datas = Jasa::where('nama_jasa', 'LIKE', '%' . $query . '%')->paginate(2);
        return view('modules.jasa.search', compact('datas', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //mengambil view tampilan di resource/modules/jasa/add.blade.php
        return view('modules.jasa.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //mengatur error validasi
        $this->validate($request, [
            'nama_jasa' => 'required|min:3|max:120',
            'keterangan_jasa' => 'required|min:5',
            'harga_jasa' => 'required|min:2'
        ]);

        //ambil data nama jasa untuk filtering jika nama jasa sudah ada di tabel jasa
        $nama_jasa = $request->get('nama_jasa');
        $jasa = DB::table('jasa')->where('nama_jasa', $nama_jasa)->first();
        if (count($jasa) !=0 ) {
            \Session::flash('message','Data sudah pernah disimpan.');
            return redirect()->to('/jasa/add');
        }
        else {
            //manipulasi dari rupiah ke bilangan
            $rupiah = $request->get('harga_jasa');
            $satu = array('.','Rp',' ');
            $dua = array('','','');
            $harga_jasa = str_replace($satu,$dua,$rupiah);

            //memasukan data ke tabel jasa pada database
            $query = new jasa();
            $query->nama_jasa = $request->get('nama_jasa');
            $query->keterangan = $request->get('keterangan_jasa');
            $query->harga_jasa = $harga_jasa;
            $query->save();
            
            \Session::flash('message','Data telah berhasil ditambahkan.');
            return redirect()->to('/jasa');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //mengambil data dari tabel jasa berdasaar id
        $data = Jasa::where('id', $id)->first();
        return view('modules.jasa.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        ///mengatur error validasi
        $this->validate($request, [
            'nama_jasa' => 'required|min:3|max:120',
            'keterangan_jasa' => 'required|min:5',
            'harga_jasa' => 'required|min:2'
        ]);

        //ambil data untuk filtering jika data yg di edit sudah ada dengan id yg berbeda
        $nama_jasa = $request->get('nama_jasa');
        $jasa = DB::table('jasa')->where([
            ['id', '!=', $id],
            ['nama_jasa', '=', $nama_jasa]
        ])->get();

        if (count($jasa) != 0) {
            \Session::flash('message','Data sudah pernah disimpan.');
            return redirect()->to('/jasa/edit/'.$id);
        } else {
            //manipulasi dari rupiah ke bilangan
            $rupiah = $request['harga_jasa'];
            $satu = array('.','Rp',' ');
            $dua = array('','','');
            $harga_jasa = str_replace($satu,$dua,$rupiah);

            //memasukan data yg telah di ubah ke tabel jasa pada database
            $query = Jasa::where('id', $id)->first();
            $query->nama_jasa = $request['nama_jasa'];
            $query->keterangan = $request['keterangan_jasa'];
            $query->harga_jasa = $harga_jasa;
            $query->update();
            \Session::flash('message','Data telah berhasil diubah.');
            return redirect()->to('/jasa');
        }
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //hapus isi data tabel jasa berdasarkan id
        $delete = Jasa::find($id);
        $delete->delete();
        \Session::flash('message','Data telah berhasil dihapus.');
        return redirect()->to('/jasa');
    }
}
