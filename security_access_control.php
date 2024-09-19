<?php
include 'header.php'; // Include header and navigation

// Example: Fetch user's role from session or database
$userRole = 'Teacher'; // Replace with actual role fetching logic

// Define CRUD permissions for each role
$permissions = [
    'Super Admin' => ['Users' => 'CRUD', 'Students' => 'CRUD', 'Teachers' => 'CRUD', 'Parents' => 'CRUD', 'Store' => 'CRUD'],
    'Admin' => ['Users' => 'CRUD', 'Students' => 'CRUD', 'Teachers' => 'CRUD', 'Parents' => 'CRUD', 'Store' => 'CRUD'],
    'Teacher' => ['Users' => 'Read', 'Students' => 'CRUD', 'Teachers' => 'Read', 'Parents' => 'Read', 'Store' => 'Read'],
    // Add more roles as needed
];
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Security and Access Control</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Security and Access Control</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Role Selection -->
      <div class="mb-3">
        <h3>Select Role</h3>
        <select id="roleSelect" class="form-select">
          <option value="Super Admin" <?php echo ($userRole === 'Super Admin') ? 'selected' : ''; ?>>Super Admin</option>
          <option value="Admin" <?php echo ($userRole === 'Admin') ? 'selected' : ''; ?>>Admin</option>
          <option value="Teacher" <?php echo ($userRole === 'Teacher') ? 'selected' : ''; ?>>Teacher</option>
          <!-- Add more roles as needed -->
        </select>
      </div>

      <!-- Menu for Super Admin -->
      <div id="superAdminContent" class="content-section" style="display: none;">
        <h2>Super Admin Dashboard</h2>
        <ul class="list-group">
          <li class="list-group-item"><a href="manage_users.php">Manage Users</a></li>
          <li class="list-group-item"><a href="manage_students.php">Manage Students</a></li>
          <li class="list-group-item"><a href="manage_teachers.php">Manage Teachers</a></li>
          <li class="list-group-item"><a href="manage_parents.php">Manage Parents</a></li>
          <li class="list-group-item"><a href="manage_store.php">Manage Store</a></li>
        </ul>
      </div>

      <!-- Menu for Admin -->
      <div id="adminContent" class="content-section" style="display: none;">
        <h2>Admin Dashboard</h2>
        <ul class="list-group">
          <li class="list-group-item"><a href="manage_users.php">Manage Users</a></li>
          <li class="list-group-item"><a href="manage_students.php">Manage Students</a></li>
          <li class="list-group-item"><a href="manage_teachers.php">Manage Teachers</a></li>
          <li class="list-group-item"><a href="manage_parents.php">Manage Parents</a></li>
          <li class="list-group-item"><a href="manage_store.php">Manage Store</a></li>
        </ul>
      </div>

      <!-- Menu for Teacher -->
      <div id="teacherContent" class="content-section" style="display: none;">
        <h2>Teacher Dashboard</h2>
        <ul class="list-group">
          <li class="list-group-item"><a href="view_students.php">View Students</a></li>
          <li class="list-group-item"><a href="view_teachers.php">View Teachers</a></li>
          <li class="list-group-item"><a href="view_parents.php">View Parents</a></li>
          <li class="list-group-item"><a href="view_store.php">View Store</a></li>
        </ul>
      </div>

    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'footer.php'; // Include footer ?>

<!-- JavaScript to toggle content sections based on selected role -->
<script>
  document.getElementById('roleSelect').addEventListener('change', function() {
    var role = this.value;
    document.getElementById('superAdminContent').style.display = (role === 'Super Admin') ? 'block' : 'none';
    document.getElementById('adminContent').style.display = (role === 'Admin') ? 'block' : 'none';
    document.getElementById('teacherContent').style.display = (role === 'Teacher') ? 'block' : 'none';
  });

  // Initially display content based on the user's role
  (function() {
    var role = "<?php echo $userRole; ?>";
    if (role === 'Super Admin') {
      document.getElementById('superAdminContent').style.display = 'block';
    } else if (role === 'Admin') {
      document.getElementById('adminContent').style.display = 'block';
    } else if (role === 'Teacher') {
      document.getElementById('teacherContent').style.display = 'block';
    }
  })();
</script>
