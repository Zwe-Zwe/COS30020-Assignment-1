<?php 
session_start();

// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

// File path where user data is stored
$file = 'user.txt';

// Function to retrieve user data by email
function getUserByEmail($email, $file) {
    if (file_exists($file)) {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos($line, "Email:$email") !== false) {
                // Convert the line to an associative array for easier access
                $user_data = [];
                $fields = explode('|', $line);
                foreach ($fields as $field) {
                    list($key, $value) = explode(':', $field, 2);
                    $user_data[trim($key)] = trim($value);
                }
                return $user_data; // Return the user data as an associative array
            }
        }
    }
    return null; // Return null if no user is found
}

// Check if the user is logged in (you should have an email stored in the session after login)
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Retrieve user data by email
    $user_data = getUserByEmail($email, $file);

    if ($user_data) {
        ?>
        <?php include_once "head.php"; ?>
        <body>
        <?php include_once "header.php"; ?>
        <div class="container profile-container">
            <div class="row justify-content-center profile-row">
                <div class="col-md-6 col-lg-5">

                    <!-- Profile Card -->
                    <div class="card profile-card">
                        <div class="card-header profile-card-header text-center">
                            <h2>Profile Page</h2>
                        </div>
                        <div class="card-body text-center profile-card-body">

                            <!-- Profile Image -->
                            <img src="img/profile_images/<?php echo htmlspecialchars($user_data['Profile Image']); ?>" class="img-fluid rounded-circle mb-3" alt="Profile Image" style="width: 150px; height: 150px; object-fit: cover;">

                            <!-- Name and Info -->
                            <div>
                                <p><strong>Name:</strong> <?php echo htmlspecialchars($user_data['First Name'] . ' ' . $user_data['Last Name']); ?></p>
                                <p><strong>Student ID:</strong> <?php echo htmlspecialchars($user_data['Student ID'] ?? 'N/A'); ?></p>
                                <p><strong>Email:</strong> <a href="mailto:<?php echo htmlspecialchars($user_data['Email']); ?>"><?php echo htmlspecialchars($user_data['Email']); ?></a></p>
                            </div>
                        </div>

                        <!-- Declaration -->
                        <div class="card-footer text-center profile-card-footer">
                            <p class="mb-3 text-justify">
                                I declare that this assignment is my individual work. I have not worked collaboratively nor have I copied from any other student's work or from any other source. I have not engaged another party to complete this assignment. I am aware of the University’s policy with regards to plagiarism. I have not allowed, and will not allow, anyone to copy my work with the intention of passing it off as his or her own work.
                            </p>

                            <!-- Update Profile Button -->
                            <div>
                                <a href="update_profile.php" class="btn btn-secondary btn-sm">Edit Profile</a>
                                <a href="index.php" class="btn btn-secondary btn-sm">Home Page</a>
                                <a href="about.php" class="btn btn-secondary btn-sm">About</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php include_once "footer.php"; ?>
        </body>
        </html>
        <?php
    } else {
        echo "<p class='text-center mt-5'>No profile found for this email. Please register first.</p>";
    }
} else {
    echo "<p class='text-center mt-5'>You must be logged in to view your profile. Please <a href='login.php'>log in</a>.</p>";
}
?>
