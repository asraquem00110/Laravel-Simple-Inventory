@extends('layouts.index')


@section('MainContent')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">

            <h1 class="text-dark"> <i class="fa fa-upload"></i> Outbound Reports Per Items
            	<div class="float-right">
            		<button type="button" class="btn btn-default"><span class="fa fa-file-excel" style="color: green;"></span><span style="color: green;"> Export Excel</span></button>
            		<button type="button" class="btn btn-default"><span class="fa fa-file-pdf" style="color: maroon;"></span> <span style="color: maroon;"> Print PDF</span></button>
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
  					@if($dates = $viewModel->getOutbounds($field->datefrom,$field->dateto))
  						@foreach($dates as $date)
  							<tr style="background: dimgray;color: white;">
  								<td colspan="9">{{date_format(date_create($date->datecreated),'M d, Y')}}</td>
  							</tr>
                
                @foreach($viewModel->getOutboundsItem($date->datecreated) as $item)
                <tr>
                  <td colspan="9"><span style="font-weight: bold;">{{$item->item->description}} - </span> <small>{{$item->item->productCode}}</small></td>
                </tr>
                <tr>
                  <td></td>
                  <td>Ref No</td>
                  <td>Client</td>
                  <td>Barcode</td>
                  <td>Serial</td>
                  <td>Quantity</td>
                  <td>Unit</td>
                  <td>Prepared by</td>
                  <td>Approved by</td>
                </tr>

                @foreach($item->item->outbounditems as $obitem)
                  <tr>
                    <td></td>
                    <td>{{$obitem->outbound->refNo}}</td>
                    <td>{{$obitem->outbound->client->name}}</td>
                    <td>{{$obitem->itemlist->barcode}}</td>
                    <td>{{$obitem->itemlist->serialNumber}}</td>
                    <td>{{$obitem->quantity}}</td>
                    <td>{{$item->item->unitMeasurement}}</td>
                    <td>{{$obitem->outbound->preparedby}}</td>
                    <td>{{$obitem->outbound->approvedby}}</td>
                  </tr>
                @endforeach


                  @if(count($viewModel->getOutboundsItem_Logs($date->datecreated,$item->item_id))>0)
                  <tr>
                    <td colspan="9">LOGS</td>
                  </tr>
                  <tr>
                    <td colspan="3"></td>
                    <td>Barcode</td>
                    <td>Serial</td>
                    <td>Qty</td>
                    <td>Unit</td>
                    <td>Remarks</td>
                    <td>Modified By</td>
                  </tr>
                      @foreach($viewModel->getOutboundsItem_Logs($date->datecreated,$item->item_id) as $log)
                      <tr>
                        <td colspan="3"></td>
                        <td>{{$log->itemlist->barcode}}</td>
                        <td>{{$log->itemlist->serialNumber}}</td>
                        <td>{{($log->oldvalue - $log->newvalue)}}</td>
                        <td>{{$log->item->unitMeasurement}}</td>
                        <td>{{$log->remarks}}</td>
                        <td>{{$log->modifiedby}}</td>
                      </tr>
                      @endforeach
                  @endif
                @endforeach

  						@endforeach
  					@endif
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

