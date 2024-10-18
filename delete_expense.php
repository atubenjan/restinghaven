<?php

include './root/process.php';
// Check if delete request is sent
if (isset($_GET['deleteProduct'])) {
    $id = $_GET['deleteProduct'];

    // Prepare the DELETE statement
    $stmt = $dbh->prepare("DELETE FROM expenses WHERE id = :id");
    $stmt->bindParam(':id', $id);
    
    // Execute the statement and check if deletion was successful
    if ($stmt->execute()) {
        echo "<script>alert('Expense deleted successfully.'); window.location='expenses.php';</script>";
    } else {
        echo "<script>alert('Error deleting expense.');</script>";
    }
}
?>
