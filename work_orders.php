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
                      <td><?= $row->description ?></td>
                      <td class="status-text <?= strtolower(str_replace(' ', '-', $row->status)); ?>">
                        <?= $row->status ?>
                      </td>
                      <td class="priority-text <?= strtolower($row->priority) == 'high' ? 'high' : ''; ?>">
                        <?= $row->priority ?>
                      </td>
                      <td><?= $row->assigned_to ?></td>
                      <td><?= $row->due_date ?></td>
                      <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editWorkOrderModal">Edit</button>
                        <a href="delete_work_order.php?id=<?= $row->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this work order?');">Delete</a>
                      </td>
                    </tr>
                    <?php 
                      $count++;  
                    }
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
        <h4 class="modal-title" id="modalTitle">Add Work Order</h4> <!-- Dynamic title -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="workOrderForm" action="" method="POST">
          <!-- Hidden input for the Work Order ID (used for editing) -->
          <input type="hidden" id="workOrderId" name="id">

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
          
          <button type="submit" name="add_work_order_btn" class="btn btn-primary" id="saveButton">Add Work Order</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  // Function to set the modal for editing or adding a work order
  function openWorkOrderModal(workOrder = null) {
    if (workOrder) {
      // If work order exists, we are editing
      document.getElementById('modalTitle').innerText = 'Edit Work Order';
      document.getElementById('workOrderId').value = workOrder.id; // Set work order ID
      document.getElementById('addDescription').value = workOrder.description;
      document.getElementById('addStatus').value = workOrder.status;
      document.getElementById('addPriority').value = workOrder.priority;
      document.getElementById('userRole').value = workOrder.assigned_to;
      document.getElementById('addDueDate').value = workOrder.due_date;
      document.getElementById('saveButton').innerText = 'Update Work Order'; // Change button text
    } else {
      // If no work order, we are adding a new one
      document.getElementById('modalTitle').innerText = 'Add Work Order';
      document.getElementById('workOrderForm').reset(); // Clear form fields
      document.getElementById('saveButton').innerText = 'Add Work Order'; // Button text for adding
    }
    $('#modal-default').modal('show'); // Show modal
  }
</script>


<style>
  .status-text {
      padding: 1px 5px; /* Smaller padding for a tighter background */
      border-radius: 3px; /* Slight rounding of corners */
      display: inline-block; /* Ensure the background fits tightly around the text */
      font-size: 0.9rem; /* Slightly smaller font size */
      font-weight: bold; /* Make the text bold */
      text-align: center; /* Center text inside the background */
      margin: auto; /* This helps center the background within the cell */
  }

  .status-text.pending {
      background-color: #f0ad4e; /* Warning color for Pending */
      color: white; /* White text */
  }

  .status-text.in-progress {
      background-color: #5bc0de; /* Info color for In Progress */
      color: white; /* White text */
  }

  .status-text.completed {
      background-color: #5cb85c; /* Success color for Completed */
      color: white; /* White text */
  }

 
 
</style>

<?php include('footer.php'); ?>
