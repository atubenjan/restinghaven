<?php
require "config.php";
include './root/vendor/autoload.php';

$api_key = "TQx3th8uR2R8I8o8858HUos2f37c81Smw1I0DQ470a7b3rk4E3U33GN5cm7L3AHz";

// Enable error reporting and set a custom error handler
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function customError($errno, $errstr, $errfile, $errline) {
    $errorMessage = "Error: [$errno] $errstr in $errfile on line $errline";
    $_SESSION['error'] = $errorMessage; // Store error in session
    header("Location: error_page.php"); // Redirect to error page
    exit();
}
set_error_handler("customError");


// Login process
if (isset($_POST['login_btn'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $encrypt_password = sha1($password);

    $result = dbQuery("SELECT * FROM users WHERE email = :email AND password = :password", [
        ':email' => $email,
        ':password' => $encrypt_password
    ]);

    if ($result->rowCount() == 1) {
        $rows = $result->fetch(PDO::FETCH_OBJ);

        $_SESSION['id'] = $rows->id;
        $_SESSION['username'] = $rows->username;
        $_SESSION['email'] = $rows->email;
        $_SESSION['user_role'] = $rows->user_role;

        echo "<script>
            alert('Login Successful...');
            window.location.href = '".SITE_URL."';
        </script>";
    } else {
        echo "<script>
            alert('Invalid email or password');
            window.location.href = window.location.href;
        </script>";
    }
}

// User Registration
elseif (isset($_POST['register_btn'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $national_id = trim($_POST['national_id']);
    $user_role = trim($_POST['user_role']);
    $password = trim($_POST['password']);
    $encrypt_password = sha1($password);

    $filename = isset($_FILES['photo']['name']) ? trim($_FILES['photo']['name']) : '';
    $photo = '';
    if ($filename) {
        $chk = rand(1111111111111, 9999999999999);
        $ext = strrchr($filename, ".");
        $photo = $chk . $ext;
        $target_img = "./uploads/" . $photo;
        $url = SITE_URL . '/uploads/' . $photo;
    }

    $check = dbQuery("SELECT username, email FROM users WHERE username = :username OR email = :email OR national_id = :national_id", [
        ':username' => $username,
        ':email' => $email,
        ':national_id' => $national_id
    ])->fetchColumn();

    if (!$check) {
        
        $result = dbCreate("INSERT INTO users (username, email, national_id, user_role, password, photo) VALUES (:username, :email, :national_id, :user_role, :password, :photo)", [
            ':username' => $username,
            ':email' => $email,
            ':national_id' => $national_id,
            ':user_role' => $user_role,
            ':password' => $encrypt_password,
            ':photo' => $photo ? $url : ''
        ]);

        if ($result == 1) {
            if ($photo) {
                move_uploaded_file($_FILES['photo']['tmp_name'], $target_img);
            }
            $_SESSION['status'] = '<div class="alert alert-success text-center">You have Successfully registered</div>';
            $_SESSION['loader'] = '<center><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></center>';
            echo "<script>
                alert('User registered successfully');
                window.location.href = window.location.href;
            </script>";
        } else {
            echo "<script>
                alert('User registration failed');
                window.location.href = window.location.href;
            </script>";
        }
    } else {
        $_SESSION['status'] = '<div class="alert alert-danger text-center">Username or email already exists</div>';
    }
}

// Edit User
elseif (isset($_POST['edit_user_btn'])) {
    $id = trim($_POST['id']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $national_id = trim($_POST['national_id']);
    $user_role = trim($_POST['user_role']);
    $oldphoto = trim($_POST['oldphoto']);

    $filename = isset($_FILES['photo']['name']) ? trim($_FILES['photo']['name']) : '';
    $photo = '';
    if ($filename) {
        $chk = rand(1111111111111, 9999999999999);
        $ext = strrchr($filename, ".");
        $photo = $chk . $ext;
        $target_img = "./uploads/" . $photo;
        $url = SITE_URL . '/uploads/' . $photo;
        $url_img = $url;
    } else {
        $url_img = $oldphoto;
    }

    $result = dbCreate("UPDATE users SET username = :username, email = :email, national_id = :national_id, user_role = :user_role, photo = :photo WHERE id = :id", [
        ':username' => $username,
        ':email' => $email,
        ':national_id' => $national_id,
        ':user_role' => $user_role,
        ':photo' => $url_img,
        ':id' => $id
    ]);

    if ($result) {
        if ($filename) {
            move_uploaded_file($_FILES['photo']['tmp_name'], $target_img);
        }
        $_SESSION['status'] = '<div class="alert alert-success text-center">User edited successfully</div>';
        echo "<script>
            alert('User edited successfully');
            window.location.href = window.location.href;
        </script>";
    } else {
        echo "<script>
            alert('User edit failed');
            window.location.href = window.location.href;
        </script>";
    }
}



// Add Appointment
elseif (isset($_POST['add_appointment_btn'])) {
    $fullname = trim($_POST['fullname']);
    $date = trim($_POST['date']);
    $time = trim($_POST['time']);
    $reason = trim($_POST['reason']);
    $assigned_to = trim($_POST['assigned_to']);

    $sql = "INSERT INTO appointments (fullname, date, time, reason, assigned_to) VALUES (:fullname, :date, :time, :reason, :assigned_to)";
    $params = [
        ':fullname' => $fullname,
        ':date' => $date,
        ':time' => $time,
        ':reason' => $reason,
        ':assigned_to' => $assigned_to
    ];

    try {
        $result = dbCreate($sql, $params);

        if ($result == 1) {
            echo "<script>
                alert('Appointment added successfully');
                window.location.href = window.location.href;
            </script>";
        } else {
            echo "<script>
                alert('Appointment addition failed');
                window.location.href = window.location.href;
            </script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}



// Add Supplier
elseif (isset($_POST['add_supplier_btn'])) {
    $supplier_name = trim($_POST['supplier_name']);
    $contact_person = trim($_POST['contact_person']);
    $contact_email = trim($_POST['contact_email']);
    $contact_phone = trim($_POST['contact_phone']);
    $address = trim($_POST['address']);
    $status = trim($_POST['status']);
    $date_added = trim($_POST['date_added']);
  
    $result = dbCreate("INSERT INTO suppliers (supplier_name, contact_person, contact_email, contact_phone, address, status, date_added) 
                        VALUES (:supplier_name, :contact_person, :contact_email, :contact_phone, :address, :status, :date_added)", [
        ':supplier_name' => $supplier_name,
        ':contact_person' => $contact_person,
        ':contact_email' => $contact_email,
        ':contact_phone' => $contact_phone,
        ':address' => $address,
        ':status' => $status,
        ':date_added' => $date_added
    ]);

    if ($result == 1) {
        echo "<script>
            alert('Supplier added successfully');
            window.location.href = window.location.href;
        </script>";
    } else {
        echo "<script>
            alert('Supplier addition failed');
            window.location.href = window.location.href;
        </script>";
    }
}

// Add Inventory
// Add Inventory
elseif (isset($_POST['add_inventory_btn'])) {
    // Safely assign and trim POST values
    $product_name = trim($_POST['product_name']);
    $product_code = trim($_POST['product_code']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);
    $quantity = trim($_POST['quantity']);
    $unit_of_measurement = trim($_POST['unit_of_measurement']);
    $reorder_level = trim($_POST['reorder_level']);
    $supplier_id = isset($_POST['supplier_id']) ? trim($_POST['supplier_id']) : null; // Safe assignment
    $cost_per_unit = trim($_POST['cost_per_unit']);
    $total_cost = trim($_POST['total_cost']);
    $status = trim($_POST['status']);
    $date_added = isset($_POST['date_added']) ? trim($_POST['date_added']) : null; // Safe assignment

    // Now proceed with the database query
    $result = dbCreate("INSERT INTO inventory (product_name, product_code, category, description, quantity, unit_of_measurement, reorder_level, supplier_id, cost_per_unit, total_cost, status, date_added) VALUES (:product_name, :product_code, :category, :description, :quantity, :unit_of_measurement, :reorder_level, :supplier_id, :cost_per_unit, :total_cost, :status, :date_added)", [
        ':product_name' => $product_name,
        ':product_code' => $product_code,
        ':category' => $category,
        ':description' => $description,
        ':quantity' => $quantity,
        ':unit_of_measurement' => $unit_of_measurement,
        ':reorder_level' => $reorder_level,
        ':supplier_id' => $supplier_id,
        ':cost_per_unit' => $cost_per_unit,
        ':total_cost' => $total_cost,
        ':status' => $status,
        ':date_added' => $date_added // Use the safe assignment
    ]);

    if ($result == 1) {
        echo "<script>
            alert('Inventory added successfully');
            window.location.href = window.location.href;
        </script>";
    } else {
        echo "<script>
            alert('Inventory addition failed');
            window.location.href = window.location.href;
        </script>";
    }
}
//Insert into Lot_ Managemt 
elseif (isset($_POST['add_lot_btn'])) {
    // Safely assign and trim POST values
    $section = trim($_POST['section']);
    $lot_number = trim($_POST['lot_number']);
    $location = trim($_POST['location']);
    $status = trim($_POST['status']);
    $date_added = isset($_POST['date_added']) ? trim($_POST['date_added']) : null; // Safe assignment for date if provided

    // Proceed with the database query
    $result = dbCreate("INSERT INTO lot_management (section, lot_number, location, status, date_added) VALUES (:section, :lot_number, :location, :status, :date_added)", [
        ':section' => $section,
        ':lot_number' => $lot_number,
        ':location' => $location,
        ':status' => $status,
        ':date_added' => $date_added // Use the safe assignment for date if provided
    ]);

    if ($result == 1) {
        echo "<script>
            alert('Lot added successfully');
            window.location.href = window.location.href;
        </script>";
    } else {
        echo "<script>
            alert('Lot addition failed');
            window.location.href = window.location.href;
        </script>";
    }
}
// add deceased recored
elseif (isset($_POST['add_deceased_btn'])) {
    // Safely assign and trim POST values
    $name = trim($_POST['name']);
    $date_of_birth = trim($_POST['date_of_birth']);
    $date_of_death = trim($_POST['date_of_death']);
    $time_of_death = trim($_POST['time_of_death']);
    $cause_of_death = trim($_POST['cause_of_death']);
    $plot_number = trim($_POST['plot_number']);
    $family_lineage = trim($_POST['family_lineage']);
    $spouse = trim($_POST['spouse']);
    $origin = trim($_POST['origin']);
    $place_of_birth = trim($_POST['place_of_birth']);
    $place_of_death = trim($_POST['place_of_death']);
    $nationality = trim($_POST['nationality']); // Update to match the column name in the database
    $occupation = trim($_POST['occupation']);
    $remarks = trim($_POST['remarks']);
    $files = isset($_FILES['file']['name']) ? $_FILES['file']['name'] : null; // Handle file uploads

    // Proceed with the database query
    $result = dbCreate("INSERT INTO deceased_records (name, date_of_birth, date_of_death, time_of_death, cause_of_death, plot_number, family_lineage, spouse, origin, place_of_birth, place_of_death, nationality, occupation, remarks, files) VALUES (:name, :date_of_birth, :date_of_death, :time_of_death, :cause_of_death, :plot_number, :family_lineage, :spouse, :origin, :place_of_birth, :place_of_death, :nationality, :occupation, :remarks, :files)", [
        ':name' => $name,
        ':date_of_birth' => $date_of_birth,
        ':date_of_death' => $date_of_death,
        ':time_of_death' => $time_of_death,
        ':cause_of_death' => $cause_of_death,
        ':plot_number' => $plot_number,
        ':family_lineage' => $family_lineage,
        ':spouse' => $spouse,
        ':origin' => $origin,
        ':place_of_birth' => $place_of_birth,
        ':place_of_death' => $place_of_death,
        ':nationality' => $nationality, // Make sure this column name exists in the database
        ':occupation' => $occupation,
        ':remarks' => $remarks,
        ':files' => $files
    ]);

    if ($result == 1) {
        echo "<script>
            alert('Deceased record added successfully');
            window.location.href = window.location.href;
        </script>";
    } else {
        echo "<script>
            alert('Deceased record addition failed');
            window.location.href = window.location.href;
        </script>";
    }
}





// Add Work Order
elseif (isset($_POST['add_work_order_btn'])) {
    $order_number = trim($_POST['order_number']);
    $order_date = trim($_POST['order_date']);
    $customer_name = trim($_POST['customer_name']);
    $description = trim($_POST['description']);
    $status = trim($_POST['status']);
    $total_amount = trim($_POST['total_amount']);
    $created_by = trim($_POST['created_by']);

    $result = dbCreate("INSERT INTO work_orders (order_number, order_date, customer_name, description, status, total_amount, created_by) VALUES (:order_number, :order_date, :customer_name, :description, :status, :total_amount, :created_by)", [
        ':order_number' => $order_number,
        ':order_date' => $order_date,
        ':customer_name' => $customer_name,
        ':description' => $description,
        ':status' => $status,
        ':total_amount' => $total_amount,
        ':created_by' => $created_by
    ]);

    if ($result == 1) {
        echo "<script>
            alert('Work order added successfully');
            window.location.href = window.location.href;
        </script>";
    } else {
        echo "<script>
            alert('Work order addition failed');
            window.location.href = window.location.href;
        </script>";
    }
}
?>
