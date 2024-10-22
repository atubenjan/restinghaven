<?php include('header.php'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Appointment</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Appointment</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Appointment Management</h3>
              <div class="card-tools"></div>
            </div>
            <!-- /.card-header -->
           
            <div class="card-body">
              <div class="card-header">
                <!-- Button to trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" style="background-color: #0b603a; border-color: #0b603a;">
                  <i class="fas fa-plus"></i> Appointment
                </button>
              </div>
              <table id="example1" class="table table-bordered table-striped">
              <thead style="background-color: #0b603a; color: white;">
                  <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Reason</th>
                    <th>Assigned To</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                      $appointments = $dbh->query("SELECT * FROM appointments");
                      $count = 1;
                      while ($row = $appointments->fetch(PDO::FETCH_OBJ)) {
                    ?>
                    <tr>
                      <td><?=$count;?></td>
                      <td><?= $row->fullname ?></td>
                      <td><?= $row->date ?></td>                  
                      <td><?= $row->time ?></td>
                      <td><?= $row->reason ?></td>
                      <td><?= $row->assigned_to ?></td>
                      <td>
                        <!-- Edit Button -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?= $row->id ?>" onclick="populateEditModal(<?= $row->id ?>)">
                          <i class="fas fa-edit"></i>
                        </button>
                        <a href="?deleteAppointments=<?= $row->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?')">
                          <i class="fas fa-trash"></i>
                        </a>
                        <button type="button" class="btn btn-info btn-sm text-white" data-toggle="modal" data-target="#viewProduct<?= $row->id ?>">
                          <i class="fas fa-eye"></i>
                        </button>
                      </td>
                    </tr>

                 
                   <!-- Edit Modal -->
<div class="modal fade" id="editModal<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $row->id ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel<?= $row->id ?>">Edit Appointment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
          <input type="hidden" name="id" value="<?= $row->id ?>">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="editFullname<?= $row->id ?>" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="editFullname<?= $row->id ?>" name="fullname" value="<?= $row->fullname ?>" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="editAssignedTo<?= $row->id ?>" class="form-label">Assigned to</label>
              <input type="text" class="form-control" id="editAssignedTo<?= $row->id ?>" name="assigned_to" value="<?= $row->assigned_to ?>" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="editDate<?= $row->id ?>" class="form-label">Date</label>
              <input type="date" class="form-control" id="editDate<?= $row->id ?>" name="date" value="<?= $row->date ?>" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="editTime<?= $row->id ?>" class="form-label">Time</label>
              <input type="time" class="form-control" id="editTime<?= $row->id ?>" name="time" value="<?= $row->time ?>" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="editReason<?= $row->id ?>" class="form-label">Reason</label>
            <textarea class="form-control" id="editReason<?= $row->id ?>" name="reason" rows="3" required><?= $row->reason ?></textarea>
          </div>
          <button type="submit" name="update_appointment_btn" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>


                    <?php
                    $count++; // Increment count for the next row
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

<?php 
// Handle Appointment Deletion
if (isset($_GET['deleteAppointments'])) {
  $id = $_GET['deleteAppointments'];
  $stmt = $dbh->prepare("DELETE FROM appointments WHERE id = :id");
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  if ($stmt->execute()) {
    echo "<script>
            alert('Appointment deleted successfully.');
            window.location.href = 'appointments'; // Redirect to the same page
          </script>";
  } else {
    echo "<script>alert('Error deleting appointment.');</script>";
  }
}

// Handle Appointment Update
if (isset($_POST['update_appointment_btn'])) {
  $id = $_POST['id'];
  $fullname = $_POST['fullname'];
  $date = $_POST['date'];
  $time = $_POST['time'];
  $reason = $_POST['reason'];
  $assigned_to = $_POST['assigned_to'];

  $stmt = $dbh->prepare("UPDATE appointments SET fullname = :fullname, date = :date, time = :time, reason = :reason, assigned_to = :assigned_to WHERE id = :id");
  $stmt->bindParam(':fullname', $fullname);
  $stmt->bindParam(':date', $date);
  $stmt->bindParam(':time', $time);
  $stmt->bindParam(':reason', $reason);
  $stmt->bindParam(':assigned_to', $assigned_to);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);

  if ($stmt->execute()) {
    echo "<script>
            alert('Appointment updated successfully.');
            window.location.href = 'appointments'; // Redirect to the same page
          </script>";
  } else {
    echo "<script>alert('Error updating appointment.');</script>";
  }
}
?>

<!-- Add Product Modal -->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Schedule An Appointment</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addAppointmentForm" method="post">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="addFullname" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="addFullname" name="fullname" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="addAssignedTo" class="form-label">Assigned to</label>
              <select class="form-control" id="addAssignedTo" name="assigned_to" required>
                <option value="">Select Who to Assign </option>
                <?php
                  // Fetch users and their roles from the database
                  $users = $dbh->query("SELECT username, user_role FROM users");
                  while ($user = $users->fetch(PDO::FETCH_OBJ)) {
                    echo "<option value='{$user->username}'>{$user->username} ({$user->user_role})</option>";
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="addDate" class="form-label">Date</label>
              <input type="date" class="form-control" id="addDate" name="date" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="addTime" class="form-label">Time</label>
              <input type="time" class="form-control" id="addTime" name="time" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="addReason" class="form-label">Reason</label>
            <textarea class="form-control" id="addReason" name="reason" rows="3" required></textarea>
          </div>
          <button type="submit" name="add_appointment_btn" class="btn btn-sm btn-primary">Add Appointment</button>
        </form>
      </div>
    </div>
  </div>
</div>




<?php include('footer.php'); ?>
