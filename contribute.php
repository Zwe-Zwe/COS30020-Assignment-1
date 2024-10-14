<?php 
session_start();

// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}
?>
<?php include_once 'head.php' ?>
<body>
<?php include_once 'header.php' ?>
<!-- Contribute Button -->
<div class="container contribute-button d-flex align-items-center">
    <h1 class="me-3">Contributions:</h1>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#contributeModal">
        Contribute
    </button>
</div>

 

<!-- Contribute Modal -->
<div class="modal fade" id="contributeModal" tabindex="-1" aria-labelledby="contributeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="contributeModalLabel">Contribute</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="submit_contribution.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="scientificName" class="form-label">Scientific Name (Species) <span class="text-danger">*</span></label>
            <input type="text" class="custom-input" id="scientificName" name="scientific_name" placeholder="e.g. Dipterocarpus bourdillonii" required>
          </div>
          <div class="mb-3">
            <label for="commonName" class="form-label">Common Name</label>
            <input type="text" class="custom-input" id="commonName" name="common_name" placeholder="e.g. Chiratta anjili">
          </div>
          <div class="mb-3">
            <label for="family" class="form-label">Family <span class="text-danger">*</span></label>
            <input type="text" class="custom-input" id="family" name="family" placeholder="e.g. Dipterocarpaceae" required>
          </div>
          <div class="mb-3">
            <label for="genus" class="form-label">Genus <span class="text-danger">*</span></label>
            <input type="text" class="custom-input" id="genus" name="genus" placeholder="e.g. Dipterocarpus" required>
          </div>
          <div class="mb-3">
            <label for="herbariumPhoto" class="form-label">Herbarium Photo <span class="text-danger">*</span></label>
            <input type="file" class="custom-input" id="herbariumPhoto" name="herbarium_photo" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="container">
    <div class="row">
        <?php
        // Check if contribute.txt exists and read the data
        $filename = 'data/contribute.txt';
        if (file_exists($filename)) {
            $file_contents = file($filename);
            // Display each contribution as a card
            foreach ($file_contents as $line) {
                list($scientific_name, $common_name, $family, $genus) = explode('|', trim($line));

                echo '<div class="col-md-4 mb-4">';
                echo '    <div class="card">';
                $image_path = 'img/plants/' . $scientific_name . '.jpg'; // Path to the image
                echo '        <img src="' . $image_path . '" class="card-img-top contribute-card-img" alt="Herbarium Photo">';
                echo '        <div class="card-body">';
                echo '            <h5 class="card-title">' . trim($scientific_name) . '</h5>';
                echo '            <p class="card-text"><strong>Common Name:</strong> ' . trim($common_name) . '</p>';
                echo '            <a href="plant_detail.php?scientific_name=' . urlencode($scientific_name) . '" class="btn btn-primary">Learn more</a>';
                echo '        </div>';
                echo '    </div>';
                echo '</div>';
            }
        }
        ?>
    </div>
</div>

<?php include_once "footer.php" ?>
</body>
</html>
