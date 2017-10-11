@extends('layouts.index')

@section('title', 'User')

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
                @if(Auth::user()->can(['user-create']))
                    <a href="{{ url('/user/tambah') }}" class="btn btn-sm btn-default">
                        <span class="glyphicon glyphicon-plus"></span> Tambah
                    </a>
                @else
                &nbsp;
                @endif
                <div class="box-tools">
                <form action="{{ url('user/query') }}" method="GET">
                    <div class="input-group input-group-sm" style="width: 200px; margin-top:4px;">
                    <input type="text" name="q" class="form-control pull-right" placeholder="Cari User">

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
                @if(count($user) != 0)
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="width: 25px">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th class="text-center" colspan="{{ count($roles) }}">Permission Role</th>
                            <th></th>
                        </tr>
                        @foreach($user as $us)
                        <tr>
                            <td align="center">{{ (($user->currentPage() - 1 ) * $user->perPage()) + $loop->iteration }}</td>
                            <td>{{ $us->name }}</td>
                            <td>{{ $us->email }}</td>

                            @foreach ($roles as $role)
                                <td class="text-center">
                                    <input id="{{ $role->id }}-{{ $us->id }}" class="filled-in"
                                        onclick="return coba('{{$us->id}}','{{$role->id}}','{{ $role->id }}-{{ $us->id }}')"
                                        type="checkbox"
                                        @if($us->hasRole($role->name))
                                        checked
                                            @endif
                                    >
                                    <label for="{{ $role->id }}-{{ $us->id }}">
                                        {{$role->display_name}}</label>
                                </td>
                            @endforeach

                            <td align="center">
                                @if(Auth::user()->can(['user-edit']))
                                <button onclick="window.location.href='{{ url("/user/edit", $us->id) }}'" type="button" class="btn btn-sm btn-default ">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </button>
                                @endif
                                @if(Auth::user()->can(['user-delete']))
                                <button type="button" onclick="return hapus('{{ url("/user/hapus", $us->id) }}');" class="btn btn-sm btn-default">
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
                    <a href="{{ url('user') }}">
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
            @if($user->total() > $user->perPage())

            <div class="box-footer clearfix">
                {{ $user->links('pagination.default') }}
            </div>

            @endif
        </div>
        <!-- /.box -->

        </section>
        <!-- /.content -->
        
    </div>
@endsection


@section('js')

    <script type="text/javascript">
        function coba(user, role, id) {
            var url = "user/edtuserrole";
            var $x = $("#" + id);

            if ($x.is(":checked")) {
                $.ajax({
                    url: "http://localhost:8000/user/makeuserrole/" + user + "/" + role
                });
            }
            else {
                $.ajax({
                    url: "http://localhost:8000/user/deleuserrole/" + user + "/" + role
                });
            }
        }
    </script>
@endsection