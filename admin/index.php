<?php
include('../connection.php');

session_start();
if (isset($_POST['login'])) {
    $email = $con->real_escape_string($_POST['email']);
    $password = $con->real_escape_string($_POST['password']);

    if ($email == "" || $password == "") {
        echo '<script type="text/javascript">alert("Check your inputs");</script>';
    } else {
        $query = "SELECT * FROM userdata WHERE Email='$email'";
        $ses_sql = mysqli_query($con, $query);

        if ($ses_sql && mysqli_num_rows($ses_sql) > 0) {
            $row = mysqli_fetch_assoc($ses_sql);
            $sql1 = $row['Password'];
            $sql2 = $row['userRole'];
            $sql3 = $row['verification'];
            $sql4 = $row['userID'];

            if (password_verify($password, $sql1)) {
                $_SESSION['login_user'] = $email;

                switch ($sql2) {
                    case 'Scholar':
                        if ($sql3 == '1') {
                            header("location: ./isko/index.php");
                        } elseif ($sql3 == '2') {
                            header("location: ./isko/personalinfo.php?userID=$sql4");
                        } else {
                            echo '<script type="text/javascript">alert("Please Verify your email");</script>';
                        }
                        break;

                    case 'Admin':
                        $log = "Admin Login";
                        $con->query("INSERT INTO `logs`(`logs`) VALUES ('$log')");
                        header("location: home.php");
                        break;

                    case 'Superadmin':
                        header("location: ./superadmin/index.php");
                        break;
                }
            } else {
                echo '<script type="text/javascript">alert("Check your inputs");</script>';
            }
        } else {
            echo '<script type="text/javascript">alert("User not found");</script>';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/2625a4d18c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="loginStyleAdmin.css">
    <title>Login</title>
</head>
<body>
    
    <div class="back">

    </div>

    <div class="wrapper">
        <div class="form-container">
            <h1>Admin Login</h1>
            <div class="form-box">
                   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="form" method="post">
                    <div class="input-field"> 
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" placeholder="Email or Username">
                        <small id="email-error">Error</small>
                        <i class="fa-solid fa-circle-check"></i>
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </div>
                    
                    <div class="input-field">
                        <label for="password">Password</label>
                        
                        <input type="password" name="password" id="password" autocomplete="off" placeholder="Password">
                        
                        <small id="password-error">Error</small>
                        <i class="fa-solid fa-circle-check"></i>
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </div>
                    
                   

                    <div class="option_div">
                        <label class="checkbox">
                            <input type="checkbox">
                            <span class="check">Remember Me</span>
                        </label>
                        <a href="forgotpass.html" title="Forgot Password" id="link-reset">Forgot Password?</a>
                    </div>

                    <div class="input-field">
                        <button type="submit" name="login">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    


</body>
</html>