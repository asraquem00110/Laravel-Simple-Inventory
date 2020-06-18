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
               <h3 class="m-0 text-white"><a href="{{url('/item/list')}}" class="btn btn-default"><span class="fa fa-times"></span> CLOSE</a></h3>

              </div>
              <div class="card-body">
                  

               
                    <div class="row">
                      <div class="col-lg-12">
                              <div class="row">
                                  <div class="col-lg-2" style="text-align: center;">
                                      <img src="{{ asset('images/items').'/'.$viewModel->item()->img}}" style="width: 200px;height: 250px;" />
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
                                           <tr>
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


            <div class="col-lg-12">
                 <div class="card">
          <!--     <div class="card-header bg-default">
               <h3 class="m-0 text-white">&nbsp;</h3>

              </div> -->
              <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr style="background: dimgray;color: white;"> 
                              <th colspan="5">NO BARCODE STORAGE</th>
                            </tr>
                            <tr>
                              <th></th>
                              <th>BARCODE</th>
                              <th>QTY</th>
                              <th>LOGS/HISTORY</th>
                              <th></th>
                            </tr>
                        </thead>
                        <tbody>

                      
                          <tr style="padding: 10pt 0pt;background: #F8F8E7;font-weight: bold;font-size: 14pt;">
                            <td></td>
                            <td>{{$viewModel->item()->itemListStorage->barcode}}</td>

                            <td>{{$viewModel->item()->itemListStorage->qty}}</td>
                            <td style="font-size: 12pt;font-weight: bold;"><a href="#" style="color: blue"><span class="fa fa-search-plus"></span> View</a></td>
                            <td style="font-size: 12pt;font-weight: bold;"><!--  <a href="#" style="color: green;margin-right: 20px;"><span class="fa fa-plus"></span> Add Stock</a>
                                <a href="#" style="color: maroon"><span class="fa fa-minus"></span> Reduce Stock</a> -->
                              </td>
                          </tr>
                     
               


                        </tbody>

                      </table>

                      <br/>
<!-- <input id="searchitem" type="text" class="form-control" name="" style="padding: 25px;font-size: 18pt;font-weight: bold" placeholder="SEARCH"> -->
  <br/>
  <hr/>
                         <table class="table table-striped table-bordered table-condensed" id="bcodedatatable">
                        <thead>
                              <tr style="background: dimgray;color: white;font-weight: bold;">
                                 <td colspan="9">WITH BARCODE STORAGE</th>
                            </tr>
                            <tr>
                              <th></th>
                              <th>BARCODE</th>
                              <th>SERIALNUMBER</th>
                              <th>QR CODE</th>
                              <th>DESCRIPTION</th>
                              <th>QTY</th>
                              <th>UOM</th>
                              <th></th>
                              <th></th>
                            </tr>
                        </thead>

                        
                        <tbody id="barcodeItems">
                          @foreach($viewModel->item()->itemListCurrent as $list)
                        
                          <tr style="padding: 10pt 0pt;" id="itemlist{{$list->id}}">
                            <td></td>
                            <td><span style="font-size: 14pt">{{$list->barcode}}</span></td>
                            <td><span style="font-size: 14pt;">{{$list->serialNumber}}</span></td>
                            <td><span style="font-size: 14pt;">{{$list->qrcode}}</span></td>
                            <td><span style="font-size: 14pt;">{{$list->description}}</span></td>
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
                              class="showItemEditModal" href="javascript:void(0)" style="color:green"><span class="fa fa-edit"></span> Edit Details</a></td>
                            <td></td>
                          </tr>
                         
                          @endforeach
                        </tbody>
                    </table>
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


<div class="modal" tabindex="-1" role="dialog" id="editModal">
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




<div class="modal" tabindex="-1" role="dialog" id="ItemEditModal">
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


@include('layouts.foot')

<script>

$('#itemnav').addClass("active")

$('#bcodedatatable').dataTable()

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
                        <td><span style="font-size: 14pt;">${res.itemlist.qrcode != null ? res.itemlist.qrcode : ""}</span></td>
                        <td><span style="font-size: 14pt;">${res.itemlist.description != null ? res.itemlist.description : ""}</span></td>
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
                            <td></td>

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

