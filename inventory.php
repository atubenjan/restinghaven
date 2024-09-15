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
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            <i class="fas fa-plus"></i> Add Inventory
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
              <?php
              // Include database connection

              // Fetch inventory items
              try {
                  $stmt = $dbh->query("SELECT * FROM inventory");
                  $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  // Display each item
                  foreach ($items as $item) {
                      echo "<tr>";
                      echo "<td>" . htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars($item['product_name'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars($item['category'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars($item['description'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars($item['quantity'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars($item['unit_of_measurement'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars($item['reorder_level'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars($item['supplier_id'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars($item['cost_per_unit'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars($item['total_cost'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars($item['status'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>
                            <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editInventoryModal' data-id='" . htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8') . "'>Edit</button>
                            <a href='delete_inventory.php?id=" . htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8') . "' class='btn btn-danger btn-sm'>Delete</a>
                            </td>";
                      echo "</tr>";
                  }
              } catch (PDOException $e) {
                  echo "Error: " . $e->getMessage();
              }
              ?>
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
        <form action="" method="post">
          <div class="row">
            <div class="col-md-4">
              <div class="mb-3">
                <label for="addItemName" class="form-label">Item Name</label>
                <input type="text" class="form-control" id="addItemName" name="product_name" required>
              </div>
              <div class="mb-3">
                <label for="addCategory" class="form-label">Category</label>
                <input type="text" class="form-control" id="addCategory" name="category" required>
              </div>
              <div class="mb-3">
                <label for="addDescription" class="form-label">Description</label>
                <textarea class="form-control" id="addDescription" name="description"></textarea>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="addQuantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="addQuantity" name="quantity" required>
              </div>
              <div class="mb-3">
                <label for="addUnitOfMeasurement" class="form-label">Unit of Measurement</label>
                <input type="text" class="form-control" id="addUnitOfMeasurement" name="unit_of_measurement" required>
              </div>
              <div class="mb-3">
                <label for="addReorderLevel" class="form-label">Reorder Level</label>
                <input type="number" class="form-control" id="addReorderLevel" name="reorder_level" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="addSupplier" class="form-label">Supplier</label>
                <input type="text" class="form-control" id="addSupplier" name="supplier_id">
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
                <input type="date" class="form-control" id="addDate" name="date_added">
              </div>
            </div>
          </div>
          <button type="submit" name="add_invetory_btn" class="btn btn-primary">Submit</button>
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
          <input type="hidden" id="editItemId" name="id">
          <div class="row">
            <div class="col-md-4">
              <div class="mb-3">
                <label for="editItemName" class="form-label">Item Name</label>
                <input type="text" class="form-control" id="editItemName" name="product_name" required>
              </div>
              <div class="mb-3">
                <label for="editCategory" class="form-label">Category</label>
                <input type="text" class="form-control" id="editCategory" name="category" required>
              </div>
              <div class="mb-3">
                <label for="editDescription" class="form-label">Description</label>
                <textarea class="form-control" id="editDescription" name="description"></textarea>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="editQuantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="editQuantity" name="quantity" required>
              </div>
              <div class="mb-3">
                <label for="editUnitOfMeasurement" class="form-label">Unit of Measurement</label>
                <input type="text" class="form-control" id="editUnitOfMeasurement" name="unit_of_measurement" required>
              </div>
              <div class="mb-3">
                <label for="editReorderLevel" class="form-label">Reorder Level</label>
                <input type="number" class="form-control" id="editReorderLevel" name="reorder_level" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="editSupplier" class="form-label">Supplier</label>
                <input type="text" class="form-control" id="editSupplier" name="supplier_id">
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
