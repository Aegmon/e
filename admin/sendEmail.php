<?php
include('../connection.php');
if (isset($_POST['email']) && isset($_POST['message'])) {
    $email = $_POST['email'];
    $message = $_POST['message'];


    $subject = "Interview Schedule ";
    $email_message = "
        <html>
            <head>
                <title>Interview Schedule</title>
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

    if (mail($email, $subject, $email_message, $headers)) {
        echo "Email sent successfully.";
    } else {
        echo "Failed to send email.";
    }
}
?>
