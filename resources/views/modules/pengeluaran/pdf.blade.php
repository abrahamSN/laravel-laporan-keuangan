<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan pengeluaran</title>
    <style type="text/css">
        body {
            font-family: "Arial", Helvetica, sans-serif !important;;
        }

        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            border-color: #ccc;
            width: 100%;
        }

        .tg td {
            font-family: Arial;
            font-size: 12px;
            padding: 8px 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: #ccc;
            color: #333;
            background-color: #fff;
        }

        .tg th {
            font-family: Arial;
            font-size: 14px;
            font-weight: normal;
            padding: 8px 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: #cc685e;
            color: #333;
            background-color: #f0f0f0;
        }

        .tg .tg-3wr7 {
            font-weight: bold;
            font-size: 12px;
            font-family: "Arial", Helvetica, sans-serif !important;;
            text-align: center
        }

        .tg .tg-ti5e {
            font-size: 10px;
            font-family: "Arial", Helvetica, sans-serif !important;;
            text-align: center
        }

        .tg .tg-rv4w {
            font-size: 10px;
            font-family: "Arial", Helvetica, sans-serif !important;
        }
        .report_t {
            width: 100%;
            height: auto;
            text-align: center;
            font-size: 25px;
        }
        .report_c {
            width: 100%;
            height: auto;
            text-align: center;
            font-size: 16px;
            line-height: 18px;
        }
    </style>
</head>
<body>
    @php
    if($bulan == 1){$bln = 'Januari';}
    if($bulan == 2){$bln = 'Febuari';}
    if($bulan == 3){$bln = 'Maret';}
    if($bulan == 4){$bln = 'April';}
    if($bulan == 5){$bln = 'Mei';}
    if($bulan == 6){$bln = 'Juni';}
    if($bulan == 7){$bln = 'Juli';}
    if($bulan == 8){$bln = 'Agustus';}
    if($bulan == 9){$bln = 'September';}
    if($bulan == 10){$bln = 'Oktober';}
    if($bulan == 11){$bln = 'November';}
    if($bulan == 12){$bln = 'Desember';}
    $no = 1;
    @endphp
    <div class="report_t">LAPORAN PENGELUARAN</div>
    <div class="report_c">Report laporan pengeluaran bulan {{$bln}} tahun {{$tahun}} <br> di Software House Lampung</div>
    <br>
    <hr>
    <br>
    <table class="tg">
    <tr>
        <th align="center"><b>No</b></th>
        <th><b>Tanggal</b></th>
        <th><b>Nama</b></th>
        <th><b>Jumlah</b></th>
        <th><b>Keterangan</b></th>
        <th><b>Total</b></th>
    </tr>
    @foreach($pengeluaran as $pn)
    @php
    $tgl = explode('-',$pn->tanggal);
    $tanggal = $tgl[2].'/'.$tgl[1].'/'.$tgl[0];
    @endphp
    <tr>
        <td align="center">{{$no}}</td>
        <td>{{$tanggal}}</td>
        <td>{{$pn->nama}}</td>
        <td align="center">{{$pn->jumlah}}</td>
        <td>{{$pn->keterangan}}</td>
        <td>Rp. {{number_format($pn->total,0,',','.')}}</td>
    </tr>
    @php
        $no++
    @endphp
    @endforeach
    <tr>
        <td style="border-right:1px solid #fff;"></td>
        <td style="border-right:1px solid #fff;"></td>
        <td style="border-right:1px solid #fff;"></td>
        <td style="border-right:1px solid #fff;"></td>
        <td align="right"><b>Total Pengeluaran : </b></td>
        <td><b>Rp. {{ number_format($total_pengeluaran,0,',','.') }}</b></td>
    </tr>
    

</table>
</body>
</html>