<?php
session_name('Zwe_Het_Zaw');
session_start();
$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = isset($_POST['new_password']) ? trim($_POST['new_password']) : '';
    $confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';

    // Check if passwords match
    if ($new_password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        // Get user data from session
        $user_data = $_SESSION['user_data'] ?? [];
        $updated_data = [];

        if (count($user_data) > 0) {
            // Extract the user information
            $user_email = explode(":", $user_data[4])[1] ?? ''; // Email
            $user_email = trim($user_email);

            // Read all users and update the password for the current user
            $file = fopen("data/user.txt", "r");
            while (($line = fgets($file)) !== false) {
                $line_data = explode("|", trim($line));
                $stored_email = explode(":", $line_data[4])[1] ?? ''; // Extract the stored email
                $stored_email = trim($stored_email);

                if ($stored_email === $user_email) {
                    // Update the password field
                    $line_data[8] = "Password:$new_password"; // Update the password
                }

                // Add the line to the updated data
                $updated_data[] = implode("|", $line_data);
            }
            fclose($file);

            // Write the updated data back to the user.txt file
            $file = fopen("data/user.txt", "w");
            foreach ($updated_data as $line) {
                fwrite($file, $line . PHP_EOL);
            }
            fclose($file);

            // Clear session data
            session_destroy();

            // Redirect to the login page with a success message
            header("Location: login.php?message=Password updated successfully.");
            exit();
        } else {
            $error_message = "Session expired or user not found.";
        }
    }
}
?>
<?php include_once "head.php"; ?>
<body id="reg-body">
    <?php include_once "header.php"; ?>
    <div class="container d-flex justify-content-center" id="forgetPassword">
        <form method="POST" action="reset_password.php" id="login-form">
            <legend class="text-center display-7 ml-3 mb-3 mt-3">Reset Password</legend>
            <?php if (!empty($error_message)) : ?>
                <div style="color:red;"><?php echo htmlspecialchars($error_message); ?></div>
            <?php endif; ?>
            <div class="row mb-3 p-3">
                <div class="col">
                    <input type="password" name="new_password" class="custom-input" placeholder="Enter new password" required>
                </div>
            </div>
            <div class="row mb-3 p-3">
                <div class="col">
                    <input type="password" name="confirm_password" class="custom-input" placeholder="Confirm new password" required>
                </div>
            </div>
            <div class="row mb-3 p-3">
                <div class="col d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary rounded-0 d-flex custom-btn" value="Reset Password">
                </div>
            </div>
        </form>
    </div>
    <?php include_once 'footer.php' ?>
</body>
</html>
