<?php
include('../connection.php');
$user_check = $_GET['scholarID'];

if(isset($_POST['create'])){
        $fname = $con->real_escape_string($_POST['fname']);
		$lname = $con->real_escape_string($_POST['lname']);
		$number = $con->real_escape_string($_POST['number']);
		$dob = $con->real_escape_string($_POST['dob']);
		$edu = $con->real_escape_string($_POST['edu']);
        $income = $con->real_escape_string($_POST['income']);
        $occupation = $con->real_escape_string($_POST['occupation']);
		$address = $con->real_escape_string($_POST['address']);
		$source = $con->real_escape_string($_POST['source']);
		
        $con->query("INSERT INTO `father`(`scholarID`, `ffname`, `flname`, `fnumber`, `fdob`, `fedu`, `fincome`, `fs_income`, `foccupation`, `faddress`) VALUES
         ('$user_check','$fname','$lname','$number','$dob','$edu','$income','$source','$occupation','$address')");
        $info_qry = "SELECT * from father where scholarID='$user_check'";
        $info_ses = mysqli_query($con,$info_qry);
        $info = mysqli_fetch_assoc($info_ses);
        $infoid = $info['scholarID'];
        header("location: guardianinfo.php?scholarID=".$infoid);
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

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-profile.html" />

	<title>Profile</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.php">
          <span class="align-middle">Welcome Iskolar</span>
        </a>
				<ul class="sidebar-nav">
					<li class="sidebar-item">
						<a class="sidebar-link" href="logout.php">
              <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Logout</span>
            </a>
					</li>
                 
		
				</ul>

		
			</div>
		</nav>
		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				
			</nav>

			<main class="content" style="background:url('../assets/StepByStep_regBg.png'); background-repeat: no-repeat;
  background-size:  120%;">
				<div class="container-fluid p-0">
                <div class="row">
				<div class=" col-md-6  mx-auto   mt-10">
				

						
                <form action=" " method="post" enctype="multipart/form-data">
						<div class="card">
							<div class="card-body">
                            <div class="card-header text-center">
								<h4 style="  
  border-radius: 107px;
  border: 2px solid #73AD21;
  padding: 20px;
  margin: auto;
  width: 68px;
  text-align: center;
  ">2</h4>
								</div>
                            <div class="card-header text-center">
								<h1>Father's Information</h1>
								</div>
								<div class="m-sm-2">
                              
								
										<div class="mb-3">
										<div class="row mb-3">
                                            <div class="col-6">
                                            <input class="form-control form-control-lg" type="text" name="fname" required="" placeholder="First Name" />
                                            </div>
                                            <div class="col-6">
                                            <input class="form-control form-control-lg" type="text" name="lname" required="" placeholder="Last Name" />
                                                </div>

                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-6">
                                            <label class="form-label">Educational Attainment</label>
                                         <input type="text" class="form-control" placeholder="" name="edu" aria-describedby="basic-addon1">
                                            </div>
                                            <div class="col-6">
                                            <label class="form-label">Occupation</label>
                                         <input type="text" class="form-control"  name="occupation" aria-describedby="basic-addon1">
                                                </div>

                                        </div>
										</div>
                                        <div class="mb-3">
										<div class="mb-3">
											<label class="form-label">Source of Income</label>
                                         <input type="text" class="form-control" placeholder="" name="source" aria-describedby="basic-addon1">
										</div>
											<label class="form-label">Monthly Income</label>
                                        	<select class="form-control" aria-label="Default select example"  name="income">
                                            <option selected disabled>Select</option>
                                           <option value="Php 3,000.00 or below">Php 3,000.00 or below</option>
                                           <option value="Php 3,000.00 - Php 6,000.00">Php 3,000.00 - Php 6,000.00</option>
                                          <option value="Php 6,001.00 - Php 9,000.00">Php 6,001.00 - Php 9,000.00</option>
                                           <option value="Php 9,001.00 - Php 12,000.00">Php 9,001.00 - Php 12,000.00</option>
										   <option value="Php 12,001.00 - Php 15,000.00">Php 12,001.00 - Php 15,000.00</option>
										   <option value="Php 15,000.001.00 - Php 18,000.00">Php 15,000.001.00 - Php 18,000.00</option>
										   <option value="Php 18,001.00 - Php 21,000.00">Php 18,001.00 - Php 21,000.00</option>
										   <option value="Php 21,001.00 or above">Php 21,001.00 or above</option>
										   <option value="None">None</option>
                                           </select>
										</div>
										</div>
                                        <div class="mb-3">
											<label class="form-label">Contact Number</label>
                                         <input type="number" class="form-control" placeholder="" name="number" aria-describedby="basic-addon1"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  maxlength = "11" minlength="11">
										</div>
										<div class="mb-3">
											<label class="form-label">Date of Birth</label>
                                         <input type="date" class="form-control" placeholder="" name="dob" aria-describedby="basic-addon1">
										</div>
										<div class="mb-3">
											<label class="form-label">Civil Status</label>
				 							<select class="form-control" aria-label="Default select example"  name="rel_stat">
                                            <option selected disabled>Civil Status</option>
                                           <option value="Single">Single</option>
                                           <option value="Married">Married</option>
                                          <option value="Widowed">Widowed</option>
                                           <option value="Legally Separated">Legally Separated</option>
                                           </select>
										</div>
								
										
									
										<div class="mb-3">
											<label class="form-label">Address</label>
                                         <input type="text" class="form-control"  name="address" aria-describedby="basic-addon1">
										</div>
									
                                    </div>
								
									
										<div class="text-center mt-3">
											<input type="submit"  class="btn btn-lg btn-primary" Value="Next" name="create"></br>
									
										</div>
												<div class="text-center mt-3">
									
									<button class="btn btn-lg btn-primary" onclick="history.back()">Back</button></br>
							
								</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
                </form>
		</div>
                        </div> 
                

					
					</div>
                
				</div>
			</main>

		</div>
	</div>

	<script src="js/app.js"></script>
    <script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>

</body>

</html>