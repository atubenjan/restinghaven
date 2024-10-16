<?php
// delete_work_order.php
include './root/process.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Get the ID from the URL

    // Prepare the delete statement
    $stmt = $dbh->prepare("DELETE FROM work_orders WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        // Redirect back to the work order management page with a success message
        header("Location: work_orders.php?message=Deleted successfully");
        exit;
    } else {
        // Redirect back with an error message
        header("Location: work_orders.php?message=Error deleting work order");
        exit;
    }
} else {
    // Redirect back if ID is not set
    header("Location: work_orders.php?message=Invalid ID");
    exit;
}
