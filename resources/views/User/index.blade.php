@extends('layouts.index')


@section('MainContent')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark"> <i class="fa fa-users"></i> Manage Users</h1>
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
              <div class="card-header bg-success">
               <h3 class="m-0 text-dark"><span class="text-white"><i class="fa fa-check"></i>  Active List</span><a href="javascript:void(0)" data-toggle="modal" data-target="#AddModal" class="btn btn-default float-right"><span class="fa fa-plus"></span> CREATE</a></h3>

              </div>
              <div class="card-body">
                
                  <table class="table tabledata">
                      <thead>
                          <tr>
                            <th>#</th>
                            <th>FullName</th>
                            <th>Email Address</th>
                            <th width="5%"></th>
                            <th width="12%"></th>
                            <th width="8%"></th>
                          </tr>
                      </thead>
                      <tbody>
                          @php $x=1; @endphp
                          @foreach($viewModel->active() as $user)
                          <tr>
                            <td>{{$x++}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td><a href="javascript:void(0)" class="editUser" 
                              data-name="{{$user->name}}"
                              data-email="{{$user->email}}"
                              data-id="{{$user->id}}"
                              style="color: green"> <span class="fa fa-edit"></span> Edit</a></td>
                            <td>@if(Auth::User()->id != $user->id)<a href="javascript:void(0)" class="changepass" data-id="{{$user->id}}"> <span class="fa fa-lock"></span> Change Password</a>@endif</td>
                            <td>@if(Auth::User()->id != $user->id)<a href="javascript:void(0)" class="archivedata"  data-id="{{ $user->id }}" style="color: maroon"> <span class="fa fa-trash"></span> Archive</a>@endif</td>
                          </tr>
                          @endforeach

                      </tbody>
                  </table>
                
              </div>
            </div>

          </div>
          <!-- /.col-md-6 -->



        </div>
        <!-- /.row -->
        <hr/>
        <div class="row">


               <!-- /.col-md-12 -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header bg-danger" style="background: mistyrose !important;">
               <h3 class="m-0 text-white"><span class="text-dark"> <i class="fa fa-trash"></i> Archive List</span></h3>

              </div>
              <div class="card-body">
                
                  <table class="table tabledata">
                      <thead>
                          <tr>
                            <th>#</th>
                            <th>FullName</th>
                            <th>Email Address</th>
                            <th width="5%"></th>
                          </tr>
                      </thead>
                      <tbody>
                        @php $x=1; @endphp
                        @foreach($viewModel->archive() as $user)
                        <tr>
                          <td>{{$x++}}</td>
                          <td>{{$user->name}}</td>
                          <td>{{$user->email}}</td>
                          <td><a href="javascript:void(0)" class="restoredata" data-id="{{ $user->id }}"   style="color: green"> <span class="fas fa-refresh"></span> Restore</a></td>
                        </tr>
                        @endforeach

                      </tbody>
                  </table>
                
              </div>
            </div>

          </div>
          <!-- /.col-md-6 -->

        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- MODALS -->

    <div class="modal" tabindex="-1" role="dialog" id="AddModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header bg-success">
              <h5 class="modal-title"></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
               </button>
          </div>

          <div class="modal-body">
              <form id="newUserForm">
                    @csrf
                    <div class="form-group">
                      <label>FULLNAME:</label>
                      <input type="text" class="form-control" name="name" required>
                      <p class="alert-danger errmsg" id="nameerr"></p>
                    </div>

                    <div class="form-group">
                      <label>EMAIL:</label>
                      <input type="email" class="form-control" name="email" required>
                      <p class="alert-danger errmsg" id="emailerr"></p>
                    </div>

                     <div class="form-group">
                      <label>PASSWORD:</label>
                      <input type="password" class="form-control" name="password" required>
                      <p class="alert-danger errmsg" id="passerr"></p>
                    </div>

                    <div class="form-group">
                      <label>CONFIRM PASSWORD:</label>
                      <input type="password" class="form-control" name="password_confirmation" required>
                      <p class="alert-danger errmsg" id="confirmerr"></p>
                    </div>
        
                    <button type="button" id="createUser" class="btn btn-success float-right text-white"><span class="fa fa-plus"></span> CREATE</button>
                </form>
                

          </div>

      <!--     <div class="modal-footer">


          </div> -->
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

          <input type="hidden" value="" id="edituserid" name="">
             <br/>
          <span style="font-weight: bold;">Set New Password</span>
          <input type="password" name="" class="form-control" id="newpassword">
           <p class="alert-danger errmsg" id="passediterr"></p>
          <br/>
          <button tybpe="button" class="btn btn-default float-left" data-dismiss="modal"><span class="fa fa-times"></span> CLOSE</button>
          <button tybpe="button" class="btn btn-primary float-right"  onclick="updatepassword()"><span class="fa fa-check"></span> UPDATE</button>
      </div>
    </div>
    </div>
  </div>


  <div class="modal" role="dialog" id="editModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success">
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
             </button>
        </div>
      <div class="modal-body">

          <input type="hidden" value="" id="updateid" name="">
          <input type="hidden" id="oldemail" name="">
             <br/>
             <div class="form-group">
              <label>Name</label>
                <input type="text" name="" class="form-control" id="editname">
                <p class="alert-danger errmsg" id="editnameerr"></p>
             </div>

                <div class="form-group">
              <label>Email</label>
                <input type="email" name="" class="form-control" id="editemail">
                <p class="alert-danger errmsg" id="editemailerr"></p>
             </div>
     
          <button tybpe="button" class="btn btn-default float-left" data-dismiss="modal"><span class="fa fa-times"></span> CLOSE</button>
          <button tybpe="button" class="btn btn-success float-right"  onclick="updateUser()"><span class="fa fa-check"></span> UPDATE</button>
      </div>
    </div>
    </div>
  </div>


@include('layouts.foot')

<script>

$('#settingsnav').addClass("active");


$(document).on('click','.editUser',function(){
  let name = $(this).data('name')
  let email = $(this).data('email')
  let id = $(this).data('id')

  $('#updateid').val(id)
  $("#editname").val(name)
  $('#editemail').val(email)
  $('#oldemail').val(email)
  $('#editnameerr').text("")
  $('#editemailerr').text("")
  $('#editModal').modal('show')

})

function updateUser(){
  let name =  $("#editname").val()
  let email =  $('#editemail').val()
  let id = $('#updateid').val()
  let oldemail = $('#oldemail').val()

  $.ajax({
    url: '{{url("")}}/user/update/'+id+'',
    type: 'PATCH',
    data: {
      '_token': $('input[name=_token]').val(),
      'name': name,
      'email': email,
      'oldemail': oldemail,
    },
    datatype: 'json',
    success: function(res){
      if(res.errors){
        $('#editnameerr').text(res.errors.name ? res.errors.name : "")
        $('#editemailerr').text(res.errors.email ? res.errors.email : "")
      }

      if(res.message =="success"){
           swal({
                    title: "User Updated!!",
                    //text: "You will not be able to recover this imaginary file!",
                    type: "success",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1500,
                 })

           setTimeout(()=>{
            window.location.href = window.location.href
          },1500)
        
      }else if(res.message == "fail"){
           swal({
                    title: "Something Went Wrong!!",
                    //text: "You will not be able to recover this imaginary file!",
                    type: "warning",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1000,
                 })
  
      }

    }
  })
}

$(document).on('click','.changepass',function(){
  let id = $(this).data('id')
  $('#changepassModal').modal('show')
  $('#edituserid').val(id)
  $('#passediterr').text("")
})

function updatepassword(){
  let password = $("#newpassword").val()
  let id = $('#edituserid').val()
  $.ajax({
    url: '{{url("")}}/changepassword/'+id+'',
    type: 'PATCH',
    data: {
      '_token': $('input[name=_token]').val(),
      'pass': password,
    },
    datatype: 'json',
    success: function(res){
      if(res.errors){
       $('#passediterr').text(res.errors.pass ? res.errors.pass : "")
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

$(document).on('click','#createUser',function(){

  $.ajax({
    url: '{{url("")}}/user/add',
    type: 'POST',
    data: $("#newUserForm").serialize(),
    datatype: 'json',
    success: function(res){
      if(res.errors){
        $('#nameerr').text(res.errors.name ? res.errors.name : "")
        $('#emailerr').text(res.errors.email ? res.errors.email : "")
        $('#passerr').text(res.errors.password ? res.errors.password : "")
      }

      if(res.message =="success"){
           swal({
                    title: "New user added!!",
                    //text: "You will not be able to recover this imaginary file!",
                    type: "success",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1500,
                 })

           setTimeout(()=>{
            window.location.href = window.location.href
          },1500)
        
      }else if(res.message == "fail"){
           swal({
                    title: "Something Went Wrong!!",
                    //text: "You will not be able to recover this imaginary file!",
                    type: "warning",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1000,
                 })
  
      }
    }
  })
})

// $('#tabledata,#tabledata2').dataTable();

$('.tabledata').dataTable();

$(document).on('click','.archivedata',function(){
  let id = $(this).data('id')
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
              let url = "/user/archive/"+id+""
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
                          title: "User Archived!!",
                          //text: "You will not be able to recover this imaginary file!",
                          type: "success",
                          showCancelButton: false,
                          showConfirmButton: false,
                          timer: 1500,
                       })

                   setTimeout(()=>{
                    window.location.href = window.location.href
                  },1000)
                }
              })
        } 
     });
})


$(document).on('click','.restoredata',function(){
  let id = $(this).data('id')
        swal({
        title: "Restore",
        text: "This data will go to active list",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: 'Yes!',
        cancelButtonText: "No!",
        closeOnConfirm: true,
        closeOnCancel: true,
     },
     function(isConfirm){

       if (isConfirm){
              let url = "/user/archive/"+id+""
              $.ajax({
                url: '{{url('')}}'+url+'',
                type: 'PATCH',
                data: {
                  '_token': $('input[name=_token]').val(),
                  'status': 0,
                },
                datatype: 'json',
                success: function(res){
                       swal({
                          title: "User Restored!!",
                          //text: "You will not be able to recover this imaginary file!",
                          type: "success",
                          showCancelButton: false,
                          showConfirmButton: false,
                          timer: 1500,
                       })

                   setTimeout(()=>{
                    window.location.href = window.location.href
                  },1000)
                }
              })
        } 
     });
})




</script>
@endsection

