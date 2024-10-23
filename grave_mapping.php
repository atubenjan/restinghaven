<?php
  include 'header.php'; // Include header and navigation

  if(isset($_POST['edit_grave_mapping'])) {
    $id = $_POST['id'];
    $grave_number = $_POST['grave_number'];
    $location = $_POST['location'];
    $lot_number = $_POST['lot_number'];
    $size = $_POST['size'];
    $status = $_POST['status'];
    $remarks = $_POST['remarks'];

    // Prepare the UPDATE statement
    $stmt = $dbh->prepare("UPDATE grave_mapping SET 
        grave_number =?, 
        location =?, 
        lot_number =?, 
        size =?, 
        status =?, 
        remarks =? 
        WHERE id =?");

    // Bind the parameters
    $stmt->bindParam(1, $grave_number);
    $stmt->bindParam(2, $location);
    $stmt->bindParam(3, $lot_number);
    $stmt->bindParam(4, $size);
    $stmt->bindParam(5, $status);
    $stmt->bindParam(6, $remarks);
    $stmt->bindParam(7, $id);

    // Execute the statement
    if ($stmt->execute()) {
      header("Location: grave_mapping.php?status=success&message=Grave mapping updated successfully");
      exit();
      } else {
        header("Location: grave_mapping.php?status=error&message=Failed to update grave mapping");
        exit();
      }
  }
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
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" style="background-color: #0b603a; border-color: #0b603a;">
            Add Grave Mapping
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="graveMappingTable" class="table table-bordered table-striped">
          <thead style="background-color: #0b603a; color: white;">
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
              <?php
              $stmt= $dbh->prepare("SELECT * FROM grave_mapping");
              $stmt->execute();
              $count = 1;
              while($row = $stmt->fetch(PDO::FETCH_OBJ)){
              ?>
              <tr>
                <td><?= $count;?></td>
                <td><?= $row->grave_number;?></td>
                <td><?= $row->location;?></td>
                <td><?= $row->lot_number;?></td>
                <td><?= $row->size;?></td>
                <td><?= $row->status;?></td>
                <td><?= $row->remarks;?></td>
                <td>
                  <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editGraveMappingModal<?= $row->id?>">Edit</button>
                  <!-- Edit Grave Mapping Modal -->
                <div class="modal fade" id="editGraveMappingModal<?= $row->id?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" style="background-color: #0b603a; border-color: #0b603a;">
                        <h5 class="modal-title" id="editGraveMappingModalLabel">Edit Grave Mapping Record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                      </div>
                      <div class="modal-body">
                        <form method="post">
                          <input type="hidden" id="id" value="<?= $row->id?>" name="id">
                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label for="editGraveNumber" class="form-label">Grave Number</label>
                              <input type="text" class="form-control" value="<?= $row->grave_number?>" id="editGraveNumber" name="grave_number" required>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="editLocation" class="form-label">Location</label>
                              <input type="text" class="form-control" value="<?= $row->location?>" id="editLocation" name="location" required>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="editLotNumber" class="form-label">Lot Number</label>
                              <input type="text" class="form-control" id="editLotNumber" value="<?= $row->lot_number?>" name="lot_number">
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="editSize" class="form-label">Size</label>
                              <input type="text" class="form-control" id="editSize" value="<?= $row->size?>" name="size">
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="editStatus" class="form-label">Status</label>
                              <input type="text" class="form-control" id="editStatus" value="<?= $row->status?>" name="status">
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="editRemarks" class="form-label">Remarks</label>
                              <textarea class="form-control" id="editRemarks" name="remarks"><?= $row->remarks?></textarea>
                            </div>
                          </div>
                          <button type="submit" class="btn btn-primary" name="edit_grave_mapping" style="background-color: #0b603a; border-color: #0b603a;">Save changes</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                  <a href="delete_grave_mapping.php?id=<?= $row->id?>" class="btn btn-danger btn-sm deleteBtn">Delete</a>
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

<!-- Add Grave Mapping Modal -->
<div class="modal fade" id="addGraveMappingModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addGraveMappingModalLabel">Add New Grave Mapping</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST">
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
          <button type="submit" name="grave_mapping_btn" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php include 'footer.php'; // Include footer ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // JavaScript to populate edit modal with grave mapping record data
  // function populateEditModal(id, grave_number, location, lot_number, size, status, remarks) {
  //   document.getElementById('editGraveMappingId').value = id;
  //   document.getElementById('editGraveNumber').value = grave_number;
  //   document.getElementById('editLocation').value = location;
  //   document.getElementById('editLotNumber').value = lot_number;
  //   document.getElementById('editSize').value = size;
  //   document.getElementById('editStatus').value = status;
  //   document.getElementById('editRemarks').value = remarks;
  // }

  // // Handle form submissions (optional)
  // document.getElementById('addGraveMappingForm').addEventListener('submit', function(event) {
  //   event.preventDefault();
  //   // Handle add grave mapping form submission
  //   alert('Add Grave Mapping Form submitted');
  // });

  // document.getElementById('editGraveMappingForm').addEventListener('submit', function(event) {
  //   event.preventDefault();
  //   // Handle edit grave mapping form submission
  //   alert('Edit Grave Mapping Form submitted');
  // });
</script>
