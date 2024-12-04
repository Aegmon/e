<?php
include("../connection.php");

// Check if the required POST data is set
if (isset($_POST['applicant_id'])) {
    $applicant_id = $_POST['applicant_id'];
    $status = $_POST['status'];
    $scholarship_type = $_POST['scholarship_type'];
    $year = $_POST['year'];
    $course = $_POST['course'];

    // Sanitize input to prevent SQL injection
    $applicant_id = mysqli_real_escape_string($con, $applicant_id);
    $status = mysqli_real_escape_string($con, $status);
    $scholarship_type = mysqli_real_escape_string($con, $scholarship_type);
    $year = mysqli_real_escape_string($con, $year);
    $course = mysqli_real_escape_string($con, $course);

    // SQL query to update the applicant's status, scholarship type, year level, and course
    $query = "
        UPDATE applicants 
        SET 
            status = '$status', 
            scholarType = '$scholarship_type', 
            year_level = '$year', 
            year_course = '$course' 
        WHERE id = '$applicant_id'
    ";

    // Execute the query
    if (mysqli_query($con, $query)) {
        // Return success response
        echo json_encode(['success' => true]);
    } else {
        // Return error response
        echo json_encode(['success' => false, 'error' => mysqli_error($con)]);
    }
}
?>
