<?php include 'header.php'; // Include header and navigation ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0" style="color: #0b603a;">Branch Management</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#" style="color: #0b603a;">Home</a></li>
            <li class="breadcrumb-item active">Branch Management</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Branch table -->
      <div class="card">
        <div class="card-header">
          <!-- Button to trigger the Add Branch modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" style="background-color: #0b603a; border-color: #0b603a;">
            <i class="fas fa-plus"></i> Add Branch
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead style="background-color: #0b603a; color: white;">
              <tr>
                <th>Branch ID</th>
                <th>Branch Name</th>
                <th>Location</th>
                <th>Branch Manager</th>
                <th>Contact</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $stmt = $dbh->query("SELECT * FROM branch");
              $count = 1;
              while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
              ?>
              <tr>
                <td><?= $count; ?></td>
                <td><?= $row->branch_name; ?></td>
                <td><?= $row->location; ?></td>
                <td><?= $row->branch_manager; ?></td>
                <td><?= $row->contact; ?></td>
                <td>
                  <a href="delete_branch.php?id=<?= $row->branch_id; ?>" class="btn btn-sm btn-danger" 
                     onclick="return confirm('Are you sure you want to delete this branch?');" 
                     style="background-color: #dc3545;">
                    <i class="fas fa-trash"></i>
                  </a>
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

<!-- Add Branch Modal -->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #0b603a; color: white;">
        <h5 class="modal-title" id="addBranchModalLabel">Add New Branch</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
          <div class="mb-3">
            <label for="addBranchName" class="form-label">Branch Name</label>
            <input type="text" class="form-control" id="addBranchName" name="branch_name" required>
          </div>
          <div class="mb-3">
            <label for="addBranchLocation" class="form-label">Location</label>
            <input type="text" class="form-control" id="addBranchLocation" name="location" required>
          </div>
          <div class="mb-3">
            <label for="addBranchManager" class="form-label">Branch Manager</label>
            <select class="form-control" id="addBranchManager" name="branch_manager" required>
              <option value="">Select a Manager</option>
              <?php
              $stmt = $dbh->query("SELECT id, username FROM users WHERE user_role = 'manager'");
              while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                  echo "<option value=\"{$row->id}\">{$row->username}</option>";
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="addBranchContact" class="form-label">Contact</label>
            <input type="text" class="form-control" id="addBranchContact" name="contact" required>
          </div>
          <button type="submit" name="add_branch_btn" class="btn btn-primary" style="background-color: #0b603a;">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; // Include footer ?>
