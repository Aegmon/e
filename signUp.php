<?php
  include("connection.php");
 if(isset($_POST['reset'])){


	
        $email = $con->real_escape_string($_POST['email']);
        $password = $con->real_escape_string($_POST['password']);
		$cpassword = $con->real_escape_string($_POST['cpassword']);
	
	 
	
		 if ($password != $cpassword){
			echo '<script type="text/javascript">alert("Password mismatch, Please try again");</script>';
		 }else{
            $sql = $con->query("SELECT Email FROM userdata WHERE Email='$email'");
            if ($sql->num_rows >0){
                echo '<script type="text/javascript">alert("Email is already in use");</script>';
            }else{
				$token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
                $token = str_shuffle($token);
                $token = substr($token, 0, 10);
                $hashedPassword =password_hash($password, PASSWORD_DEFAULT);
                $con->query("INSERT INTO userdata (Email,Password,userRole,token) VALUES ('$email','$hashedPassword','Scholar','$token')");
                $query = "SELECT userID FROM userdata WHERE Email='$email'";
				$ses_sql = mysqli_query($con,$query);
				$row = mysqli_fetch_assoc($ses_sql);
				$id =$row['userID'];
				ini_set( 'display_errors', 1 );
				error_reporting( E_ALL );
				$from = "Reformaattagumpay@gmail.com";
				
		
				$subject = "Email Verification";
				$message = "
			Verify Your Email - https://www.repormaattagumpay.com/verify.php?userID=$id
				";
			   // The content-type header must be set when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers = "From:" . $from;
				if(mail($email,$subject,$message, $headers)) {
					echo '<script type="text/javascript">alert("Register Successful");
					window.location = "./login.php";</script>';
				} else {
					echo '<script>alert("Error")</script>';
				}
		 
              
            } 
			
        }
		
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-up.html" />

	<title>Sign Up</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<style>

#background-video {
  width: 100vw;
  height: 100vh;
  object-fit: cover;
  position: fixed;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  z-index: -1;

}
	</style>
</head>

<body>
<main class="d-flex w-100" style="background: url('./assets/PUBMAT SIGN UP.png'); background-size: cover;">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-60 col-md-6 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

					<!-- <video autoplay muted loop id="background-video">
                            <source src="./assets/signuppubmat.mp4" type="video/mp4">
                             </video> -->

						<div class="card">
							<div class="card-body">
								<div class="m-sm-3">
								<div class="text-center">
										<img src="assets/LogoSM.png" alt="Charles Hall" class="img-fluid rounded-circle" width="132" height="132" />
									</div>
									<form action="" method="post">
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email"required=""data-validation="email" data-validation-has-keyup-event="true" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter password" minlength="8" maxlength="128" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
											title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" required="" />
										</div>
										<div class="mb-3">
											<label class="form-label">Confirm Password</label>
											<input class="form-control form-control-lg" type="password" name="cpassword" placeholder="Confirm password" />
										</div>
										<div class="text-center mt-3">
											<button type="submit" name="reset" class="btn btn-lg btn-primary" style="background-color: #297506; border-color: border-color: coral;">Sign up</button> 
										</div>
									</form>
									<div class="text-center mt-3">
											<a href="login.php">Already Have an Account.</a>
										
										</div>
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="col-sm-60 col-md-6 col-lg-6 mx-auto d-table h-100">
				
				</div>
			</div>

			
		</div>


	</main>
    

	<script src="js/app.js"></script>

</body>

</html>