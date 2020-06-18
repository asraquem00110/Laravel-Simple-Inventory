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
               <h3 class="m-0 text-dark"><i class="fa fa-undo"></i> REFERENCE # {{$viewModel->getReturn()->refNo}}</h3>

              </div>
              <div class="card-body">
                     
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Site</label>
                          <input type="text" class="form-control" name="" value="{{$viewModel->getReturn()->client->name}}" readonly style="background: white;">
                           <p class="alert-danger errmsg" id="clienterr"></p>
                          </div>

                        </div>

                         <div class="col-md-4">
                          <div class="form-group">
                            <label>Date Return</label>
                            <input type="text" class="form-control" name="date" value="{{date_format(date_create($viewModel->getReturn()->datereturn),'M d, Y')}}" readonly style="background: white;">
                             <p class="alert-danger errmsg" id="dateerr"></p>
                          </div>
                        </div>

                          <div class="col-md-4">
                          <div class="form-group">
                            <label>Delivery RefNo</label>
                            <input type="text" class="form-control" name="refno" value="{{$viewModel->getReturn()->dispatch_refno}}" readonly style="background: white;">
                             <p class="alert-danger errmsg" id="refnoerr"></p>
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
                      
                       <h3 class="m-0 text-dark">Summary <a target="_blank"  href="{{url('return/view/'.$viewModel->getReturn()->id.'/summary')}}" class="btn btn-default float-right"><span class="fa fa-print"></span> Print</a></h3>
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
                          @foreach($viewModel->ItemsSummary() as $item)
                          @php $iteminfo = $viewModel->itemInfo($item->item_id); @endphp
                          <tr>
                            <td>{{$iteminfo->description}}</td>
                            <td>{{$iteminfo->productCode}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->uom}}</td>
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
                      
                       <h3 class="m-0 text-dark">Detailed <a target="_blank"  href="{{url('return/view/'.$viewModel->getReturn()->id.'/detailed')}}" class="btn btn-default float-right"><span class="fa fa-print"></span> Print</a></h3>

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
                          @foreach($viewModel->ItemsSummary() as $item)
                          @php $iteminfo = $viewModel->itemInfo($item->item_id); @endphp
                          <tr>
                            <td>{{$iteminfo->description}}</td>
                            <td>{{$iteminfo->productCode}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->uom}}</td>
                          </tr>

                               <tr style="background: #F8F8E7">  
                                  <td><span style="font-size:8pt;margin-left: 30px;font-weight: bold;">Barcode</span></td>
                                  <td><span style="font-size:8pt;font-weight: bold;">SerialNumber</span></td>
                                  <td><span style="font-size:8pt;font-weight: bold;">Description</span></td>
                                  <td><span style="font-size:8pt;font-weight: bold;">Qty</span></td>
                                  <td><span style="font-size:8pt;font-weight: bold;">Remarks</span></td>
                                </tr>

                              @foreach($viewModel->getReturnItems($item->item_id,$viewModel->getReturn()->id) as $item)
                                    <tr>
                                    <td><span style="font-size: 8pt;margin-left: 30px;">{{$item->itemlist->barcode}}</span></td>
                                    <td><span style="font-size: 8pt;">{{$item->itemlist->serialNumber}}</span></td>
                                    <td><span style="font-size: 8pt;">{{$item->item->description}}</span></td>
                                    <td><span style="font-size: 8pt;">{{$item->qty.' '.$item->item->unitMeasurement}}</span></td>
                                    <td><span style="font-size: 8pt;">{{$item->remarks}}</span></td>
                                  </tr>

                              @endforeach
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

$('#returnnav').addClass("active");

</script>
@endsection

