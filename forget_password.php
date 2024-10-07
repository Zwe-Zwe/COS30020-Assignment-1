<?php
require 'vendor/autoload.php';

use SendGrid\Mail\Mail;

session_start();
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';

    // Open the user file to check if the email exists
    $file = fopen("user.txt", "r");
    $user_found = false;

    while (($line = fgets($file)) !== false) {
        $user_data = explode("|", $line);
        $user_email = explode(":", $user_data[4])[1];
        $user_email = trim($user_email);

        if ($email === $user_email) {
            $user_found = true;
            break;
        }
    }
    fclose($file);

    if ($user_found) {
        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);

        // Store OTP in session and close session early to avoid locking issues
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;
        session_write_close();

        // Send OTP via SendGrid
        $email = new Mail();
        $email->setFrom("102783659@students.swinburne.edu.my", "Herbarium");
        $email->setSubject("Your OTP for Password Reset");
        $email->addTo($user_email, "Recipient");
        $email->addContent("text/html", "Your OTP is: $otp");


        $sendgrid = new \SendGrid('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'); // Replace with your API key

        try {
            $response = $sendgrid->send($email);
            if ($response->statusCode() == 202) {
                // Redirect to the OTP verification page
                header("Location: verify_otp.php");
                exit();
            } else {
                $error_message = "Failed to send email. Status code: " . $response->statusCode() . ". Body: " . $response->body();
                // Log detailed error
                error_log($response->body());
            }
        } catch (Exception $e) {
            $error_message = 'Caught exception: '. $e->getMessage();
        }
        
    } else {
        $error_message = "No account found with that email address.";
    }
}
?>
<?php include_once "head.php"; ?>
<body id="reg-body">
    <?php include_once "header.php"; ?>
    <div class="container d-flex justify-content-center" id="login-container">
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
                    <input type="submit" class="btn btn-primary rounded-0 d-flex custom-btn" value="Send OTP">
                </div>
            </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>
