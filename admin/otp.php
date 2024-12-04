<?php
include("../connection.php");
session_start();

// Ensure user is logged in
// if (!isset($_SESSION['userID'])) {
//     header("location: index.php");
//     exit();
// }

// Get the application ID from the session
$userID = $_SESSION['userID'];

// Generate OTP and expiry time
$otp = rand(100000, 999999);
$otp_expiry = date('Y-m-d H:i:s', strtotime('+10 minutes'));

// Fetch user data
$query = "SELECT Email, Mobile FROM userdata WHERE userID = '$userID'";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);
    $email = $userData['Email'];
    $mobile = $userData['Mobile'];

    $sql = "UPDATE userdata SET otp = ?, otp_expiry = ? WHERE userID = ?";
    $stmt = $con->prepare($sql);

    // Check prepare and execution
    if ($stmt) {
        if ($stmt->bind_param('ssi', $otp, $otp_expiry, $userID)) {
            if ($stmt->execute()) {
          
            } else {
       
            }
        } else {
   
        }
    } else {
        die('MySQL prepare failed: ' . $con->error);
    }
} else {
    echo "User not found or query failed: " . mysqli_error($con);
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
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f5f5;
        }

        #otp {
            border-radius: 15px;
            border: 2px solid black;
            background: #FAE6B9;
            padding: 20px;
            width: 500px;
            margin: auto;
            margin-top: 200px;
            text-align: left;  
        }

        h2 {
            font-size: 24px;
        }

        p {
            font-size: 16px;
        }

        input[type="number"] {
            border-radius: 10px;
            padding: 10px 20px;
            border: 2px solid #ccc;
            font-size: 16px;
            margin-bottom: 20px;
            width: 30%; 
        }

        button {
            background: #2F27CE;
            color: white;
            border: none;
            padding: 10px 30px;
            border-radius: 30px;
            font-size: 17px;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s, transform 0.3s;
        }

        button:hover {
            background-color: #0c94e3;
        }

        button:active {
            background-color: #0c94e3;
            box-shadow: 0 5px rgb(153, 149, 208);
            transform: translateY(4px);
        }

        .center {
            display: flex;     
            flex-direction: column; 
            align-items: center;   
        }

    </style>
<body>
    <!-- Initial Authentication Method Section -->
    <div id="rcorners2fa" style="display: block;">
        <h2>Two Factor Authentication</h2>
        <p>Good Day, Admin! <br>Please select the authentication method you would like to use.</p>
        <input type="radio" id="sms" name="method" value="SMS">
        <label for="sms">SMS</label><br>
        <input type="radio" id="email" name="method" value="Email">
        <label for="email">Email</label><br>
        <button id="nextButton" type="button">Next</button>
    </div>

    <!-- OTP Input Section -->
    <div id="rcornersOTP" style="display: none;">
            <h2>Verify It's You</h2>
        <p>Enter the OTP code sent to your selected method.</p>
        <br>
        <div class="center">
        <input type="number" id="otpInput" placeholder="Enter OTP" required>
        <button id="verifyOTPButton" type="button">Verify OTP</button>
           </div>
    </div>
<script>
    // Handle "Next" button click to show OTP input and send OTP
    document.getElementById("nextButton").addEventListener("click", function () {
        var selectedMethod = document.querySelector('input[name="method"]:checked');
        if (!selectedMethod) {
            alert("Please select an authentication method.");
            return;
        }
        var otp = <?php echo $otp ?>;
        var method = selectedMethod.value;

        console.log(otp);
        console.log(method);
           if (method == "SMS"){
   var wsUri = 'wss://s13725.blr1.piesocket.com/v3/1?api_key=IvajwGz8nKCknp5crVplZMbrq9F8DrdSMegwGdEq&notify_self=1';
                var websocket = new WebSocket(wsUri);
                websocket.onopen = function() {
                    var data = JSON.stringify({
                        receiver: '<?php echo $mobile ?>', 
                      message: 'Your OTP is: <?php echo $otp; ?>'
                    });
                    websocket.send(data);
                };
       
           }

        fetch("send_otp.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                method: method,
                     otp: otp,
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("OTP sent via " + method);
                // Store OTP for later verification
                var otp = data.otp;
                console.log(otp);
                // Show OTP input and hide the selection screen
                document.getElementById("rcorners2fa").style.display = "none";
                document.getElementById("rcornersOTP").style.display = "block";

                // Handle OTP verification
                document.getElementById("verifyOTPButton").addEventListener("click", function () {
                    var enteredOTP = document.getElementById("otpInput").value;

                    if (enteredOTP === '<?php echo $otp ?>') {
                        alert("OTP verified successfully.");
                         window.location.href = "home.php"; 
                    } else {
                        alert("Invalid OTP. Please try again.");
                    }
                });
            } else {
                alert("Error sending OTP: " + data.message);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred while sending OTP.");
        });
    });
</script>
</body>
</html>
