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
      <!-- Action Buttons -->
      <div class="mb-3">
        <button id="printBtn" class="btn btn-info">Print</button>
        <button id="pdfBtn" class="btn btn-danger">Download PDF</button>
        <button id="excelBtn" class="btn btn-success">Download Excel</button>
        <!-- Add additional margin if needed -->
      </div>

      <!-- Search and Filter -->
      <div class="mb-3">
        <input type="text" id="searchInput" class="form-control mb-2" placeholder="Search suppliers...">
        <select id="statusFilter" class="form-control mb-2">
          <option value="">All Statuses</option>
          <option value="Active">Active</option>
          <option value="Non-active">Non-active</option>
        </select>
      </div>

      <!-- Suppliers table -->
      <div class="card">
        <div class="card-header">
          <!-- Button to trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            <i class="fas fa-plus"></i> Supplier
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
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
              <!-- PHP code to fetch and display suppliers -->
              <?php
              $stmt = $dbh->query("SELECT * FROM suppliers");
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              ?>
                <tr>
                  <td><?= htmlspecialchars($row['id']); ?></td>
                  <td><?= htmlspecialchars($row['supplier_name']); ?></td>
                  <td><?= htmlspecialchars($row['contact_person']); ?></td>
                  <td><?= htmlspecialchars($row['contact_email']); ?></td>
                  <td><?= htmlspecialchars($row['contact_phone']); ?></td>
                  <td><?= htmlspecialchars($row['address']); ?></td>
                  <td><?= htmlspecialchars($row['status']); ?></td>
                  <td><?= htmlspecialchars($row['date_added']); ?></td>
                  <td>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editSupplier"
                      onclick="populateEditModal('<?= htmlspecialchars($row['id']); ?>', '<?= htmlspecialchars($row['supplier_name']); ?>', '<?= htmlspecialchars($row['contact_person']); ?>', '<?= htmlspecialchars($row['contact_email']); ?>', '<?= htmlspecialchars($row['contact_phone']); ?>', '<?= htmlspecialchars($row['address']); ?>', '<?= htmlspecialchars($row['status']); ?>', '<?= htmlspecialchars($row['date_added']); ?>')">
                      Edit
                    </button>
                    <a href="delete_supplier.php?id=<?= htmlspecialchars($row['id']); ?>" class="btn btn-danger btn-sm">Delete</a>
                  </td>
                </tr>
              <?php   
           

             
            
            
            } ?>
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
<?php if (isset($_REQUEST['deleteProduct'])) {
  $id = $_GET['deleteProduct'];
  $sql = $dbh->query("DELETE FROM supplier WHERE id = '$id' ");
  if ($sql) {
    echo "
          <script>
            window.location.href = 'products';
          </script>
        ";
  }
}
?>
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
        <form id="addSupplierForm" action="" method="post">
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
                  <option value="Non-active">Non-active</option>
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
          <button type="submit" name="add_supplier_btn" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>



<!-- JavaScript to handle search, filter, and export functionalities -->
<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspdf@2.4.0/dist/jspdf.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search and Filter functionality
    document.getElementById('searchInput').addEventListener('input', filterTable);
    document.getElementById('statusFilter').addEventListener('change', filterTable);

    function filterTable() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const statusFilter = document.getElementById('statusFilter').value;
        const rows = document.querySelectorAll('#supplierTableBody tr');

        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            const statusCell = row.cells[6].textContent.trim();
            const matchesSearch = Array.from(cells).some(cell => cell.textContent.toLowerCase().includes(searchTerm));
            const matchesStatus = statusFilter ? statusCell === statusFilter : true;
            row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
        });
    }

    // Print functionality
    document.getElementById('printBtn').addEventListener('click', function() {
        window.print();
    });

    // PDF functionality
    document.getElementById('pdfBtn').addEventListener('click', function() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        doc.text('Suppliers List', 10, 10);
        doc.autoTable({ html: 'table' });
        doc.save('suppliers.pdf');
    });

    // Excel functionality
    document.getElementById('excelBtn').addEventListener('click', function() {
        const table = document.querySelector('table');
        const wb = XLSX.utils.table_to_book(table, { sheet: 'Suppliers' });
        XLSX.writeFile(wb, 'suppliers.xlsx');
    });
});
</script>

<?php include 'footer.php'; // Include footer ?>
