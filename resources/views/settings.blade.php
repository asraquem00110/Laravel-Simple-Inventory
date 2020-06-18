@extends('layouts.index')


@section('MainContent')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark"> <i class="fa fa-cogs"></i> Settings</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
              <hr/>
        <div class="row">
    
            <div class="col-12 col-sm-6 col-md-3">
                <a href="javascript:void(0)" style="color: black;" id="changepass">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
              
              <div class="info-box-content">
                <span class="info-box-text">Change Password</span>
                <span class="info-box-number">
          <!--         10
                  <small>%</small> -->
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
              <a href="{{url('units')}}" style="color: black;">
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-balance-scale"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Manage Unit of Measurement</span>
                <span class="info-box-number">&nbsp;</span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-3">
              <a href="{{route('manageusers')}}" style="color: black;">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Manage Users</span>
                <span class="info-box-number">&nbsp;</span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

              <div class="col-12 col-sm-6 col-md-3">
              <a href="{{route('companyinfo')}}" style="color: black;">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1" style="background: violet !important;"><i class="fas fa-industry"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Company Info</span>
                <span class="info-box-number">&nbsp;</span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

        </div>
        <!-- /.row -->
              <hr/>

            <div class="row">

                 <div class="col-12 col-sm-6 col-md-4" style="position: relative;">
                <span class="fa fa-edit" id="barcodeEdit" style="position: absolute;top: 7px;right:12px;z-index: 1;font-size: 9pt;"> Edit</span>
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-barcode"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Barcode Fill Zero(es) Format</span>
                <span class="info-box-number" id="barcodezero">-</span>

              </div>
              <!-- /.info-box-content -->
            </div>
        
            <!-- /.info-box -->
          </div>


                 <div class="col-12 col-sm-6 col-md-4" style="position: relative;">
                <span class="fa fa-edit" id="inboundedit" style="position: absolute;top: 7px;right:12px;z-index: 1;font-size: 9pt;"> Edit</span>
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-download"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">InBound Ref No Fill Zero(es) Format</span>
                <span class="info-box-number" id="inzero">-</span>

              </div>
              <!-- /.info-box-content -->
            </div>
        
            <!-- /.info-box -->
          </div>


                 <div class="col-12 col-sm-6 col-md-4" style="position: relative;">
                <span class="fa fa-edit" id="outboundEdit" style="position: absolute;top: 7px;right:12px;z-index: 1;font-size: 9pt;"> Edit</span>
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-upload"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">OutBound Ref No Fill Zero(es) Format</span>
                <span class="info-box-number" id="outzero">-</span>

              </div>
              <!-- /.info-box-content -->
            </div>
        
            <!-- /.info-box -->
          </div>



              <div class="col-12 col-sm-6 col-md-4" style="position: relative;">
                <span class="fa fa-edit" id="dispatchEdit" style="position: absolute;top: 7px;right:12px;z-index: 1;font-size: 9pt;"> Edit</span>
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-truck"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Dispatch Ref No Fill Zero(es) Format</span>
                <span class="info-box-number" id="diszero">-</span>

              </div>
              <!-- /.info-box-content -->
            </div>
        
            <!-- /.info-box -->
          </div>


              <div class="col-12 col-sm-6 col-md-4" style="position: relative;">
                <span class="fa fa-edit" id="returnEdit" style="position: absolute;top: 7px;right:12px;z-index: 1;font-size: 9pt;"> Edit</span>
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-undo"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Return Ref No Fill Zero(es) Format</span>
                <span class="info-box-number" id="returnzero">-</span>

              </div>
              <!-- /.info-box-content -->
            </div>
        
            <!-- /.info-box -->
          </div>
            </div>

            <hr/>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Modals -->

  <div class="modal" role="dialog" id="barcodeZeroModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
             </button></div>
      <div class="modal-body" style="text-align: center;">

           
             <br/>
          <span style="font-weight: bold;">Set No. of Zero(es) in Barcode String</span>
          <input type="number" name="" class="form-control zeroqty" id="newbarcodezero">
           <p class="alert-danger errmsg" id="barcodezeroerr"></p>
          <br/>
          <button tybpe="button" class="btn btn-default float-left" data-dismiss="modal"><span class="fa fa-times"></span> CLOSE</button>
          <button tybpe="button" class="btn btn-success float-right addzerobtn"  onclick="updatebarcodezero()"><span class="fa fa-check"></span> UPDATE</button>
      </div>
    </div>
    </div>
  </div>



  <div class="modal" role="dialog" id="inboundZeroModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
             </button></div>
      <div class="modal-body" style="text-align: center;">

             <br/>
          <span style="font-weight: bold;">Set No. of Zero(es) in Inbound Ref #</span>
          <input type="number" name="" class="form-control zeroqty" id="newinboundzero">
           <p class="alert-danger errmsg" id="inboundzeroerr"></p>
          <br/>
          <button tybpe="button" class="btn btn-default float-left" data-dismiss="modal"><span class="fa fa-times"></span> CLOSE</button>
          <button tybpe="button" class="btn btn-success float-right addzerobtn"  onclick="updateinboundzero()"><span class="fa fa-check"></span> UPDATE</button>
      </div>
    </div>
    </div>
  </div>


  <div class="modal" role="dialog" id="outboundZeroModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
             </button></div>
      <div class="modal-body" style="text-align: center;">

           
             <br/>
          <span style="font-weight: bold;">Set No. of Zero(es) in Outbound Ref #</span>
          <input type="number" name="" class="form-control zeroqty" id="newoutboundzero">
           <p class="alert-danger errmsg" id="outboundzeroerr"></p>
          <br/>
          <button tybpe="button" class="btn btn-default float-left" data-dismiss="modal"><span class="fa fa-times"></span> CLOSE</button>
          <button tybpe="button" class="btn btn-success float-right addzerobtn"  onclick="updateoutboundzero()"><span class="fa fa-check"></span> UPDATE</button>
      </div>
    </div>
    </div>
  </div>



  <div class="modal" role="dialog" id="disZeroModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success">  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
             </button></div>
      <div class="modal-body" style="text-align: center;">

          
             <br/>
          <span style="font-weight: bold;">Set No. of Zero(es) in Dispatch Ref #</span>
          <input type="number" name="" class="form-control zeroqty" id="newdiszero">
           <p class="alert-danger errmsg" id="diszeroerr"></p>
          <br/>
          <button tybpe="button" class="btn btn-default float-left" data-dismiss="modal"><span class="fa fa-times"></span> CLOSE</button>
          <button tybpe="button" class="btn btn-success float-right addzerobtn"  onclick="updatediszero()"><span class="fa fa-check"></span> UPDATE</button>
      </div>
    </div>
    </div>
  </div>


    <div class="modal" role="dialog" id="returnZeroModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success">  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
             </button></div>
      <div class="modal-body" style="text-align: center;">

          
             <br/>
          <span style="font-weight: bold;">Set No. of Zero(es) in Return Ref #</span>
          <input type="number" name="" class="form-control zeroqty" id="newreturnzero">
           <p class="alert-danger errmsg" id="returnzeroerr"></p>
          <br/>
          <button tybpe="button" class="btn btn-default float-left" data-dismiss="modal"><span class="fa fa-times"></span> CLOSE</button>
          <button tybpe="button" class="btn btn-success float-right addzerobtn"  onclick="updatereturnzero()"><span class="fa fa-check"></span> UPDATE</button>
      </div>
    </div>
    </div>
  </div>



    <div class="modal" role="dialog" id="changepassModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
             </button>
        </div>
      <div class="modal-body">

         
             <br/>
          <span style="font-weight: bold;">Set New Password</span>
          <input type="password" name="" class="form-control" id="newpassword">
           <p class="alert-danger errmsg" id="passerr"></p>
          <br/>
          <button tybpe="button" class="btn btn-default float-left" data-dismiss="modal"><span class="fa fa-times"></span> CLOSE</button>
          <button tybpe="button" class="btn btn-primary float-right"  onclick="updatepassword()"><span class="fa fa-check"></span> UPDATE</button>
      </div>
    </div>
    </div>
  </div>





@include('layouts.foot')

<script>

$('#settingsnav').addClass("active");

$(document).on('keyup change','.zeroqty',function(){
  if(this.value <= 0){
      $('.addzerobtn').attr("disabled",true)
      this.classList.add("is-invalid")
    }else{
        $('.addzerobtn').removeAttr("disabled")
        this.classList.remove("is-invalid")
    }

})


function updatepassword(){
  let password = $("#newpassword").val();
  $.ajax({
    url: '{{url("")}}/changepassword/'+'{{Auth::User()->id}}'+'',
    type: 'PATCH',
    data: {
      '_token': $('input[name=_token]').val(),
      'pass': password,
    },
    datatype: 'json',
    success: function(res){
      if(res.errors){
        $('#passerr').text(res.errors.pass ? res.errors.pass : "")
      }

      if(res.message == "success"){
               swal({
                    title: "Password Successfully changed!!",
                    //text: "You will not be able to recover this imaginary file!",
                    type: "success",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1500,
                 })
               $('#changepassModal').modal('hide')
      }else if(res.message == "fail"){
          swal({
                    title: "Something Went Wrong!!",
                    //text: "You will not be able to recover this imaginary file!",
                    type: "error",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1500,
                 })
      }
    }
  })
}


$(document).on('click','#changepass',function(){
  $('#changepassModal').modal('show')
  $("#passerr").text("")
  $('#newpassword').val("")
})



$(document).ready(function(){

  init()
})

function init(){
  let url = "/api/getSettingInit"
  $.ajax({
      url: '{{url('')}}'+url+'',
      type: 'POST',
      data: {
        '_token': $('input[name=_token]').val(),
      },
      datatype: 'json',
      success: function(res){
          $("#barcodezero").text(res.setting[0].value)
          $("#inzero").text(res.setting[1].value)
          $("#outzero").text(res.setting[2].value)
          $('#diszero').text(res.setting[3].value)
          $('#returnzero').text(res.setting[7].value)
      }
    })
}

function updatebarcodezero(){
  let barcodezero = $('#newbarcodezero').val()
    let url = "/api/updateBarcodeSettingCount"
  $.ajax({
      url: '{{url('')}}'+url+'',
      type: 'PATCH',
      data: {
        '_token': $('input[name=_token]').val(),
        'key': 'barcodeZero',
        'val': barcodezero,
      },
      datatype: 'json',
      success: function(res){
         if(res.errors){
          $("#barcodezeroerr").text(res.errors.val ? res.errors.val : "")
         }

         if(res.message){
           $("#barcodezeroerr").text(res.message ? res.message : "")
           if(res.message == "ok"){
            $("#barcodezeroerr").removeClass('alert-danger')
            $("#barcodezeroerr").addClass('alert-success')
            init()
           }else{
            $("#barcodezeroerr").addClass('alert-danger')
            $("#barcodezeroerr").removeClass('alert-success')
           }
         }
      }
  })
}

$(document).on('click','#barcodeEdit',function(){
  $("#barcodeZeroModal").modal('show')
  $("#barcodezeroerr").text("")
  $("#newbarcodezero").val($('#barcodezero').text())
})


function updateinboundzero(){
  let inboundzero = $("#newinboundzero").val()
  let url = "/api/updateBarcodeSettingCount"
  $.ajax({
      url: '{{url('')}}'+url+'',
      type: 'PATCH',
      data: {
        '_token': $('input[name=_token]').val(),
        'key': 'inboundZero',
        'val': inboundzero,
      },
      datatype: 'json',
      success: function(res){
         if(res.errors){
          $("#inboundzeroerr").text(res.errors.val ? res.errors.val : "")
         }

         if(res.message){
           $("#inboundzeroerr").text(res.message ? res.message : "")
           if(res.message == "ok"){
            $("#inboundzeroerr").removeClass('alert-danger')
            $("#inboundzeroerr").addClass('alert-success')
            init()
           }else{
            $("#inboundzeroerr").addClass('alert-danger')
            $("#inboundzeroerr").removeClass('alert-success')
           }
         }
      }
  })
}

$(document).on('click','#inboundedit',function(){
  $("#inboundZeroModal").modal('show')
  $("#inboundzeroerr").text("")
  $("#newinboundzero").val($('#inzero').text())
})


function updateoutboundzero(){
  let outboundzero = $("#newoutboundzero").val()
  let url = "/api/updateBarcodeSettingCount"
  $.ajax({
      url: '{{url('')}}'+url+'',
      type: 'PATCH',
      data: {
        '_token': $('input[name=_token]').val(),
        'key': 'outboundZero',
        'val': outboundzero,
      },
      datatype: 'json',
      success: function(res){
         if(res.errors){
          $("#outboundzeroerr").text(res.errors.val ? res.errors.val : "")
         }

         if(res.message){
           $("#outboundzeroerr").text(res.message ? res.message : "")
           if(res.message == "ok"){
            $("#outboundzeroerr").removeClass('alert-danger')
            $("#outboundzeroerr").addClass('alert-success')
            init()
           }else{
            $("#outboundzeroerr").addClass('alert-danger')
            $("#outboundzeroerr").removeClass('alert-success')
           }
         }
      }
  })
}


$(document).on('click','#outboundEdit',function(){
  $("#outboundZeroModal").modal('show')
  $("#outboundzeroerr").text("")
  $("#newoutboundzero").val($('#outzero').text())
})



function updatediszero(){
    let diszero = $("#newdiszero").val()
  let url = "/api/updateBarcodeSettingCount"
  $.ajax({
      url: '{{url('')}}'+url+'',
      type: 'PATCH',
      data: {
        '_token': $('input[name=_token]').val(),
        'key': 'disZero',
        'val': diszero,
      },
      datatype: 'json',
      success: function(res){
         if(res.errors){
          $("#diszeroerr").text(res.errors.val ? res.errors.val : "")
         }

         if(res.message){
           $("#diszeroerr").text(res.message ? res.message : "")
           if(res.message == "ok"){
            $("#diszeroerr").removeClass('alert-danger')
            $("#diszeroerr").addClass('alert-success')
            init()
           }else{
            $("#diszeroerr").addClass('alert-danger')
            $("#diszeroerr").removeClass('alert-success')
           }
         }
      }
  })
}

$(document).on('click','#dispatchEdit',function(){
  $("#disZeroModal").modal('show')
  $("#diszeroerr").text("")
  $("#newdiszero").val($('#diszero').text())
})



function updatereturnzero(){
    let returnzero = $("#newreturnzero").val()
  let url = "/api/updateBarcodeSettingCount"
  $.ajax({
      url: '{{url('')}}'+url+'',
      type: 'PATCH',
      data: {
        '_token': $('input[name=_token]').val(),
        'key': 'returnZero',
        'val': returnzero,
      },
      datatype: 'json',
      success: function(res){
         if(res.errors){
          $("#returnzeroerr").text(res.errors.val ? res.errors.val : "")
         }

         if(res.message){
           $("#returnzeroerr").text(res.message ? res.message : "")
           if(res.message == "ok"){
            $("#returnzeroerr").removeClass('alert-danger')
            $("#returnzeroerr").addClass('alert-success')
            init()
           }else{
            $("#returnzeroerr").addClass('alert-danger')
            $("#returnzeroerr").removeClass('alert-success')
           }
         }
      }
  })
}


$(document).on('click','#returnEdit',function(){
  $("#returnZeroModal").modal('show')
  $("#returnzeroerr").text("")
  $("#newreturnzero").val($('#returnzero').text())
})



</script>
@endsection

