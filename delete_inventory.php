<?php
include './root/process.php'; // Include your database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepare the delete statement
    $stmt = $dbh->prepare("DELETE FROM inventory WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: inventory.php?status=success&message=inventory deletion was successful");
        exit();
     } else {
         header("Location: inventory.php?status=error&message=inventory deletion failed");
         exit();
     }
} else {
    header("Location: inventory.php");
    exit();
}
?>