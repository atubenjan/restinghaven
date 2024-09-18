<?php
session_start();

// Check if there is an error message
$errorMessage = isset($_SESSION['error']) ? $_SESSION['error'] : '';

unset($_SESSION['error']); // Clear the error message after displaying it
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link rel="stylesheet" href="path/to/bootstrap.min.css">
    <style>
        .error-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .alert {
            max-width: 600px;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($errorMessage); ?>
        </div>
    </div>
</body>
</html>
