@extends('layouts.index')

@section('title', 'Pemasukan | Tambah')

@section('css')
    <!-- ini css -->
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('adminLTE/bower_components/select2/dist/css/select2.min.css')}}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{asset('adminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    
@endsection

@section('content')
    <div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            <h1>
                Tambah
                <small>data pemasukan</small>
            </h1>
            <ol class="breadcrumb">
                <li><i class="fa fa-book"></i> Pemasukan</li>
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
                    
                    <form role="form" method="POST" action="{{ url('pemasukan/store') }}" enctype="multipart/form-data">
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

                            <div class="form-group{{ $errors->has('jasa') ? ' has-error' : '' }}">
                                <label for="jasa">Jasa</label>
                                <select class="form-control select2" name="jasa" id="jasa" style="width: 100%;">
                                    <option value="">- Pilih -</option>
                                    @foreach($jasa as $js)
                                        <option value="{{ $js->id }}" {{ (old("jasa") == "$js->id" ? "selected":"") }}>{{ $js->nama_jasa }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('jasa'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jasa') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('jumlah') ? ' has-error' : '' }}">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" name="jumlah" min="1" class="form-control" id="jumlah" value="{{ old('jumlah') }}" placeholder="Jumlah">
                                @if ($errors->has('jumlah'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jumlah') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
                                <label for="keterangan">Keterangan</label>
                                <textarea id="keterangan" name="keterangan" class="form-control" rows="6" placeholder="Keterangan ...">{{ old('keterangan') }}</textarea>
                                @if ($errors->has('keterangan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('keterangan') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('foto_bukti') ? ' has-error' : '' }}">
                                <label for="exampleInputFile">Foto Bukti</label>
                                <br/>
                                <img src="http://placehold.it/100x100" id="showgambar" style="max-width:200px;max-height:200px;" />
                                <br/>
                                <br/>
                                <input type="file" id="foto_bukti" name="foto_bukti">

                                <p class="help-block">Format jpeg|png|bmp, ukuran max 2mb.</p>
                                @if ($errors->has('foto_bukti'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('foto_bukti') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('tanggal') ? ' has-error' : '' }}">
                                <label for="tanggal">Tanggal</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" placeholder="Tanggal">
                                </div>
                                <!-- /.input group -->
                                @if ($errors->has('tanggal'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tanggal') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ url('pemasukan') }}" class="btn btn-default">
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
    <!-- select2 -->
    <script src="{{asset('adminLTE/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{asset('adminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('adminLTE/bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js')}}"></script>
    
    <script>
    //Select2
    $(function(){
        //Initialize Select2 Elements
        $('.select2').select2()
    })

    //Date picker
    $('#tanggal').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      language: 'ID'
    }).datepicker("setDate", new Date());

    //menampilakn image saat upload
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#showgambar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#foto_bukti").change(function () {
        readURL(this);
    });
    </script>
@endsection