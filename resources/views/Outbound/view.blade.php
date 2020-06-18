@extends('layouts.index')


@section('MainContent')

  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
    
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
         
          <!-- /.col-md-12 -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header bg-default">
               <h3 class="m-0 text-dark"><i class="fa fa-upload"></i> REFERENCE # {{$viewModel->outbound()->refNo}}</h3>

              </div>
              <div class="card-body">
            <div class="row">

                        <div class="col-md-12" style="text-align: center;background:#F2F2F2;padding: 10px;margin-bottom: 20px;">
                            <span style="font-weight: bold;font-size: 12pt;">OUTBOUND RECEIPT</span>
                        </div>

                        <div class="col-md-3">

                             <div class="form-group">
                              <label>Client</label>
                              <input type="text" name="" class="form-control" style="background: white !important;" readonly value="{{$viewModel->outbound()->client->name}}">
                            </div>
                        </div>


                        <div class="col-md-3">

                              <div class="form-group">
                        <label>Driver</label>
                        <input type="text" name="" class="form-control" style="background: white !important;"  readonly value="{{$viewModel->outbound()->driver}}">
                      </div>
                        </div>


                        <div class="col-md-3">

                            <div class="form-group">
                          <label>Plate No</label>
                          <input type="text" name="" class="form-control" readonly style="background: white !important;"  value="{{$viewModel->outbound()->plateNo}}">
                        </div>
                        </div>

                        <div class="col-md-3">
                           <div class="form-group">
                        <label>Container</label>
                        <input type="text" name="" class="form-control" readonly style="background: white !important;"  value="{{$viewModel->outbound()->container}}">
                      </div>

                        </div>

                         <div class="col-md-3">
                      <div class="form-group">
                        <label>Control No</label>
                        <input type="text" name="" class="form-control" readonly style="background: white !important;"  value="{{$viewModel->outbound()->controlNo}}">
                      </div>
                    </div>



                      <div class="col-md-3">
                        <div class="form-group">
                        <label>Date</label>
                        <input type="text" name="" class="form-control" readonly style="background: white !important;"  value="{{date_format(date_create($viewModel->outbound()->loadDate),'M d, Y')}}">
                      </div>

                    </div>

                     <div class="col-md-3">
                      <div class="form-group">
                        <label>Unload Start Time</label>
                        <input type="text" name="" class="form-control" readonly style="background: white !important;"  value="{{date_format(date_create($viewModel->outbound()->loadTime),'h:i a')}}">
                      </div>
                    </div>

                           <div class="col-md-3">
                        <div class="form-group">
                        <label>Unload Finish Time</label>
                        <input type="text" name="" class="form-control" readonly style="background: white !important;"  value="{{date_format(date_create($viewModel->outbound()-> finishloadTime),'h:i a')}}">
                      </div>

                    </div>

          

                        <div class="col-md-3">
                        <div class="form-group">
                        <label>Prepared By</label>
                        <input type="text" name="" class="form-control" readonly style="background: white !important;"  value="{{$viewModel->outbound()->preparedby}}">
                         <span style="margin-left: 2px;">Date Created: {{date_format(date_create($viewModel->outbound()->created_at),'M d, Y h:i a')}}</span>
                      </div>

                    </div>


                        <div class="col-md-3">
                        <div class="form-group">
                        <label>Approved By</label>
                        <input type="text" name="" class="form-control" readonly style="background: white !important;"  value="{{$viewModel->outbound()->approvedby}}">
                        <span style="margin-left: 2px;">Date Approved: {{date_format(date_create($viewModel->outbound()->ApprovedDateTime),'M d, Y h:i a')}}</span>
                      </div>

                    </div>


                     <div class="col-md-3">
                      <div class="form-group">
                        <label>Received By</label>
                        <input type="text" name="" class="form-control" readonly style="background: white !important;"  value="{{$viewModel->outbound()->receivedby}}">
                      </div>
                    </div>

                       <div class="col-md-3">
                      <div class="form-group">
                        <label>Checked By</label>
                        <input type="text" name="" class="form-control" readonly style="background: white !important;"  value="{{$viewModel->outbound()->checkedby}}">
                      </div>
                    </div>


                </div>

              </div>
            </div>

          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->



            <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      
                       <h3 class="m-0 text-dark">Summary <a target="_blank"  href="{{url('outbound/view/'.$viewModel->outbound()->id.'/summary')}}" class="btn btn-default float-right"><span class="fa fa-print"></span> Print</a></h3>
                    </div>
                    <div class="card-body">

                       <table class="table table-condensed">
                        <thead>
                   
                            <tr>
                              <th>DESCRIPTION</th>
                              <th>ITEM CODE</th>
                              <th>QTY</th>
                              <th>UOM</th>
                            
                            </tr>
                        </thead>

                        <tbody>
                          @foreach($viewModel->outboundItemsSummary() as $item)
                          <tr>
                            <td>{{$item->item->description}}</td>
                            <td>{{$item->item->productCode}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->item->unitMeasurement}}</td>
                          </tr>
                          @endforeach
                        </tbody>

                      </table>

                    </div>
                </div>

            </div>

        </div>


              <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      
                       <h3 class="m-0 text-dark">Detailed <a target="_blank"  href="{{url('outbound/view/'.$viewModel->outbound()->id.'/detailed')}}" class="btn btn-default float-right"><span class="fa fa-print"></span> Print</a></h3>
                    </div>
                    <div class="card-body">

                       <table class="table table-condensed">
                        <thead>
                   
                            <tr>
                              <th>DESCRIPTION</th>
                              <th>ITEM CODE</th>
                              <th>QTY</th>
                              <th>UOM</th>
                              <th></th>
                            </tr>
                        </thead>

                        <tbody>
                          @foreach($viewModel->outboundItemsSummary() as $item)
                          <tr>
                            <td>{{$item->item->description}}</td>
                            <td>{{$item->item->productCode}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->item->unitMeasurement}}</td>
                           <td></td>
                             
                          </tr>

                          @if($item->item->outbounditems[0]->itemlist->freeStorage == 0)
                            <tr style="background: #F8F8E7">  
                                  <td><span style="font-size:8pt;margin-left: 30px;font-weight: bold;">Barcode</span></td>
                                  <td><span style="font-size:8pt;font-weight: bold;">SerialNumber</span></td>
                                  <td><span style="font-size:8pt;font-weight: bold;">Description</span></td>
                                  <td><span style="font-size:8pt;font-weight: bold;">Qty</span></td>
                                  <td><span style="font-size:8pt;font-weight: bold;">Remarks</span></td>
                                </tr>
                              @foreach($viewModel->getOutboundItems($item->item_id,$viewModel->outbound()->id) as $item)
                                    <tr>
                                    <td><span style="font-size: 8pt;margin-left: 30px;">{{$item->itemlist->barcode}}</span></td>
                                    <td><span style="font-size: 8pt;">{{$item->itemlist->serialNumber}}</span></td>
                                    <td><span style="font-size: 8pt;">{{$item->item->description}}</span></td>
                                    <td><span style="font-size: 8pt;">{{$item->quantity.' '.$item->item->unitMeasurement}}</span></td>
                                    <td><span style="font-size: 8pt;">{{$item->remarks}}</span></td>
                                  </tr>

                              @endforeach

                          @endif
                          @endforeach
                        </tbody>

                      </table>

                    </div>
                </div>

            </div>

        </div>




      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@include('layouts.foot')

<script>

$('#outboundnav').addClass("active");

</script>
@endsection

