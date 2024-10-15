<?php
  include 'header.php'; // Include header and navigation
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Burial Records</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Burial Records</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Burial records table -->
      <div class="card">
        <div class="card-header">
          <!-- Button to trigger modal -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBurialModal">
            Add Burial Record
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="burialTable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Burial Date</th>
                <th>Grave Number</th>
                <th>Deceased ID</th>
                <th>Location</th>
                <th>Remarks</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $stmt = $dbh->prepare("SELECT * FROM burial_records");
              $stmt->execute();
              $count = 1; 
              while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
              ?>
              <tr>
                <td><?= $count;?></td>
                <td><?= $row->burial_date;?></td>
                <td><?= $row->grave_number;?></td>
                <td><?= $row->deceased_id;?></td>
                <td><?= $row->location;?></td>
                <td><?= $row->remarks;?></td>
                <td>
                  <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewBurialModal" 
                          onclick="viewBurialDetails(1, '2020-02-15', 'G-123', 1, 'Section A, Row 5', 'None')">View</button>
                  <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editBurialModal" 
                          onclick="populateEditModal(1, '2020-02-15', 'G-123', 1, 'Section A, Row 5', 'None')">Edit</button>
                  <a href="delete_burial.html" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                </td>
              </tr>
              <?php $count++; }?>
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

<!-- Add Burial Modal -->
<div class="modal fade" id="addBurialModal" tabindex="-1" aria-labelledby="addBurialModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addBurialModalLabel">Add New Burial Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST">
          <div class="row">
            <div class="col-md-6 mb-3">
<<<<<<< HEAD
              <label for="addBurialID" class="form-label">Burial ID</label>
              <input type="text" class="form-control" id="addBurialID" name="burial_id" required>
            </div>
            <div class="col-md-6 mb-3">
    <label for="grave_number">Grave Number</label>
    <input type="text" class="form-control" id="grave_number" name="grave_number" placeholder="Enter Grave Number" required>
</div>
            <div class="col-md-6 mb-3">
              <label for="addCemeteryID" class="form-label">Cemetery ID</label>
              <input type="text" class="form-control" id="addCemeteryID" name="cemetery_id" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="addPlotID" class="form-label">Plot ID</label>
              <input type="text" class="form-control" id="addPlotID" name="plot_id" required>
            </div>
            <div class="col-md-6 mb-3">
    <label for="addDeceasedID" class="form-label">Deceased ID</label>
    <select class="form-control" id="addDeceasedID" name="deceased_id" required>
        <option value="" disabled selected>Select Deceased ID</option>
        <?php
        // Fetch deceased records from the database
        $deceasedStmt = $dbh->prepare("SELECT deceased_id, full_name FROM deceased_records");
        $deceasedStmt->execute();
        
        while ($deceasedRow = $deceasedStmt->fetch(PDO::FETCH_OBJ)) {
            echo '<option value="' . $deceasedRow->deceased_id . '">' . $deceasedRow->full_name . ' (ID: ' . $deceasedRow->deceased_id . ')</option>';
        }
        ?>
    </select>
</div>

            <div class="col-md-6 mb-3">
              <label for="addBurialDate" class="form-label">Date of Burial</label>
=======
              <label for="addBurialDate" class="form-label">Burial Date</label>
>>>>>>> parent of 28fea5c (Latest Upate)
              <input type="date" class="form-control" id="addBurialDate" name="burial_date" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="addGraveNumber" class="form-label">Grave Number</label>
              <input type="text" class="form-control" id="addGraveNumber" name="grave_number" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="addDeceasedId" class="form-label">Deceased ID</label>
              <input type="number" class="form-control" id="addDeceasedId" name="deceased_id" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="addLocation" class="form-label">Location</label>
              <input type="text" class="form-control" id="addLocation" name="location">
            </div>
            <div class="col-md-12 mb-3">
              <label for="addRemarks" class="form-label">Remarks</label>
              <textarea class="form-control" id="addRemarks" name="remarks"></textarea>
            </div>
<<<<<<< HEAD
            <div class="form-group">
    <label for="remarks">Remarks</label>
    <textarea class="form-control" id="remarks" name="remarks" placeholder="Enter any remarks or additional information here..." rows="4" required></textarea>
</div>
=======
>>>>>>> parent of 28fea5c (Latest Upate)
          </div>
          <button type="submit" name="burial_record_btn" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- View Burial Modal -->
<div class="modal fade" id="viewBurialModal" tabindex="-1" aria-labelledby="viewBurialModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewBurialModalLabel">View Burial Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td><strong>Full Name:</strong></td>
              <td id="viewFullName"></td>
            </tr>
            <tr>
              <td><strong>Date of Birth:</strong></td>
              <td id="viewDateOfBirth"></td>
            </tr>
            <tr>
              <td><strong>Date of Death:</strong></td>
              <td id="viewDateOfDeath"></td>
            </tr>
            <tr>
              <td><strong>Date of Burial:</strong></td>
              <td id="viewDateOfBurial"></td>
            </tr>
            <tr>
              <td><strong>Grave Number:</strong></td>
              <td id="viewGraveNumber"></td>
            </tr>
            <tr>
              <td><strong>Location:</strong></td>
              <td id="viewLocation"></td>
            </tr>
            <tr>
              <td><strong>Remarks:</strong></td>
              <td id="viewRemarks"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Burial Modal -->
<div class="modal fade" id="editBurialModal" tabindex="-1" aria-labelledby="editBurialModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editBurialModalLabel">Edit Burial Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editBurialForm">
          <input type="hidden" id="editBurialId" name="id">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="editBurialDate" class="form-label">Burial Date</label>
              <input type="date" class="form-control" id="editBurialDate" name="burial_date" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="editGraveNumber" class="form-label">Grave Number</label>
              <input type="text" class="form-control" id="editGraveNumber" name="grave_number" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="editDeceasedId" class="form-label">Deceased ID</label>
              <input type="number" class="form-control" id="editDeceasedId" name="deceased_id" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="editLocation" class="form-label">Location</label>
              <input type="text" class="form-control" id="editLocation" name="location">
            </div>
            <div class="col-md-12 mb-3">
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
  // JavaScript to populate edit modal with burial record data
  // function populateEditModal(id, burial_date, grave_number, deceased_id, location, remarks) {
  //   document.getElementById('editBurialId').value = id;
  //   document.getElementById('editBurialDate').value = burial_date;
  //   document.getElementById('editGraveNumber').value = grave_number;
  //   document.getElementById('editDeceasedId').value = deceased_id;
  //   document.getElementById('editLocation').value = location;
  //   document.getElementById('editRemarks').value = remarks;
  // }

  // // JavaScript to populate view modal with burial record data
  // function viewBurialDetails(id, burial_date, grave_number, deceased_id, location, remarks) {
  //   document.getElementById('viewFullName').innerText = 'John Doe'; // Replace with actual data
  //   document.getElementById('viewDateOfBirth').innerText = '1980-01-01'; // Replace with actual data
  //   document.getElementById('viewDateOfDeath').innerText = burial_date; // Replace with actual data
  //   document.getElementById('viewDateOfBurial').innerText = burial_date; // Replace with actual data
  //   document.getElementById('viewGraveNumber').innerText = grave_number;
  //   document.getElementById('viewLocation').innerText = location;
  //   document.getElementById('viewRemarks').innerText = remarks;
  // }

  // // Handle form submissions (optional)
  // document.getElementById('addBurialForm').addEventListener('submit', function(event) {
  //   event.preventDefault();
  //   // Handle add burial record form submission
  //   alert('Add Burial Form submitted');
  // });

  // document.getElementById('editBurialForm').addEventListener('submit', function(event) {
  //   event.preventDefault();
  //   // Handle edit burial record form submission
  //   alert('Edit Burial Form submitted');
  // });
</script>
