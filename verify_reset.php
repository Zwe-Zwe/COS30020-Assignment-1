<?php
session_name('Zwe_Het_Zaw');
session_start();
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve hometown and date of birth from the form
    $input_hometown = isset($_POST['hometown']) ? trim($_POST['hometown']) : '';
    $input_dob = isset($_POST['dob']) ? trim($_POST['dob']) : '';

    // Get user data from session
    $user_data = $_SESSION['user_data'] ?? [];
    
    if (count($user_data) > 0) {
        $stored_hometown = explode(":", $user_data[5])[1] ?? ''; // Hometown
        $stored_dob = explode(":", $user_data[2])[1] ?? ''; // DOB

        if ($input_hometown === trim($stored_hometown) && $input_dob === trim($stored_dob)) {
            // Redirect to reset password page
            header("Location: reset_password.php");
            exit();
        } else {
            $error_message = "Invalid hometown or date of birth.";
        }
    } else {
        $error_message = "Session expired or user not found.";
    }
}
?>
<?php include_once "head.php"; ?>
<body id="reg-body">
    <?php include_once "header.php"; ?>
    <div class="container d-flex justify-content-center" id="forgetPassword">
        <form method="POST" action="verify_reset.php" id="login-form">
            <legend class="text-center display-7 ml-3 mb-3 mt-3">Verify Account</legend>
            <?php if (!empty($error_message)) : ?>
                <div style="color:red;"><?php echo htmlspecialchars($error_message); ?></div>
            <?php endif; ?>
            <div class="row mb-3 p-3">
                <div class="col">
                    <input type="text" name="hometown" class="custom-input" placeholder="Enter your hometown" required>
                </div>
            </div>
            <div class="row mb-3 p-3">
                <div class="col">
                    <input type="date" name="dob" class="custom-input" required>
                </div>
            </div>  
            <div class="row mb-3 p-3">
                <div class="col d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary rounded-0 d-flex custom-btn" value="Verify">
                </div>
            </div>
        </form>
    </div>
    <?php include_once 'footer.php' ?>
</body>
</html>
