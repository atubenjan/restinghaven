<?php include 'header.php'; // Include header and navigation 

if(isset($_POST['edit_branch'])){
  $branch_id = trim($_POST['branch_id']);
  $branch_name = trim($_POST['branch_name']);
  $location = trim($_POST['location']);
  $branch_manager = trim($_POST['branch_manager']);
  $contact = trim($_POST['contact']);

  // Prepare the UPDATE statement
  $stmt = $dbh->prepare("UPDATE branch SET branch_name =:branch_name, location =:location, branch_manager =:branch_manager, contact =:contact WHERE branch_id = :branch_id");

  // Bind the parameters
  $stmt->bindParam(':branch_name', $branch_name);
  $stmt->bindParam(':location', $location);
  $stmt->bindParam(':branch_manager', $branch_manager);
  $stmt->bindParam(':contact', $contact);
  $stmt->bindParam(':branch_id', $branch_id);

  // Execute the query
  if($stmt->execute()){
    // Redirect to the branch page with success message
    header("Location: branch.php?status=success&message=Branch updated successfully.");
    exit;
  } else {
    // Redirect to the branch page with error message
    header("Location: branch.php?status=error&error=Error updating branch.");
    exit;
  }
}

$managerStmt = $dbh->query("SELECT id, username FROM users WHERE user_role = 'manager'");
$managers = $managerStmt->fetchAll(PDO::FETCH_OBJ);

?>

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
              $branchStmt = $dbh->query("SELECT branch.*,users.username FROM branch LEFT JOIN users ON users.id = branch.branch_manager");
              $count = 1;
              while ($row = $branchStmt->fetch(PDO::FETCH_OBJ)) {
              ?>
              <tr>
                <td><?= $row->branch_id; ?></td>
                <td><?= $row->branch_name; ?></td>
                <td><?= $row->location; ?></td>
                <td><?= $row->username; ?></td>
                <td><?= $row->contact; ?></td>
                <td>
                  <a href="delete_branch.php?branch_id=<?= $row->branch_id; ?>" class="btn btn-sm btn-danger deleteBtn">
                    <i class="fas fa-trash"></i>
                  </a>
                  <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#branchEdit<?= $row->branch_id?>">
                    <i class="fas fa-edit"></i>
                  </button>
                  <div class="modal fade" id="branchEdit<?= $row->branch_id?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header" style="background-color: #0b603a; color: white;">
                          <h5 class="modal-title" id="editBranchModalLabel">Edit New Branch</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="POST">
                            <input type="hidden" name="branch_id" value="<?= $row->branch_id; ?>">

                            <div class="row">
                              <!-- Left Column -->
                              <div class="col-md-6">
                                <div class="mb-3">
                                  <label for="editBranchName" class="form-label">Branch Name</label>
                                  <input type="text" class="form-control" id="editBranchName" name="branch_name" value="<?= $row->branch_name; ?>" required>
                                </div>

                                <div class="mb-3">
                                  <label for="editBranchManager" class="form-label">Branch Manager</label>
                                  <select class="form-control" id="editBranchManager" name="branch_manager" required>
                                    <option value="" selected disabled>Select a Manager</option>
                                    <?php foreach ($managers as $manager): ?>
                                      <option value="<?= $manager->id; ?>" <?= ($row->branch_manager == $manager->id) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($manager->username); ?>
                                      </option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                              </div>

                              <!-- Right Column -->
                              <div class="col-md-6">
                                <div class="mb-3">
                                  <label for="editBranchLocation" class="form-label">Location</label>
                                  <input type="text" class="form-control" id="editBranchLocation" name="location" value="<?= $row->location; ?>" required>
                                </div>
                                <div class="mb-3">
                                  <label for="editBranchContact" class="form-label">Contact</label>
                                  <input type="text" class="form-control" id="editBranchContact" name="contact" value="<?= $row->contact; ?>" required>
                                </div>
                              </div>
                            </div>

                            <button type="submit" name="edit_branch" class="btn btn-primary" style="background-color: #0b603a; color: white;">Update Branch</button>
                          </form>
                        </div>

                      </div>
                    </div>
                  </div>
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="addBranchName" class="form-label">Branch Name</label>
                <input type="text" class="form-control" id="addBranchName" name="branch_name" required>
              </div>
              <div class="mb-3">
                <label for="addBranchLocation" class="form-label">Location</label>
                <input type="text" class="form-control" id="addBranchLocation" name="location" required>
              </div>
            </div>
            <div class="col-md-6">
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
            </div>
          </div>
          <button type="submit" name="add_branch_btn" class="btn btn-primary" style="background-color: #0b603a;">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>



<?php include 'footer.php'; // Include footer ?>
