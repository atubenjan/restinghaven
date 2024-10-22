<?php include 'header.php'; // Include header and navigation ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Customer Management</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Customer Management</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Customer table -->
      <div class="card">
        <div class="card-header">
          <!-- Button to trigger the Add Customer modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" style="background-color: #0b603a; border-color: #0b603a;">
            Add Customer
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
          <thead style="background-color: #0b603a; color: white;">
              <tr>
                <th>Customer ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Remarks/Notes</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- Example Row -->
              <?php 
              $stmt = $dbh->query("SELECT * FROM customers");
              $count = 1;
              while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
              ?>
              <tr>
                <td><?= $count; ?></td>
                <td><?= $row->name; ?></td>
                <td><?= $row->email; ?></td>
                <td><?= $row->phone; ?></td>
                <td><?= $row->remarks; ?></td>
                <td>
                <!--   <button class="btn btn-info btn-sm text-white data-bs-toggle="modal" data-bs-target="#editCustomerModal" onclick="populateEditModal(1, 'John Doe', 'john@example.com', '123-456-7890', 'Some remarks')"><i class="fas fa-edit"></button> -->
                <a href="delete_customer.php?id=<?= $row->id; ?>" 
   class="btn btn-info btn-sm btn-danger" 
   onclick="return confirm('Are you sure you want to delete this customer?');">
   <i class="fas fa-trash"></i>
</a>


                </td>
              </tr>
              <?php $count++; }?>
              <!-- Add more rows as needed -->
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
<!-- Add Customer Modal -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCustomerModalLabel">Add New Customer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
          <div class="mb-3">
            <label for="addCustomerName" class="form-label">Name</label>
            <input type="text" class="form-control" id="addCustomerName" name="name" required>
          </div>
          <div class="mb-3">
            <label for="addCustomerEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="addCustomerEmail" name="email" required>
          </div>
          <div class="mb-3">
            <label for="addCustomerPhone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="addCustomerPhone" name="phone" required>
          </div>
          <div class="mb-3">
            <label for="addCustomerRemarks" class="form-label">Remarks/Notes</label>
            <textarea class="form-control" id="addCustomerRemarks" name="remarks" rows="3"></textarea>
          </div>
          <button type="submit" name="add_customer_btn" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Edit Customer Modal -->
<div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCustomerModalLabel">Edit Customer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editCustomerForm">
          <input type="hidden" id="editCustomerId" name="id">
          <div class="mb-3">
            <label for="editCustomerName" class="form-label">Name</label>
            <input type="text" class="form-control" id="editCustomerName" name="name" required>
          </div>
          <div class="mb-3">
            <label for="editCustomerEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="editCustomerEmail" name="email" required>
          </div>
          <div class="mb-3">
            <label for="editCustomerPhone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="editCustomerPhone" name="phone" required>
          </div>
          <div class="mb-3">
            <label for="editCustomerRemarks" class="form-label">Remarks/Notes</label>
            <textarea class="form-control" id="editCustomerRemarks" name="remarks" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; // Include footer ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // JavaScript to populate edit modal with customer data
  function populateEditModal(id, name, email, phone, remarks) {
    document.getElementById('editCustomerId').value = id;
    document.getElementById('editCustomerName').value = name;
    document.getElementById('editCustomerEmail').value = email;
    document.getElementById('editCustomerPhone').value = phone;
    document.getElementById('editCustomerRemarks').value = remarks; // Set the remarks field
  }
  
  // Handle form submissions (optional)
  document.getElementById('addCustomerForm').addEventListener('submit', function(event) {
    event.preventDefault();
    // Handle add customer form submission
    alert('Add Customer Form submitted');
  });

  document.getElementById('editCustomerForm').addEventListener('submit', function(event) {
    event.preventDefault();
    // Handle edit customer form submission
    alert('Edit Customer Form submitted');
  });
</script>
