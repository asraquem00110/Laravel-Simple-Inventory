@extends('layouts.index')


@section('MainContent')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark"> <i class="fa fa-download"></i>Inbound Request Ref # {{$viewModel->inboundPending()->refNo}}</h1>
            
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
                          <select class="select2bs4 form-control" id="client" name="client" data-placeholder="Select Supplier" data-dropdown-css-class="select2-purple" style="width: 100%;height: 100%;">
                             
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
                          <input type="text" class="form-control" name="driver" value="{{$viewModel->inboundPending()->driver}}">
                          <p class="alert-danger errmsg" id="drivererr"></p>
                      </div>
                    </div>
                

                  <div class="col-md-4">
                      <div class="form-group">
                          <label>PLATE NO</label>
                          <input type="text" class="form-control" name="plateno" value="{{$viewModel->inboundPending()->plateNo}}">
                      </div>
                    </div>
                  </div>


                   <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>CONTAINER</label>
                           <input type="text" class="form-control" name="container" value="{{$viewModel->inboundPending()->container}}">
                      </div>
                    </div>

                    <div class="col-md-4" style="display: none;">
                      <div class="form-group">
                          <label>REF NO</label>
                          <input type="text" class="form-control" name="refno" value="{{$viewModel->inboundPending()->refNo}}">
                      </div>
                    </div>
                

                  <div class="col-md-4">
                      <div class="form-group">
                          <label>CONTROL NO</label>
                          <input type="text" class="form-control" name="controlno" value="{{$viewModel->inboundPending()->controlNo}}">
                      </div>
                    </div>

                       <div class="col-md-4">
                      <div class="form-group">
                          <label>ORIGIN</label>
                           <input type="text" class="form-control" name="origin" value="{{$viewModel->inboundPending()->origin}}">
                      </div>
                    </div>


                  </div>



                   <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>DATE</label>
                           <input type="date" class="form-control" name="refdate" value="{{$viewModel->inboundPending()->unloadDate}}">
                           <p class="alert-danger errmsg" id="dateerr"></p>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                          <label>UNLOADING TIME</label>
                          <input type="time" class="form-control" name="unloadtime" value="{{date_format(date_create($viewModel->inboundPending()->unloadTime),'H:i')}}">
                          <p class="alert-danger errmsg" id="unloaderr"></p>
                      </div>
                    </div>
                

                  <div class="col-md-4">
                      <div class="form-group">
                          <label>TIME FINISHED</label>
                          <input type="time" class="form-control" name="finishtime" value="{{date_format(date_create($viewModel->inboundPending()->finishUnloadTime),'H:i')}}">
                          <p class="alert-danger errmsg" id="finisherr"></p>
                      </div>
                    </div>
                  </div>



                   <div class="row">
                 

                    <div class="col-md-4">
                      <div class="form-group">
                          <label>RECEIVED BY</label>
                          <input type="text" class="form-control" name="rcvby" value="{{$viewModel->inboundPending()->receivedby}}">
                      </div>
                    </div>
                

                  <div class="col-md-4">
                      <div class="form-group">
                          <label>CHECKED BY</label>
                          <input type="text" class="form-control" name="chkby" value="{{$viewModel->inboundPending()->checkedby}}">
                      </div>
                    </div>

                        <div class="col-md-4">
                      <div class="form-group">
                          <label>NOTED BY</label>
                          <input type="text" class="form-control" name="notedby" value="{{$viewModel->inboundPending()->notedby}}">
                      </div>
                    </div>

                     <div class="col-md-12">
                          <div class="form-group">
                           
                            <button type="button" id="editbtn" style="margin-bottom: 32px;color: green;" class="btn btn-default float-right"><span class="fa fa-edit"></span> Edit</button>


                            <button type="button" id="updatebtn" style="display:none;margin-bottom: 32px;color: blue;margin-right: 20px;" class="btnedit btn btn-default float-right"><span class="fa fa-check"></span> Update</button>


                             <button type="button" onclick="window.location.href=window.location.href" id="canceleditbtn" style="display:none;margin-bottom: 32px;color: maroon;margin-right: 20px;" class="btnedit btn btn-default float-right"><span class="fa fa-times"></span> Cancel</button>
                          </div>
                      </div>

                  </div>

     

                  <div class="row">
                      <div class="col-md-12">
                          <table class="table table-striped" id="itemlisttable">
                              <thead>
                                <tr style="text-align: left;background: #F8F8E7;">
                                  <th colspan="5"><span style="font-weight: bold;font-size: 14pt;">ITEMS</span><span style="display:none;margin-left: 20px;font-weight: normal;font-size: 12pt;">*Note: if item has barcode qty is the number of barcode that will generate else it is the exact value of measurement</span> <p class="alert-danger errmsg" id="itemerr"></p></th>
                                  <th style="text-align: right;"><button disabled type="button" class="btn btn-default" id="showaddItem"><span class="fa fa-plus"></span> ADD ITEM</button></th>
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
                                <script>
                                    let itemlist = [];
                                </script>
                              <tbody id="itemlistbody">
                                  
                              </tbody>

                                @foreach($viewModel->inboundItemsSummary() as $temp)

                                  <script>
                                    itemlist.push("{{$temp->item_id}}")
                                  </script>
                                      <tbody id="itemtbody_{{$temp->item_id}}">
                                          <tr id="list{{$temp->item_id}}" style="background:dimgray;color:white;">
                                            <td>{{$temp->item->description}}</td>
                                            <td>{{$temp->item->productCode}}</td>
                                            <td>

                                              <span id="span{{$temp->item_id}}">
                                                @if($viewModel->getInboundItems($temp->item_id,$viewModel->inboundPending()->id)[0]->hasbarcode == 1)
                                                {{count($viewModel->getInboundItems($temp->item_id,$viewModel->inboundPending()->id))}}
                                                @else
                                                No
                                                @endif
                                              </span> Barcode(s)

                                            </td>
                                            <td>{{$temp->item->unitMeasurement}}</td>
                                            <td></td>
                                            <td width="10%"><span class="fa fa-times removeitemonlist" data-id="{{$temp->item_id}}" style="font-size:14pt;font-weight:bold;cursor:pointer;margin-right:40px;display: none;"></span>
                                              @if($viewModel->getInboundItems($temp->item_id,$viewModel->inboundPending()->id)[0]->hasbarcode == 1)
                                            <span class="fa fa-plus additemonlist" data-uom="{{$temp->item->unitMeasurement}}" data-id="{{$temp->item_id}}" style="font-size:14pt;font-weight:bold;cursor:pointer;display: none;"></span>
                                            @endif
                                            </td>
                                          </tr>
                                          @php $x=0; @endphp
                                          @foreach($viewModel->getInboundItems($temp->item_id,$viewModel->inboundPending()->id) as $item)
                                                 <tr id="item_{{$item->item_id.$x}}" class="item_{{$item->item_id}}">
                                                  <td></td>
                                                  <td>
                                                  @if($item->hasbarcode == 1)
                                                  BARCODE
                                                  @else
                                                  NO BARCODE
                                                  @endif
                                                  
                                                  </td>
                                                  <td><input type="hidden" name="hasbarcode[]" value="{{$item->hasbarcode}}"/>
                                                    <input type="hidden" value="{{$item->item_id}}" name="item[]"/>
                                                    <input type="number" data-id="{{$item->item_id.$x}}" class="itemcart form-control" name="quantity[]" value="{{$item->quantity}}"/></td>
                                                  <td>{{$item->item->unitMeasurement}}</td>
                                                  <td><input type="text" name="remarks[]" class="form-control"/></td>
                                                  <td><span class="removeitem fa fa-minus" style="color:maroon;cursor:pointer;display: none;" data-item="{{$item->item_id}}" data-id="item_{{$item->item_id.$x}}"></span></td>
                                                </tr>
                                          @php $x++; @endphp
                                          @endforeach
   
                                        </tbody>

                                    @endforeach


                          </table>
<!-- 
                          <button type="button" id="saveButton" onclick="createInbound()" class="btn btn-primary float-right"><span class="fa fa-check"></span> CREATE</button> -->
                                   <div class="row">
                <div class="col-md-6">
            <div id="modifiedlogs" style="margin-top: 30px">
               @if($viewModel->inboundPending()->lastmodifiedBy != NULL)
              <span>Last Modified By: 
               
                {{$viewModel->inboundPending()->lastmodifiedBy}} // 
                {{date_format(date_create($viewModel->inboundPending()->updated_at),'M d, Y h:i a')}}
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

function init(){
  $('#showaddItem').attr("disabled",true)
  $('.form-control').attr("readonly",true)
  $('.form-control').css("background","white")
  $('#client').prop('disabled', true)
  $("#client").val("{{$viewModel->inboundPending()->client->id}}").trigger("change")
  $('.removeitem').css("display","none")
  $('.additemonlist').css("display","none")
  $('.removeitemonlist').css("display","none")
  
}

init()

$(document).on('click','#editbtn',function(){
  $('#showaddItem').removeAttr("disabled")
  $('.form-control').removeAttr("readonly")
  $('#client').prop('disabled', false)
  $('#createbtn').attr("disabled",true)
  $('#editbtn').css("display","none")
  $('.btnedit').css("display","block")
  $('.removeitem').css("display","block")
  $('.additemonlist').css("display","inline")
  $('.removeitemonlist').css("display","inline")

})


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
              url: '{{url("")}}/inbound/update/{{$viewModel->inboundPending()->id}}',
              type: 'PATCH',
              data: $('#inboundcreate').serialize(),
              datatype: 'json',
            }).then((res)=>{
                   if(res.errors){
                        $('#clienterr').text(res.errors.client ? res.errors.client : "")
                        $('#drivererr').text(res.errors.driver ? res.errors.driver : "")
                        $('#dateerr').text(res.errors.refdate ? res.errors.refdate : "")
                        $('#unloaderr').text(res.errors.unloadtime ? res.errors.unloadtime : "")
                        $('#finisherr').text(res.errors.finishtime ? res.errors.finishtime : "")
                        $('#itemerr').text(res.errors.item ? "Choose Item(s)" : "")

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
                                        title: "New Supply Succesfully Added!!",
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
                             clearinputerr()
                          }

            })
        }else{

        } 
     });
})

function confirmed(status){
 $.ajax({
    url: '{{url('')}}/inbound/approved/{{$viewModel->inboundPending()->id}}',
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

                            window.location.href = '{{url('')}}/inbound/pending'
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
        $('#updatebtn').attr('disabled','true')
          break
      }else{
          $('#updatebtn').removeAttr('disabled')
      }
  }
}


$(document).on('keyup change','.itemqty',function(){
validate()
})

// let itemlist = [];

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
  validate2()

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
            finaldisplay = finaldisplay +`<span class="fa fa-plus additemonlist" data-uom="${$('#uom').val()}" data-id="${$('#itemid').val()}" style="font-size:14pt;font-weight:bold;cursor:pointer;"></span>`
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
  let findid = itemlist.indexOf(id.toString())
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

