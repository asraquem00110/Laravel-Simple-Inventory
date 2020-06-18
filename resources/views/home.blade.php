@extends('layouts.index')


@section('MainContent')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark"> <i class="fa fa-tachometer-alt"></i> Dashboard</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
         
          <!-- /.col-md-12 -->
          <div class="col-lg-12">
                <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$itemcount}}</h3>

                <p>Items</p>
              </div>
              <div class="icon">
                <i class="fa fa-cubes"></i>
              </div>
              <a href="{{url('item/list')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$clientcount}}</h3>

                <p>Site(s)</p>
              </div>
              <div class="icon">
                <i class="fa fa-map"></i>
              </div>
              <a href="{{route('clients')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>


           <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$suppliercount}}</h3>

                <p>Supplier(s)</p>
              </div>
              <div class="icon">
                <i class="fa fa-store"></i>
              </div>
              <a href="{{route('supplier')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$usercount}}</h3>

                <p>Users</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="{{route('manageusers')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          <!-- ./col -->
        </div>

          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
        <div class="row">
                  <div class="col-12 col-sm-6 col-md-3">
              <a href="{{url('inbound/pending')}}" style="color: black;">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-download"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pending New Supply</span>
                <span class="info-box-number">{{$pendingInbound}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>

           <div class="col-12 col-sm-6 col-md-3">
              <a href="{{url('outbound/pending/list')}}" style="color: black;">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-undo"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pending Return Items</span>
                <span class="info-box-number">{{$pendingReturn}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>

                  <div class="col-12 col-sm-6 col-md-3">
              <a href="{{url('outbound/pending/list')}}" style="color: black;">
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-upload"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pending Outbound</span>
                <span class="info-box-number">{{$pendingOutbound}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>

                  <div class="col-12 col-sm-6 col-md-3">
              <a href="{{url('dispatch/pending/list')}}" style="color: black;">
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-truck"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pending Delivery</span>
                <span class="info-box-number">{{$pendingDelivery}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>

        </div>
        <div class="row">
          <div class="col-md-6">
                 <!-- DONUT CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Stocks Status Chart</h3>

                <div class="card-tools">
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button> -->
                 <!--  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                </div>
              </div>
              <div class="card-body">
                <canvas id="donutChart" style="min-height: 250px; height: 400px; max-height: 400px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>

          <div class="col-md-6">
                   <!-- BAR CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">{{ date('Y')}}</h3>

                <div class="card-tools">
                 <!--  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 400px; max-height: 400px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@include('layouts.foot')

<script>

$('#dashboardnav').addClass("active");

  let itemstocks = "{{json_encode($itemdata)}}"

    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'GOOD', 
          'WARNING', 
          'LOW',
          'NO STOCK', 
      ],
      datasets: [
        {
          data: JSON.parse(itemstocks),
          backgroundColor : ['#28A745', '#17A2B8', '#f39c12', '#DC3545'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions      
    })



    let inbounddata = "{{json_encode($Inbound_displayarray)}}"
    let outbounddata = "{{json_encode($Outbound_displayarray)}}"
    let dispatchdata = "{{json_encode($Dispatch_displayarray)}}"


    var areaChartData = {
      labels  : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul','Aug','Sep','Oct','Nov','Dec'],
      datasets: [
        {
          label               : 'Outbound',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : JSON.parse(outbounddata)
        },
        {
          label               : 'Inbound',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : JSON.parse(inbounddata)
        },
        {
          label               : 'Dispatch',
          backgroundColor     : 'rgba(52, 58, 64, 1)',
          borderColor         : 'rgba(52, 58, 64, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : JSON.parse(dispatchdata)
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

        var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false,
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: barChartData,
      options: barChartOptions
    })

</script>
@endsection

