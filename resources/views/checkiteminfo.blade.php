@extends('layouts.index')


@section('MainContent')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark"> <i class="fa fa-barcode"></i> CHECK ITEM INFORMATION</h1>
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
  
                  <input type="text" id="searchinput" class="form-control" name="" style="padding: 30px;font-size: 18pt;font-weight: bold;" placeholder="SCAN BARCODE...">
                    <span style="font-size: 10pt;background: dimgray;color: white;padding: 2px 10px;border-radius: 5px;">PUT THE CURSOR/MOUSE HERE WHEN SCANNING ITEMS</span>

              </div>
            </div>

          </div>

          <div class="col-lg-12">
            <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                          <div class="card-body" style="height: 432px;">
                              <img src="{{asset('/images/items/default.png')}}" style="max-height: 400px;width: 100%;" id="itemimg">
                          </div>
                        </div>
                   
                    </div>

                    <div class="col-md-9">

                      <div class="card">
                          <div class="card-body">
                              <table class="table">
                                <tr>
                                  <td width="10%" style="background: #F2F2F2;font-weight: bold;font-size: 16pt;color: dimgray;">PRODUCT</td>
                                  <td align="center"><span style="font-size: 16pt;color: green;font-weight: bold;" id="product"></span></td>

                                </tr>

                                <tr>
                                  <td width="10%" style="background: #F2F2F2;font-weight: bold;font-size: 16pt;color: dimgray;">PRODUCT CODE</td>
                                  <td align="center"><span style="font-size: 16pt;color: green;font-weight: bold;" id="code"></span></td>

                                </tr>

                              
                                <tr>
                                  <td width="10%" style="background: #F2F2F2;font-weight: bold;font-size: 16pt;color: dimgray;">REMAINING QTY</td>
                                  <td align="center"><span style="font-size: 16pt;color: green;font-weight: bold;" id="qty"></span></td>

                                </tr>

                                <tr>
                                  <td width="10%" style="background: #F2F2F2;font-weight: bold;font-size: 16pt;color: dimgray;">UNIT MEASUREMENT</td>
                                  <td align="center"><span style="font-size: 16pt;color: green;font-weight: bold;" id="unit"></span></td>

                                </tr>


                                     <tr>
                                  <td width="10%" style="background: #F2F2F2;font-weight: bold;font-size: 16pt;color: dimgray;">BARCODE</td>
                                  <td align="center"><span style="font-size: 16pt;color: green;font-weight: bold;" id="barcode"></span></td>

                                </tr>

                                     <tr>
                                  <td width="10%" style="background: #F2F2F2;font-weight: bold;font-size: 16pt;color: dimgray;">SERIAL</td>
                                  <td align="center"><span style="font-size: 16pt;color: green;font-weight: bold;" id="serial"></span></td>

                                </tr>

                                     <tr>
                                  <td width="10%" style="background: #F2F2F2;font-weight: bold;font-size: 16pt;color: dimgray;">SPECS/DESCRIPTION</td>
                                  <td align="center"><span style="font-size: 16pt;color: green;font-weight: bold;" id="description"></span></td>

                                </tr>

                              </table>
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


@include('layouts.foot')

<script>

$('#checknav').addClass("active");

$(document).ready(function(){
  $('#searchinput').focus()
})

let typingTimer = ''
let doneTypingInterval = 800

$(document).on('keyup','#searchinput',function(){

  clearTimeout(typingTimer)
  if($('#searchinput').val().length > 0){
    typingTimer = setTimeout(()=>{
          $.ajax({
            url: '{{url('')}}/scanbarcodeItem/'+this.value,
            type: 'GET',
            data: {
              '_token': $('input[name=_token]').val(),
            }
          }).then((res)=>{
              if(res.item == null){

                swal({
                    title: "No Record Found!!",
                    //text: "You will not be able to recover this imaginary file!",
                    type: "error",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1000,
                 })
              }else{
             
                $('#itemimg').attr('src','{{asset("")}}'+'images/items/'+res.item.item.img)
                $('#product').text(res.item.item.description)
                $('#code').text(res.item.item.productCode)
                $('#unit').text(res.item.item.unitMeasurement)
                $('#qty').text(res.item.qty)
                $('#barcode').text(res.item.barcode)
                $('#serial').text(res.item.serialNumber != null ? res.item.serialNumber : "")
                $('#description').text(res.item.description != null ? res.item.description :"")
              }

              $('#searchinput').val("")
          })

    },1000)
  }else{

  }


})

</script>
@endsection

