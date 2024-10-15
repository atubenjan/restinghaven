
<?php
// Include header and navigation
include 'header.php';
?>


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
      <!-- Display messages -->
      <?php
      if (isset($_GET['message'])) {
          echo "<div class='alert alert-success'>" . htmlspecialchars($_GET['message'], ENT_QUOTES) . "</div>";
      }
      if (isset($_GET['error'])) {
          echo "<div class='alert alert-danger'>" . htmlspecialchars($_GET['error'], ENT_QUOTES) . "</div>";
      }
      ?>

      <!-- Lot Management table -->
      <div class="card">
        <div class="card-header">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            <i class="fas fa-plus"></i> Grave Management
          </button>
          <a href="download_lot.php" class="btn btn-info float-right">
            Download Lot Data
          </a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Cemetery</th>
                <th>Section</th>
                <th>Plot Number</th>
                <th>Size</th>
                <th>Status</th>
                <th>Price</th>
                <th>Coordinates</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Fetch lots
              try {
                  $stmt = $dbh->query("
                      SELECT g.Plot_ID, c.Cemetery_Name, s.Section_Name, g.Plot_Number, g.Size, g.Availability_Status, g.Price, g.Coordinates
                      FROM grave_management g
                      JOIN cemeteries c ON g.Cemetery_ID = c.Cemetery_ID
                      JOIN sections s ON g.Section_ID = s.Section_ID
                  ");
                  $lots = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  // Display each lot
                  foreach ($lots as $lot) {
                      echo "<tr>";
                      echo "<td>" . htmlspecialchars($lot['Plot_ID'], ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars($lot['Cemetery_Name'], ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars($lot['Section_Name'], ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars($lot['Plot_Number'], ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars($lot['Size'], ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars($lot['Availability_Status'], ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars($lot['Price'], ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars($lot['Coordinates'], ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>
                            <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editLotModal' data-id='" . htmlspecialchars($lot['Plot_ID'], ENT_QUOTES, 'UTF-8') . "'>Edit</button>
                            <a href='delete_lot.php?id=" . htmlspecialchars($lot['Plot_ID'], ENT_QUOTES, 'UTF-8') . "' class='btn btn-danger btn-sm'>Delete</a>
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
        <h4 class="modal-title">Grave Management</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addLotForm" action="" method="post">
          <div class="row">
            <!-- Left column -->
            <div class="col-md-6">
              <div class="mb-3">
                <label for="addCemeteryID" class="form-label">Cemetery ID</label>
                <input type="number" class="form-control" id="addCemeteryID" name="Cemetery_ID" required>
              </div>
              <div class="mb-3">
                <label for="addPlotNumber" class="form-label">Plot Number</label>
                <input type="text" class="form-control" id="addPlotNumber" name="Plot_Number" required>
              </div>
              <div class="mb-3">
                <label for="addSize" class="form-label">Size</label>
                <select class="form-control" id="addSize" name="Size" required>
                  <option value="Single">Single</option>
                  <option value="Double">Double</option>
                  <option value="Family">Family</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="selectSection" class="form-label">Section (Row, Block, etc.)</label>
                <select class="form-control" id="selectSection" name="sections">
                  <option value="">Select Section</option>
                  <?php
                  // Fetch sections from the database
                  $stmt = $dbh->query("SELECT DISTINCT Section_Name FROM sections");
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      echo "<option value='" . htmlspecialchars($row['Section_Name'], ENT_QUOTES) . "'>" . htmlspecialchars($row['Section_Name'], ENT_QUOTES) . "</option>";
                  }
                  ?>
                  <option value="new">Add New Section</option>
                </select>
              </div>
              <div class="mb-3" id="newSectionInput" style="display:none;">
                <label for="addNewSection" class="form-label">New Section</label>
                <input type="text" class="form-control" id="addNewSection" name="new_section">
              </div>
            </div>

            <!-- Right column -->
            <div class="col-md-6">
              <div class="mb-3">
                <label for="addStatus" class="form-label">Availability Status</label>
                <select class="form-control" id="addStatus" name="Availability_Status" required>
                  <option value="Available">Available</option>
                  <option value="Occupied">Occupied</option>
                  <option value="Reserved">Reserved</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="addPrice" class="form-label">Price</label>
                <input type="number" class="form-control" id="addPrice" name="Price" step="0.01" required>
              </div>
              <div class="mb-3">
                <label for="addCoordinates" class="form-label">Coordinates (GPS)</label>
                <input type="text" class="form-control" id="addCoordinates" name="Coordinates" placeholder="e.g., 40.7128 N, 74.0060 W" required>
              </div>
            </div>
          </div>
          <button type="submit" name="add_lot_btn" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('selectSection').addEventListener('change', function () {
    var newSectionInput = document.getElementById('newSectionInput');
    if (this.value === 'new') {
      newSectionInput.style.display = 'block';
    } else {
      newSectionInput.style.display = 'none';
    }
  });
</script>

<?php include 'footer.php'; // Include footer and script tags ?>