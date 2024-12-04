<?php
include("../connection.php");

// Get parameters from the URL
$applicant_id = isset($_GET['applicant_id']) ? $_GET['applicant_id'] : '';
$title = isset($_GET['title']) ? $_GET['title'] : ''; // Changed to match 'title'

// Validate inputs
if (empty($applicant_id) || empty($title)) {
    die("Invalid request.");
}

// Query to fetch the file data and metadata
$query = "SELECT * FROM applicationform WHERE applicant_id = '$applicant_id' AND title = '$title'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);

    // Retrieve file details
    $file_name = $data['filename']; // The original filename
    $file_type = $data['mime_type']; // MIME type (e.g., application/pdf)
    $file_data = $data['data']; // Binary file data

    // Send headers to initiate the download
    header('Content-Description: File Transfer');
    header("Content-Type: $file_type");
    header('Content-Disposition: attachment; filename="' . $file_name . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . strlen($file_data));

    // Output the file data
    echo $file_data;
    exit;
} else {
    die("No record found for the given applicant ID and file title.");
}
?>
