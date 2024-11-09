<?php
include("connection.php");
$token = $_GET['token'];
$query = "SELECT * from userdata where token='$token'";
$ses_sql = mysqli_query($con,$query);
$row = mysqli_fetch_assoc($ses_sql);
	if(isset($_POST['reset'])){
		$password = $con->real_escape_string($_POST['password']);
		$cpassword = $con->real_escape_string($_POST['cpassword']);
		$userID = $con->real_escape_string($_POST['userID']);
		if ($password != $cpassword){
			echo '<script type="text/javascript">alert("Password mismatch, Please try again");</script>';
		 }else{
					$hashedPassword =password_hash($password, PASSWORD_DEFAULT);
					
				
					// $con->query("UPDATE `userdata` SET `Password` = 'dasdsadsaa' WHERE userID = '$userID'");
				$con->query("UPDATE `userdata` SET `Password` = '$hashedPassword' WHERE userID = '$userID'");
					echo '<script type="text/javascript">alert("Reset Password Successful");
					window.location = "login.php";</script>';
            
			
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
									
							<h1 class="h2">Enter your new Password</h1>
						
						</div>
									<form class="widget-form" id="login-form" action="" method="post">
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="hidden" name="userID" value="<?php echo $row['userID'] ?>" />
											<input class="form-control form-control-lg" type="password" name="email" required="" />
										</div>
                                        <div class="mb-3">
											<label class="form-label">Confirm Password</label>
											<input class="form-control form-control-lg" type="password" name="email" required="" />
										</div>
								
									
										<div class="text-center mt-3">
											<input type="submit"  class="btn btn-lg btn-primary" Value="Reset" name="reset" style="background-color: #297506; border-color: border-color: coral;"></br>
											<!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
											 <a href="login.php">Already have an account?</a>
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