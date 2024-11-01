<?php
include './root/process.php';
if (isset($_GET['deceased_id'])) {
    $deceased_id = $_GET['deceased_id'];

    // Prepare the DELETE statement
    $stmt = $dbh->prepare("DELETE FROM deceased_records WHERE deceased_id = :deceased_id");
    $stmt->bindParam(':deceased_id', $deceased_id, PDO::PARAM_STR);

    // Execute the statement and check if deletion was successful
    if ($stmt->execute()) {
        // Redirect to the main page with a success message
        header("Location: deceased_records.php?status=success&message=Record deleted successfully");
        exit();
    } else {
        // Redirect to the main page with an error message
        header("Location: deceased_records.php?status=error&message=Error deleting record");
        exit();
    }
} else {
    // Redirect to the main page with an error message if no ID is provided
    header("Location: deceased_records.php?status=error&message=Invalid ID");
    exit();
}
?>