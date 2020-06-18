@php
use App\Models\Setting\getCompany;
$company = new getCompany;
@endphp
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>{{ config('app.name')}}</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('adminlte3/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte3/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('sweetalert/dist/sweetalert.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('adminlte3/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('adminlte3/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('adminlte3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('adminlte3/plugins/toastr/toastr.min.css')}}">
  <style>
    .active {
      background: #D4AF37 !important;
    }

    nav, .card {
      box-shadow: 2px 3px 3px 0px #343A40;
    }

    .bg-warning {
      background: #D4AF37 !important;
    }


    input[readonly] {
  background-color: white;
}

  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>

  

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Notifications Dropdown Menu -->
<!--       <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> -->
  

      <li class="nav-item">
        <a class="nav-link" id="settingsnav" data-slide="true" href="{{ route('settings') }}"><i
            class="fas fa-cog"></i> Settings</a>
      </li>

          <li class="nav-item">
        <a class="nav-link" data-slide="true" href="javascript:void(0)" id="logout"><i
            class="fas fa-power-off"></i> Logout</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
  <a href="{{url('/')}}">
    <!--   <img src="{{asset('/images/logo.png')}}"
           alt="AdminLTE Logo"
           class="brand-image"
           style="opacity: .8;height: 70px;width: 100%;margin-top: 10px;"> -->

         
       <img src="{{asset('/images/company/'.$company->execute()[1]->value.'')}}"
           alt="Company Logo"
           class="brand-image"
           style="opacity: 1;height: 70px;width: 100%;margin-top: 10px;">

    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex"  style="background: dimgray;padding-top: 18px;border-right: 2px;">
        <div class="image">
          <img src="{{ asset('images/userlogo.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::User()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          <li class="nav-item">
            <a href="{{url('home')}}" class="nav-link" id="dashboardnav">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>


            <li class="nav-item has-treeview">
            <a href="javascript:void(0)" class="nav-link" id="itemnav">
              <i class="nav-icon fas fa-cubes"></i>
              <p>
                Manage Item(s)
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('item/list')}}" class="nav-link">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>Active List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('item/archive')}}" class="nav-link">
                  <i class="far fa-circle nav-icon text-danger"></i>
                  <p>Archive List</p>
                </a>
              </li>

                 <li class="nav-item">
                <a href="{{ route('bulkinsert') }}" class="nav-link">
                  <i class="fa fa-file-excel nav-icon text-success"></i>
                  <p>Bulk Insert</p>
                </a>
              </li>
             
            </ul>
          </li>



            <li class="nav-item has-treeview">
            <a href="javascript:void(0)" class="nav-link" id="clientnav">
              <i class="nav-icon fas fa-map-marked-alt"></i>
              <p>
                Manage Site(s)
               <!--  <span class="right badge badge-danger">New</span> -->
              <!--   <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('clients')}}" class="nav-link">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>Active List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('archiveindex') }}" class="nav-link">
                  <i class="far fa-circle nav-icon text-danger"></i>
                  <p>Archive List</p>
                </a>
              </li>


                 <li class="nav-item">
                <a href="{{ route('bulkinsertSites') }}" class="nav-link">
                  <i class="fa fa-file-excel nav-icon text-success"></i>
                  <p>Bulk Insert</p>
                </a>
              </li>
             
            </ul>
          </li>


                   <li class="nav-item has-treeview">
            <a href="javascript:void(0)" class="nav-link" id="suppliernav">
              <i class="nav-icon fas fa-store"></i>
              <p>
                Manage Supplier(s)
               <!--  <span class="right badge badge-danger">New</span> -->
              <!--   <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('supplier')}}" class="nav-link">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>Active List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('archivesupplier') }}" class="nav-link">
                  <i class="far fa-circle nav-icon text-danger"></i>
                  <p>Archive List</p>
                </a>
              </li>


                 <li class="nav-item">
                <a href="{{ route('bulkinsertSupplier') }}" class="nav-link">
                  <i class="fa fa-file-excel nav-icon text-success"></i>
                  <p>Bulk Insert</p>
                </a>
              </li>
             
            </ul>
          </li>


            <li class="nav-header">Inbound Supplies</li>

            <li class="nav-item has-treeview">
            <a href="#" class="nav-link" id="inboundnav">
              <i class="nav-icon fas fa-download"></i>
              <p>
               New Supply
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('createInbound')}}" class="nav-link">
                  <i class="fa fa-plus nav-icon text-primary"></i>
                  <p>Create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('pendingInbound') }}" class="nav-link">
                  <i class="far fa-circle nav-icon text-danger"></i>
                  <p>Pending</p>
                </a>
              </li>

                 <li class="nav-item">
                <a href="{{ route('approvedInbound') }}" class="nav-link">
                  <i class="fa fa-check nav-icon text-success"></i>
                  <p>List</p>
                </a>
              </li>



             
            </ul>
          </li>

               <li class="nav-item has-treeview">
            <a href="#" class="nav-link" id="returnnav">
              <i class="nav-icon fa fa-undo"></i>
              <p>
               Return Items
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                       <li class="nav-item">
                <a href="{{route('returnCreate')}}" class="nav-link">
                  <i class="fa fa-plus nav-icon text-primary"></i>
                  <p>Create</p>
                </a>
              </li>
             <li class="nav-item">
                <a href="{{ route('returnPending') }}" class="nav-link">
                  <i class="far fa-circle nav-icon text-danger"></i>
                  <p>Pending</p>
                </a>
              </li>

                 <li class="nav-item">
                <a href="{{ route('returnlist') }}" class="nav-link">
                  <i class="fa fa-check nav-icon text-success"></i>
                  <p>List</p>
                </a>
              </li>    

              
            </ul>
          </li>


            <li class="nav-header">Outbound Supplies</li>
 <li class="nav-item has-treeview">
            <a href="#" class="nav-link" id="outboundnav">
              <i class="nav-icon fas fa-upload"></i>
              <p>
               Outbound
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('createOutbound')}}" class="nav-link">
                  <i class="fa fa-plus nav-icon text-primary"></i>
                  <p>Create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('pendingOutbound') }}" class="nav-link">
                  <i class="far fa-circle nav-icon text-danger"></i>
                  <p>Pending</p>
                </a>
              </li>

                 <li class="nav-item">
                <a href="{{ route('approvedOutbound') }}" class="nav-link">
                  <i class="fa fa-check nav-icon text-success"></i>
                  <p>List</p>
                </a>
              </li>

           
             
            </ul>
          </li>


            <li class="nav-item has-treeview">
            <a href="#" class="nav-link" id="dispatchnav">
              <i class="nav-icon fas fa-truck"></i>
              <p>
               Delivery
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                       <li class="nav-item">
                <a href="{{route('dispatchCreate')}}" class="nav-link">
                  <i class="fa fa-plus nav-icon text-primary"></i>
                  <p>Create</p>
                </a>
              </li>
             <li class="nav-item">
                <a href="{{ route('pendingDispatch') }}" class="nav-link">
                  <i class="far fa-circle nav-icon text-danger"></i>
                  <p>Pending</p>
                </a>
              </li>

                 <li class="nav-item">
                <a href="{{ route('dispatchlist') }}" class="nav-link">
                  <i class="fa fa-check nav-icon text-success"></i>
                  <p>List</p>
                </a>
              </li>

              
            </ul>
          </li>


          
            <li class="nav-header">History</li>
             <li class="nav-item">
            <a href="{{url('reports')}}" class="nav-link" id="reportnav">
              <i class="nav-icon fas fa-edit"></i>
              <p>
              Report(s)
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>

            <li class="nav-header">Barcode Scan</li>
                   <li class="nav-item">
            <a href="{{route('checkiteminfo')}}" class="nav-link" id="checknav">
              <i class="nav-icon fas fa-barcode"></i>
              <p>
               Check Item Information
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>

           <li class="nav-item" style="display: none;">
            <a href="{{url('item/list')}}" class="nav-link" id="itemnav">
              <i class="nav-icon fas fa-barcode"></i>
              <p>
               Return with Barcode(s)
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
 

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  @yield('MainContent')



  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      version 1.0
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020-{{ date('Y',time())}} <a href="javascript:void(0)">{{$company->execute()[0]->value}}</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

</body>
</html>
