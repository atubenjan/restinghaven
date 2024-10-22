<?php
  include 'header.php'; // Include header and navigation

  // Define upload directory (absolute path)
  $uploadDir = 'uploads/'; // Relative path for HTML access
  $uploadSuccess = false;
  $errorMessage = '';

  // Handle file upload
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['document'])) {
    $fileName = basename($_FILES['document']['name']);
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $uploadFile = $uploadDir . preg_replace("/[^a-zA-Z0-9\._-]/", "", $fileName); // Sanitize file name

    // Define allowed file types
    $allowedTypes = ['pdf', 'doc', 'docx', 'jpg', 'png'];

    // Check if the uploads directory exists
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0777, true); // Create the directory if it doesn't exist
    }

    if (in_array($fileExtension, $allowedTypes)) {
      if ($_FILES['document']['size'] <= 5000000) { // Restrict file size to 5MB
        if (move_uploaded_file($_FILES['document']['tmp_name'], $uploadFile)) {
          $uploadSuccess = true;
        } else {
          $errorMessage = 'File upload failed due to a server error.';
        }
      } else {
        $errorMessage = 'File size exceeds the 5MB limit.';
      }
    } else {
      $errorMessage = 'Invalid file type. Only PDF, DOC, DOCX, JPG, and PNG files are allowed.';
    }
  }
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Document Management</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Document Management</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Document upload form -->
      <div class="card mb-4">
        <div class="card-header">
          Upload Document
        </div>
        <div class="card-body">
          <?php if ($uploadSuccess): ?>
            <div class="alert alert-success" id="upload-success">File uploaded successfully!</div>
            <script>
              // Check if the page has already reloaded
              if (!sessionStorage.getItem('reloaded')) {
                sessionStorage.setItem('reloaded', 'true'); // Mark page as reloaded
                setTimeout(function() {
                  window.location.reload();
                }, 2000); // Reload the page after 2 seconds
              }
            </script>
          <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($errorMessage); ?></div>
          <?php endif; ?>
          <form action="" method="post" enctype="multipart/form-data" id="uploadForm">
            <div class="mb-3">
              <label for="document" class="form-label">Choose document</label>
              <input type="file" class="form-control" id="document" name="document" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
          </form>
        </div>
      </div>

      <!-- Document list -->
      <div class="card">
        <div class="card-header">
          Uploaded Documents
        </div>
        <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead style="background-color: #0b603a; color: white;">
              <tr>
                <th>File Name</th>
                <th>Size</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
                // Display uploaded files
                if (is_dir($uploadDir)) {
                  $files = array_diff(scandir($uploadDir), array('.', '..'));
                  foreach ($files as $file) {
                    $filePath = $uploadDir . $file;
                    $fileSize = filesize($filePath);
              ?>
                  <tr>
                    <td><?php echo htmlspecialchars($file); ?></td>
                    <td><?php echo number_format($fileSize / 1024, 2); ?> KB</td>
                    <td>
                      <a href="<?php echo $filePath; ?>" class="btn btn-info btn-sm" target="_blank">View</a> <!-- View the file -->
                      <a href="download.php?file=<?php echo urlencode($file); ?>" class="btn btn-primary btn-sm">Download</a> <!-- Download the file -->
                      <a href="delete_document.php?file=<?php echo urlencode($file); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this file?');">Delete</a>
                    </td>
                  </tr>
              <?php
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'footer.php'; // Include footer ?>
