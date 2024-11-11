
<?php
include("../connection.php");
header('Content-Type: application/json');

// Ensure the form fields are being passed through POST
if (isset($_POST['date']) && isset($_POST['family_circumstances']) && isset($_POST['year_course'])) {
    // Sanitize user input to avoid SQL injection
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $family_circumstances = mysqli_real_escape_string($con, $_POST['family_circumstances']);
    $year_course = mysqli_real_escape_string($con, $_POST['year_course']);
    $applicant_id = $_GET['applicant_id']; // Get applicant ID from the query parameter

    // Additional fields for family members and case study details
    $name1 = isset($_POST['name1']) ? mysqli_real_escape_string($con, $_POST['name1']) : null;
    $relationship1 = isset($_POST['relationship1']) ? mysqli_real_escape_string($con, $_POST['relationship1']) : null;
    $status1 = isset($_POST['status1']) ? mysqli_real_escape_string($con, $_POST['status1']) : null;
    $occupation1 = isset($_POST['occupation1']) ? mysqli_real_escape_string($con, $_POST['occupation1']) : null;
    $income1 = isset($_POST['income1']) ? mysqli_real_escape_string($con, $_POST['income1']) : null;
    
    // Repeat for name2, name3, etc.
    $name2 = isset($_POST['name2']) ? mysqli_real_escape_string($con, $_POST['name2']) : null;
    $relationship2 = isset($_POST['relationship2']) ? mysqli_real_escape_string($con, $_POST['relationship2']) : null;
    $status2 = isset($_POST['status2']) ? mysqli_real_escape_string($con, $_POST['status2']) : null;
    $occupation2 = isset($_POST['occupation2']) ? mysqli_real_escape_string($con, $_POST['occupation2']) : null;
    $income2 = isset($_POST['income2']) ? mysqli_real_escape_string($con, $_POST['income2']) : null;

    $name3 = isset($_POST['name3']) ? mysqli_real_escape_string($con, $_POST['name3']) : null;
    $relationship3 = isset($_POST['relationship3']) ? mysqli_real_escape_string($con, $_POST['relationship3']) : null;
    $status3 = isset($_POST['status3']) ? mysqli_real_escape_string($con, $_POST['status3']) : null;
    $occupation3 = isset($_POST['occupation3']) ? mysqli_real_escape_string($con, $_POST['occupation3']) : null;
    $income3 = isset($_POST['income3']) ? mysqli_real_escape_string($con, $_POST['income3']) : null;

    // Additional case study details
    $problem_presented = isset($_POST['problem_presented']) ? mysqli_real_escape_string($con, $_POST['problem_presented']) : null;
    $disposition = isset($_POST['disposition']) ? mysqli_real_escape_string($con, $_POST['disposition']) : null;

    // SQL query to insert data into the table
    $query = "INSERT INTO casestudy (
                applicant_id, date, year_course, family_circumstances, 
                name1, relationship1, status1, occupation1, income1,
                name2, relationship2, status2, occupation2, income2,
                name3, relationship3, status3, occupation3, income3,
                problem_presented, disposition
              ) VALUES (
                '$applicant_id', '$date', '$year_course', '$family_circumstances', 
                '$name1', '$relationship1', '$status1', '$occupation1', '$income1',
                '$name2', '$relationship2', '$status2', '$occupation2', '$income2',
                '$name3', '$relationship3', '$status3', '$occupation3', '$income3',
                '$problem_presented', '$disposition'
              )";

    // Execute the query and check if it was successful
    if (mysqli_query($con, $query)) {
        echo json_encode(['success' => true]); // Return success response
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to insert data']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
}
?>
