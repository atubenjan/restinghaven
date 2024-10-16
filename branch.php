<?php include 'header.php'; // Include header and navigation ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Branch Management</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
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
          <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addBranchModal">
            Add Branch
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
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
                <td><?= $row->branch_name; ?></td>
                <td><?= $row->location; ?></td>
                <td><?= $row->branch_manager; ?></td>
                <td><?= $row->contact; ?></td>
                <td>
                  <a href="delete_branch.php?id=<?= $row->branch_id; ?>" 
                     class="btn btn-info btn-sm btn-danger" 
                     onclick="return confirm('Are you sure you want to delete this branch?');">
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
<div class="modal fade" id="addBranchModal"  aria-labelledby="addBranchModalLabel" aria-hidden="true">
<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" 
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
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
            <input type="text" class="form-control" id="addBranchManager" name="branch_manager" required>
          </div>
          <div class="mb-3">
            <label for="addBranchContact" class="form-label">Contact</label>
            <input type="text" class="form-control" id="addBranchContact" name="contact" required>
          </div>
          <button type="submit" name="add_branch_btn" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; // Include footer ?>

