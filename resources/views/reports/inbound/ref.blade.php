@extends('layouts.index')


@section('MainContent')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">

            <h1 class="text-dark"> <i class="fa fa-download"></i> Inbound Daily Reports
            	<div class="float-right">
            		<a href="{{url('export/inbound/'.$field->datefrom.'/'.$field->dateto.'/'.$field->type.'')}}"><button type="button" class="btn btn-default"><span class="fa fa-file-excel" style="color: green;"></span><span style="color: green;"> Export Excel</span></button></a>
            		<a target="_blank" href="{{url('export/inboundPdf/'.$field->datefrom.'/'.$field->dateto.'/'.$field->type.'')}}"><button type="button" class="btn btn-default"><span class="fa fa-file-pdf" style="color: maroon;"></span> <span style="color: maroon;"> Print PDF</span></button></a>
            	</div>
            </h1>
            <span style="color: green;margin-left: 35px;">Cover from {{date_format(date_create($field->datefrom),'M d, Y')}} up to {{date_format(date_create($field->dateto),'M d, Y')}}</span>
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
            <div class="card">
             <!--  <div class="card-header bg-warning">
               <h3 class="m-0 text-white">&nbsp;</h3>

              </div> -->
              <div class="card-body">
              		<table class="table table-bordered table-condensed">

  						@foreach($viewModel->getDateRange($field->datefrom,$field->dateto) as $date)
               @if(count($viewModel->getInboundLogs($date))>0 || count($viewModel->getInboundsData($date)) > 0)
  							<tr style="background: dimgray;color: white;">
  								<td colspan="9">{{date_format(date_create($date),'M d, Y')}}</td>
  							</tr>
                  @foreach($viewModel->getInboundsData($date) as $ib)
                  <tr style="background: #F2F2F2">
                    <td colspan="1">{{$ib->refNo}}</td>
                    <td colspan="8">{{$ib->client->name}}</td>
                  </tr>
                  <tr style="background: #D7F8D7;">
                    <td>Product</td>
                    <td>Barcode</td>
                    <td>Serial</td>
                    <td>Specs/Description</td>
                    <td>Qty</td>
                    <td>Unit</td>
                    <td>Remarks</td>
                    <td>Created By</td>
                    <td>Approved By</td>
                  </tr>

                    @foreach($ib->temp as $item)
                            <tr>
                              
                              <td>{{$item->item->description}}</td>
                              <td>{{$item->itemList->barcode}}</td>
                              <td>{{$item->itemList->serialNumber}}</td>
                              <td>{{$item->itemList->description}}</td>
                              <td>{{$item->quantity}}</td>
                              <td>{{$item->item->unitMeasurement}}</td>
                              <td>{{$item->itemList->remarks}}</td>
                              <td>{{$ib->user->name}}<br/><small>{{date_format(date_create($ib->created_at),"M d, Y h:i a")}}</small></td>
                              <td>{{$ib->approvedBy}}<br/><small>{{date_format(date_create($ib->ApprovedDateTime),"M d, Y h:i a")}}</small></td>
                            </tr>

                    @endforeach


                @endforeach
                    @if(count($viewModel->getInboundLogs($date))>0)
                        <tr style="background: #F8F8E7;">
                          <td colspan="9">LOGS</td>
                        </tr>
                      <tr style="background: #D7F8D7;">
                        
                        <td>Product</td>
                        <td>Barcode</td>
                        <td>Serial</td>
                        <td>Specs/Description</td>
                        <td>Qty</td>
                        <td>Unit</td>
                        <td>Remarks</td>
                        <td>Modified By</td>
                        <td></td>


                      </tr>
                            @foreach($viewModel->getInboundLogs($date) as $log)
                              <tr>
                                
                                <td>{{$log->item->description}}</td>
                                <td>{{$log->itemlist->barcode}}</td>
                                <td>{{$log->itemlist->serialNumber}}</td>
                                <td>{{$log->itemlist->description}}</td>
                                <td>{{($log->newvalue - $log->oldvalue)}}</td>
                                <td>{{$log->item->unitMeasurement}}</td>
                                <td>{{$log->remarks}}</td>
                                <td>{{$log->modifiedby}}<br/><small>{{date_format(date_create($log->created_at),"M d, Y h:i a")}}</small></td>
                                <td></td>
                              </tr>
                              @endforeach
                       

                        @endif
                        <tr>
                          <td colspan="9"></td>
                        </tr>
                        @endif
  						@endforeach
  		
  					</table>
              </div>
            </div>

          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



@include('layouts.foot')

<script>

$('#reportnav').addClass("active");

</script>
@endsection

