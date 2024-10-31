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
          <table id="example1" class="table table-bordered table-striped">
            <thead style="background-color: #0b603a; color: white;">
              <tr>
                <th>ID</th>
                <th>Report Type</th>
                <th>Date Generated</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- Data will be dynamically populated here -->
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
    
    const reportType = document.getElementById('reportType').value;
    const startDate = document.getElementById('reportStartDate').value;
    const endDate = document.getElementById('reportEndDate').value;

    // Validate dates
    if (new Date(startDate) > new Date(endDate)) {
      alert('Start date must be before end date');
      return;
    }

    // Fetch report data
    const formData = new FormData(this);
    fetch('generate_report.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      // Populate the report table with data
      const tbody = document.querySelector('#example1 tbody');
      tbody.innerHTML = ''; // Clear existing rows
      data.forEach(report => {
        tbody.innerHTML += `
          <tr>
            <td>${report.id}</td>
            <td>${report.type}</td>
            <td>${report.date_generated}</td>
            <td>
              <a href="view_report.php?id=${report.id}" class="btn btn-info btn-sm">View</a>
              <a href="download_report.php?id=${report.id}" class="btn btn-success btn-sm">Download</a>
            </td>
          </tr>
        `;
      });

      // Render the chart
      renderChart(reportType);
    })
    .catch(error => console.error('Error fetching report data:', error));
  });

  // Function to render the chart based on the report type
  function renderChart(reportType) {
    fetch(`get_chart_data.php?report_type=${reportType}`)
      .then(response => response.json())
      .then(data => {
        var ctx = document.createElement('canvas');
        document.getElementById('analyticsChartContainer').innerHTML = ''; // Clear previous chart
        document.getElementById('analyticsChartContainer').appendChild(ctx);
        new Chart(ctx, {
          type: 'bar', // Change type as needed
          data: {
            labels: data.labels,
            datasets: [{
              label: 'Report Data',
              data: data.values,
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
      })
      .catch(error => console.error('Error fetching chart data:', error));
  }

  // Render the chart when the page loads (if applicable)
  // window.onload = renderChart; // Uncomment if needed
</script>
