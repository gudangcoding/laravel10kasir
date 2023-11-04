@extends('layouts.app')

@section('title')
  Dashboard
@endsection

@section('breadcrumb')
   @parent
@endsection

@section('content') 
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
            	<h3>{{ $kategori }}</h3>
           		<p>Total Kategori</p>
            </div>
       		<div class="icon">
            	<i class="fa fa-cube"></i>
        	</div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
            	<h3>{{ $produk }}</h3>
           		<p>Total Produk</p>
            </div>
       		<div class="icon">
            	<i class="fa fa-cubes"></i>
        	</div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
            	<h3>{{ $supplier }}</h3>
           		<p>Total Supplier</p>
            </div>
       		<div class="icon">
            	<i class="fa fa-truck"></i>
        	</div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
            <div class="inner">
            	<h3>{{ $member }}</h3>
           		<p>Total Member</p>
            </div>
       		<div class="icon">
            	<i class="fa fa-credit-card"></i>
        	</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
            	{{-- <h3 class="box-title">Grafik Pendapatan {{ tanggal_indonesia($awal) }} s/d {{ tanggal_indonesia($akhir) }}</h3> --}}
              <h3 class="box-title">Grafik Pendapatan {{ tanggal_indonesia($awalBulanIni) }} s/d {{ tanggal_indonesia($akhirBulanIni) }}</h3>
            </div>
            <div class="box-body">
            	<div class="chart">

                    <!-- <canvas id="salesChart" style="height: 250px;"></canvas> -->
                    {{$data_pendapatan}}
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
$(function () {
  var salesChartCanvas = $("#myChart").get(0).getContext("2d");
  var salesChart = new Chart(salesChartCanvas);

  var salesChartData = {
    labels: {{ json_encode($data_tanggal) }},
    datasets: [
      {
        label: "Electronics",
        fillColor: "rgba(60,141,188,0.9)",
        strokeColor: "rgb(210, 214, 222)",
        pointColor: "rgb(210, 214, 222)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgb(220,220,220)",
        data: {{ json_encode($data_pendapatan) }}
      }
    ]
  };

  var salesChartOptions = {
    pointDot: false,
    responsive: true
  };

  //Create the line chart
  salesChart.Line(salesChartData, salesChartOptions);
});
</script> --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
@endsection