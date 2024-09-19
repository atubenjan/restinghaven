<?php
// Include header and navigation
include 'header.php';
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
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Expenses</h3>
              <div class="card-tools">
               
              </div>
            </div>
      <!-- Expenses table -->
      <div class="card-body">
      <div class="card-header">
          <!-- Button to trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            Add Expense
          </button>
        </div>
        <!-- /.card-header -->
     
      

        <table id="example2" class="table table-bordered table-hover">
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
            <?php
                  $expenses = $dbh->query("SELECT * FROM expenses");
                  $count = 1;
                  while ($row = $expenses->fetch(PDO::FETCH_OBJ)) {
                  ?>
                <tr>
                <td><?= $count; ?></td>
                      <th><?= $row->date ?></td>
                      <td><?= $row->description ?></td>                  
                      <td><?= $row->amount ?></td>
                      <td><?= $row->category ?></td>
                      <td><?= $row->remarks ?></td>
                      <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editProduct<?= $row->id ?>">
                          <i class="fas fa-edit"></i>
                        </button>
                        <a href="?deleteProduct=<?= $row->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?')">
                          <i class="fas fa-trash"></i>
                        </a>
                        <button type="button" class="btn btn-info btn-sm text-white" data-toggle="modal" data-target="#viewProduct<?= $row->id ?>">
                          <i class="fas fa-eye"></i>
                        </button>
                      </td>
                </tr>
                <?php
                 
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

<!-- Add Expense Modal -->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addExpenseModalLabel">Add Expense</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addExpenseForm" method="post" action="">
          <div class="mb-3">
            <label for="expenseDate" class="form-label">Date</label>
            <input type="date" class="form-control" id="expenseDate" name="date" required>
          </div>
          <div class="mb-3">
            <label for="expenseDescription" class="form-label">Description</label>
            <input type="text" class="form-control" id="expenseDescription" name="description" required>
          </div>
          <div class="mb-3">
            <label for="expenseAmount" class="form-label">Amount</label>
            <input type="number" class="form-control" id="expenseAmount" name="amount" step="0.01" required>
          </div>
          <div class="mb-3">
            <label for="expenseCategory" class="form-label">Category</label>
            <input type="text" class="form-control" id="expenseCategory" name="category" required>
          </div>
          <div class="mb-3">
            <label for="expenseRemarks" class="form-label">Remarks</label>
            <textarea class="form-control" id="expenseRemarks" name="remarks"></textarea>
          </div>
          <button type="submit" name="add_expense_btn" class="btn btn-primary">Add Expense</button>
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
        <h5 class="modal-title" id="editExpenseModalLabel">Edit Expense</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editExpenseForm" method="post" action="edit_expense.php">
          <input type="hidden" id="editExpenseId" name="id">
          <div class="mb-3">
            <label for="editExpenseDate" class="form-label">Date</label>
            <input type="date" class="form-control" id="editExpenseDate" name="date" required>
          </div>
          <div class="mb-3">
            <label for="editExpenseDescription" class="form-label">Description</label>
            <input type="text" class="form-control" id="editExpenseDescription" name="description" required>
          </div>
          <div class="mb-3">
            <label for="editExpenseAmount" class="form-label">Amount</label>
            <input type="number" class="form-control" id="editExpenseAmount" name="amount" step="0.01" required>
          </div>
          <div class="mb-3">
            <label for="editExpenseCategory" class="form-label">Category</label>
            <input type="text" class="form-control" id="editExpenseCategory" name="category" required>
          </div>
          <div class="mb-3">
            <label for="editExpenseRemarks" class="form-label">Remarks</label>
            <textarea class="form-control" id="editExpenseRemarks" name="remarks"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Update Expense</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; // Include footer ?>
