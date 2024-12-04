<?php
include("connection.php");
session_start();

// Check if the session is valid
if (!isset($_SESSION['application_id'])) {
    echo json_encode(["success" => false, "message" => "Session expired."]);
    exit();
}

$application_id = $_SESSION['application_id'];

// Get user data
$query = "SELECT email, contact_no FROM applicants WHERE id='$application_id'";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);
    $email = $userData['email'];
    $mobile = $userData['contact_no'];


    $requestBody = json_decode(file_get_contents('php://input'), true);
    $method = $requestBody['method'] ?? '';
    $otp = $requestBody['otp'] ?? '';
    if ($method === "Email") {
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
              echo json_encode(["success" => true, "message" => "OTP sent to email.", "otp" => $otp]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to send OTP via email."]);
        }
    } elseif ($method === "SMS") {

        $wsUri = 'wss://s13733.blr1.piesocket.com/v3/1?api_key=8b9HJ4XFI6o09cmloKIUNtPkMlRkuM1RDdeJX0rK&notify_self=1';
        $webSocketScript = "
            <script>
                var websocket = new WebSocket('$wsUri');
                websocket.onopen = function() {
                    var data = JSON.stringify({
                        receiver: '$mobile', 
                        message: 'Your OTP is: $otp'
                    });
                    websocket.send(data);
                };
            </script>
        ";
 
        echo json_encode([
            "success" => true,
            "message" => "OTP sent to mobile number.",
            "websocketScript" => $webSocketScript 
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid method selected."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "User data not found."]);
}
?>
