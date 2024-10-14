<?php 
session_start();
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}
include_once 'head.php';
?>
<body>
<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h2>Upload Images</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="upload-container" id="uploadContainer">
            <p>Drag and drop images here, or click to select files</p>
            <input type="file" name="files[]" id="fileInput" multiple accept="image/*" style="display: none;">
            <label for="fileInput" class="btn btn-primary">Select Images</label>
        </div>
        <button type="submit" class="btn btn-success">Upload</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['files'])) {
        $totalFiles = count($_FILES['files']['name']);
        for ($i = 0; $i < $totalFiles; $i++) {
            $fileName = $_FILES['files']['name'][$i];
            $fileTmpName = $_FILES['files']['tmp_name'][$i];
            $uploadDir = 'uploads/'; // Specify your upload directory here
            $uploadFilePath = $uploadDir . basename($fileName);
            
            // Check if the uploads directory exists, create if not
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Move the uploaded file to the specified directory
            if (move_uploaded_file($fileTmpName, $uploadFilePath)) {
                echo "<div class='alert alert-success'>Image '$fileName' uploaded successfully.</div>";
            } else {
                echo "<div class='alert alert-danger'>Error uploading image '$fileName'.</div>";
            }
        }
    }
    ?>
</div>
<?php include_once "footer.php"; ?>
</body>
</html>
