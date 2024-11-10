<?php
include("connection.php");
	if(isset($_POST['login'])){
        session_start();
		$email = $con->real_escape_string($_POST['email']);
        $password = $con->real_escape_string($_POST['password']);
		if ($email =="" || $password ==""){
			 echo '<script type="text/javascript">alert("Check your inputs");</script>';
			}else{
				
				$sql =$con->query("SELECT * FROM userdata where Email='$email'");
				$query = "SELECT * from userdata where Email='$email'";
				$ses_sql = mysqli_query($con,$query);
				$row = mysqli_fetch_assoc($ses_sql);
				$sql1 = $row['Password'];
				$sql2 = $row['userRole'];
				$sql3 = $row['verification'];
				$sql4 = $row['userID'];
				if ($sql->num_rows >= 0 && password_verify($password,$sql1)){			
				$_SESSION['login_user'] = $email;
				
              
					switch ($sql2) {
				
						case 'Scholar':
                         if( $sql3 == '1')
						 {
							header("location: ./isko/index.php");
						 }elseif($sql3 == '2'){
							header("location: ./isko/personalinfo.php?userID=$sql4");
						 }else{
							echo '<script type="text/javascript">alert("Please Verify your email");</script>';
						 }


						
							break;	



							case 'Admin':
								$log = "Admin Login"; 
								$con->query("INSERT INTO `logs`(`logs`) VALUES  ('$log')");
							header("location: ./admin/index.php");

							break;	

							case 'Superadmin':
								header("location: ./superadmin/index.php");
								break;

                }
			
	}else{
		echo '<script type="text/javascript">alert("Check your inputs");</script>';
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

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>Sign In</title>

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
  -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
  filter: grayscale(100%);
}
	</style>
</head>

<body>
	<main class="d-flex">
		<div class="container mb-200 pb-50">
			<div class="row vh-100">
				<div class=" col-md-4  mx-auto d-table  mt-50">
					<div class="d-table-cell align-middle mb-50">

					<video autoplay muted loop id="background-video">
						<source src="./assets/mayor video.mp4" type="video/mp4">
						</video>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-2">
									<div class="text-center">
										<img src="assets/LogoSM.png" alt="Charles Hall" class="img-fluid rounded-circle" width="132" height="132" />
									</div>
									<div class="text-center mt-4">
							<h1 class="h2">Welcome Ka Iskolar!</h1>
						
						</div>
									<form class="widget-form" id="login-form" action="" method="post">
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="text" name="email" required placeholder="Enter your email" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" required placeholder="Enter your password" />
										<small>
											<a href="forgetpassword.php">Forgot password?</a>
										</small>
										</div>
								
									
										<div class="text-center mt-3">
											<input type="submit"  class="btn btn-lg btn-primary" Value="Sign in" name="login" style="background-color: #297506; border-color: border-color: coral;"></br>
											<!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
											Don't Have an account? Signup <a href="signUp.php">here.</a>
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