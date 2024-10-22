<?php
include './root/process.php'; // Include your database connection

if (isset($_GET['branch_id'])) {
    $branch_id = $_GET['branch_id'];
    
    // Prepare the delete statement
    $stmt = $dbh->prepare("DELETE FROM branch WHERE branch_id = :branch_id");
    $stmt->bindParam(':branch_id', $branch_id, PDO::PARAM_INT);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the burial records page
        header("Location: branch.php?status=success&message=Branch deleted successfully.");
        exit;
    } else {
        // Redirect back with error message
        header("Location: branch.php?status=error&Error+deleting+branch");
        exit;
    }
} else {
    header("Location: branch.php");
    exit;
}
?>