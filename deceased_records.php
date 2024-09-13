<?php
  include 'header.php'; // Include header and navigation
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Deceased Records</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Deceased Records</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Deceased records table -->
      <div class="card">
        <div class="card-header">
          <!-- Button to trigger modal -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDeceasedModal">
            Add Deceased Record
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="deceasedTable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Plot Number</th>
                <th>Photo</th>
                <th>Documents</th>
                <th>Nationality/Ethnicity</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- Example Row -->
              <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>Male</td>
                <td>Male</td>
                <td>G-123</td>
                <td>G-123</td>
                <td>USA</td>
                <td>
                  <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewDeceasedModal" onclick="viewDeceasedDetails(1, 'John Doe', 'Male', 'Natural Causes', 'G-123', 'Doe Family', 'USA', 'Jane Doe', 'Doctor', 'None', '2020-01-01', '14:30', '1950-01-01')">View</button>
                  <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editDeceasedModal" onclick="populateEditModal(1, 'John Doe', '1950-01-01', '2020-01-01', '14:30', 'Natural Causes', 'G-123', 'Doe Family', 'Jane Doe', 'USA', 'None')">Edit</button>
                  <a href="delete_deceased.php?id=1" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
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

<!-- Add Deceased Modal -->
<div class="modal fade" id="addDeceasedModal" tabindex="-1" aria-labelledby="addDeceasedModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDeceasedModalLabel">Add New Deceased Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addDeceasedForm">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="addName" class="form-label">Name</label>
              <input type="text" class="form-control" id="addName" name="name" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="addDateOfBirth" class="form-label">Date of Birth</label>
              <input type="date" class="form-control" id="addDateOfBirth" name="date_of_birth" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="addDateOfDeath" class="form-label">Date of Death</label>
              <input type="date" class="form-control" id="addDateOfDeath" name="date_of_death" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="addTimeOfDeath" class="form-label">Time of Death</label>
              <input type="time" class="form-control" id="addTimeOfDeath" name="time_of_death">
            </div>
            <div class="col-md-6 mb-3">
              <label for="addCauseOfDeath" class="form-label">Cause of Death</label>
              <input type="text" class="form-control" id="addCauseOfDeath" name="cause_of_death">
            </div>
            <div class="col-md-6 mb-3">
              <label for="addGraveNumber" class="form-label">Grave Number</label>
              <input type="text" class="form-control" id="addGraveNumber" name="grave_number">
            </div>
            <div class="col-md-6 mb-3">
              <label for="addFamilyLineage" class="form-label">Family Lineage</label>
              <input type="text" class="form-control" id="addFamilyLineage" name="family_lineage">
            </div>
            <div class="col-md-6 mb-3">
              <label for="addSpouse" class="form-label">Spouse</label>
              <input type="text" class="form-control" id="addSpouse" name="spouse">
            </div>
            <div class="col-md-6 mb-3">
              <label for="addOrigin" class="form-label">Origin</label>
              <input type="text" class="form-control" id="addOrigin" name="origin">
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

<!-- View Deceased Modal -->
<div class="modal fade" id="viewDeceasedModal" tabindex="-1" aria-labelledby="viewDeceasedModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewDeceasedModalLabel">View Deceased Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 mb-3">
            <strong>Name:</strong> <span id="viewName"></span>
          </div>
          <div class="col-md-6 mb-3">
            <strong>Gender:</strong> <span id="viewGender"></span>
          </div>
          <div class="col-md-6 mb-3">
            <strong>Cause of Death:</strong> <span id="viewCauseOfDeath"></span>
          </div>
          <div class="col-md-6 mb-3">
            <strong>Plot Number:</strong> <span id="viewPlotNumber"></span>
          </div>
          <div class="col-md-6 mb-3">
            <strong>Family Lineage:</strong> <span id="viewFamilyLineage"></span>
          </div>
          <div class="col-md-6 mb-3">
            <strong>Nationality/Ethnicity:</strong> <span id="viewNationality"></span>
          </div>
          <div class="col-md-6 mb-3">
            <strong>Spouse:</strong> <span id="viewSpouse"></span>
          </div>
          <div class="col-md-6 mb-3">
            <strong>Occupation:</strong> <span id="viewOccupation"></span>
          </div>
          <div class="col-md-6 mb-3">
            <strong>Date of Death:</strong> <span id="viewDateOfDeath"></span>
          </div>
          <div class="col-md-6 mb-3">
            <strong>Time of Death:</strong> <span id="viewTimeOfDeath"></span>
          </div>
          <div class="col-md-6 mb-3">
            <strong>Date of Birth:</strong> <span id="viewDateOfBirth"></span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php
  include 'footer.php'; // Include footer
?>
<!-- Optional Bootstrap JavaScript with Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Function to populate the View Deceased Modal with data
  function viewDeceasedDetails(id, name, gender, causeOfDeath, plotNumber, familyLineage, nationality, spouse, occupation, remarks, dateOfDeath, timeOfDeath, dateOfBirth) {
    document.getElementById('viewName').innerText = name;
    document.getElementById('viewGender').innerText = gender;
    document.getElementById('viewCauseOfDeath').innerText = causeOfDeath;
    document.getElementById('viewPlotNumber').innerText = plotNumber;
    document.getElementById('viewFamilyLineage').innerText = familyLineage;
    document.getElementById('viewNationality').innerText = nationality;
    document.getElementById('viewSpouse').innerText = spouse;
    document.getElementById('viewOccupation').innerText = occupation;
    document.getElementById('viewDateOfDeath').innerText = dateOfDeath;
    document.getElementById('viewTimeOfDeath').innerText = timeOfDeath;
    document.getElementById('viewDateOfBirth').innerText = dateOfBirth;
  }
</script>
