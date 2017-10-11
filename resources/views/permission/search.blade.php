@extends('layouts.index')

@section('title', 'Permission')

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
                @if(Auth::user()->can(['permission-create']))
                    <a href="{{ url('/permission/tambah') }}" class="btn btn-sm btn-default">
                        <span class="glyphicon glyphicon-plus"></span> Tambah
                    </a>
                @endif
                <div class="box-tools">
                <form action="{{ url('permission/query') }}" method="GET">
                    <div class="input-group input-group-sm" style="width: 200px; margin-top:4px;">
                    <input type="text" name="q" class="form-control pull-right" placeholder="Cari Permission">

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
                @if(count($perms) != 0)
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="width: 20px">No</th>
                            <th>Nama Permission</th>
                            <th>Permisssion</th>
                            <th class="text-center" colspan="{{ count($roles) }}">Permission Role</th>
                            <th></th>
                        </tr>
                        @foreach($perms as $perm)
                        <tr>
                            <td align="center">{{ (($perms->currentPage() - 1 ) * $perms->perPage()) + $loop->iteration }}</td>
                            <td>{{ $perm->display_name }}</td>
                            <td>{{ $perm->name }}</td>

                            @foreach ($roles as $role)
                                <td class="text-center">
                                    <input id="{{ $role->id }}-{{ $perm->id }}" class="filled-in"
                                        onclick="return coba('{{$perm->id}}','{{$role->id}}','{{ $role->id }}-{{ $perm->id }}')"
                                        type="checkbox"
                                        @if($perm->hasRole($role->name))
                                        checked
                                            @endif
                                    >
                                    <label for="{{ $role->id }}-{{ $perm->id }}">
                                        {{$role->display_name}}</label>
                                </td>
                            @endforeach

                            <td align="center">
                                @if(Auth::user()->can(['permission-edit']))
                                <button onclick="window.location.href='{{ url("/permission/edit", $perm->id) }}'" type="button" class="btn btn-sm btn-default ">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </button>
                                @endif
                                @if(Auth::user()->can(['permission-delete']))
                                <button type="button" onclick="return hapus('{{ url("/permission/hapus", $perm->id) }}');" class="btn btn-sm btn-default">
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
                    <a href="{{ url('barang') }}">
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
                @if($perms->total() > $perms->perPage())
                    {{ $perms->appends(Request::only('q'))->links('pagination.default') }}
                @endif
            </div>
        </div>
        <!-- /.box -->

        </section>
        <!-- /.content -->
        
    </div>
@endsection

@section('js')

    <script type="text/javascript">
        function coba(perm, role, id) {
            var url = "permission/edtpermirole";
            var $x = $("#" + id);

            if ($x.is(":checked")) {
                $.ajax({
                    url: "http://localhost:8000/permission/makepermirole/" + perm + "/" + role
                });
            }
            else {
                $.ajax({
                    url: "http://localhost:8000/permission/delepermirole/" + perm + "/" + role
                });
            }
        }
    </script>
@endsection