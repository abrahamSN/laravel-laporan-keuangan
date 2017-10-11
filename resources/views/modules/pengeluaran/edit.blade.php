@extends('layouts.index')

@section('title', 'Pengeluaran | Tambah')

@section('css')
    <!-- ini css -->
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
                Detail
                <small>data pengeluaran</small>
            </h1>
            <ol class="breadcrumb">
                <li><i class="fa fa-book"></i> Pengeluaran</li>
                <li class="active"> edit</li>
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
                    
                    <form role="form" method="POST" action="{{ url('pengeluaran/update', $data->id) }}" enctype="multipart/form-data">
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

                            <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                                <label for="nama">Nama</label>
                                <input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama', $data->nama) }}" placeholder="Nama">
                                @if ($errors->has('nama'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('jumlah') ? ' has-error' : '' }}">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" name="jumlah" min="1" class="form-control" id="jumlah" value="{{ old('jumlah', $data->jumlah) }}" placeholder="Jumlah">
                                @if ($errors->has('jumlah'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jumlah') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
                                <label for="keterangan">Keterangan</label>
                                <textarea id="keterangan" name="keterangan" class="form-control" rows="6" placeholder="Keterangan ...">{{ old('keterangan', $data->keterangan) }}</textarea>
                                @if ($errors->has('keterangan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('keterangan') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('total') ? ' has-error' : '' }}">
                                <label for="total">Total</label>
                                <input id="total" type="text" name="total" value="Rp. {{ old('total', number_format($data->total,0,',','.')) }}" class="form-control" placeholder="Total">
                                @if ($errors->has('total'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('total') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('foto_bukti') ? ' has-error' : '' }}">
                                <label for="exampleInputFile">Foto Bukti</label>
                                <br/>
                                <img src="{{ asset('images/pengeluaran/'.$data->foto_bukti) }}" id="showgambar" style="max-width:200px;max-height:200px;" />
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
                                    @php
                                    $tanggal_x = $data->tanggal;
                                    $tgl = explode('-',$tanggal_x);
                                    $tanggal = $tgl[2].'/'.$tgl[1].'/'.$tgl[0];
                                    @endphp
                                    <input type="text" class="form-control pull-right" id="tanggal" name="tanggal" value="{{ old('tanggal', $tanggal) }}" placeholder="Tanggal">
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
                            <a href="{{ url('pengeluaran') }}" class="btn btn-default">
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
    <!-- bootstrap datepicker -->
    <script src="{{asset('adminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('adminLTE/bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js')}}"></script>
    
    <script src="{{asset('adminLTE/plugins/maskMoney/jquery.maskMoney.min.js')}}"></script>
    <script>
    $(document).ready(function(){
        $('#total').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0});
    });
    </script>

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
    });

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