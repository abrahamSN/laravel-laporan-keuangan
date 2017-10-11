@extends('layouts.index')

@section('title', 'Page Coba')

@section('css')
    <!-- ini css -->
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
            Dashboard
            <small>laporan keuangan software house lampung</small>
        </h1>
        </section>

        <!-- Main content -->
        <section class="content">

        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                    <h4><b>Rp. {{ number_format($pemasukan,0,',','.') }}</b></h4>

                    <p>Pemasukan di bulan ini</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ url('pemasukan') }}" class="small-box-footer">lebih lanjut <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                    <h4><b>Rp. {{ number_format($pengeluaran,0,',','.') }}</b></h4>

                    <p>Pengeluaran di bulan ini</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ url('pengeluaran') }}" class="small-box-footer">lebih lanjut <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        

        <!-- Default box -->
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <canvas id="myChart"></canvas>
            </div>
            <!-- /.box-body -->
            
        </div>
        <!-- /.box -->

        </section>
        <!-- /.content -->
        
    </div>
@endsection

@section('js')
    <script>
    var d = new Date();
    var n = d.getFullYear();
    var ctx = document.getElementById("myChart").getContext("2d");
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
            datasets: [{
                label: "Pemasukan",
                backgroundColor: 'rgb(0, 166, 90)',
                borderColor: 'rgb(0, 166, 90)',
                fill: false,
                data: [
                    @foreach($chart_pm as $c_pm)
                        {{ ($c_pm != 0) ? $c_pm : 'null' }},
                    @endforeach
                ]
            },
            {
                label: "Pengeluaran",
                backgroundColor: 'rgb(221, 75, 57)',
                borderColor: 'rgb(221, 75, 57)',
                fill: false,
                data: [
                    @foreach($chart_pn as $c_pn)
                        {{ ($c_pn != 0) ? $c_pn : 'null' }},
                    @endforeach
                ]
            }
            ]
        },

        // Configuration options go here
        options: {
                responsive: true,
                title:{
                    display:true,
                    text:'Grafik Pemasukan dan Pengeluaran ' + n
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