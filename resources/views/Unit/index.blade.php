@extends('layouts.index')


@section('MainContent')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark"> <i class="fa fa-cog"></i> Unit of Measurement</h1>
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
              <div class="card-header bg-success">
               <h3 class="m-0 text-dark"><span class="text-white"><i class="fa fa-check"></i>  Active List</span><a href="javascript:void(0)" data-toggle="modal" data-target="#AddModal" class="btn btn-default float-right"><span class="fa fa-plus"></span> CREATE</a></h3>

              </div>
              <div class="card-body">
                
                  <table class="table tabledata">
                      <thead>
                          <tr>
                            <th>#</th>
                            <th>Description</th>
                            <th></th>
                            <th></th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php $x=1;?>
                        @foreach($viewModel->units() as $unit)
                          <tr>
                            <td>{{$x++}}</td>
                            <td>{!!$unit->unit!!}</td>
                            <td><a style="color: green;" href="javascript:void(0)"
                              data-id="{{ $unit->id }}"
                              data-unit="{{$unit->unit}}"
                              class="editdata" 
                              ><span class="fa fa-edit"></span> 
                              Edit</a></td>
                            <td><a style="color: maroon;" href="javascript:void(0)"
                              data-id="{{ $unit->id }}"
                              class="archivedata" 
                              ><span class="fa fa-trash"></span> 
                              Archive</a></td>
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
        <hr/>
        <div class="row">


               <!-- /.col-md-12 -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header bg-danger" style="background: mistyrose !important;">
               <h3 class="m-0 text-white"><span class="text-dark"> <i class="fa fa-trash"></i> Archive List</span></h3>

              </div>
              <div class="card-body">
                
                  <table class="table tabledata">
                      <thead>
                          <tr>
                            <th>#</th>
                            <th>Description</th>
                            <th></th>
                            <th></th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php $x=1;?>
                        @foreach($viewModel->archive() as $unit)
                          <tr>
                            <td>{{$x++}}</td>
                            <td>{{$unit->unit}}</td>
                            <td></td>
                            <td><a href="javascript:void(0)"
                              data-id="{{ $unit->id }}"
                              class="restoredata" 
                              >
                              Restore</a></td>
                          </tr>
                        @endforeach

                      </tbody>
                  </table>
                
              </div>
            </div>

          </div>
          <!-- /.col-md-6 -->

        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@include('Unit.modals')

@include('layouts.foot')

<script>

$('#settingsnav').addClass("active");

// $('#tabledata,#tabledata2').dataTable();

$('.tabledata').dataTable();

$(document).on('click','.editdata',function(){
  let unit = $(this).data('unit')
  let id = $(this).data('id')
  $("#unitID").val(id)
  $('#newunit').val(unit)
  $('#EditModal').modal('show')
});

function updateUnit(){
  $.ajax({
    url: '{{route("updateUnit")}}',
    type: 'PATCH',
    data: $('#editForm').serialize(),
    datatype: 'json',
    success: function(res){
      if(res.errors){
        $('#edituniterr').text(res.errors.unit ? res.errors.unit : "")
      }

      if(res.message == "success"){
            swal({
                    title: "Updated Successfully!!",
                    //text: "You will not be able to recover this imaginary file!",
                    type: "success",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1500,
                 })

            setTimeout(()=>{
              window.location.href = window.location.href
            },1500)
      }else if(res.message == "fail"){
         swal({
                    title: "Something Went Wrong!!",
                    //text: "You will not be able to recover this imaginary file!",
                    type: "error",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1500,
                 })
      }
    }
  })

}



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
              let url = "/unit/archive/"+id+""
              $.ajax({
                url: '{{url('')}}'+url+'',
                type: 'PATCH',
                data: {
                  '_token': $('input[name=_token]').val(),
                  'status': 1,
                },
                datatype: 'json',
                success: function(res){
                      window.location.href = window.location.href
                }
              })
        } 
     });
})


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
              let url = "/unit/archive/"+id+""
              $.ajax({
                url: '{{url('')}}'+url+'',
                type: 'PATCH',
                data: {
                  '_token': $('input[name=_token]').val(),
                  'status': 0,
                },
                datatype: 'json',
                success: function(res){
                      window.location.href = window.location.href
                }
              })
        } 
     });
})




</script>
@endsection

