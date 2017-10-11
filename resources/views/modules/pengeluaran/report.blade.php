@extends('layouts.index')

@section('title', 'Page Coba')

@section('css')
    <!-- ini css -->
    <style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>
  <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{asset('adminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endsection

@section('chart')
    <script src="{{asset('adminLTE/bower_components/moment/min/moment.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js" />
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Report
            <small>laporan pengeluaran</small>
        </h1>
        </section>

        <!-- Main content -->
        <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-default">
                    <span class="glyphicon glyphicon-print"></span> Cetak PDF
                </button>
                <div class="box-tools">
                <form action="{{ url('pengeluaran/report') }}" method="GET">
                    <div class="input-group input-group-sm" style="width: 220px; margin-top:4px;">
                        <select class="form-control" name="tahun" onChange="this.form.submit()">
                            <option>- Filter Tahun -</option>
                            @for($i = date('Y'); $i >= 2000; $i--)
                                <option value="{{ $i }}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </form>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <canvas id="myChart"></canvas>
            </div>
            <!-- /.box-body -->
            
        </div>
        <!-- /.box -->

        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Filter Cetak Pengeluaran</h4>
              </div>
              <form action="{{ url('pengeluaran/pdf') }}" method="GET">
              <div class="modal-body">
                <div class="form-group">
                    <label for="tanggal">Bulan dan Tahun</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                    </div>
                    <!-- /.input group -->
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Cetak</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        </section>
        <!-- /.content -->
        
    </div>
@endsection

@section('js')
<!-- bootstrap datepicker -->
    <script src="{{asset('adminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('adminLTE/bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js')}}"></script>
    <script>
    //Date picker
    $('#tanggal').datepicker({
      autoclose: true,
      format: "mm-yyyy",
      viewMode: "months", 
      minViewMode: "months",
      language: 'ID'
    });

    $('.modal').on('hidden.bs.modal', function(){
        $(this).find('form')[0].reset();
    });

    var ctx = document.getElementById("myChart").getContext("2d");
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
            datasets: [{
                label: "Pengeluaran",
                backgroundColor: 'rgb(221, 75, 57)',
                borderColor: 'rgb(221, 75, 57)',
                fill: false,
                data: [
                    @foreach($chart_pn as $c_pn)
                        {{ ($c_pn != 0) ? $c_pn : 'null' }},
                    @endforeach
                ]
            }]
        },

        // Configuration options go here
        options: {
                responsive: true,
                title:{
                    display:true,
                    text:'Grafik Pengeluaran Di Tahun ' + {{$year}}
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return "Rp" + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                                return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "." + c : c;
                            });
                        }
                    }
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Bulan'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Jumlah'
                        },
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                            if(parseInt(value) >= 1000){
                                return 'Rp.' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            } else {
                                return 'Rp.' + value;
                            }
                            }
                        }
                    }]
                }
        }
    });
    </script>
@endsection