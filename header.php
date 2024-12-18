<?php
include './root/init.php';
include './root/process.php';
include './root/counts.php';
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
    <link rel="shortcut icon" href="logo.jpg">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
<!-- Include Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />


    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
    <link rel="shortcut icon" href="../images/whitelogo.png" type="image/x-icon">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/style.css">
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<style>
    .modal {
    z-index: 1050; /* Ensure it's above other elements */
}

body {
  overflow: visible !important;
}

</style>

<body class="hold-transition sidebar-mini layout-fixed">
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
                <?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item menu-open">
        <a href="index.php" class="nav-link <?= ($current_page == 'index.php') ? 'active' : '' ?>"
            style="<?= ($current_page == 'index.php') ? 'background-color: #0b603a; color: white;' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="branch.php" class="nav-link <?= ($current_page == 'branch.php') ? 'active' : '' ?>"
            style="<?= ($current_page == 'branch.php') ? 'background-color: #0b603a; color: white;' : '' ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>Branch</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="customer_management.php" class="nav-link <?= ($current_page == 'customer_management.php') ? 'active' : '' ?>"
            style="<?= ($current_page == 'customer_management.php') ? 'background-color: #0b603a; color: white;' : '' ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>Customer Management</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="appointments.php" class="nav-link <?= ($current_page == 'appointments.php') ? 'active' : '' ?>"
            style="<?= ($current_page == 'appointments.php') ? 'background-color: #0b603a; color: white;' : '' ?>">
            <i class="nav-icon fas fa-calendar-check"></i>
            <p>Appointments</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="deceased_records.php" class="nav-link <?= ($current_page == 'deceased_records.php') ? 'active' : '' ?>"
            style="<?= ($current_page == 'deceased_records.php') ? 'background-color: #0b603a; color: white;' : '' ?>">
            <i class="nav-icon fas fa-user-alt-slash"></i>
            <p>Deceased Records</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="grave_management.php" class="nav-link <?= ($current_page == 'grave_management.php') ? 'active' : '' ?>"
            style="<?= ($current_page == 'grave_management.php') ? 'background-color: #0b603a; color: white;' : '' ?>">
            <i class="nav-icon fas fa-map-marked-alt"></i>
            <p>Grave Management</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="burial_records.php" class="nav-link <?= ($current_page == 'burial_records.php') ? 'active' : '' ?>"
            style="<?= ($current_page == 'burial_records.php') ? 'background-color: #0b603a; color: white;' : '' ?>">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>Burial Records</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="work_orders.php" class="nav-link <?= ($current_page == 'work_orders.php') ? 'active' : '' ?>"
            style="<?= ($current_page == 'work_orders.php') ? 'background-color: #0b603a; color: white;' : '' ?>">
            <i class="nav-icon fas fa-tools"></i>
            <p>Work Order Management</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="expense.php" class="nav-link <?= ($current_page == 'expense.php') ? 'active' : '' ?>"
            style="<?= ($current_page == 'expense.php') ? 'background-color: #0b603a; color: white;' : '' ?>">
            <i class="nav-icon fas fa-money-bill-wave"></i>
            <p>Expenses</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="sales.php" class="nav-link <?= ($current_page == 'sales.php') ? 'active' : '' ?>"
            style="<?= ($current_page == 'sales.php') ? 'background-color: #0b603a; color: white;' : '' ?>">
            <i class="nav-icon fas fa-money-check-alt"></i>
            <p>Sales</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="suppliers.php" class="nav-link <?= ($current_page == 'suppliers.php') ? 'active' : '' ?>"
            style="<?= ($current_page == 'suppliers.php') ? 'background-color: #0b603a; color: white;' : '' ?>">
            <i class="nav-icon fas fa-truck"></i>
            <p>Suppliers</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="inventory.php" class="nav-link <?= ($current_page == 'inventory.php') ? 'active' : '' ?>"
            style="<?= ($current_page == 'inventory.php') ? 'background-color: #0b603a; color: white;' : '' ?>">
            <i class="nav-icon fas fa-layer-group"></i>
            <p>Inventory</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="reporting_analytics.php" class="nav-link <?= ($current_page == 'reporting_analytics.php') ? 'active' : '' ?>"
            style="<?= ($current_page == 'reporting_analytics.php') ? 'background-color: #0b603a; color: white;' : '' ?>">
            <i class="nav-icon fas fa-chart-bar"></i>
            <p>Reporting & Analytics</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="document_management.php" class="nav-link <?= ($current_page == 'document_management.php') ? 'active' : '' ?>"
            style="<?= ($current_page == 'document_management.php') ? 'background-color: #0b603a; color: white;' : '' ?>">
            <i class="nav-icon fas fa-file-archive"></i>
            <p>Document Management</p>
        </a>
    </li>
  
    <li class="nav-item">
        <a href="grave_mapping.php" class="nav-link <?= ($current_page == 'grave_mapping.php') ? 'active' : '' ?>"
            style="<?= ($current_page == 'grave_mapping.php') ? 'background-color: #0b603a; color: white;' : '' ?>">
            <i class="nav-icon fas fa-map-marked-alt"></i>
            <p>Grave Mapping</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="users.php" class="nav-link <?= ($current_page == 'users.php') ? 'active' : '' ?>"
            style="<?= ($current_page == 'users.php') ? 'background-color: #0b603a; color: white;' : '' ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>User</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="user_activity" class="nav-link <?= ($current_page == 'user_activity.php') ? 'active' : '' ?>"
            style="<?= ($current_page == 'user_activity.php') ? 'background-color: #0b603a; color: white;' : '' ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>UserActivity</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="logout.php" id="logoutBtn" class="nav-link <?= ($current_page == 'logout.php') ? 'active' : '' ?>"
            style="<?= ($current_page == 'logout.php') ? 'background-color: #0b603a; color: white;' : '' ?>">
            <i class="nav-icon fas fa-lock"></i>
            <p>LogOut</p>
        </a>
    </li>
</ul>



            </div>
            <!-- /.sidebar -->
        </aside>

    <script>
         document.getElementById('logoutBtn').addEventListener('click', (e) => {
      e.preventDefault();

        const logoutUrl = e.currentTarget.href; 

      swal.fire({
        title: 'Are you sure?',
        text: "You will be logged out!",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, log me out!'
      }).then((result) => {
        if(result.isConfirmed) {
          window.location.href = logoutUrl;
        }
      })
    })

    </script>   
           
     
                                 
                                        