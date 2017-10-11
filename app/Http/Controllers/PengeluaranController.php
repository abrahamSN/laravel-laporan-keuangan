<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengeluaran;
use PDF;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mengambil data tabel jasa dari database
        $datas = Pengeluaran::orderBy('tanggal', 'DESC')->paginate(10);
        //mengambil view tampilan di resource/modules/pengeluaran/read.blade.php
        return view('modules.pengeluaran.read')->with('datas', $datas);
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

        $datas = Pengeluaran::orderBy('tanggal', 'ASC')->whereBetween('tanggal', [$tanggal_pertama, $tanggal_kedua])->paginate(2);

        return view('modules.pengeluaran.search', compact('datas', 'query'));
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
            $chart_pn[$x] = Pengeluaran::whereYear('tanggal', '=', $year)
                        ->whereMonth('tanggal', '=', $x)
                        ->sum('total');
        }

        return view('modules.pengeluaran.report', compact('chart_pn', 'year'));
    }

    public function pdf(Request $request)
    {
        $tanggal = explode('-',$request->get('tanggal'));
        $bulan = $tanggal[0];
        $tahun = $tanggal[1];
        $total_pengeluaran = Pengeluaran::whereYear('tanggal', '=', $tahun)
                        ->whereMonth('tanggal', '=', $bulan)
                        ->sum('total');
        
        $pengeluaran = Pengeluaran::orderBy('tanggal', 'ASC')->whereYear('tanggal', '=', $tahun)
                        ->whereMonth('tanggal', '=', $bulan)
                        ->get();
        $kode = 'PEN-'.$bulan.'-'.$tahun;
        $pdf = PDF::loadView('modules.pengeluaran.pdf', compact('bulan', 'tahun','pengeluaran', 'total_pengeluaran'));
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
        return view('modules.pengeluaran.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|min:3',
            'jumlah' => 'required',
            'keterangan' => 'required|min:3',
            'total' => 'required|min:3',
            'tanggal' => 'required',
            'foto_bukti' => 'required|image|mimes:jpeg,bmp,png|max:2000'
        ]);

        // Disini proses mendapatkan judul dan memindahkan letak gambar ke folder image
        $file       = $request->file('foto_bukti');
        $fileName   = $file->getClientOriginalName();

        //membetulkan format tanggal untuk database
        $tanggal_x = $request->get('tanggal');
        $tgl = explode('/',$tanggal_x);
        $tanggal = $tgl[2].'-'.$tgl[1].'-'.$tgl[0];

        //manipulasi dari rupiah ke bilangan
        $rupiah = $request->get('total');
        $satu = array('.','Rp',' ');
        $dua = array('','','');
        $total = str_replace($satu,$dua,$rupiah);

        //memasukan data ke tabel pengeluaran pada database
        $query = new Pengeluaran();
        $query->nama = $request->get('nama');
        $query->jumlah = $request->get('jumlah');
        $query->keterangan = $request->get('keterangan');
        $query->total = $total;
        $query->foto_bukti = $fileName;
        $query->tanggal = $tanggal;
        $query->save();

        //memasukan foto ke folder images/pengeluaran
        $request->file('foto_bukti')->move("images/pengeluaran", $fileName);
        
        \Session::flash('message','Data telah berhasil ditambahkan.');
        return redirect()->to('/pengeluaran');
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
        //mengambil data dari tabel pengeluaran berdasarkan id
        $data = Pengeluaran::where('id', $id)->first();

        return view('modules.pengeluaran.edit')->with('data', $data);
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
            'nama' => 'required|min:3',
            'jumlah' => 'required',
            'keterangan' => 'required|min:3',
            'total' => 'required|min:3',
            'tanggal' => 'required',
            'foto_bukti' => 'image|mimes:jpeg,bmp,png|max:2000'
        ]);

        $query = Pengeluaran::where('id', $id)->first();

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
            $filename = public_path().'/images/pengeluaran/'.$file;
            \File::delete($filename);

            $file = $request->file('foto_bukti');
            $fileName = $file->getClientOriginalName();
            $request->file('foto_bukti')->move("images/pengeluaran", $fileName);

            $query->foto_bukti = $fileName;
        }

        //manipulasi dari rupiah ke bilangan
        $rupiah = $request->get('total');
        $satu = array('.','Rp',' ');
        $dua = array('','','');
        $total = str_replace($satu,$dua,$rupiah);

        $query->nama = $request->get('nama');
        $query->jumlah = $request->get('jumlah');
        $query->keterangan = $request->get('keterangan');
        $query->total = $total;
        $query->tanggal = $tanggal;

        $query->update();
        \Session::flash('message','Data telah berhasil diubah.');
        return redirect()->to('/pengeluaran');
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
        $delete = Pengeluaran::find($id);
        $file = $delete->foto_bukti;
        //hapus file foto dari folder
        $filename = public_path().'/images/pengeluaran/'.$file;
        \File::delete($filename);
    
        $delete->delete();
        \Session::flash('message','Data telah berhasil dihapus.');
        return redirect()->to('/pengeluaran');
    }
}
