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
              <div class="card-header bg-danger" style="background: mistyrose !important;">
               <h3 class="m-0 text-dark"> <i class="fa fa-map-marked-alt"></i> Archived Site List</h3>

              </div>
              <div class="card-body">
  
                  <table class="table table-striped" id="tableData">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th></th>
                      </tr>
                    </thead>
                 
                 

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

$('#clientnav').addClass("active")

getList()

function getList(){
  $('#tableData').dataTable({
  'bProcessing': true,
  'sAjaxSource': '{{ url("getClientArchive")}}',
  'sAjaxDataProp': "data",
  'destroy': true,
//  'order': [[0,"asc"]],  
// 'lengthMenu': [[10,50,100,500,-1],[10,50,100,500,'ALL']],

});
}

$(document).on('click','.restoredata',function(){
  let id = $(this).data('id')
        swal({
        title: "Restore",
        text: "This data will go to active list",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: 'Yes!',
        cancelButtonText: "No!",
        closeOnConfirm: true,
        closeOnCancel: true,
     },
     function(isConfirm){

       if (isConfirm){
              let url = "/clients/archive/"+id+""
              $.ajax({
                url: '{{url('')}}'+url+'',
                type: 'PATCH',
                data: {
                  '_token': $('input[name=_token]').val(),
                  'status': 0,
                },
                datatype: 'json',
                success: function(res){
                      getList()
                }
              })
        } 
     });
})

</script>
@endsection

