<?php
session_start();

// Include Composer autoloader if installed via Composer
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

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

// Check for image with different possible extensions
$image_extensions = ['jpg', 'jpeg', 'png', 'gif'];
$image_path = '';
foreach ($image_extensions as $ext) {
    if (file_exists('img/plants/' . $scientific_name . '.' . $ext)) {
        $image_path = 'img/plants/' . $scientific_name . '.' . $ext;
        break;
    }
}

// If an image is found, create the base64-encoded image string
$image_base64 = '';
if ($image_path) {
    $image_full_path = __DIR__ . '/' . $image_path; // Full local path to the image
    $image_data = file_get_contents($image_full_path);
    $image_base64 = 'data:image/' . pathinfo($image_full_path, PATHINFO_EXTENSION) . ';base64,' . base64_encode($image_data);
}

// Set up DOMPDF options
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true); // Enable for loading images

$dompdf = new Dompdf($options);

// Prepare the HTML content for the PDF
$html = '
    <h1 style="text-align: center;">Plant Details</h1>';

// Add the image to the PDF if it exists
if ($image_base64) {
    $html .= '<div style="text-align: center; margin-bottom: 20px;">
                <img src="' . $image_base64 . '" style="width:300px; height:auto;" alt="Herbarium Photo">
              </div>';
}

$html .= '
    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <tr>
            <td><strong>Scientific Name</strong></td>
            <td>' . $plant_data['scientific_name'] . '</td>
        </tr>
        <tr>
            <td><strong>Common Name</strong></td>
            <td>' . $plant_data['common_name'] . '</td>
        </tr>
        <tr>
            <td><strong>Family</strong></td>
            <td>' . $plant_data['family'] . '</td>
        </tr>
        <tr>
            <td><strong>Genus</strong></td>
            <td>' . $plant_data['genus'] . '</td>
        </tr>
    </table>';

// Load the HTML content into DOMPDF
$dompdf->loadHtml($html);

// Set paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF (force download)
$pdf_name = str_replace(' ', '_', $plant_data['scientific_name']) . '.pdf';
$dompdf->stream($pdf_name, ['Attachment' => true]);

exit();
