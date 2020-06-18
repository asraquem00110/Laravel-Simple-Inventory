@extends('layouts.index')


@section('MainContent')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark"> <i class="fa fa-plus"></i> Create New Supply Inbound Form</h1>
            
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
                  
                  <form id="inboundcreate">
                    @csrf
                    <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>SUPPLIER</label>
                          <select class="select2bs4 form-control" name="client" data-placeholder="Select Supplier" data-dropdown-css-class="select2-purple" style="width: 100%;height: 100%;">
                              <option></option>
                              @foreach($viewModel->clients() as $client)
                              @if($client->type==1) 
                              <option value="{{$client->id}}">{{$client->name}}</option>
                                @endif
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
                          <table class="table table-striped" id="itemlisttable">
                              <thead>
                                <tr style="text-align: left;background: #F8F8E7;">
                                  <th colspan="5"><span style="font-weight: bold;font-size: 14pt;">ITEMS</span><span style="display:none;margin-left: 20px;font-weight: normal;font-size: 12pt;">*Note: if item has barcode qty is the number of barcode that will generate else it is the exact value of measurement</span> <p class="alert-danger errmsg" id="itemerr"></p></th>
                                  <th style="text-align: right;"><button type="button" class="btn btn-default" id="showaddItem"><span class="fa fa-plus"></span> ADD ITEM</button></th>
                                </tr>
                                <tr>
                                  <th>DESCRIPTION</th>
                                  <th>CODE</th>
                                  <th>BARCODE QTY</th>
                                  <th>UOM</th>
                                  <th>REMARKS</th>
                                  <th></th>
                                </tr>
                              </thead>

                              <tbody id="itemlistbody">
                               
                              </tbody>
                          </table>

                          <button type="button" id="saveButton" onclick="createInbound()" class="btn btn-primary float-right"><span class="fa fa-check"></span> CREATE</button>

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


  <div class="modal" role="dialog" id="addItemModal" data-backdrop="static" data-keyboard="false">
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
                    <td><button data-des="{{$item->description}}" data-id="{{$item->id}}" data-code="{{$item->productCode}}" data-unit="{{$item->unitMeasurement}}" class="btn btn-default selectitem" type="button">Select</button></td>
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


    <div class="modal" role="dialog" id="ItemModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
               </button>

          </div>

          <div class="modal-body">
              <form>
                <input type="hidden" id="itemid" name="">
                <div class="row">
                  <div class="col-md-6">
                <div class="form-group">
                  <label>Description</label>
                  <input type="text" class="form-control" id="des" readonly style="background: white;">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Product Code</label>
                  <input type="text" class="form-control" id="code" readonly style="background: white;">
                </div>
              </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                     <div class="form-group">
                  <label>Unit of Measurement</label>
                  <input type="text" class="form-control" id="uom" readonly style="background: white;">
                </div>
              </div>

               <div class="col-md-3" style="display: none;">
                  <div class="form-group">
                 <label>HAS BARCODE</label>
                <select class="form-control" id="hasbarcode" >
                  <option>YES</option>
                  <option>NO</option>
                </select>
                </div>
              </div>

                    <div class="col-md-6">
                  <div class="form-group">
                 <label>Quantity of Barcode</label>
                  <input type="number" class="form-control" id="quantity">
                </div>
              </div>

              </div>

              

                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Quantity</th>
                      <th>UOM</th>
                    </tr>
                  </thead>
                  <tbody id="tbodyItemList">

                  </tbody>
                </table>


                <button type="button" class="btn btn-default float-left" data-dismiss="modal">Back</button>
              <button type="button" class="btn btn-success float-right" disabled id="addItembtn">Add</button>
            </form>
          </div>

          <div class="modal-footer">
        
          </div>
        </div>

    </div>

  </div>



@include('layouts.foot')

<script>

// $(document).on('keyup','#quantity',function(){

//   let quantity = $('#quantity').val()

//   if(quantity <= 0){
//       $('#addItembtn').attr('disabled',true)
//         $('#quantity').addClass('is-invalid')
//   }else{
//     $('#addItembtn').removeAttr('disabled')
//         $('#quantity').removeClass('is-invalid')
//     let items = ""
//     for(let x =0 ; x< quantity; x++){
//       items = items + `<tr id="item${x}">
//       <td>BARCODE ${(x + 1)}</td>
//       <td><input type="number" class="form-control itemqty" value="1"/></td>
//       <td>${$('#uom').val()}</td>
//       </tr>`
//     }

//     $('#tbodyItemList').html(items)
//   }
// })



$(document).on('keyup change','#quantity',function(){
displaydata()
})

$(document).on('change','#hasbarcode',function(){
  displaydata()
})

function displaydata(){
    let quantity = $('#quantity').val()

  if(quantity <= 0){
      $('#addItembtn').attr('disabled',true)
        $('#quantity').addClass('is-invalid')
  }else{
    $('#addItembtn').removeAttr('disabled')
        $('#quantity').removeClass('is-invalid')
    let items = ""

    if($('#hasbarcode').val() == "YES"){
          for(let x =0 ; x< quantity; x++){
            items = items + `<tr id="item${x}">
            <td>BARCODE</td>
            <td><input type="number" class="form-control itemqty" value="1"/></td>
            <td>${$('#uom').val()}</td>
            </tr>`
          }   
    }else{
         items = items + `<tr>
            <td>1</td>
            <td><input type="number" class="form-control itemqty" value="${$('#quantity').val()}"/></td>
            <td>${$('#uom').val()}</td>
            </tr>`
    }


    $('#tbodyItemList').html(items)
  }
}

function validate(){
     let itemqty = $('.itemqty')
     let invalid = ""
  for(let x = 0 ; x < itemqty.length ; x++){

      if(itemqty[x].value <= 0){
        $(`#item${x}`).css('border','3px solid maroon')
        invalid = 1
      }else{
         $(`#item${x}`).css('border','none')

      }

  }

  if(invalid == 1){
       $('#addItembtn').attr('disabled',true)
  }else{
        $('#addItembtn').removeAttr('disabled')
  }
}


$(document).on('click','.itemcart',function(){
  let id = $(this).data('id')
  if(this.value <= 0){
      $(`#item_${id}`).css('border','5px solid red')
  }else{
      $(`#item_${id}`).css('border','none')
  }

  validate2()
})


function validate2(){
  let items = $('.itemcart')

  for(let x = 0 ; x < items.length ; x++){
      if(items[x].value <= 0){
        $('#saveButton').attr('disabled','true')
          break
      }else{
          $('#saveButton').removeAttr('disabled')
      }
  }
}


$(document).on('keyup change','.itemqty',function(){
validate()
})

let itemlist = [];

$(document).on('click','.additemonlist',function(){
  let itemid = $(this).data('id')
  let bcodecount = $(`#span${itemid}`).text()
  let uom = $(this).data('uom')
  bcodedisplay = `BARCODE`
  $(`#itemtbody_${itemid}`).append(
    `  <tr id="item_${itemid+(bcodecount)}" class="item_${itemid}">
          <td></td>
          <td>${bcodedisplay}</td>
          <td><input type="hidden" name="hasbarcode[]" value="1"/>
          <input type="hidden" value="${itemid}" name="item[]"/>
          <input type="number" data-id="${itemid+(bcodecount)}" class="itemcart form-control" name="quantity[]" value="1"/></td>
          <td>${uom}</td>
          <td><input type="text" name="remarks[]" class="form-control"</td>
          <td><span class="removeitem fa fa-minus" style="color:maroon;cursor:pointer;" data-item="${itemid}" data-id="item_${itemid+(bcodecount)}"></span></td>
        </tr>
    `)

  $(`#span${itemid}`).text(parseInt(bcodecount)+parseInt(1))

})

$(document).on('click','.removeitem',function(){
  let id = $(this).data('id')
  let itemid = $(this).data('item')
   let bcodecount = $(`#span${itemid}`).text()
  $(`#${id}`).remove()
  $(`#span${itemid}`).text(parseInt(bcodecount)-parseInt(1))

  // // uncomment if need to remove if theres no item
  // if((parseInt(bcodecount)-parseInt(1)) == 0){
  //   $(`#itemtbody_${itemid}`).remove()
  //   let findid = itemlist.indexOf(itemid)
  //   itemlist.splice(findid,1)
  // }
})

$(document).on('click','#addItembtn',function(){
  let finaldisplay = ""
  let findid = itemlist.indexOf($('#itemid').val())

  if(findid == -1){

    itemlist.push($('#itemid').val())

    let bcodedisplay = $('#hasbarcode').val() == "YES" ? $('#quantity').val() : "No Barcode"
    
    finaldisplay = finaldisplay + `<tbody id="itemtbody_${$('#itemid').val()}">
        <tr id="list${$('#itemid').val()}" style="background:dimgray;color:white;">
          <td>${$('#des').val()}</td>
          <td>${$('#code').val()}</td>
          <td><span id="span${$('#itemid').val()}">${bcodedisplay}</span> Barcode(s)</td>
          <td>${$('#uom').val()}</td>
          <td></td>
          <td width="10%"><span class="fa fa-times removeitemonlist" data-id="${$('#itemid').val()}" style="font-size:14pt;font-weight:bold;cursor:pointer;margin-right:40px;"></span>`

          if($('#hasbarcode').val() == "YES"){
            finaldisplay = finaldisplay + `<span class="fa fa-plus additemonlist" data-uom="${$('#uom').val()}" data-id="${$('#itemid').val()}" style="font-size:14pt;font-weight:bold;cursor:pointer;"></span>`
          }
        


         finaldisplay = finaldisplay + `</td></tr>`

     let itemqty = $('.itemqty')
        
     for(let x = 0; x < itemqty.length ; x++){
         //let bcodedisplay = $('#hasbarcode').val() == "YES" ? "BARCODE "+(x+1) : "Quantity"
         let bcodedisplay ="BARCODE"
         let hasbarcode = $('#hasbarcode').val() == "YES" ? 1 : 0
        finaldisplay = finaldisplay + `
        <tr id="item_${$('#itemid').val()+x}" class="item_${$('#itemid').val()}">
          <td></td>
          <td>${bcodedisplay}</td>
          <td><input type="hidden" name="hasbarcode[]" value="${hasbarcode}"/><input type="hidden" value="${$('#itemid').val()}" name="item[]"/><input type="number" data-id="${$('#itemid').val()+x}" class="itemcart form-control" name="quantity[]" value="${itemqty[x].value}"/></td>
          <td>${$('#uom').val()}</td>
          <td><input type="text" name="remarks[]" class="form-control"/></td>
          <td><span class="removeitem fa fa-minus" style="color:maroon;cursor:pointer;" data-item="${$('#itemid').val()}" data-id="item_${$('#itemid').val()+x}"></span></td>
        </tr>
      `
      
     }

     finaldisplay = finaldisplay + `</tbody>`

     $('#itemlisttable').append(finaldisplay)

      $("#tbodyItemList").html("")
        $('#quantity').val("")
        $('#hasbarcode').val("YES")
        $('#ItemModal').modal('hide')

  }else{
    // alert('exist')
              swal({
                    title: "Item Already Added",
                    //text: "You will not be able to recover this imaginary file!",
                    type: "warning",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1000,
                 })
  }
})

$(document).on('click','.removeitemonlist',function(){
  let id = $(this).data('id')
  let findid = itemlist.indexOf(id)
  itemlist.splice(findid,1)
  $(`#list${id}`).remove()
  $(`#itemtbody_${id}`).remove()
  $(`.item_${id}`).remove()
})


$(document).on('click','.selectitem',function(){
  $('#des').val($(this).data('des'))
  $('#code').val($(this).data('code'))
  $('#uom').val($(this).data('unit'))
  $('#itemid').val($(this).data('id'))
  $('#quantity').val(0)
  $('#tbodyItemList').html("")
  $('#ItemModal').modal('show');
})

$('#inboundnav').addClass("active");

$(document).on('click','#showaddItem',function(){
  
  $('#addItemModal').modal('show')
})

$("#itemData").dataTable({
   'lengthMenu': [[5],["5"]],
  'lengthChange': false
});


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

                swal({
                    title: "Check the Required field",
                    //text: "You will not be able to recover this imaginary file!",
                    type: "error",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1500,
                 })
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

