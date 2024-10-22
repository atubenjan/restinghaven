<?php include 'header.php'; // Include header and navigation ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Lot Management</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Lot Management</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Lot Management table -->
      <div class="card">
        <div class="card-header">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" style="background-color: #0b603a; border-color: #0b603a;">
            <i class="fas fa-plus"></i> Add Lot
          </button>
          <a href="download_lot.php" class="btn btn-info float-right">
            Download Lot Data
          </a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
          <thead style="background-color: #0b603a; color: white;">
              <tr>
                <th>ID</th>
                <th>Section</th>
                <th>Lot Number</th>
                <th>Location</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Include database connection

              // Fetch lots
              try {
                  $stmt = $dbh->query("SELECT * FROM lot_management");
                  $lots = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  // Display each lot
                  foreach ($lots as $lot) {
                      echo "<tr>";
                      echo "<td>" . htmlspecialchars($lot['id'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars($lot['section'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars($lot['lot_number'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars($lot['location'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars($lot['status'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>
                            <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editLotModal' data-id='" . htmlspecialchars($lot['id'] ?? '', ENT_QUOTES, 'UTF-8') . "'>Edit</button>
                            <a href='delete_lot.php?id=" . htmlspecialchars($lot['id'] ?? '', ENT_QUOTES, 'UTF-8') . "' class='btn btn-danger btn-sm'>Delete</a>
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

<!-- Add Lot Modal -->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Lot</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addLotForm" action="" method="post">
          <div class="mb-3">
            <label for="addSection" class="form-label">Section</label>
            <input type="text" class="form-control" id="addSection" name="section" required>
          </div>
          <div class="mb-3">
            <label for="addLotNumber" class="form-label">Lot Number</label>
            <input type="text" class="form-control" id="addLotNumber" name="lot_number" required>
          </div>
          <div class="mb-3">
            <label for="addLocation" class="form-label">Location</label>
            <input type="text" class="form-control" id="addLocation" name="location" required>
          </div>
          <div class="mb-3">
            <label for="addStatus" class="form-label">Status</label>
            <select class="form-control" id="addStatus" name="status" required>
              <option value="Available">Available</option>
              <option value="Occupied">Occupied</option>
              <option value="Reserved">Reserved</option>
            </select>
          </div>
          <button type="submit" name="add_lot_btn" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; // Include footer and script tags ?>
