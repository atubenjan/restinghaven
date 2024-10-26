<?php
include 'header.php';

if(isset($_POST['edit_sales_btn'])){
  $id = $_POST['id'];
  $product_name = $_POST['product_name'];
  $quantity = $_POST['quantity'];
  $price = $_POST['price'];
  $date = $_POST['date']; // Added date input field

  // Prepare SQL update statement
  $stmt = $dbh->prepare("UPDATE sales SET product_name =?, quantity =?, price =?, date =? WHERE id =?");

  // Bind parameters
  $stmt->bindParam(1, $product_name);
  $stmt->bindParam(2, $quantity);
  $stmt->bindParam(3, $price);
  $stmt->bindParam(4, $date); // Added date binding
  $stmt->bindParam(5, $id);

  // Execute the query
  if ($stmt->execute()) {
    header("Location: sales.php?status=success&message=sales updated successfully");
    exit;
} else {
    header("Location: sales.php?status=error&message=Error updating sales");
    exit;
}
}
   // Fetch customer data from the database using PDO
   $customerStmt = $dbh->query("SELECT  name FROM customers");
   $customers = $customerStmt->fetchAll(PDO::FETCH_ASSOC); // Fetch as associative array

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container mt-4">
    <h1>Sales Management</h1>

    <!-- Display sales records -->
    <div class="card">
      <div class="card-header">Sales Records</div>
      <div class="card-body">
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#salesModal">Add New Sale</button>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
            <th>ID</th>
      <th>Customer Name</th> <!-- Added Customer Name -->
      <th>Item/Service Sold</th> <!-- From the Item Sold field -->
      <th>Quantity</th>
      <th>Unit Price</th> <!-- Changed from Price to Unit Price for clarity -->
      <th>Total Price</th> <!-- Added Total Price Column -->
      <th>Date of Sale</th> <!-- Changed to match the Sale Date field -->
      <th>Description</th> <!-- Added Description Column -->
      <th>Payment Method</th> <!-- Added Payment Method Column -->
      <th>Payment Status</th> <!-- Added Payment Status Column -->
      <th>Actions</th>
            </tr>
          </thead>
          <tbody id="sales-table-body">
            <!-- Example rows, replace with dynamic data -->
             <?php 
             $stmt = $dbh->prepare("SELECT * FROM sales");
             $stmt->execute();
             $count = 1;
             while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
             ?>
            <tr>
            <td><?= $count; ?></td>
    <td><?= htmlspecialchars($row->customer_name); ?></td>
    <td><?= htmlspecialchars($row->item_sold); ?></td>
    <td><?= htmlspecialchars($row->quantity); ?></td>
    <td><?= htmlspecialchars(number_format($row->unit_price, 2)); ?></td>
    <td><?= htmlspecialchars(number_format($row->total_price, 2)); ?>UGX</td>
    <td><?= htmlspecialchars($row->sale_date); ?></td>
    <td><?= htmlspecialchars($row->description); ?></td>
    <td><?= htmlspecialchars($row->payment_method); ?></td>
    <td><?= htmlspecialchars($row->payment_status); ?></td>
              <td>
                <button class="btn btn-warning btn-sm edit-btn" data-toggle="modal" data-target="#editSalesModal<?= $row->id?>">Edit</button>

                <!-- Modal for adding sales-->
               
                <a href="delete_sales.php?id=<?= $row->id?>" class="btn btn-danger btn-sm deleteBtn" data-id="1">Delete</a>
              </td>
            </tr>
            <?php $count++; }?>
            <!-- End of example rows -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- /.content-wrapper -->

<!-- Modal for adding sales-->
<div class="modal fade" id="salesModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="salesModalLabel">Add Sales</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body">
        <form method="POST">
          <input type="hidden" name="id" id="sales-id">

          <!-- Customer Information -->
          <h6>Customer Information</h6>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="customer-name" class="form-label">Customer Name</label>
              <select class="form-select" id="customer-name" name="customer_name" required>
                <option value="">Select Customer</option>
                <?php
                // Assuming $customers array is available from previous code
                foreach ($customers as $customer) {
                    echo '<option value="' . htmlspecialchars($customer['name']) . '">' . htmlspecialchars($customer['name']) . '</option>';
                }
                ?>
              </select>
            </div>
          </div>

          <!-- Sale Details -->
          <h6>Sale Details</h6>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="sale-date" class="form-label">Date of Sale</label>
              <input type="date" class="form-control" id="sale-date" name="sale_date" required>
            </div>
            <div class="col-md-6">
              <label for="item-sold" class="form-label">Item/Service Sold</label>
              <select class="form-select" id="item-sold" name="item_sold" required>
                <option value="burial_plot">Burial Plot</option>
                <option value="mausoleum_space">Mausoleum Space</option>
                <option value="memorial_product">Memorial Product</option>
                <option value="funeral_service">Funeral Service</option>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="plot-number" class="form-label">Plot Number</label>
              <input type="text" class="form-control" id="plot-number" name="plot_number">
            </div>
            <div class="col-md-6">
              <label for="unit-price" class="form-label">Unit Price</label>
              <input type="number" step="0.01" class="form-control" id="unit-price" name="unit_price" required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="quantity" class="form-label">Quantity</label>
              <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>
            <div class="col-md-6">
              <label for="total-price" class="form-label">Total Price</label>
              <input type="number" step="0.01" class="form-control" id="total-price" name="total_price" readonly required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="payment-method" class="form-label">Payment Method</label>
              <select class="form-select" id="payment-method" name="payment_method" required>
                <option value="cash">Cash</option>
                <option value="credit_card">Credit Card</option>
                <option value="bank_transfer">Bank Transfer</option>
                <option value="installment">Installment Plan</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="payment-status" class="form-label">Payment Status</label>
              <select class="form-select" id="payment-status" name="payment_status" required>
                <option value="paid">Paid</option>
                <option value="pending">Pending</option>
                <option value="partially_paid">Partially Paid</option>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="col-md-6">
              <label for="notes" class="form-label">Special Requests or Instructions</label>
              <textarea class="form-control" id="notes" name="notes"></textarea>
            </div>
          </div>

          <button type="submit" name="add_sales_btn" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>







<?php include 'footer.php'; ?>


<script>
  // JavaScript to calculate the Total Price automatically
  document.addEventListener('DOMContentLoaded', function () {
    const unitPriceInput = document.getElementById('unit-price');
    const quantityInput = document.getElementById('quantity');
    const totalPriceInput = document.getElementById('total-price');

    function calculateTotalPrice() {
      const unitPrice = parseFloat(unitPriceInput.value) || 0;
      const quantity = parseInt(quantityInput.value) || 0;
      const totalPrice = (unitPrice * quantity).toFixed(2); // Calculate and fix to two decimals
      totalPriceInput.value = totalPrice; // Set the value in the total price input
    }

    // Add event listeners to calculate total price on input change
    unitPriceInput.addEventListener('input', calculateTotalPrice);
    quantityInput.addEventListener('input', calculateTotalPrice);
  });
</script>
