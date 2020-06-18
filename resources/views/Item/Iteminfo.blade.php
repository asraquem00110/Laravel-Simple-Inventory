@extends('layouts.index')


@section('MainContent')
<!-- GET REMAINING STOCKS -->
{{ App\Models\Item\Item::remaining($viewModel->item()->itemList) }}
<!-- GET STOCK STATUS -->
{{ App\Models\Item\Item::checkstatus($viewModel->item()->danger,$viewModel->item()->warning) }}

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
               <h3 class="m-0 text-white"><a href="{{url('/item/list')}}" class="btn btn-default" style="color: maroon"><span class="fa fa-times"></span> CLOSE</a></h3>

              </div>
              <div class="card-body">
                  

               
                    <div class="row">
                      <div class="col-lg-12">
                              <div class="row">
                                  <div class="col-lg-2" style="text-align: center;">
                                      <img src="{{ asset('images/items').'/'.$viewModel->item()->img}}" style="width: 200px;height: 250px;" />
                                      <br/>
                                      <button type="button" data-toggle="modal" data-target="#ChangeImageModal" class="btn btn-default" style="margin-top: 5px;"><span></span> Change Image</button>
                                  </div>

                                  <div class="col-lg-5">
                                      <table class="table table-striped">
                                          <tr>
                                            <td colspan="2" align="center" style="background: dimgray;color: white;"><span style="font-weight: bold;">PRODUCT INFORMATION</span></td>
                                          </tr>
                                          <tr>
                                            <td><span style="font-weight: bold;">DESCRIPTION:</span></td>
                                            <td>{{$viewModel->item()->description}}</td>
                                          </tr>
                                          <tr>
                                            <td><span style="font-weight: bold;">CODE:</span></td>
                                            <td>{{$viewModel->item()->productCode}}</td>
                                          </tr>
                                           <tr>
                                            <td><span style="font-weight: bold;">REMAINING QUANTITY:</span></td>
                                            <td>{{ App\Models\Item\Item::$remaining }}</td>
                                          </tr>
                                          <tr>
                                            <td><span style="font-weight: bold;">UNIT MEASUREMENT:</span></td>
                                            <td>{{$viewModel->item()->unitMeasurement}}</td>
                                          </tr>
                                      </table>
                                  </div>

                                     <div class="col-lg-5">
                                       <table class="table table-striped">
                                          <tr>
                                            <td colspan="3" align="center" style="background: dimgray;color: white;"><span style="font-weight: bold;">STOCKS INFORMATION</span></td>
                                          </tr>
                                          <tr>
                                            <td><span style="font-weight: bold;">STATUS:</span></td>
                                            <td colspan="2">
                                              @if(App\Models\Item\Item::$status == 0)
                                              <span style="font-weight: bold;color: orange">WARNING</span>
                                              @elseif(App\Models\Item\Item::$status == 1)
                                              <span style="font-weight: bold;color: maroon">LOW</span>
                                              @elseif(App\Models\Item\Item::$status == 2)
                                              <span style="font-weight: bold;color: maroon">NO STOCK</span>
                                              @else
                                              <span style="font-weight: bold;color: green">GOOD</span>
                                              @endif

                                          </td>
                                          </tr>
                                          <tr>
                                            <td><span style="font-weight: bold;">WITH BARCODE:</span></td>
                                            <td colspan="2">{{ App\Models\Item\Item::$withcode.' '.$viewModel->item()->unitMeasurement }}</td>
                                          </tr>
                                           <tr style="opacity: 0">
                                          <td><span style="font-weight: bold;">NO BARCODE:</span></td>
                                            <td colspan="2">{{ App\Models\Item\Item::$nocode.' '.$viewModel->item()->unitMeasurement }}</td>
                                          </tr>
                                            <tr style="background: #E6E2EB;color: dimgray;">
                                            <td><span class="fa fa-cog"></span> <span style="font-weight: bold;">STATUS SETTINGS:</span></td>
                                            <td align="center"><span style="font-weight: bold;">WARNING - {{$viewModel->item()->warning.' '.$viewModel->item()->unitMeasurement}}</span></td>
                                            <td align="center"><span style="font-weight: bold;">LOW - {{$viewModel->item()->danger.' '.$viewModel->item()->unitMeasurement}}</span></td>
                                          </tr>
                                      
                                      </table>
                                      <button id="arhiveItem" class="btn btn-danger float-right"><span class="fa fa-trash-alt"></span> Archive</button>
                                      <button 
                                      data-id="{{$viewModel->item()->id}}" 
                                      data-des="{{$viewModel->item()->description}}"
                                      data-code="{{$viewModel->item()->productCode}}"
                                      data-unit="{{$viewModel->item()->unitMeasurement}}"
                                      data-warning="{{$viewModel->item()->warning}}"
                                      data-low="{{$viewModel->item()->danger}}"
                                      id="editItemInfo" class="btn btn-success float-left"><span class="fa fa-edit"></span> Edit</button>
                                      
                                  </div>

                              </div>
                      </div>
                   
                    </div>
                


              </div>
            </div>

          </div>
          <!-- /.col-md-6 -->

        <!-- FREE STORAGE -->
            <div class="col-lg-12" style="display: none;">
                 <div class="card">
              <div class="card-header" style="background: mistyrose">
               <h3 class="m-0 text-dark">NO BARCODE STORAGE</h3>

              </div>
                <div class="card-body">
                               <table class="table table-condensed table-bordered">
                        <thead>
                          
                            <tr>
                              <th></th>
                              <th>BARCODE</th>
                              <th>QTY</th>
                          
                              <th width="20%"></th>
                            </tr>
                        </thead>
                        <tbody>

                      
                          <tr style="padding: 10pt 0pt;background: #F8F8E7;font-weight: bold;font-size: 14pt;">
                            <td></td>
                            <td>{{$viewModel->item()->itemListStorage->barcode}}</td>

                            <td>{{$viewModel->item()->itemListStorage->qty}}</td>
                           
                            <td style="font-size: 12pt;font-weight: bold;"> 
                              <a href="javascript:void(0)" style="color: green;margin-right: 20px;" class="showaddreduceModal" data-flag="1" data-remaining="{{$viewModel->item()->itemListStorage->qty}}" data-id="{{$viewModel->item()->itemListStorage->id}}" data-action="Add"><span class="fa fa-plus"></span> Add Stock</a>
                                <a href="javascript:void(0)" style="color: maroon" class="showaddreduceModal" data-flag="1" data-remaining="{{$viewModel->item()->itemListStorage->qty}}" data-id="{{$viewModel->item()->itemListStorage->id}}" data-action="Reduce"><span class="fa fa-minus"></span> Reduce Stock</a>
                              </td>
                          </tr>
                                 
                        </tbody>

                      </table>
                </div>

              </div>

            </div>


            <div class="col-lg-12">
                 <div class="card">
              <div class="card-header bg-default">
               <h3 class="m-0 text-dark"><span class="fa fa-barcode"></span> WITH BARCODE STORAGE<button style="color: green;" data-toggle="modal" data-target="#ItemModal" class="btn btn-default float-right"><span class="fa fa-plus"></span> Add New Stocks W/ Barcode(s)</button></h3>

              </div>
                <div class="card-body">
                        <div class="col-md-4">
                            <form method="GET" action="">
                             <div class="form-group">
                           
                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="text" class="form-control" name="barcode" placeholder="Search via Barcode...">
                               
                                </div>
                                <div class="input-group-append">
                                  <button type="submit" class="btn btn-default"><span class="fa fa-search"></span> Search</button>
                                </div>
                              </div>
                           </div>
                         </form>
                        </div>
                         <table class="table table-bordered table-condensed" id="bcodedatatable">
                        <thead>

                            <tr style="background: #F2F2F2">
                              <th rowspan="2"></th>
                              <th rowspan="2">BARCODE</th>
                              <th rowspan="2">SERIALNUMBER</th>
                               <th rowspan="2">DESCRIPTION</th>
                              <th colspan="2" style="text-align: center;">INBOUND</th>
                             
                              <th rowspan="2">REMARKS</th>
                              <th rowspan="2">QTY</th>
                              <th rowspan="2">UOM</th>
                              <th rowspan="2" width="10%;"></th>
                       
                            </tr>

                            <tr style="background: #F2F2F2">
                              <th>REF #</th>
                              <th>DATE</th>
                            </tr>
                        </thead>

                        
                        <tbody id="barcodeItems">
                          @foreach($itemlist as $list)
                          @if($list->qty > 0)
                          <tr style="padding: 10pt 0pt;" id="itemlist{{$list->id}}">
                          @else
                          <tr style="padding: 10pt 0pt;background: mistyrose" id="itemlist{{$list->id}}">
                          @endif
                            <td></td>
                            <td><span style="font-size: 14pt">{{$list->barcode}}</span></td>
                            <td><span style="font-size: 14pt;">{{$list->serialNumber}}</span></td>
                             <td><span style="font-size: 14pt;">{{$list->description}}</span></td>
                            <td><span style="font-size: 14pt;">
                                @if($list->inbound_id == NULL)

                                @else
                                  {{$list->Inbound->refNo}}
                                @endif

                            </span></td>

                            <td><span style="font-size: 14pt;">
                                @if($list->inbound_id == NULL)

                                @else
                                  {{date_format(date_create($list->Inbound->created_at),'M d, Y')}}
                                @endif

                            </span></td>


                           
                             <td><span style="font-size: 14pt;">{{$list->remarks}}</span></td>
                            <td><span style="font-size: 14pt;">{{$list->qty}}</span></td>
                            <td><span style="font-size: 14pt;">{{$list->item->unitMeasurement}}</span></td>
                            <td><a 
                              data-id="{{$list->id}}" 
                              data-bcode="{{$list->barcode}}"
                              data-serialNo="{{$list->serialNumber}}"
                              data-qrcode="{{$list->qrcode}}"
                              data-description="{{$list->description}}"
                              data-qty="{{$list->qty}}"
                              data-remarks="{{$list->remarks}}" 
                              data-uom="{{$list->item->unitMeasurement}}"
                              class="showItemEditModal" href="javascript:void(0)" style="color:green"><span class="fa fa-edit"></span> Edit Details</a></td>
                           
                          </tr>
                         
                          @endforeach
                        </tbody>
                    </table>
                      <div style="margin-top:10px;">

                    {{ $viewModel->paginateItem()->links() }} 
                  </div>
                </div>

              </div>
            </div>

           <!-- /.col-md-12 -->
       
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



<!-- Modals -->

<div class="modal" role="dialog" id="ChangeImageModal">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
         <h5 class="modal-title"></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
               </button>
      </div>

        <div class="modal-body">
            <form method="POST" action="{{route('updateItemImage')}}" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id" value="{{$viewModel->item()->id}}">
               <img src="{{ asset('images/items').'/'.$viewModel->item()->img}}" alt="Choose Image" id="imgpreview" style="height: 200px;width: 50%">
                <input type="file" name="imgfile" id="imgfile" accept=".png,.jpg" onchange="changePreview(this)" required>

                <br/><br/>
                <button class="btn btn-default float-left" type="button" data-dismiss="modal"><span class="fa fa-times"></span> Close</button>
                <button type="submit" class="btn btn-success float-right"><span class="fa fa-check"></span> Update</button>
            </form>
        </div>
         </div>
         </div>
  </div>


<div class="modal" tabindex="-1" role="dialog" id="editModal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title"></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
               </button>
      </div>

        <div class="modal-body">

              <form>
                    <input type="hidden" name="" id="itemid">
                    <input type="hidden" name="" id="oldcode">
                    <div class="form-group">
                      <label>DESCRIPTION:</label>
                      <input type="text" class="form-control" name="description" id="description">
                      <p class="alert-danger errmsg" id="descriptionerr"></p>
                    </div>
              
                    <div class="form-group">
                      <label>CODE:</label>
                      <input type="text" class="form-control" name="code" id="code">
                      <p class="alert-danger errmsg" id="codeerr"></p>
                    </div>
     

                    <div class="form-group">
                      <label>UNIT MEASUREMENT:</label>
                      <select class="form-control" name="unit" id="unit">
                        @foreach($viewModel->units() as $unit)
                          <option>{{$unit->unit}}</option>
                        @endforeach
                      </select>
                       <p class="alert-danger errmsg" id="uniterr"></p>
                    </div>
 

                    <div class="form-group">
                      <label>WARNING QTY:</label>
                      <input type="number" value="0" class="form-control" name="warning" id="warning">
                      <p class="alert-danger errmsg" id="warningerr"></p>
                    </div>

                    <div class="form-group">
                      <label>LOW QTY:</label>
                      <input type="number" value="0" class="form-control" name="low" id="low">
                      <p class="alert-danger errmsg" id="lowerr"></p>
                    </div>


              </form>

        </div>

        <div class="modal-footer">
            <button onclick="updateItemInfo()" class="btn btn-success float-right"><span class="fa fa-check"></span> Update</button>
        </div>
    </div>
  </div>
</div>




<div class="modal" tabindex="-1" role="dialog" id="ItemEditModal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title"></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
               </button>
      </div>

        <div class="modal-body">
          <form>
            <input type="hidden" id="editItemlistid" name="">

            <div class="row">
              <div class="col col-md-6">
                <div class="form-group">
                  <label>Barcode</label>
                  <input type="text" name="" class="form-control" readonly id="editbcode">
                </div>
             </div>
             <div class="col col-md-6">
            <div class="form-group">
              <label>Serial #</label>
              <input type="text" name="" class="form-control" id="editserial">
              <p class="alert-danger errmsg" id="serialerr"></p>
            </div>
          </div>
          </div>

          <div class="row">
              <div class="col col-md-6">
            <div class="form-group">
              <label>QR code</label>
              <input type="text" name="" class="form-control" id="editqrcode">
                 <p class="alert-danger errmsg" id="qrerr"></p>
            </div>
          </div>

          <div class="col col-md-6">
            <div class="form-group">
              <label>Description</label>
              <input type="text" name="" class="form-control" id="editdescription">
              <p class="alert-danger errmsg" id="deserr"></p>
            </div>
          </div>
        </div>


          <div class="row">
            <div class="col col-md-6">
            <div class="form-group">
              <label>Quantity</label>
              <input type="number" name="" class="form-control" id="editqty" readonly>
              <hr/>
              <button type="button" class="btn btn-xs btn-success float-left showaddreduceModal" data-flag="0" data-remaining="" data-id="" data-action="Add"><span class="fa fa-plus"></span> ADD</button>
              <button id="reducebtn" type="button" class="btn btn-xs btn-danger float-right showaddreduceModal" data-flag="0" data-remaining="" data-id="" data-action="Reduce"><span class="fa fa-times"></span> REDUCE</button>
                 <p class="alert-danger errmsg" id="qtyerr"></p>
            </div>
          </div>

          <div class="col col-md-6">
            <div class="form-group">
              <label>Remarks</label>
              <textarea class="form-control" id="editremarks"></textarea>
            </div>
          </div>
          </div>





          </form>
        </div>

        <div class="modal-footer">
            <button onclick="updateItemListInfo()" type="button" class="btn btn-primary float-right"><span class="fa fa-check"></span> Update</button>
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
                  <input type="text" class="form-control" id="des" readonly style="background: white;"  value="{{$viewModel->item()->description}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Product Code</label>
                  <input type="text" class="form-control" id="code" readonly style="background: white;"  value="{{$viewModel->item()->productCode}}">
                </div>
              </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                     <div class="form-group">
                  <label>Unit of Measurement</label>
                  <input type="text" class="form-control" id="uom" readonly style="background: white;"  value="{{$viewModel->item()->unitMeasurement}}">
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
                 <label id="qbcodemsg">Quantity of Barcode</label>
                  <input type="number" class="form-control" id="quantity">
                </div>
              </div>


          <div class="col col-md-12">
            <div class="form-group">
              <label>Remarks</label>
              <textarea class="form-control" id="remarks"></textarea>
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
              <button type="button" class="btn btn-success float-right" onclick="addItems()" disabled id="addItembtn">Add</button>
            </form>
          </div>

          <div class="modal-footer">
        
          </div>
        </div>

    </div>

  </div>




<div class="modal" role="dialog" id="addreduceModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header bg-success">
                <h4><span id="manual_msg"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
               </button>

          </div>

          <div class="modal-body">
                <input type="hidden" name="" id="itemlistmanual_flag">
                <input type="hidden" name="" id="itemlistmanual_remaining">
                <input type="hidden" name="" id="itemlistmanual_id">
              <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="" class="form-control" id="itemlistmanual_quantity" value="1">
                  <p class="alert-danger errmsg" id="itemlistmanual_quantity_err"></p>
              </div>

              <div class="form-group">
                <label>Remarks</label>
                 <textarea class="form-control" id="itemlistmanual_remarks"></textarea>
                  <p class="alert-danger errmsg" id="itemlistmanual_remarks_err"></p>
              </div>

              <button class="btn btn-default float-left" type="button" data-dismiss="modal"><span class="fa fa-times"></span> Close</button>
                 <button class="btn btn-success float-right" type="button" onclick="manualaddstocks()"><span class="fa fa-check"></span> Confirm</button>
          </div>

          <div class="modal-footer">
        
          </div>
        </div>

    </div>

  </div>



@include('layouts.foot')

<script>

$('#itemnav').addClass("active")

function changePreview(e){
  var files = e.files
  var reader
  if(files.Length === 0){
    console.log('empty');
  }else{
    reader = new FileReader();
    reader.onload = (e)=>{
      $('#imgpreview').attr('src',e.target.result)
    }

    reader.readAsDataURL(files[0]);
      fileimg = e.files[0]
  }



}

function manualaddstocks(){
  let itemlistid = $("#itemlistmanual_id").val()
  let quantity = $("#itemlistmanual_quantity").val()
  let remarks = $('#itemlistmanual_remarks').val()
  let action = $('#manual_msg').text()
  let flag = $('#itemlistmanual_flag').val()
  let remaining = $("#itemlistmanual_remaining").val()

  //alert(itemlistid + " "+quantity+ " "+remarks+ " "+action+ " "+flag +" "+remaining)
      swal({
        title: "Confirm Action?",
        //text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: 'Yes!',
        cancelButtonText: "No!",
        closeOnConfirm: true,
        closeOnCancel: true,
     },
     function(isConfirm){

       if (isConfirm){
            $.ajax({
              url: '{{url("")}}/item/itemlistmanualadd/'+itemlistid,
              type: 'PATCH',
              data: {
                '_token': $('input[name=_token]').val(),
                quantity: quantity,
                remarks: remarks,
                action: action,
                flag: flag,
                remaining: remaining,
              },
              datatype: 'json',
              success:function(res){
                if(res.errors){
                  $('#itemlistmanual_quantity_err').text(res.errors.quantity ? res.errors.quantity : "")
                  $('#itemlistmanual_remarks_err').text(res.errors.remarks ? res.errors.remarks : "")
                }

                      if(res.message == "success"){
             swal({
                    title: "Successful !!",
                    //text: "You will not be able to recover this imaginary file!",
                    type: "success",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1500,
                 })
             
              setTimeout(()=>{
                window.location.href = window.location.href
              },1000)
                
        }else if(res.message =="fail"){

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
        } 
     });
}


$(document).on('click','.showaddreduceModal',function(){
  let flag = $(this).data('flag')
  $('#itemlistmanual_flag').val(flag)
  $("#itemlistmanual_remaining").val(flag == "1" ? $(this).data('remaining') : $('#editqty').val())
  $('#itemlistmanual_id').val(flag == "1" ? $(this).data('id') : $('#editItemlistid').val())
  $('#manual_msg').text($(this).data('action'))
  $('#itemlistmanual_remarks').val("")
  $("#itemlistmanual_quantity").val(1)
  $('#itemlistmanual_quantity_err').text("")
  $('#itemlistmanual_remarks_err').text("")
  $('#addreduceModal').modal('show')


})


function addItems(){
     swal({
        title: `Confirmed ?!!`,
       // text: `Inbound approval was ${res.message}!!`,
        type: "success",
        showCancelButton: true,
        confirmButtonText: 'Yes!',
         cancelButtonText: "No!",
         closeOnConfirm: true,
         closeOnCancel: true,
     },function(isConfirm){
        if(isConfirm){
          confirmedAddItems()
        }

      })


}


function confirmedAddItems(){
    let itemid = '{{$viewModel->item()->id}}'
  let itemqty = $('.itemqty')
  let hasbarcode = $("#hasbarcode").val()
  let remarks = $('#remarks').val()
  let items = []

    for(let x = 0 ; x < itemqty.length ; x++){
        items.push(itemqty[x].value)
    }

    $.ajax({
      url: '{{url("")}}/item/manualaddstocks',
      type: 'POST',
      data: {
        '_token': $('input[name=_token]').val(),
        itemid: itemid,
        items: items,
        hasbarcode: hasbarcode,
        remarks: remarks,
      },
      datatype: 'json',
      success: function(res){
        if(res.message == "success"){
             swal({
                    title: "Succesfully added!!",
                    //text: "You will not be able to recover this imaginary file!",
                    type: "success",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1500,
                 })
              $('#ItemModal').modal('hide')
              setTimeout(()=>{
                window.location.href = window.location.href
              },1000)
                
        }else{

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


$(document).on('change','.itemqty',function(){
validate()
})

$(document).on('keyup','#quantity',function(){
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
            <td>BARCODE ${(x + 1)}</td>
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

$(document).on('change','#hasbarcode',function(){
  let hasbarcode = this.value
  $("#qbcodemsg").text(hasbarcode == "YES" ? "Quantity of Barcode" : "Quantity")
  
})

// $('#bcodedatatable').dataTable()

function updateItemListInfo(){
   let url = "/updateItemListInfo/"+$('#editItemlistid').val()+""
  $.ajax({
   url: '{{url('')}}'+url+'',
    type: 'PATCH',
    data: {
      '_token': $("input[name=_token]").val(),
      'serial': $('#editserial').val(),
      'qrcode': $('#editqrcode').val(),
      'description': $('#editdescription').val(),
      'qty': $('#editqty').val(),
      'remarks': $('#editremarks').val(),
    },
    datatype: 'json',
    success: function(res){
      if(res.errors){
        $('#serialerr').text()
        $('#qrerr').text()
        $('#qtyerr').text(res.errors.qty ? res.errors.qty : "")
        $('#deserr').text()
      }else{
              swal({
                    title: `${res.message}!!`,
                   // text: `Inbound approval was ${res.message}!!`,
                    type: "success",
                    showCancelButton: false,
                    confirmButtonText: 'Ok!',
                    // cancelButtonText: "No!",
                    closeOnConfirm: true,
                    // closeOnCancel: true,
                 },function(isConfirm){
                    if(isConfirm){
                  
                     $(`#itemlist${res.itemlist.id}`).html(`<td></td>
                        <td><span style="font-size: 14pt">${res.itemlist.barcode != null ? res.itemlist.barcode : ""}</span></td>
                        <td><span style="font-size: 14pt;">${res.itemlist.serialNumber != null ? res.itemlist.serialNumber : ""}</span></td>
                        <td><span style="font-size: 14pt;">${res.itemlist.description != null ? res.itemlist.description : ""}</span></td>
                        <td><span style="font-size: 14pt;">${res.itemlist.inbound_id != null ? res.itemlist.inbound.refNo : ""}</span></td>
                        <td><span style="font-size: 14pt;">${res.itemlist.inbound_id != null ? res.itemlist.inbound.created_at : ""}</span></td>
                         <td><span style="font-size: 14pt;">${res.itemlist.remarks != null ? res.itemlist.remarks : ""}</span></td>
                        <td><span style="font-size: 14pt;">${res.itemlist.qty != null ? res.itemlist.qty : ""}</span></td>
                        <td><span style="font-size: 14pt;">${res.itemlist.item.unitMeasurement}</span></td>
                        <td><a 
                              data-id="${res.itemlist.id}" 
                              data-bcode="${res.itemlist. barcode}"
                              data-serialNo="${res.itemlist.serialNumber}"
                              data-qrcode="${res.itemlist.qrcode}"
                              data-description="${res.itemlist.description}"
                              data-qty="${res.itemlist.qty}"
                              data-remarks="${res.itemlist.remarks}" 
                              class="showItemEditModal" href="javascript:void(0)" style="color:green"><span class="fa fa-edit"></span> Edit Details</a></td>
                        `)

                     $('#ItemEditModal').modal('hide')
                     initSearchfocus()
                    }
                 })
      }
    }
  })
}

$(document).on('click','.showItemEditModal',function(){
  $('#editItemlistid').val($(this).data('id'))
  $('#editbcode').val($(this).data('bcode'))
  $('#editserial').val($(this).data('serialNo'))
  $('#editqrcode').val($(this).data('qrcode'))
  $('#editdescription').val($(this).data('description'))
  $('#editqty').val($(this).data('qty'))
  $('#editremarks').val($(this).data('remarks'))
  $('#ItemEditModal').modal('show')

  if($('#editqty').val() == 0){
    $('#reducebtn').attr('disabled',true)
  }else{
    $('#reducebtn').removeAttr('disabled')
  }
})

function initSearchfocus(){
  $('#searchitem').focus()
}

$(document).ready(function(){
initSearchfocus()
})

$(document).on('click','#arhiveItem',function(){
    let id = "{{$viewModel->item()->id}}"
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
              let url = "/item/archive/"+id+""
              $.ajax({
                url: '{{url('')}}'+url+'',
                type: 'PATCH',
                data: {
                  '_token': $('input[name=_token]').val(),
                  'status': 1,
                },
                datatype: 'json',
                success: function(res){
              
                       swal({
                          title: "Item has been archived",
                          //text: "You will not be able to recover this imaginary file!",
                          type: "success",
                          showCancelButton: false,
                          confirmButtonText: 'Yes!',
                          cancelButtonText: "No!",
                          closeOnConfirm: false,
                          closeOnCancel: true,
                       },
                       function(isConfirm){

                         if (isConfirm){
                          window.location.href = '{{url("")}}/item/list'
                          } 
                       });

                }
              })
        } 
     });
})


$(document).on('click','#editItemInfo',function(){
  cleareditinputErrors()
  $('#itemid').val($(this).data('id'))
  $('#oldcode').val($(this).data('code'))
  $('#description').val($(this).data('des'))
  $('#code').val($(this).data('code'))
  $('#unit').val($(this).data('unit'))
  $('#warning').val($(this).data('warning'))
  $('#low').val($(this).data('low'))
  $('#editModal').modal('show')
})


function cleareditinputErrors(){
    $('#descriptionerr').text("")
    $('#codeerr').text("")
    $('#warningerr').text("")
    $('#lowerr').text("")
}

function updateItemInfo(){
    let url = "/updateItemInfo"
    $.ajax({
      url: '{{url('')}}'+url+'',
      type: 'PATCH',
      data: {
        '_token': $('input[name=_token]').val(),
        'id': $('#itemid').val(),
        'oldcode': $('#oldcode').val(),
        'product': $('#description').val(),
        'productCode': $('#code').val(),
        'unit': $('#unit').val(),
        'warningStock': $('#warning').val(),
        'dangerStock': $('#low').val(),
      },
      datatype: 'json',
      success: function(res){
          if(res.errors){
              $('#descriptionerr').text(res.errors.product ? res.errors.product : "")
              $('#codeerr').text(res.errors.productCode ? res.errors.productCode : "")
              $('#warningerr').text(res.errors.warningStock ? res.errors.warningStock : "")
              $('#lowerr').text(res.errors.dangerStock ? res.errors.dangerStock : "")
          }else{
            window.location.href = window.location.href
          }


      }
    })
}

</script>
@endsection

