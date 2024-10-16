php

<?php
include './root/process.php';

if (isset($_GET['id'])) {
    // Get the customer ID from the URL
    $customer_id = intval($_GET['id']);
    
    // Prepare the SQL statement to delete the customer
    $stmt = $dbh->prepare("DELETE FROM customers WHERE id = :id");
    $stmt->bindParam(':id', $customer_id, PDO::PARAM_INT);
    
    // Execute the query
    if ($stmt->execute()) {
        // Redirect to customer management page with a success message
        header("Location: customer_management.php?message=Customer deleted successfully");
        exit();
    } else {
        // Redirect to customer management page with an error message
        header("Location: customer_management.php?message=Error deleting customer");
        exit();
    }
} else {
    // Redirect if no ID is provided
    header("Location: customer_management.php");
    exit();
}
?>
