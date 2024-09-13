<?php include 'header.php'; // Include header and navigation ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Reporting and Analytics</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Reporting and Analytics</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Report generation section -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Generate Report</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form id="reportForm">
            <div class="row">
              <div class="col-md-4">
                <div class="mb-3">
                  <label for="reportType" class="form-label">Report Type</label>
                  <select class="form-select" id="reportType" name="report_type" required>
                    <option value="">Select Report Type</option>
                    <option value="sales">Sales Report</option>
                    <option value="inventory">Inventory Report</option>
                    <option value="customer">Customer Report</option>
                    <!-- Add more report types as needed -->
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label for="reportStartDate" class="form-label">Start Date</label>
                  <input type="date" class="form-control" id="reportStartDate" name="start_date" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label for="reportEndDate" class="form-label">End Date</label>
                  <input type="date" class="form-control" id="reportEndDate" name="end_date" required>
                </div>
              </div>
              <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Generate Report</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- Report table section -->
      <div class="card mt-4">
        <div class="card-header">
          <h3 class="card-title">Report Data</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="reportTable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Report Type</th>
                <th>Date Generated</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- Example Row -->
              <tr>
                <td>1</td>
                <td>Sales Report</td>
                <td>2024-09-06</td>
                <td>
                  <a href="view_report.php?id=1" class="btn btn-info btn-sm">View</a>
                  <a href="download_report.php?id=1" class="btn btn-success btn-sm">Download</a>
                </td>
              </tr>
              <!-- Add more rows as needed -->
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- Chart section -->
      <div class="card mt-4">
        <div class="card-header">
          <h3 class="card-title">Analytics Dashboard</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div id="analyticsChartContainer">
            <!-- Chart will be rendered here -->
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'footer.php'; // Include footer ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Handle report form submission
  document.getElementById('reportForm').addEventListener('submit', function(event) {
    event.preventDefault();
    // Handle report generation logic
    alert('Report generation form submitted');
  });

  // Example function to render a chart (replace with your data and chart type)
  function renderChart() {
    var ctx = document.createElement('canvas');
    document.getElementById('analyticsChartContainer').appendChild(ctx);
    new Chart(ctx, {
      type: 'bar', // Example chart type
      data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
          label: 'Monthly Data',
          data: [12, 19, 3, 5, 2, 3, 7],
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  }

  // Render the chart when the page loads
  window.onload = renderChart;
</script>
