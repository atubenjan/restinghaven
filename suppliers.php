<?php include 'header.php'; // Include header and navigation ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Suppliers</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Suppliers</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Suppliers table -->
      <div class="card">
        <div class="card-header">
          <!-- Button to trigger modal -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
            Add Supplier
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Supplier ID</th>
                <th>Supplier Name</th>
                <th>Contact Person</th>
                <th>Contact Email</th>
                <th>Contact Phone</th>
                <th>Address</th>
                <th>Status</th>
                <th>Date Added</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td colspan="8">No data available</td> <!-- Empty data except for Actions -->
                <td>
                  <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editSupplierModal">Edit</button>
                  <a href="delete_supplier.html" class="btn btn-danger btn-sm">Delete</a>
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

<!-- Add Supplier Modal with Two Columns -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSupplierModalLabel">Add New Supplier</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addSupplierForm">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="addSupplierId" class="form-label">Supplier ID</label>
                <input type="text" class="form-control" id="addSupplierId" name="supplier_id" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="addSupplierName" class="form-label">Supplier Name</label>
                <input type="text" class="form-control" id="addSupplierName" name="supplier_name" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="addContactPerson" class="form-label">Contact Person</label>
                <input type="text" class="form-control" id="addContactPerson" name="contact_person" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="addContactEmail" class="form-label">Contact Email</label>
                <input type="email" class="form-control" id="addContactEmail" name="contact_email">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="addContactPhone" class="form-label">Contact Phone</label>
                <input type="tel" class="form-control" id="addContactPhone" name="contact_phone">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="addAddress" class="form-label">Address</label>
                <textarea class="form-control" id="addAddress" name="address"></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="addStatus" class="form-label">Status</label>
                <input type="text" class="form-control" id="addStatus" name="status">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="addDateAdded" class="form-label">Date Added</label>
                <input type="date" class="form-control" id="addDateAdded" name="date_added" required>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Supplier Modal with Two Columns -->
<div class="modal fade" id="editSupplierModal" tabindex="-1" aria-labelledby="editSupplierModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editSupplierModalLabel">Edit Supplier</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editSupplierForm">
          <input type="hidden" id="editSupplierId" name="supplier_id">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="editSupplierName" class="form-label">Supplier Name</label>
                <input type="text" class="form-control" id="editSupplierName" name="supplier_name" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="editContactPerson" class="form-label">Contact Person</label>
                <input type="text" class="form-control" id="editContactPerson" name="contact_person" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="editContactEmail" class="form-label">Contact Email</label>
                <input type="email" class="form-control" id="editContactEmail" name="contact_email">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="editContactPhone" class="form-label">Contact Phone</label>
                <input type="tel" class="form-control" id="editContactPhone" name="contact_phone">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="editAddress" class="form-label">Address</label>
                <textarea class="form-control" id="editAddress" name="address"></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="editStatus" class="form-label">Status</label>
                <input type="text" class="form-control" id="editStatus" name="status">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="editDateAdded" class="form-label">Date Added</label>
                <input type="date" class="form-control" id="editDateAdded" name="date_added" disabled> <!-- Disabled date field for editing -->
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; // Include footer ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // JavaScript to populate the edit modal with the correct data
  function populateEditModal(id, name, contactPerson, email, phone, address, status, dateAdded) {
    document.getElementById('editSupplierId').value = id;
    document.getElementById('editSupplierName').value = name;
    document.getElementById('editContactPerson').value = contactPerson;
    document.getElementById('editContactEmail').value = email;
    document.getElementById('editContactPhone').value = phone;
    document.getElementById('editAddress').value = address;
    document.getElementById('editStatus').value = status;
    document.getElementById('editDateAdded').value = dateAdded;
  }
</script>