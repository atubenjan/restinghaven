<?php
  include 'header.php';
  // require "./root/config.php";
?>

<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Login Logs</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Login Logs</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Log Details</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>IP Address</th>
                                        <th>Role</th>
                                        <th>Login Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch login logs from the database
                                    $logsQuery = $dbh->query("SELECT * FROM login_logs ORDER BY login_time DESC");
                                    while ($log = $logsQuery->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<tr>";
                                        echo "<td>{$log['id']}</td>";
                                        echo "<td>{$log['username']}</td>";
                                        echo "<td>{$log['ip_address']}</td>";
                                        echo "<td>{$log['role']}</td>";
                                        echo "<td>{$log['login_time']}</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include('footer.php'); ?>
