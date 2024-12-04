<?php
include("../connection.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure ID is an integer
    $success = true; // Track deletion success

    // Delete from scholaraccount
    $qry1 = "DELETE FROM scholaraccount WHERE application_id = $id";
    if (!mysqli_query($con, $qry1)) {
        $success = false;
        echo "Error deleting from scholaraccount: " . mysqli_error($con);
    }

    // Delete from applicants
    $qry = "DELETE FROM applicants WHERE id = $id";
    if (!mysqli_query($con, $qry)) {
        $success = false;
        echo "Error deleting from applicants: " . mysqli_error($con);
    }

    // Redirect if successful
    if ($success) {
        header("Location: record.php");
        exit;
    }
} else {
    echo "Invalid ID";
}

mysqli_close($con);
?>
