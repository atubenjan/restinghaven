<?php
include 'header.php';
$stmt = $dbh->query('SELECT COUNT(*) AS branch_count FROM `branch`');
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$branchCount = $row['branch_count']; // Get the count of branches


// Initialize arrays to hold the counts
$branchCounts = [];
$customerCounts = [];
$appointmentCounts = [];
$deceasedCounts = [];
$burialRecordCounts = [];
$workOrderCounts = [];
$expenseCounts = [];
$saleCounts = [];
$supplierCounts = [];
$inventoryCounts = [];

// Loop through each month and fetch counts
for ($i = 1; $i <= 12; $i++) {
    // Monthly branch counts
    $query = "SELECT COUNT(*) FROM branch WHERE MONTH(date_created) = $i"; // Use correct column name
    $result = $dbh->query($query); // Use your database connection variable
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $branchCounts[] = $row['COUNT(*)'];

    // Monthly customer counts
    $query = "SELECT COUNT(*) FROM customers WHERE MONTH(created_at) = $i"; // Use correct column name
    $result = $dbh->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $customerCounts[] = $row['COUNT(*)'];

    // Monthly appointment counts
    $query = "SELECT COUNT(*) FROM appointments WHERE MONTH(date_created) = $i"; // Use correct column name
    $result = $dbh->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $appointmentCounts[] = $row['COUNT(*)'];

    // Monthly deceased counts
    $query = "SELECT COUNT(*) FROM deceased_records WHERE MONTH(created_at) = $i"; // Use correct column name
    $result = $dbh->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $deceasedCounts[] = $row['COUNT(*)'];

    // Monthly burial record counts
    $query = "SELECT COUNT(*) FROM burial_records WHERE MONTH(date_created) = $i"; // Use correct column name
    $result = $dbh->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $burialRecordCounts[] = $row['COUNT(*)'];

    // Monthly work order counts
    $query = "SELECT COUNT(*) FROM work_orders WHERE MONTH(created_at) = $i"; // Use correct column name
    $result = $dbh->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $workOrderCounts[] = $row['COUNT(*)'];

    // Monthly expense counts
    $query = "SELECT SUM(amount) FROM expenses WHERE MONTH(created_at) = $i"; // Use correct column name
    $result = $dbh->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $expenseCounts[] = $row['SUM(amount)'];

    // Monthly sales counts
    //$query = "SELECT SUM(amount) FROM sales WHERE MONTH(date_created) = $i"; // Use correct column name
   // $result = $dbh->query($query);
   // $row = $result->fetch(PDO::FETCH_ASSOC);
   // $saleCounts[] = $row['SUM(amount)'];

    // Monthly supplier counts
    $query = "SELECT COUNT(*) FROM suppliers WHERE MONTH(date_added) = $i"; // Use correct column name
    $result = $dbh->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $supplierCounts[] = $row['COUNT(*)'];

    // Monthly inventory counts
    $query = "SELECT SUM(quantity) FROM inventory WHERE MONTH(date_created) = $i"; // Use correct column name
    $result = $dbh->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $inventoryCounts[] = $row['SUM(quantity)'];
}
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
                        <li class="breadcrumb-item active">Main Dashboard</li>
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
                            <span class="info-box-number"><?= $branchCount ?></span>
                            <span class="info-box-text">Branches</span>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="customer_management" class="info-box">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number"><?= $customerCount; ?></span>
                            <span class="info-box-text">Total Customers</span>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="appointments" class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-calendar-check"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number"><?= $appointmentCount; ?></span>
                            <span class="info-box-text">Total Appointments</span>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="deceased_records" class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-alt-slash"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number"><?= $deceasedCount; ?></span>
                            <span class="info-box-text">Total Deceased Records</span>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="burial_records" class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-file-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number"><?= $total_burial_records; ?></span>
                            <span class="info-box-text">Total Burial Records</span>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="work_orders" class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-tools"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number"><?= $total_work_orders; ?></span>
                            <span class="info-box-text">Work Order Management</span>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="expense" class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-money-bill-wave"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number"><?= $total_expenses; ?></span>
                            <span class="info-box-text">Expenses</span>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="sales" class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-check-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number"><?= $total_sales; ?></span>
                            <span class="info-box-text">Sales</span>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="suppliers" class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-truck"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number"><?= $total_suppliers; ?></span>
                            <span class="info-box-text">Suppliers</span>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="inventory" class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-layer-group"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number"><?= $total_inventory; ?></span>
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
                            <span class="info-box-number"><?= $total_users; ?></span>
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
            </div><!-- /.row -->

            <!-- Analytics Dashboard -->
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Analytics Dashboard</h3>
                    <select id="monthSelector" multiple>
        <option value="current">Current Month</option>
        <option value="0">January</option>
        <option value="1">February</option>
        <option value="2">March</option>
        <option value="3">April</option>
        <option value="4">May</option>
        <option value="5">June</option>
        <option value="6">July</option>
        <option value="7">August</option>
        <option value="8">September</option>
        <option value="9">October</option>
        <option value="10">November</option>
        <option value="11">December</option>
    </select>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="analyticsChartContainer">
                        <canvas id="barChart" style="height: 400px; width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    
    // Monthly labels
    const labels = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    // Fetch monthly data from PHP variables (make sure these are correctly populated)
    const monthlyData = {
        branches: [
            <?= implode(', ', $branchCounts) ?> // Monthly counts for branches
        ],
        customers: [
            <?= implode(', ', $customerCounts) ?> // Monthly counts for customers
        ],
        appointments: [
            <?= implode(', ', $appointmentCounts) ?> // Monthly counts for appointments
        ],
        deceased: [
            <?= implode(', ', $deceasedCounts) ?> // Monthly counts for deceased records
        ],
        burial_records: [
            <?= implode(', ', $burialRecordCounts) ?> // Monthly counts for burial records
        ],
        work_orders: [
            <?= implode(', ', $workOrderCounts) ?> // Monthly counts for work orders
        ],
        expenses: [
            <?= implode(', ', $expenseCounts) ?> // Monthly expenses
        ],
        sales: [
            <?= isset($salesCounts) ? implode(', ', $salesCounts) : '0' ?> // Monthly sales, default to 0 if not set
        ],
        suppliers: [
            <?= implode(', ', $supplierCounts) ?> // Monthly counts for suppliers
        ],
        inventory: [
            <?= implode(', ', $inventoryCounts) ?> // Monthly inventory counts
        ]
    };
   
    // Data for the bar chart (in thousands)
    const datasets = [
        {
            label: 'Branches',
            data: monthlyData.branches.map(count => count / 1000),
            backgroundColor: 'rgba(75, 192, 192, 0.5)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        },
        {
            label: 'Customers',
            data: monthlyData.customers.map(count => count / 1000),
            backgroundColor: 'rgba(153, 102, 255, 0.5)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1
        },
        {
            label: 'Appointments',
            data: monthlyData.appointments.map(count => count / 1000),
            backgroundColor: 'rgba(255, 159, 64, 0.5)',
            borderColor: 'rgba(255, 159, 64, 1)',
            borderWidth: 1
        },
        {
            label: 'Deceased Records',
            data: monthlyData.deceased.map(count => count / 1000),
            backgroundColor: 'rgba(255, 99, 132, 0.5)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        },
        {
            label: 'Burial Records',
            data: monthlyData.burial_records.map(count => count / 1000),
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        },
        {
            label: 'Work Orders',
            data: monthlyData.work_orders.map(count => count / 1000),
            backgroundColor: 'rgba(255, 206, 86, 0.5)',
            borderColor: 'rgba(255, 206, 86, 1)',
            borderWidth: 1
        },
        {
            label: 'Expenses',
            data: monthlyData.expenses.map(count => count / 1000),
            backgroundColor: 'rgba(75, 192, 192, 0.5)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        },
        {
            label: 'Sales',
            data: monthlyData.sales.map(count => count / 1000),
            backgroundColor: 'rgba(153, 102, 255, 0.5)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1
        },
        {
            label: 'Suppliers',
            data: monthlyData.suppliers.map(count => count / 1000),
            backgroundColor: 'rgba(255, 159, 64, 0.5)',
            borderColor: 'rgba(255, 159, 64, 1)',
            borderWidth: 1
        },
        {
            label: 'Inventory',
            data: monthlyData.inventory.map(count => count / 1000),
            backgroundColor: 'rgba(255, 99, 132, 0.5)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }
    ];

    // Bar Chart
    const ctxBar = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Count (in thousands)'
                    },
                    ticks: {
                        callback: function(value) {
                            return value + 'k'; // Format y-axis ticks to show 'k' for thousands
                        }
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Months'
                    }
                }
            }
        }
    });
    function updateChart() {
            const selectedMonths = Array.from(document.getElementById('monthSelector').selectedOptions).map(option => option.value);
            const selectedLabels = [];
            const datasets = [];

            if (selectedMonths.includes('current')) {
                const currentMonthIndex = new Date().getMonth();
                selectedMonths.push(currentMonthIndex); // Include current month
            }

            // Create datasets for each metric
            ['branches', 'customers', 'appointments', 'deceased', 'burial_records', 'work_orders', 'expenses', 'sales', 'suppliers', 'inventory'].forEach(metric => {
                const data = selectedMonths.map(month => monthlyData[metric][month] / 1000);
                datasets.push({
                    label: metric.charAt(0).toUpperCase() + metric.slice(1).replace(/_/g, ' '), // Capitalize metric name
                    data: data,
                    backgroundColor: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.5)`, // Random color
                    borderColor: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 1)`,
                    borderWidth: 1
                });
            });

            // Update chart data and labels
            barChart.data.labels = selectedMonths.map(month => labels[month]);
            barChart.data.datasets = datasets;
            barChart.update();
        }

        // Add event listener to the dropdown to update the chart on change
        document.getElementById('monthSelector').addEventListener('change', updateChart);

        // Initialize the chart with the current month
        updateChart();
</script>

