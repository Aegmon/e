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

		<div class="main" ;
  background-size:  100%;">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

		
					<div class="row">
						<div class="col-12 col-lg-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Personal Information</h5>
								</div>
								<div class="card-body">
                                <div class="text-center mb-4">
										<img src="../assets/LogoSM.png" alt="Charles Hall" class="img-fluid rounded-circle" width="132" height="132" />
									</div>	
                                    <form action="" method="post">
								<div class="row mb-3">
                                        <div class="col-lg-6">
                                        <input type="hidden" class="form-control" placeholder="First Name" name="scholarID" value="<?php echo $infoid ?>" aria-describedby="basic-addon1">
                                         <input type="text" class="form-control" placeholder="First Name" name="fname" value="<?php echo $fname ?>" aria-describedby="basic-addon1">
										</div>
										<div class="col-lg-6">
									
                                         <input type="text" class="form-control" placeholder="Last Name" name="lname" value="<?php echo $lname ?>" aria-describedby="basic-addon1">
										</div>

									</div>
                                    <div class="mb-3">
											<label class="form-label">Contact Number</label>
                                         <input type="text" class="form-control" placeholder="" name="number" value="<?php echo $number ?>" aria-describedby="basic-addon1">
										</div>
										<div class="mb-3">
											<label class="form-label">Date of Birth</label>
                                         <input type="date" class="form-control" placeholder="" name="dob" value="<?php echo $dob ?>"  aria-describedby="basic-addon1" readonly>
										</div>
										<div class="mb-3">
											<label class="form-label">Relationship Status</label>
											<select class="form-control" aria-label="Default select example"  name="rel_stat">
                        <option selected Value="<?php echo $rel_stat ?>"><?php echo $rel_stat ?></option>
  <option value="Single">Single</option>
  <option value="Married">Married</option>
  <option value="Widowed">Widowed</option>
  <option value="Legally Separated">Legally Separated</option>
</select>
										</div>
										
										<div class="mb-3">
											<label class="form-label">Address</label>
                                         <input type="text" class="form-control"  name="address" value="<?php echo $address ?>"aria-describedby="basic-addon1" >
										</div>
										<div class="mb-3">
											<label class="form-label">Year Level</label>
                                         <input type="text" class="form-control"name="yr_lvl"  value="<?php echo $yr_lvl ?>"aria-describedby="basic-addon1">
										</div>
										<div class="mb-3">
											<label class="form-label">Course</label>
                                         <input type="text" class="form-control"  name="course" value="<?php echo $course ?>"aria-describedby="basic-addon1">
										</div>
                                        <div class="mb-3">
                                         <input type="submit"  class="btn btn-lg btn-primary"  name="save" value="Update"aria-describedby="basic-addon1" style="background-color: #297506; border-color: border-color: coral;">
										</div>
								</div>
                                </form>   
							</div>

						</div>
                
						<div class="col-12 col-lg-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Email & Password</h5>
								</div>
                                <form action="" method="post">
								<div class="card-body">
								<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="text" name="email" Value="<?php echo $email; ?>" required="" placeholder="Enter your email" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password"  />
                                            </div>
                                            <div class="mb-3">
											<label class="form-label">Confirm Password</label>
											<input class="form-control form-control-lg" type="password" name="cpassword"   />
                                            </div>
                                            <div class="mb-3">
                                         <input type="submit"  class="btn btn-lg btn-primary"  name="#" value="Update"aria-describedby="basic-addon1" style="background-color: #297506; border-color: border-color: coral;">
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