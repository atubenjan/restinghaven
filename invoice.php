<?php
include './root/process.php';

if (!isset($_GET['id'])) {
    die('Invoice ID is missing.');
}

$sale_id = $_GET['id'];

$stmt = $dbh->prepare("SELECT s.*, c.name AS customer_name 
                        FROM sales s 
                        JOIN customers c ON s.customer_name = c.name 
                        WHERE s.id = :id");
$stmt->execute([':id' => $sale_id]);

$sale = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$sale) {
    die('Invoice not found.');
}

$customer_name = htmlspecialchars($sale['customer_name']);
$item_sold = htmlspecialchars($sale['item_sold']);
$quantity = htmlspecialchars($sale['quantity']);
$unit_price = htmlspecialchars($sale['unit_price']);
$total_price = htmlspecialchars($sale['total_price']);
$sale_date = htmlspecialchars($sale['sale_date']);
$description = htmlspecialchars($sale['description']);
$payment_method = htmlspecialchars($sale['payment_method']);
$payment_status = htmlspecialchars($sale['payment_status']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .invoice-container { max-width: 800px; margin: auto; padding: 20px; border: 1px solid #ccc; }
        .invoice-header { display: flex; justify-content: space-between; align-items: center; }
        .invoice-header img { width: 150px; }
        .invoice-details { margin-top: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        .table th { background-color: #f2f2f2; }
        .table .right-align { text-align: right; }
        .invoice-summary { margin-top: 20px; text-align: right; }
        .invoice-summary p { margin: 5px 0; }
        .print-button { margin-top: 20px; display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; border: none; cursor: pointer; }
        .print-button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <div>
                <h2>RESTING HAVEN CEMETERY</h2>
                <p>Kampala<br>Uganda <br>VAT Number: 1234457</p>
            </div>
            <div>
                <img src="./logo.jpg" alt="Company Logo">
                <h3>Invoice #<?= $sale_id; ?></h3>
                <p>Date: <?= $sale_date; ?></p>
                <p><strong>Amount Due:</strong> UGX<?= number_format($total_price, 2); ?></p>
            </div>
        </div>
        
        <div class="invoice-details">
            <p><strong>Customer Name:</strong> <?= $customer_name; ?></p>
            
        </div>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Description</th>
                    <th>Unit Cost</th>
                    <th>Quantity</th>
                    <th>Line Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $item_sold; ?></td>
                    <td><?= $description; ?></td>
                    <td class="right-align">UGX<?= number_format($unit_price, 2); ?></td>
                    <td class="right-align"><?= $quantity; ?></td>
                    <td class="right-align">UGX<?= number_format($total_price, 2); ?></td>
                </tr>
            </tbody>
        </table>

        <div class="invoice-summary">
            <p><strong>Subtotal:</strong> UGX<?= number_format($total_price, 2); ?></p>
            <p><strong>Discount:</strong> 10%</p>
            <p><strong>Total:</strong> UGX<?= number_format($total_price * 0.9, 2); ?></p>
        </div>

        <p>Please pay your invoice within 30 days of receiving it.</p>
        
        <p><strong>Terms</strong><br>These are our terms and conditions.</p>
        <p><strong>Notes</strong><br>Thank you for being our customer.</p>
        
        <button class="print-button" onclick="window.print()">Print Invoice</button>
    </div>
</body>
</html>