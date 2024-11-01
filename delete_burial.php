<?php
include './root/process.php'; // Include your database connection

if (isset($_GET['burial_id'])) {
    $id = $_GET['burial_id'];
    
    // Prepare the delete statement
    $stmt = $dbh->prepare("DELETE FROM burial_records WHERE burial_id = :burial_id");
    $stmt->bindParam(':burial_id', $id, PDO::PARAM_STR);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the burial records page
        header("Location: burial_records.php?status=success&message=Record+deleted+successfully");
        exit;
    } else {
        // Redirect back with error message
        header("Location: burial_records.php?status=error&message=Error+deleting+record");
        exit;
    }
} else {
    header("Location: burial_records.php");
    exit;
}
?>