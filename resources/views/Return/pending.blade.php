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
              <div class="card-header" style="background: mistyrose;">
               <h3 class="m-0 text-dark"><span class="fa fa-undo"></span> Pending Return Request</h3>

              </div>
              <div class="card-body">
                
                <table class="table table-striped table-condensed table-hover">
                    <thead> 
                      <tr>
                        <th>REF #</th>
                        <th>DATE</th>
                        <th>SITE</th>
                        <th>DELIVERY REF #</th>
                        <th>CREATED BY</th>

                      </tr>
                    </thead>

                    <tbody>
                      @foreach($viewModel->pendingList() as $return)
                      <tr>
                        <td><a href="{{url('return/pending/'.$return->id.'')}}"><span style="font-weight: bold">{{$return->refNo}}</span></a></td>
                        <td>{{date_format(date_create($return->datereturn),'M d, Y h:i a')}}</td>
                        <td>{{$return->client->name}}</td>
                        <td>{{$return->dispatch_refno}}</td>
                        <td>{{$return->user->name}}<br/><small>{{date_format(date_create($return->created_at),'M d, Y h:i a')}}</small></td>
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

$('#returnnav').addClass("active");
$('table').dataTable()
</script>
@endsection

