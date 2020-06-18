@extends('layouts.index')


@section('MainContent')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
       
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
         
          <!-- /.col-md-12 -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header bg-default">
               <h3 class="m-0 text-dark"><i class="fa fa-industry"></i> Company Setting</h3>

              </div>
              <div class="card-body">
                 <form method="POST" action="{{route('updateCompanySetting')}}" enctype="multipart/form-data">
                  @csrf
                    <div class="form-group">
                      <label>COMPANY LOGO:</label><br/>
                    <img src="{{ asset('images/company').'/'.$setting[1]->value }}" id="imgpreview" style="max-height: 200px;max-width: 400px;" />
                    <input class="form-control" type="file" name="imgfile" id="imgfile" accept=".png,.jpg" onchange="changePreview(this)">
                  </div>

                  <div class="form-group">
                    <label>COMPANY NAME:</label>
                    <input type="text" name="company" required value="{{$setting[0]->value}}" class="form-control" style="background: white;">
                  </div>

                  <div class="form-group">
                    <label>COMPANY ADDRESS:</label>
                    <input type="text" name="address" required value="{{$setting[2]->value}}" class="form-control" style="background: white;">
                  </div>

                  <button type="button" class="btn btn-default" id="edit"><span class="fa fa-edit"></span> Edit</button>
                   <button type="button" class="btn btn-default" onclick="window.location.href = window.location.href" id="cancel" style="color:maroon;margin-right: 20px;display: none;"><span class="fa fa-times"></span> Cancel</button>
                  <button type="submit" class="btn btn-default" id="update" style="display: none;color: green;"><span class="fa fa-check" ></span> Update</button>
                 
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

$('#settingsnav').addClass("active");

$('.form-control').attr("disabled",true)

$(document).on('click','#edit',function(){
  $('.form-control').removeAttr("disabled")
  $('#edit').css("display","none")
  $('#update').css("display","inline")
  $('#cancel').css("display","inline")
})

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

</script>
@endsection

