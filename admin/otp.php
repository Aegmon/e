<?php
include("../connection.php");
session_start();

// Get the application ID from the session
$userID = $_SESSION['userID'];

// Ensure that the user has logged in by checking the session
if (!isset($_SESSION['userID'])) {
    header("location: index.php");  // Redirect to login if the session is not set
    exit();
} else {
    // Generate a random 6-digit OTP
    $otp = rand(100000, 999999);

    // Set OTP expiry time (10 minutes from now)
    $otp_expiry = date('Y-m-d H:i:s', strtotime('+10 minutes'));

    // Check if the connection is successful
    if ($con === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    // Update the OTP and OTP expiry in the userdata table
    $sql = "UPDATE userdata SET otp = ?, otp_expiry = ? WHERE userID = ?";
    $stmt = $con->prepare($sql);

    // Check if the prepare() method is successful
    if ($stmt === false) {
        die('MySQL prepare failed: ' . $con->error);  // Provide detailed error message if prepare() fails
    }

    // Bind parameters to the prepared statement
    $stmt->bind_param('ssi', $otp, $otp_expiry, $userID);

    // Execute the query and check if it was successful
    if ($stmt->execute()) {
     
    } else {
        echo "Error executing query: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link rel="stylesheet" href="2fa_admin.css">
    <title>2FA</title>
</head>
<body>

    <div id="rcorners2fa">
        <h2>Two Factor Authentication</h2>
        <p>Good Day, Scholar! <br>Please select the authentication method you would like to use.</p>
        <input type="radio" id="sms" name="method" value="SMS">
        <label for="sms">SMS</label><br>
        <input type="radio" id="email" name="method" value="Email">
        <label for="email">Email</label><br>
        <button id="nextButton" type="button">Next</button>
    </div>
    
    <!-- Email Verification Section -->
    <div id="rcornersEmail" style="display: none;">
        <h2>Email Verification</h2>
        <p>Please enter your email to receive a verification code.</p>
        <br>
        <input type="email" id="emailInput" placeholder="johndoe@gmail.com" required>
        <button id="sendEmailCodeButton" type="button">Send Code</button>
        <br>
        <p id="nonotif">Did not receive an email?</p>
        <p id="nonotif">
            <button class="no_border" id="tryEmail">Try Again</button> or 
            <button class="no_border" id="cancelEmail">Cancel</button>
        </p>
    </div>
    
    <!-- SMS Verification Section -->
    <div id="rcornersSMS" style="display: none;">
        <h2>SMS Verification</h2>
        <p>Please enter your mobile number to receive a verification code.</p>
        <br>
        <input type="number" id="smsInput" placeholder="+639123456789" required>
        <button id="sendSMSCodeButton" type="button">Send Code</button>
        <br>
        <p id="nonotif">Did not receive an SMS?</p>
        <p id="nonotif">
            <button class="no_border" id="trySMS">Try Again</button> or 
            <button class="no_border" id="cancelSMS">Cancel</button>
        </p>
    </div>

    <!-- OTP Input Section (hidden until code is sent) -->
    <div id="rcornersOTP" style="display: none;">
        <h2>Enter OTP</h2>
        <p>Please enter the OTP sent to your email or phone:</p>
        <input type="text" id="otpInput" placeholder="Enter OTP" required>
        <button id="verifyOTPButton" type="button">Verify OTP</button>
    </div>

    <script>
        // Handle button click and send OTP based on selected method
        document.getElementById("nextButton").addEventListener("click", function() {
            var method = document.querySelector('input[name="method"]:checked').value;

            if (method === "Email") {
                document.getElementById("rcornersEmail").style.display = "block";
                document.getElementById("rcorners2fa").style.display = "none";
            } else if (method === "SMS") {
                document.getElementById("rcornersSMS").style.display = "block";
                document.getElementById("rcorners2fa").style.display = "none";
            }
        });

        // Send OTP via Email
        document.getElementById("sendEmailCodeButton").addEventListener("click", function() {
            var email = document.getElementById("emailInput").value;
            var otp = "<?php echo $otp; ?>";  // PHP generates the OTP dynamically

            var subject = "Your OTP Code";
            var message = "Your OTP code is: " + otp;

            var email_message = `
                <html>
                    <head>
                        <title>OTP Code</title>
                    </head>
                    <body>
                        <p>Hello,</p>
                        <p>${message}</p>
                    </body>
                </html>
            `;
            
            var from = "noreply@aseest.com";
            var headers = "MIME-Version: 1.0" + "\r\n";
            headers += "Content-type:text/html;charset=UTF-8" + "\r\n";
            headers += "From: " + from + "\r\n";

            // Send email using PHP mail function
            var emailSent = false; // Assume mail() is not available in JS
            if (emailSent) {
                alert("OTP sent successfully to your email.");
                document.getElementById("rcornersOTP").style.display = "block"; // Show OTP input
            } else {
                alert("Failed to send OTP email.");
            }
        });

        // Send OTP via SMS using WebSocket
        document.getElementById("sendSMSCodeButton").addEventListener("click", function() {
            var phoneNumber = document.getElementById("smsInput").value;
            var otp = "<?php echo $otp; ?>";  // PHP generates the OTP dynamically

            var wsUri = 'wss://s13725.blr1.piesocket.com/v3/1?api_key=IvajwGz8nKCknp5crVplZMbrq9F8DrdSMegwGdEq&notify_self=1';
            var websocket = new WebSocket(wsUri);

            websocket.onopen = function() {
                var data = JSON.stringify({
                    receiver: phoneNumber,
                    message: 'Your OTP is: ' + otp
                });
                websocket.send(data);
            };

            alert('OTP has been resent via SMS.');
            document.getElementById("rcornersOTP").style.display = "block"; // Show OTP input
               document.getElementById("rcornersSMS").style.display = "none";
        });

        // Verify OTP entered by user
        document.getElementById("verifyOTPButton").addEventListener("click", function() {
            var enteredOTP = document.getElementById("otpInput").value;
            var otp = "<?php echo $otp; ?>"; // PHP generated OTP

            if (enteredOTP === otp) {
                alert("OTP verified successfully.");
                     window.location.href = " home.php"; 
            } else {
                alert("Invalid OTP. Please try again.");
            }
        });
    </script>
</body>
</html>
