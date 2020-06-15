<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  @yield('title')
  <base href="{{ asset('') }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dashboard/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">



  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <h5><a href="{{ route('index') }}" class="d-block"><i class="fas fa-id-card"></i>&nbsp; &nbsp; <b>{{ $username }}</b></a></h5>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="{{ route('users') }}" class="nav-link">
               &nbsp;
              <i class="fas fa-user"></i></i>
              <p>
                &nbsp; Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('users') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Information</p>
                </a>
              </li>
              @if (Auth::isAdmin())
              <li class="nav-item">
                <a href="{{ route('roles') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Roles</p>
                </a>
              </li>
              @endif
              
              <!-- <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li> -->
            </ul>
          </li>
          @if (!Auth::isShipper())
            <li class="nav-item has-treeview">
            <a href="{{ route('products') }}" class="nav-link">
              &nbsp;
              <i class="fas fa-shopping-basket"></i></i>
              <p>
                &nbsp;Products
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('products') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('product-types') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product Types</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          
          <li class="nav-item has-treeview">
            <a href="{{ route('bills') }}" class="nav-link">
               &nbsp;
              <i class="fas fa-file-invoice-dollar"></i>
              <p>
                &nbsp; &nbsp; Bills
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('bills') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bills List</p>
                </a>
              </li>
              @if (!Auth::isShipper())
              <li class="nav-item">
                <a href="{{ route('bill-details') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bill Details</p>
                </a>
              </li>
              @endif
              
             <!--  <li class="nav-item">
                <a href="pages/UI/buttons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buttons</p>
                </a>
              </li> -->
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('customers') }}" class="nav-link">
              &nbsp;
              <i class="fas fa-users"></i>
              <p>
                &nbsp; Customers
                <!-- <i class="fas fa-angle-left right"></i> -->
              </p>
            </a>
          </li>
          @if (!Auth::isShipper())
            <li class="nav-item has-treeview">
            <a href="{{ route('slides') }}" class="nav-link">
              &nbsp;
              <i class="fas fa-images"></i>
              <p>
                &nbsp; Slides
                <!-- <i class="fas fa-angle-left right"></i> -->
              </p>
            </a>
          </li>
          @endif
          
          <li class="nav-item">
            <a href="{{ route('index') }}" class="nav-link">
              <i class="nav-icon far fa-circle text-success"></i>
              <p class="text">Home</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Log Out</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="padding-top: 30px">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="col-md-12" style="padding: 20px;">

         @yield('content')

        </div>
        
        <div class="row">
          <div class="col-lg-3 col-6">
          </div>
        </div>
      </div>
            
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="dashboard/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="dashboard/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dashboard/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dashboard/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dashboard/dist/js/demo.js"></script>
{{-- Select 2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function () {
    $('.has-treeview a').each(function () {
        if (this.href.trim() == window.location) {
            $(this).parent().parent().parent('li').addClass('menu-open');
            $(this).addClass('active');
        } else {
            $(this).parent('li').removeClass('menu-open');
        }
        console.log(this.href.trim());
        console.log(window.location);
    });
});
</script>
</body>
</html>
