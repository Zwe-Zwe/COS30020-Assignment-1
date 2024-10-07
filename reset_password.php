<?php
session_start();
$error_message = '';
$_SESSION['password_reset_success'] = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = isset($_POST['new_password']) ? trim($_POST['new_password']) : '';
    $confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';

    if ($new_password === $confirm_password) {
        // Update the password in the user.txt file
        $email = $_SESSION['email'];
        $file = fopen("user.txt", "r+");
        $updated_content = '';

        // Loop through the file to update the user's password
        while (($line = fgets($file)) !== false) {
            $user_data = explode("|", $line);
            $user_email = explode(":", $user_data[4])[1];
            $user_email = trim($user_email);

            if ($email === $user_email) {
                // Update the password for the user
                $user_data[6] = "password:" . $new_password;
                $line = implode("|", $user_data) . "\n";
            }
            $updated_content .= $line;
        }
        fclose($file);

        // Write the updated content back to the file
        file_put_contents("user.txt", $updated_content);
        $_SESSION['password_reset_success'] = true;
        // Redirect to the login page
        header("Location: login.php");
        exit();
    } else {
        $error_message = "Passwords do not match!";
    }
}
?>

<?php include_once 'head.php' ?>
<body id="reg-body">
    <div class="container d-flex justify-content-center" id="login-container">
        <?php include_once "header.php"; ?>
        <form id="login-form" method="POST" action="reset_password.php">
            <legend class="text-center display-7 ml-3 mb-3 mt-3">Reset Password</legend>

            <?php if (isset($_SESSION['password_reset_success']) && $_SESSION['password_reset_success'] === true): ?>
                <div class="alert alert-success">
                    Password Resetting successful! Redirecting to login page...
                </div>
                <meta http-equiv="refresh" content="3;url=login.php">
                <?php unset($_SESSION['password_reset_success']); ?>
            <?php endif; ?>

            <?php if (!empty($error_message)) : ?>
                <div style="color:red;"><?php echo htmlspecialchars($error_message); ?></div>
            <?php endif; ?>

            <div class="row mb-3 p-3">
                <div class="col">
                    <input type="password" name="new_password" class="custom-input" placeholder="New Password" required>
                </div>
            </div>
            <div class="row mb-3 p-3">
                <div class="col">
                    <input type="password" name="confirm_password" class="custom-input" placeholder="Confirm Password" required>
                </div>
            </div>
            <div class="row mb-3 p-3">
                <div class="col d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary rounded-0 d-flex custom-btn" value="Reset Password">
                </div>
            </div>
        </form>
    </div> 
    <script src="script.js"></script>   
</body>
</html>
