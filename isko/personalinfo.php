<?php
include('../connection.php');
$user_check = $_GET['userID'];

if(isset($_POST['create'])){
$fname = $con->real_escape_string($_POST['fname']);
		$lname = $con->real_escape_string($_POST['lname']);
		$number = $con->real_escape_string($_POST['number']);
		$dob = $con->real_escape_string($_POST['dob']);
		$rel_stat = $con->real_escape_string($_POST['rel_stat']);
		$stud_num = $con->real_escape_string($_POST['stud_num']);
		$address = $con->real_escape_string($_POST['address']);
		$address1 = $con->real_escape_string($_POST['address1']);
		$address2 = $con->real_escape_string($_POST['address2']);
		$yr_lvl = $con->real_escape_string($_POST['yr_lvl']);
		$course = $con->real_escape_string($_POST['course']);
        $image = $_FILES['image']['name'];
		$target = "../assets/img/".basename($image);
		move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $con->query("INSERT INTO `scholarinfo`(`userID`, `firstName`, `LastName`, `number`, `dob`, `rel_stat`, `stud_num`, `address`, `address1`, `address2`, `yr_lvl`, `course`, `image`)
         VALUES ('$user_check','$fname','$lname','$number','$dob','$rel_stat','$stud_num','$address','$address1','$address2','$yr_lvl','$course','$image')");
        $info_qry = "SELECT * from scholarinfo where userID='$user_check'";
        $info_ses = mysqli_query($con,$info_qry);
        $info = mysqli_fetch_assoc($info_ses);
        $infoid = $info['scholarID'];
        header("location: mothersinfo.php?scholarID=".$infoid);
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
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
  background-size:  125%;">
				<div class="container-fluid p-0">
                <div class="row">
				<div class=" col-md-6  mx-auto   mt-10">
				

						
                <form action=" " method="post" enctype="multipart/form-data" >
						<div class="card">
							<div class="card-body">
                            <div class="card-header text-center">
								<h1> Personal Information</h1>
								</div>
								<div class="m-sm-2">
                              
									<div class="text-center mb-3">
                                    <img src="../assets/LogoSM.png"  id="output" alt="" class="img-fluid rounded-circle mb-2" width="178" height="178" />
                                    <div text-center"> 
                                        <input class="form-control form-control-lg text-center" onchange="validateSize(this)" id="image" type="file" name="image" required="" accept="image/*" onchange="loadFile(event)"/>
                                    </div>
									</div>
								
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
                                            <label class="form-label">Student Number</label>
                                         <input type="text" class="form-control" placeholder="" name="stud_num" aria-describedby="basic-addon1">
                                            </div>
                                            <div class="col-6">
                                            <label class="form-label">Course</label>
                                         <input type="text" class="form-control"  name="course" aria-describedby="basic-addon1">
                                                </div>

                                        </div>
										</div>
                                        <div class="mb-3">
											<label class="form-label">Contact Number</label>
                                         <input type="number" class="form-control" placeholder="" name="number" aria-describedby="basic-addon1"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  required="" maxlength = "11" minlength="11">
										</div>
										<div class="mb-3">
											<label class="form-label">Date of Birth</label>
                                         <input type="date" class="form-control" placeholder="" name="dob" aria-describedby="basic-addon1" required="">
										</div>
										<div class="mb-3">
											<label class="form-label">Civil Status</label>
				 							<select class="form-control" aria-label="Default select example"  name="rel_stat" required="">
                                            <option selected disabled>Civil Status</option>
                                           <option value="Single">Single</option>
                                           <option value="Married">Married</option>
                                          <option value="Widowed">Widowed</option>
                                           <option value="Legally Separated">Legally Separated</option>
                                           </select>
										</div>
								
										
									
										<div class="mb-3">
											<label class="form-label">Address</label>
                                         <input type="text" class="form-control"  name="address" aria-describedby="basic-addon1" placeholder="House No./Street" required="">
										</div>
										<div class="mb-3">
                        
										 <select name="address1" id="cars" class="form-control form-control-lg mb-3">
										 <option selected disabled>Barangay</option>
   <?php
   	$sql = "SELECT * FROM barangay";
	   $result = $con->query($sql);
 	if($result->num_rows > 0) {
		//output data
		while($row = $result->fetch_assoc()) {

			echo '<option value="'.$row["brgy"].'">'.$row["brgy"].'</option>';

			}
			
	}
 	//Close   
   ?>

  </select>
										</div>

										<div class="mb-3">
                                         <input type="text" class="form-control"  name="address2" Value="San Miguel" readonly aria-describedby="basic-addon1" required="">
										</div>
										<div class="mb-3">
											<label class="form-label">Year Level</label>
                                    
										 <select class="form-control" aria-label="Default select example"  name="yr_lvl" required="">
                                            <option selected disabled>Select</option>
                                           <option value="First Year">1st Year</option>
                                           <option value="Second Year">2nd Year</option>
                                          <option value="Third Year">3rd Year</option>
                                           <option value="Fourth Year ">4th Year</option>
										   <option value="Others">Others</option>
                                           </select>
										</div>
										<div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" required="">
  <label class="form-check-label" for="defaultCheck1">
  <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalLong"> <i class="fa fa-plus" aria-hidden="true">Privacy Policy</i> </a>
  </label>
  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Privacy Policy</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
			<p>This Privacy Policy describes Our policies and procedures on the collection, use and disclosure of Your information when You use the Service and tells You about Your privacy rights and how the law protects You.</p>
		<p>We use Your Personal data to provide and improve the Service. By using the Service, You agree to the collection and use of information in accordance with this Privacy Policy. This Privacy Policy has been created with the help of the Privacy Policy Generator.</p>
		</div>
		<div class="form-group">
			<h2 class="text-center">Interpretation and Definitions</h2>
			<h4>Interpretation</h4>
			<p>The words of which the initial letter is capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.</p>
			<h4 >Definitions</h4>
			<p>For the purposes of this Privacy Policy:</p>
			<p class="ml-3"><b>Account </b>means a unique account created for You to access our Service or parts of our Service.</p>
			<p class="ml-3"><b>Company </b>(referred to as either "the Company", "We", "Us" or "Our" in this Agreement) refers to Reporma at Tagumpay para sa San Miguelenos.</p>
			<p class="ml-3"><b>Cookies </b>are small files that are placed on Your computer, mobile device or any other device by a website, containing the details of Your browsing history on that website among its many uses.</p>
			<p class="ml-3"><b>Country </b>refers to: Philippines</p>
			<p class="ml-3"><b>Device </b>means any device that can access the Service such as a computer, a cellphone or a digital tablet.</p>
			<p class="ml-3"><b>Personal Data </b>means any device that can access the Service such as a computer, a cellphone or a digital tablet.</p>
			<p class="ml-3"><b>Service </b>refers to the Website.</p>
			<p class="ml-3"><b>Service Provider </b>means any natural or legal person who processes the data on behalf of the Company. It refers to third-party companies or individuals employed by the Company to facilitate the Service, to provide the Service on behalf of the Company, to perform services related to the Service or to assist the Company in analyzing how the Service is used.</p>
			<p class="ml-3"><b>Usage Data </b>refers to data collected automatically, either generated by the use of the Service or from the Service infrastructure itself (for example, the duration of a page visit).</p>
			<p class="ml-3"><b>Website </b>refers to data collected automatically, either generated by the use of the Service or from the Service infrastructure itself (for example, the duration of a page visit).</p>
			<p class="ml-3"><b>You </b>means the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.</p>
		</div>
		<div class="form-group">
		<h2 class="text-center">Collecting and Using Your Personal Data</h2>
		<h4>Types of Data Collected</h4>
		<p><b>Personal Data</b></p>
		<p>While using Our Service, We may ask You to provide Us with certain personally identifiable information that can be used to contact or identify You. Personally identifiable information may include, but is not limited to:</p>
		<p class="ml-3">Email address</p>
		<p class="ml-3">First name and last name</p>
		<p class="ml-3">Phone number</p>
		<p class="ml-3">Address, State, Province, ZIP/Postal code, City</p>
		<p class="ml-3">Usage Data</p>
	</div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Okay</button>
    
      </div>
    </div>
  </div>
</div>
  
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
                

					<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
					</div>
                
				</div>
			</main>

		</div>
	</div>

	<script src="js/app.js"></script>
    <script>
		function validateSize(input) {
  const fileSize = input.files[0].size / 1024 / 1024; // in MiB
  if (fileSize > 2) {
    alert('File size exceeds 2 MiB');
	document.getElementById("image").value = "";
  } else {
	
  }
}
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