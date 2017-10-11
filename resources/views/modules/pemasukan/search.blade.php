@extends('layouts.index')

@section('title', 'Pemasukan')

@section('css')
    <!-- ini css -->
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('adminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <!-- image popup -->
    <link rel="stylesheet" href="{{asset('adminLTE/plugins/magnific-popup/magnific-popup.css')}}">
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            List View
            <small>data pemasukan</small>
        </h1>
        <ol class="breadcrumb">
            <li><i class="fa fa-book"></i> Pemasukan</li>
            <li class="active"> View</li>
        </ol>
        </section>

        <!-- Main content -->
        <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                @if(Auth::user()->can(['pemasukan-create']))
                    <a href="{{ url('/pemasukan/add') }}" class="btn btn-sm btn-default">
                        <span class="glyphicon glyphicon-plus"></span> Tambah
                    </a>
                @else
                &nbsp;
                @endif
                <div class="box-tools">
                <form action="{{ url('pemasukan/query') }}" method="GET">
                    <div class="input-group input-group-sm" style="width: 220px; margin-top:4px;">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="q" class="form-control pull-right" id="reservation" placeholder="Cari tanggal">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if (Session::has('message'))
                <div class="pesan-alert" style="display:none;">
                    <div class="col-sm-4 col-sm-offset-4">
                        <div class="row">
                        <div class="alert alert-info alert-dismissible">
                            <h4 style="text-align:center"><i class="icon fa fa-check"></i>Berhasil!</h4>
                            <p style="text-align:center">{{ session('message') }}</p>
                        </div>
                        </div>
                    </div>
                </div>
                @endif
                @if(count($datas) != 0)
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="width: 25px">No</th>
                            <th>Tanggal</th>
                            <th>Jasa</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Total</th>
                            <th>Foto Bukti</th>
                            <th></th>
                        </tr>
                        <?php  $count = 1; ?>
                        @foreach($datas as $data)
                        @php
                        $tgl = explode('-',$data->tanggal);
                        $tanggal = $tgl[2].'/'.$tgl[1].'/'.$tgl[0];
                        @endphp
                        <tr>
                            <td align='center'>{{ (($datas->currentPage() - 1 ) * $datas->perPage()) + $loop->iteration }}</td>
                            <td>{{ $tanggal }}</td>
                            <td>{{ $data->jasa->nama_jasa }}</td>
                            <td>{{ $data->jumlah }}</td>
                            <td>{{ $data->keterangan }}</td>
                            <td>Rp. {{ number_format($data->total,0,',','.') }}</td>
                            <td align='center'>
                                <a class="image-popup-no-margins" href="{{asset('images/pemasukan/'.$data->foto_bukti)}}">
                                    <img src="{{asset('images/pemasukan/'.$data->foto_bukti)}}" width="60" height="60" class="img-circle" alt="" />
                                </a>
                            </td>
                            <td align='center'>
                                @if(Auth::user()->can(['pemasukan-edit']))
                                <button onclick="window.location.href='{{ url("pemasukan/edit", $data->id) }}'" type="button" class="btn btn-sm btn-default">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </button>
                                @endif
                                @if(Auth::user()->can(['pemasukan-delete']))
                                <button type="button" class="btn btn-sm btn-default" onclick="return hapus('{{ url("pemasukan/delete", $data->id) }}');">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <br>
                <br>
                <br>
                <br>
                <center>
                    <h1><span class="glyphicon glyphicon-floppy-remove"></span> Data Tidak Ditemukan</h1>
                    <a href="{{ url('pemasukan') }}">
                      <span class="fa fa-arrow-left"></span> Kembali ke View
                    </a>
                </center>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                @endif
            </div>
            <!-- /.box-body -->
            <!-- Pagination setting -->
            <div class="box-footer clearfix">
                <div>
                    <p>Hasil pencarian dari '{{Request::get('q')}}'</p>
                </div>
                @if($datas->total() > $datas->perPage())
                    {{ $datas->appends(Request::only('q'))->links('pagination.default') }}
                @endif
            </div>
            
        </div>
        <!-- /.box -->

        </section>
        <!-- /.content -->
        
    </div>
@endsection

@section('js')
    <!-- date-range-picker -->
    <script src="{{asset('adminLTE/bower_components/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('adminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- js image popup -->
    <script src="{{asset('adminLTE/plugins/magnific-popup/jquery.magnific-popup.js')}}"></script>
    <script>
        $(document).ready(function() {

            $('.image-popup-vertical-fit').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                mainClass: 'mfp-img-mobile',
                image: {
                verticalFit: true
                }

            });

            $('.image-popup-fit-width').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                image: {
                verticalFit: false
                }
            });

            $('.image-popup-no-margins').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                closeBtnInside: false,
                fixedContentPos: true,
                mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
                image: {
                verticalFit: true
                },
                zoom: {
                enabled: true,
                duration: 300 // don't foget to change the duration also in CSS
                }
            });

            });

        //Date range picker
        $('#reservation').daterangepicker({
            locale: {
                format: 'DD/MM/YYYY',
            }
        })
    </script>
@endsection