<?php
include 'header.php'; // Include header and navigation

// Handle deletion of supplier
if (isset($_GET['deleteSupplier'])) {
    $id = $_GET['deleteSupplier'];
    $stmt = $dbh->prepare("DELETE FROM suppliers WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        // Redirect back to the burial records page
        header("Location: suppliers.php?status=success&message=supplier record deleted successfully");
        exit;
    } else {
        // Redirect back with error message
        header("Location: suppliers.php?status=error&message=Error deleting supplier's record");
        exit;
    }
}

// Handle updating supplier
if (isset($_POST['update_supplier_btn'])) {
    $id = $_POST['supplier_id'];
    $supplier_name = $_POST['supplier_name'];
    $contact_person = $_POST['contact_person'];
    $contact_email = $_POST['contact_email'];
    $contact_phone = $_POST['contact_phone'];
    $address = $_POST['address'];
    $status = $_POST['status'];
    $date_added = $_POST['date_added'];

    $stmt = $dbh->prepare("UPDATE suppliers SET supplier_name = :supplier_name, contact_person = :contact_person, contact_email = :contact_email, contact_phone = :contact_phone, address = :address, status = :status, date_added = :date_added WHERE id = :id");
    $stmt->bindParam(':supplier_name', $supplier_name);
    $stmt->bindParam(':contact_person', $contact_person);
    $stmt->bindParam(':contact_email', $contact_email);
    $stmt->bindParam(':contact_phone', $contact_phone);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':date_added', $date_added);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirect back to the burial records page
        header("Location: suppliers.php?status=success&message=supplier record updated successfully");
        exit;
    } else {
        // Redirect back with error message
        header("Location: suppliers.php?status=error&message=Error updating supplier's record");
        exit;
    }
}
?>

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
            <!-- Action Buttons -->

            <!-- Search and Filter -->
            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control form-control-sm mb-2" placeholder="Search suppliers..." style="max-width: 300px;">
                <select id="statusFilter" class="form-control form-control-sm mb-2" style="max-width: 150px;">
                    <option value="">All Statuses</option>
                    <option value="Active">Active</option>
                    <option value="Non-active">Non-active</option>
                </select>
            </div>

            <!-- Suppliers table -->
            <div class="card">
                <div class="card-header">
                    <!-- Button to trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" style="background-color: #0b603a; border-color: #0b603a;">
                        <i class="fas fa-truck"></i> Add Supplier
                    </button>
                    
                
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead style="background-color: #0b603a; color: white;">
                            <tr>
                                <th>ID</th>
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
                        <tbody id="supplierTableBody">
                            <?php
                            // Fetch and display suppliers
                            $stmt = $dbh->query("SELECT * FROM suppliers");
                            $count = 1;
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <tr>
                                    <td><?=$count; ?></td>
                                    <td><?= htmlspecialchars($row['supplier_name']); ?></td>
                                    <td><?= htmlspecialchars($row['contact_person']); ?></td>
                                    <td><?= htmlspecialchars($row['contact_email']); ?></td>
                                    <td><?= htmlspecialchars($row['contact_phone']); ?></td>
                                    <td><?= htmlspecialchars($row['address']); ?></td>
                                    <td><?= htmlspecialchars($row['status']); ?></td>
                                    <td><?= htmlspecialchars($row['date_added']); ?></td>
                                    <td>
                                        <!-- edit supplier btn -->
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editSupplier<?= $row['id'];?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <!-- Edit Supplier Modal -->
                                        <div class="modal fade" id="editSupplier<?= $row['id'];?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editSupplierLabel">Edit Supplier</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="editSupplierForm" action="" method="post"> <!-- Add action for updating supplier -->
                                                            <input type="hidden" name="supplier_id" value="<?= $row['id'];?>" id="supplier_id">
                                                            <div class="mb-3">
                                                                <label for="supplier_name" class="form-label">Supplier Name</label>
                                                                <input type="text" class="form-control" value="<?= $row['supplier_name'];?>" name="supplier_name" id="supplier_name" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="contact_person" class="form-label">Contact Person</label>
                                                                <input type="text" class="form-control" value="<?= $row['contact_person'];?>" name="contact_person" id="contact_person" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="contact_email" class="form-label">Contact Email</label>
                                                                <input type="email" class="form-control" value="<?= $row['contact_email'];?>" name="contact_email" id="contact_email">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="contact_phone" class="form-label">Contact Phone</label>
                                                                <input type="tel" class="form-control" value="<?= $row['contact_phone'];?>" name="contact_phone" id="contact_phone">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="address" class="form-label">Address</label>
                                                                <textarea class="form-control" name="address" id="address"><?= $row['address'];?></textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="status" class="form-label">Status</label>
                                                                <select name="status" id="status" class="form-control">
                                                                    <option value="Active" <?= $row['status'] == 'Active' ? 'selected' : '';?>>Active</option>
                                                                    <option value="Not Active" <?= $row['status'] == 'Not Active' ? 'selected' : '';?>>Not Active</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="date_added" class="form-label">Date Added</label>
                                                                <input type="date" class="form-control" value="<?= $row['date_added'];?>" name="date_added" id="date_added" required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary" name="update_supplier_btn">Update Supplier</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- delete supplier btn-->
                                        <a href="?deleteSupplier=<?= htmlspecialchars($row['id']); ?>" class="btn btn-info btn-sm btn-danger deleteBtn"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php $count++; } ?>
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

<!-- Add Supplier Modal -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Supplier</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addSupplierForm" action="" method="post"> <!-- Adjust the action as needed -->
                    <div class="row">
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
                                <select id="addStatus" name="status" class="form-control">
                                    <option value="Active">Active</option>
                                    <option value="Not Active">Not Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="addDateAdded" class="form-label">Date Added</label>
                                <input type="date" class="form-control" id="addDateAdded" name="date_added" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm" name="add_supplier_btn">Add Supplier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
function populateEditModal(id, name, contactPerson, contactEmail, contactPhone, address, status, dateAdded) {
    document.getElementById('supplier_id').value = id;
    document.getElementById('supplier_name').value = name;
    document.getElementById('contact_person').value = contactPerson;
    document.getElementById('contact_email').value = contactEmail;
    document.getElementById('contact_phone').value = contactPhone;
    document.getElementById('address').value = address;
    document.getElementById('status').value = status;
    document.getElementById('date_added').value = dateAdded;
}

// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#supplierTableBody tr');
    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        let match = false;
        cells.forEach(cell => {
            if (cell.textContent.toLowerCase().includes(filter)) {
                match = true;
            }
        });
        row.style.display = match ? '' : 'none';
    });
});

// Status filter functionality
document.getElementById('statusFilter').addEventListener('change', function() {
    const filter = this.value;
    const rows = document.querySelectorAll('#supplierTableBody tr');
    rows.forEach(row => {
        const statusCell = row.cells[6].textContent; // Adjust index based on your table structure
        if (filter === '' || statusCell === filter) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>

<?php
include 'footer.php'; // Include footer
?>
