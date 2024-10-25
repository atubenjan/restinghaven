<?php
// Include header and navigation
include 'header.php';

if (isset($_POST['edit_grave_btn'])) {
    $id = trim($_POST['id']); // Assuming the form sends the auto-incrementing id
    $cemetery_id = trim($_POST['cemetery_id']);
    $plot_number = trim($_POST['plot_number']);
    $size = trim($_POST['size']);
    $availability_status = trim($_POST['availability_status']);
    $section_name = trim($_POST['section_name']);
    $price = trim($_POST['price']);
    $coordinates = trim($_POST['coordinates']);

    // Prepare SQL update statement
    $stmt = $dbh->prepare("UPDATE grave_management SET 
        cemetery_id = ?, 
        plot_number = ?, 
        size = ?, 
        availability_status = ?, 
        section_name = ?, 
        price = ?, 
        coordinates = ? 
        WHERE id = ?"); // Use id for the condition

    // Bind parameters
    $stmt->bindParam(1, $cemetery_id);
    $stmt->bindParam(2, $plot_number);
    $stmt->bindParam(3, $size);
    $stmt->bindParam(4, $availability_status);
    $stmt->bindParam(5, $section_name);
    $stmt->bindParam(6, $price);
    $stmt->bindParam(7, $coordinates);
    $stmt->bindParam(8, $id); // Bind the id for the WHERE clause

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: grave_management.php?status=success&message=Grave details updated successfully");
        exit();
    } else {
        header("Location: grave_management.php?status=error&message=Error updating grave details");
        exit();
    }
}




?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Grave Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Lot Management</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" style="background-color: #0b603a; border-color: #0b603a;">
                        <i class="fas fa-plus"></i> Grave Management
                    </button>
                   
                </div>

                <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead style="background-color: #0b603a; color: white;">
                            <tr>
                                <th>Cementery ID</th>
                            
                                <th>Plot Number</th>
                                <th>Lot</th>
                                <th>Size</th>
                                <th>Section</th>                            
                               
                                <th>Status</th>
                                <th>Price</th>
                                <th>Coordinates</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // Prepare SQL Query
                            $stmt = $dbh->query("SELECT * FROM grave_management");
                            $count = 1;

                            // Fetch and display rows
                            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                            ?>
                            <tr>
                                
                                <td><?= htmlspecialchars($row->cemetery_id); ?></td>
                                <td><?= htmlspecialchars($row->plot_number); ?></td>
                                <td><?= htmlspecialchars($row->lot); ?></td>
                                <td><?= htmlspecialchars($row->size); ?></td>
                                <td><?= htmlspecialchars($row->section_name); ?></td>
                               
                                <td><?= htmlspecialchars($row->availability_status); ?></td>
                                <td><?= htmlspecialchars($row->price); ?>UGX</td>
                                <td><?= htmlspecialchars($row->coordinates); ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit-modal<?= $row->cemetery_id; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>


                                  


                                    <div class="modal fade" id="edit-modal<?= $row->cemetery_id ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #0b603a; color: white;">
                                                    <h5 class="modal-title" id="editGraveModalLabel">Edit Grave Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>







                                                <div class="modal-body">
                                                <form method="POST">
    <input type="hidden" name="cemetery_id" value="<?= $row->cemetery_id; ?>">

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="editPlotNumber" class="form-label">Plot Number</label>
                <input type="text" class="form-control" id="editPlotNumber" name="plot_number" value="<?= $row->plot_number; ?>" required>
            </div>
            <div class="mb-3">
                <label for="editPlotNumber" class="form-label">Lot</label>
                <input type="text" class="form-control" id="editPlotNumber" name="lot" value="<?= $row->lot; ?>" required>
            </div>
            <div class="mb-3">
                <label for="editSize" class="form-label">Category</label>
                <select class="form-control" id="editSize" name="size" required>
                    <option value="" selected disabled>Choose category...</option>
                    <option value="single" <?= ($row->size == 'single') ? 'selected' : ''; ?>>Single</option>
                    <option value="double" <?= ($row->size == 'double') ? 'selected' : ''; ?>>Double</option>
                    <option value="family" <?= ($row->size == 'family') ? 'selected' : ''; ?>>Family</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="editAvailabilityStatus" class="form-label">Availability Status</label>
                <select class="form-control" id="editAvailabilityStatus" name="availability_status" required>
                    <option value="" selected disabled>Choose status...</option>
                    <option value="available" <?= ($row->availability_status == 'available') ? 'selected' : ''; ?>>Available</option>
                    <option value="occupied" <?= ($row->availability_status == 'occupied') ? 'selected' : ''; ?>>Occupied</option>
                    <option value="reserved" <?= ($row->availability_status == 'reserved') ? 'selected' : ''; ?>>Reserved</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="editSectionName" class="form-label">Section Name</label>
                <input type="text" class="form-control" id="editSectionName" name="section_name" value="<?= $row->section_name; ?>" required>
            </div>

            <div class="mb-3">
                <label for="editPrice" class="form-label">Price</label>
                <input type="text" class="form-control" id="editPrice" name="price" value="<?= $row->price; ?>" required>
            </div>

            <div class="mb-3">
                <label for="editCoordinates" class="form-label">Coordinates</label>
                <input type="text" class="form-control" id="editCoordinates" name="coordinates" value="<?= $row->coordinates; ?>" required>
            </div>
        </div>
    </div>

    <button type="submit" name="edit_grave_btn" class="btn btn-primary" style="background-color: #0b603a; color: white;">Update Grave</button>
</form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="delete_lot.php?id=<?= $row->cemetery_id; ?>" class="btn btn-danger btn-sm deleteBtn">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php 
                                $count++; 
                            } 
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

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
                        <!-- Left Column -->
                        <div class="col-md-6">
                        <div class="mb-3">
                        <span style="color: red; font-size: 0.85em; display: block; margin-bottom: 2px;">
        The Plot should be in the format PRHC0001.
    </span>
    <label for="addPlotNumber" class="form-label">Plot Number</label>
    <input type="text" class="form-control" id="addPlotNumber" name="Plot_number" placeholder="PRHC0001">
</div>


<div class="mb-3">
    <span style="color: red; font-size: 0.85em; display: block; margin-bottom: 2px;">
        The Lot should be in the format LRHC0001.
    </span>
    <label for="addPlotNumber" class="form-label">Lot</label>
    <input type="text" class="form-control" id="addPlotNumber" name="lot" placeholder="LRHC0001" required>
</div>


                        <div class="mb-3">
                                <label for="addSize" class="form-label">Size</label>
                                <select class="form-control" id="addSize" name="size" required>
                                    <option value="single">Resident-Adult</option>
                                    <option value="single">Resident-Child</option>
                                    <option value="single">Resident-Infant</option>
                                    <option value="single">Non Resident-Adult</option>
                                    <option value="single">Non Resident-Child</option>
                                    <option value="single">Non Resident-Infant</option>
                                </select>
                            </div>
                        </div>
                        <!-- Right Column -->
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
                                <label for="addSection" class="form-label">Section</label>
                                <select class="form-control" id="addSection" name="section_name" required>
                                    <option value="Row">Row</option>
                                    <option value="Block">Block</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Full Width Section -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="addPrice" class="form-label">Price</label>
                                <input type="number" class="form-control" id="addPrice" name="price" step="0.01" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="addCoordinates" class="form-label">Coordinates (GPS)</label>
                                <input type="text" class="form-control" id="addCoordinates" name="coordinates" placeholder="e.g., 40.7128 N, 74.0060 W" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="add_grave_btn" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Include footer -->
<?php include 'footer.php'; ?>

<script>
    // Defer loading this script until the DOM is fully loaded
    document.addEventListener("DOMContentLoaded", function() {
        // JavaScript functionality to manage the lot addition can go here
    });
    
</script>
