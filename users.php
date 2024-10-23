<?php include 'header.php'; 

if (isset($_REQUEST['deleteUser'])) {
    $id = $_GET['deleteUser'];
  
    // Fetch the user's role first
    $stmt = $dbh->prepare("SELECT user_role FROM users WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_OBJ);
  
    // Check if the user is found and their role
    if ($user) {
        if ($user->user_role === 'SuperAdmin') {
            header("Location: users.php?status=error&message=SuperAdmin cannot be deleted");
        } else {
            // Prepare the DELETE statement to prevent SQL injection
            $deleteStmt = $dbh->prepare("DELETE FROM users WHERE id = :id");
            $deleteStmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($deleteStmt->execute()) {
                header("Location: users.php?status=success&message=User deleted successfully");
                exit();
            }
        }
    } else {
        header("Location: users.php?status=error&message=User not found.");
        exit();
    }
}


?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">User Management</h3>
                            <div class="card-tools">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" style="background-color: #0b603a; border-color: #0b603a;">
                                    <i class="fas fa-user-plus"></i> Add System User
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="background-color: #0b603a; color: white;">
                                    <tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>National ID</th>
                                        <th>Role</th>
                                        <th>Photo</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $users = $dbh->query("SELECT * FROM users");
                                    $count = 1;
                                    while ($row = $users->fetch(PDO::FETCH_OBJ)) {
                                    ?>
                                        <tr>
                                            <td><?=$count;?></td>
                                            <td><?=$row->username;?></td>
                                            <td><?=$row->email;?></td>
                                            <td><?=$row->national_id;?></td>
                                            <td><?=$row->user_role;?></td>
                                            <td><img src="<?=$row->photo;?>" alt="User Photo" class="img-thumbnail" width="100"></td>
                                            <td>
                                                <!-- edit btn -->
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editUser<?=$row->id?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <!-- edit modal -->
                                                <div class="modal fade" id="editUser<?=$row->id?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color: #0b603a; color: white; border-color: #0b603a;">
                                                                <h4 class="modal-title">Edit User</h4>
                                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" action="" enctype="multipart/form-data">
                                                                    <input type="hidden" name="id" value="<?= $row->id ?>">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="username" class="form-label">Username</label>
                                                                                <input type="text" class="form-control" id="username" value="<?= $row->username ?>" name="username" placeholder="Enter username" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="email" class="form-label">Email</label>
                                                                                <input type="email" class="form-control" id="email" value="<?= $row->email ?>" name="email" placeholder="Enter Email" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="nationalId" class="form-label">National ID</label>
                                                                                <input type="text" class="form-control" id="nationalId" value="<?= $row->national_id ?>" name="national_id" placeholder="Enter National ID" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="userRole" class="form-label">User Role</label>
                                                                                <select class="form-control" name="user_role" required>
                                                                                    <option value="" disabled selected>Select user role</option>
                                                                                    <option value="Admin" <?= $row->user_role == 'Admin' ? 'selected' : '' ?>>Admin</option>
                                                                                    <option value="SuperAdmin" <?= $row->user_role == 'SuperAdmin' ? 'selected' : '' ?>>SuperAdmin</option>
                                                                                    <option value="Manager" <?= $row->user_role == 'Manager' ? 'selected' : '' ?>>Manager</option>
                                                                                    <option value="FuneralDirector" <?= $row->user_role == 'FuneralDirector' ? 'selected' : '' ?>>FuneralDirector</option>
                                                                                    <option value="CemeteryStaff" <?= $row->user_role == 'CemeteryStaff' ? 'selected' : '' ?>>CemeteryStaff</option>
                                                                                    <option value="Accounting" <?= $row->user_role == 'Accounting' ? 'selected' : '' ?>>Accounting</option>
                                                                                    <option value="Maintenance" <?= $row->user_role == 'Maintenance' ? 'selected' : '' ?>>Maintenance</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="photo" class="form-label">Photo</label>
                                                                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*" onchange="previewImage(event)">
                                                                        <img id="photoPreview" src="#" alt="Image Preview" style="display:none; max-width: 200px; margin-top: 10px;">
                                                                    </div>

                                                                    <script>
                                                                        function previewImage(event) {
                                                                            const photoPreview = document.getElementById('photoPreview');
                                                                            const file = event.target.files[0];
                                                                            const reader = new FileReader();
                                                                            reader.onload = function() {
                                                                                photoPreview.src = reader.result;
                                                                                photoPreview.style.display = 'block';
                                                                            };
                                                                            if (file) {
                                                                                reader.readAsDataURL(file);
                                                                            } else {
                                                                                photoPreview.style.display = 'none';
                                                                            }
                                                                        }
                                                                    </script>

                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-sm btn-success" style="background-color: #0b603a; border-color: #0b603a;" name="edit_user_btn">Save changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- delete users -->
                                                <?php if ($row->user_role !== 'SuperAdmin'): ?>
                                                    <a href="?deleteUser=<?=$row->id?>" class="btn btn-danger btn-sm deleteBtn">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                <?php else: ?>
                                                    <button class="btn btn-danger btn-sm" disabled>
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php 
                                        $count++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0b603a; border-color: #0b603a;">
                <h4 class="modal-title">Add User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nationalId" class="form-label">National ID</label>
                                <input type="text" class="form-control" id="nationalId" name="national_id" placeholder="Enter National ID" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userRole" class="form-label">User Role</label>
                                <select class="form-control" id="userRole" name="user_role" required>
                                    <option value="" disabled selected>Select user role</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                    </div>
                    <div class="form-group">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" class="form-control" id="photo" name="photo" required accept="image/*" onchange="previewImage(event)">
                        <img id="photoPreview" src="#" alt="Image Preview" style="display:none; max-width: 200px; margin-top: 10px;">
                    </div>
                <script>
                    function previewImage(event) {
                        const photoPreview = document.getElementById('photoPreview');
                        const file = event.target.files[0];
                        const reader = new FileReader();
                        reader.onload = function(){
                            photoPreview.src = reader.result;
                            photoPreview.style.display = 'block';
                        };
                        if (file) {
                            reader.readAsDataURL(file);
                        } else {
                            photoPreview.style.display = 'none';
                        }
                    }
                </script>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success" name="register_btn" style="background-color: #0b603a; border-color: #0b603a;">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Fetch user roles from the JSON file
    fetch('user_roles.json')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(userRoles => {
            const selectElement = document.getElementById('userRole');
            // Populate the select element with user roles
            userRoles.forEach(userRole => {
                const option = document.createElement('option');
                option.value = userRole;  // Set the value of the option
                option.textContent = userRole;  // Set the display text
                selectElement.appendChild(option); // Append the option to the select
            });
        })
        .catch(error => {
            console.error('Error loading user roles:', error);
            // Optionally, display an error message to the user
            const selectElement = document.getElementById('userRole');
            const option = document.createElement('option');
            option.value = '';
            option.textContent = 'Failed to load user roles';
            selectElement.appendChild(option); // Append error message option
        });
</script>

<?php include('footer.php'); ?>
