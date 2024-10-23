<?php
// Include header and navigation
include 'header.php';


// Handle update request
if (isset($_POST['update_expense_btn'])) {
    $id = $_POST['id'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $remarks = $_POST['remarks'];

    $stmt = $dbh->prepare("UPDATE expenses SET date = :date, description = :description, amount = :amount, category = :category, remarks = :remarks WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':remarks', $remarks);
    
    if ($stmt->execute()) {
        header("Location: expense.php?status=success&message=Expense updated successfully");
        exit;
    } else {
        header("Location: expense.php?status=error&message=Error updating expense");
        exit;
    }
}

// Fetch all expenses at once
$expenses = $dbh->query("SELECT * FROM expenses")->fetchAll(PDO::FETCH_OBJ);
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
                        </div>
                        <!-- Expenses table -->
                        <div class="card-body">
                            <div class="card-header">
                                <!-- Button to trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" style="background-color: #0b603a; border-color: #0b603a;">
                                    Add Expense
                                </button>
                            </div>
                            <!-- /.card-header -->

                            <table id="example1" class="table table-bordered table-hover">
                            <thead style="background-color: #0b603a; color: white;">
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
                                    <?php foreach ($expenses as $count => $row): ?>
                                        <tr>
                                            <td><?= $count + 1; ?></td>
                                            <td><?= htmlspecialchars($row->date); ?></td>
                                            <td><?= htmlspecialchars($row->description); ?></td>
                                            <td><?= htmlspecialchars($row->amount); ?></td>
                                            <td><?= htmlspecialchars($row->category); ?></td>
                                            <td><?= htmlspecialchars($row->remarks); ?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editExpense<?= $row->id ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <div class="modal fade" id="editExpense<?=$row->id?>" tabindex="-1" aria-labelledby="editExpenseModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header"  style="background-color: #0b603a; color:white; border-color: #0b603a;">
                                                                <h5 class="modal-title" id="editExpenseModalLabel">Edit Expense</h5>
                                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                    &times;
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" action="">
                                                                    <input type="hidden" id="editExpenseId" name="id" value="<?= $row->id?>">
                                                                    <div class="mb-3">
                                                                        <label for="editExpenseDate" class="form-label">Date</label>
                                                                        <input type="date" class="form-control" id="editExpenseDate" name="date" required value="<?= $row->date ?>">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="editExpenseDescription" class="form-label">Description</label>
                                                                        <input type="text" class="form-control" id="editExpenseDescription" name="description" required value="<?=$row->description ?>">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="editExpenseAmount" class="form-label">Amount</label>
                                                                        <input type="number" class="form-control" id="editExpenseAmount" name="amount" step="0.01" required value="<?= $row->amount; ?>">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="editExpenseCategory" class="form-label">Category</label>
                                                                        <input type="text" class="form-control" id="editExpenseCategory" name="category" required value="<?= $row->category ?>">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="editExpenseRemarks" class="form-label">Remarks</label>
                                                                        <textarea class="form-control" id="editExpenseRemarks" name="remarks"><?= $row->remarks?></textarea>
                                                                    </div>
                                                                    <button type="submit" name="update_expense_btn" class="btn btn-primary"  style="background-color: #0b603a; border-color: #0b603a;">Update Expense</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="delete_expense.php?id=<?= $row->id ?>" class="btn btn-danger btn-sm deleteBtn">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <button type="button" class="btn btn-info btn-sm text-white" data-toggle="modal" data-target="#viewProduct<?= $row->id ?>">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div><!-- /.row -->
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

<script>
    // JavaScript for populating edit modal
    $('#editExpenseModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var date = button.data('date');
        var description = button.data('description');
        var amount = button.data('amount');
        var category = button.data('category');
        var remarks = button.data('remarks');

        var modal = $(this);
        modal.find('#editExpenseId').val(id);
        modal.find('#editExpenseDate').val(date);
        modal.find('#editExpenseDescription').val(description);
        modal.find('#editExpenseAmount').val(amount);
        modal.find('#editExpenseCategory').val(category);
        modal.find('#editExpenseRemarks').val(remarks);
    });
</script>

<?php include 'footer.php'; ?>
