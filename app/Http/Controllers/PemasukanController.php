<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemasukan;
use App\Jasa;
use PDF;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mengambil data tabel jasa dari database
        $datas = Pemasukan::orderBy('tanggal', 'DESC')->paginate(10);
        //mengambil view tampilan di resource/modules/pemasukan/read.blade.php
        return view('modules.pemasukan.read')->with('datas', $datas);
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        //pecah data input cari
        $tanggal_a = explode('-',$query);

        //tanggal pertama
        $tanggal_x = str_replace(" ", "", $tanggal_a[0]);
        $tgl_x = explode('/',$tanggal_x);
        $tanggal_pertama = $tgl_x[2].'-'.$tgl_x[1].'-'.$tgl_x[0];

        //tanggal kedua
        $tanggal_y = str_replace(" ", "", $tanggal_a[1]);
        $tgl_y = explode('/',$tanggal_y);
        $tanggal_kedua = $tgl_y[2].'-'.$tgl_y[1].'-'.$tgl_y[0];

        $datas = Pemasukan::orderBy('tanggal', 'ASC')->whereBetween('tanggal', [$tanggal_pertama, $tanggal_kedua])->paginate(2);

        return view('modules.pemasukan.search', compact('datas', 'query'));
    }

    public function report(Request $request)
    {
        if($request->get('tahun') == false){
            $year = date('Y');
        }
        else {
            $year = $request->get('tahun');
        }

        for ($x = 1; $x <= 12; $x++) {
            $chart_pm[$x] = Pemasukan::whereYear('tanggal', '=', $year)
                        ->whereMonth('tanggal', '=', $x)
                        ->sum('total');
        }

        return view('modules.pemasukan.report', compact('chart_pm', 'year'));
    }

    public function pdf(Request $request)
    {
        $tanggal = explode('-',$request->get('tanggal'));
        $bulan = $tanggal[0];
        $tahun = $tanggal[1];
        $total_pemasukan = Pemasukan::whereYear('tanggal', '=', $tahun)
                        ->whereMonth('tanggal', '=', $bulan)
                        ->sum('total');
        
        $pemasukan = Pemasukan::orderBy('tanggal', 'ASC')->whereYear('tanggal', '=', $tahun)
                        ->whereMonth('tanggal', '=', $bulan)
                        ->get();
        $kode = 'PEM-'.$bulan.'-'.$tahun;
        $pdf = PDF::loadView('modules.pemasukan.pdf', compact('bulan', 'tahun','pemasukan', 'total_pemasukan'));
        return $pdf->download($kode.'.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $jasa = Jasa::all();
        return view('modules.pemasukan.add')->with('jasa', $jasa);
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
        $this->validate($request, [
            'jasa' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required|min:3',
            'tanggal' => 'required',
            'foto_bukti' => 'required|image|mimes:jpeg,bmp,png|max:2000'
        ]);

        //mengambil harga jasa lalu di kali jumlah
        $jasa = $request->get('jasa');
        $dataJasa = Jasa::where('id', $jasa)->first();
        $harga_jasa = $dataJasa->harga_jasa;
        $jumlah = $request->get('jumlah');
        $total = $harga_jasa * $jumlah;

        // Disini proses mendapatkan judul dan memindahkan letak gambar ke folder image
        $file       = $request->file('foto_bukti');
        $fileName   = $file->getClientOriginalName();

        //membetulkan format tanggal untuk database
        $tanggal_x = $request->get('tanggal');
        $tgl = explode('/',$tanggal_x);
        $tanggal = $tgl[2].'-'.$tgl[1].'-'.$tgl[0];

        //memasukan data ke tabel pemasukan pada database
        $query = new Pemasukan();
        $query->jasa_id = $jasa;
        $query->jumlah = $jumlah;
        $query->keterangan = $request->get('keterangan');
        $query->total = $total;
        $query->foto_bukti = $fileName;
        $query->tanggal = $tanggal;
        $query->save();

        //memasukan foto ke folder images/pemasukan
        $request->file('foto_bukti')->move("images/pemasukan", $fileName);
        
        \Session::flash('message','Data telah berhasil ditambahkan.');
        return redirect()->to('/pemasukan');
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
        //mengambil data dari tabel pemasukan berdasaar id
        $data = Pemasukan::where('id', $id)->first();
        //mengambil data dari tabel jasa
        $jasa = Jasa::all();
        return view('modules.pemasukan.edit', compact('data','jasa'));
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
        //
        $this->validate($request, [
            'jasa' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required|min:3',
            'tanggal' => 'required',
            'foto_bukti' => 'image|mimes:jpeg,bmp,png|max:2000'
        ]);

        //mengambil harga jasa lalu di kali jumlah
        $jasa = $request->get('jasa');
        $dataJasa = Jasa::where('id', $jasa)->first();
        $harga_jasa = $dataJasa->harga_jasa;
        $jumlah = $request->get('jumlah');
        $total = $harga_jasa * $jumlah;

        $query = Pemasukan::where('id', $id)->first();

        //membetulkan format tanggal untuk database
        $tanggal_x = $request->get('tanggal');
        $tgl = explode('/',$tanggal_x);
        $tanggal = $tgl[2].'-'.$tgl[1].'-'.$tgl[0];

        //jika upload foto kosong
        if ($request->file('foto_bukti') == "") {
            $query->foto_bukti = $query->foto_bukti;
        }
        else {

            $file = $query->foto_bukti;
            //hapus file foto dari folder
            $filename = public_path().'/images/pemasukan/'.$file;
            \File::delete($filename);

            $file = $request->file('foto_bukti');
            $fileName = $file->getClientOriginalName();
            $request->file('foto_bukti')->move("images/pemasukan", $fileName);

            $query->foto_bukti = $fileName;
        }

        $query->jasa_id = $jasa;
        $query->jumlah = $jumlah;
        $query->keterangan = $request->get('keterangan');
        $query->total = $total;
        $query->tanggal = $tanggal;

        $query->update();
        \Session::flash('message','Data telah berhasil diubah.');
        return redirect()->to('/pemasukan');


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
        $delete = Pemasukan::find($id);
        $file = $delete->foto_bukti;
        //hapus file foto dari folder
        $filename = public_path().'/images/pemasukan/'.$file;
        \File::delete($filename);
    
        $delete->delete();
        \Session::flash('message','Data telah berhasil dihapus.');
        return redirect()->to('/pemasukan');
    }
}
