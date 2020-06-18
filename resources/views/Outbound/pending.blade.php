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
              <div class="card-header" style="background: mistyrose">
               <h3 class="m-0 text-dark"><span class="fa fa-upload"></span> PENDING OUTBOUND REQUEST</h3>

              </div>
              <div class="card-body">
                    
                    <table class="table" id="outboundData">
                      <thead>
                        <tr>
                          <th>REFERENCE #</th>
                          <th>DATE</th>
                          <th>SITE</th>
                          <th>CREATED BY</th>
                        
                        </tr>
                      </thead>

                      <tbody>
                          @foreach($viewModel->pending() as $outbound)
                            <tr>
                                <td style="font-size: 14pt;"><a href="{{url('/outbound/pending/list/').'/'.$outbound->id}}">{{$outbound->refNo}}</a></td>
                                <td>{{date_format(date_create($outbound->loadDate),'M d, Y')}}</td>
                                <td>{{$outbound->client->name}}</td>
                                <td>{{$outbound->user->name}}<br/><small>{{date_format(date_create($outbound->created_at),'M d, Y h:i a')}}</small></td>
                               
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

$('#outboundnav').addClass("active");
$('#outboundData').dataTable()
</script>
@endsection

