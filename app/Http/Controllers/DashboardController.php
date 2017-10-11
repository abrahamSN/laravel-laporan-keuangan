<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemasukan;
use App\Pengeluaran;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $month = date('m');
        $year = date('Y');

        for ($x = 1; $x <= 12; $x++) {
            $chart_pm[$x] = Pemasukan::whereYear('tanggal', '=', $year)
                        ->whereMonth('tanggal', '=', $x)
                        ->sum('total');
            $chart_pn[$x] = Pengeluaran::whereYear('tanggal', '=', $year)
                        ->whereMonth('tanggal', '=', $x)
                        ->sum('total');
        }

        $pemasukan = Pemasukan::whereYear('tanggal', '=', $year)
                        ->whereMonth('tanggal', '=', $month)
                        ->sum('total');
        $pengeluaran = Pengeluaran::whereYear('tanggal', '=', $year)
                        ->whereMonth('tanggal', '=', $month)
                        ->sum('total');

        return view('modules.dashboard.read', compact('pemasukan','pengeluaran','chart_pm','chart_pn'));
    }
}
