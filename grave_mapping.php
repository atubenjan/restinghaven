<?php
  include 'header.php'; // Include header and navigation
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Grave Mapping</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Grave Mapping</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Grave Mapping table -->
      <div class="card">
        <div class="card-header">
          <!-- Button to trigger modal -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGraveMappingModal">
            Add Grave Mapping
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="graveMappingTable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Grave Number</th>
                <th>Location</th>
                <th>Lot Number</th>
                <th>Size</th>
                <th>Status</th>
                <th>Remarks</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- Example Row -->
              <tr>
                <td>1</td>
                <td>G-123</td>
                <td>Section A, Row 3</td>
                <td>L-45</td>
                <td>4x6</td>
                <td>Occupied</td>
                <td>Reserved for family</td>
                <td>
                  <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editGraveMappingModal" onclick="populateEditModal(1, 'G-123', 'Section A, Row 3', 'L-45', '4x6', 'Occupied', 'Reserved for family')">Edit</button>
                  <a href="delete_grave_mapping.html" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
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

<!-- Add Grave Mapping Modal -->
<div class="modal fade" id="addGraveMappingModal" tabindex="-1" aria-labelledby="addGraveMappingModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addGraveMappingModalLabel">Add New Grave Mapping</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addGraveMappingForm">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="addGraveNumber" class="form-label">Grave Number</label>
              <input type="text" class="form-control" id="addGraveNumber" name="grave_number" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="addLocation" class="form-label">Location</label>
              <input type="text" class="form-control" id="addLocation" name="location" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="addLotNumber" class="form-label">Lot Number</label>
              <input type="text" class="form-control" id="addLotNumber" name="lot_number">
            </div>
            <div class="col-md-6 mb-3">
              <label for="addSize" class="form-label">Size</label>
              <input type="text" class="form-control" id="addSize" name="size">
            </div>
            <div class="col-md-6 mb-3">
              <label for="addStatus" class="form-label">Status</label>
              <input type="text" class="form-control" id="addStatus" name="status">
            </div>
            <div class="col-md-6 mb-3">
              <label for="addRemarks" class="form-label">Remarks</label>
              <textarea class="form-control" id="addRemarks" name="remarks"></textarea>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Grave Mapping Modal -->
<div class="modal fade" id="editGraveMappingModal" tabindex="-1" aria-labelledby="editGraveMappingModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editGraveMappingModalLabel">Edit Grave Mapping Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editGraveMappingForm">
          <input type="hidden" id="editGraveMappingId" name="id">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="editGraveNumber" class="form-label">Grave Number</label>
              <input type="text" class="form-control" id="editGraveNumber" name="grave_number" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="editLocation" class="form-label">Location</label>
              <input type="text" class="form-control" id="editLocation" name="location" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="editLotNumber" class="form-label">Lot Number</label>
              <input type="text" class="form-control" id="editLotNumber" name="lot_number">
            </div>
            <div class="col-md-6 mb-3">
              <label for="editSize" class="form-label">Size</label>
              <input type="text" class="form-control" id="editSize" name="size">
            </div>
            <div class="col-md-6 mb-3">
              <label for="editStatus" class="form-label">Status</label>
              <input type="text" class="form-control" id="editStatus" name="status">
            </div>
            <div class="col-md-6 mb-3">
              <label for="editRemarks" class="form-label">Remarks</label>
              <textarea class="form-control" id="editRemarks" name="remarks"></textarea>
            </div>
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
  // JavaScript to populate edit modal with grave mapping record data
  function populateEditModal(id, grave_number, location, lot_number, size, status, remarks) {
    document.getElementById('editGraveMappingId').value = id;
    document.getElementById('editGraveNumber').value = grave_number;
    document.getElementById('editLocation').value = location;
    document.getElementById('editLotNumber').value = lot_number;
    document.getElementById('editSize').value = size;
    document.getElementById('editStatus').value = status;
    document.getElementById('editRemarks').value = remarks;
  }

  // Handle form submissions (optional)
  document.getElementById('addGraveMappingForm').addEventListener('submit', function(event) {
    event.preventDefault();
    // Handle add grave mapping form submission
    alert('Add Grave Mapping Form submitted');
  });

  document.getElementById('editGraveMappingForm').addEventListener('submit', function(event) {
    event.preventDefault();
    // Handle edit grave mapping form submission
    alert('Edit Grave Mapping Form submitted');
  });
</script>
