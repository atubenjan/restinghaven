<?php include 'header.php'; // Include header and navigation ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Appointments</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Appointments</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Appointment table -->
      <div class="card">
        <div class="card-header">
          <!-- Button to trigger modal -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAppointmentModal">
            Add Appointment
          </button>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Reason</th>
                <th>Assigned to</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- Placeholder rows with no data in fields except action buttons -->
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editAppointmentModal" 
                    onclick="populateEditModal(1, '', '', '', '', '')">
                    Edit
                  </button>
                  <a href="delete_appointment.php?id=1" class="btn btn-danger btn-sm" 
                    onclick="return confirm('Are you sure you want to delete this appointment?');">Delete</a>
                </td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editAppointmentModal" 
                    onclick="populateEditModal(2, '', '', '', '', '')">
                    Edit
                  </button>
                  <a href="delete_appointment.php?id=2" class="btn btn-danger btn-sm" 
                    onclick="return confirm('Are you sure you want to delete this appointment?');">Delete</a>
                </td>
              </tr>
              <!-- Add more rows as needed -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Add Appointment Modal -->
<div class="modal fade" id="addAppointmentModal" tabindex="-1" aria-labelledby="addAppointmentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addAppointmentModalLabel">Add New Appointment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addAppointmentForm">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="addFullname" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="addFullname" name="fullname" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="addDate" class="form-label">Date</label>
                <input type="date" class="form-control" id="addDate" name="date" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="addTime" class="form-label">Time</label>
                <input type="time" class="form-control" id="addTime" name="time" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="mb-3">
                <label for="addReason" class="form-label">Reason</label>
                <textarea class="form-control" id="addReason" name="reason" rows="3" required></textarea>
              </div>
            </div>
            <div class="col-md-12">
              <div class="mb-3">
                <label for="addAssignedTo" class="form-label">Assigned to</label>
                <input type="text" class="form-control" id="addAssignedTo" name="assigned_to" required>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Appointment Modal -->
<div class="modal fade" id="editAppointmentModal" tabindex="-1" aria-labelledby="editAppointmentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editAppointmentModalLabel">Edit Appointment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editAppointmentForm">
          <input type="hidden" id="editAppointmentId" name="id">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="editFullname" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="editFullname" name="fullname" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="editDate" class="form-label">Date</label>
                <input type="date" class="form-control" id="editDate" name="date" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="editTime" class="form-label">Time</label>
                <input type="time" class="form-control" id="editTime" name="time" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="mb-3">
                <label for="editReason" class="form-label">Reason</label>
                <textarea class="form-control" id="editReason" name="reason" rows="3" required></textarea>
              </div>
            </div>
            <div class="col-md-12">
              <div class="mb-3">
                <label for="editAssignedTo" class="form-label">Assigned to</label>
                <input type="text" class="form-control" id="editAssignedTo" name="assigned_to" required>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Update</button> <!-- Update button -->
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; // Include footer ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // JavaScript to populate edit modal with appointment data
  function populateEditModal(id, fullname, date, time, reason, assignedTo) {
    document.getElementById('editAppointmentId').value = id;
    document.getElementById('editFullname').value = fullname;
    document.getElementById('editDate').value = date;
    document.getElementById('editTime').value = time;
    document.getElementById('editReason').value = reason;
    document.getElementById('editAssignedTo').value = assignedTo;
  }

  document.getElementById('addAppointmentForm').addEventListener('submit', function(event) {
    event.preventDefault();
    alert('Add Appointment Form submitted');
  });

  document.getElementById('editAppointmentForm').addEventListener('submit', function(event) {
    event.preventDefault();
    alert('Edit Appointment Form submitted');
  });
</script>
