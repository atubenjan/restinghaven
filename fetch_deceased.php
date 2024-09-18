<?php
include './process.php'; // Include database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $dbh->prepare("SELECT * FROM deceased_records WHERE id = ?");
        $stmt->execute([$id]);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($record) {
            foreach ($record as $key => $value) {
                echo "<p><strong>" . htmlspecialchars(ucwords(str_replace('_', ' ', $key))) . ":</strong> " . htmlspecialchars($value) . "</p>";
            }
        } else {
            echo "<p>No details found for this record.</p>";
        }
    } catch (PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p>Invalid request.</p>";
}
?>