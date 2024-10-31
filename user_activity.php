<?php
// Include database connection
include 'header.php'; // Include header and navigation
error_reporting(E_ALL);
ini_set('display_errors', 1);

function getUserActivity($dbh, $userId) {
    $stmt = $dbh->prepare("SELECT * FROM user_activity WHERE user_id = :user_id ORDER BY visit_time DESC");
    $stmt->execute([':user_id' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch activities for the logged-in user
$activities = getUserActivity($dbh, $_SESSION['id']); // Make sure the session has the user ID
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Activity</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <style>
                /* Basic styling for the table */
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    padding: 10px;
                    border: 1px solid #ddd;
                }
                th {
                    background-color: #0b603a; /* Changed for better visibility */
                    color: white;
                }
            </style>
            
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>User Role</th>
                                <th>Login Time</th>
                                <th>Page Visited</th>
                                <th>Visit Time</th>
                                <th>IP Address</th>
                                <th>Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($activities as $activity): ?>
                                <tr>
                                    <td><?= htmlspecialchars($activity['user_id']) ?></td>
                                    <td><?= htmlspecialchars($activity['username']) ?></td>
                                    <td><?= htmlspecialchars($activity['user_role']) ?></td>
                                    <td><?= htmlspecialchars($activity['login_time']) ?></td>
                                    <td><?= htmlspecialchars($activity['page_visited']) ?></td>
                                    <td><?= htmlspecialchars($activity['visit_time']) ?></td>
                                    <td><?= htmlspecialchars($activity['ip_address']) ?></td>
                                    <td><?= htmlspecialchars($activity['location']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'footer.php'; // Include footer ?>
