@extends('layouts.index')

@section('title', 'Jasa | Tambah')

@section('css')
    <!-- ini css -->
@endsection

@section('content')
    <div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            <h1>
                Tambah
                <small>data jasa</small>
            </h1>
            <ol class="breadcrumb">
                <li><i class="fa fa-book"></i> Jasa</li>
                <li class="active"> Add</li>
            </ol>
            </section>

            <!-- Main content -->
            <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    
                    <form role="form" method="POST" action="{{ url('jasa/store') }}">
                        {{ csrf_field() }}
                        <div class="box-body">

                            @if (Session::has('message'))
                            <div class="col-sm-12">
                            <div class="row">
                                <div class="alert alert-error alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                <h4 style="text-align:center"><i class="icon fa fa-exclamation-circle"></i>Error!</h4><p style="text-align:center">{{ session('message') }}</p>
                                </div>
                            </div>
                            </div>
                            @endif

                            <div class="form-group{{ $errors->has('nama_jasa') ? ' has-error' : '' }}">
                                <label for="nama_jasa">Nama Jasa</label>
                                <input id="nama_jasa" type="text" class="form-control" name="nama_jasa" value="{{ old('nama_jasa') }}" placeholder="Nama jasa">
                                @if ($errors->has('nama_jasa'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_jasa') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('keterangan_jasa') ? ' has-error' : '' }}">
                                <label for="keterangan_jasa">Keterangan</label>
                                <textarea id="keterangan_jasa" name="keterangan_jasa" class="form-control" rows="6" placeholder="Keterangan jasa ...">{{ old('keterangan_jasa') }}</textarea>
                                @if ($errors->has('keterangan_jasa'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('keterangan_jasa') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('harga_jasa') ? ' has-error' : '' }}">
                                <label for="harga_jasa">Harga Jasa</label>
                                <input id="harga_jasa" type="text" name="harga_jasa" value="{{ old('harga_jasa') }}" class="form-control" placeholder="Harga jasa">
                                @if ($errors->has('harga_jasa'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('harga_jasa') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ url('jasa') }}" class="btn btn-default">
                            <span class="glyphicon glyphicon-remove"></span>  Batal
                            </a>
                        </div>
                    </form>
                    
                </div>
                <!-- /.box-body -->

            </div>
            <!-- /.box -->

            </section>
            <!-- /.content -->
        </div>
    </div>
    </div>
@endsection

@section('js')
    <!-- ini js -->
    <!-- MaskMoney -->
    <script src="{{asset('adminLTE/plugins/maskMoney/jquery.maskMoney.min.js')}}"></script>
    <script>
    $(document).ready(function(){
        $('#harga_jasa').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0});
    });
    </script>
@endsection