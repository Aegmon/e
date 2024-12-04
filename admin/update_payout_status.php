<?php
// Include your database connection file
include('../connection.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the applicant ID and selected status from the form
    $applicantID = $_POST['applicantID'] ?? null;
    $payoutStatus = $_POST['payoutStatus'] ?? null;

    if ($applicantID && $payoutStatus) {
        // Update the payout status in the database
        $query = "UPDATE applicants SET payout = ? WHERE id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("si", $payoutStatus, $applicantID);

        if ($stmt->execute()) {
            // Redirect back with a success message
            header("Location: record.php");
        } else {
            // Redirect back with an error message
            header("Location: your_table_page.php?status=error");
        }
        $stmt->close();
    } else {
        // Redirect back with a validation error message
        header("Location: your_table_page.php?status=validation_error");
    }
} else {
    // Redirect if the request method is not POST
    header("Location: your_table_page.php");
}

$con->close();
