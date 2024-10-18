<?php
include './root/process.php';

if (isset($_GET['id'])) {
    $cemeteryId = $_GET['id'];  // Use 'cemetery_id' as the identifier

    try {
        // Prepare the delete statement using the correct column name 'cemetery_id'
        $stmt = $dbh->prepare("DELETE FROM grave_management WHERE cemetery_id = :cemeteryId");
        $stmt->bindParam(':cemeteryId', $cemeteryId, PDO::PARAM_INT);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the grave management page with a success message
            header("Location: grave_management.php?message=Lot deleted successfully");
            exit();
        } else {
            echo "Error: Unable to delete the lot.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Error: No ID specified.";
}
?>
