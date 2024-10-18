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

  <section class="content">
  <div class="container-fluid">
    <!-- Burial records table -->
    <div class="card">
      <div class="card-header">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            <i class="fas fa-plus"></i>  Add Burial Record
          </button>
       
      </div>
      <!-- /.card-header -->
      <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Burial Date</th>
              <th>Time of Burial</th>
              <th>Grave Number</th>
              <th>Deceased ID</th>
              <th>Plot ID</th>
              <th>Burial Type</th>
              <th>Officiant</th>
              <th>Location</th>
              <th>Burial Status</th>
              <th>Cemetery</th>
              <th>Remarks</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $stmt = $dbh->prepare("SELECT burial_id, burial_date, time_of_burial, grave_number, deceased_id, plot_id, burial_type, officiant, location, burial_status, cemetery_id, remarks FROM burial_records");
            $stmt->execute();
            $count = 1; 
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            ?>
            <tr>
              <td><?= $count; ?></td>
              <td><?= $row->burial_date; ?></td>
              <td><?= $row->time_of_burial; ?></td>
              <td><?= $row->grave_number; ?></td>
              <td><?= $row->deceased_id; ?></td>
              <td><?= $row->plot_id; ?></td>
              <td><?= $row->burial_type; ?></td>
              <td><?= $row->officiant; ?></td>
              <td><?= $row->location; ?></td>
              <td><?= $row->burial_status; ?></td>
              <td><?= $row->cemetery_id; ?></td>
              <td><?= $row->remarks; ?></td>
              <td>
                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewBurialModal" 
                        onclick="viewBurialDetails(<?= $row->burial_id; ?>, '<?= $row->burial_date; ?>', '<?= $row->time_of_burial; ?>', '<?= $row->grave_number; ?>', <?= $row->deceased_id; ?>, '<?= $row->plot_id; ?>', '<?= $row->burial_type; ?>', '<?= $row->officiant; ?>', '<?= $row->location; ?>', '<?= $row->burial_status; ?>', '<?= $row->cemetery_id; ?>', '<?= $row->remarks; ?>')">View</button>
                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editBurialModal" 
                        onclick="populateEditModal(<?= $row->burial_id; ?>, '<?= $row->burial_date; ?>', '<?= $row->time_of_burial; ?>', '<?= $row->grave_number; ?>', <?= $row->deceased_id; ?>, '<?= $row->plot_id; ?>', '<?= $row->burial_type; ?>', '<?= $row->officiant; ?>', '<?= $row->location; ?>', '<?= $row->burial_status; ?>', '<?= $row->cemetery_id; ?>', '<?= $row->remarks; ?>')">Edit</button>
                <a href="delete_burial.php?id=<?= $row->burial_id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
              </td>
            </tr>
            <?php $count++; } ?>
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
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addBurialModalLabel">Add New Burial Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="grave_number" class="form-label">Grave Number</label>
              <input type="text" class="form-control" id="grave_number" name="grave_number" placeholder="Enter Grave Number" required>
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
                    echo '<option value="' . htmlspecialchars($deceasedRow->deceased_id) . '">' . htmlspecialchars($deceasedRow->full_name) . ' (ID: ' . htmlspecialchars($deceasedRow->deceased_id) . ')</option>';
                }
                ?>
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label for="addBurialDate" class="form-label">Date of Burial</label>
              <input type="date" class="form-control" id="addBurialDate" name="burial_date" required>
            </div>

            <div class="col-md-6 mb-3">
              <label for="time_of_burial" class="form-label">Time of Burial</label>
              <input type="time" class="form-control" id="time_of_burial" name="time_of_burial" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="addPlotID" class="form-label">Plot ID</label>
              <input type="text" class="form-control" id="addPlotID" name="plot_id" placeholder="Enter Plot ID" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="burial_type" class="form-label">Burial Type</label>
              <select class="form-control" id="burial_type" name="burial_type" required>
                <option value="" disabled selected>Select Burial Type</option>
                <option value="Traditional">Traditional</option>
                <option value="Cremation">Cremation</option>
                <option value="Natural">Natural</option>
                <option value="Green Burial">Green Burial</option>
                <option value="Above Ground">Above Ground</option>
                <option value="Aquamation">Aquamation</option>
                <option value="Burial at Sea">Burial at Sea</option>
                <option value="Mausoleum">Mausoleum</option>
                <option value="Community Burial">Community Burial</option>
                <option value="Home Burial">Home Burial</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="officiant" class="form-label">Officiant</label>
              <input type="text" class="form-control" id="officiant" name="officiant" placeholder="Enter Officiant Name" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="location" class="form-label">Location</label>
              <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="burial_status" class="form-label">Burial Status</label>
              <select class="form-control" id="burial_status" name="burial_status" required>
                <option value="" disabled selected>Select Burial Status</option>
                <option value="Completed">Completed</option>
                <option value="Pending">Pending</option>
                <option value="Cancelled">Cancelled</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="cemetery" class="form-label">Cemetery</label>
              <input type="text" class="form-control" id="cemetery" name="cemetery" placeholder="Enter Cemetery" required>
            </div>
            <div class="col-md-12 mb-3">
              <label for="remarks" class="form-label">Remarks</label>
              <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Add Record</button>
        </form>
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
        <form method="POST" action="">
          <input type="hidden" id="editBurialID" name="burial_id">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="editGraveNumber" class="form-label">Grave Number</label>
              <input type="text" class="form-control" id="editGraveNumber" name="grave_number" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="editDeceasedID" class="form-label">Deceased ID</label>
              <select class="form-control" id="editDeceasedID" name="deceased_id" required>
                <option value="" disabled selected>Select Deceased ID</option>
                <?php
                // Fetch deceased records from the database
                $deceasedStmt = $dbh->prepare("SELECT deceased_id, full_name FROM deceased_records");
                $deceasedStmt->execute();
                
                while ($deceasedRow = $deceasedStmt->fetch(PDO::FETCH_OBJ)) {
                    echo '<option value="' . htmlspecialchars($deceasedRow->deceased_id) . '">' . htmlspecialchars($deceasedRow->full_name) . ' (ID: ' . htmlspecialchars($deceasedRow->deceased_id) . ')</option>';
                }
                ?>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="editBurialDate" class="form-label">Date of Burial</label>
              <input type="date" class="form-control" id="editBurialDate" name="burial_date" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="editTimeOfBurial" class="form-label">Time of Burial</label>
              <input type="time" class="form-control" id="editTimeOfBurial" name="time_of_burial" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="editPlotID" class="form-label">Plot ID</label>
              <input type="text" class="form-control" id="editPlotID" name="plot_id" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="editBurialType" class="form-label">Burial Type</label>
              <select class="form-control" id="editBurialType" name="burial_type" required>
                <option value="" disabled selected>Select Burial Type</option>
                <option value="Traditional">Traditional</option>
                <option value="Cremation">Cremation</option>
                <option value="Natural">Natural</option>
                <option value="Green Burial">Green Burial</option>
                <option value="Above Ground">Above Ground</option>
                <option value="Aquamation">Aquamation</option>
                <option value="Burial at Sea">Burial at Sea</option>
                <option value="Mausoleum">Mausoleum</option>
                <option value="Community Burial">Community Burial</option>
                <option value="Home Burial">Home Burial</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="editOfficiant" class="form-label">Officiant</label>
              <input type="text" class="form-control" id="editOfficiant" name="officiant" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="editLocation" class="form-label">Location</label>
              <input type="text" class="form-control" id="editLocation" name="location" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="editBurialStatus" class="form-label">Burial Status</label>
              <select class="form-control" id="editBurialStatus" name="burial_status" required>
                <option value="" disabled selected>Select Burial Status</option>
                <option value="Completed">Completed</option>
                <option value="Pending">Pending</option>
                <option value="Cancelled">Cancelled</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="editCemetery" class="form-label">Cemetery</label>
              <input type="text" class="form-control" id="editCemetery" name="cemetery" required>
            </div>
            <div class="col-md-12 mb-3">
              <label for="editRemarks" class="form-label">Remarks</label>
              <textarea class="form-control" id="editRemarks" name="remarks" rows="3"></textarea>
            </div>
          </div>
          <button type="submit" class="btn btn-warning">Update Record</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function populateEditModal(burialID, burialDate, timeOfBurial, graveNumber, deceasedID, plotID, burialType, officiant, location, burialStatus, cemetery, remarks) {
    // Populate fields for editing
    document.getElementById('editBurialID').value = burialID;
    document.getElementById('editGraveNumber').value = graveNumber;
    document.getElementById('editDeceasedID').value = deceasedID;
    document.getElementById('editBurialDate').value = burialDate;
    document.getElementById('editTimeOfBurial').value = timeOfBurial;
    document.getElementById('editPlotID').value = plotID;
    document.getElementById('editBurialType').value = burialType;
    document.getElementById('editOfficiant').value = officiant;
    document.getElementById('editLocation').value = location;
    document.getElementById('editBurialStatus').value = burialStatus;
    document.getElementById('editCemetery').value = cemetery;
    document.getElementById('editRemarks').value = remarks;
  }
</script>

<?php 
include 'footer.php'; // Include footer
?>
