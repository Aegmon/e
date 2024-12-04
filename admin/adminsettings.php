<?php
include("sidebar.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ensure the button has been clicked
    if (isset($_POST['update_userdata'])) {
        // Retrieve form data
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $userID = $id; // Replace with dynamic user ID retrieval logic if available

        if (!empty($password) && !empty($cpassword)) {
            // If passwords are provided, validate and update both email and password
            if ($password === $cpassword) {
                // Hash the password for security
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Update email and password in the userdata table
                $updateUserQuery = "UPDATE userdata 
                                    SET Email = ?, Password = ? 
                                    WHERE userID = ?";
                $stmt = $con->prepare($updateUserQuery);
                $stmt->bind_param("ssi", $email, $hashedPassword, $userID);
            } else {
                echo "<script>alert('Passwords do not match.');</script>";
                exit;
            }
        } else {
            // If password fields are empty, update only the email
            $updateUserQuery = "UPDATE userdata 
                                SET Email = ? 
                                WHERE userID = ?";
            $stmt = $con->prepare($updateUserQuery);
            $stmt->bind_param("si", $email, $userID);
        }

        // Execute the query and handle the response
        if ($stmt->execute()) {
                $_SESSION['login_user'] = $email;
            echo "<script>
                    alert('User data updated successfully!');
                    window.location.href = 'adminsettings.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Failed to update user data.');
                  </script>";
        }
    }
}
?>



		<div class="main" >
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

		
					<div class="row">
					
							
                 
						<div class="col-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Email & Password</h5>
								</div>
                            <form action="" method="post">
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control form-control-lg" type="text" name="email" value="<?php echo $email; ?>" required="" placeholder="Enter your email" />
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input class="form-control form-control-lg" type="password" name="password" />
        </div>
        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input class="form-control form-control-lg" type="password" name="cpassword" />
        </div>
        <div class="mb-3">
            <input type="submit" class="btn btn-lg btn-primary" name="update_userdata" value="Update" aria-describedby="basic-addon1">
        </div>
    </div>
</form>
  
						</div> 
					</div>

				</div>
			</main>
		</div>
	</div>

	<script src="js/app.js"></script>

</body>

</html>