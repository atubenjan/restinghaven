<?php include 'header.php'; // Include header and navigation ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Work Orders</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Work Orders</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Work Orders table -->
      <div class="card">
        <div class="card-header">
          <!-- Buttons to trigger modals -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addWorkOrderModal">
            Add Work Order
          </button>
        </div>
        <!-- /.card-header -->
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
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- Add Work Order Modal -->
      <div class="modal fade" id="addWorkOrderModal" tabindex="-1" aria-labelledby="addWorkOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addWorkOrderModalLabel">Add New Work Order</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="addWorkOrderForm">
                <div class="mb-3">
                  <label for="addDescription" class="form-label">Description</label>
                  <textarea class="form-control" id="addDescription" name="description" required></textarea>
                </div>
                <div class="mb-3">
                  <label for="addStatus" class="form-label">Status</label>
                  <select class="form-select" id="addStatus" name="status" required>
                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="addPriority" class="form-label">Priority</label>
                  <select class="form-select" id="addPriority" name="priority" required>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="addAssignedTo" class="form-label">Assigned To</label>
                  <input type="text" class="form-control" id="addAssignedTo" name="assigned_to">
                </div>
                <div class="mb-3">
                  <label for="addDueDate" class="form-label">Due Date</label>
                  <input type="date" class="form-control" id="addDueDate" name="due_date">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Edit Work Order Modal -->
      <div class="modal fade" id="editWorkOrderModal" tabindex="-1" aria-labelledby="editWorkOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editWorkOrderModalLabel">Edit Work Order</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="editWorkOrderForm">
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
                <button type="submit" class="btn btn-primary">Save changes</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'footer.php'; // Include footer ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // JavaScript to populate edit modal with work order data
  function populateEditModal(id, description, status, priority, assigned_to, due_date) {
    document.getElementById('editWorkOrderId').value = id;
    document.getElementById('editDescription').value = description;
    document.getElementById('editStatus').value = status;
    document.getElementById('editPriority').value = priority;
    document.getElementById('editAssignedTo').value = assigned_to;
    document.getElementById('editDueDate').value = due_date;
  }
  
  // Handle form submissions (optional)
  document.getElementById('addWorkOrderForm').addEventListener('submit', function(event) {
    event.preventDefault();
    // Handle add work order form submission
    alert('Add Work Order Form submitted');
  });

  document.getElementById('editWorkOrderForm').addEventListener('submit', function(event) {
    event.preventDefault();
    // Handle edit work order form submission
    alert('Edit Work Order Form submitted');
  });
</script>

