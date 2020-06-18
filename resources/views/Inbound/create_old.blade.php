@extends('layouts.index')


@section('MainContent')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark"> <i class="fa fa-plus"></i> Create Inbound Request</h1>
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
            <!--     <div class="card-header">
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
              </div> -->
              <div class="card-body">
                  
                  <form id="inboundcreate">
                    @csrf
                    <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>CLIENT NAME</label>
                          <select class="select2bs4 form-control" name="client" data-placeholder="Select a Client" data-dropdown-css-class="select2-purple" style="width: 100%;height: 100%;">
                              <option></option>
                              @foreach($viewModel->clients() as $client)
                              <option value="{{$client->id}}">{{$client->name}}</option>
                              @endforeach
                          </select>
                          <p class="alert-danger errmsg" id="clienterr"></p>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                          <label>DRIVER</label>
                          <input type="text" class="form-control" name="driver">
                          <p class="alert-danger errmsg" id="drivererr"></p>
                      </div>
                    </div>
                

                  <div class="col-md-4">
                      <div class="form-group">
                          <label>PLATE NO</label>
                          <input type="text" class="form-control" name="plateno">
                      </div>
                    </div>
                  </div>


                   <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>CONTAINER</label>
                           <input type="text" class="form-control" name="container">
                      </div>
                    </div>

                    <div class="col-md-4" style="display: none;">
                      <div class="form-group">
                          <label>REF NO</label>
                          <input type="text" class="form-control" name="refno">
                      </div>
                    </div>
                

                  <div class="col-md-4">
                      <div class="form-group">
                          <label>CONTROL NO</label>
                          <input type="text" class="form-control" name="controlno">
                      </div>
                    </div>

                       <div class="col-md-4">
                      <div class="form-group">
                          <label>ORIGIN</label>
                           <input type="text" class="form-control" name="origin">
                      </div>
                    </div>


                  </div>



                   <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>DATE</label>
                           <input type="date" class="form-control" name="refdate">
                           <p class="alert-danger errmsg" id="dateerr"></p>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                          <label>UNLOADING TIME</label>
                          <input type="time" class="form-control" name="unloadtime">
                          <p class="alert-danger errmsg" id="unloaderr"></p>
                      </div>
                    </div>
                

                  <div class="col-md-4">
                      <div class="form-group">
                          <label>TIME FINISHED</label>
                          <input type="time" class="form-control" name="finishtime">
                          <p class="alert-danger errmsg" id="finisherr"></p>
                      </div>
                    </div>
                  </div>



                   <div class="row">
                 

                    <div class="col-md-4">
                      <div class="form-group">
                          <label>RECEIVED BY</label>
                          <input type="text" class="form-control" name="rcvby">
                      </div>
                    </div>
                

                  <div class="col-md-4">
                      <div class="form-group">
                          <label>CHECKED BY</label>
                          <input type="text" class="form-control" name="chkby">
                      </div>
                    </div>

                        <div class="col-md-4">
                      <div class="form-group">
                          <label>NOTED BY</label>
                          <input type="text" class="form-control" name="notedby">
                      </div>
                    </div>

                  </div>

     

                  <div class="row">
                      <div class="col-md-12">
                          <table class="table table-striped">
                              <thead>
                                <tr style="text-align: left;background: #F8F8E7;">
                                  <th colspan="5"><span style="font-weight: bold;font-size: 14pt;">ITEMS</span><span style="display:none;margin-left: 20px;font-weight: normal;font-size: 12pt;">*Note: if item has barcode qty is the number of barcode that will generate else it is the exact value of measurement</span> <p class="alert-danger errmsg" id="itemerr"></p></th>
                                  <th style="text-align: right;"><button type="button" class="btn btn-default" id="showaddItem"><span class="fa fa-plus"></span> ADD ITEM</button></th>
                                </tr>
                                <tr>
                                  <th>DESCRIPTION</th>
                                  <th>CODE</th>
                                  <th>QTY</th>
                                <!--   <th>UOM</th> -->
                                  <th>REMARKS</th>
                                  <th>HAS BARCODE?</th>
                                  <th></th>
                                </tr>
                              </thead>

                              <tbody id="itemlistbody">
                               
                              </tbody>
                          </table>

                          <button type="button" onclick="createInbound()" class="btn btn-primary float-right"><span class="fa fa-check"></span> CREATE</button>

                      </div>

                  </div>

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



  <!-- MODALS -->


  <div class="modal" role="dialog" id="addItemModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
               </button>

          </div>

          <div class="modal-body">


              <table class="table table-striped" id="itemData">
                <thead>
                  <tr>
                    <th></th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Code</th>
                    <th>Unit of Measurement</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($viewModel->products() as $item)
                  <tr id="rowitem{{$item->id}}">
                    <td><input type="checkbox" data-des="{{$item->description}}" data-code="{{$item->productCode}}" data-unit="{{$item->unitMeasurement}}" class="itemaddchk form-control" id="chkitem{{$item->id}}" name="" value="{{ $item->id}}"></td>
                    <td><img src="{{asset('images/items').'/'.$item->img}}" style="height: 50px;width: 70px;" /></td>
                    <td>{{$item->description}}</td>
                    <td>{{$item->productCode}}</td>
                    <td>{{$item->unitMeasurement}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

          </div>

          <div class="modal-footer">
           
          </div>
        </div>

    </div>

  </div>


@include('layouts.foot')

<script>

$('#inboundnav').addClass("active");

$(document).on('click','#showaddItem',function(){
  
  $('#addItemModal').modal('show')
})

$("#itemData").dataTable();

let items = []


$(document).on('change','.itemaddchk',function(){
  let des = $(this).data('des')
  let code = $(this).data('code')
  let unit = $(this).data('unit')

  if(this.checked){
    //items.push({id: this.value, des: des,code: code,unit: unit})
     let  display = `<tr id="datarowitem${this.value}">
        <td><input type="hidden" name="item[]" value="${this.value}"/>${des}</td>
        <td>${code}</td>
        <td><input type="number" name="quantity[]" value="0" class="form-control"/></td>
        <td><input type="text" name="remarks[]" class="form-control"/></td>
        <td>    
              <select class="form-control" name="hasbarcode[]">
                <option value="off">NO</option>
                <option value="on">YES</option>
              </select>
            </td>
        <td><a data-id="${this.value}" class="removeitem_onlist" href="javascript:void(0)" style="color:maroon"><span class="fa fa-times"></span> Remove</a></td>
        </tr>`

      $("#itemlistbody").append(display)

  }else{
       $(`#datarowitem${this.value}`).remove()

  }

})

$(document).on('click','.removeitem_onlist',function(){
    $(`#datarowitem${$(this).data('id')}`).remove()
    $(`#chkitem${$(this).data('id')}`).prop("checked",false)

})

function clearinputerr(){
  $('#clienterr').text("")
  $('#drivererr').text("")
  $('#dateerr').text("")
  $('#unloaderr').text("")
  $('#finisherr').text("")
  $('#itemerr').text("")
}


function createInbound(){
    let url = "/createInbound"
    $.ajax({
      url: "{{url('')}}"+url,
      type: 'POST',
      data: $('#inboundcreate').serialize(),
      datatype: 'json',
      success:function(res){
          if(res.errors){
            $('#clienterr').text(res.errors.client ? res.errors.client : "")
            $('#drivererr').text(res.errors.driver ? res.errors.driver : "")
            $('#dateerr').text(res.errors.refdate ? res.errors.refdate : "")
            $('#unloaderr').text(res.errors.unloadtime ? res.errors.unloadtime : "")
            $('#finisherr').text(res.errors.finishtime ? res.errors.finishtime : "")
            $('#itemerr').text(res.errors.item ? "Choose Item(s)" : "")
          }else if(res.message){
            clearinputerr()
               swal({
                    title: `${res.message}!!`,
                    text: `Creating Inbound was ${res.message}!!`,
                    type: "success",
                    showCancelButton: false,
                    confirmButtonText: 'Ok!',
                    // cancelButtonText: "No!",
                    closeOnConfirm: true,
                    // closeOnCancel: true,
                 },function(isConfirm){
                    if(isConfirm){
                      window.location.href = window.location.href
                    }
                 })
          }
      } 
    })

}

</script>
@endsection

