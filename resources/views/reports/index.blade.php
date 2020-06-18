@extends('layouts.index')


@section('MainContent')

  <style>
    ul li {
      font-size: 14pt;
    }

    ul li a {
      color: black;

    }
  </style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark"> <i class="fa fa-edit"></i> Reports</h1>
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
             <!--  <div class="card-header bg-warning">
               <h3 class="m-0 text-white">&nbsp;</h3>

              </div> -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                      <div class="col-md-12">
                          <h3  class="bg-default" style="border:1px solid black;padding: 10px 20px;border-radius: 10px;"><span class="fa fa-download"></span> Inbound Supplies</h3>
                            <div class="row">
                          <div class="col-md-6">
                                 <h3 class="bg-info" style="color: white;padding: 10px 20px;border-radius: 10px;"><span class="fa fa-check"></span> Purchased</h3>
                                  <ul>
                                    <li><a class="inboundModal"  data-type="a"  href="javascript:void(0)">Detailed Report Daily</a></li>
                                    <li><a class="inboundModal" data-type="b" href="javascript:void(0)">Detailed Report per Items</a></li>
                                    <li><a class="inboundModal" data-type="c" href="javascript:void(0)">Detailed Report per Supplier</a></li>
                                  </ul>
                          </div>
                          <div class="col-md-6">
                              <h3  class="bg-info" style="background: #696969;color: white;padding: 10px 20px;border-radius: 10px;"><span class="fa fa-undo"></span> Return Item(s)</h3>
                                  <ul>
                                    <li><a class="returnModal"  data-type="a"  href="javascript:void(0)">Detailed Report Daily</a></li>
                                    <li><a class="returnModal" data-type="b" href="javascript:void(0)">Detailed Report per Items</a></li>
                                    <li><a class="returnModal" data-type="c" href="javascript:void(0)">Detailed Report per Site</a></li>
                                  </ul>
                          </div>
                        </div>
                      </div>

                  </div>

                  <div class="col-md-6">
                      <div class="col-md-12">
                          <h3  class="bg-default" style="border:1px solid black;padding: 10px 20px;border-radius: 10px;"><span class="fa fa-upload"></span> Outbound Supplies</h3>
                            <div class="row">
                                    <div class="col-md-6">
                                      <h3 class="bg-danger" style="background: #696969;color: white;padding: 10px 20px;border-radius: 10px;"><span class="fa fa-times"></span> Outbound</h3>
                                      <ul>
                                        <li><a class="outboundModal" data-type="a" href="javascript:void(0)">Detailed Report Daily</a></li>
                                        <li><a class="outboundModal" data-type="b" href="javascript:void(0)">Detailed Report per Items</a></li>
                                        <li><a class="outboundModal" data-type="c" href="javascript:void(0)">Detailed Report per Sites</a></li>
                                      </ul>
                                    </div>

                                     <div class="col-md-6">
                                       <h3 class="bg-danger" style="background: #696969;color: white;padding: 10px 20px;border-radius: 10px;"><span class="fa fa-truck"></span> Delivery</h3>
                                      <ul>
                                         <li><a class="deliveryModal" data-type="a" href="javascript:void(0)">Detailed Report Daily</a></li>
                                        <li><a class="deliveryModal" data-type="b" href="javascript:void(0)">Detailed Report per Items</a></li>
                                       <li><a class="deliveryModal" data-type="c" href="javascript:void(0)">Detailed Report per Sites</a></li>
                                       </ul>
                                    </div>

                            </div>
                       </div>

                  </div>

                </div>



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

<div class="modal" role="dialog" id="inboundModal"  data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
      <div class="modal-header bg-info">
         <h5 class="modal-title"></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
               </button>
      </div>
      <div class="modal-body">
        <form id="inboundForm">
            @csrf
            <input type="hidden" id="inboundType" name="type"/>
            <div class="form-group">
              <label>DATE FROM:</label>
              <input id="inboundDatefrom" type="date" name="datefrom" class="form-control">
               <p class="alert-danger errmsg" id="Idatefromerr"></p>
            </div>

            <div class="form-group">
              <label>DATE TO:</label>
              <input id="inboundDateto" type="date" name="dateto" class="form-control">
               <p class="alert-danger errmsg" id="Idatetoerr"></p>
            </div>

            <div class="form-group" id="inboundChooseItem" style="display: none;">
              <label>ITEM</label>
              <select class="form-control" id="selecttypeInbound" name="selecttype">
                <option>ALL</option>
                <option>SELECT</option>
              </select>
            </div>


            <div class="form-group" id="selectinbounditem" style="display: none;">
              <label>CHOOSE ITEM</label>
              <select class="form-control select2bs4" multiple="multiple" name="" id="selectiteminbound">
                  @foreach($viewModel->getItems() as $item)
                  <option value="{{$item->id}}">{{$item->description}}</option>
                  @endforeach

              </select>
               <p class="alert-danger errmsg" id="IselectItemerr"></p>
              <input type="hidden" name="selectitem" id="selectiteminbound_Val">
            </div>



             <div class="form-group" id="inboundChooseSupplier" style="display: none;">
              <label>SUPPLIER</label>
              <select class="form-control" id="selecttypeInboundSupplier" name="selecttypeSupplier">
                <option>ALL</option>
                <option>SELECT</option>
              </select>
            </div>


            <div class="form-group" id="selectinboundSupplier" style="display: none;">
              <label>CHOOSE SUPPLIER</label>
              <select class="form-control select2bs4" multiple="multiple" name="" id="selectsupplierinbound">
                  @foreach($viewModel->sitesSuppliers() as $supplier)
                  @if($supplier->type == 1)
                  <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                  @endif
                  @endforeach

              </select>
               <p class="alert-danger errmsg" id="IselectSuppliererr"></p>
              <input type="hidden" name="selectsupplier" id="selectsupplierinbound_Val">
            </div>


              <button class="btn btn-default float-left" type="button" data-dismiss="modal"><span class="fa fa-times"></span> Close</button>
              <button onclick="generateInbound()" class="btn btn-primary float-right" type="button"><span class="fa fa-check"></span> Generate</button>

          </form>


      </div>
  </div>
</div>
</div>



<div class="modal" role="dialog" id="returnModal"  data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
      <div class="modal-header bg-info">
         <h5 class="modal-title"></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
               </button>
      </div>
      <div class="modal-body">
        <form id="returnForm">
            @csrf
            <input type="hidden" id="returnType" name="type"/>
            <div class="form-group">
              <label>DATE FROM:</label>
              <input id="returnDatefrom" type="date" name="datefrom" class="form-control">
               <p class="alert-danger errmsg" id="Rdatefromerr"></p>
            </div>

            <div class="form-group">
              <label>DATE TO:</label>
              <input id="returnDateto" type="date" name="dateto" class="form-control">
               <p class="alert-danger errmsg" id="Rdatetoerr"></p>
            </div>

            <div class="form-group" id="returnChooseItem" style="display: none;">
              <label>ITEM</label>
              <select class="form-control" id="selecttypeReturn" name="selecttype">
                <option>ALL</option>
                <option>SELECT</option>
              </select>
            </div>


            <div class="form-group" id="selectreturnitem" style="display: none;">
              <label>CHOOSE ITEM</label>
              <select class="form-control select2bs4" multiple="multiple" name="" id="selectitemreturn">
                  @foreach($viewModel->getItems() as $item)
                  <option value="{{$item->id}}">{{$item->description}}</option>
                  @endforeach

              </select>
               <p class="alert-danger errmsg" id="RselectItemerr"></p>
              <input type="hidden" name="selectitem" id="selectitemreturn_Val">
            </div>



             <div class="form-group" id="returnChooseSupplier" style="display: none;">
              <label>SUPPLIER</label>
              <select class="form-control" id="selecttypeReturnSupplier" name="selecttypeSupplier">
                <option>ALL</option>
                <option>SELECT</option>
              </select>
            </div>


            <div class="form-group" id="selectreturnSupplier" style="display: none;">
              <label>CHOOSE SUPPLIER</label>
              <select class="form-control select2bs4" multiple="multiple" name="" id="selectsupplierreturn">
                  @foreach($viewModel->sitesSuppliers() as $supplier)
                  @if($supplier->type == 1)
                  <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                  @endif
                  @endforeach

              </select>
               <p class="alert-danger errmsg" id="RselectSuppliererr"></p>
              <input type="hidden" name="selectsupplier" id="selectsupplierreturn_Val">
            </div>


              <button class="btn btn-default float-left" type="button" data-dismiss="modal"><span class="fa fa-times"></span> Close</button>
              <button onclick="generateReturn()" class="btn btn-primary float-right" type="button"><span class="fa fa-check"></span> Generate</button>

          </form>


      </div>
  </div>
</div>
</div>



<div class="modal" role="dialog" id="outboundModal"  data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
      <div class="modal-header bg-danger">
         <h5 class="modal-title"></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
               </button>
      </div>
      <div class="modal-body">

          <form id="outboundForm">
            @csrf
            <input type="hidden" id="outboundType" name="type"/>
            <div class="form-group">
              <label>DATE FROM:</label>
              <input id="outboundDatefrom" type="date" name="datefrom" class="form-control">
               <p class="alert-danger errmsg" id="Odatefromerr"></p>
            </div>

            <div class="form-group">
              <label>DATE TO:</label>
              <input id="outboundDateto" type="date" name="dateto" class="form-control">
               <p class="alert-danger errmsg" id="Odatetoerr"></p>
            </div>

            <div class="form-group" id="outboundChooseItem" style="display: none;">
              <label>ITEM</label>
              <select class="form-control" id="selecttypeOutbound" name="selecttype">
                <option>ALL</option>
                <option>SELECT</option>
              </select>
            </div>


            <div class="form-group" id="selectoutbounditem" style="display: none;">
              <label>CHOOSE ITEM</label>
              <select class="form-control select2bs4" multiple="multiple" name="" id="selectitemoutbound">
                  @foreach($viewModel->getItems() as $item)
                  <option value="{{$item->id}}">{{$item->description}}</option>
                  @endforeach

              </select>
               <p class="alert-danger errmsg" id="OselectItemerr"></p>
              <input type="hidden" name="selectitem" id="selectitemoutbound_Val">
            </div>


            <div class="form-group" id="outboundChooseSupplier" style="display: none;">
              <label>SITE</label>
              <select class="form-control" id="selecttypeOutboundSupplier" name="selecttypeSupplier">
                <option>ALL</option>
                <option>SELECT</option>
              </select>
            </div>


            <div class="form-group" id="selectoutboundSupplier" style="display: none;">
              <label>CHOOSE SITE</label>
              <select class="form-control select2bs4" multiple="multiple" name="" id="selectsupplieroutbound">
                  @foreach($viewModel->sitesSuppliers() as $supplier)
                  @if($supplier->type == 0)
                  <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                  @endif
                  @endforeach

              </select>
               <p class="alert-danger errmsg" id="OselectSuppliererr"></p>
              <input type="hidden" name="selectsupplier" id="selectsupplieroutbound_Val">
            </div>


              <button class="btn btn-default float-left" type="button" data-dismiss="modal"><span class="fa fa-times"></span> Close</button>
              <button onclick="generateOutbound()" class="btn btn-primary float-right" type="button"><span class="fa fa-check"></span> Generate</button>

          </form>

      </div>
  </div>
</div>
</div>


<div class="modal" role="dialog" id="deliveryModal"  data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
      <div class="modal-header bg-danger">
         <h5 class="modal-title"></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
               </button>
      </div>
      <div class="modal-body">

              <form id="deliveryForm">
            @csrf
            <input type="hidden" id="deliveryType" name="type"/>
            <div class="form-group">
              <label>DATE FROM:</label>
              <input id="deliveryDatefrom" type="date" name="datefrom" class="form-control">
               <p class="alert-danger errmsg" id="Ddatefromerr"></p>
            </div>

            <div class="form-group">
              <label>DATE TO:</label>
              <input id="deliveryDateto" type="date" name="dateto" class="form-control">
               <p class="alert-danger errmsg" id="Ddatetoerr"></p>
            </div>

            <div class="form-group" id="deliveryChooseItem" style="display: none;">
              <label>ITEM</label>
              <select class="form-control" id="selecttypeDelivery" name="selecttype">
                <option>ALL</option>
                <option>SELECT</option>
              </select>
            </div>


            <div class="form-group" id="selectdeliveryitem" style="display: none;">
              <label>CHOOSE ITEM</label>
              <select class="form-control select2bs4" multiple="multiple" name="" id="selectitemdelivery">
                  @foreach($viewModel->getItems() as $item)
                  <option value="{{$item->id}}">{{$item->description}}</option>
                  @endforeach

              </select>
               <p class="alert-danger errmsg" id="DselectItemerr"></p>
              <input type="hidden" name="selectitem" id="selectitemdelivery_Val">
            </div>

            <div class="form-group" id="deliveryChooseSupplier" style="display: none;">
              <label>SITE</label>
              <select class="form-control" id="selecttypeDeliverySupplier" name="selecttypeSupplier">
                <option>ALL</option>
                <option>SELECT</option>
              </select>
            </div>


            <div class="form-group" id="selectdeliverySupplier" style="display: none;">
              <label>CHOOSE SITE</label>
              <select class="form-control select2bs4" multiple="multiple" name="" id="selectsupplierdelivery">
                  @foreach($viewModel->sitesSuppliers() as $supplier)
                  @if($supplier->type == 0)
                  <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                  @endif
                  @endforeach

              </select>
               <p class="alert-danger errmsg" id="DselectSuppliererr"></p>
              <input type="hidden" name="selectsupplier" id="selectsupplierdelivery_Val">
            </div>


              <button class="btn btn-default float-left" type="button" data-dismiss="modal"><span class="fa fa-times"></span> Close</button>
              <button onclick="generateDelivery()" class="btn btn-primary float-right" type="button"><span class="fa fa-check"></span> Generate</button>

          </form>

      </div>
  </div>
</div>
</div>


@include('layouts.foot')

<script>

$('#reportnav').addClass("active");


// INBOUND

$(document).on('change','#selectiteminbound',function(){
    $('#selectiteminbound_Val').val($('#selectiteminbound').val())
})

$(document).on('change','#selectsupplierinbound',function(){
    $('#selectsupplierinbound_Val').val($('#selectsupplierinbound').val())
})

$(document).on('change','#selecttypeInbound',function(){
  if(this.value == "ALL"){
    $('#selectinbounditem').css("display","none")
  }else{
    $('#selectinbounditem').css("display","block")
  }
})

$(document).on('change','#selecttypeInboundSupplier',function(){
  if(this.value == "ALL"){
    $('#selectinboundSupplier').css("display","none")
  }else{
    $('#selectinboundSupplier').css("display","block")
  }
})


$(document).on('click','.inboundModal',function(){
  $('#Idatefromerr').text("")
  $('#Idatetoerr').text("")
  $('#inboundType').val($(this).data('type'))
  $('.select2bs4').val([]).trigger('change')
  $('#selecttypeInbound').val("ALL")
  $('#selectinbounditem').css("display","none")
  $('#selectinboundSupplier').css("display","none")
  $('#selecttypeInboundSupplier').val("ALL")

  if($(this).data('type') == "b"){
    $('#inboundChooseItem').css("display","block")
  }else{
    $('#inboundChooseItem').css("display","none")
  }

  if($(this).data('type') == "c"){
    $('#inboundChooseSupplier').css("display","block")
  }else{
     $('#inboundChooseSupplier').css("display","none")
  }

  $('#inboundModal').modal('show')
})


function generateInbound(){
  let datefrom = $('#inboundDatefrom').val()
  let dateto = $('#inboundDateto').val()
  let type = $('#inboundType').val()

  $.ajax({
    url: '{{url("")}}/reports/validate',
    type: 'POST',
    data: $('#inboundForm').serialize(),
  }).then((res)=>{
    if(res.errors){
      $('#Idatefromerr').text(res.errors.datefrom ? res.errors.datefrom : "")
      $('#Idatetoerr').text(res.errors.dateto ? res.errors.dateto : "")
      $('#IselectItemerr').text(res.errors.selectitem ? res.errors.selectitem : "")
      $('#IselectSuppliererr').text(res.errors.selectsupplier ? "This field is required" : "")
    }

    if(res.message == "success"){
       window.location.href = "{{url('')}}/reports/inbound/"+datefrom+"/"+dateto+"/"+type  
    }else if(res.message == "fail"){

    }
  })

}


// RETURN

$(document).on('change','#selectitemreturn',function(){
    $('#selectitemreturn_Val').val($('#selectitemreturn').val())
})

$(document).on('change','#selectsupplierreturn',function(){
    $('#selectsupplierreturn_Val').val($('#selectsupplierreturn').val())
})

$(document).on('change','#selecttypeReturn',function(){
  if(this.value == "ALL"){
    $('#selectreturnitem').css("display","none")
  }else{
    $('#selectreturnitem').css("display","block")
  }
})

$(document).on('change','#selecttypeReturnSupplier',function(){
  if(this.value == "ALL"){
    $('#selectreturnSupplier').css("display","none")
  }else{
    $('#selectreturnSupplier').css("display","block")
  }
})


$(document).on('click','.returnModal',function(){
  $('#Rdatefromerr').text("")
  $('#Rdatetoerr').text("")
  $('#returnType').val($(this).data('type'))
  $('.select2bs4').val([]).trigger('change')
  $('#selecttypeReturn').val("ALL")
  $('#selectreturnitem').css("display","none")
  $('#selectreturnSupplier').css("display","none")
  $('#selecttypeReturnSupplier').val("ALL")

  if($(this).data('type') == "b"){
    $('#returnChooseItem').css("display","block")
  }else{
    $('#returnChooseItem').css("display","none")
  }

  if($(this).data('type') == "c"){
    $('#returnChooseSupplier').css("display","block")
  }else{
     $('#returnChooseSupplier').css("display","none")
  }

  $('#returnModal').modal('show')
})


function generateReturn(){
  let datefrom = $('#returnDatefrom').val()
  let dateto = $('#returnDateto').val()
  let type = $('#returnType').val()

  $.ajax({
    url: '{{url("")}}/reports/validate',
    type: 'POST',
    data: $('#returnForm').serialize(),
  }).then((res)=>{
    if(res.errors){
      $('#Rdatefromerr').text(res.errors.datefrom ? res.errors.datefrom : "")
      $('#Rdatetoerr').text(res.errors.dateto ? res.errors.dateto : "")
      $('#RselectItemerr').text(res.errors.selectitem ? res.errors.selectitem : "")
      $('#RselectSuppliererr').text(res.errors.selectsupplier ? "This field is required" : "")
    }

    if(res.message == "success"){
       window.location.href = "{{url('')}}/reports/return/"+datefrom+"/"+dateto+"/"+type  
    }else if(res.message == "fail"){

    }
  })

}







// OUTBOUND

$(document).on('change','#selectitemoutbound',function(){
    $('#selectitemoutbound_Val').val($('#selectitemoutbound').val())
})

$(document).on('change','#selectsupplieroutbound',function(){
    $('#selectsupplieroutbound_Val').val($('#selectsupplieroutbound').val())
})

$(document).on('change','#selecttypeOutbound',function(){
  if(this.value == "ALL"){
    $('#selectoutbounditem').css("display","none")
  }else{
    $('#selectoutbounditem').css("display","block")
  }
})

$(document).on('change','#selecttypeOutboundSupplier',function(){
  if(this.value == "ALL"){
    $('#selectoutboundSupplier').css("display","none")
  }else{
    $('#selectoutboundSupplier').css("display","block")
  }
})



$(document).on('click','.outboundModal',function(){
  $('#Odatefromerr').text("")
  $('#Odatetoerr').text("")
  $('#outboundType').val($(this).data('type'))
  $('.select2bs4').val([]).trigger('change')
  $('#selecttypeOutbound').val("ALL")
   $('#selecttypeOutboundSupplier').val("ALL")
   $('#selectoutbounditem').css("display","none")
    $('#selectoutboundSupplier').css("display","none")

  if($(this).data('type') == "b"){
    $('#outboundChooseItem').css("display","block")
  }else{
    $('#outboundChooseItem').css("display","none")
  }

   if($(this).data('type') == "c"){
    $('#outboundChooseSupplier').css("display","block")
  }else{
    $('#outboundChooseSupplier').css("display","none")
  }


  $('#outboundModal').modal('show')
})


function generateOutbound(){
  let datefrom = $('#outboundDatefrom').val()
  let dateto = $('#outboundDateto').val()
  let type = $('#outboundType').val()

  $.ajax({
    url: '{{url("")}}/reports/validate',
    type: 'POST',
    data: $('#outboundForm').serialize(),
  }).then((res)=>{
    if(res.errors){
      $('#Odatefromerr').text(res.errors.datefrom ? res.errors.datefrom : "")
      $('#Odatetoerr').text(res.errors.dateto ? res.errors.dateto : "")
      $('#OselectItemerr').text(res.errors.selectitem ? res.errors.selectitem : "")
      $('#OselectSuppliererr').text(res.errors.selectsupplier ? "This field is required" : "")
    }

    if(res.message == "success"){
      window.location.href = "{{url('')}}/reports/outbound/"+datefrom+"/"+dateto+"/"+type  
    }else if(res.message == "fail"){

    }
  })

}


// DELIVERY

$(document).on('change','#selectitemdelivery',function(){
    $('#selectitemdelivery_Val').val($('#selectitemdelivery').val())
})

$(document).on('change','#selectsupplierdelivery',function(){
    $('#selectsupplierdelivery_Val').val($('#selectsupplierdelivery').val())
})

$(document).on('change','#selecttypeDeliverySupplier',function(){
  if(this.value == "ALL"){
    $('#selectdeliverySupplier').css("display","none")
  }else{
    $('#selectdeliverySupplier').css("display","block")
  }
})



$(document).on('change','#selecttypeDelivery',function(){
  if(this.value == "ALL"){
    $('#selectdeliveryitem').css("display","none")
  }else{
    $('#selectdeliveryitem').css("display","block")
  }
})


$(document).on('click','.deliveryModal',function(){
  $('#Ddatefromerr').text("")
  $('#Ddatetoerr').text("")
  $('#deliveryType').val($(this).data('type'))
  $('.select2bs4').val([]).trigger('change')
  $('#selecttypeDelivery').val("ALL")
  $('#selectdeliveryitem').css("display","none")
  $('#selecttypeDeliverySupplier').val("ALL")
  $('#selectdeliverySupplier').css("display","none")

  if($(this).data('type') == "b"){
    $('#deliveryChooseItem').css("display","block")
  }else{
    $('#deliveryChooseItem').css("display","none")
  }

  if($(this).data('type') == "c"){
    $('#deliveryChooseSupplier').css("display","block")
  }else{
    $('#deliveryChooseSupplier').css("display","none")
  }

  $('#deliveryModal').modal('show')
})

function generateDelivery(){
  let datefrom = $('#deliveryDatefrom').val()
  let dateto = $('#deliveryDateto').val()
  let type = $('#deliveryType').val()

  $.ajax({
    url: '{{url("")}}/reports/validate',
    type: 'POST',
    data: $('#deliveryForm').serialize(),
  }).then((res)=>{
    if(res.errors){
      $('#Ddatefromerr').text(res.errors.datefrom ? res.errors.datefrom : "")
      $('#Ddatetoerr').text(res.errors.dateto ? res.errors.dateto : "")
      $('#DselectItemerr').text(res.errors.selectitem ? res.errors.selectitem : "")
      $('#DselectSuppliererr').text(res.errors.selectsupplier ? "This field is required" : "")
    }

    if(res.message == "success"){
       window.location.href = "{{url('')}}/reports/delivery/"+datefrom+"/"+dateto+"/"+type  
    }else if(res.message == "fail"){

    }
  })

}




</script>
@endsection

