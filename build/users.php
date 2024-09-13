<?php include 'header.php'; // Include header and navigation ?>

<?php

// Fetch users
function fetchUsers($pdo) {
    $sql = "SELECT id, photo, fullname, email, phone, nin, location, role FROM users";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Delete user
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        header("Location: users.php"); // Redirect to users page
        exit();
    } else {
        echo "Error deleting user.";
    }
}

// Update user
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $nin = $_POST['nin'];
    $location = $_POST['location'];
    $role = $_POST['role'];
    
    $photo = $_FILES['photo']['name'];
    if ($photo) {
        // Handle file upload
        $targetDir = "path/to/photos/";
        $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile);
    } else {
        // If no file uploaded, keep existing photo
        $sql = "SELECT photo FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $photo = $result['photo'];
    }
    
    $sql = "UPDATE users SET fullname = :fullname, email = :email, phone = :phone, nin = :nin, location = :location, role = :role, photo = :photo WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':nin', $nin);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':photo', $photo);
    
    if ($stmt->execute()) {
        header("Location: users.php"); // Redirect to users page
        exit();
    } else {
        echo "Error updating user.";
    }
}
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Users</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Users table -->
      <div class="card">
        <div class="card-header">
          <!-- Button to trigger modal -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            Add User
          </button>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Photo</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>NIN</th>
                <th>Location</th>
                <th>Role</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $users = fetchUsers($pdo);
              foreach ($users as $user) {
                  echo "<tr>
                          <td>{$user['id']}</td>
                          <td><img src='path/to/photos/{$user['photo']}' alt='User Photo' width='50'></td>
                          <td>{$user['fullname']}</td>
                          <td>{$user['email']}</td>
                          <td>{$user['phone']}</td>
                          <td>{$user['nin']}</td>
                          <td>{$user['location']}</td>
                          <td>{$user['role']}</td>
                          <td>
                              <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editUserModal' onclick='populateEditModal({$user['id']}, \"{$user['fullname']}\", \"{$user['email']}\", \"{$user['phone']}\", \"{$user['nin']}\", \"{$user['location']}\", \"{$user['role']}\", \"{$user['photo']}\")'>Edit</button>
                              <a href='users.php?delete_id={$user['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
                              <a href='download_user.php?id={$user['id']}' class='btn btn-info btn-sm'>Download</a>
                          </td>
                        </tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addUserForm" action="add_user.php" method="POST" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="addPhoto" class="form-label">Photo</label>
                <input type="file" class="form-control" id="addPhoto" name="photo" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="addFullname" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="addFullname" name="fullname" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="addEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="addEmail" name="email" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="addPhone" class="form-label">Phone</label>
                <input type="tel" class="form-control" id="addPhone" name="phone" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="addNin" class="form-label">NIN</label>
                <input type="text" class="form-control" id="addNin" name="nin" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="addLocation" class="form-label">Location</label>
                <input type="text" class="form-control" id="addLocation" name="location" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="addRole" class="form-label">Role</label>
                <select class="form-control" id="addRole" name="role" required>
                  <option value="Admin">Admin</option>
                  <option value="User">User</option>
                  <option value="Cashier">Cashier</option>
                  <option value="Cemetery Manager">Cemetery Manager</option>
                  <!-- Add more roles as needed -->
                </select>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editUserForm" action="users.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" id="editUserId" name="id">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="editPhoto" class="form-label">Photo</label>
                <input type="file" class="form-control" id="editPhoto" name="photo">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="editFullname" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="editFullname" name="fullname" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="editEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="editEmail" name="email" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="editPhone" class="form-label">Phone</label>
                <input type="tel" class="form-control" id="editPhone" name="phone" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="editNin" class="form-label">NIN</label>
                <input type="text" class="form-control" id="editNin" name="nin" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="editLocation" class="form-label">Location</label>
                <input type="text" class="form-control" id="editLocation" name="location" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="editRole" class="form-label">Role</label>
                <select class="form-control" id="editRole" name="role" required>
                  <option value="Admin">Admin</option>
                  <option value="User">User</option>
                  <option value="Cashier">Cashier</option>
                  <option value="Cemetery Manager">Cemetery Manager</option>
                  <!-- Add more roles as needed -->
                </select>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary" name="update">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript to populate the edit modal -->
<script>
function populateEditModal(id, fullname, email, phone, nin, location, role, photo) {
    document.getElementById('editUserId').value = id;
    document.getElementById('editFullname').value = fullname;
    document.getElementById('editEmail').value = email;
    document.getElementById('editPhone').value = phone;
    document.getElementById('editNin').value = nin;
    document.getElementById('editLocation').value = location;
    document.getElementById('editRole').value = role;
    // Set photo preview if necessary
}
</script>

<?php include 'footer.php'; // Include footer ?>
