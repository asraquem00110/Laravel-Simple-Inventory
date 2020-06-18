@extends('layouts.index')


@section('MainContent')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark"> <i class="fa fa-download"></i> REFERENCE # {{$info->refNo}}</h1>
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
              <div class="card-header bg-default" style="background: dimgray;text-align: center;">
               <h3 class="m-0 text-white"><span style="font-weight: bold;font-size: 14pt;">INBOUND RECEIPT</span> 
            </h3>

              </div>
              <div class="card-body">
  
                 <form>
                   <div class="row">


                     <div class="col-md-4">
                      <div class="form-group">
                          <label>CLIENT</label>
                          <select id="client" type="text" class="select2bs4 form-control editdata" name="driver" disabled>
                              <option value="{{$info->client_id}}">{{$info->client->name}}</option>
                              @foreach($clients as $client)
                              @if($client->name != $info->client->name)
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
                          <input type="text" class="form-control editdata" name="driver" value="{{$info->driver}}" readonly>
                          <p class="alert-danger errmsg" id="drivererr"></p>
                      </div>
                    </div>
                

                  <div class="col-md-4">
                      <div class="form-group">
                          <label>PLATE NO</label>
                          <input type="text" class="form-control editdata" value="{{$info->plateNo}}" name="plateno" readonly>
                      </div>
                    </div>

                   </div>

                     <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>CONTAINER</label>
                           <input type="text" class="form-control editdata" name="container"  value="{{$info->container}}" readonly>
                      </div>
                    </div>

                    <div class="col-md-4" style="display: none;">
                      <div class="form-group">
                          <label>REF NO</label>
                          <input type="text" class="form-control editdata" name="refno">
                      </div>
                    </div>
                

                  <div class="col-md-4">
                      <div class="form-group">
                          <label>CONTROL NO</label>
                          <input type="text" class="form-control editdata"  value="{{$info->controlNo}}" name="controlno" readonly>
                      </div>
                    </div>

                       <div class="col-md-4">
                      <div class="form-group">
                          <label>ORIGIN</label>
                           <input type="text" class="form-control editdata"  value="{{$info->origin}}" name="origin" readonly>
                      </div>
                    </div>


                  </div>

                      <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>DATE</label>
                           <input type="date" class="form-control editdata"  value="{{$info->unloadDate}}" name="refdate" readonly>
                           <p class="alert-danger errmsg" id="dateerr"></p>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                          <label>UNLOADING TIME</label>
                          <input type="time" class="form-control editdata"   value="{{$info->unloadTime}}" name="unloadtime" readonly>
                          <p class="alert-danger errmsg" id="unloaderr"></p>
                      </div>
                    </div>
                

                  <div class="col-md-4">
                      <div class="form-group">
                          <label>TIME FINISHED</label>
                          <input type="time" class="form-control editdata" name="finishtime"  value="{{$info->finishUnloadTime}}" readonly>
                          <p class="alert-danger errmsg" id="finisherr"></p>
                      </div>
                    </div>
                  </div>

                      <div class="row">
                 

                    <div class="col-md-4">
                      <div class="form-group">
                          <label>RECEIVED BY</label>
                          <input type="text"  value="{{$info->receivedby}}" class="form-control editdata" name="rcvby" readonly>
                      </div>
                    </div>
                

                  <div class="col-md-4">
                      <div class="form-group">
                          <label>CHECKED BY</label>
                          <input type="text" class="form-control editdata"  value="{{$info->checkedby}}" name="chkby" readonly>
                      </div>
                    </div>

                        <div class="col-md-4">
                      <div class="form-group">
                          <label>NOTED BY</label>
                          <input type="text" class="form-control editdata"  value="{{$info->notedby}}" name="notedby" readonly>
                      </div>
                    </div>

                  </div>

                  
                  <div class="row">
                      <div class="col-md-12">
                          <table class="table table-striped">
                              <thead>
                                <tr style="text-align: left;background: #F8F8E7;">
                                  <th colspan="6"><span style="font-weight: bold;font-size: 14pt;">ITEMS</span> <p class="alert-danger errmsg" id="itemerr"></p></th>
                                  <th style="text-align: right;"><button type="button" class="btn btn-default" id="showaddItem" style="display: none;"><span class="fa fa-plus"></span> ADD ITEM</button></th>
                                </tr>
                                <tr>
                                  <th>DESCRIPTION</th>
                                  <th>CODE</th>
                                  <th>QTY</th>
                                  <th>UOM</th>
                                  <th>REMARKS</th>
                                  <th>HAS BARCODE?</th>
                          
                                </tr>
                              </thead>

                              <tbody id="itemlistbody">
                                 
                                  @foreach($info->temp as $temp)
                                  <tr id="temp{{$temp->id}}">
                                    <td>{{$temp->item->description}}</td>
                                    <td>{{$temp->item->productCode}}</td>
                                    <td><input type="number" class="form-control editdata" value="{{$temp->quantity}}" readonly></td>
                                    <td>{{$temp->item->unitMeasurement}}</td>
                                    <td><input type="text" name="" class="form-control editdata" value="{{$temp->remarks}}" readonly></td>
                                    <td>
                                      <select class="form-control editdata" disabled> 
                                      @if($temp->hasbarcode == 1)
                                        <option value="1">YES</option>
                                        <option value="0">NO</option>
                                        @else
                                         <option value="0">NO</option>
                                        <option value="1">YES</option>
                                        @endif
                                      </select>
                                    </td>
                                    <td><a onclick="removeitem({{$temp->id}})" href="javascript:void(0)" class="removeitem" style="color: maroon;display: none;"><span class="fa fa-times"></span> Remove</a></td>

                                  </tr>
                                  @endforeach
                              </tbody>
                          </table>

                      

                      </div>

                  </div>

                    <button style="display: none;" type="button" id="editbtn" onclick="editInbound()" class="btn btn-success float-left"><span class="fa fa-edit"></span> Edit</button>
                   <button type="button" id="canceleditbtn" style="display: none;" onclick="cancelInbound()" class="btn btn-warning float-left"><span class="fa fa-times"></span> Cancel</button>

                   <button style="display: none;" id="updatebtn" class="btn btn-success  float-right"><span class="fa fa-check"></span> Update</button>
                  <div id="confirmdiv" class="input-group-prepend float-right">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                      <span style="font-weight:bold">Confirmed?</span>
                    </button>
                    <ul class="dropdown-menu">
                      <li class="dropdown-item"><button onclick="confirmed(1)" type="button" class="btn btn-primary" style="margin-right: 20px;"><span class="fa fa-check"></span> YES</button><button onclick="confirmed(2)" class="btn btn-danger" type="button"><span class="fa fa-times"></span> NO</button></li>
                     
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


@include('layouts.foot')

<script>


$(document).ready(function(){
$('#client').val('{{$info->client->id}}')
})

$('#inboundnav').addClass("active")

function removeitem(id){
  $(`#temp${id}`).remove()
}

function editInbound(){
 $('#editbtn').css('display','none')
 $('#canceleditbtn').css('display','block')
 $('#confirmdiv').css('display','none')
 $('#updatebtn').css('display','block')
 $('#showaddItem').css('display','block')
 $('.editdata').removeAttr('readonly')
 $('.editdata').removeAttr('disabled')
 $('#client').addClass('')
 $('.removeitem').css('display','block')
}

function cancelInbound(){
  window.location.href = window.location.href
 // $('#editbtn').css('display','block')
 // $('#canceleditbtn').css('display','none')
 // $('#confirmdiv').css('display','block')
 // $('#updatebtn').css('display','none')
 // $('#showaddItem').css('display','none')
 // $('.editdata').attr('readonly','true')
 // $('.editdata').attr('disabled','true')
 
}

function refreshData(){
  $.ajax({
    url: '{{url('')}}/getItemInfoData/'+'{{$info->id}}',
    type: 'GET',
    success: function(res){
      $('#client').val(res.itemdata.client.id)
      $('select2bs4').trigger('chosen:updated')
    }
  })
}

function confirmed(status){
  let id = "{{$info->id}}"
  $.ajax({
    url: '{{url("")}}/updateInboundStatus/'+id+'',
    type: 'PATCH',
    data: {
      '_token': $('input[name=_token]').val(),
      'status': status,
    },
    datatype: 'json',
    success:function(res){
      if(res.message){
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
                      window.location.href = "{{route('pendingInbound')}}"
                    }
                 })
      }
    }
  })
}

</script>
@endsection

