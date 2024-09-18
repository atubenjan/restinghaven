<?php include('header.php'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Work Order</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Work Order</li>
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
              <h3 class="card-title">Work Order Management</h3>
              <div class="card-tools">
               
              </div>
            </div>
            <!-- /.card-header -->
           
            <div class="card-body">
            <div class="card-header">
          <!-- Button to trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            <i class="fas fa-plus"></i> Work Order
          </button>
        </div>
        <div class="card-body">
          <table id="workOrdersTable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Assigned To</th>
                <th>Due Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- Example Row -->
              <tr>
                <td>1</td>
                <td>Repair broken gate</td>
                <td>Pending</td>
                <td>High</td>
                <td>John Doe</td>
                <td>2024-09-15</td>
                <td>
                  <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editWorkOrderModal" onclick="populateEditModal(1, 'Repair broken gate', 'Pending', 'High', 'John Doe', '2024-09-15')">Edit</button>
                  <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this work order?');">Delete</button>
                </td>
              </tr>
              <!-- Add more rows as needed -->
            </tbody>
          </table>
        </div>
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
        <h4 class="modal-title">Work Order</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method>
                <input type="hidden" id="editWorkOrderId" name="id">
                <div class="mb-3">
                  <label for="editDescription" class="form-label">Description</label>
                  <textarea class="form-control" id="editDescription" name="description" required></textarea>
                </div>
                <div class="mb-3">
                  <label for="editStatus" class="form-label">Status</label>
                  <select class="form-select" id="editStatus" name="status" required>
                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="editPriority" class="form-label">Priority</label>
                  <select class="form-select" id="editPriority" name="priority" required>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="editAssignedTo" class="form-label">Assigned To</label>
                  <input type="text" class="form-control" id="editAssignedTo" name="assigned_to">
                </div>
                <div class="mb-3">
                  <label for="editDueDate" class="form-label">Due Date</label>
                  <input type="date" class="form-control" id="editDueDate" name="due_date">
                </div>
                <button type="submit" name="add_work_btn" class="btn btn-primary">Save changes</button>
              </form>


    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<?php include('footer.php'); ?>