<?php
// delete_work_order.php
include './root/process.php';

;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Delete query
    $stmt = $dbh->prepare("DELETE FROM work_orders WHERE id = ?");
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
        // Success, redirect to work orders page
        header('Location: work_orders.php?delete_success=1');
    } else {
        // Failure, redirect with error
        header('Location: work_orders.php?delete_error=1');
    }
}
?>
