@extends('layouts.index')


@section('MainContent')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">

            <h1 class="m-0 text-dark"> <i class="fa fa-upload"></i> Outbound Request Reference # {{$viewModel->pendingOutbound()->refNo}}</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <form id="outboundform">
          @csrf
        <div class="row">
         
          <!-- /.col-md-12 -->
          <div class="col-lg-12">
            <div class="card">
             
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-3">
                          <div class="form-group">
                          <label>SITE</label>
                          <select class="select2bs4 form-control" name="client" data-placeholder="Select Site" data-dropdown-css-class="select2-purple" style="width: 100%;height: 100%;" id="site">
                              <!-- <option value="{{$viewModel->pendingOutbound()->client_id}}">{{$viewModel->pendingOutbound()->client->name}}</option> -->
                              @foreach($viewModel->clients() as $client)
                              @if($client->type==0)
                              <option value="{{$client->id}}">{{$client->name}}</option>
                               @endif
                              @endforeach
                          </select>
                          <p class="alert-danger errmsg" id="clienterr"></p>
                      </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>DRIVER</label>
                          <input type="text" class="form-control" name="driver" value="{{$viewModel->pendingOutbound()->driver}}">
                           <p class="alert-danger errmsg" id="drivererr"></p>
                        </div>
                      </div>

                       <div class="col-md-3">
                        <div class="form-group">
                          <label>PLATE #</label>
                          <input type="text" class="form-control" name="plateno" value="{{$viewModel->pendingOutbound()->plateNo}}">
                        </div>
                      </div>

                       <div class="col-md-3">
                        <div class="form-group">
                          <label>CONTAINER #</label>
                          <input type="text" class="form-control" name="containerno"  value="{{$viewModel->pendingOutbound()->container}}">
                        </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>CONTROL #</label>
                          <input type="text" class="form-control" name="control"  value="{{$viewModel->pendingOutbound()->controlNo}}">
                          <p class="alert-danger errmsg" id="controlerr"></p>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>DATE</label>
                          <input type="date" class="form-control" name="date"  value="{{$viewModel->pendingOutbound()->loadDate}}">
                           <p class="alert-danger errmsg" id="dateerr"></p>
                        </div>
                      </div>

                       <div class="col-md-3">
                        <div class="form-group">
                          <label>TIME OF LOADING</label>
                          <input type="time" class="form-control" name="loadtime"  value="{{date_format(date_create($viewModel->pendingOutbound()->loadTime),'H:i')}}">
                          <p class="alert-danger errmsg" id="loaderr"></p>
                        </div>
                      </div>

                       <div class="col-md-3">
                        <div class="form-group">
                          <label>TIME ENDED</label>
                          <input type="time" class="form-control" name="finishtime"  value="{{date_format(date_create($viewModel->pendingOutbound()->finishloadTime),'H:i')}}">
                          <p class="alert-danger errmsg" id="finisherr"></p>
                        </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>PREPARED BY</label>
                          <input type="text" class="form-control" id="preparedby" name="preparedby"  value="{{$viewModel->pendingOutbound()->preparedby}}" readonly style="background: white;">
                            <span style="margin-left: 2px;">Date Created: {{date_format(date_create($viewModel->pendingOutbound()->created_at),'M d, Y h:i a')}}</span>
                            <p class="alert-danger errmsg" id="prepareerr"></p>
                        </div>
                      </div>

                      <div class="col-md-3" style="display: none;">
                        <div class="form-group">
                          <label>APPROVED BY</label>
                          <input type="text" class="form-control" name="approvedby" value="{{Auth::User()->name}}">
                              <p class="alert-danger errmsg" id="approvederr"></p>
                        </div>
                      </div>

                       <div class="col-md-3">
                        <div class="form-group">
                          <label>RECEIVED BY</label>
                          <input type="text" class="form-control" name="receivedby"  value="{{$viewModel->pendingOutbound()->recievedby}}">
                        </div>
                      </div>

                       <div class="col-md-3">
                        <div class="form-group">
                          <label>CHECKED BY</label>
                          <input type="text" class="form-control" name="checkedby"  value="{{$viewModel->pendingOutbound()->checkedby}}">
                        </div>
                      </div>

                      <div class="col-md-3">
                          <div class="form-group">
                           
                            <button type="button" id="editbtn" style="margin-top: 32px;color: green;" class="btn btn-default float-right"><span class="fa fa-edit"></span> Edit</button>


                            <button type="button" id="updatebtn" style="display:none;margin-top: 32px;color: blue;margin-right: 20px;" class="btnedit btn btn-default float-right"><span class="fa fa-check"></span> Update</button>


                             <button type="button" onclick="window.location.href=window.location.href" id="canceleditbtn" style="display:none;margin-top: 32px;color: maroon;margin-right: 20px;" class="btnedit btn btn-default float-right"><span class="fa fa-times"></span> Cancel</button>
                          </div>
                      </div>
                  </div>
                
                
              </div>
            </div>

          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->


        <div class="card">
          <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <input type="text" class="form-control" name="" placeholder="Scan Barcode..." id="scanbarcode">
                   <span style="font-size: 10pt;margin-left: 5px;background: dimgray;color: white;padding: 2px 10px;border-radius: 5px;">PUT THE CURSOR/MOUSE HERE WHEN SCANNING ITEMS</span>
                </div>
                <div class="col-md-6">
                    <button disabled="true" data-toggle="modal" id="addModal" data-target="#addItemModal" type="button" class="btn btn-default float-right"><span class="fa fa-plus"></span> Manual Add</button>
                </div>
              </div>
                 <p class="alert-danger errmsg" id="itemserr"></p>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>BarCode</th>
                    <th>Serial</th>
                    <th>Remaining</th>
                    <th>Quantity</th>
                    <th>UOM</th>
                    <th>REMARKS</th>
                    <th></th>
                  </tr>
                </thead>
                <script>
                  let itemarray = []
                </script>
                <tbody id="outboundItem">
                      @foreach($viewModel->pendingOutbound()->outbounditems as $item)
                      <script>
                          itemarray.push(parseInt("{{$item->itemlist_id}}"))
                      </script>
                         <tr id="item{{$item->itemlist_id}}">
                      <td><span style="font-weight:bold">{{$item->item->description}}</span><br/><small style="font-size:8pt">{{$item->item->productCode}}</small></td>
                      <td>{{$item->itemlist->barcode}}</td>
                      <td>{{$item->itemlist->serialNumber}}</td>
                      <td><span id="remaining{{$item->itemlist_id}}">{{$item->itemlist->qty}}</span></td>
                      <td width="10%">
                      <input type="hidden" value="{{$item->itemlist->freeStorage}}" name="hasbarcode[]"/>
                      <input type="hidden" value="{{$item->itemlist_id}}" name="items[]"/>
                      <input type="hidden" value="{{$item->item_id}}" name="itemID[]"/>
                      <input id="itemqty{{$item->itemlist_id}}" name="quantity[]" type="number" class="form-control quantity" data-id="{{$item->itemlist_id}}" value="{{$item->quantity}}">
                      </td>
                      <td>{{$item->item->unitMeasurement}}</td>
                      <td><input type="text" class="form-control" name="remarks[]" value="{{$item->remarks}}" /></td>
                      <td><a href="javascript:void(0)" style="color:maroon;display: none;" class="removeitem" data-id="{{$item->itemlist_id}}"><span class="fa fa-times"></span></a></td>
                      </tr>


                      @endforeach

                </tbody>
              </table>
            <!--   <button style="margin-top: 20px;" class="btn btn-success float-right" type="button" id="createbtn"><span class="fa fa-check"></span> Approved</button> -->
            <div class="row">
                <div class="col-md-6">
            <div id="modifiedlogs" style="margin-top: 30px">
               @if($viewModel->pendingOutbound()->LastModifiedBy != NULL)
              <span>Last Modified By: 
               
                {{$viewModel->pendingOutbound()->LastModifiedBy}} // 
                {{date_format(date_create($viewModel->pendingOutbound()->updated_at),'M d, Y h:i a')}}
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
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- MODALS -->



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
                    <th></th>
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
                    <!-- FREE STORAGE -->
                    <td style="opacity: 0;">
                       @if($item->itemListStorage->qty == 0)
                      <span>No Barcode Items<br/>{{$item->itemListStorage->qty}}</span>
                      @else
                      <a href="javascript:void(0)"
                        data-id="{{$item->itemListStorage->id}}"
                        data-remaining="{{$item->itemListStorage->qty}}"
                        data-des="{{$item->description}}"
                        data-productCode="{{$item->productCode}}"
                        data-barcode="{{$item->itemListStorage->barcode}}"
                       class="addItemNoBcode">No Barcode Items<br/><span>{{$item->itemListStorage->qty}}</span></a>
                      @endif
                      </td>

                    <td>
                      @php $total = 0 @endphp
                      @foreach($item->itemListCurrent as $_item)
                      @php $total += $_item->qty @endphp
                      @endforeach

                      @if($total == 0)
                      <span>With Barcode Items<br/>{{$total}}</span>
                      @else
                      <a href="javascrpt:void(0)" 
                      data-des="{{$item->description}}" 
                      data-itemid="{{$item->id}}"
                      data-code="{{$item->productCode}}"
                      class="addItemBcode">With Barcode Items<br/><span>
                      {{$total}}
                    </span></a>
                      @endif

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


  <div class="modal" role="dialog" id="addItemNoBcodeModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
               </button>

          </div>

          <div class="modal-body">
                <input type="hidden" name="" id="m_bcode">
                <input type="hidden" name="" id="m_id">
                <h3 id="m_product"></h3>
                <hr/>
                <div class="form-group">
                  <label>REMAINING QUANTITY</label>
                  <input type="number" name="" class="form-control" id="m_remaining" readonly style="background: white;">
                </div>

                   <div class="form-group">
                  <label>QUANTITY</label>
                  <input type="number" name="" class="form-control" id="m_quantity">
                </div>

                <button type="button" class="btn btn-default float-left" data-dismiss="modal"><span class="fa fa-times"></span> Close</button>
                <button type="button" class="btn btn-primary float-right" id="m_add"><span class="fa fa-plus"></span> Add</button>
          
          </div>
        </div>
    </div>
  </div>


  <div class="modal" role="dialog" id="addItemBcodeModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
               </button>

          </div>

          <div class="modal-body">
                 <span style="font-weight: bold;font-size: 20pt;" id="b_product"></span> <span id="b_code"></span>
                 <hr/>
              
                 <table class="table table-striped table-condensed table-hover" id="tablewithBcode">
                    <thead>
                      <tr>               
                        <th>Barcode</th>
                        <th>SerialNumber</th>
                        <th>Qr code</th>
                        <th>Remaining</th>
                        <th>UOM</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody id="tablewithBcodeItems">


                    </tbody>
                 </table>

                <hr/>
                 <button type="button" class="btn btn-default float-left" data-dismiss="modal"><span class="fa fa-times"></span> Close</button>
               
          </div>
        </div>
    </div>
  </div>



@include('layouts.foot')

<script>

$('#outboundnav').addClass("active")
// $("#itemData").dataTable()

function init(){
  $('#addModal').attr("disabled",true)
  $('.form-control').attr("readonly",true)
  $('.form-control').css("background","white")
  $('select').prop('disabled', true)
  $("select").val("{{$viewModel->pendingOutbound()->client->id}}").trigger("change")
  $('.removeitem').css("display","none")
}

$(document).on('click','#editbtn',function(){
  $('#addModal').removeAttr("disabled")
  $('.form-control').removeAttr("readonly")
  $('select').prop('disabled', false)
  $('#createbtn').attr("disabled",true)
  $('#editbtn').css("display","none")
  $('.btnedit').css("display","block")
  $('.removeitem').css("display","block")
  $('#preparedby').attr("readonly",true)
})

$(document).ready(function(){
 init()
 prepareItemlist()
})

function prepareItemlist(){
//   $("#itemData").dataTable({
//   'bProcessing': true,
//   'sAjaxSource': '{{ route("manualAddItem")}}',
//   'sAjaxDataProp': "data",
//   'destroy': true,
// })

$("#itemData").dataTable({
   'lengthMenu': [[5],["5"]],
  'lengthChange': false
})
}


$(document).on('click','.addItemBcode',function(){
  let des = $(this).data('des')
  let itemid = $(this).data('itemid')
  let code = $(this).data('code')
  $('#b_product').text(des+' // ')
  $('#b_code').text(code)
  $("#addItemBcodeModal").modal('show')
  generateitemlist(itemid)

})

function generateitemlist(id){
$("#tablewithBcode").dataTable({
  'bProcessing': true,
  'sAjaxSource': '{{ url("outbound/iteminfo")}}/'+id+'',
  'sAjaxDataProp': "data",
  'destroy': true,
   'lengthMenu': [[5],["5"]],
  'lengthChange': false
})
}

$(document).on('click','.addItemNoBcode',function(){
  let id = $(this).data('id')
  let des = $(this).data('des')
  let remaining = $(this).data('remaining')
  let bcode = $(this).data('barcode')

  $('#m_id').val(id)
  $('#m_product').text(des)
  $('#m_remaining').val(remaining)
  $('#m_quantity').val(1)
  $('#m_bcode').val(bcode)
  $('#addItemNoBcodeModal').modal('show')
  // $('#addItemModal').modal('hide')
})


$(document).on('click','.addItemWithBcode',function(){
  let bcode = $(this).data('barcode')
  addManualItems(bcode)
})


$(document).on('click','#m_add',function(){
    addManualItems($('#m_bcode').val())
    $('#addItemNoBcodeModal').modal('hide')
})

$(document).on('keyup change','#m_quantity',function(){
   let remaining =  $('#m_remaining').val()
   let quantity = $('#m_quantity').val()

   if(parseFloat(quantity) <= 0 || parseFloat(quantity) > parseFloat(remaining)){
      $('#m_quantity').addClass('is-invalid')
      $('#m_add').attr('disabled',true)
   }else{
      $('#m_quantity').removeClass('is-invalid')
      $('#m_add').removeAttr('disabled')
   }
})

let typingTimer = ''
let doneTypingInterval = 800

function initbarcode(){
  $('#scanbarcode').focus()
}


// $(document).on('keyup','.form-control',function(){
//   clearTimeout(typingTimer)
//   if(this.value.length > 0){
//     typingTimer = setTimeout(()=>{
//       initbarcode()
//     },doneTypingInterval) 
//   }
  
// })

function addManualItems(barcode){
  $.ajax({
          url: '{{url("")}}/outbound/getItem/'+barcode+'',
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
                      <td>${res.itemlist[0].barcode == null ? "" : res.itemlist[0].barcode}</td>
                      <td>${res.itemlist[0].serialNumber == null ? "" : res.itemlist[0].serialNumber}</td>
                      <td><span id="remaining${res.itemlist[0].id}">${res.itemlist[0].qty}</span></td>
                      <td width="10%">
                      <input type="hidden" value="${res.itemlist[0].freeStorage}" name="hasbarcode[]"/>
                      <input type="hidden" value="${res.itemlist[0].id}" name="items[]"/>
                      <input type="hidden" value="${res.itemlist[0].item.id}" name="itemID[]"/>
                      <input id="itemqty${res.itemlist[0].id}" name="quantity[]" type="number" class="form-control quantity" data-id="${res.itemlist[0].id}" value="1">
                      </td>
                      <td>${res.itemlist[0].item.unitMeasurement}</td>
                      <td><input type="text" class="form-control" name="remarks[]"/></td>
                      <td><a href="javascript:void(0)" style="color:maroon" class="removeitem" data-id="${res.itemlist[0].id}"><span class="fa fa-times"></span></a></td>
                      </tr>
                    `
                    $('#outboundItem').append(display)
                   
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

// let itemarray = []

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

$(document).on('keyup change','.quantity',function(){
  let id = $(this).data('id')
  let qty = this.value
  let remaining = $(`#remaining${id}`).text()

  if(parseFloat(qty) > parseFloat(remaining) || parseFloat(qty) <= 0){
      $(`#item${id}`).css('border','5px solid red')
  }else{
      $(`#item${id}`).css('border','none')
  }

  validate()

})

$(document).ready(function(){
  initbarcode()
})

$(document).on('click','.removeitem',function(){
  let id = $(this).data('id')
  $(`#item${id}`).remove()
  let findid = itemarray.indexOf(id)
  itemarray.splice(findid,1)

validate()


})

function validate(){
    for(let x = 0;x<itemarray.length;x++){
    let qty = $(`#itemqty${itemarray[x]}`).val()
    let remaining = $(`#remaining${itemarray[x]}`).text()

    if(parseFloat(qty) > parseFloat(remaining) || parseFloat(qty) <= 0){
      $('#updatebtn').attr('disabled','true')
      break
    }else{
      $('#updatebtn').removeAttr('disabled')
    }
  }
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
              url: '{{url("")}}/outbound/update/{{$viewModel->pendingOutbound()->id}}',
              type: 'PATCH',
              data: $('#outboundform').serialize(),
              datatype: 'json',
            }).then((res)=>{
                   if(res.errors){
                      $('#itemserr').text(res.errors.items ? res.errors.items : "")
                      $('#clienterr').text(res.errors.client ? res.errors.client : "")
                      $('#approvederr').text(res.errors.approvedby ? res.errors.approvedby : "")
                      $('#dateerr').text(res.errors.date ? res.errors.date : "")
                      $('#loaderr').text(res.errors.loadtime ? res.errors.loadtime : "")
                      $('#finisherr').text(res.errors.finishtime ? res.errors.finishtime : "")
                      $('#prepareerr').text(res.errors.preparedby ? res.errors.preparedby : "")
                      $('#controlerr').text(res.errors.control ? res.errors.control : "")

                         swal({
                                  title: "Check Required inputs!!",
                                  //text: "You will not be able to recover this imaginary file!",
                                  type: "error",
                                  showCancelButton: false,
                                  showConfirmButton: false,
                                  timer: 1500,
                               })
                    }

                          if(res.message){
                            if(res.message == "Successful"){
                                    swal({
                                        title: "Outbound Succesfully Updated!!",
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
    url: '{{url('')}}/outbound/approved/{{$viewModel->pendingOutbound()->id}}',
    type: 'PATCH',
    data: {
      '_token': $('input[name=_token]').val(),
      'status': status,
    },
    datatype: 'json',
 }).then((res)=>{
        if(res.message){
                    if(res.message == "Successful"){
                            swal({
                                title: "Outbound Succesfully Updated!!",
                                //text: "You will not be able to recover this imaginary file!",
                                type: "success",
                                showCancelButton: false,
                                showConfirmButton: false,
                                timer: 2000,
                             })

                            window.location.href = '{{url('')}}/outbound/pending/list'
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


// $(document).on('click','#createbtn',function(){
//   $.ajax({
//     url: '{{url('')}}/outbound/save',
//     type: 'POST',
//     data: $('#outboundform').serialize(),
//     datatype: 'json',
//     success:function(res){
//       if(res.errors){
//         $('#itemserr').text(res.errors.items ? res.errors.items : "")
//         $('#clienterr').text(res.errors.client ? res.errors.client : "")
//         $('#approvederr').text(res.errors.approvedby ? res.errors.approvedby : "")
//         $('#dateerr').text(res.errors.date ? res.errors.date : "")
//         $('#loaderr').text(res.errors.loadtime ? res.errors.loadtime : "")
//         $('#finisherr').text(res.errors.finishtime ? res.errors.finishtime : "")
//         $('#prepareerr').text(res.errors.preparedby ? res.errors.preparedby : "")
//         $('#controlerr').text(res.errors.control ? res.errors.control : "")

//            swal({
//                     title: "Check Required inputs!!",
//                     //text: "You will not be able to recover this imaginary file!",
//                     type: "error",
//                     showCancelButton: false,
//                     showConfirmButton: false,
//                     timer: 1500,
//                  })
//       }

//       if(res.message){
//         if(res.message == "Successful"){
//                 swal({
//                     title: "Outbound Succesfully Created!!",
//                     //text: "You will not be able to recover this imaginary file!",
//                     type: "success",
//                     showCancelButton: false,
//                     showConfirmButton: false,
//                     timer: 1500,
//                  })

//                 window.location.href = window.location.href
//         }else{
//                    swal({
//                     title: "Something Went Wrong!!",
//                     //text: "You will not be able to recover this imaginary file!",
//                     type: "error",
//                     showCancelButton: false,
//                     showConfirmButton: false,
//                     timer: 2000,
//                  })
//         }

//       }
//     }
//   })
// })

</script>
@endsection

