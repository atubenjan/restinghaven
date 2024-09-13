<?php
include "config.php";
include './root/vendor/autoload.php';


$api_key = "TQx3th8uR2R8I8o8858HUos2f37c81Smw1I0DQ470a7b3rk4E3U33GN5cm7L3AHz";

$errors = array();
foreach ($errors as $error) {
    echo $error;
}

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
        $_SESSION['status'] = '<div class="alert alert-success text-center">You have Successfully registered</div>';
        $_SESSION['loader'] = '<center><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></center>';
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
} elseif (isset($_POST['add_product_btn'])) {
    trim(extract($_POST));

    // id, product_id, product_name, batch_number, production_date, product_type, route, hardness, oven_setting, qr_img, created_at, updated_at, qr_code_path
    $result = dbCreate("INSERT INTO products VALUES(NULL, '$product_id', '$product_name', '$batch_number', '$production_date', '$product_type', '$route', '$hardness', '$oven_setting', '$today', '$today', '9878')");
    if ($result == 1) {
        echo '
            <script>
                alert("Product added successfully");
                window.location.href = window.location.href;
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Product addition failed");
                window.location.href = window.location.href;
            </script>
        ';
    }
} elseif (isset($_POST['edit_product_btn'])) {
    trim(extract($_POST));

    $result = $dbh->query("UPDATE products SET product_id='$product_id', product_name='$product_name', batch_number='$batch_number', production_date='$production_date', product_type='$product_type', route='$route', hardness='$hardness', oven_setting='$oven_setting' WHERE id='$id'");
    if ($result) {
        echo '
            <script>
                alert("Product edited successfully");
                window.location.href = window.location.href;
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Product edit failed");
                window.location.href = window.location.href;
            </script>
        ';
    }
}
?>
