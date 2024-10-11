<?php
session_start();

// File path
$file = 'user.txt';

// Function to get user data based on email
function getUserData($email, $file) {
    if (!file_exists($file)) {
        return false; // File doesn't exist
    }

    $lines = file($file);
    foreach ($lines as $line) {
        $user_data = explode('|', $line);
        $user_email = explode(":", $user_data[4])[1] ?? ''; // Email is stored in index 4

        if (trim($user_email) === $email) {
            return $user_data; // Return user data if email matches
        }
    }
    return false;
}

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("Location: login.php");
    exit();
}

// Get the current user's email from session
$current_email = $_SESSION['email'];

// Get user data
$user_data = getUserData($current_email, $file);
if ($user_data === false) {
    // Handle the case where user data cannot be found
    echo "User data not found.";
    exit();
}

// Extract current user information
$first_name = explode(":", $user_data[0])[1];
$last_name = explode(":", $user_data[1])[1];
$dob = explode(":", $user_data[2])[1];
$gender = explode(":", $user_data[3])[1];
$email = explode(":", $user_data[4])[1];
$home_town = explode(":", $user_data[5])[1];
$phone_number = explode(":", $user_data[6])[1];
$student_id = explode(":", $user_data[7])[1];
$password = explode(":", $user_data[8])[1]; // Password not editable
$profile_image = explode(":", $user_data[9])[1] ?? ''; // Extract profile image filename

// Use the extracted image filename to set the profile image path
$profile_image_path = !empty($profile_image) ? "img/profile_images/" . htmlspecialchars($profile_image) : "img/profile_images/default.png"; // Fallback to a default image if not set

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data safely
    $first_name = isset($_POST["first_name"]) ? trim($_POST["first_name"]) : '';
    $last_name = isset($_POST["last_name"]) ? trim($_POST["last_name"]) : '';
    $dob = isset($_POST["dob"]) ? $_POST["dob"] : '';
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : '';
    $home_town = isset($_POST["home_town"]) ? trim($_POST["home_town"]) : '';
    $phone_number = isset($_POST["phone_number"]) ? trim($_POST["phone_number"]) : '';
    $student_id = isset($_POST["student_id"]) ? trim($_POST["student_id"]) : '';

    // Handle file upload
    $new_profile_image = '';
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        // Get the uploaded file details
        $upload_file = $_FILES['profile_image'];
        $upload_dir = 'img/profile_images/';
        $file_name = basename($upload_file['name']);
        $target_file = $upload_dir . $file_name;
        
        // Move the uploaded file to the target directory
        if (move_uploaded_file($upload_file['tmp_name'], $target_file)) {
            $new_profile_image = $file_name; // Store the new image filename

            
            $_SESSION['profile_image'] = $new_profile_image;
        } else {
            echo "Error uploading file.";
            exit();
        }
    } else {
        $new_profile_image = $profile_image; // Keep the old image if no new image is uploaded
    }

    // Update the user record
    $updated_user_data = "First Name:$first_name|Last Name:$last_name|DOB:$dob|Gender:$gender|Email:$email|Hometown:$home_town|Phone Number:$phone_number|Student ID:$student_id|Password:$password|Profile Image:$new_profile_image\n"; // Include Profile Image in updated data

    // Read all lines and replace the current user's line with the updated data
    $lines = file($file);
    foreach ($lines as $index => $line) {
        $user_email = explode('|', $line)[4]; // Email is stored in index 4
        if (strpos($user_email, $email) !== false) {
            $lines[$index] = $updated_user_data; // Update the user line
            break;
        }
    }

    // Save updated data back to the file
    file_put_contents($file, implode("", $lines));

    // Set a session variable to indicate success
    $_SESSION['update_success'] = true;
    header("Location: main_menu.php");
    exit();
}
?>

<!-- HTML section of the update profile page -->
<?php include_once "head.php"; ?>
<body id="reg-body">
    <?php include_once "header.php"; ?>
    <div class="container d-flex justify-content-center" id="update-container">
    <form id="update-form" method="POST" action="update_profile.php" enctype="multipart/form-data">

        <!-- Profile Image -->
        <div class="row mb-3">
            <div class="col text-center">
                <img src="<?= $profile_image_path; ?>" alt="Profile Image" class="img-thumbnail" width="150">
            </div>
        </div>

        <!-- Other Fields: First Name, Last Name, DOB, Gender, Home Town, Phone Number, Student ID -->
        <div class="row mb-3 p-3">
            <div class="col">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" id="first_name" class="custom-input" value="<?= htmlspecialchars($first_name); ?>" placeholder="First Name" required>
            </div>
            <div class="col">
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" id="last_name" class="custom-input" value="<?= htmlspecialchars($last_name); ?>" placeholder="Last Name" required>
            </div>
        </div>

        <div class="row mb-3 p-3">
            <div class="col">
                <label for="dob">Date of Birth:</label>
                <input type="date" name="dob" id="dob" class="custom-input" value="<?= htmlspecialchars($dob); ?>" required>
            </div>
            <div class="col">
                <label for="gender">Gender:</label>
                <p class="custom-input" id="gender"><?= htmlspecialchars($gender); ?></p> <!-- Display current gender -->
                <p class="text-muted" style="font-size: 0.9em;">* You cannot update your gender.</p> <!-- Note under gender -->
            </div>
        </div>

        <div class="row mb-3 p-3">
            <div class="col">
                <label for="home_town">Home Town:</label>
                <input type="text" name="home_town" id="home_town" class="custom-input" value="<?= htmlspecialchars($home_town); ?>" placeholder="Home Town" required>
            </div>
            <div class="col">
                <label for="phone_number">Phone Number:</label>
                <input type="text" name="phone_number" id="phone_number" class="custom-input" value="<?= htmlspecialchars($phone_number); ?>" placeholder="Phone Number" required>
            </div>
        </div>

        <div class="row mb-3 p-3">
            <div class="col">
                <label for="student_id">Student ID:</label>
                <input type="text" name="student_id" id="student_id" class="custom-input" value="<?= htmlspecialchars($student_id); ?>" placeholder="Student ID" required>
            </div>
            <div class="col">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" class="custom-input" value="<?= htmlspecialchars($email); ?>" placeholder="Email" readonly>
                <p class="text-muted" style="font-size: 0.9em;">* You cannot update your email.</p> <!-- Note under email -->
            </div>
        </div>

        <div class="row mb-3 p-3">
            <div class="col">
                <label for="profile_image">Profile Image:</label>
                <input type="file" name="profile_image" id="profile_image" class="custom-input" accept="image/*">
            </div>
        </div>

        <!-- Update Button -->
        <div class="row mb-3 p-3">
            <div class="col-md-6 d-flex justify-content-center">
                <input type="submit" class="btn btn-primary rounded-0 d-flex custom-btn" value="Update">
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <a href="view_profile.php" class="btn btn-secondary rounded-0 d-flex custom-btn d-flex justify-content-center">Cancel</a>
            </div>
        </div>
    </form>


    </div>
    <?php include_once 'footer.php' ?>
</body>
</html>
