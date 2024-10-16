<?php
include './root/process.php';
if (isset($_GET['id'])) {
    $deceased_id = $_GET['id'];

    // Prepare the DELETE statement
    $stmt = $dbh->prepare("DELETE FROM deceased_records WHERE deceased_id = :deceased_id");
    $stmt->bindParam(':deceased_id', $deceased_id, PDO::PARAM_STR);

    // Execute the statement and check if deletion was successful
    if ($stmt->execute()) {
        // Redirect to the main page with a success message
        header("Location: deceased_records.php?message=Record deleted successfully");
        exit();
    } else {
        // Redirect to the main page with an error message
        header("Location: deceased_records.php?message=Error deleting record");
        exit();
    }
} else {
    // Redirect to the main page with an error message if no ID is provided
    header("Location: deceased_records.php?message=Invalid ID");
    exit();
}
?>