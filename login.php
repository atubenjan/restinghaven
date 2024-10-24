<?php include 'root/process.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <style>
    /* Background styling */
    body {
      background: url('logo.jpg') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    /* Semi-transparent overlay */
    .login-page::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: -1;
    }

    /* Rounded logo */
    .login-logo img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }

    /* Card styling */
    .card {
      border-radius: 10px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      background: rgba(255, 255, 255, 0.9); /* Slight transparency */
    }

    /* Form elements styling */
    .form-control {
      border-radius: 50px;
      border: 1px solid #ced4da;
      box-shadow: none;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
      border-color: #007bff;
    }

    /* Button styling */
    .btn-primary {
      background: linear-gradient(45deg, #007bff, #0056b3);
      border-radius: 50px;
      border: none;
      transition: background 0.3s ease;
    }

    .btn-primary:hover {
      background: linear-gradient(45deg, #0056b3, #003f7f);
      box-shadow: 0 4px 15px rgba(0, 123, 255, 0.5);
    }

    /* Alert styling */
    .alert {
      border-radius: 5px;
      font-size: 14px;
    }

    /* Login message styling */
    .login-box-msg {
      font-size: 16px;
      font-weight: bold;
      color: #333;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="bg.jpg" alt="Logo">
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <!-- Display alert if there's an error in the URL parameters -->
      <?php if (isset($_GET['status']) && $_GET['status'] == 'error'): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?php echo htmlspecialchars($_GET['message']); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
        </div>
      <?php endif; ?>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" name="login_btn">Sign In</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
