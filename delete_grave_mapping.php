<?php
include './root/process.php'; // Include your database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepare the delete statement
    $stmt = $dbh->prepare("DELETE FROM grave_mapping WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: grave_mapping.php?status=success&message=Grave mapping record deletion was successful");
        exit();
     } else {
         header("Location: grave_mapping.php?status=error&message=Grave mapping record deletion failed");
         exit();
     }
} else {
    header("Location: grave_mapping.php");
    exit();
}
?>