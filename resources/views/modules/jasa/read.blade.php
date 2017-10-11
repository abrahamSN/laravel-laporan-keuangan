@extends('layouts.index')

@section('title', 'Jasa')

@section('css')
    <!-- ini css -->
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            List View
            <small>data jasa</small>
        </h1>
        <ol class="breadcrumb">
            <li><i class="fa fa-book"></i> Jasa</li>
            <li class="active"> View</li>
        </ol>
        </section>

        <!-- Main content -->
        <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                @if(Auth::user()->can(['jasa-create']))
                <a href="{{ url('jasa/add') }}" class="btn btn-sm btn-default">
                  <span class="glyphicon glyphicon-plus"></span>  Tambah Data
                </a>
                @else
                &nbsp;
                @endif
                <div class="box-tools">
                <form action="{{ url('jasa/query') }}" method="GET">
                    <div class="input-group input-group-sm" style="width: 200px; margin-top:4px;">
                    <input type="text" name="q" class="form-control pull-right" placeholder="Cari jasa">

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
                            <th>Nama Jasa</th>
                            <th>Keterangan</th>
                            <th>Harga Jasa</th>
                            <th></th>
                        </tr>
                        <?php  $count = 1; ?>
                        @foreach($datas as $data)
                        <tr>
                            <td align='center'>{{ (($datas->currentPage() - 1 ) * $datas->perPage()) + $loop->iteration }}</td>
                            <td>{{ $data->nama_jasa }}</td>
                            <td>{{ $data->keterangan }}</td>
                            <td>Rp. {{ number_format($data->harga_jasa,0,',','.') }}</td>
                            <td align='center'>
                                @if(Auth::user()->can(['jasa-edit']))
                                <button onclick="window.location.href='{{ url("jasa/edit", $data->id) }}'" type="button" class="btn btn-sm btn-default">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </button>
                                @endif
                                @if(Auth::user()->can(['jasa-delete']))
                                <button type="button" class="btn btn-sm btn-default" onclick="return hapus('{{ url("jasa/delete", $data->id) }}');">
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
                    <a href="{{ url('jasa') }}">
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
            @if($datas->total() > $datas->perPage())

            <div class="box-footer clearfix">
                {{ $datas->links('pagination.default') }}
            </div>

            @endif
        </div>
        <!-- /.box -->

        </section>
        <!-- /.content -->
        
    </div>
@endsection

@section('js')
    <!-- ini js -->
@endsection