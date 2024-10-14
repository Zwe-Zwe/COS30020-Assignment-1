<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $scientific_name = $_POST['scientific_name'];
    $common_name = $_POST['common_name'];
    $family = $_POST['family'];
    $genus = $_POST['genus'];

    // Prepare data to write in one line
    $data = "$scientific_name|$common_name|$family|$genus\n"; // Use | as a delimiter

    // Handle file upload
    if (isset($_FILES['herbarium_photo']) && $_FILES['herbarium_photo']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'img/'; // Directory to save images
        $image_name = $scientific_name . '.jpg'; // Name the image file
        $upload_file = $upload_dir . basename($image_name);

        // Move uploaded file to the destination
        if (move_uploaded_file($_FILES['herbarium_photo']['tmp_name'], $upload_file)) {
            // Append the data to the text file
            file_put_contents('data/contribute.txt', $data, FILE_APPEND);
        } else {
            // Handle the error if the file could not be uploaded
            echo "Error uploading the image.";
            exit();
        }
    }

    header("Location: contribute.php");
    exit();
}
?>
