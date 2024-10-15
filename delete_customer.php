php

<?php
include './root/process.php';

// Check if the ID is set in the URL
if (isset($_GET['id'])) {
    $customerId = intval($_GET['id']); // Get the customer ID from the query string

    // Prepare a DELETE statement
    $stmt = $dbh->prepare("DELETE FROM customers WHERE id = :id");
    $stmt->bindParam(':id', $customerId, PDO::PARAM_INT);
    
    // Execute the statement and check if the deletion was successful
    if ($stmt->execute()) {
        // Redirect to the customer management page with a success message
        header("Location: customer_management.php?message=Customer+deleted+successfully");
        exit();
    } else {
        // Redirect with an error message
        header("Location: customer_management.php?error=Unable+to+delete+customer");
        exit();
    }
} else {
    // Redirect with an error message if no ID was provided
    header("Location: customer_management.php?error=No+customer+ID+provided");
    exit();
}
?>