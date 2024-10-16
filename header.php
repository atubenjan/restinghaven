<?php
include './root/process.php';

if (empty($_SESSION['id'])) {
    header("Location: login");
    exit(); // Always call exit after header redirection
} else {
    // `userid`, `fullname`, `phone`, `token`, `status`, `role`, `date_registered`
    $interface = $_SESSION['user_role'];
    $username = $_SESSION['username'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RHC | Dashboard</title>
    <link rel="shortcut icon" href="./logo.png">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
    <link rel="shortcut icon" href="../images/whitelogo.png" type="image/x-icon">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->

    <!-- Preloader CSS -->
    <style>
        .preloader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out;
        }

        .preloader.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
            border-width: 0.4em;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="preloader">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">RHC...</span>
        </div>
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

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="dashboard.php" class="brand-link">
    <img src="logo.jpg" 
         alt="AdminLTE Logo" 
         style="opacity: .8; border-radius: 50%; width: 30px; height: 30px; object-fit: cover;">
    <span class="brand-text font-weight-light">RESTING HAVEN</span>
</a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
    <img src="logo.jpg" 
         alt="logged in User" 
         style="border-radius: 50%; width: 25px; height: 25px; object-fit: cover;">
</div>
                    <div class="info">
                        <a href="#" class="d-block">Welcome <?php echo htmlspecialchars($_SESSION['user_role']); ?></a>
                    </div>
                </div>

                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="customer_management" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Customer Management</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="appointments" class="nav-link">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>Appointments</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="deceased_records" class="nav-link">
                            <i class="nav-icon fas fa-user-alt-slash"></i>
                            <p>Deceased Records</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="grave_management" class="nav-link">
                            <i class="nav-icon fas fa-map-marked-alt"></i>
                            <p>Grave Management</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="burial_records" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Burial Records</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="work_orders" class="nav-link">
                            <i class="nav-icon fas fa-tools"></i>
                            <p>Work Order Management</p>
                        </a>
                    </li>
                    
                   
                    <li class="nav-item">
                        <a href="expense" class="nav-link">
                            <i class="nav-icon fas fa-money-bill-wave"></i>
                            <p>Expenses</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="sales" class="nav-link">
                            <i class="nav-icon fas fa-money-check-alt"></i>
                            <p>Sales</p>
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
                        <a href="reporting_analytics" class="nav-link">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>Reporting & Analytics</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="document_management" class="nav-link">
                            <i class="nav-icon fas fa-file-archive"></i>
                            <p>Document Management</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="plotNumber" class="nav-link">
                            <i class="nav-icon fas fa-file-archive"></i>
                            <p>PlotS</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="grave_mapping" class="nav-link">
                            <i class="nav-icon fas fa-map-marked-alt"></i>
                            <p>Grave Mapping</p>
                        </a>
                    </li>
                   
                   
                  
                    <li class="nav-item">
                        <a href="users" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>User</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="security_access" class="nav-link">
                            <i class="nav-icon fas fa-lock"></i>
                            <p>LogOut</p>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar -->
        </aside>

       
           

    <script>
        // Preloader script
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                const preloader = document.querySelector('.preloader');
                preloader.classList.add('hidden'); // Add hidden class to preloader
            }, 4000); // Adjust the time as necessary
        });
    </script>
    
