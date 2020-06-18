@extends('layouts.index')


@section('MainContent')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">

            <h1 class="text-dark"> <i class="fa fa-truck"></i> Delivery Reports Per Sites
            	<div class="float-right">
            		<a href="{{url('export/delivery/'.$field->datefrom.'/'.$field->dateto.'/'.$field->type.'')}}"><button type="button" class="btn btn-default"><span class="fa fa-file-excel" style="color: green;"></span><span style="color: green;"> Export Excel</span></button></a>
            		<a target="_blank" href="{{url('export/deliveryPdf/'.$field->datefrom.'/'.$field->dateto.'/'.$field->type.'')}}"><button type="button" class="btn btn-default"><span class="fa fa-file-pdf" style="color: maroon;"></span> <span style="color: maroon;"> Print PDF</span></button></a>
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

             	    
                    @foreach($sites as $site)
                      <tr style="background: #F2F2F2;">
                        <td colspan="11">{{$site->name}}</td>
                      </tr>
                             @if(count($viewModel->getDelivery_PerSite($site->id,$field->datefrom,$field->dateto))>0)
                                 <tr style="background: #D7F8D7;">
                                    
                                    <td>Date</td>
                                    <td>DI RefNo</td>
                                    <td>Item</td>
                                    <td>ProductCode</td>
                                    <td>Barcode</td>
                                    <td>Serial</td>
                                    <td>Specs/Description</td>
                                    <td>Qty</td>
                                    <td>Unit</td>
                                    <td>Created By</td>
                                    <td>Approved By</td>
                                  </tr>

                                   @foreach($viewModel->getDelivery_PerSite($site->id,$field->datefrom,$field->dateto) as $dispatch)
                                      @foreach($dispatch->item as $diitem)
                                          <tr>
                                           
                                            <td>{{date_format(date_create($dispatch->date),'M d, Y')}}</td>
                                            <td>{{$dispatch->refNo}}</td>
                                            <td>{{$diitem->description}}</td>
                                            <td>{{$diitem->productCode}}</td>
                                            @if($diitem->pivot->itemlist_id == NULL)
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            @else
                                            @php $dispatchdata = $viewModel->getItemlistInfo($dispatch->id,$diitem->pivot->itemlist_id); @endphp
                                            <td>{{$dispatchdata->itemlist->barcode}}</td>
                                            <td>{{$dispatchdata->itemlist->serialNumber}}</td>
                                            <td>{{$dispatchdata->itemlist->description}}</td>

                                            @endif
                                            <td>{{$diitem->pivot->qty}}</td>
                                            <td>{{$diitem->pivot->uom}}</td>
                                            <td>{{$dispatch->user->name}}<br/><small>{{date_format(date_create($dispatch->created_at),"M d, Y h:i a")}}</small></td>
                                             <td>{{$dispatch->approvedby}}<br/><small>{{date_format(date_create($dispatch->ApprovedDateTime),"M d, Y h:i a")}}</small></td>
                                          </tr>

                                      @endforeach
                                    @endforeach


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

