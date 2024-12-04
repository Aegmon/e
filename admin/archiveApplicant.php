<?php
include('../connection.php');

if (isset($_POST['applicant_id']) && isset($_POST['status']) && isset($_POST['reason'])) {
    $applicant_id = $_POST['applicant_id'];
    $status = $_POST['status']; // This will be either 1 (archive) or 0 (unarchive)
    $reason = $_POST['reason']; // This will be 'Demoted' or 'Graduate'

    // Update the applicant's isArchive status and reason
    $qry = "UPDATE applicants SET isArchive = '$status', reason = '$reason' WHERE id = '$applicant_id'";
    if (mysqli_query($con, $qry)) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'missing_data';
}
?>
