<?php
session_name('Zwe_Het_Zaw');
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$query = isset($_GET['query']) ? trim($_GET['query']) : '';


?>

<?php include_once 'head.php'; ?>

<body>
    <?php include_once 'header.php'; ?>

    <main class="container search-container" id="main-mt">
        <div class="shadow-lg rounded p-4 w-100">
            <h1 class="mb-4">Search Results</h1>
            <?php
            if ($query) {
                
                $contributions = file('data/contribute.txt', FILE_IGNORE_NEW_LINES);
                $results = [];
                
                foreach ($contributions as $line) {
                    $data = explode('|', $line); 
                    $scientific_name = strtolower($data[0]); 
                    $common_name = strtolower($data[1]); 
                    $family = strtolower($data[2]); 
                    $genus = strtolower($data[3]);

 
                    if (
                        strpos($scientific_name, strtolower($query)) !== false ||
                        strpos($common_name, strtolower($query)) !== false ||
                        strpos($family, strtolower($query)) !== false ||
                        strpos($genus, strtolower($query)) !== false
                    ) {
                        $results[] = $data;
                    }
                }
                
                if (count($results) > 0) {
                    echo '<div class="row">';
                    foreach ($results as $data) {
                        echo '
                        <div class="col-md-4">
                            <div class="card rounded shadow-lg mb-4">
                                <img src="img/plants/' . htmlspecialchars($data[0]) . '.jpg" class="card-img-top" alt="Plant Image" id="search-img">
                                <div class="card-body">
                                    <h5 class="card-title">' . htmlspecialchars($data[0]) . '</h5>
                                    <p class="card-text">' . htmlspecialchars($data[1]) . '</p>
                                    <a href="plant_detail.php?scientific_name=' . htmlspecialchars($data[0]) . '" class="btn btn-primary">View Description</a>
                                </div>
                            </div>
                        </div>';
                    }
                    echo '</div>';
                } else {
                    echo '<p>No results found for "' . htmlspecialchars($query) . '".</p>';
                }
            } else {
                echo '<p>Please enter a search query.</p>';
            }
            ?>
        </div>
    </main>

    <?php include_once 'footer.php'; ?>
</body>

</html>
