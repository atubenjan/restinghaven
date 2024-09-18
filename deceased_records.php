<?php include 'header.php'; // Include header and navigation ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Deceased Management</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Deceased Management</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Deceased Management table -->
      <div class="card">
        <div class="card-header">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            <i class="fas fa-plus"></i> Add Deceased Details
          </button>
          <a href="download_deceased.php" class="btn btn-info float-right">
            Download Deceased Data
          </a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>Date of Death</th>
                <th>Plot Number</th>
                <th>Family Lineage</th>
                <th>Spouse</th>
                <th>Gender</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Include database connection
              try {
                  $stmt = $dbh->query("SELECT id, name, date_of_birth, date_of_death, plot_number, family_lineage, spouse, gender FROM deceased_records");
                  $deceasedRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  // Display each record
                  foreach ($deceasedRecords as $record) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($record['id'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>" . htmlspecialchars($record['name'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>" . htmlspecialchars($record['date_of_birth'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>" . htmlspecialchars($record['date_of_death'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>" . htmlspecialchars($record['plot_number'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>" . htmlspecialchars($record['family_lineage'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>" . htmlspecialchars($record['spouse'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>" . htmlspecialchars($record['gender'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>
                          <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editDeceasedModal' data-id='" . htmlspecialchars($record['id'] ?? '', ENT_QUOTES, 'UTF-8') . "'>Edit</button>
                          <a href='delete_deceased.php?id=" . htmlspecialchars($record['id'] ?? '', ENT_QUOTES, 'UTF-8') . "' class='btn btn-danger btn-sm'>Delete</a>
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

<!-- Add Deceased Modal -->
<!-- (This remains unchanged) -->

<!-- Edit Deceased Modal -->
<!-- (This remains unchanged) -->

<!-- View Deceased Modal -->
<div class="modal fade" id="viewDeceasedModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">View Deceased Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="viewDeceasedDetails">
          <!-- Details will be loaded here via AJAX -->
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php include 'footer.php'; // Include footer ?>

<!-- ./wrapper -->

<script>
$(document).ready(function() {
  $('#viewDeceasedModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data('id'); // Extract info from data-* attributes

    $.ajax({
      url: 'fetch_deceased.php',
      type: 'GET',
      data: { id: id },
      success: function(response) {
        $('#viewDeceasedDetails').html(response);
      },
      error: function() {
        $('#viewDeceasedDetails').html('<p>Error loading details.</p>');
      }
    });
  });
});
</script>
