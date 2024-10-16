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
                <th>Time of Death</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Include database connection
           

              // Fetch deceased records
              try {
                  $stmt = $dbh->query("SELECT * FROM deceased_records");
                  $deceasedRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  // Display each record
                  foreach ($deceasedRecords as $record) {
                      $deceased_id = htmlspecialchars($record['deceased_id'], ENT_QUOTES, 'UTF-8');
                      echo "<tr>";
                      echo "<td>$deceased_id</td>";
                      echo "<td>" . htmlspecialchars($record['full_name'], ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars($record['date_of_birth'], ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars($record['date_of_death'], ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>" . htmlspecialchars($record['time_of_death'], ENT_QUOTES, 'UTF-8') . "</td>";
                      echo "<td>
                           <button class='btn btn-info btn-sm' data-toggle='modal' data-target='#modal-success' data-id='$deceased_id'>View</button>
                           <button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editDeceasedModal' data-id='$deceased_id'>Edit</button>
                           <a href='delete_deceased.php?id=$deceased_id' class='btn btn-danger btn-sm'>Delete</a>
                           </td>";
                      echo "</tr>";
                  }
              } catch (PDOException $e) {
                  echo "Error: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
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
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg"> <!-- Larger modal size -->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Deceased Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addDeceasedForm" action="" method="post" enctype="multipart/form-data">
          <div class="container">
            <div class="row">
              <!-- Column 1 -->
              <div class="col-md-4 mb-3">
                <label for="addName" class="form-label"> Full Name</label>
                <input type="text" class="form-control" id="addName" name="full_name" required>
              </div>
              <div class="col-md-4 mb-3">
                <label for="addDateOfBirth" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="addDateOfBirth" name="date_of_birth" required>
              </div>
              <div class="col-md-4 mb-3">
                <label for="addDateOfDeath" class="form-label">Date of Death</label>
                <input type="date" class="form-control" id="addDateOfDeath" name="date_of_death" required>
              </div>
              <div class="col-md-4 mb-3">
                <label for="addTimeOfDeath" class="form-label">Time of Death</label>
                <input type="time" class="form-control" id="addTimeOfDeath" name="time_of_death">
              </div>
              <div class="col-md-4 mb-3">
                <label for="addCauseOfDeath" class="form-label">Cause of Death</label>
                <input type="text" class="form-control" id="addCauseOfDeath" name="cause_of_death">
              </div>
              <div class="col-md-4 mb-3">
                <label for="addPlotNumber" class="form-label">Plot Number</label>
                <input type="text" class="form-control" id="addPlotNumber" name="plot_number">
              </div>
              <div class="col-md-4 mb-3">
                <label for="addFamilyLineage" class="form-label">Family Lineage</label>
                <input type="text" class="form-control" id="addFamilyLineage" name="family_lineage">
              </div>
              <div class="col-md-4 mb-3">
                <label for="addSpouse" class="form-label">Spouse</label>
                <input type="text" class="form-control" id="addSpouse" name="spouse">
              </div>
              <div class="col-md-4 mb-3">
                <label for="addOrigin" class="form-label">Origin</label>
                <input type="text" class="form-control" id="addOrigin" name="origin">
              </div>
              <div class="col-md-4 mb-3">
                <label for="addAgeAtDeath" class="form-label">Age at Death</label>
                <input type="number" class="form-control" id="addAgeAtDeath" name="age_at_death">
              </div>
              <div class="col-md-4 mb-3">
                <label for="addGender" class="form-label">Gender</label>
                <select class="form-control" id="addGender" name="gender">
                  <option value="">Select Gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label for="addPlaceOfBirth" class="form-label">Place of Birth</label>
                <input type="text" class="form-control" id="addPlaceOfBirth" name="place_of_birth">
              </div>
              <div class="col-md-4 mb-3">
                <label for="addPlaceOfDeath" class="form-label">Place of Death</label>
                <input type="text" class="form-control" id="addPlaceOfDeath" name="place_of_death">
              </div>
              <div class="col-md-4 mb-3">
                <label for="addNationality" class="form-label">Nationality/Ethnicity</label>
                <input type="text" class="form-control" id="addNationality" name="nationality">
              </div>
              <div class="col-md-4 mb-3">
                <label for="addOccupation" class="form-label">Occupation</label>
                <input type="text" class="form-control" id="addOccupation" name="occupation">
              </div>
              <div class="col-md-4 mb-3">
                <label for="addFileUpload" class="form-label">File Upload</label>
                <input type="file" class="form-control" id="addFileUpload" name="file_upload">
              </div>
              <div class="col-md-12 mb-3">
                <label for="addRemarks" class="form-label">Remarks</label>
                <textarea class="form-control" id="addRemarks" name="remarks" rows="3"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="add_deceased_btn" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- View Deceased Modal -->
<div class="modal fade" id="modal-success">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">View Deceased Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Content will be loaded here via JavaScript -->
      </div>
    </div>
  </div>
</div>

<!-- Edit Deceased Modal -->
<div class="modal fade" id="editDeceasedModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Deceased Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editDeceasedForm" action="update_deceased.php" method="post" enctype="multipart/form-data">
          <!-- Form fields to be dynamically populated via JavaScript -->
          <input type="hidden" name="id" id="editId">
          <!-- Add similar fields to those in the Add Modal -->
          <!-- Ensure all fields match those in the database schema -->
          <!-- Example -->
          <div class="form-group">
            <label for="editName">Name</label>
            <input type="text" class="form-control" id="editName" name="name" required>
          </div>
          <!-- Other fields go here -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Include jQuery, Bootstrap JS, and any other necessary libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

<script>
  $(document).ready(function() {
    // Fetch and display details for the view modal
    $('#modal-success').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var id = button.data('id'); // Extract info from data-* attributes
      
      // Perform AJAX request to fetch the details
      $.ajax({
        url: 'fetch_deceased_details.php', // URL to fetch details
        type: 'GET',
        data: { id: id },
        success: function(data) {
          $('#modal-success .modal-body').html(data);
        }
      });
    });
   

    // Fetch and populate fields for the edit modal
    $('#editDeceasedModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var id = button.data('id'); // Extract info from data-* attributes
      
      // Perform AJAX request to fetch the details
      $.ajax({
        url: 'fetch_deceased_details.php', // URL to fetch details
        type: 'GET',
        data: { id: id },
        success: function(data) {
          var details = JSON.parse(data);
          $('#editId').val(details.id);
          $('#editName').val(details.name);
          // Populate other fields similarly
        }
      });
    });
  });
</script>

<?php include 'footer.php'; // Include footer ?>
