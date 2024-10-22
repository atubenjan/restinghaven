<?php 
include 'header.php'; // Include header and navigation

if (isset($_POST['edit_burial_record'])) {
  // Extract and trim all POST variables
  $burial_date = trim($_POST['burial_date']);
  $grave_number = trim($_POST['grave_number']);
  $deceased_id = trim($_POST['deceased_id']);
  $cemetery_id = trim($_POST['cemetery_id']);
  $plot_id = trim($_POST['plot_id']);
  $time_of_burial = trim($_POST['time_of_burial']);
  $burial_type = trim($_POST['burial_type']);
  $officiant = trim($_POST['officiant']);
  $location = trim($_POST['location']);
  $burial_status = trim($_POST['burial_status']);
  $remarks = trim($_POST['remarks']);
  $burial_id = trim($_POST['burial_id']);

  // Prepare the UPDATE statement
  $stmt = $dbh->prepare("UPDATE burial_records SET 
      burial_date = :burial_date, 
      grave_number = :grave_number, 
      deceased_id = :deceased_id, 
      cemetery_id = :cemetery_id, 
      plot_id = :plot_id, 
      time_of_burial = :time_of_burial, 
      burial_type = :burial_type, 
      officiant = :officiant, 
      location = :location, 
      burial_status = :burial_status, 
      remarks = :remarks 
      WHERE burial_id = :burial_id");

  // Bind parameters
  $stmt->bindParam(':burial_date', $burial_date);
  $stmt->bindParam(':grave_number', $grave_number);
  $stmt->bindParam(':deceased_id', $deceased_id);
  $stmt->bindParam(':cemetery_id', $cemetery_id);
  $stmt->bindParam(':plot_id', $plot_id);
  $stmt->bindParam(':time_of_burial', $time_of_burial);
  $stmt->bindParam(':burial_type', $burial_type);
  $stmt->bindParam(':officiant', $officiant);
  $stmt->bindParam(':location', $location);
  $stmt->bindParam(':burial_status', $burial_status);
  $stmt->bindParam(':remarks', $remarks);
  $stmt->bindParam(':burial_id', $burial_id);

  // Execute the UPDATE statement
  if ($stmt->execute()) {
      // Redirect on success
      header("Location: burial_records.php?status=success&message=Burial record updated successfully.");
      exit;
  } else {
      // Redirect on failure
      header("Location: burial_records.php?status=error&message=Failed to update burial record.");
      exit;
  }
}


$deceased_id = $dbh->query("SELECT deceased_id, full_name FROM deceased_records");
$deceased = $deceased_id->fetchAll(PDO::FETCH_OBJ);

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
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" style="background-color: #0b603a; border-color: #0b603a;">
            <i class="fas fa-plus"></i>  Add Burial Record
          </button>
       
      </div>
      <!-- /.card-header -->
      <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
      <thead style="background-color: #0b603a; color: white;">
            <tr>
              <th>ID</th>
              <th>Burial Date</th>
              <th>Time of Burial</th>
              <th>Deceased ID</th>
              <th>Grave Number</th>
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
            $stmt = $dbh->prepare("SELECT * FROM burial_records");
            $stmt->execute();
            $count = 1; 
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            ?>
            <tr>
              <td><?= $count; ?></td>
              <td><?= $row->burial_date; ?></td>
              <td><?= $row->time_of_burial; ?></td>
              <td><?= $row->deceased_id; ?></td>
              <td><?= $row->grave_number; ?></td>
              <td><?= $row->burial_type; ?></td>
              <td><?= $row->officiant; ?></td>
              <td><?= $row->location; ?></td>
              <td><?= $row->burial_status; ?></td>
              <td><?= $row->cemetery_id; ?></td>
              <td><?= $row->remarks; ?></td>
              <td>
                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewBurialModal">View</button>
                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editBurialModal<?= $row->burial_id?>">Edit</button>
                <div class="modal fade" id="editBurialModal<?= $row->burial_id?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="addBurialModalLabel">Edit Burial Record</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="">
                          <input type="hidden" value="<?= $row->burial_id?>" name="burial_id">
                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label for="grave_number" class="form-label">Grave Number</label>
                              <input type="text" class="form-control" id="grave_number" value="<?= $row->grave_number; ?>" name="grave_number" placeholder="Enter Grave Number" required>
                            </div>

                            <div class="col-md-6 mb-3">
                              <label for="addDeceasedID" class="form-label">Deceased ID</label>
                              <select class="form-control" id="addDeceasedID" name="deceased_id" required>
                                <option value="" disabled selected>Select Deceased ID</option>
                                <?php foreach ($deceased as $dc): ?>
                                    <option value="<?= $dc->deceased_id; ?>" <?= ($row->deceased_id == $dc->deceased_id) ? 'selected' : ''; ?>><?= htmlspecialchars($dc->full_name); ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>

                            <div class="col-md-6 mb-3">
                              <label for="addBurialDate" class="form-label">Date of Burial</label>
                              <input type="date" class="form-control" id="addBurialDate" value="<?= $row->burial_date; ?>" name="burial_date" required>
                            </div>

                            <div class="col-md-6 mb-3">
                              <label for="time_of_burial" class="form-label">Time of Burial</label>
                              <input type="time" class="form-control" id="time_of_burial" value="<?= $row->time_of_burial; ?>" name="time_of_burial" required>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="addPlotID" class="form-label">Plot ID</label>
                              <input type="text" class="form-control" id="addPlotID" name="plot_id" value="<?= $row->plot_id; ?>" placeholder="Enter Plot ID" required>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="burial_type" class="form-label">Burial Type</label>
                              <select class="form-control" id="burial_type" name="burial_type" required>
                                <option value="" disabled selected>Select Burial Type</option>
                                <option value="Traditional"  <?= ($row->burial_type == 'Traditional') ? 'selected' : ''; ?>>Traditional</option>
                                <option value="Cremation"  <?= ($row->burial_type == 'Cremation') ? 'selected' : ''; ?>>Cremation</option>
                                <option value="Natural"  <?= ($row->burial_type == 'Natural') ? 'selected' : ''; ?>>Natural</option>
                                <option value="Green Burial"  <?= ($row->burial_type == 'Green Burial') ? 'selected' : ''; ?>>Green Burial</option>
                                <option value="Above Ground"  <?= ($row->burial_type == 'Above Ground') ? 'selected' : ''; ?>>Above Ground</option>
                                <option value="Aquamation"  <?= ($row->burial_type == 'Aquamation') ? 'selected' : ''; ?>>Aquamation</option>
                                <option value="Burial at Sea"  <?= ($row->burial_type == 'Burial at Sea') ? 'selected' : ''; ?>>Burial at Sea</option>
                                <option value="Mausoleum"  <?= ($row->burial_type == 'Mausoleum') ? 'selected' : ''; ?>>Mausoleum</option>
                                <option value="Community Burial"  <?= ($row->burial_type == 'Community Burial') ? 'selected' : ''; ?>>Community Burial</option>
                                <option value="Home Burial"  <?= ($row->burial_type == 'Home Burial') ? 'selected' : ''; ?>>Home Burial</option>
                                <option value="Other"  <?= ($row->burial_type == 'Other') ? 'selected' : ''; ?>>Other</option>
                              </select>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="officiant" class="form-label">Officiant</label>
                              <input type="text" class="form-control" id="officiant" name="officiant" value="<?= $row->officiant; ?>" placeholder="Enter Officiant Name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="location" class="form-label">Location</label>
                              <input type="text" class="form-control" id="location" name="location" value="<?= $row->location; ?>" placeholder="Enter Location" required>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="burial_status" class="form-label">Burial Status</label>
                              <select class="form-control" id="burial_status" name="burial_status" required>
                                <option value="" disabled selected>Select Burial Status</option>
                                <option value="Completed"  <?= ($row->burial_status == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                                <option value="Pending"  <?= ($row->burial_status == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                <option value="Cancelled"  <?= ($row->burial_status == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                              </select>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="cemetery_id" class="form-label">Cemetery_id</label>
                              <input type="text" class="form-control" id="cemetery_id" name="cemetery_id" value="<?= $row->cemetery_id; ?>" placeholder="Enter Cemetery_id" required>
                            </div>
                            <div class="col-md-12 mb-3">
                              <label for="remarks" class="form-label">Remarks</label>
                              <textarea class="form-control" id="remarks" name="remarks" rows="3"><?= $row->remarks; ?>"</textarea>
                            </div>
                          </div>
                          <button type="submit" name="edit_burial_record" class="btn btn-primary">Add Record</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="delete_burial.php?id=<?= $row->burial_id; ?>" class="btn btn-danger btn-sm deleteBtn">Delete</a>
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
              <label for="cemetery_id" class="form-label">Cemetery_id</label>
              <input type="text" class="form-control" id="cemetery_id" name="cemetery_id" placeholder="Enter Cemetery_id" required>
            </div>
            <div class="col-md-12 mb-3">
              <label for="remarks" class="form-label">Remarks</label>
              <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
            </div>
          </div>
          <button type="submit" name="burial_record_btn" class="btn btn-primary">Add Record</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Burial Modal -->
<!-- <div class="modal fade" id="editBurialModal" tabindex="-1" aria-labelledby="editBurialModalLabel" aria-hidden="true">
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
</div> -->

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
