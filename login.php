<?php
session_name('Zwe_Het_Zaw');
session_start();  // Start the session to manage user state

// Initialize an error message variable
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Open the user file for reading
    if (!file_exists("data/user.txt")) {
        $error_message = "User file not found.";
    } else {
        $file = fopen("data/user.txt", "r");

        // Flag to track if a user is found
        $user_found = false;

        // Loop through the file line by line
        while (($line = fgets($file)) !== false) {
            // Split the line using '|' as a delimiter
            $user_data = explode("|", $line);

            // Check if the required fields exist
            if (count($user_data) >= 10) { // Ensure there are enough elements
                // Extract the user email, password, gender, and profile image by parsing the line data
                $user_email = explode(":", $user_data[4])[1] ?? ''; // Email is stored in index 4
                $user_password = explode(":", $user_data[8])[1] ?? ''; // Password is stored in index 8
                $user_gender = explode(":", $user_data[3])[1] ?? ''; // Gender is stored in index 3
                $user_profile_image = explode(":", $user_data[9])[1] ?? ''; // Profile image path is stored in index 9

                // Trim whitespace and newlines from email, password, gender, and profile image
                $user_email = trim($user_email);
                $user_password = trim($user_password);
                $user_gender = trim($user_gender);
                $user_profile_image = trim($user_profile_image);

                // Check if the provided email and password match
                if ($email === $user_email && $password === $user_password) {
                    // User found and credentials match
                    $user_found = true;

                    // Store the email, gender, profile image, and logged-in status in session
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['gender'] = $user_gender; // Store gender in the session
                    $_SESSION['profile_image'] = $user_profile_image; // Store profile image in session

                    // Redirect to the main page (or any other page like dashboard)
                    header("Location: main_menu.php");
                    exit;
                }
            }
        }

        // Close the file after reading
        fclose($file);

        // If no user was found, set an error message
        if (!$user_found) {
            $error_message = "Invalid email or password!";
        }
    }
}
?>

<!-- HTML section of the login page -->
<?php include_once "head.php"; ?>
<body id="reg-body">
    <?php include_once "header.php"; ?>
    <div class="container d-flex justify-content-center" id="login-container">
        <form id="login-form" method="POST" action="login.php">
            <legend class="text-center display-7 ml-3 mb-3 mt-3">Please Login</legend>

            <!-- Display error message if login failed -->
            <?php if (!empty($error_message)) : ?>
                <div style="color:red; text-align:center;"><?= htmlspecialchars($error_message); ?></div>
            <?php endif; ?>

            <!-- Email Input Field -->
            <div class="row mb-3 p-3">
                <div class="col">
                    <input type="email" name="email" class="custom-input" placeholder="Email" required>
                </div>
            </div>

            <!-- Password Input Field -->
            <div class="row mb-3 p-3">
                <div class="col">
                    <input type="password" name="password" class="custom-input" placeholder="Password" required>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row mb-3 p-3">
                <div class="col d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary rounded-0 d-flex custom-btn" value="Login">
                </div>
            </div>

            <!-- Registration Link -->
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <p>Don't have an account? <a class="login-a" href="registration.php">Register</a></p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col d-flex justify-content-center">
                    <p><a class="login-a" href="forget_password.php">Forgot the password?</a></p>
                </div>
            </div>
        </form>
    </div>
    <?php include_once 'footer.php' ?>
</body>
</html>
