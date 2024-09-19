<?php
include './root/process.php'; // Include your database connection file

// Check if the ID parameter is provided
if (isset($_POST['id'])) {
    // Get the ID from POST data
    $id = intval($_POST['id']); // Ensure it's an integer for security

    try {
        // Prepare and execute the SQL statement
        $stmt = $dbh->prepare("SELECT * FROM deceased_records WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Fetch the record
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($record) {
            // Prepare the HTML for the modal
            $html = '<div class="container">';
            $html .= '<div class="row">';
            $html .= '<div class="col-md-12">';
            $html .= '<p><strong>Name:</strong> ' . htmlspecialchars($record['name'], ENT_QUOTES, 'UTF-8') . '</p>';
            $html .= '<p><strong>Date of Birth:</strong> ' . htmlspecialchars($record['date_of_birth'], ENT_QUOTES, 'UTF-8') . '</p>';
            $html .= '<p><strong>Date of Death:</strong> ' . htmlspecialchars($record['date_of_death'], ENT_QUOTES, 'UTF-8') . '</p>';
            $html .= '<p><strong>Time of Death:</strong> ' . htmlspecialchars($record['time_of_death'], ENT_QUOTES, 'UTF-8') . '</p>';
            $html .= '<p><strong>Cause of Death:</strong> ' . htmlspecialchars($record['cause_of_death'], ENT_QUOTES, 'UTF-8') . '</p>';
            $html .= '<p><strong>Plot Number:</strong> ' . htmlspecialchars($record['plot_number'], ENT_QUOTES, 'UTF-8') . '</p>';
            $html .= '<p><strong>Family Lineage:</strong> ' . htmlspecialchars($record['family_lineage'], ENT_QUOTES, 'UTF-8') . '</p>';
            $html .= '<p><strong>Spouse:</strong> ' . htmlspecialchars($record['spouse'], ENT_QUOTES, 'UTF-8') . '</p>';
            $html .= '<p><strong>Origin:</strong> ' . htmlspecialchars($record['origin'], ENT_QUOTES, 'UTF-8') . '</p>';
            $html .= '<p><strong>Age at Death:</strong> ' . htmlspecialchars($record['age_at_death'], ENT_QUOTES, 'UTF-8') . '</p>';
            $html .= '<p><strong>Gender:</strong> ' . htmlspecialchars($record['gender'], ENT_QUOTES, 'UTF-8') . '</p>';
            $html .= '<p><strong>Place of Birth:</strong> ' . htmlspecialchars($record['place_of_birth'], ENT_QUOTES, 'UTF-8') . '</p>';
            $html .= '<p><strong>Place of Death:</strong> ' . htmlspecialchars($record['place_of_death'], ENT_QUOTES, 'UTF-8') . '</p>';
            $html .= '<p><strong>Nationality/Ethnicity:</strong> ' . htmlspecialchars($record['nationality'], ENT_QUOTES, 'UTF-8') . '</p>';
            $html .= '<p><strong>Occupation:</strong> ' . htmlspecialchars($record['occupation'], ENT_QUOTES, 'UTF-8') . '</p>';
            if ($record['file']) {
                $html .= '<p><strong>File/Photo:</strong> <a href="uploads/' . htmlspecialchars($record['file'], ENT_QUOTES, 'UTF-8') . '" target="_blank">View File</a></p>';
            }
            $html .= '<p><strong>Remarks:</strong> ' . htmlspecialchars($record['remarks'], ENT_QUOTES, 'UTF-8') . '</p>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';

            echo $html;
        } else {
            echo '<p>No record found for the provided ID.</p>';
        }

    } catch (PDOException $e) {
        echo '<p>An error occurred while fetching the details: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>';
    }
} else {
    echo '<p>ID parameter is missing.</p>';
}
?>
