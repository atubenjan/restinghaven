<?php
include './root/process.php'; // Include your database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepare the delete statement
    $stmt = $dbh->prepare("DELETE FROM expenses WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: expense.php?status=success&message=expense deletion was successful");
        exit();
     } else {
         header("Location: expense.php?status=error&message=expense deletion failed");
         exit();
     }
} else {
    header(Location: "expense.php");
    exit();
}
?>