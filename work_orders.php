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
               <?php 
                 $stmt = $dbh->query('SELECT * FROM work_orders');
                 $count = 1;
                 while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
               ?>
              <tr>
                <td><?= $count ?></td>
                <td><?= $row->description?></td>
                <td><?= $row->status?></td>
                <td><?= $row->priority?></td>
                <td><?= $row->assigned_to?></td>
                <td><?= $row->due_date?></td>
                <td>
                  <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editWorkOrderModal" onclick="populateEditModal(1, 'Repair broken gate', 'Pending', 'High', 'John Doe', '2024-09-15')">Edit</button>
                  <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this work order?');">Delete</button>
                </td>
              </tr>
              <?php 
              $count++;  }
               ?>
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
        <form action="" method="POST">
          <input type="hidden" id="editWorkOrderId" name="id">
          
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="addDescription" class="form-label">Description</label>
              <textarea class="form-control" id="addDescription" name="description" required></textarea>
            </div>
            
            <div class="col-md-6 mb-3">
              <label for="addStatus" class="form-label">Status</label>
              <select class="form-control" id="addStatus" name="status" required>
                <option value="Pending">Pending</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
              </select>
            </div>
            
            <div class="col-md-6 mb-3">
              <label for="addPriority" class="form-label">Priority</label>
              <select class="form-control" id="addPriority" name="priority" required>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
              </select>
            </div>
            
            <div class="col-md-6 mb-3">
              <label for="userRole" class="form-label">Assigned To</label>
              <select class="form-control" id="userRole" name="assigned_to" required>
                <option value="" disabled selected>Select User Role</option>
                <?php
                // Fetch user roles from the database
                $user_roles = ["Admin", "SuperAdmin", "Manager", "FuneralDirector", "CemeteryStaff", "Accounting", "Maintenance"];
                foreach ($user_roles as $user_role) {
                    echo "<option value=\"$user_role\">$user_role</option>";
                }
                ?>
              </select>
            </div>
            
            <div class="col-md-6 mb-3">
              <label for="addDueDate" class="form-label">Due Date</label>
              <input type="date" class="form-control" id="addDueDate" name="due_date" required>
            </div>
          </div>
          
          <button type="submit" name="add_work_order_btn" class="btn btn-primary">Save changes</button>
        </form>
      </div>
      <!-- /.modal-body -->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- /.modal -->



<?php include('footer.php'); ?>