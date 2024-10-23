<?php
include './root/process.php'; // Include your database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepare the delete statement
    $stmt = $dbh->prepare("DELETE FROM sales WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the burial records page
        header("Location: sales.php?status=success&message=sales record+deleted+successfully");
        exit;
    } else {
        // Redirect back with error message
        header("Location: sales.php?status=error&message=Error+deleting+sales record");
        exit;
    }
} else {
    header("Location: sales.php");
    exit;
}
?>