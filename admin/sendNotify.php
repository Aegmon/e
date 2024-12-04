<?php
include('../connection.php'); // Include database connection

if (isset($_POST['applicantID']) && isset($_POST['message'])) {
    $applicantID = $_POST['applicantID'];
    $message = $_POST['message'];

    // Retrieve the applicant's email from the database
    $query = "SELECT email FROM applicants WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $applicantID);
    $stmt->execute();
    $result = $stmt->get_result();
    $applicant = $result->fetch_assoc();

    if ($applicant) {
        $email = $applicant['email'];

        // Prepare email content
        $subject = "Notification";
        $email_message = "
            <html>
                <head>
                    <title>Notification</title>
                </head>
                <body>
                    <p>Hello,</p>
                    <p>$message</p>
                </body>
            </html>
        ";

        $from = "noreply@aseest.com";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: " . $from . "\r\n";

        // Attempt to send the email
        if (mail($email, $subject, $email_message, $headers)) {
            echo "Email sent successfully.";
        } else {
            echo "Failed to send email.";
        }
    } else {
        echo "Applicant not found.";
    }
} else {
    echo "Invalid request.";
}
?>
