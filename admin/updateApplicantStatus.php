<?php
include("../connection.php");

// Check if the required POST data is set
if (isset($_POST['applicant_id']) && isset($_POST['status']) && isset($_POST['scholarship_type'])) {
    $applicant_id = $_POST['applicant_id'];
    $status = $_POST['status'];
    $scholarship_type = $_POST['scholarship_type'];

    // Sanitize input to prevent SQL injection
    $applicant_id = mysqli_real_escape_string($con, $applicant_id);
    $status = mysqli_real_escape_string($con, $status);
    $scholarship_type = mysqli_real_escape_string($con, $scholarship_type);

    // SQL query to update the applicant's status and scholarship type
    $query = "UPDATE applicants SET status = '$status', scholarType = '$scholarship_type' WHERE id = '$applicant_id'";

    // Execute the query
    if (mysqli_query($con, $query)) {
        // Return success response
        echo json_encode(['success' => true]);
    } else {
        // Return error response
        echo json_encode(['success' => false]);
    }
} else {
    // Return error response if required data is missing
    echo json_encode(['success' => false]);
}
?>
