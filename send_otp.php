<?php
include("connection.php");
session_start();

// Ensure the user is logged in
// Get the application ID from the session
$id = $_SESSION['id'];

// Ensure that the user has logged in by checking the session
if (!isset($_SESSION['id'])) {
    header("location: login.php");  // Redirect to login if the session is not set
    exit();
} else {
    // Generate a random 6-digit OTP
    $otp = rand(100000, 999999);

    // Set OTP expiry time (10 minutes from now)
    $otp_expiry = date('Y-m-d H:i:s', strtotime('+10 minutes'));

    // Update the OTP and OTP expiry in the scholaraccount table
    $sql = "UPDATE scholaraccount SET otp = ?, otp_expiry = ? WHERE id = ?";
    $stmt = $con->prepare($sql);

// Check if the prepare() method is successful
if ($stmt === false) {
    die('MySQL prepare failed: ' . $con->error);  // Provide detailed error message if prepare() fails
}

// Bind parameters to the prepared statement
$stmt->bind_param('ssi', $otp, $otp_expiry, $id);

// Execute the query and check if it was successful
if ($stmt->execute()) {
    // After updating OTP in the database, get the user input email
    if (isset($_POST['email'])) {
        $email = $_POST['email']; // Get email from the user input

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

        // Send the email using PHP's mail() function
        if (mail($email, $subject, $message, $headers)) {
            echo "OTP has been sent to your email.";
        } else {
            echo "Failed to send OTP email.";
        }
    }
} else {
    echo "Error executing query: " . $stmt->error;
}
}
?>
