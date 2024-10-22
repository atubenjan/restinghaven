<?php
include './root/process.php'; // Include your database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepare the delete statement
    $stmt = $dbh->prepare("DELETE FROM grave_management WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the burial records page
        header("Location: grave_management.php?status=success&message=grave-details deleted successfully.");
        exit;
    } else {
        // Redirect back with error message
        header("Location: grave_management.php?status=error&Error+deleting+grave-details");
        exit;
    }
} else {
    header("Location: grave_management.php");
    exit;
}
?>