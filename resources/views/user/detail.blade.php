@extends('layouts.index')

@section('title', 'User | Detail')

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
                <small>data barang</small>
            </h1>
            <ol class="breadcrumb">
                <li><i class="fa fa-book"></i> Barang</li>
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
                    
                    <form role="form" method="POST" action="{{ url('/user/update',$show->id) }}">
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
                                <input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama', $show->name) }}" placeholder="Nama">
                                @if ($errors->has('nama'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $show->email) }}" placeholder="Email">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>


                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ url('user') }}" class="btn btn-default">
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
    
@endsection