@extends('layouts.index')

@section('title', 'Permission | Tambah')

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
                    
                    <form role="form" method="POST" action="{{ url('permission/store') }}">
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

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
                                <label for="display_name">Display Name</label>
                                <input id="display_name" type="text" class="form-control" name="display_name" value="{{ old('display_name') }}" placeholder="Display Name">
                                @if ($errors->has('display_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('display_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control" rows="6" placeholder="Description ...">{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ url('permission') }}" class="btn btn-default">
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