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
          <div class="col-lg-8">
            <div class="card">
              <div class="card-header bg-warning">

               <h3 class="m-0 text-white">&nbsp;</h3>

              </div>
              <div class="card-body">
                @if(session::has('message') && strlen($message) != 0)
                <div class="alert alert-success" role="alert">
                    ALERT ALERT ALERT!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ session::forget('message')}}
                @endif
                <form method="POST" action="{{ route('saveclient')}}">
                    @csrf
                    <div class="form-group">
                      <label>NAME:</label>
                      <input type="text" class="form-control" name="" required>
                    </div>

                    <div class="form-group">
                      <label>ADDRESS:</label>
                      <input type="text" class="form-control" name="" required>
                    </div>

                    <div class="form-group">
                      <label>TIN:</label>
                      <input type="text" class="form-control" name="tin">
                       <span class="invalid-feedback" role="alert">
                            <strong>gg</strong>
                        </span>
                    </div>
                    
                       
                 
                    <a href="{{ route('clients')}}" class="btn btn-default float-left"><span class="fa fa-times"></span> CLOSE</a>
                    <button type="submit" class="btn btn-warning float-right text-white"><span class="fa fa-plus"></span> CREATE</button>
                </form>
                

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

$('#clientnav').addClass("active");

</script>
@endsection

