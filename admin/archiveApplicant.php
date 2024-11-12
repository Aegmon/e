<?php
include('../connection.php');

if (isset($_POST['applicant_id']) && isset($_POST['status'])) {
    $applicant_id = $_POST['applicant_id'];
    $status = $_POST['status']; // This will be either 1 (archive) or 0 (unarchive)

    // Update the applicant's isArchive status
    $qry = "UPDATE applicants SET isArchive = '$status' WHERE id = '$applicant_id'";
    if (mysqli_query($con, $qry)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
