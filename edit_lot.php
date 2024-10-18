<?php
include './root/process.php';


if (isset($_POST['edit_grave_btn'])) {
    $cemetery_id = $_POST['cemetery_id'];
    $plot_number = $_POST['plot_number'];
    $size = $_POST['size'];
    $availability_status = $_POST['availability_status'];
    $section_name = $_POST['section_name'];
    $price = $_POST['price'];
    $coordinates = $_POST['coordinates'];

    // Prepare SQL update statement
    $stmt = $dbh->prepare("UPDATE grave_management SET plot_number = ?, size = ?, availability_status = ?, section_name = ?, price = ?, coordinates = ? WHERE cemetery_id = ?");
    $stmt->execute([$plot_number, $size, $availability_status, $section_name, $price, $coordinates, $cemetery_id]);

    // Redirect or display success message
    header("Location: grave_management.php?success=Record updated successfully");
    exit();
}
?>
