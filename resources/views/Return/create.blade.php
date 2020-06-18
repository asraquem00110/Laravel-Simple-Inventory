@extends('layouts.index')


@section('MainContent')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark"> <i class="fa fa-undo"></i> Create Return Form</h1>
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
                            <select class="select2bs4 form-control" name="client" data-placeholder="Select Site" data-dropdown-css-class="select2-purple" style="width: 100%;height: 100%;">
                              <option></option>
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
                            <input type="date" class="form-control" name="date">
                             <p class="alert-danger errmsg" id="dateerr"></p>
                          </div>
                        </div>

                          <div class="col-md-4">
                          <div class="form-group">
                            <label>Delivery RefNo</label>
                            <input type="text" class="form-control" name="refno">
                             <p class="alert-danger errmsg" id="refnoerr"></p>
                          </div>
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
                    <button data-toggle="modal" data-target="#addItemModal" type="button" class="btn btn-default float-right"><span class="fa fa-plus"></span> Manual Add</button>
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

                <tbody id="dispatchItems">
        

                </tbody>
              </table>
              <button style="margin-top: 20px;" class="btn btn-success float-right" type="button" id="createbtn"><span class="fa fa-check"></span> Create</button>
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

$(document).on('click','#createbtn',function(){
  $.ajax({
    url: '{{url("")}}/return/create',
    type: 'POST',
    data: $("#returnForm").serialize(),
    datatype: 'json',
    success: function(res){
      if(res.errors){
        $("#clienterr").text(res.errors.client ? res.errors.client : "")
        $("#dateerr").text(res.errors.date ? res.errors.date : "")
        $("#refnoerr").text(res.errors.refno ? res.errors.refno : "")
        $("#itemserr").text(res.errors.items ? res.errors.items : "")

         swal({
                    title: "Check Required Inputs!!",
                    //text: "You will not be able to recover this imaginary file!",
                    type: "error",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1000,
                 })
      }

      if(res.message == "success"){
          swal({
                    title: "Successful!!",
                    //text: "You will not be able to recover this imaginary file!",
                    type: "success",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1000,
                 })

          setTimeout(()=>{
           window.location.href = window.location.href
          },1500)
      }else if(res.message == "fail"){
             swal({
                    title: "Something Went Wrong!!",
                    text: "Please Try Again!",
                    type: "error",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1000,
                 })
      }
    }
  })
})

let itemManualArray = []

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
  // let id = $('#productID').val()
  // let des = $('#product').text()
  // let productcode = $('#productcode').text()
  // let bcode = $("#barcode").val()
  // let serial = $("#serial").val()
  // let qty = $('#quantity').val()
  // let uom = $('#uom').val()

 


  // // // uncomment if required to eliminate duplication

  // let findid = itemManualArray.indexOf(id)

  // if(findid == -1){
  //   itemManualArray.push(id)

  //     let display = `
  //           <tr id="item_${id}">
  //           <td><span style="font-weight:bold">${des}</span><br/><small style="font-size:8pt">${productcode}</small></td>
  //           <td>${bcode}</td>
  //           <td>${serial}</td>
  //           <td width="10%">
  //           <input type="hidden" value="${id}" name="itemID[]"/>
  //           <input type="hidden" name="flag[]" value="0"/>
  //           <input type="hidden" name="uom[]" value="${uom}"/>
  //           <input type="hidden" value="${id}" name="items[]"/>
  //           <input id="itemqty_${id}" name="quantity[]" type="number" class="form-control quantity" data-id="${id}" value="${qty}"></td>
  //           <td>${uom}</td>
  //           <td><input type="text" class="form-control" name="remarks[]"/></td>
  //           <td><a href="javascript:void(0)" style="color:maroon" class="_removeitem" data-id="${id}"><span class="fa fa-times"></span></a></td>
  //           </tr>
  //         `
  // $('#dispatchItems').append(display)


  // }else{
  //        swal({
  //                   title: "Already added!!",
  //                   //text: "You will not be able to recover this imaginary file!",
  //                   type: "warning",
  //                   showCancelButton: false,
  //                   showConfirmButton: false,
  //                   timer: 1000,
  //                })
  // }
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
    $('#createbtn').attr("disabled",true)
  }else{
    $('#createbtn').removeAttr("disabled")
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

let itemarray = []

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


</script>
@endsection

