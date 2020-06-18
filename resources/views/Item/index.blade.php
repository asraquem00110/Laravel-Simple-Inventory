@extends('layouts.index')


@section('MainContent')



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


          <div class="col-lg-12">
            <div class="card">
              <div class="card-header bg-default">
               <h3 class="m-0 text-dark"> <i class="fa fa-cubes"></i> Item(s) List <select id="selectStatus" style="margin-left: 10px;border-radius: 10px;">
                 
                 <option>ALL</option>
                 <option>LOW</option>
                 <option>WARNING</option>
                 <option>NO STOCK</option>
                 <option>GOOD</option>
               </select>

                <a style="margin-left: 10px;color: blue;" href="javascript:void(0)" data-toggle="modal" data-target="#AddModal" class="btn btn-default float-right"><span class="fa fa-plus"></span> REGISTER NEW ITEM</a>

                <a href="{{url('/exportItemList')}}" class="btn btn-default float-right" style="color: green;"><span class="fa fa-file-excel"></span> EXPORT SUMMARY</a>

                <a href="{{url('/exportItemListDetailed')}}" class="btn btn-default float-right" style="color: green;margin-right: 10px;"><span class="fa fa-file-excel"></span> EXPORT DETAILED</a></h3>

              </div>
              <div class="card-body">
                <div style="">
                  <table class="table table-striped" id="tableData">
                    <thead>
                      <tr>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Remaining quantity</th>
                        <th>Unit Measurement</th>
                      <!--   <th>TIN</th> -->
                    <!--     <th></th> -->
                        <th></th>
                      </tr>
                    </thead>
                 
                 

                  </table>

                </div>
              </div>
            </div>

          </div>


        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <!-- MODALS -->

  <div class="modal" tabindex="-1" role="dialog" id="AddModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title"></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
               </button>
          </div>

          <div class="modal-body">
              <form id="addform" enctype="multipart/form-data">
                    @csrf

                    <img src="{{asset('images/items/default.png')}}" alt="Choose Image" id="imgpreview" style="height: 200px;width: 50%">
                    <input type="file" name="imgfile" id="imgfile" accept=".png,.jpg" onchange="changePreview(this)">

                    <div class="form-group">
                      <label>PRODUCT:</label>
                      <input type="text" class="form-control" name="product" id="product">
                      <p class="alert-danger errmsg" id="producterr"></p>
                    </div>

                    <div class="form-group">
                      <label>CODE:</label>
                      <input type="text" class="form-control" name="productCode" id="productCode">
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
                      <input type="number" class="form-control" value="20" name="warningStock" id="warningStock">
                       <p class="alert-danger errmsg" id="warningerr"></p>
                    </div>


                    <div class="form-group">
                       <label>LOW QTY:</label>
                      <input type="number" class="form-control" value="10" name="dangerStock" id="dangerStock">
                       <p class="alert-danger errmsg" id="dangereerr"></p>
                    </div>


      
        
                    <button type="button" id="savebtn" class="btn btn-warning float-right text-white"><span class="fa fa-plus"></span> CREATE</button>
                </form>
                

          </div>

      <!--     <div class="modal-footer">


          </div> -->
      </div>
    </div>
  </div>


@include('layouts.foot')

<script>

   $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

$('#itemnav').addClass("active");

let fileimg = null
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

getList()

$(document).on('change','#selectStatus',function(){
  getList()
})

function getList(){
  let filter = $('#selectStatus').val()
  $('#tableData').dataTable({
  'bProcessing': true,
  'sAjaxSource': '{{ url("getItemData")}}/'+filter,
  'sAjaxDataProp': "data",
  'destroy': true,
//  'order': [[0,"asc"]],  
'lengthMenu': [[10,50,100,500,-1],[10,50,100,500,'ALL']],

});
}

$(document).on('click','#savebtn',function(){
   // var form = $('#addform')[0]

  let fd = new FormData()
  fd.append('_token',$('input[name=_token]').val())
  fd.append('product',$("#product").val())
  fd.append('productCode',$('#productCode').val())
  fd.append('unit',$("#unit").val())
  fd.append('warningStock',$('#warningStock').val())
  fd.append('dangerStock',$('#dangerStock').val())
  fd.append('imgfile',fileimg)


  $.ajax({
    url: '{{ route("saveitem")}}',
    type: 'POST',
    data: fd,
    processData: false,
    contentType: false,
    cache: false,
    timeout: 600000,
    // datatype: 'json',
    success:function(res){
      if(res.errors){
        $('#producterr').text(res.errors.product ? res.errors.product : "")
        $('#codeerr').text(res.errors.productCode ? res.errors.productCode : "")
        $('#warningerr').text(res.errors.warningStock ? res.errors.warningStock : "")
        $('#dangereerr').text(res.errors.dangerStock ? res.errors.dangerStock : "")
      }else{
       getList()
       $('#AddModal').modal('hide')
      }
    }
  })

})

</script>
@endsection

