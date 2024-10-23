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
              <th>Product Name</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Date</th> <!-- Added Date Column -->
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
              <td><?= $row->product_name; ?></td>
              <td><?= $row->quantity; ?></td>
              <td><?= $row->price; ?></td>
              <td><?= $row->date; ?></td> <!-- Example date -->
              <td>
                <button class="btn btn-warning btn-sm edit-btn" data-toggle="modal" data-target="#editSalesModal<?= $row->id?>">Edit</button>

                <!-- Modal for adding sales-->
                <div class="modal fade" id="editSalesModal<?= $row->id?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="salesModalLabel">Edit Sales</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                      </div>
                      <div class="modal-body">
                        <form method="POST">
                          <input type="hidden" name="id" value="<?= $row->id?>" id="sales-id">
                          <div class="mb-3">
                            <label for="product-name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="product-name" value = "<?= $row->product_name?>" name="product_name" required>
                          </div>
                          <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" value = "<?= $row->quantity?>" name="quantity" required>
                          </div>
                          <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" id="price" value = "<?= $row->price?>" name="price" required>
                          </div>
                          <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" value = "<?= $row->date?>" name="date" required>
                          </div>
                          <button type="submit" name="edit_sales_btn" class="btn btn-primary">Save</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
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
          <div class="mb-3">
            <label for="product-name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="product-name" name="product_name" required>
          </div>
          <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
          </div>
          <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
          </div>
          <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
          </div>
          <button type="submit" name="add_sales_btn" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

<!-- Include Bootstrap JavaScript Bundle -->
<!-- Bootstrap JavaScript Bundle -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript for handling form and table actions -->
<script>
  // document.addEventListener('DOMContentLoaded', function() {
  //   // Handle form submission
  //   document.getElementById('sales-form').addEventListener('submit', function(event) {
  //     event.preventDefault();
  //     // Add your form submission logic here
  //     alert('Form submitted!');
  //     // Close the modal after submission
  //     var modal = bootstrap.Modal.getInstance(document.getElementById('salesModal'));
  //     modal.hide();
  //   });

  //   // Handle edit button clicks
  //   document.querySelectorAll('.edit-btn').forEach(btn => {
  //     btn.addEventListener('click', function() {
  //       document.getElementById('sales-id').value = this.getAttribute('data-id');
  //       document.getElementById('product-name').value = this.getAttribute('data-name');
  //       document.getElementById('quantity').value = this.getAttribute('data-quantity');
  //       document.getElementById('price').value = this.getAttribute('data-price');
  //       document.getElementById('date').value = this.getAttribute('data-date'); // Set date field
  //       // Set the modal title to 'Edit Sale'
  //       document.getElementById('salesModalLabel').innerText = 'Edit Sale';
  //     });
  //   });

  //   // Handle delete button clicks
  //   document.querySelectorAll('.delete-btn').forEach(btn => {
  //     btn.addEventListener('click', function() {
  //       if (confirm('Are you sure you want to delete this record?')) {
  //         const id = this.getAttribute('data-id');
  //         // Add your deletion logic here
  //         alert('Record with ID ' + id + ' deleted!');
  //       }
  //     });
  //   });
  // });
</script>
