<?php
// Include header and navigation
include 'header.php';
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                        <i class="fas fa-plus"></i> Grave Management
                    </button>
                   
                </div>

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
                            // Prepare SQL Query
                            $stmt = $dbh->query("SELECT cemetery_id, plot_number, size, section_name, availability_status, price, coordinates FROM grave_management");
                            $count = 1;

                            // Fetch and display rows
                            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                            ?>
                            <tr>
                                <td><?= $count; ?></td>
                                <td><?= htmlspecialchars($row->cemetery_id); ?></td>
                                <td><?= htmlspecialchars($row->section_name); ?></td>
                                <td><?= htmlspecialchars($row->plot_number); ?></td>
                                <td><?= htmlspecialchars($row->size); ?></td>
                                <td><?= htmlspecialchars($row->availability_status); ?></td>
                                <td><?= htmlspecialchars($row->price); ?></td>
                                <td><?= htmlspecialchars($row->coordinates); ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit-modal-<?= $row->cemetery_id; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <a href="delete_lot.php?id=<?= $row->cemetery_id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this lot?');">
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
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="addCemeteryID" class="form-label">Cemetery ID</label>
                                <input type="number" class="form-control" id="addCemeteryID" name="Cemetery_id" required>
                            </div>
                            <div class="mb-3">
                                <label for="addPlotNumber" class="form-label">Plot Number</label>
                                <input type="text" class="form-control" id="addPlotNumber" name="Plot_number" required>
                            </div>
                            <div class="mb-3">
                                <label for="addSize" class="form-label">Size</label>
                                <select class="form-control" id="addSize" name="size" required>
                                    <option value="Single">Single</option>
                                    <option value="Double">Double</option>
                                    <option value="Family">Family</option>
                                </select>
                            </div>
                        </div>

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
                            <div class="mb-3">
                                <label for="addPrice" class="form-label">Price</label>
                                <input type="number" class="form-control" id="addPrice" name="price" step="0.01" required>
                            </div>
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
