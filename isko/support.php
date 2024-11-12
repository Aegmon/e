<?php

include("sidebar.php");



if(isset($_POST['save'])){


	
    $email = $con->real_escape_string($_POST['email']);
    $password = $con->real_escape_string($_POST['password']);
    $cpassword = $con->real_escape_string($_POST['cpassword']);
    $fname = $con->real_escape_string($_POST['fname']);
    $lname = $con->real_escape_string($_POST['lname']);
    $number = $con->real_escape_string($_POST['number']);
    $dob = $con->real_escape_string($_POST['dob']);
    $rel_stat = $con->real_escape_string($_POST['rel_stat']);
    $stud_num = $con->real_escape_string($_POST['stud_num']);
    $address = $con->real_escape_string($_POST['address']);
    $yr_lvl = $con->real_escape_string($_POST['yr_lvl']);
    $course = $con->real_escape_string($_POST['course']);
    $scholarID = $con->real_escape_string($_POST['scholarID']);
    $newDate = date("Y-m-d", strtotime($dob));

    $con->query("UPDATE `scholarinfo` SET `firstName`='$fname',`LastName`='$lname',`number`='$number'
,`dob`='$dob',`rel_stat`='$rel_stat',`stud_num`='$stud_num',`address`='$address',`yr_lvl`='$yr_lvl',`course`='$course' WHERE `scholarID` = $scholarID");
    echo '<script type="text/javascript">alert("Update Successful");
    window.location = "settings.php";</script>';
}

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
         
            $query = "SELECT userID FROM userdata WHERE Email='$email'";
            $ses_sql = mysqli_query($con,$query);
            $row = mysqli_fetch_assoc($ses_sql);
            $id =$row['userID'];
            $hashedPassword =password_hash($password, PASSWORD_DEFAULT);
            $con->query("UPDATE `userdata` SET `Email`='$email',`Password`='$hashedPassword' WHERE `userID` = $id");
            echo '<script type="text/javascript">alert("Register Successful");
            window.location = "./login.php";</script>';
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
									<h5 class="card-title mb-0">Submit a Ticket</h5>
								</div>
                                <form action="" method="post">
								<div class="card-body">
								<div class="mb-3">
                                            <div class="mb-3">
                                                <label for="subject" class="form-label">Title</label>
                                                <input type="text" class="form-control" id="subject" name="subject" required>
                                            </div>
											
                                            <div class="mb-3">
											<label class="form-label">Priority</label>
											<select class="form-control" aria-label="Default select example"  name="rel_stat">
                                                <option value=""disabled selected>Select a level</option>
                                                <option value="general">General Issue</option>
                                                <option value="medium">Medium</option>
                                                <option value="critical">Critical</option>
                                            </select>
										</div>

										</div>
										<div class="mb-3">
                                            <label class="form-label">Name</label>
										    <input class="form-control form-control-lg" type="text" name="email" Value="<?php echo $email; ?>" required="" placeholder="Enter your name" />
                                        </div>

                                        <div class="mb-3">
                                        <label class="form-label">Email Address</label>
                                        <input class="form-control form-control-lg" type="email" name="email" Value="<?php echo $email; ?>" required="" placeholder="Enter your email" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="subject" class="form-label"><i>Explain your concern, include all the details related to the transaction to help speed up our investigation. </i></label>
                                            <textarea class="form-control" id="content" name="content" placeholder="write a message..."></textarea>
                                        </div>
                                        
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Attachments</label>
                                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                            </div>

                                            <div class="mb-3">
                                                <label for="subject" class="form-label"><i>Please note that the expected response time for your query is between 8:00 a.m. and 4:00 p.m.</i></label>
                                            </div>

                                            <div class="mb-3">
                                                <input type="submit"  class="btn btn-lg btn-primary"  name="#" value="Create Ticket"aria-describedby="basic-addon1" style="background-color: #297506; border-color: border-color: coral;">
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