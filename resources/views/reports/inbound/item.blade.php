@extends('layouts.index')


@section('MainContent')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">

            <h1 class="text-dark"> <i class="fa fa-download"></i> Inbound Reports Per Items
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
              		
                      <table class="table table-bordered">
                        @foreach($items as $item)
                        @php $qty_total = 0 @endphp
                        <tr style="background: #F2F2F2;">
                          <td colspan="10">{{$item->description}} - {{$item->productCode}}</td>
                        </tr>
                          @if(count($viewModel->getInbound_PerItem($item->id,$field->datefrom,$field->dateto)) > 0)
                            <tr style="background: #D7F8D7;">
                           
                              <td>Date</td>
                              <td>IB RefNo</td>
                              <td>Site</td>
                              <td>Barcode</td>
                              <td>Serial</td>
                              <td>Specs/Description</td>
                              <td>Qty</td>
                              <td>Unit</td>
                              <td>Created By</td>
                              <td>Approved By</td>
                            </tr>

                            @foreach($viewModel->getInbound_PerItem($item->id,$field->datefrom,$field->dateto) as $ibitem)
                                <tr>
                                  
                                  <td>{{date_format(date_create($ibitem->unloadDate),'M d, Y')}}</td>
                                  <td>{{$ibitem->inbound->refNo}}</td>
                                  <td>{{$ibitem->inbound->client->name}}</td>
                                  <td>{{$ibitem->itemlist->barcode}}</td>
                                  <td>{{$ibitem->itemlist->serialNumber}}</td>
                                  <td>{{$ibitem->itemlist->description}}</td>
                                  <td>{{$ibitem->quantity}}</td>
                                  <td>{{$ibitem->item->unitMeasurement}}</td>
                                  <td>{{$ibitem->inbound->user->name}}<br/><small>{{date_format(date_create($ibitem->inbound->created_at),"M d, Y h:i a")}}</small></td>
                                  <td>{{$ibitem->inbound->approvedBy}}<br/><small>{{date_format(date_create($ibitem->inbound->ApprovedDateTime),"M d, Y h:i a")}}</small></td>
                                </tr>
                                  @php $qty_total += $ibitem->quantity; @endphp
                              @endforeach
                          @endif

                           @if(count($viewModel->getInboundsItem_Logs_PerItem($item->id,$field->datefrom,$field->dateto))>0)
                              <tr style="background: #F8F8E7;">
                              <td colspan="9">LOGS</td>
                             </tr>
                             <tr style="background: #D7F8D7;">
                             
                                <td>Date</td>
                                <td>IB RefNo</td>
                                <td>Site</td>
                                <td>Barcode</td>
                                <td>Serial</td>
                                <td>Specs/Description</td>
                                <td>Qty</td>
                                <td>Unit</td>
                                <td>Modified By</td>
                                <td></td>
                              </tr>

                              @foreach($viewModel->getInboundsItem_Logs_PerItem($item->id,$field->datefrom,$field->dateto) as $itemlog)
                                 <tr>
                               
                                  <td>{{date_format(date_create($itemlog->created_at),'M d, Y')}}</td>
                                  <td></td>
                                  <td></td>
                                  <td>{{$itemlog->itemlist->barcode}}</td>
                                  <td>{{$itemlog->itemlist->serialNumber}}</td>
                                  <td>{{$itemlog->itemlist->description}}</td>
                                  <td>{{$itemlog->newvalue - $itemlog->oldvalue}}</td>
                                  <td>{{$itemlog->item->unitMeasurement}}</td>
                                  <td>{{$itemlog->modifiedby}}<br/><small>{{date_format(date_create($itemlog->created_at),"M d, Y h:i a")}}</small></td>
                                  <td></td>
                                </tr>
                                 @php $qty_total += ($itemlog->newvalue - $itemlog->oldvalue); @endphp
                              @endforeach

                           @endif
                            <tr>
                              <td colspan="6" align="right">TOTAL</td>
                              <td style="background: mistyrose;color: dimgray;">{{$qty_total}}</td>
                              <td style="background: mistyrose;color: dimgray;">{{$item->unitMeasurement}}</td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td colspan="10"></td>
                            </tr>
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

