<?php
  include 'header.php'; // Include header and navigation
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Expenses</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Expenses</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Expenses table -->
      <div class="card">
        <div class="card-header">
          <!-- Button to trigger modal -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addExpenseModal">
            Add Expense
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="expensesTable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Category</th>
                <th>Remarks</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- Example Row -->
              <tr>
                <td>1</td>
                <td>2024-09-01</td>
                <td>Office Supplies</td>
                <td>$150.00</td>
                <td>Office</td>
                <td>Purchased pens and notebooks</td>
                <td>
                  <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editExpenseModal" onclick="populateEditModal(1, '2024-09-01', 'Office Supplies', 150.00, 'Office', 'Purchased pens and notebooks')">Edit</button>
                  <a href="delete_expense.html" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                </td>
              </tr>
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

<!-- Add Expense Modal -->
<div class="modal fade" id="addExpenseModal" tabindex="-1" aria-labelledby="addExpenseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addExpenseModalLabel">Add New Expense</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addExpenseForm">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="addDate" class="form-label">Date</label>
              <input type="date" class="form-control" id="addDate" name="date" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="addDescription" class="form-label">Description</label>
              <input type="text" class="form-control" id="addDescription" name="description" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="addAmount" class="form-label">Amount</label>
              <input type="number" class="form-control" id="addAmount" name="amount" step="0.01" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="addCategory" class="form-label">Category</label>
              <input type="text" class="form-control" id="addCategory" name="category">
            </div>
            <div class="col-md-12 mb-3">
              <label for="addRemarks" class="form-label">Remarks</label>
              <textarea class="form-control" id="addRemarks" name="remarks"></textarea>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Expense Modal -->
<div class="modal fade" id="editExpenseModal" tabindex="-1" aria-labelledby="editExpenseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editExpenseModalLabel">Edit Expense Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editExpenseForm">
          <input type="hidden" id="editExpenseId" name="id">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="editDate" class="form-label">Date</label>
              <input type="date" class="form-control" id="editDate" name="date" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="editDescription" class="form-label">Description</label>
              <input type="text" class="form-control" id="editDescription" name="description" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="editAmount" class="form-label">Amount</label>
              <input type="number" class="form-control" id="editAmount" name="amount" step="0.01" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="editCategory" class="form-label">Category</label>
              <input type="text" class="form-control" id="editCategory" name="category">
            </div>
            <div class="col-md-12 mb-3">
              <label for="editRemarks" class="form-label">Remarks</label>
              <textarea class="form-control" id="editRemarks" name="remarks"></textarea>
            </div>
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
  // JavaScript to populate edit modal with expense record data
  function populateEditModal(id, date, description, amount, category, remarks) {
    document.getElementById('editExpenseId').value = id;
    document.getElementById('editDate').value = date;
    document.getElementById('editDescription').value = description;
    document.getElementById('editAmount').value = amount;
    document.getElementById('editCategory').value = category;
    document.getElementById('editRemarks').value = remarks;
  }

  // Handle form submissions (optional)
  document.getElementById('addExpenseForm').addEventListener('submit', function(event) {
    event.preventDefault();
    // Handle add expense record form submission
    alert('Add Expense Form submitted');
  });

  document.getElementById('editExpenseForm').addEventListener('submit', function(event) {
    event.preventDefault();
    // Handle edit expense record form submission
    alert('Edit Expense Form submitted');
  });
</script>
