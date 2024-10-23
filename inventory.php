<?php include 'header.php'; // Include header and navigation

if (isset($_POST['edit_inventory_btn'])) {
  $id = $_POST['id'];
  $product_name = $_POST['product_name'];
  $category = $_POST['category'];
  $description = $_POST['description'];
  $quantity = $_POST['quantity'];
  $unit_of_measurement = $_POST['unit_of_measurement'];
  $reorder_level = $_POST['reorder_level'];
  $supplier_id = $_POST['supplier_id'];
  $cost_per_unit = $_POST['cost_per_unit'];
  $total_cost = $_POST['total_cost'];
  $status = $_POST['status'];

  // Prepare the SQL statement
  $stmt = $dbh->prepare("UPDATE inventory SET product_name=?, category=?, description=?, quantity=?, unit_of_measurement=?, reorder_level=?, supplier_id=?, cost_per_unit=?, total_cost=?, status=? WHERE id=?");

  // Execute the statement
  if ($stmt->execute([$product_name, $category, $description, $quantity, $unit_of_measurement, $reorder_level, $supplier_id, $cost_per_unit, $total_cost, $status, $id])) {
    header("Location: inventory.php?status=success&message=Inventory updated successfully");
    exit;
} else {
    header("Location: inventory.php?status=error&message=Error updating inventory");
    exit;
  }
}


?>
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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" style="background-color: #0b603a; border-color: #0b603a;">
            <i class="fas fa-plus"></i> Add Inventory
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
          <thead style="background-color: #0b603a; color: white;">
              <tr>
                <th>ID</th>
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
              <?php
              // Include database connection
                  $stmt = $dbh->query("SELECT * FROM inventory");
                  $count = 1;
                  while ($item = $stmt->fetch(PDO::FETCH_ASSOC)){
              ?>
                      <tr>
                      <td><?= $count;?></td>
                      <td><?= htmlspecialchars($item['product_name'])?></td>
                      <td><?= htmlspecialchars($item['category'])?></td>
                      <td><?= htmlspecialchars($item['description'])?></td>
                      <td><?= htmlspecialchars($item['quantity'])?></td>
                      <td><?= htmlspecialchars($item['unit_of_measurement'])?></td>
                      <td><?= htmlspecialchars($item['reorder_level'])?></td>
                      <td><?= htmlspecialchars($item['supplier_id'])?></td>
                      <td><?= htmlspecialchars($item['cost_per_unit'])?></td>
                      <td><?= htmlspecialchars($item['total_cost'])?></td>
                      <td><?= htmlspecialchars($item['status'])?></td>
                      <td>
                        <button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editInventoryModal<?= $item['id'];?>'>Edit</button>
                        <!-- edit modal -->
                        <div class="modal fade" id="editInventoryModal<?= $item['id'];?>">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="editInventoryModalLabel">Edit Inventory Item</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <form method="POST">
                                  <input type="hidden" id="editItemId" value="<?= $item['id'];?>" name="id">
                                  <div class="row">
                                    <div class="col-md-4">
                                      <div class="mb-3">
                                        <label for="editItemName" class="form-label">Item Name</label>
                                        <input type="text" class="form-control"  value="<?= $item['product_name'];?>" id="editItemName" name="product_name" required>
                                      </div>
                                      <div class="mb-3">
                                        <label for="editCategory" class="form-label">Category</label>
                                        <input type="text" class="form-control" value="<?= $item['category'];?>" id="editCategory" name="category" required>
                                      </div>
                                      <div class="mb-3">
                                        <label for="editDescription" class="form-label">Description</label>
                                        <textarea class="form-control" id="editDescription" name="description"><?= $item['description'];?></textarea>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="mb-3">
                                        <label for="editQuantity" class="form-label">Quantity</label>
                                        <input type="number" class="form-control" value="<?= $item['quantity'];?>" id="editQuantity" name="quantity" required>
                                      </div>
                                      <div class="mb-3">
                                        <label for="editUnitOfMeasurement" class="form-label">Unit of Measurement</label>
                                        <input type="text" class="form-control" id="editUnitOfMeasurement" value="<?= $item['unit_of_measurement'];?>" name="unit_of_measurement" required>
                                      </div>
                                      <div class="mb-3">
                                        <label for="editReorderLevel" class="form-label">Reorder Level</label>
                                        <input type="number" class="form-control" id="editReorderLevel" value="<?= $item['reorder_level'];?>" name="reorder_level" required>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="mb-3">
                                        <label for="editSupplier" class="form-label">Supplier</label>
                                        <input type="text" class="form-control" value="<?= $item['supplier_id'];?>" id="editSupplier" name="supplier_id">
                                      </div>
                                      <div class="mb-3">
                                        <label for="editCostPerUnit" class="form-label">Cost per Unit</label>
                                        <input type="number" step="0.01" class="form-control" value="<?= $item['cost_per_unit'];?>" id="editCostPerUnit" name="cost_per_unit" required>
                                      </div>
                                      <div class="mb-3">
                                        <label for="editTotalCost" class="form-label">Total Cost</label>
                                        <input type="number" step="0.01" class="form-control" value="<?= $item['total_cost'];?>" id="editTotalCost" name="total_cost" readonly>
                                      </div>
                                      <div class="mb-3">
                                        <label for="editStatus" class="form-label">Status</label>
                                        <input type="text" class="form-control" value="<?= $item['status'];?>" id="editStatus" name="status">
                                      </div>
                                    </div>
                                  </div>
                                  <button type="submit" name="edit_inventory_btn" class="btn btn-primary btn-sm">Submit</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <a href="delete_inventory.php?id=<?= $item['id'];?>" class='btn btn-danger btn-sm deleteBtn'>Delete</a>
                      </td>
                      </tr>
                
                <?php $count++; };?>
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
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Inventory</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="addInventoryForm" action="" method="post">
          <div class="row">
              <div class="col-md-6">
                  <div class="mb-3">
                      <label for="addProductName" class="form-label">Product Name</label>
                      <input type="text" class="form-control" id="addProductName" name="product_name" required>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="mb-3">
                      <label for="addProductCode" class="form-label">Product Code</label>
                      <input type="text" class="form-control" id="addProductCode" name="product_code" required>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="mb-3">
                      <label for="addCategory" class="form-label">Category</label>
                      <input type="text" class="form-control" id="addCategory" name="category" required>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="mb-3">
                      <label for="addDescription" class="form-label">Description</label>
                      <textarea class="form-control" id="addDescription" name="description"></textarea>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="mb-3">
                      <label for="addQuantity" class="form-label">Quantity</label>
                      <input type="number" class="form-control" id="addQuantity" name="quantity" required>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="mb-3">
                      <label for="addUnitOfMeasurement" class="form-label">Unit of Measurement</label>
                      <input type="text" class="form-control" id="addUnitOfMeasurement" name="unit_of_measurement" required>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="mb-3">
                      <label for="addReorderLevel" class="form-label">Reorder Level</label>
                      <input type="number" class="form-control" id="addReorderLevel" name="reorder_level" required>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="mb-3">
                      <!-- Other form fields -->
          <label for="supplier_id">Supplier:</label>
          <select name="supplier_id" id="supplier_id" required>
              <option value="">Select Supplier</option>
              <option value="1">Supplier 1</option>
              <option value="2">Supplier 2</option>
              <!-- More supplier options -->
          </select>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="mb-3">
                      <label for="addCostPerUnit" class="form-label">Cost per Unit</label>
                      <input type="number" step="0.01" class="form-control" id="addCostPerUnit" name="cost_per_unit" required>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="mb-3">
                      <label for="addTotalCost" class="form-label">Total Cost</label>
                      <input type="number" step="0.01" class="form-control" id="addTotalCost" name="total_cost" required>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="mb-3">
                      <label for="addStatus" class="form-label">Status</label>
                      <select id="addStatus" name="status" class="form-control">
                          <option value="Active">Active</option>
                          <option value="Non-active">Non-active</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="mb-3">
                      <label for="addStatus" class="form-label">Date Added</label>
                      <input type="date" name="date_added" required>
                  </div>
              </div>
            

          </div>
          <button type="submit" name="add_inventory_btn" class="btn btn-primary btn-sm">Submit</button>
      </form>

      </div>
    </div>
  </div>
</div>


<!-- JavaScript to handle total cost calculation -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    function updateTotalCost() {
        var quantity = parseFloat(document.querySelector('#addQuantity').value) || 0;
        var costPerUnit = parseFloat(document.querySelector('#addCostPerUnit').value) || 0;
        document.querySelector('#addTotalCost').value = (quantity * costPerUnit).toFixed(2);
    }

    function updateEditTotalCost() {
        var quantity = parseFloat(document.querySelector('#editQuantity').value) || 0;
        var costPerUnit = parseFloat(document.querySelector('#editCostPerUnit').value) || 0;
        document.querySelector('#editTotalCost').value = (quantity * costPerUnit).toFixed(2);
    }

    // Event listeners for add form
    document.querySelector('#addQuantity').addEventListener('input', updateTotalCost);
    document.querySelector('#addCostPerUnit').addEventListener('input', updateTotalCost);

    // Event listeners for edit form
    document.querySelector('#editQuantity').addEventListener('input', updateEditTotalCost);
    document.querySelector('#editCostPerUnit').addEventListener('input', updateEditTotalCost);

    // Initialize total cost on modal show
    $('#modal-default').on('shown.bs.modal', function () {
        updateTotalCost();
    });

    $('#editInventoryModal').on('shown.bs.modal', function () {
        updateEditTotalCost();
    });
});
</script>

<?php include 'footer.php'; // Include footer and script tags ?>
