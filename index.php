<?php
  include 'header.php';
  // require "./root/config.php";
  $stmt = $dbh->query('SELECT COUNT(*) AS branch_count FROM `branch`');
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$branchCount = $row['branch_count']; // Get the count of branches
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Main DashBoard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
    <a href="branch" class="info-box">
      
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
        <div class="info-box-content">
          
            <span class="info-box-number"><?= $branchCount ?></span> <!-- Display the count here -->
            <span class="info-box-text">Branches</span>
        </div>
    </a>
</div>
    
<div class="col-12 col-sm-6 col-md-3">
    <a href="customer_management" class="info-box">
        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
        <div class="info-box-content">
            <span class="info-box-number"><?php echo $customerCount; ?></span> <!-- Display the customer count -->
            <span class="info-box-text">Total Customers</span>
        </div>
    </a>
</div>
<div class="col-12 col-sm-6 col-md-3">
    <a href="appointments" class="info-box">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-calendar-check"></i></span>
        <div class="info-box-content">
            <span class="info-box-number"><?php echo $appointmentCount; ?></span> <!-- Display the appointment count -->
            <span class="info-box-text">Total Appointments</span>
        </div>
    </a>
</div>
<div class="col-12 col-sm-6 col-md-3">
    <a href="deceased_records" class="info-box">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-alt-slash"></i></span>
        <div class="info-box-content">
            <span class="info-box-number"><?php echo $deceasedCount; ?></span> <!-- Display the count here -->
            <span class="info-box-text">Total Deceased Records</span>
        </div>
    </a>
</div>
 
<div class="col-12 col-sm-6 col-md-3">
    <a href="burial_records" class="info-box">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-file-alt"></i></span>
        <div class="info-box-content">
         
            <span class="info-box-number"><?php echo $total_burial_records; ?></span>
            <span class="info-box-text">Total Burial Records</span>
        </div>
    </a>
</div>

<div class="col-12 col-sm-6 col-md-3">
    <a href="work_orders" class="info-box">
        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-tools"></i></span>
        <div class="info-box-content">
            <span class="info-box-number"><?php echo $total_work_orders; ?></span> <!-- Display the count here -->
            <span class="info-box-text">Work Order Management</span>
        </div>
    </a>
</div>

<div class="col-12 col-sm-6 col-md-3">
    <a href="expense" class="info-box">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-money-bill-wave"></i></span>
        <div class="info-box-content">
            <span class="info-box-number"><?php echo $total_expenses; ?></span> <!-- Display the count here -->
            <span class="info-box-text">Expenses</span>
        </div>
    </a>
</div>

<div class="col-12 col-sm-6 col-md-3">
    <a href="sales" class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-check-alt"></i></span>
        <div class="info-box-content">
            <span class="info-box-number"><?php echo $total_sales; ?></span> <!-- Display the count here -->
            <span class="info-box-text">Sales</span>
        </div>
    </a>
</div>

<div class="col-12 col-sm-6 col-md-3">
    <a href="suppliers" class="info-box">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-truck"></i></span>
        <div class="info-box-content">
            <span class="info-box-number"><?php echo $total_suppliers; ?></span> <!-- Display the count here -->
            <span class="info-box-text">Suppliers</span>
        </div>
    </a>
</div>

<div class="col-12 col-sm-6 col-md-3">
    <a href="inventory" class="info-box">
        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-layer-group"></i></span>
        <div class="info-box-content">
            <span class="info-box-number"><?php echo $total_inventory; ?></span> <!-- Display the count here -->
            <span class="info-box-text">Inventory</span>
        </div>
    </a>
</div>


    <div class="col-12 col-sm-6 col-md-3">
        <a href="reporting_analytics" class="info-box">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-chart-bar"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Reporting & Analytics</span>
            </div>
        </a>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <a href="document_management" class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file-archive"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Document Management</span>
            </div>
        </a>
    </div>

   
    <div class="col-12 col-sm-6 col-md-3">
    <a href="users" class="info-box">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
        <div class="info-box-content">
            <span class="info-box-number"><?php echo $total_users; ?></span> <!-- Display the count here -->
            <span class="info-box-text">Users</span>
        </div>
    </a>
</div>

    <div class="col-12 col-sm-6 col-md-3">
        <a href="logout" class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-lock"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">LogOut</span>
            </div>
        </a>
    </div>
</div>

        <!-- /.row -->

      
   
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->



<?php include('footer.php'); ?>
