<?php
session_start();

// Function to validate email format
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate password complexity
function validatePassword($password) {
    return preg_match('/^(?=.*\d)(?=.*[\W_]).{8,}$/', $password);
}

// Function to check if the email already exists in the file
function isEmailTaken($email, $file) {
    if (!file_exists($file)) {
        return false; // File doesn't exist, so no email is taken yet
    }
    
    $lines = file($file); // Read all lines from the file
    foreach ($lines as $line) {
        $user_data = explode('|', $line);
        foreach ($user_data as $data) {
            if (strpos($data, "Email:$email") !== false) {
                return true; // Email already exists
            }
        }
    }
    return false;
}

// File path
$file = 'user.txt';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data safely
    $first_name = isset($_POST["first_name"]) ? trim($_POST["first_name"]) : '';
    $last_name = isset($_POST["last_name"]) ? trim($_POST["last_name"]) : '';
    $dob = isset($_POST["dob"]) ? $_POST["dob"] : '';
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : '';
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : '';
    $home_town = isset($_POST["home_town"]) ? trim($_POST["home_town"]) : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';
    $confirm_password = isset($_POST["confirm_password"]) ? $_POST["confirm_password"] : '';

    // Validate form data
    $errors = [];

    // Check for empty fields
    if (empty($first_name)) {
        $errors['first_name'] = "First name cannot be empty.";
    }

    if (empty($last_name)) {
        $errors['last_name'] = "Last name cannot be empty.";
    }

    if (empty($dob)) {
        $errors['dob'] = "Date of Birth cannot be empty.";
    }

    if (empty($email)) {
        $errors['email'] = "Email cannot be empty.";
    }

    if (empty($home_town)) {
        $errors['home_town'] = "Home town cannot be empty.";
    }

    if (empty($password)) {
        $errors['password'] = "Password cannot be empty.";
    }

    if (empty($confirm_password)) {
        $errors['confirm_password'] = "Confirm Password cannot be empty.";
    }

    // Validate names to only allow alphabets and spaces if not empty
    if (!empty($first_name) && !preg_match("/^[a-zA-Z\s]+$/", $first_name)) {
        $errors['first_name'] = "First name must contain only alphabets and spaces.";
    }

    if (!empty($last_name) && !preg_match("/^[a-zA-Z\s]+$/", $last_name)) {
        $errors['last_name'] = "Last name must contain only alphabets and spaces.";
    }

    // Validate email format if not empty
    if (!empty($email) && !validateEmail($email)) {
        $errors['email'] = "Invalid email format.";
    }

    // Check if the email is already taken
    if (!empty($email) && isEmailTaken($email, $file)) {
        $errors['email'] = "This email is already registered.";
    }

    // Validate password complexity if not empty
    if (!empty($password) && !validatePassword($password)) {
        $errors['password'] = "Password must be at least 8 characters long and include 1 number and 1 symbol.";
    }

    // Check if password and confirm password match if both are not empty
    if (!empty($password) && !empty($confirm_password) && $password !== $confirm_password) {
        $errors['confirm_password'] = "Password and Confirm Password do not match.";
    }

    // If there are no errors, save the data to the file
    if (empty($errors)) {
        // Format the user record
        $user_data = "First Name:$first_name|Last Name:$last_name|DOB:$dob|Gender:$gender|Email:$email|Hometown:$home_town|Password:$password\n";

        // Save the data into the text file
        file_put_contents($file, $user_data, FILE_APPEND);

        // Set a session variable to indicate success
        $_SESSION['registration_success'] = true;
        header("Location: registration.php");
        exit();
    } else {
        // Store errors in session and redirect back to form
        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = $_POST; // Optionally store form data to repopulate fields
        header("Location: registration.php");
        exit();
    }
}

?>
