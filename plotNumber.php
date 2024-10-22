<?php include 'header.php'; // Include header and navigation ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Plot Management</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Plot Management</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Plot table -->
      <div class="card">
        <div class="card-header">
          <!-- Button to trigger the Add Plot modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" style="background-color: #0b603a; border-color: #0b603a;">
            Add Plot
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
          <thead style="background-color: #0b603a; color: white;">
              <tr>
                <th>Plot ID</th>
                <th>Plot Location</th>
                <th>Plot Number</th>
                <th>Remarks/Notes</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- Example Row -->
              <?php 
              $stmt = $dbh->query("SELECT * FROM plots");
              $count = 1;
              while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
              ?>
              <tr>
                <td><?= $count; ?></td>
                <td><?= $row->plot_location; ?></td>
                <td><?= $row->plot_number; ?></td>
                <td><?= $row->remarks; ?></td>
                <td>
                  <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPlotModal" onclick="populateEditModal(<?= $row->id ?>, '<?= $row->plot_location ?>', '<?= $row->plot_number ?>', '<?= $row->remarks ?>')">Edit</button>
                  <a href="delete_plot.php?id=<?= $row->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this plot?');">Delete</a>
                </td>
              </tr>
              <?php $count++; } ?>
              <!-- Add more rows as needed -->
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Add Plot Modal -->
<div class="modal fade" id="addPlotModal" tabindex="-1" aria-labelledby="addPlotModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addPlotModalLabel">Add New Plot</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
          <div class="mb-3">
            <label for="addPlotLocation" class="form-label">Plot Location</label>
            <input type="text" class="form-control" id="addPlotLocation" name="plot_location" required>
          </div>
          <div class="mb-3">
            <label for="addPlotNumber" class="form-label">Plot Number</label>
            <input type="text" class="form-control" id="addPlotNumber" name="plot_number" required>
          </div>
          <div class="mb-3">
            <label for="addPlotRemarks" class="form-label">Remarks/Notes</label>
            <textarea class="form-control" id="addPlotRemarks" name="remarks" rows="3"></textarea>
          </div>
          <button type="submit" name="add_plot_btn" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Plot Modal -->
<div class="modal fade" id="editPlotModal" tabindex="-1" aria-labelledby="editPlotModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPlotModalLabel">Edit Plot</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editPlotForm">
          <input type="hidden" id="editPlotId" name="id">
          <div class="mb-3">
            <label for="editPlotLocation" class="form-label">Plot Location</label>
            <input type="text" class="form-control" id="editPlotLocation" name="plot_location" required>
          </div>
          <div class="mb-3">
            <label for="editPlotNumber" class="form-label">Plot Number</label>
            <input type="text" class="form-control" id="editPlotNumber" name="plot_number" required>
          </div>
          <div class="mb-3">
            <label for="editPlotRemarks" class="form-label">Remarks/Notes</label>
            <textarea class="form-control" id="editPlotRemarks" name="remarks" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; // Include footer ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // JavaScript to populate edit modal with plot data
  function populateEditModal(id, plotLocation, plotNumber, remarks) {
    document.getElementById('editPlotId').value = id;
    document.getElementById('editPlotLocation').value = plotLocation;
    document.getElementById('editPlotNumber').value = plotNumber;
    document.getElementById('editPlotRemarks').value = remarks;
  }
</script>
