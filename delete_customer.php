<?php
include './root/process.php'; // Include your database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepare the delete statement
    $stmt = $dbh->prepare("DELETE FROM customers WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the burial records page
        header("Location: customer_management.php?status=success&message=customer deleted successfully.");
        exit;
    } else {
        // Redirect back with error message
        header("Location: customer_management.php?status=error&Error+deleting+customer");
        exit;
    }
} else {
    header("Location: customer_management.php");
    exit;
}
?>