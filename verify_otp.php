<?php
session_start();
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_otp = isset($_POST['otp']) ? trim($_POST['otp']) : '';

    // Verify if the submitted OTP matches the one in the session
    if ($user_otp == $_SESSION['otp']) {
        // OTP is correct, allow user to reset password
        header("Location: reset_password.php");
        exit();
    } else {
        $error_message = "Invalid OTP!";
    }
}
?>

<?php include_once "head.php"; ?>
<body id="reg-body">
<?php include_once "header.php"; ?>
    <div class="container d-flex justify-content-center" id="login-container">
        <form id="login-form" method="POST" action="verify_otp.php">
            <legend class="text-center display-7 ml-3 mb-3 mt-3">Verify OTP</legend>

            <?php if (!empty($error_message)) : ?>
                <div style="color:red;"><?php echo htmlspecialchars($error_message); ?></div>
            <?php endif; ?>

            <div class="row mb-3 p-3">
                <div class="col">
                    <input type="text" name="otp" class="custom-input" placeholder="Enter OTP" required>
                </div>
            </div>
            <div class="row mb-3 p-3">
                <div class="col d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary rounded-0 d-flex custom-btn" value="Verify OTP">
                </div>
            </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>
