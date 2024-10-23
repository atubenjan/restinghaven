<?php
include './root/process.php'; // Include your database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepare the delete statement
    $stmt = $dbh->prepare("DELETE FROM inventory WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: document_management.php?status=success&message=document deletion was successful");
        exit();
     } else {
         header("Location: document_management.php?status=error&message=document deletion failed");
         exit();
     }
} else {
    header("Location: document_management.php");
    exit();
}
?>