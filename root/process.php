<?php
include "config.php";
include './root/vendor/autoload.php';

$api_key = "TQx3th8uR2R8I8o8858HUos2f37c81Smw1I0DQ470a7b3rk4E3U33GN5cm7L3AHz";

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

if (isset($_POST['login_btn'])) {
    trim(extract($_POST));

    $encrypt_password = sha1($password);
    $result = $dbh->query("SELECT * FROM users WHERE email = '$email' AND password = '$encrypt_password'");
    if ($result->rowCount() == 1) {
        $rows = $result->fetch(PDO::FETCH_OBJ);

        $_SESSION['id'] = $rows->id;
        $_SESSION['username'] = $rows->username;
        $_SESSION['email'] = $rows->email;
        $_SESSION['user_role'] = $rows->user_role;

        echo "
            <script>
                alert('Login Successful...');
                window.location.href = '".SITE_URL."';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Invalid email or password');
                window.location.href = window.location.href;
            </script>
        ";
    }
} elseif (isset($_POST['register_btn'])) {
    trim(extract($_POST));

    $filename = trim($_FILES['photo']['name']);
    $chk = rand(1111111111111, 9999999999999);
    $ext = strrchr($filename, ".");
    $photo = $chk . $ext;
    $target_img = "./uploads/" . $photo;
    $url = SITE_URL . '/uploads/' . $photo;

    $check = $dbh->query("SELECT username, email FROM users WHERE username = '$username' OR email ='$email' OR national_id = '$national_id'")->fetchColumn();
    if (!$check) {
        $encrypt_password = sha1($password);
        $result = dbCreate("INSERT INTO users VALUES(NULL, '$username', '$email', '$national_id', '$user_role', '$encrypt_password', '$url', NULL, NULL)");
        if ($result == 1) {
            move_uploaded_file($_FILES['photo']['tmp_name'], $target_img);
            $_SESSION['status'] = '<div class="alert alert-success text-center">You have Successfully registered</div>';
            $_SESSION['loader'] = '<center><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></center>';
            echo '
                <script>
                    alert("User registered successfully");
                    window.location.href = window.location.href;
                </script>
            ';
        } else {
            echo '
                <script>
                    alert("User registration failed");
                    window.location.href = window.location.href;
                </script>
            ';
        }
    } else {
        $_SESSION['status'] = '<div class="alert alert-danger text-center">Username already exists</div>';
    }
} elseif (isset($_POST['edit_user_btn'])) {
    trim(extract($_POST));

    $filename = trim($_FILES['photo']['name']);
    $chk = rand(1111111111111, 9999999999999);
    $ext = strrchr($filename, ".");
    $photo = $chk . $ext;
    $target_img = "./uploads/" . $photo;
    $url = SITE_URL . '/uploads/' . $photo;

    $url_img = $url !== '' ? $url : $oldphoto;

    $result = $dbh->query("UPDATE users SET username='$username', email='$email', national_id='$national_id', user_role='$user_role', photo='$url_img' WHERE id = '$id'");
    if ($result) {
        move_uploaded_file($_FILES['photo']['tmp_name'], $target_img);
        $_SESSION['status'] = '<div class="alert alert-success text-center">User edited successfully</div>';
        echo '
            <script>
                alert("User edited successfully");
                window.location.href = window.location.href;
            </script>
        ';
    } else {
        echo '
            <script>
                alert("User edit failed");
                window.location.href = window.location.href;
            </script>
        ';
    }
} elseif (isset($_POST['add_appointment_btn'])) {
    trim(extract($_POST));

    // Insert into appointments
    $result = dbCreate("INSERT INTO appointments VALUES(NULL, '$fullname', '$date', '$time', '$reason', '$asigned_to')");
    if ($result == 1) {
        echo '
            <script>
                alert("Appointment added successfully");
                window.location.href = window.location.href;
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Appointment addition failed");
                window.location.href = window.location.href;
            </script>
        ';
    }
} elseif (isset($_POST['add_supplier_btn'])) {
    trim(extract($_POST));

    // Insert data into the database
    $result = dbCreate("INSERT INTO suppliers (id, supplier_name, contact_person, contact_email, contact_phone, address, status, date_added) VALUES (NULL, '$supplier_name', '$contact_person', '$contact_email', '$contact_phone', '$address', '$status', '$date_added')");

    // Check the result and provide feedback
    if ($result == 1) {
        echo '
            <script>
                alert("Supplier added successfully");
                window.location.href = window.location.href;
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Supplier addition failed");
                window.location.href = window.location.href;
            </script>
        ';
    }
} elseif (isset($_POST['add_inventory_btn'])) {
    // Debugging: Display form data
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';

    // Trim and extract form values
    trim(extract($_POST));

    // Prepare SQL query
    $query = "INSERT INTO inventory (id, product_name, product_code, category, description, quantity, unit_of_measurement, reorder_level, supplier_id, cost_per_unit, total_cost, status, date_added) 
              VALUES (NULL, '$product_name', '$product_code', '$category', '$description', $quantity, '$unit_of_measurement', $reorder_level, $supplier_id, $cost_per_unit, $total_cost, '$status', '$date_added')";

    // Insert into the inventory table
    $result = dbCreate($query);

    // Check the result and provide feedback
    if ($result) {
        echo '
            <script>
                alert("Inventory item added successfully");
                window.location.href = window.location.href;
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Failed to add inventory item");
            </script>
        ';
    }


} elseif (isset($_POST['edit_supplier_btn'])) {
   
    
        trim(extract($_POST));
        
        
        // Update query
        $result = $dbh->query("UPDATE suppliers SET 
            supplier_name='$supplier_name', 
            contact_person='$contact_person', 
            contact_email='$contact_email', 
            contact_phone='$contact_phone', 
            address='$address', 
            status='$status', 
            date_added='$date_added' 
            WHERE id='$id'");
        
        if ($result) {
            echo '
                <script>
                    alert("Supplier edited successfully");
                    window.location.href = window.location.href;
                </script>
            ';
        } else {
            echo '
                <script>
                    alert("Supplier edit failed");
                    window.location.href = window.location.href;
                </script>
            ';
        }
    }
    
?>
