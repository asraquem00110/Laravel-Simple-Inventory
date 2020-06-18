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
               <h3 class="m-0 text-dark"> <i class="fa fa-cubes"></i> Archived Item List</h3>

              </div>
              <div class="card-body">
  
                	
  
                  <table class="table table-striped" id="tableData">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th>Product Code</th>
                        <th>UOM</th>
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

$('#itemnav').addClass("active");
getList()

function getList(){
  $('#tableData').dataTable({
  'bProcessing': true,
  'sAjaxSource': '{{ url("getItemArchive")}}',
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
              let url = "/item/restore/"+id+""
              $.ajax({
                url: '{{url('')}}'+url+'',
                type: 'PATCH',
                data: {
                  '_token': $('input[name=_token]').val(),
                },
                datatype: 'json',
                success: function(res){
                      getList()
                        swal({
			                    title: "Item Restored!!",
			                    //text: "You will not be able to recover this imaginary file!",
			                    type: "success",
			                    showCancelButton: false,
			                    showConfirmButton: false,
			                    timer: 1000,
			                 })
                }
              })
        } 
     });
})
</script>
@endsection

