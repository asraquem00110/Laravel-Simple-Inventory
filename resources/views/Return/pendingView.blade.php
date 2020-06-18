@extends('layouts.index')


@section('MainContent')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark"> <i class="fa fa-undo"></i>Return Form Ref # {{$viewModel->getReturn()->refNo}}</h1>
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
        <form id="returnForm">
          @csrf
            <div class="card">
             
              <div class="card-body">
                  
                 
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Site</label>
                            <select class="select2bs4 form-control" id="client" name="client" data-placeholder="Select Site" data-dropdown-css-class="select2-purple" style="width: 100%;height: 100%;">
                              @foreach($viewModel->sites() as $client)
                              @if($client->type==0)
                              <option value="{{$client->id}}">{{$client->name}}</option>
                               @endif
                              @endforeach
                          </select>
                           <p class="alert-danger errmsg" id="clienterr"></p>
                          </div>

                        </div>

                         <div class="col-md-4">
                          <div class="form-group">
                            <label>Date Return</label>
                            <input type="date" class="form-control" name="date" value="{{ date_format(date_create($viewModel->getReturn()->datereturn),'Y-m-d') }}">
                             <p class="alert-danger errmsg" id="dateerr"></p>
                          </div>
                        </div>

                          <div class="col-md-4">
                          <div class="form-group">
                            <label>Delivery RefNo</label>
                            <input type="text" class="form-control" name="refno" value="{{$viewModel->getReturn()->dispatch_refno}}">
                             <p class="alert-danger errmsg" id="refnoerr"></p>
                          </div>
                        </div>

                      </div>


                      <div class="col-md-12">
                          <div class="form-group">
                           
                            <button type="button" id="editbtn" style="margin-top: 32px;color: green;" class="btn btn-default float-right"><span class="fa fa-edit"></span> Edit</button>


                            <button type="button" id="updatebtn" style="display:none;margin-top: 32px;color: blue;margin-right: 20px;" class="btnedit btn btn-default float-right"><span class="fa fa-check"></span> Update</button>


                             <button type="button" onclick="window.location.href=window.location.href" id="canceleditbtn" style="display:none;margin-top: 32px;color: maroon;margin-right: 20px;" class="btnedit btn btn-default float-right"><span class="fa fa-times"></span> Cancel</button>
                          </div>
                      </div>
           


                 
                

              </div>
            </div>



          <div class="card">
          <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <input type="text" class="form-control" name="" placeholder="Scan Barcode..." id="scanbarcode">
                  <span style="font-size: 10pt;margin-left: 5px;background: dimgray;color: white;padding: 2px 10px;border-radius: 5px;">PUT THE CURSOR/MOUSE HERE WHEN SCANNING ITEMS</span>
                </div>
                <div class="col-md-6">
                    <button disabled id="addModal" data-toggle="modal" data-target="#addItemModal" type="button" class="btn btn-default float-right"><span class="fa fa-plus"></span> Manual Add</button>
                </div>
              </div>
                 <p class="alert-danger errmsg" id="itemserr"></p>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>BarCode</th>
                    <th>Serial</th>
                    <th>Quantity</th>
                    <th>UOM</th>
                    <th>REMARKS</th>
                    <th></th>
                  </tr>
                </thead>
                    <script>

                    let itemarray = []
                    let itemManualArray = []
                </script>
                <tbody id="dispatchItems">
        			@foreach($viewModel->getReturn()->returnitem as $item)
      					<script>
      						itemarray.push(parseInt("{{$item->itemlist_id}}"))
      					</script>
                      <tr id="item{{$item->itemlist_id}}">
                      <td><span style="font-weight:bold">{{$item->item->description}}</span><br/><small style="font-size:8pt">{{$item->item->productCode}}</small></td>
                      <td>
                      @if($item->itemlist->freeStorage == 0)
                      {{$item->itemlist->barcode}}
                      @endif
                      </td>
                      <td>{{$item->itemlist->serialNumber}}</td>
                      <td width="10%">
                      <input type="hidden" value="{{$item->item_id}}" name="itemID[]"/>
                      <input type="hidden" name="uom[]" value="{{$item->uom}}"/>
                      <input type="hidden" value="{{$item->itemlist->freeStorage}}" name="hasbarcode[]"/>
                      <input type="hidden" value="{{$item->itemlist_id}}" name="items[]"/>
                      <input id="itemqty{{$item->itemlist_id}}" name="quantity[]" type="number" class="form-control quantity" data-id="{{$item->itemlist_id}}" value="{{$item->qty}}"></td>
                      <td>{{$item->uom}}</td>
                      <td><input type="text" class="form-control" name="remarks[]"/></td>
                      <td><a href="javascript:void(0)" style="color:maroon;display: none;" class="removeitem" data-id="{{$item->itemlist_id}}"><span class="fa fa-times"></span></a></td>
                      </tr>

        			@endforeach
                </tbody>
              </table>
            <!--   <button style="margin-top: 20px;" class="btn btn-success float-right" type="button" id="createbtn"><span class="fa fa-check"></span> Create</button> -->
                <div class="row">
                <div class="col-md-6">
            <div id="modifiedlogs" style="margin-top: 30px">
               @if($viewModel->getReturn()->LastModifiedBy != NULL)
              <span>Last Modified By:         
                {{$viewModel->getReturn()->LastModifiedBy}} // 
                {{date_format(date_create($viewModel->getReturn()->updated_at),'M d, Y h:i a')}}
             </span>
              @endif

            </div>
          </div>

           <div class="col-md-6">
                    <div id="confirmdiv" class="input-group-prepend float-right" style="margin-top: 30px;">
                    <button type="button" id="createbtn" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                      <span style="font-weight:bold">Approved ?</span>
                    </button>
                    <ul class="dropdown-menu">
                      <li class="dropdown-item"><button onclick="confirmed(1)" type="button" class="btn btn-primary" style="margin-right: 20px;"><span class="fa fa-check"></span> YES</button><button onclick="confirmed(2)" class="btn btn-danger" type="button"><span class="fa fa-times"></span> NO</button></li>
                      </ul>
                  </div>
          </div>
        </div>
          </div>


        </div>
 </form>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- Modals -->

<div class="modal" role="dialog" id="addItemModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
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
                 
                    <th>Image</th>
                    <th>Description</th>
                    <th>Product Code</th>
                    <th>Unit of Measurement</th>
                       <!--  <th>Storage Barcode</th> -->
                    <th></th>
                  </tr>
                </thead>

                <tbody id="itemDatabody">
                  @foreach($viewModel->products() as $item)
                  <tr id="rowitem{{$item->id}}">
                    
                    <td><img src="{{asset('images/items').'/'.$item->img}}" style="height: 50px;width: 70px;" /></td>
                    <td>{{$item->description}}</td>
                    <td>{{$item->productCode}}</td>
                    <td>{{$item->unitMeasurement}}</td>
                     <!--   <td>{{$item->itemstorage->barcode}}</td> -->
                  

                    <td>
            
                      <a href="javascrpt:void(0)" 
                      data-des="{{$item->description}}" 
                      data-itemid="{{$item->id}}"
                      data-code="{{$item->productCode}}"
                      data-barcode="{{$item->itemstorage->barcode}}"
                      data-uom="{{$item->unitMeasurement}}"
                      class="addItem"><span class="fa fa-plus"></span> Add<br/></a>
                    
                  </td>
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

  <div class="modal" role="dialog" id="addItemManualModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
               </button>

          </div>

          <div class="modal-body">
            <h4 id="product"></h4><br/><span id="productcode"></span>

            <hr/>
              <form>
                <input type="hidden" id="productID" name="">
               <div class="form-group" style="display: none;">
                  <label>Storage Barcode</label>
                  <input type="text" value="" name="" class="form-control" placeholder="Leave blank if not applicable" id="barcode" readonly style="background: white;">
                </div>

                <div class="form-group" style="display: none;">
                  <label>Serial</label>
                  <input type="text" value="" name="" class="form-control" placeholder="Leave blank if not applicable" id="serial">
                </div>

                <div class="form-group">
                  <label>Quantity</label>
                  <input type="number" value="1" name="" class="form-control" id="quantity">
                </div>

                <div class="form-group">
                  <label>Unit of Measurement</label>
                  <input style="background: white;" id="uom" type="text" value="" name="" class="form-control" readonly>
                </div>

                <hr/>

                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-times"></span> Close</button>
                 <button type="button" class="btn btn-success float-right"  id="_additem"><span class="fa fa-plus"></span> Add</button>
              </form>
          </div>
        </div>
    </div>

  </div>
@include('layouts.foot')

<script>

$('#returnnav').addClass("active");

function init(){
  $('#addModal').attr("disabled",true)
  $('.form-control').attr("readonly",true)
  $('.form-control').css("background","white")
  $('#client').prop('disabled', true)
  $("#client").val("{{$viewModel->getReturn()->client->id}}").trigger("change")
  $('.removeitem').css("display","none")
  $('._removeitem').css("display","none")
}

init()

$(document).on('click','#editbtn',function(){
  $('#addModal').removeAttr("disabled")
  $('.form-control').removeAttr("readonly")
  $('#client').prop('disabled', false)
  $('#createbtn').attr("disabled",true)
  $('#editbtn').css("display","none")
  $('.btnedit').css("display","block")
  $('.removeitem').css("display","block")
  $('._removeitem').css("display","block")

})
$(document).on('change','#client',function(){
  $.ajax({
    url: '{{url("")}}/getClient/'+this.value,
    type: 'GET',
    data: {
      '_token': $('input[name=_token]').val(),
    },
    datatype: 'json',
  }).then((res)=>{
    document.getElementById("address").value = res.client.address
  })
})



$(document).on('keyup change','#quantity',function(){
  let quantity = this.value

  if(quantity <= 0){
    this.classList.add("is-invalid")
    $('#_additem').attr('disabled',true)
  }else{
      this.classList.remove('is-invalid')
      $('#_additem').removeAttr('disabled')
  }
})

$(document).on('click','#_additem',function(){
  addManualItems($('#barcode').val())
})

$(document).on('click','._removeitem',function(){
  let id = $(this).data('id')
  $(`#item_${id}`).remove()
validate()


})

$(document).on('keyup change','.quantity',function(){
  validate()
})

function validate(){
    let invalid = 0
    for(let x = 0;x<itemarray.length;x++){
    let qty = $(`#itemqty${itemarray[x]}`).val()

    if(qty <= 0){
      $(`#item${itemarray[x]}`).css("border", "3px solid maroon")
      invalid = 1
    }else{
        $(`#item${itemarray[x]}`).css("border", "none")
     
    }
 
  }

  for(let x = 0;x<itemManualArray.length;x++){
    let qty = $(`#itemqty_${itemManualArray[x]}`).val()
    
   if(qty <= 0){
      $(`#item_${itemManualArray[x]}`).css("border", "3px solid maroon")
      invalid = 1
    }else{
        $(`#item_${itemManualArray[x]}`).css("border", "none")
   
    }

   
  }

  if(invalid === 1){
    $('#updatebtn').attr("disabled",true)
  }else{
    $('#updatebtn').removeAttr("disabled")
  }
}



$(document).on('click','.addItem',function(){
  $('#product').text($(this).data('des'))
  $('#productcode').text($(this).data('code'))
  $('#uom').val($(this).data('uom'))
  $('#productID').val($(this).data('itemid'))
  $('#barcode').val($(this).data('barcode'))
  $('#quantity').val(1)
  $('#addItemManualModal').modal('show')
})

$(document).on('click','.removeitem',function(){
  let id = $(this).data('id')
  $(`#item${id}`).remove()
  let findid = itemarray.indexOf(id)
  itemarray.splice(findid,1)

// validate()


})

$(document).on('click','.addItemWithBcode',function(){
  let bcode = $(this).data('barcode')
  addManualItems(bcode)
})



$("#itemData").dataTable({
   'lengthMenu': [[5],["5"]],
  'lengthChange': false
})
let typingTimer = ''
let doneTypingInterval = 800

function initbarcode(){
  $('#scanbarcode').focus()
}

$(document).ready(function(){
  initbarcode()
})



$(document).on('keyup change','#scanbarcode',function(){
  clearTimeout(typingTimer)
  if($('#scanbarcode').val().length > 0){
    typingTimer = setTimeout(()=>{
        let display = ""
        addManualItems($('#scanbarcode').val())
    },500)
  }else{

  }
})



function addManualItems(barcode){
  $.ajax({
          url: '{{url("")}}/dispatch/getItem/'+barcode.trim()+'',
          type: 'GET',
          data: {
            '_token': $('input[_token]').val(),
          },
          datatype: 'json',
          success:function(res){
            if(res.itemlist.length > 0){

                let findid = itemarray.indexOf(res.itemlist[0].id)
                if(findid == -1){
                      display = `
                      <tr id="item${res.itemlist[0].id}">
                      <td><span style="font-weight:bold">${res.itemlist[0].item.description}</span><br/><small style="font-size:8pt">${res.itemlist[0].item.productCode == null ? "" : res.itemlist[0].item.productCode}</small></td>
                      <td>${(res.itemlist[0].barcode == null || res.itemlist[0].freeStorage == 1) ? "" : res.itemlist[0].barcode}</td>
                      <td>${res.itemlist[0].serialNumber == null ? "" : res.itemlist[0].serialNumber}</td>
                      <td width="10%">
                      <input type="hidden" value="${res.itemlist[0].item.id}" name="itemID[]"/>
                      <input type="hidden" name="uom[]" value="${res.itemlist[0].item.unitMeasurement}"/>
                      <input type="hidden" value="${res.itemlist[0].freeStorage}" name="hasbarcode[]"/>
                      <input type="hidden" value="${res.itemlist[0].id}" name="items[]"/>
                      <input id="itemqty${res.itemlist[0].id}" name="quantity[]" type="number" class="form-control quantity" data-id="${res.itemlist[0].id}" value="${res.itemlist[0].freeStorage == 1 ? $('#quantity').val() : 1}"></td>
                      <td>${res.itemlist[0].item.unitMeasurement}</td>
                      <td><input type="text" class="form-control" name="remarks[]"/></td>
                      <td><a href="javascript:void(0)" style="color:maroon" class="removeitem" data-id="${res.itemlist[0].id}"><span class="fa fa-times"></span></a></td>
                      </tr>
                    `
                    $('#dispatchItems').append(display)
                   
                    itemarray.push(res.itemlist[0].id)
                }else{
                  
                  // alert('already added')
                   
                swal({
                    title: "Already added!!",
                    //text: "You will not be able to recover this imaginary file!",
                    type: "warning",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1000,
                 })
                }

              
            }else{
                // alert('No record found')
            
                swal({
                    title: "No Record Found!!",
                    //text: "You will not be able to recover this imaginary file!",
                    type: "error",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1000,
                 })
            }
             
           
          }
        })
       $('#scanbarcode').val("")
      initbarcode()
}



$(document).on('click','#updatebtn',function(){
    swal({
        title: "Confirm Update?",
        //text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: 'Yes!',
        cancelButtonText: "No!",
        closeOnConfirm: false,
        closeOnCancel: true,
     },
     function(isConfirm){

       if (isConfirm){
            $.ajax({
              url: '{{url("")}}/return/update/{{$viewModel->getReturn()->id}}',
              type: 'PATCH',
              data: $('#returnForm').serialize(),
              datatype: 'json',
            }).then((res)=>{
                       if(res.errors){
                          $("#clienterr").text(res.errors.client ? res.errors.client : "")
                          $("#dateerr").text(res.errors.date ? res.errors.date : "")
                          $("#itemserr").text(res.errors.items ? res.errors.items : "")
                          $('#refnoerr').text(res.errors.refno ? res.errors.refno : "")

                           swal({
                                      title: "Check Required Inputs!!",
                                      //text: "You will not be able to recover this imaginary file!",
                                      type: "error",
                                      showCancelButton: false,
                                      showConfirmButton: false,
                                      timer: 1000,
                                   })
                        }

                          if(res.message){
                            if(res.message == "success"){
                                    swal({
                                        title: "Return Request Succesfully Updated!!",
                                        //text: "You will not be able to recover this imaginary file!",
                                        type: "success",
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                        timer: 1500,
                                     })

                                    window.location.href = window.location.href
                            }else{
                                       swal({
                                        title: "Something Went Wrong!!",
                                        text: "Please Try Again!",
                                        type: "error",
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                        timer: 2000,
                                     })
                            }
                          }

            })
        }else{

        } 
     });
})

function confirmed(status){
 $.ajax({
    url: '{{url('')}}/return/approved/{{$viewModel->getReturn()->id}}',
    type: 'PATCH',
    data: {
      '_token': $('input[name=_token]').val(),
      'status': status,
    },
    datatype: 'json',
 }).then((res)=>{
        if(res.message){
                    if(res.message == "success"){
                            swal({
                                title: "Return Succesfully Updated!!",
                                //text: "You will not be able to recover this imaginary file!",
                                type: "success",
                                showCancelButton: false,
                                showConfirmButton: false,
                                timer: 2000,
                             })

                            window.location.href = '{{url('')}}/return/pending/list'
                    }else{
                               swal({
                                title: "Something Went Wrong!!",
                                text: "Please Try Again!",
                                type: "error",
                                showCancelButton: false,
                                showConfirmButton: false,
                                timer: 2000,
                             })
                    }
                  }
 })
}

</script>
@endsection

