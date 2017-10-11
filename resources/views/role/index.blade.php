@extends('layouts.index')

@section('title', 'Role')

@section('css')
    <!-- ini css -->
@endsection


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            List View
            <small>data barang</small>
        </h1>
        <ol class="breadcrumb">
            <li><i class="fa fa-book"></i> Barang</li>
            <li class="active"> View</li>
        </ol>
        </section>

        <!-- Main content -->
        <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                @if(Auth::user()->can(['role-create']))
                    <a href="{{ url('/role/tambah') }}" class="btn btn-sm btn-default">
                        <span class="glyphicon glyphicon-plus"></span> Tambah
                    </a>
                @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
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
                @if(count($role) != 0)
                @php
                    $no = 1;
                @endphp
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="width: 25px">No</th>
                            <th>Nama Role</th>
                            <th>Deskripsi Role</th>
                            <th>Permission Role</th>
                            <th></th>
                        </tr>
                        @foreach($role as $ro)
                        <tr>
                            <td align="center">{{$no}}</td>
                            <td>{{ $ro->display_name }}</td>
                            <td>{{ $ro->description }}</td>
                            <td style="width: 30%">
                                @foreach ($ro->perms as $perm)
                                    <span class="label label-primary">{{ $perm->name }}</span>
                                @endforeach
                            </td>
                            <td align="center">
                                @if(Auth::user()->can(['role-edit']))
                                <button onclick="window.location.href='{{ url("/role/edit", $ro->id) }}'" type="button" class="btn btn-sm btn-default ">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </button>
                                @endif
                                @if(Auth::user()->can(['role-delete']))
                                <button type="button" onclick="return hapus('{{ url("/role/hapus", $ro->id) }}');" class="btn btn-sm btn-default">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                                @endif
                            </td>
                        </tr>
                        @php
                            $no++;
                        @endphp
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
                    <a href="{{ url('role') }}">
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
        </div>
        <!-- /.box -->

        </section>
        <!-- /.content -->
        
    </div>
@endsection

@section('js')
    
@endsection