<?php
include("../connection.php");
	if(isset($_POST['send'])){
		ini_set( 'display_errors', 1 );
		error_reporting( E_ALL );
		$from = "aseest080122@gmail.com";
		$to = $_POST['email'];
		$query = "SELECT * from userdata where Email='$to'";
		$ses_sql = mysqli_query($con,$query);
		$row = mysqli_fetch_assoc($ses_sql);
  $userID = $row['userID'];

		$subject = "Password Reset";
		$message = "
	   Click this link to reset your password - https://aseest.website/admin/resetpassword.php?userID=$userID
		";
	   // The content-type header must be set when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers = "From:" . $from;
		if(mail($to,$subject,$message, $headers)) {
			echo '<script>alert("Link was sent to your email for password Reset")</script>';
		} else {
			echo '<script>alert("Error")</script>';
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

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>Sign In</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	
</head>

<body>
	<main class="d-flex">
		<div class="container mb-200 pb-50">
			<div class="row vh-100">
				<div class=" col-md-8  mx-auto d-table  mt-50">
					<div class="d-table-cell align-middle mb-50">

						

						<div class="card">
							<div class="card-body">
								<div class="m-sm-2">
									<div class="text-center">
									
									</div>
									<div class="text-center mt-4">
							<h1 class="h2">Enter Your Email</h1>
						
						</div>
									<form class="widget-form" id="login-form" action="" method="post">
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="text" name="email" required="" placeholder="Enter your email" />
										</div>
	
								
									
										<div class="text-center mt-3">
											<input type="submit"  class="btn btn-lg btn-primary" Value="Send" name="send" ></br>
								
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>

</body>

</html>