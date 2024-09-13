<?php include 'header.php'; // Include header and navigation ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Inventory</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Inventory</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Inventory table -->
      <div class="card">
        <div class="card-header">
          <!-- Buttons to trigger modals and download -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInventoryModal">
            Add Inventory Item
          </button>
          <a href="download_inventory.php" class="btn btn-info float-right">
            Download Inventory
          </a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Item ID</th>
                <th>Item Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Unit of Measurement</th>
                <th>Reorder Level</th>
                <th>Supplier</th>
                <th>Cost per Unit</th>
                <th>Total Cost</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td colspan="11" style="text-align: center;">No data available</td>
                <td>
                  <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editInventoryModal">Edit</button>
                  <a href="delete_inventory.html" class="btn btn-danger btn-sm">Delete</a>
                </td>
              </tr>
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

<!-- Add Inventory Modal -->
<div class="modal fade" id="addInventoryModal" tabindex="-1" aria-labelledby="addInventoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addInventoryModalLabel">Add New Inventory Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addInventoryForm">
          <div class="row">
            <div class="col-md-4">
              <div class="mb-3">
                <label for="addItemId" class="form-label">Item ID</label>
                <input type="text" class="form-control" id="addItemId" name="item_id" required>
              </div>
              <div class="mb-3">
                <label for="addItemName" class="form-label">Item Name</label>
                <input type="text" class="form-control" id="addItemName" name="item_name" required>
              </div>
              <div class="mb-3">
                <label for="addCategory" class="form-label">Category</label>
                <input type="text" class="form-control" id="addCategory" name="category" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="addDescription" class="form-label">Description</label>
                <textarea class="form-control" id="addDescription" name="description"></textarea>
              </div>
              <div class="mb-3">
                <label for="addQuantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="addQuantity" name="quantity" required>
              </div>
              <div class="mb-3">
                <label for="addUnitOfMeasurement" class="form-label">Unit of Measurement</label>
                <input type="text" class="form-control" id="addUnitOfMeasurement" name="unit_of_measurement" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="addReorderLevel" class="form-label">Reorder Level</label>
                <input type="number" class="form-control" id="addReorderLevel" name="reorder_level" required>
              </div>
              <div class="mb-3">
                <label for="addSupplier" class="form-label">Supplier</label>
                <input type="text" class="form-control" id="addSupplier" name="supplier">
              </div>
              <div class="mb-3">
                <label for="addCostPerUnit" class="form-label">Cost per Unit</label>
                <input type="number" step="0.01" class="form-control" id="addCostPerUnit" name="cost_per_unit" required>
              </div>
              <div class="mb-3">
                <label for="addTotalCost" class="form-label">Total Cost</label>
                <input type="number" step="0.01" class="form-control" id="addTotalCost" name="total_cost" readonly>
              </div>
              <div class="mb-3">
                <label for="addStatus" class="form-label">Status</label>
                <input type="text" class="form-control" id="addStatus" name="status">
              </div>
              <div class="mb-3">
                <label for="addDate" class="form-label">Date</label>
                <input type="date" class="form-control" id="addDate" name="date">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Inventory Modal -->
<div class="modal fade" id="editInventoryModal" tabindex="-1" aria-labelledby="editInventoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editInventoryModalLabel">Edit Inventory Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editInventoryForm">
          <input type="hidden" id="editItemId" name="item_id">
          <div class="row">
            <div class="col-md-4">
              <div class="mb-3">
                <label for="editItemName" class="form-label">Item Name</label>
                <input type="text" class="form-control" id="editItemName" name="item_name" required>
              </div>
              <div class="mb-3">
                <label for="editCategory" class="form-label">Category</label>
                <input type="text" class="form-control" id="editCategory" name="category" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="editDescription" class="form-label">Description</label>
                <textarea class="form-control" id="editDescription" name="description"></textarea>
              </div>
              <div class="mb-3">
                <label for="editQuantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="editQuantity" name="quantity" required>
              </div>
              <div class="mb-3">
                <label for="editUnitOfMeasurement" class="form-label">Unit of Measurement</label>
                <input type="text" class="form-control" id="editUnitOfMeasurement" name="unit_of_measurement" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="editReorderLevel" class="form-label">Reorder Level</label>
                <input type="number" class="form-control" id="editReorderLevel" name="reorder_level" required>
              </div>
              <div class="mb-3">
                <label for="editSupplier" class="form-label">Supplier</label>
                <input type="text" class="form-control" id="editSupplier" name="supplier">
              </div>
              <div class="mb-3">
                <label for="editCostPerUnit" class="form-label">Cost per Unit</label>
                <input type="number" step="0.01" class="form-control" id="editCostPerUnit" name="cost_per_unit" required>
              </div>
              <div class="mb-3">
                <label for="editTotalCost" class="form-label">Total Cost</label>
                <input type="number" step="0.01" class="form-control" id="editTotalCost" name="total_cost" readonly>
              </div>
              <div class="mb-3">
                <label for="editStatus" class="form-label">Status</label>
                <input type="text" class="form-control" id="editStatus" name="status">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; // Include footer and script tags ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // JavaScript to populate edit modal with inventory data
  function populateEditModal(item_id, item_name, category, description, quantity, unit_of_measurement, reorder_level, supplier, cost_per_unit, total_cost, status) {
    document.getElementById('editItemId').value = item_id;
    document.getElementById('editItemName').value = item_name;
    document.getElementById('editCategory').value = category;
    document.getElementById('editDescription').value = description;
    document.getElementById('editQuantity').value = quantity;
    document.getElementById('editUnitOfMeasurement').value = unit_of_measurement;
    document.getElementById('editReorderLevel').value = reorder_level;
    document.getElementById('editSupplier').value = supplier;
    document.getElementById('editCostPerUnit').value = cost_per_unit;
    document.getElementById('editTotalCost').value = total_cost;
    document.getElementById('editStatus').value = status;
  }
  
  // Handle form submissions (optional)
  document.getElementById('addInventoryForm').addEventListener('submit', function(event) {
    event.preventDefault();
    // Handle add inventory form submission
    alert('Add Inventory Form submitted');
  });

  document.getElementById('editInventoryForm').addEventListener('submit', function(event) {
    event.preventDefault();
    // Handle edit inventory form submission
    alert('Edit Inventory Form submitted');
  });
</script>