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
               <h3 class="m-0 text-dark"><span class="fa fa-truck"></span> PENDING DELIVERY REQUEST</h3>

              </div>
              <div class="card-body">
                    
                    <table class="table" id="dispatchData">
                      <thead>
                        <tr>
                          <th>REFERENCE #</th>
                          <th>DATE</th>
                          <th>SITE</th>
                          <th>CREATED BY</th>
                        
                        </tr>
                      </thead>

                      <tbody>
                        @foreach($viewModel->pendingDispatch() as $dispatch)
                        <tr>
                          <td><a href="{{url('/dispatch/pending/list/').'/'.$dispatch->id}}">{{$dispatch->refNo}}</a></td>
                          <td>{{date_format(date_create($dispatch->loadDate),'M d, Y')}}</td>
                          <td>{{$dispatch->client->name}}</td>
                          <td>{{$dispatch->user->name}}<br/><small>{{date_format(date_create($dispatch->created_at),'M d, Y h:i a')}}</small></td>
                        

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

$('#dispatchnav').addClass("active");
$('#dispatchData').dataTable()
</script>
@endsection

