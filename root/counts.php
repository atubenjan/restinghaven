<?php
require "config.php";
  // require "./root/config.php";

// Count burial records and store in $total_burial_records
$total_burial_records = countBurialRecords();

function countBurialRecords() {
    global $dbh; // Use the global PDO database handler (ensure it's defined)
    $query = "SELECT COUNT(*) as total FROM burial_records"; // Adjust the table name if needed
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total']; // Return the total count
}


// Count appointment records and store in $appointmentCount
$appointmentCount = countAppointments(); 

function countAppointments() {
    global $dbh; // Use the global PDO database handler (make sure it's defined)
    $query = "SELECT COUNT(*) as total FROM appointments"; // Adjust the table name if necessary
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total']; // Return the total count
}

// Count deceased records and store in $deceasedCount
$deceasedCount = countDeceasedRecords();

function countDeceasedRecords() {
    global $dbh; // Use the global PDO database handler (make sure it's defined)
    $query = "SELECT COUNT(*) as total FROM deceased_records"; // Adjust the table name if needed
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total']; // Return the total count
}

$customerCount = countCustomerRecords(); 

function countCustomerRecords() {
    global $dbh; // Use the global PDO database handler (ensure it's defined)
    $query = "SELECT COUNT(*) as total FROM customers"; // Adjust table name as needed
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total']; // Return the total count
}
$total_work_orders = countWorkOrders();

function countWorkOrders() {
    global $dbh; // Use the global PDO database handler (ensure it's defined)
    $query = "SELECT COUNT(*) as total FROM work_orders"; // Adjust the table name if needed
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total']; // Return the total count
}
// Count expenses and store in $total_expenses
$total_expenses = countExpenses();

function countExpenses() {
    global $dbh; // Use the global PDO database handler
    $query = "SELECT COUNT(*) as total FROM expenses"; // Adjust the table name as needed
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total']; // Return the total count
}
// Count sales and store in $total_sales
$total_sales = countSales();

function countSales() {
    global $dbh; // Use the global PDO database handler
    $query = "SELECT COUNT(*) as total FROM sales"; // Adjust the table name as needed
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total']; // Return the total count
}
// Count suppliers and store in $total_suppliers
$total_suppliers = countSuppliers();

function countSuppliers() {
    global $dbh; // Use the global PDO database handler
    $query = "SELECT COUNT(*) as total FROM suppliers"; // Adjust the table name as needed
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total']; // Return the total count
}
// Count inventory items and store in $total_inventory
$total_inventory = countInventory();

function countInventory() {
    global $dbh; // Use the global PDO database handler
    $query = "SELECT COUNT(*) as total FROM inventory"; // Adjust the table name as needed
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total']; // Return the total count
}
// Count user records and store in $total_users
$total_users = countUsers();

function countUsers() {
    global $dbh; // Use the global PDO database handler
    $query = "SELECT COUNT(*) as total FROM users"; // Adjust the table name as needed
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total']; // Return the total count
}

?>