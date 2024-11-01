<?php
include './root/process.php';
if (isset($_GET['cemetery_id'])) {
    $cemetery_id = $_GET['cemetery_id'];

    // Prepare the DELETE statement
    $stmt = $dbh->prepare("DELETE FROM grave_management WHERE cemetery_id = :cemetery_id");
    $stmt->bindParam(':cemetery_id', $cemetery_id, PDO::PARAM_STR);

    // Execute the statement and check if deletion was successful
    if ($stmt->execute()) {
        // Redirect to the main page with a success message
        header("Location: grave_management.php?status=success&message=Record deleted successfully");
        exit();
    } else {
        // Redirect to the main page with an error message
        header("Location: grave_management.php?status=error&message=Error deleting record");
        exit();
    }
} else {
    // Redirect to the main page with an error message if no ID is provided
    header("Location: grave_management.php?status=error&message=Invalid ID");
    exit();
}
?>