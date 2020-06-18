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
               <h3 class="m-0 text-dark"> <i class="fa fa-store"></i> Supplier List <a href="javascript:void(0)" data-toggle="modal" data-target="#AddModal" class="btn btn-default float-right"><span class="fa fa-plus"></span> CREATE</a></h3>

              </div>
              <div class="card-body">
  
                  <table class="table table-striped" id="tableData">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Address</th>
                      <!--   <th>TIN</th> -->
                        <th></th>
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

@include('supplier.modals')

@include('layouts.foot')

<script>

$('#suppliernav').addClass("active")

getList()

function getList(){
  $('#tableData').dataTable({
  'bProcessing': true,
  'sAjaxSource': '{{ url("getSupplierDate")}}',
  'sAjaxDataProp': "data",
  'destroy': true,
//  'order': [[0,"asc"]],  
// 'lengthMenu': [[10,50,100,500,-1],[10,50,100,500,'ALL']],

});
}



$(document).on('click','#savebtn',function(){
  $.ajax({
    url: '{{ route("saveclient")}}',
    type: 'POST',
    data: $('#addform').serialize(),
    datatype: 'json',
    success:function(res){
      if(res.errors){
        $('#clienterr').text(res.errors.client ? res.errors.client : "")
        $('#adderr').text(res.errors.address ? res.errors.address : "")
        $('#tinerr').text(res.errors.tin ? res.errors.tin : "")
      }else{
       getList()
       $('#AddModal').modal('hide')
      }
    }
  })

})


$(document).on('click','.editdata',function(){
  $('#EditModal').modal('show')
  $('#edit_client').val($(this).data('name'))
  $('#edit_address').val($(this).data('address'))
  $("#edit_tin").val($(this).data('tin'))
  $('#clientid').val($(this).data('id'))
})


$(document).on('click','#updatebtn',function(){
  $.ajax({
    url: '{{ route("updateclient")}}',
    type: 'PATCH',
    data: $('#editform').serialize(),
    datatype: 'json',
    success:function(res){
      if(res.errors){
        $('#edit_clienterr').text(res.errors.client ? res.errors.client : "")
        $('#edit_adderr').text(res.errors.address ? res.errors.address : "")
        $('#edit_tinerr').text(res.errors.tin ? res.errors.tin : "")
      }else{
        getList()
        $('#EditModal').modal('hide')
      }
    }
  })

})

$(document).on('click','.archivedata',function(){
  let id = $(this).data('id')
        swal({
        title: "Archive",
        text: "This data will go to archive list",
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
                  'status': 1,
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

