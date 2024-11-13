<?php
include('connection.php');
session_start();

if (isset($_POST['email']) && isset($_POST['otp'])) {
    $email = $_POST['email'];
    $otp = $_POST['otp'];

    // Prepare the email
    $subject = "Your OTP Code for Login";
    $message = "
        <html>
            <head>
                <title>Your OTP Code</title>
            </head>
            <body>
                <p>Hello,</p>
                <p>Your One-Time Password (OTP) is: <b>" . $otp . "</b></p>
                <p>This OTP will expire in 10 minutes.</p>
            </body>
        </html>
    ";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: noreply@aseest.com" . "\r\n";

    // Send the email
    if (mail($email, $subject, $message, $headers)) {
        echo "OTP has been sent to your email.";
    } else {
        echo "Failed to send OTP email.";
    }
} else {
    echo "Email or OTP not provided.";
}
?>
