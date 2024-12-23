<?php
include("connection.php");
session_start();

if (isset($_POST['login'])) {
    $email = $con->real_escape_string($_POST['email']);
    $password = $con->real_escape_string($_POST['password']);

    if ($email == "" || $password == "") {
        echo '<script type="text/javascript">alert("Check your inputs");</script>';
    } else {
        $query = "SELECT * FROM scholaraccount WHERE email='$email'";
        $ses_sql = mysqli_query($con, $query);

        if ($ses_sql && mysqli_num_rows($ses_sql) > 0) {
            $row = mysqli_fetch_assoc($ses_sql);
            $sql1 = $row['password'];
            $application_id = $row['application_id'];
                $id = $row['id'];

            if (password_verify($password, $sql1)) {
                $_SESSION['application_id'] = $application_id;
                        $_SESSION['id'] = $id;
                 header("location: otp.php");
             
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
    <link rel="stylesheet" href="loginStyleScholar.css">
    <title>Login</title>
</head>
<body>
    <div class="back">
        <button class="back_btn"><a href="index.php" target="_parent"><i class='bx bx-arrow-back'></i></a></button>
    </div>
    <div class="wrapper">
        <div class="form-container">
            <h1>Scholar Login</h1>
            <div class="form-box">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="form" method="post">
                    <div class="input-field">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" placeholder="Email or Username">
                    </div>
                    <div class="input-field">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" autocomplete="off" placeholder="Password">
                    </div>
                    <p class="note"><strong>Note: For new scholars, password must match the given password sent *</strong></p>
                    <div class="option_div">
                        <label class="checkbox">
                            <input type="checkbox">
                            <span class="check">Remember Me</span>
                        </label>
                        <a href="forgetpassword.php" title="Forgot Password" id="link-reset">Forgot Password?</a>
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
