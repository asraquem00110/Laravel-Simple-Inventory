@extends('layouts.index')


@section('MainContent')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark"> <i class="fa fa-file-excel"></i> Insert New Sites</h1>
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
             
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    @if ($message = Session::get('success'))
                      <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                              <strong>{{ $message }}</strong>
                      </div>
                      @endif


                      @if ($message = Session::get('error'))
                      <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                              <strong>{{ $message }}</strong>
                      </div>
                      @endif
                  <form method="POST" action="{{route('insertBulkSite')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="1">
                    <div class="form-group">
                      <label>EXCEL FILE:</label>
                      <input type="file" class="form-control" name="excelfile" required accept=".xlsx,.xls">
                    </div>

                     <div class="form-group">
                      <input type="submit" name="" value="Upload" class="btn btn-default">
                    </div>
                  </form>
                  </div>

                  <div class="col-md-6">
                    <a href="{{asset('excel/Supplier_format.xlsx')}}" class="btn btn-default float-right" style="color:green;">Download Excel Format For Bulk Upload</a>
                  </div>
                </div>
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

$('#itemnav').addClass("active");

</script>
@endsection

