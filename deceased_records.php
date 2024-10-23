<?php include 'header.php'; // Include header and navigation 

if (isset($_POST['edit_deceased_btn'])) {
  $deceased_id = $_POST['deceased_id'];
  $full_name = $_POST['full_name'];
  $date_of_birth = $_POST['date_of_birth'];
  $date_of_death = $_POST['date_of_death'];
  $time_of_death = $_POST['time_of_death'];
  $cause_of_death = $_POST['cause_of_death'];
  $plot_number = $_POST['plot_number'];
  $family_lineage = $_POST['family_lineage'];
  $spouse = $_POST['spouse'];
  $origin = $_POST['origin'];
  $age_at_death = $_POST['age_at_death']; // Fixed variable name
  $gender = $_POST['gender'];
  $place_of_birth = $_POST['place_of_birth'];
  $place_of_death = $_POST['place_of_death'];
  $nationality = $_POST['nationality'];
  $occupation = $_POST['occupation'];
  $remarks = $_POST['remarks']; // Fixed variable name
  $files = $_POST['files'];

  // Prepare SQL update statement
  $stmt = $dbh->prepare("
      UPDATE deceased_records SET 
          full_name = :full_name,
          date_of_birth = :date_of_birth,
          date_of_death = :date_of_death,
          time_of_death = :time_of_death,
          cause_of_death = :cause_of_death,
          plot_number = :plot_number,
          family_lineage = :family_lineage,
          spouse = :spouse,
          origin = :origin,
          age_at_death = :age_at_death,
          gender = :gender,
          place_of_birth = :place_of_birth,
          place_of_death = :place_of_death,
          nationality = :nationality,
          occupation = :occupation,
          remarks = :remarks,
          files = :files
      WHERE deceased_id = :deceased_id
  ");

  // Bind parameters
  $stmt->bindParam(':full_name', $full_name);
  $stmt->bindParam(':date_of_birth', $date_of_birth);
  $stmt->bindParam(':date_of_death', $date_of_death);
  $stmt->bindParam(':time_of_death', $time_of_death);
  $stmt->bindParam(':cause_of_death', $cause_of_death);
  $stmt->bindParam(':plot_number', $plot_number);
  $stmt->bindParam(':family_lineage', $family_lineage);
  $stmt->bindParam(':spouse', $spouse);
  $stmt->bindParam(':origin', $origin);
  $stmt->bindParam(':age_at_death', $age_at_death);
  $stmt->bindParam(':gender', $gender);
  $stmt->bindParam(':place_of_birth', $place_of_birth);
  $stmt->bindParam(':place_of_death', $place_of_death);
  $stmt->bindParam(':nationality', $nationality);
  $stmt->bindParam(':occupation', $occupation);
  $stmt->bindParam(':remarks', $remarks);
  $stmt->bindParam(':files', $files);
  $stmt->bindParam(':deceased_id', $deceased_id);

  // Execute the statement
  if ($stmt->execute()) {
    header("Location: deceased_records.php?status=success&message=Record edited successfully");
    exit();
} else {
    // Redirect to the main page with an error message
    header("Location: deceased_records.php?status=error&message=Error editting record");
    exit();
}
}

?>

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

  <section class="content">
    <div class="container-fluid">
        <!-- Deceased Management table -->
        <div class="card">
            <div class="card-header">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" style="background-color: #0b603a; border-color: #0b603a;">
                    <i class="fas fa-plus"></i> Add Deceased Details
                </button>
               
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                <thead style="background-color: #0b603a; color: white;">
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Date of Birth</th>
                            <th>Time of Death</th>
                            <th>Cause of Death</th>
                            <th>Plot Number</th>
                            <th>Family Lineage</th>
                            <th>Spouse</th>
                            <th>Origin</th>
                            <th>Age at Death</th>
                            <th>Gender</th>
                            <th>Place of Birth</th>
                            <th>Place of Death</th>
                            <th>Nationality/Ethnicity</th>
                            <th>Occupation</th>
                            <th>File Upload</th>
                            <th>Remarks</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $stmt = $dbh->query("SELECT * FROM deceased_records");
                        $count = 1;
                        while($row = $stmt->fetch(PDO::FETCH_OBJ)) {    
                    ?>
                      <tr>
                      <td><?= $count;?></td>
                      <td><?= $row->full_name; ?></td>
                      <td><?= $row->date_of_death; ?></td>
                      <td><?= $row->time_of_death; ?></td>
                      <td><?= $row->cause_of_death; ?></td>
                      <td><?= $row->plot_number; ?></td>
                      <td><?= $row->family_lineage; ?></td>
                      <td><?= $row->spouse; ?></td>
                      <td><?= $row->origin; ?></td>
                      <td><?= $row->age_at_death; ?></td>
                      <td><?= $row->gender; ?></td>
                      <td><?= $row->place_of_birth; ?></td>
                      <td><?= $row->place_of_death; ?></td>
                      <td><?= $row->nationality; ?></td>
                      <td><?= $row->occupation; ?></td>
                      <td><?= isset($row->file_upload) ? $row->file_upload : 'N/A'; ?></td>
                      <td><?= $row->remarks; ?></td>
                      <td>
                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-success">View</button>
                        
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editDeceasedModal<?= $row->deceased_id; ?>">Edit</button>
                        <!-- Edit Deceased Modal -->
                        <div class="modal fade" id="editDeceasedModal<?= $row->deceased_id; ?>">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="editDeceasedModalLabel">Edit Deceased Details</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                  <input type="hidden" name="deceased_id" value="<?= $row->deceased_id; ?>">
                                  <div class="container">
                                    <div class="row">
                                      <div class="col-md-4 mb-3">
                                        <label for="editName" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="editName" name="full_name" value="<?= $row->full_name; ?>" required>
                                      </div>
                                      <div class="col-md-4 mb-3">
                                        <label for="editDateOfBirth" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="editDateOfBirth" name="date_of_birth" value="<?= $row->date_of_birth; ?>" required>
                                      </div>
                                      <div class="col-md-4 mb-3">
                                        <label for="editDateOfDeath" class="form-label">Date of Death</label>
                                        <input type="date" class="form-control" id="editDateOfDeath" name="date_of_death" value="<?= $row->date_of_death; ?>" required>
                                      </div>
                                      <div class="col-md-4 mb-3">
                                        <label for="editTimeOfDeath" class="form-label">Time of Death</label>
                                        <input type="time" class="form-control" id="editTimeOfDeath" name="time_of_death" value="<?= $row->time_of_death; ?>">
                                      </div>
                                      <div class="col-md-4 mb-3">
                                        <label for="editCauseOfDeath" class="form-label">Cause of Death</label>
                                        <input type="text" class="form-control" id="editCauseOfDeath" name="cause_of_death" value="<?= $row->cause_of_death; ?>">
                                      </div>
                                      <div class="col-md-4 mb-3">
                                        <label for="editPlotNumber" class="form-label">Plot Number</label>
                                        <input type="text" class="form-control" id="editPlotNumber" name="plot_number" value="<?= $row->plot_number; ?>">
                                      </div>
                                      <div class="col-md-4 mb-3">
                                        <label for="editFamilyLineage" class="form-label">Family Lineage</label>
                                        <input type="text" class="form-control" id="editFamilyLineage" name="family_lineage" value="<?= $row->family_lineage; ?>">
                                      </div>
                                      <div class="col-md-4 mb-3">
                                        <label for="editSpouse" class="form-label">Spouse</label>
                                        <input type="text" class="form-control" id="editSpouse" name="spouse" value="<?= $row->spouse; ?>">
                                      </div>
                                      <div class="col-md-4 mb-3">
                                        <label for="editOrigin" class="form-label">Origin</label>
                                        <input type="text" class="form-control" id="editOrigin" name="origin" value="<?= $row->origin; ?>">
                                      </div>
                                      <div class="col-md-4 mb-3">
                                        <label for="editAgeAtDeath" class="form-label">Age at Death</label>
                                        <input type="number" class="form-control" id="editAgeAtDeath" name="age_at_death" value="<?= $row->age_at_death; ?>">
                                      </div>
                                      <div class="col-md-4 mb-3">
                                        <label for="editGender" class="form-label">Gender</label>
                                        <select class="form-control" id="editGender" name="gender">
                                          <option value="Male" <?= $row->gender == 'Male' ? 'selected' : ''; ?>>Male</option>
                                          <option value="Female" <?= $row->gender == 'Female' ? 'selected' : ''; ?>>Female</option>
                                        </select>
                                      </div>
                                      <div class="col-md-4 mb-3">
                                        <label for="editPlaceOfBirth" class="form-label">Place of Birth</label>
                                        <input type="text" class="form-control" id="editPlaceOfBirth" name="place_of_birth" value="<?= $row->place_of_birth; ?>">
                                      </div>
                                      <div class="col-md-4 mb-3">
                                        <label for="editPlaceOfDeath" class="form-label">Place of Death</label>
                                        <input type="text" class="form-control" id="editPlaceOfDeath" name="place_of_death" value="<?= $row->place_of_death; ?>">
                                      </div>
                                      <div class="col-md-4 mb-3">
                                        <label for="editNationality" class="form-label">Nationality/Ethnicity</label>
                                        <input type="text" class="form-control" id="editNationality" name="nationality" value="<?= $row->nationality; ?>">
                                      </div>
                                      <div class="col-md-4 mb-3">
                                        <label for="editOccupation" class="form-label">Occupation</label>
                                        <input type="text" class="form-control" id="editOccupation" name="occupation" value="<?= $row->occupation; ?>">
                                      </div>
                                      <div class="col-md-4 mb-3">
                                        <label for="editFileUpload" class="form-label">File Upload</label>
                                        <input type="file" class="form-control" id="editFileUpload" name="file_upload">
                                        <small>Current: <?= isset($row->file_upload) ? $row->file_upload : 'N/A'; ?></small>
                                      </div>
                                      <div class="col-md-12 mb-3">
                                        <label for="editRemarks" class="form-label">Remarks</label>
                                        <textarea class="form-control" id="editRemarks" name="remarks" rows="3"><?= $row->remarks; ?></textarea>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="edit_deceased_btn" class="btn btn-primary">Save Changes</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        <a href="delete_deceased.php?deceased_id=<?= $row->deceased_id; ?>" class="btn btn-sm btn-danger deleteDeceased" data-id="<?= $row->deceased_id; ?>">
                          Delete
                        </a>
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
        <form action="" method="post" enctype="multipart/form-data">
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
        <input type="text" class="form-control" placeholder="Choose Nationaity" id="addNationality" name="nationality" list="nationalitiesList">
        <datalist id="nationalitiesList">
            <!-- Options will be populated dynamically via JavaScript -->
        </datalist>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Fetch the nationalities JSON
            fetch('./nationalities.json')
                .then(response => response.json())
                .then(data => {
                    const nationalitiesList = document.getElementById('nationalitiesList');
                    data.nationalities.forEach(nationality => {
                        const option = document.createElement('option');
                        option.value = nationality; // The value of the option
                        nationalitiesList.appendChild(option);
                    });
                })
                .catch(error => console.error('Error loading nationalities:', error));
        });
    </script>
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


<!-- Include jQuery, Bootstrap JS, and any other necessary libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

<script>
  $(document).ready(function() {   
    $(document).on('click', '.deleteDeceased', function(e) {
      e.preventDefault(); // Prevent the default link action
      
      const deleteUrl = this.href; // Store the URL to the delete script
      
      // Show SweetAlert confirmation dialog
      Swal.fire({
        title: 'Are you sure?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          // If confirmed, redirect to the delete URL
          window.location.href = deleteUrl;
        }
      });
    });
  });

</script>

<?php include 'footer.php'; // Include footer ?>
