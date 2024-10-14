<?php
session_name('Zwe_Het_Zaw');
session_start();

// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

// Retrieve the scientific_name from the URL
if (isset($_GET['scientific_name'])) {
    $scientific_name = urldecode($_GET['scientific_name']);
} else {
    // If no scientific name is provided, redirect back to the contributions page
    header("Location: contributions.php");
    exit();
}

// Check if contribute.txt exists and read the specific plant data
$filename = 'data/contribute.txt';
$plant_data = [];
if (file_exists($filename)) {
    $file_contents = file($filename);
    foreach ($file_contents as $line) {
        list($sci_name, $common_name, $family, $genus) = explode('|', trim($line));
        if ($sci_name == $scientific_name) {
            $plant_data = [
                'scientific_name' => $sci_name,
                'common_name' => $common_name,
                'family' => $family,
                'genus' => $genus
            ];
            break;
        }
    }
}

// Redirect if the plant is not found
if (empty($plant_data)) {
    header("Location: contributions.php");
    exit();
}
?>

<?php include_once 'head.php'; ?>
<body>
<?php include_once 'header.php'; ?>

<div class="container detail-container mb-5">
    <h1 class="d-flex justify-content-center mb-5">Plant Details</h1>
    <div class="card mb-4">
        <?php
        $image_path = 'img/plants/' . $plant_data['scientific_name'] . '.jpg'; // Path to the image
        ?>
        <img src="<?php echo $image_path; ?>" class="card-img-top contribute-card-img" alt="Herbarium Photo">
        <div class="card-body">
            <h5 class="card-title"><?php echo $plant_data['scientific_name']; ?></h5>
            <p class="card-text"><strong>Common Name:</strong> <?php echo $plant_data['common_name']; ?></p>
            <p class="card-text"><strong>Family:</strong> <?php echo $plant_data['family']; ?></p>
            <p class="card-text"><strong>Genus:</strong> <?php echo $plant_data['genus']; ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            <div class="btn-group">
                <a href="download.php?scientific_name=<?php echo urlencode($plant_data['scientific_name']); ?>" class="btn btn-success me-3">Download</a>
                <a href="contribute.php" class="btn btn-secondary">Back to Contributions</a>
            </div>
        </div>
    </div>
</div>

<?php include_once 'footer.php'; ?>
</body>
</html>
