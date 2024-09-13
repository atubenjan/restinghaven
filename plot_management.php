<?php include 'header.php'; // Include header and navigation ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Lot Management</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Lot Management</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Lots table -->
      <div class="card">
        <div class="card-header">
          <!-- Button to trigger add modal -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLotModal">
            Add Lot
          </button>
          <!-- Download Button -->
          <button type="button" class="btn btn-success float-right" id="downloadButton">
            Download
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="lotsTable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Lot Number</th>
                <th>Location</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- Example Row -->
              <tr>
                <td>1</td>
                <td>A1</td>
                <td>North Side</td>
                <td>Available</td>
                <td>
                  <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editLotModal" onclick="populateEditModal(1, 'A1', 'North Side', 'Available')">Edit</button>
                  <a href="delete_lot.html" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this lot?');">Delete</a>
                </td>
              </tr>
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

<!-- Add Lot Modal -->
<div class="modal fade" id="addLotModal" tabindex="-1" aria-labelledby="addLotModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addLotModalLabel">Add New Lot</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addLotForm">
          <div class="mb-3">
            <label for="addLotNumber" class="form-label">Lot Number</label>
            <input type="text" class="form-control" id="addLotNumber" name="lot_number" required>
          </div>
          <div class="mb-3">
            <label for="addLocation" class="form-label">Location</label>
            <input type="text" class="form-control" id="addLocation" name="location" required>
          </div>
          <div class="mb-3">
            <label for="addStatus" class="form-label">Status</label>
            <select class="form-control" id="addStatus" name="status" required>
              <option value="Available">Available</option>
              <option value="Occupied">Occupied</option>
              <option value="Reserved">Reserved</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Lot Modal -->
<div class="modal fade" id="editLotModal" tabindex="-1" aria-labelledby="editLotModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editLotModalLabel">Edit Lot</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editLotForm">
          <input type="hidden" id="editLotId" name="id">
          <div class="mb-3">
            <label for="editLotNumber" class="form-label">Lot Number</label>
            <input type="text" class="form-control" id="editLotNumber" name="lot_number" required>
          </div>
          <div class="mb-3">
            <label for="editLocation" class="form-label">Location</label>
            <input type="text" class="form-control" id="editLocation" name="location" required>
          </div>
          <div class="mb-3">
            <label for="editStatus" class="form-label">Status</label>
            <select class="form-control" id="editStatus" name="status" required>
              <option value="Available">Available</option>
              <option value="Occupied">Occupied</option>
              <option value="Reserved">Reserved</option>
            </select>
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
  // JavaScript to populate edit modal with lot data
  function populateEditModal(id, lotNumber, location, status) {
    document.getElementById('editLotId').value = id;
    document.getElementById('editLotNumber').value = lotNumber;
    document.getElementById('editLocation').value = location;
    document.getElementById('editStatus').value = status;
  }

  // Handle form submissions (optional)
  document.getElementById('addLotForm').addEventListener('submit', function(event) {
    event.preventDefault();
    // Handle add lot form submission
    alert('Add Lot Form submitted');
  });

  document.getElementById('editLotForm').addEventListener('submit', function(event) {
    event.preventDefault();
    // Handle edit lot form submission
    alert('Edit Lot Form submitted');
  });

  // Handle download button click (placeholder function)
  document.getElementById('downloadButton').addEventListener('click', function() {
    alert('Download button clicked');
    // Implement download functionality here
  });
</script>
