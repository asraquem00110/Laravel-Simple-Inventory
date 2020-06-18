
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('adminlte3/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte3/dist/js/adminlte.min.js')}}"></script>
<!-- Sweet Alert -->
<script src="{{ asset('sweetalert/dist/sweetalert.min.js')}}"></script>
<!-- DataTable -->
<script src="{{ asset('adminlte3/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ asset('adminlte3/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('adminlte3/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<!-- Select2 -->
<script src="{{ asset('adminlte3/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Toastr -->
<script src="{{ asset('adminlte3/plugins/toastr/toastr.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{ asset('adminlte3/plugins/chart.js/Chart.min.js')}}"></script>

<script>
  $(document).on('click','#logout',function(){

      swal({
		    title: "Confirm Logout?",
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
		    document.getElementById('logout-form').submit();
		    } 
		 });
  })

   //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  </script>