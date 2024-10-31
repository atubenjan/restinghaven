<?php
require "config.php";


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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve posted username and password
    $username = $_POST['username'] ?? ''; // Ensure it defaults to an empty string if not set
    $password = $_POST['password'] ?? ''; // Ensure it defaults to an empty string if not set

    // Fetch user from the database
    $stmt = $dbh->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, log in the user
        $_SESSION['id'] = $user['id'];
        $_SESSION['user_role'] = $user['user_role']; // Ensure role is set
        $_SESSION['fullname'] = $user['fullname']; // Any additional session variables
        $_SESSION['userid'] = $user['userid'];
        $_SESSION['date_registered'] = $user['date_registered'];

        // Log the login event
        $ip_address = $_SERVER['REMOTE_ADDR'];

        // Insert log into the database
        $logStmt = $dbh->prepare("INSERT INTO login_logs (username, ip_address, role) VALUES (:username, :ip_address, :role)");
        $logStmt->bindParam(':username', $username);
        $logStmt->bindParam(':ip_address', $ip_address);
        $logStmt->bindParam(':role', $_SESSION['role']); // Ensure role is set
        $logStmt->execute();

        // Redirect to the dashboard or another page
        header("Location: index.php"); // Change to your actual dashboard page
        exit();
    } 
}


/* // Login process
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
                window.location.href = '".SITE_URL."';
            </script>
        ";
    } else {
        header("Location: login.php?status=error&message=Invalid Login credentials");
        exit();
    }
} */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if login button was clicked
    if (isset($_POST['login_btn'])) {
        trim(extract($_POST));

        // Encrypt the password
        $encrypt_password = sha1($password);
        $result = $dbh->query("SELECT * FROM users WHERE email = '$email' AND password = '$encrypt_password'");

        if ($result->rowCount() == 1) {
            $rows = $result->fetch(PDO::FETCH_OBJ);

            // Store user details in session
            $_SESSION['id'] = $rows->id;
            $_SESSION['username'] = $rows->username;
            $_SESSION['email'] = $rows->email;
            $_SESSION['user_role'] = $rows->user_role;


        // Store these values in variables to use them later
        $userId = $rows->id;
        $username = $rows->username;
        $user_role = $rows->user_role; // Assigning the user role here

            // Track user activity
            $userId = $rows->id;
            $ipAddress = getUserIpAddress();
            $location = getLocationFromIp($ipAddress);
            $loginTime = date('Y-m-d H:i:s');
            $pageVisited = "login"; // Page visited

            // Insert user activity into the database
            $result = dbcreate("INSERT INTO user_activity (user_id, username, user_role, login_time, page_visited, visit_time, ip_address, location) VALUES (:user_id, :username, :user_role, :login_time, :page_visited, :visit_time, :ip_address, :location)",
            [
                ':user_id' => $userId,
                ':username' => $username,
                ':user_role' => $user_role,
                ':login_time' => $loginTime,
                ':page_visited' => $pageVisited,
                ':visit_time' => $loginTime,
                ':ip_address' => $ipAddress,
                ':location' => $location
            ]);

            // Redirect to the homepage
            if ($result == 1) {
                echo "
                    <script>
                        window.location.href = '".SITE_URL."';
                    </script>
                ";
            } else {
                header("Location: login.php?status=error&message=Failed to log activity.");
                exit();
            }
        } else {
            header("Location: login.php?status=error&message=Invalid Login credentials");
            exit();
        }
    }
}



elseif (isset($_POST['add_branch_btn'])) {
    // Sanitize input
    $branch_name = trim($_POST['branch_name']);
    $location = trim($_POST['location']);
    $branch_manager = trim($_POST['branch_manager']);
    $contact = trim($_POST['contact']);

    // Check for existing branch_name
    $check = $dbh->prepare("SELECT branch_name FROM branch WHERE branch_name = :branch_name");
    $check->bindParam(':branch_name', $branch_name);
    $check->execute();

    if ($check->rowCount() == 0) {
        // Fetch the last branch_id and generate a new one
        $stmt = $dbh->query("SELECT branch_id FROM branch ORDER BY branch_id DESC LIMIT 1");
        $last_branch = $stmt->fetch(PDO::FETCH_OBJ);

        if ($last_branch) {
            // Extract numeric part from last branch_id and increment it
            $last_id_num = (int) substr($last_branch->branch_id, 4); // Get the number part after 'BRHC'
            $new_id_num = $last_id_num + 1;
            $new_branch_id = 'BRHC' . str_pad($new_id_num, 4, '0', STR_PAD_LEFT); // Create new branch_id
        } else {
            // If no branch exists, start with 'BRHC0001'
            $new_branch_id = 'BRHC0001';
        }

        // Insert new branch with generated branch_id
        $stmt = $dbh->prepare("INSERT INTO branch (branch_id, branch_name, location, branch_manager, contact, date_created) VALUES (:branch_id, :branch_name, :location, :branch_manager, :contact, NOW())");
        $stmt->bindParam(':branch_id', $new_branch_id);
        $stmt->bindParam(':branch_name', $branch_name);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':branch_manager', $branch_manager);
        $stmt->bindParam(':contact', $contact);

        if ($stmt->execute()) {
            header("Location: branch.php?status=success&message=Branch Added successfully.");
            exit();
        } else {
            header("Location: branch.php?status=error&message=Branch addition failed.");
            exit();
        }
    } else {
        header("Location: branch.php?status=error&message=Branch exists already.");
        exit();
    }
}


// edit_branch
elseif (isset($_POST['edit_branch'])) {
    // Extract and trim all POST variables
    $branch_id = trim($_POST['branch_id']);
    $branch_name = trim($_POST['branch_name']);
    $branch_manager = trim($_POST['branch_manager']);
    $location = trim($_POST['location']);
    $contact = trim($_POST['contact']);

    // Sanitize input
    $branch_name = addslashes($branch_name);
    $branch_manager = addslashes($branch_manager);
    $location = addslashes($location);
    $contact = addslashes($contact);

    // Update the properties in the database
    $sql = $dbh->prepare("UPDATE branch 
                        SET 
                           branch_name = ?, 
                           branch_manager = ?, 
                           location = ?, 
                           contact = ? 
                        WHERE 
                            branch_id = ?");
    $result = $sql->execute([
        $branch_name,
        $branch_manager,
        $location,
        $contact,
        $branch_id
    ]);

    // Check if the SQL query was successful
    if ($result) {
        header("Location: branch.php?status=success&message=Branch edited successfully.");
        exit();
    } else {
        header("Location: branch.php?status=error&message=Branch edition failed.");
        exit();
    }
} elseif (isset($_REQUEST['delete-branch'])) {
    $branch_id = $_REQUEST['delete-branch'];

    // Check if branch exists
    $stmt = $dbh->prepare("SELECT * FROM branch WHERE branch_id = :branch_id");
    $stmt->bindParam(':branch_id', $branch_id);
    $stmt->execute();
    $branch = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($branch) {
        // Delete the branch from the database
        $stmt = $dbh->prepare("DELETE FROM branch WHERE branch_id = :branch_id");
        $stmt->bindParam(':branch_id', $branch_id);
        $stmt->execute();

        if ($stmt->rowCount()) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('Branch deleted successfully!', 'success');
            });
        </script>";
        } else {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('Failed to delete branch.', 'error');
            });
        </script>";
        }
    }
}

elseif (isset($_POST['register_btn'])) {
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
}
// Edit User
if (isset($_POST['edit_user_btn'])) {
    $id = trim($_POST['id']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $national_id = trim($_POST['national_id']);
    $user_role = trim($_POST['user_role']);

    $filename = isset($_FILES['photo']['name']) ? trim($_FILES['photo']['name']) : '';
    $photo = '';

    if ($filename) {
        $chk = rand(1111111111111, 9999999999999);
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $photo = $chk . '.' . $ext; // Ensure proper file extension
        $target_img = "./uploads/" . $photo;
        $url_img = SITE_URL . '/uploads/' . $photo;
    }

    // Prepare the SQL statement
    $result = dbCreate("UPDATE users SET username = :username, email = :email, national_id = :national_id, user_role = :user_role, photo = :photo WHERE id = :id", [
        ':username' => $username,
        ':email' => $email,
        ':national_id' => $national_id,
        ':user_role' => $user_role,
        ':photo' => $url_img,
        ':id' => $id
    ]);

    // Check if the update was successful
    if ($result) {
        // Move the uploaded file if a new file was uploaded
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

    $result = dbcreate("INSERT INTO appointments (fullname, date, time, reason, assigned_to) VALUES (:fullname, :date, :time, :reason, :assigned_to)",
   [
        ':fullname' => $fullname,
        ':date' => $date,
        ':time' => $time,
        ':reason' => $reason,
        ':assigned_to' => $assigned_to
    ]);

  

        if ($result == 1) {
            header("Location: appointments.php?status=success&message=Appoitment added successfully.");
            exit();
        } else {
            header("Location: appointments.php?status=error&message=Appointment addition failed.");
            exit();
        }
  
 
    }




// Add Supplier
elseif (isset($_POST['add_supplier_btn'])) {
    trim(extract($_POST));
  
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
        header("Location: suppliers.php?status=success&message=Supplier added successfully.");
            exit();
    } else {
        header("Location: supplier.php?status=error&message=Supplier addition failed.");
        exit();
    }
}

// Add Inventory

elseif (isset($_POST['add_inventory_btn'])) {
    trim(extract($_POST));
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
        ':date_added' => $date_added 
    ]);
    if ($result == 1) {
        header("Location: inventory.php?status=success&message=Inventory added successfully.");
        exit();
    } else {
        header("Location: inventory.php?status=error&message=Inventory addition failed.");
        exit();
    }
}
//Insert into Lot_ Managemt 
elseif (isset($_POST['add_lot_btn'])) {
    trim(extract($_POST));
    // Proceed with the database query
    $result = dbCreate("INSERT INTO lot_management (section, lot_number, location, status, date_added) VALUES (:section, :lot_number, :location, :status, :date_added)", [
        ':section' => $section,
        ':lot_number' => $lot_number,
        ':location' => $location,
        ':status' => $status,
        ':date_added' => $date_added // Use the safe assignment for date if provided
    ]);

    if ($result == 1) {
        header("Location: lot_management.php?status=success&message=Lot added successfully.");
        exit();
    } else {
        header("Location: lot_management.php?status=error&message=Lot addition failed.");
        exit();
    }
}
// add deceased record
if (isset($_POST['add_deceased_btn'])) {
    // Safely assign and trim POST values
    $full_name = trim($_POST['full_name']);
    $date_of_birth = trim($_POST['date_of_birth']);
    $date_of_death = trim($_POST['date_of_death']);
    $place_of_death = trim($_POST['place_of_death']);
    $cause_of_death = trim($_POST['cause_of_death']);
    $plot_number = trim($_POST['plot_number']);
    $family_lineage = trim($_POST['family_lineage']);
    $spouse = trim($_POST['spouse']);
    $origin = trim($_POST['origin']);
    $place_of_birth = trim($_POST['place_of_birth']);
    $nationality = trim($_POST['nationality']);
    $occupation = trim($_POST['occupation']);
    $remarks = trim($_POST['remarks']);
    $age_at_death = trim($_POST['age_at_death']); // Get age at death
    $gender = trim($_POST['gender']); // Get gender

    // Initialize the files variable
    $files = null; // Default to null

    // Handle file uploads if a file was uploaded
    if (isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] == UPLOAD_ERR_OK) {
        // Define a directory to store the uploaded files
        $upload_dir = 'uploads/'; // Make sure this directory exists and is writable

        // Ensure the upload directory exists
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true); // Create directory if it doesn't exist
        }

        // Create a unique file name to avoid overwriting existing files
        $file_name = uniqid() . '_' . basename($_FILES['file_upload']['name']);
        $target_file = $upload_dir . $file_name;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['file_upload']['tmp_name'], $target_file)) {
            $files = $target_file; // Store the file path in the variable
        } else {
            // Handle error if file cannot be moved
            header("Location: deceased_records.php?status=error&message=File upload failed.");
            exit();
        }
    }

    // Generate the deceased_id in the format DRHC001
    $check = $dbh->query("SELECT deceased_id FROM deceased_records"); // Check if any records exist

    if ($check->rowCount() == 0) {
        // If no records exist, start with 'DRHC001'
        $new_deceased_id = 'DRHC001';
    } else {
        // Fetch the last deceased_id and generate a new one
        $stmt = $dbh->query("SELECT deceased_id FROM deceased_records ORDER BY deceased_id DESC LIMIT 1");
        $last_deceased = $stmt->fetch(PDO::FETCH_OBJ);

        if ($last_deceased) {
            // Extract numeric part from the last deceased_id and increment it
            $last_id_num = (int) substr($last_deceased->deceased_id, 4); // Get the number part after 'DRHC'
            $new_id_num = $last_id_num + 1;
            $new_deceased_id = 'DRHC' . str_pad($new_id_num, 3, '0', STR_PAD_LEFT); // Create new deceased_id
        } else {
            // If no deceased records exist, start with 'DRHC001'
            $new_deceased_id = 'DRHC001';
        }
    }

    // Proceed with the database query
    $result = dbCreate("INSERT INTO deceased_records (
        deceased_id,  
        full_name, 
        date_of_birth, 
        date_of_death, 
        place_of_death, 
        cause_of_death, 
        plot_number, 
        family_lineage, 
        spouse, 
        origin, 
        place_of_birth, 
        nationality, 
        occupation, 
        age_at_death, 
        gender, 
        remarks, 
        files
    ) VALUES (
        :deceased_id,  
        :full_name, 
        :date_of_birth, 
        :date_of_death, 
        :place_of_death, 
        :cause_of_death, 
        :plot_number, 
        :family_lineage, 
        :spouse, 
        :origin, 
        :place_of_birth, 
        :nationality, 
        :occupation, 
        :age_at_death, 
        :gender, 
        :remarks, 
        :files
    )", [
        ':deceased_id' => $new_deceased_id, // Bind new ID
        ':full_name' => $full_name,
        ':date_of_birth' => $date_of_birth,
        ':date_of_death' => $date_of_death,
        ':place_of_death' => $place_of_death,
        ':cause_of_death' => $cause_of_death,
        ':plot_number' => $plot_number,
        ':family_lineage' => $family_lineage,
        ':spouse' => $spouse,
        ':origin' => $origin,
        ':place_of_birth' => $place_of_birth,
        ':nationality' => $nationality,
        ':occupation' => $occupation,
        ':age_at_death' => $age_at_death,  // Bind the age at death
        ':gender' => $gender,                // Bind the gender
        ':remarks' => $remarks,
        ':files' => $files // Save the file path in the database
    ]);

    if ($result == 1) {
        header("Location: deceased_records.php?status=success&message=Deceased record added successfully.");
        exit();
    } else {
        header("Location: deceased_records.php?status=error&message=Deceased record addition failed.");
        exit();
    }
}

   
if (isset($_POST['burial_record_btn'])) {
    // Retrieve the last burial_id and generate the next one
    $stmt = $dbh->query("SELECT burial_id FROM burial_records ORDER BY burial_id DESC LIMIT 1");
    $lastBurialId = $stmt->fetchColumn();

    if ($lastBurialId) {
        // Extract the numeric part and increment it
        $lastNumber = (int)substr($lastBurialId, 4);
        $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
    } else {
        // If there is no last ID, start with 0001
        $nextNumber = '0001';
    }
    $burial_id = 'BRHC' . $nextNumber;

    // Extract and trim POST variables
    $burial_date = trim($_POST['burial_date']);
    $grave_number = trim($_POST['grave_number']);
    $deceased_id = trim($_POST['deceased_id']);
    $cemetery_id = trim($_POST['cemetery_id']);
    $location = trim($_POST['location']);
    $funeral_service_details = trim($_POST['funeral_service_details']);
    $time_of_burial = trim($_POST['time_of_burial']);
    $burial_type = trim($_POST['burial_type']);
    $officiant = trim($_POST['officiant']);
    $burial_status = trim($_POST['burial_status']);
    $remarks = trim($_POST['remarks']);
    $created_at = date('Y-m-d H:i:s');

    // Updated SQL query to include burial_id
    $sql = "INSERT INTO burial_records 
        (burial_id, burial_date, grave_number, deceased_id, location, cemetery_id, time_of_burial, burial_type, officiant, funeral_service_details, burial_status, remarks, created_at)
        VALUES 
        (:burial_id, :burial_date, :grave_number, :deceased_id, :location, :cemetery_id, :time_of_burial, :burial_type, :officiant, :funeral_service_details, :burial_status, :remarks, :created_at)";

    // Execute the database query
    $result = dbCreate($sql, [
        ':burial_id' => $burial_id,
        ':burial_date' => $burial_date,
        ':grave_number' => $grave_number,
        ':deceased_id' => $deceased_id,
        ':location' => $location,
        ':cemetery_id' => $cemetery_id,       
        ':time_of_burial' => $time_of_burial,
        ':burial_type' => $burial_type,
        ':officiant' => $officiant,
        ':funeral_service_details' => $funeral_service_details,
        ':burial_status' => $burial_status,
        ':remarks' => $remarks,
        ':created_at' => $created_at
    ]);

    // Check the result and redirect
    if ($result == 1) {
        header("Location: burial_records.php?status=success&message=Burial record added successfully.");
    } else {
        header("Location: burial_records.php?status=error&message=Burial record addition failed.");
    }
    exit();
}


// Add Expense
elseif (isset($_POST['add_expense_btn'])) {
    trim(extract($_POST));

    // Proceed with the database query
    $result = dbCreate ("INSERT INTO expenses (date, description, amount, category, remarks )VALUES (:date, :description, :amount, :category, :remarks)",[
      
            ':date' => $date,
            ':description' => $description,
            ':amount' => $amount,
            ':category' => $category,
            ':remarks' => $remarks
        ]);
        if ($result == 1) {
            header("Location: expense.php?status=success&message=Expense added successfully.");
            exit();
    } else {
        header("Location: expense.php?status=error&message=Expense addition failed.");
        exit();
    }
}

// Add Work Order
elseif (isset($_POST['add_work_order_btn'])) {
    trim(extract($_POST));

    $result = dbCreate("INSERT INTO work_orders (description, status, priority, assigned_to, due_date) VALUES (:description, :status, :priority, :assigned_to, :due_date)", [
        ':description' => $description,
        ':status' => $status,
        ':priority' => $priority,
        ':assigned_to' => $assigned_to,
        ':due_date' => $due_date
    ]);

     if ($result == 1) {
            header("Location: work_orders.php?status=success&message=Work order added successfully.");
            exit();
    } else {
        header("Location: work_orders.php?status=error&message=Work order addition failed.");
        exit();
    }
}

// add customer
elseif (isset($_POST['add_customer_btn'])) {
    trim(extract($_POST));

    // Initialize error array to collect validation errors
    $errors = [];

    // Validate Name: Should not be empty and should contain only letters and spaces
    if (empty($name) || !preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $errors[] = "Name must contain only letters and spaces.";
    }

    // Validate Phone: Should not be empty and should match a valid phone number pattern
    // Example pattern for a phone number (10-15 digits)
    if (empty($phone) || !preg_match("/^[0-9]{10,15}$/", $phone)) {
        $errors[] = "Phone number must contain 10 to 15 digits.";
    }

    // Check if there are validation errors
    if (count($errors) > 0) {
        // Redirect with error messages
        $error_message = implode(', ', $errors);
        header("Location: customer_management.php?status=error&message=$error_message");
        exit();
    }

    // If no validation errors, proceed with database insertion
    $result = dbCreate("INSERT INTO customers (name, email, phone, remarks) VALUES (:name, :email, :phone, :remarks)", [
        ':name' => $name,
        ':email' => $email,
        ':phone' => $phone,
        ':remarks' => $remarks,
    ]);

    if ($result == 1) {
        header("Location: customer_management.php?status=success&message=Customer added successfully.");
        exit();
    } else {
        header("Location: customer_management.php?status=error&message=Customer addition failed.");
        exit();
    }
}


// edit customer
elseif (isset($_POST['edit_customer_btn'])) {
    $id = trim($_POST['id']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $remarks = trim($_POST['remarks']);

    // Update the properties in the database
    $stmt = $dbh->prepare("UPDATE customers SET name = :name, email = :email, phone = :phone, remarks = :remarks WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':remarks', $remarks);

    // Check if the SQL query was successful
    if ($stmt->execute()) {
        header("Location: customer_management.php?status=success&message=customer edited successfully.");
        exit();
    } else {
        header("Location: customer_management.php?status=error&message=customer edition failed.");
        exit();
    }
}
elseif (isset($_POST['add_sales_btn'])) {
    trim(extract($_POST));

    // Calculate total price
    $total_price = $unit_price * $quantity;

    $result = dbCreate("INSERT INTO sales (customer_name, item_sold, quantity, unit_price, total_price, sale_date, description, payment_method, payment_status) VALUES (:customer_name, :item_sold, :quantity, :unit_price, :total_price, :sale_date, :description, :payment_method, :payment_status)", [
        ':customer_name' => $customer_name,
        ':item_sold' => $item_sold,
        ':quantity' => $quantity,
        ':unit_price' => $unit_price,
        ':total_price' => $total_price,
        ':sale_date' => $sale_date,
        ':description' => $description,
        ':payment_method' => $payment_method,
        ':payment_status' => $payment_status,
    ]);

    if ($result == 1) {
        // Get the last inserted ID for the invoice
        $last_id = $dbh->lastInsertId();
        header("Location: invoice.php?id=" . $last_id);
        exit();
    } else {
        header("Location: sales.php?status=error&message=Sales addition failed.");
        exit();
    }
}



// add grave mappings
elseif (isset($_POST['grave_mapping_btn'])) {
    trim(extract($_POST));

    $result = dbCreate("INSERT INTO grave_mapping (grave_number, location, lot_number, size, status, remarks) VALUES (:grave_number, :location, :lot_number, :size, :status, :remarks)", [
        ':grave_number' => $grave_number,
        ':location' => $location,
        ':lot_number' => $lot_number,
        ':size' => $size,
        ':status' => $status,
        ':remarks' => $remarks,
    ]);

     if ($result == 1) {
            header("Location: grave_mapping.php?status=success&message=Grave mapping added successfully.");
            exit();
    } else {
        header("Location: grave_mapping.php?status=error&message=Grave mapping addition failed.");
        exit();
    }
}
if (isset($_POST['add_grave_btn'])) { 
    // Safely assign and trim POST values
    $plot_number = trim($_POST['Plot_number'] ?? '');
    $lot = trim($_POST['lot'] ?? '');
 
    $section_name = trim($_POST['section_name'] ?? '');
    $type = trim($_POST['type'] ?? '');
    $availability_status = trim($_POST['Availability_Status'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $coordinates = trim($_POST['coordinates'] ?? '');

    // Ensure all required fields are available
    if ($plot_number && $type && $section_name && $availability_status && $price && $coordinates) {
        // Fetch the last cemetery_id and generate a new one
        $stmt = $dbh->query("SELECT cemetery_id FROM grave_management ORDER BY cemetery_id DESC LIMIT 1");
        $last_cemetery = $stmt->fetch(PDO::FETCH_OBJ);

        if ($last_cemetery) {
            // Extract numeric part from the last cemetery_id and increment it
            $last_id_num = (int) substr($last_cemetery->cemetery_id, 4); // Get the number part after 'CRHC'
            $new_id_num = $last_id_num + 1;
            $cemetery_id = 'CRHC' . str_pad($new_id_num, 4, '0', STR_PAD_LEFT); // Create new cemetery_id
        } else {
            // If no cemetery exists, start with 'CRHC0001'
            $cemetery_id = 'CRHC0001';
        }

        // Check if the plot_number already exists
        $check = $dbh->prepare("SELECT * FROM grave_management WHERE plot_number = :plot_number");
        $check->execute([':plot_number' => $plot_number]);

        if ($check->rowCount() == 0) {
            // Proceed with the database query using dbCreate
            $result = dbCreate("INSERT INTO grave_management (cemetery_id, plot_number,lot,section_name, type,  availability_status, price, coordinates) 
                                VALUES (:cemetery_id, :plot_number,:lot,   :section_name,:type, :availability_status, :price, :coordinates)", [
                ':cemetery_id' => $cemetery_id,
                ':plot_number' => $plot_number,
                ':lot'=>$lot,
                ':section_name' => $section_name,
                ':type' => $type,
                
                ':availability_status' => $availability_status,
                ':price' => $price,
                ':coordinates' => $coordinates,
            ]);

            if ($result == 1) {
                header("Location: grave_management.php?status=success&message=Lot added successfully.");
                exit();
            } else {
                header("Location: grave_management.php?status=error&message=Error adding lot.");
                exit();
            }
        } else {
            // Handle the case where the plot_number already exists
            header("Location: grave_management.php?status=error&message=Grave number already exists.");
            exit();
        }
    } else {
        // Handle the error where not all required fields are filled
        header("Location: grave_management.php?error=Missing required fields.");
        exit();
    }
}
// Get POST data


?>
