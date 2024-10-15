<?php
include './root/process.php';
if (isset($_GET['id'])) {
    $plotId = $_GET['id'];

    try {
        // Prepare the delete statement
        $stmt = $dbh->prepare("DELETE FROM grave_management WHERE Plot_ID = :plotId");
        $stmt->bindParam(':plotId', $plotId, PDO::PARAM_INT);
        
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
