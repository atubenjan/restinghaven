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
              <div class="card-tools">
               
              </div>
            </div>
            <!-- /.card-header -->
           
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
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
                      <td><?= $count; ?></td>
                      <td><?= $row->fullname ?></td>
                      <td><?= $row->date ?></td>                  
                      <td><?= $row->time ?></td>
                      <td><?= $row->reason ?></td>
                      <td><?= $row->assigned_to ?></td>
                     
                      <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editProduct<?= $row->id ?>">
                          <i class="fas fa-edit"></i>
                        </button>
                        <a href="?deleteProduct=<?= $row->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?')">
                          <i class="fas fa-trash"></i>
                        </a>
                        <button type="button" class="btn btn-info btn-sm text-white" data-toggle="modal" data-target="#viewProduct<?= $row->id ?>">
                          <i class="fas fa-eye"></i>
                        </button>
                      </td>
                    </tr>
                  <?php
                    $count++;
                    include 'edit-product.php';
                    include 'view-product.php';
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

<?php if (isset($_REQUEST['deleteProduct'])) {
  $id = $_GET['deleteProduct'];
  $sql = $dbh->query("DELETE FROM products WHERE id = '$id' ");
  if ($sql) {
    echo "
          <script>
            window.location.href = 'products';
          </script>
        ";
  }
}
?>

<!-- Add Product Modal -->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Product</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="addAppointmentForm"  method="post">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="addFullname" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="addFullname" name="fullname" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="addDate" class="form-label">Date</label>
                <input type="date" class="form-control" id="addDate" name="date" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="addTime" class="form-label">Time</label>
                <input type="time" class="form-control" id="addTime" name="time" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="mb-3">
                <label for="addReason" class="form-label">Reason</label>
                <textarea class="form-control" id="addReason" name="reason" rows="3" required></textarea>
              </div>
            </div>
            <div class="col-md-12">
              <div class="mb-3">
                <label for="addAssignedTo" class="form-label">Assigned to</label>
                <input type="text" class="form-control" id="addAssignedTo" name="assigned_to" required>
              </div>
            </div>
          </div>
          <button type="submit" name="add_appointment_btn" class="btn btn-primary">Submit</button>
        </form>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<?php include('footer.php'); ?>