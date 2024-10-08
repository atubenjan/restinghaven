
<?php
include './root/process.php';

if (empty($_SESSION['id'])) {
  header("Location: login");
} else {
  //`userid`, `fullname`, `phone`, `token`, `status`, `role`, `date_registered`
  $interface = $_SESSION['role'];
  $fullname = $_SESSION['fullname'];
  $phone = $_SESSION['phone'];
  $userid = $_SESSION['userid'];
  $date_registered = $_SESSION['date_registered'];

  // unset($_SESSION['status']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LSkS | Dashboard</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  
  <!-- Preloader CSS -->
  <style>
    /* Preloader Styles */
    #preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: white;
      z-index: 9999;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    #preloader .loader {
      border: 8px solid #f3f3f3;
      border-radius: 50%;
      border-top: 8px solid #3498db;
      width: 50px;
      height: 50px;
      animation: spin 1s linear infinite;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  
  <!-- Preloader -->
  <div id="preloader">
    <div class="loader"></div>
  </div>

  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Cemetery Manager</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Welcome Admin</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="users" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>User</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="appointments" class="nav-link">
                <i class="nav-icon fas fa-calendar-check"></i>
                <p>Appointments</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="suppliers" class="nav-link">
                <i class="nav-icon fas fa-truck"></i>
                <p>Suppliers</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="inventory" class="nav-link">
                <i class="nav-icon fas fa-layer-group"></i>
                <p>Inventory</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="plot_management" class="nav-link">
                <i class="nav-icon fas fa-map-marked-alt"></i>
                <p>Plot Management</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="deceased_records" class="nav-link">
                <i class="nav-icon fas fa-user-alt-slash"></i>
                <p>Deceased Records</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="burial_records" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>Burial Records</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="expense" class="nav-link">
                <i class="nav-icon fas fa-money-bill-wave"></i>
                <p>Expenses</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="grave_mapping" class="nav-link">
                <i class="nav-icon fas fa-map-marked-alt"></i>
                <p>Grave Mapping</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="sales" class="nav-link">
                <i class="nav-icon fas fa-money-check-alt"></i>
                <p>Sales</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="customer_management" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Customer Management</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="reporting_analytics" class="nav-link">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>Reporting & Analytics</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="work_orders" class="nav-link">
                <i class="nav-icon fas fa-tools"></i>
                <p>Work Order Management</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="document_management" class="nav-link">
                <i class="nav-icon fas fa-file-archive"></i>
                <p>Document Management</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="online_portal" class="nav-link">
                <i class="nav-icon fas fa-globe"></i>
                <p>Online Portal</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="settings_integration" class="nav-link">
                <i class="nav-icon fas fa-plug"></i>
                <p>Integration</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="security_access" class="nav-link">
                <i class="nav-icon fas fa-lock"></i>
                <p>Security & Access Control</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="logout" class="nav-link">
                <i class="nav-icon fas fa-power-off"></i>
                <p>Logout</p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
      <!-- /.sidebar -->
    </aside>

  
  <!-- Preloader JavaScript -->
  <script>
    // Wait for 5 seconds before hiding the preloader
    window.addEventListener('load', function() {
      setTimeout(function() {
        document.getElementById('preloader').style.display = 'none';
      }, 5000); // 5000 milliseconds = 5 seconds
    });
  </script>
