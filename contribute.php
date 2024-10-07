<?php
// Start the session
session_start();

// Initialize variables to store form data and errors
$scientific_name = $common_name = $family = $genus = $species = $description = $uploaded_file_name = "";
$errors = [];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate scientific name
    if (empty($_POST["scientific_name"])) {
        $errors['scientific_name'] = "Scientific name is required.";
    } else {
        $scientific_name = sanitize_input($_POST["scientific_name"]);
    }

    // Validate common name
    if (empty($_POST["common_name"])) {
        $errors['common_name'] = "Common name is required.";
    } else {
        $common_name = sanitize_input($_POST["common_name"]);
    }

    // Validate family (starts with capital letter, ends with -aceae)
    if (empty($_POST["family"])) {
        $errors['family'] = "Family is required.";
    } elseif (!preg_match("/^[A-Z][a-zA-Z]*aceae$/", $_POST["family"])) {
        $errors['family'] = "Family must start with a capital letter and end with '-aceae'.";
    } else {
        $family = sanitize_input($_POST["family"]);
    }

    // Validate genus (starts with capital letter, only alphabetic)
    if (empty($_POST["genus"])) {
        $errors['genus'] = "Genus is required.";
    } elseif (!preg_match("/^[A-Z][a-zA-Z]*$/", $_POST["genus"])) {
        $errors['genus'] = "Genus must start with a capital letter and contain only alphabetic characters.";
    } else {
        $genus = sanitize_input($_POST["genus"]);
    }

    // Validate species (lowercase and alphabetic)
    if (empty($_POST["species"])) {
        $errors['species'] = "Species is required.";
    } elseif (!preg_match("/^[a-z]+$/", $_POST["species"])) {
        $errors['species'] = "Species must contain only lowercase alphabetic characters.";
    } else {
        $species = sanitize_input($_POST["species"]);
    }

    // Validate description
    if (empty($_POST["description"])) {
        $errors['description'] = "Description is required.";
    } else {
        $description = sanitize_input($_POST["description"]);
    }

    // Validate image file upload and move it to the 'img' folder
    if (empty($_FILES['photo']['name'])) {
        $errors['photo'] = "Photo is required.";
    } else {
        // Handle file upload
        $target_dir = "img/"; // Ensure this directory exists
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $uploaded_file_name = basename($_FILES["photo"]["name"]);

        // Check if the file is a valid image
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if ($check === false) {
            $errors['photo'] = "The file is not a valid image.";
        } elseif (file_exists($target_file)) {
            $errors['photo'] = "Sorry, file already exists.";
        } elseif ($_FILES["photo"]["size"] > 500000) {
            $errors['photo'] = "Sorry, your file is too large.";
        } elseif (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            $errors['photo'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
        } else {
            // Try to move the uploaded file to the 'img' folder
            if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                $errors['photo'] = "Sorry, there was an error uploading your file.";
            }
        }
    }

    // If there are no errors, proceed with form submission
    if (empty($errors)) {
        // Open the file in append mode
        $file = fopen("contribute.txt", "a");
        if ($file) {
            // Create a string with the input data
            $data = "Scientific Name: $scientific_name\n";
            $data .= "Common Name: $common_name\n";
            $data .= "Family: $family\n";
            $data .= "Genus: $genus\n";
            $data .= "Species: $species\n";
            $data .= "Description: $description\n";
            $data .= "Uploaded File: $uploaded_file_name\n";
            $data .= "---------------------------\n";

            // Write the data to the file
            fwrite($file, $data);
            fclose($file);
            
            // Optional: You might want to redirect or display a success message here
        }
    }
}

// Function to sanitize user input
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>

<?php include_once 'head.php'; ?>
<body id="reg-body">
    <?php include_once 'header.php'; ?>
    <div class="container d-flex justify-content-center mt-5">
        <form class="p-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <legend class="text-center display-7 mb-3 mt-3">Contribute Your Data</legend>
            
            <div class="row mb-3 p-3">
                <div class="col-md-6 input-container">
                    <input type="text" class="custom-input" name="scientific_name" placeholder="Scientific Name" value="<?php echo $scientific_name; ?>" >
                    <?php if (isset($errors['scientific_name'])): ?>
                        <p class="error-message"><?php echo htmlspecialchars($errors['scientific_name']); ?></p>
                    <?php endif; ?>
                </div>
                <div class="col-md-6 input-container">
                    <input type="text" class="custom-input" name="common_name" placeholder="Common Name" value="<?php echo $common_name; ?>" >
                    <?php if (isset($errors['common_name'])): ?>
                        <p class="error-message"><?php echo htmlspecialchars($errors['common_name']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="row mb-3 p-3">
                <div class="col-md-6 input-container">
                    <input type="text" class="custom-input" name="family" placeholder="Family" value="<?php echo $family; ?>" >
                    <?php if (isset($errors['family'])): ?>
                        <p class="error-message"><?php echo htmlspecialchars($errors['family']); ?></p>
                    <?php endif; ?>
                </div>
                <div class="col-md-6 input-container">
                    <input type="text" class="custom-input" name="genus" placeholder="Genus" value="<?php echo $genus; ?>" >
                    <?php if (isset($errors['genus'])): ?>
                        <p class="error-message"><?php echo htmlspecialchars($errors['genus']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="row mb-3 p-3">
                <div class="col-md-6 input-container">
                    <input type="text" class="custom-input" name="species" placeholder="Species" value="<?php echo $species; ?>" >
                    <?php if (isset($errors['species'])): ?>
                        <p class="error-message"><?php echo htmlspecialchars($errors['species']); ?></p>
                    <?php endif; ?>
                </div>
                <div class="col-md-6 mt-3 input-container">
                    <input type="file" id="photo" name="photo" accept="image/*">
                    <?php if (!empty($uploaded_file_name)): ?>
                        <p>Uploaded File: <?php echo htmlspecialchars($uploaded_file_name); ?></p>
                    <?php endif; ?>
                    <?php if (isset($errors['photo'])): ?>
                        <p class="error-message"><?php echo htmlspecialchars($errors['photo']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="row mb-3 p-3">
                <div class="col input-container">
                    <textarea name="description" placeholder="Enter plant description here..." ><?php echo $description; ?></textarea>
                    <?php if (isset($errors['description'])): ?>
                        <p class="error-message"><?php echo htmlspecialchars($errors['description']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="row mb-3 p-3">
                <div class="col-md-6 mb-3 d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary rounded-0 d-flex custom-btn" value="Submit">
                </div>
                <div class="col-md-6 mb-3 d-flex justify-content-center">
                    <input type="reset" class="btn btn-primary rounded-0 d-flex custom-btn" value="Reset" onclick="clearErrors()">
                </div>
            </div>
        </form>
    </div>
    <?php include_once 'footer.php'; ?>
</body>
</html>
