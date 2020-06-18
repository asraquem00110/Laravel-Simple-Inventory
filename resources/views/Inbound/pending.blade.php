@extends('layouts.index')


@section('MainContent')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      
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
              <div class="card-header bg-warning" style="background: mistyrose !important;">
               <h3 class="m-0 text-dark"><i class="fa fa-download"></i> Pending New Supply Inbound</h3>

              </div>
              <div class="card-body">
                  
                  <table class="table table-striped" id="pendingData">
                      <thead>
                        <tr>
                       
                          <th>REFERENCE #</th>
                          <th>SUPPLIER</th>
                          <th>CONTROL #</th>
                          <th>DATE</th>
                          <th>CREATED BY</th>
                        
                        </tr>
                      </thead>

                      <tbody>
                        <?php $x=1;?>
                        @foreach($inbounds as $inbound)
                        <tr>
                        
                          <td style="font-size: 14pt;"><a href="{{ url('inbound/pending/'.$inbound->id.'') }}">{{$inbound->refNo}}</a></td>
                          <td>{{$inbound->client->name}}</td>
                          <td>{{$inbound->controlNo}}</td>
                          <td>{{ date_format(date_create($inbound->unloadDate),'M d,   Y')}}</td>
                          <td>{{ $inbound->user->name}}<br/><small>{{date_format(date_create($inbound->created_at),'M d, Y h:i a')}}</small></td>
                       
                        </tr>
                        @endforeach

                      </tbody>


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

$('#inboundnav').addClass("active");

$('#pendingData').dataTable();

</script>
@endsection

