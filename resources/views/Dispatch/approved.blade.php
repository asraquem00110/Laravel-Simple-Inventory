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
               <h3 class="m-0 text-dark"><i class="fa fa-truck"></i> Delivery List</h3>

              </div>
              <div class="card-body">
           <form id="filterForm">
                        <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>DATE FROM</label>
                           <input type="date" class="form-control" name="datefrom" id="datefrom">
                           <p class="alert-danger errmsg" id="datefromerr"></p>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                          <label>DATE TO</label>
                          <input type="date" class="form-control" name="dateto" id="dateto">
                          <p class="alert-danger errmsg" id="datetoerr"></p>
                      </div>
                    </div>
                

                  <div class="col-md-4">
                      <div class="form-group">
                          <label>REFERENCE #</label>
                          <input type="text" class="form-control" name="refno" id="refno">
                          <p class="alert-danger errmsg" id="referr"></p>
                      </div>
                    </div>
                  </div>

                  <div class="row">

                  <div class="col-md-4">
                      <div class="form-group">
                          <label>CONTROL #</label>
                          <input type="text" class="form-control" name="controlno" id="controlno">
                          <p class="alert-danger errmsg" id="controlerr"></p>
                      </div>
                    </div>


                  <div class="col-md-4">
                      <div class="form-group">
                          <label>SITE</label>
                          <input type="text" class="form-control" name="client" id="client">
                         
                          <p class="alert-danger errmsg" id="clienterr"></p>
                      </div>
                    </div>

                     <div class="col-md-4">
                      <div class="form-group">
                        <label>&nbsp;</label>
                        <button onclick="filterProceed()" type="button" class="btn btn-primary form-control"><span class="fa fa-check"></span> PROCEED</button>
                      </div>
                    </div>

                  </div>

                 </form>
               
                 <table class="table table-bordered table-condensed table-striped" id="inboundDatatable">
                    <thead> 
                      <tr style="background: dimgray;color:white;">
                        <th>REFERENCE #</th>
                        <th>CONTROL #</th>
                        <th>CLIENT</th>
                        <th>DATE</th>
                     <!--    <th>DRIVER</th> -->
                        <th>RECEIVED BY</th>
                        <!-- <th>CHECKED BY</th> -->
                     <!--    <th>NOTED BY</th> -->
                        <th>CREATED BY</th>
                        <th>APPROVED BY</th>
                      </tr>
                    
                    </thead>
                    <tbody id="tdata">

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
function filterProceed(){

  let formdata = $('#filterForm').serialize()
  if(formdata == "datefrom=&dateto=&refno=&controlno=&client="){
      $('.errmsg').text("You need to fill up atleast one of this fields")
  }else{ 
      $('.errmsg').text("")
    $.ajax({
      url: '{{ url("getDeliveryData")}}?'+formdata+'',
      type: 'GET',
    }).then((res)=>{
      if(res.errors){
            $('#datetoerr').text(res.errors.dateto ? res.errors.dateto : "")
          } 
          if(res.dispatches.length == 0){
            $('#tdata').html(`<tr><td colspan="6">NO RECORDS FOUND!</td></tr>`)
          }else{
           let datadisplay = ""
            for(let x=0;x<res.dispatches.length;x++){
              datadisplay = datadisplay + `<tr>
              <td><a target="_new" href="{{url('dispatch/view')}}/${res.dispatches[x].id}">${res.dispatches[x].refNo}</a></td>
              <td>${res.dispatches[x].controlNo == null ? "" : res.dispatches[x].controlNo}</td>
              <td>${res.dispatches[x].clientname}</td>
              <td>${res.dispatches[x].date}</td>
              <td>${res.dispatches[x].receivedby == null ? "" : res.dispatches[x].receivedby}</td>
              <td>${res.dispatches[x].user.name}<br/><small>${res.dispatches[x].created_at}</small></td>
              <td>${res.dispatches[x].approvedby == null ? "" : res.dispatches[x].approvedby}<br/><small>${res.dispatches[x].ApprovedDateTime}</small></td>
              </tr>` 
            }
            $('#tdata').html(datadisplay)
          }
    })
  }

}
</script>
@endsection

