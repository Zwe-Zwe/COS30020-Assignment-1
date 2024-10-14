<?php
session_name('Zwe_Het_Zaw');
session_start();
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';

    // Open the user file to check if the email exists
    $file = fopen("data/user.txt", "r");
    $user_found = false;

    while (($line = fgets($file)) !== false) {
        $user_data = explode("|", $line);
        $user_email = explode(":", $user_data[4])[1] ?? '';
        $user_email = trim($user_email);

        if ($email === $user_email) {
            $user_found = true;
            $_SESSION['user_data'] = $user_data; // Store the user's data in session
            break;
        }
    }
    fclose($file);

    if ($user_found) {
        // Redirect to the OTP verification page
        header("Location: verify_reset.php");
        exit();
    } else {
        $error_message = "No account found with that email address.";
    }
}
?>
<?php include_once "head.php"; ?>
<body id="reg-body">
    <?php include_once "header.php"; ?>
    <div class="container d-flex justify-content-center" id="forgetPassword">
        <form method="POST" action="forget_password.php" id="login-form">
            <legend class="text-center display-7 ml-3 mb-3 mt-3">Forgot Password</legend>
            <?php if (!empty($error_message)) : ?>
                <div style="color:red;"><?php echo htmlspecialchars($error_message); ?></div>
            <?php endif; ?>
            <div class="row mb-3 p-3">
                <div class="col">
                    <input type="text" name="email" class="custom-input" placeholder="Enter your email" required>
                </div>
            </div>  
            <div class="row mb-3 p-3">
                <div class="col d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary rounded-0 d-flex custom-btn" value="Check Email">
                </div>
            </div>
        </form>
    </div>
    <?php include_once 'footer.php' ?>
</body>
</html>
