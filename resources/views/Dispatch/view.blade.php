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
               <h3 class="m-0 text-dark"><i class="fa fa-truck"></i> REFERENCE # {{$viewModel->dispatch()->refNo}}</h3>

              </div>
              <div class="card-body">
            <div class="row">

                        <div class="col-md-12" style="text-align: center;background:#F2F2F2;padding: 10px;margin-bottom: 20px;">
                            <span style="font-weight: bold;font-size: 12pt;">DELIVERY RECEIPT</span>
                        </div>

                        <div class="col-md-4">

                             <div class="form-group">
                              <label>Delivered To</label>
                              <input type="text" name="" class="form-control" style="background: white !important;" readonly value="{{$viewModel->dispatch()->client->name}}">
                            </div>
                        </div>


                        <div class="col-md-4">

                              <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="" class="form-control" style="background: white !important;"  readonly value="{{$viewModel->dispatch()->address}}">
                      </div>
                        </div>


                        <div class="col-md-4">

                            <div class="form-group">
                          <label>Control No</label>
                          <input type="text" name="" class="form-control" readonly style="background: white !important;"  value="{{$viewModel->dispatch()->controlno}}">
                        </div>
                        </div>

                        <div class="col-md-4">
                           <div class="form-group">
                        <label>Date</label>
                        <input type="text" name="" class="form-control" readonly style="background: white !important;"  value="{{date_format(date_create($viewModel->dispatch()->date),'M d, Y')}}">
                      </div>

                        </div>

                         <div class="col-md-4">
                      <div class="form-group">
                        <label>Terms</label>
                        <input type="text" name="" class="form-control" readonly style="background: white !important;"  value="{{$viewModel->dispatch()->terms}}">
                      </div>
                    </div>



                      <div class="col-md-4">
                        <div class="form-group">
                        <label>Received By</label>
                        <input type="text" name="" class="form-control" readonly style="background: white !important;"  value="{{$viewModel->dispatch()->receivedby}}">
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
                      
                       <h3 class="m-0 text-dark">Summary <a target="_blank"  href="{{url('dispatch/view/'.$viewModel->dispatch()->id.'/summary')}}" class="btn btn-default float-right"><span class="fa fa-print"></span> Print</a></h3>
                    </div>
                    <div class="card-body">
                      <table class="table table-striped table-condensed table-hover">
                          <thead>
                              <th>QTY</th>
                              <th>UNIT</th>
                              <th>DESCRIPTION</th>
                            
                          </thead>

                          <tbody>
                              @foreach($viewModel->ItemsSummary() as $item)
                              <tr>
                                <td width="10%">{{$item->quantity}}</td>
                                <td><!-- {{$viewModel->itemInfo($item->item_id)->unitMeasurement}} -->{{$item->uom}}</td>
                                <td><span style="font-weight: bold;">{{$viewModel->itemInfo($item->item_id)->description}}</span> / {{$viewModel->itemInfo($item->item_id)->productCode}}</td>
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
                      
                       <h3 class="m-0 text-dark">Detailed <a target="_blank"  href="{{url('dispatch/view/'.$viewModel->dispatch()->id.'/detailed')}}" class="btn btn-default float-right"><span class="fa fa-print"></span> Print</a></h3>

                    </div>
                    <div class="card-body">

                  <table class="table table-condensed table-hover">
                          <thead>
                              <th>QTY</th>
                              <th>UNIT</th>
                              <th>DESCRIPTION</th>
                            
                          </thead>

                          <tbody>
                              @foreach($viewModel->ItemsSummary() as $item)
                              <tr>
                                <td width="10%">{{$item->quantity}}</td>
                                <td><!-- {{$viewModel->itemInfo($item->item_id)->unitMeasurement}} -->{{$item->uom}}</td>
                                <td><span style="font-weight: bold;">{{$viewModel->itemInfo($item->item_id)->description}}</span> / {{$viewModel->itemInfo($item->item_id)->productCode}}</td>
                              </tr>

                              @if($itemlist = $viewModel->getItemlist($item->item_id))

                                  @foreach($itemlist as $iteml)
                                    @if($iteml->itemlist_id == NULL)
                                       <tr style="background: #F2F2F2">
                                        <td></td>
                                        <td><small>{{$iteml->qty.' '.$iteml->uom}}</small></td>
                                        <td><small>DESCRIPTION: {{ $iteml->item->description}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BARCODE: none&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SERIAL NO: none</small></td>
                                      </tr>
                                    @else
                                      <tr style="background: #F8F8E7">
                                        <td></td>
                                        <td><small>{{$iteml->qty.' '.$iteml->uom}}</small></td>
                                        <td><small>DESCRIPTION: {{ $iteml->item->description}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BARCODE: {{$iteml->itemlist->barcode}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SERIAL NO: {{$iteml->itemlist->serialNumber}}</small></td>
                                      </tr>
                                    @endif
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

$('#dispatchnav').addClass("active");

</script>
@endsection

