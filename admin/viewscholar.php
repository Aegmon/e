<?php

include("sidebar.php");
$id = $_GET['stud_num'];
$info_qry = "SELECT * from scholarinfo t1
join userdata t5
on t5.userID = t1.userID
join mother t2
on t1.scholarID = t2.scholarID
join father t3
on t2.scholarID = t3.scholarID
join guardian t4
on t3.scholarID = t4.scholarID  WHERE stud_num = '$id'";
$info_ses = mysqli_query($con,$info_qry);
$info = mysqli_fetch_assoc($info_ses);
$fname = $info['firstName'];
$lname = $info['LastName'];
$studnum = $info['stud_num'];
$address = $info['address'];
$number = $info['number'];
$userID = $info['userID'];
$rel_stat = $info['rel_stat'];
$yr_lvl = $info['yr_lvl'];
$course = $info['course'];
$dob = $info['dob'];
$email = $row2['Email'];
$infoid = $info['scholarID'];
$picture = $info['image'];
$schstat = $info['sc_status'];
$mfname = $info['mfname'];
$mlname = $info['mlname'];
$maddress = $info['maddress'];
$mnumber = $info['mnumber'];
$mdob = $info['mdob'];
$ffname = $info['ffname'];
$flname = $info['flname'];
$faddress = $info['faddress'];
$fnumber = $info['fnumber'];
$fdob = $info['fdob'];
$gfname = $info['gfname'];
$glname = $info['glname'];
$email = $info['Email'];
$rel = $info['rel'];
$gdob = $info['gdob'];
$gnumber = $info['gnumber'];
$moccupation = $info['moccupation'];
$foccupation = $info['foccupation'];
$ms_income = $info['ms_income'];
$fs_income = $info['fs_income'];
if(isset($_POST['grant'])){
	$scholarID = $con->real_escape_string($_POST['scholarID']);
	mysqli_query($con,"UPDATE `scholarinfo` SET sc_status = 'Scholar' WHERE `scholarID`='$scholarID'");
	mysqli_query($con,"UPDATE `userdata` SET verification = '1' WHERE `userID`='$userID'");
	$log = "Grant Scholarship to $fname $fname ";
	$con->query("INSERT INTO `logs`(`logs`) VALUES  ('$log')");

	function send($number,$message,$key){
	  $send = json_decode(file("https://MingSms.mingming13.repl.co?phone=$number&message=$message&key=$key"));
	  return $send->status==200?true:false;
	}
   
   $message=urlencode('Your scholarship application is granted');
   $key = 'reporma_tagumpay_scholar';
   




	echo '<script type="text/javascript">alert("Successful");</script>';
	}

	
    if(isset($_POST['decline'])){
        $scholarID = $con->real_escape_string($_POST['scholarID']);
        mysqli_query($con,"UPDATE `scholarinfo` SET sc_status = 'Declined' WHERE `scholarID`='$scholarID'");
		$log = "Declined Scholarship to $fname $fname - Incomplete Requirements ";
		$con->query("INSERT INTO `logs`(`logs`) VALUES  ('$log')");
		ini_set( 'display_errors', 1 );
		error_reporting( E_ALL );
		$from = "Reformaattagumpay@gmail.com";
		

		$subject = "Incomplete Requirements";
		$message = "
		Hi $fname $lname \n 
		From the Municipality of San Miguel, Bulacan. We are sorry to inform you that we declined your application from Reporma at Tagumapy Scholarship because your requirements is incomplete. Sorry for the inconvenience. Thank you and keep safe!
		";
	   // The content-type header must be set when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers = "From:" . $from;
		if(mail($email,$subject,$message, $headers)) {
			echo '<script type="text/javascript">alert("Student Declined");
	</script>';
		} else {
			echo '<script>alert("Error")</script>';
		}

        }

		if(isset($_POST['decline1'])){
			$scholarID = $con->real_escape_string($_POST['scholarID']);
			mysqli_query($con,"UPDATE `scholarinfo` SET sc_status = 'Declined' WHERE `scholarID`='$scholarID'");
			$log = "Declined Scholarship to $fname $fname - Invalid Requirements ";
			$con->query("INSERT INTO `logs`(`logs`) VALUES  ('$log')");
			ini_set( 'display_errors', 1 );
			error_reporting( E_ALL );
			$from = "Reformaattagumpay@gmail.com";
			
	
			$subject = "Invalid  Requirements";
			$message = "
			Hi $fname $lname \n 
			From the Municipality of San Miguel, Bulacan. We are sorry to inform you that we declined your application from Reporma at Tagumapy Scholarship because your requirements is incomplete. Sorry for the inconvenience. Thank you and keep safe!
			";
		   // The content-type header must be set when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers = "From:" . $from;
			if(mail($email,$subject,$message, $headers)) {
				echo '<script type="text/javascript">alert("Student Declined");
		</script>';
			} else {
				echo '<script>alert("Error")</script>';
			}
	
			}

			if(isset($_POST['decline2'])){
				$scholarID = $con->real_escape_string($_POST['scholarID']);
				mysqli_query($con,"UPDATE `scholarinfo` SET sc_status = 'Declined' WHERE `scholarID`='$scholarID'");
				$log = "Declined Scholarship to $fname $fname -Not Eligible for the Scholarship";
				$con->query("INSERT INTO `logs`(`logs`) VALUES  ('$log')");
				ini_set( 'display_errors', 1 );
				error_reporting( E_ALL );
				$from = "Reformaattagumpay@gmail.com";
				
		
				$subject = "Not Eligible for the Scholarship";
				$message = "
				Hi $fname $lname \n 
				From the Municipality of San Miguel, Bulacan. We are sorry to inform you that we declined your application from Reporma at Tagumapay Scholarship because you are not eligible to become our scholar. Sorry for the inconvenience. Thank you and keep safe!
				";
			   // The content-type header must be set when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers = "From:" . $from;
				if(mail($email,$subject,$message, $headers)) {
					echo '<script type="text/javascript">alert("Student Declined");
			</script>';
				} else {
					echo '<script>alert("Error")</script>';
				}
		
				}
		if(isset($_POST['delete'])){
			$delete = $con->real_escape_string($_POST['formID']);
			mysqli_query($con,"DELETE FROM `forms` WHERE `formID`='$delete'");
			echo '<script type="text/javascript">alert("Delete Successful");</script>';
			}
?>

		<div class="main" style="background:url('../assets/pubmatfour.png'); background-repeat: no-repeat;
  background-size:120%;">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					
					<div class="row">
						<div class="col-md-4 col-xl-3">
							<div class="card mb-3">
								<div class="card-header">
								
								</div>
								<div class="card-body text-center">
									<img src="../assets/img/<?php echo $picture?>" alt="" class="img-fluid rounded-circle mb-2" width="178" height="178" />
									<h5 class="card-title mb-0"><?php echo $fname.' '.$lname?></h5>
									<div class="text-muted mb-2">Student Number: <strong style="color: red;"><?php echo $studnum?></strong></div>

								
								</div>
								<hr class="my-0" />
						
								<hr class="my-0" />
								<div class="card-body">
									<h5 class="h6 card-title">Personal Information</h5>
									<ul class="list-unstyled mb-0">
									<li class="mb-1"><span data-feather="mail" class="feather-sm me-1"></span> Email: <a href="#"><?php echo $email?></a></li>
										<li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Lives in <a href="#"><?php echo $address?></a></li>
										<li class="mb-1"><span data-feather="phone" class="feather-sm me-1"></span> Phone Number: <a href="#"><?php echo $number?></a></li>
										<li class="mb-1"><span data-feather="user" class="feather-sm me-1"></span> Civil Status: <a href="#"><?php echo $rel_stat?></a></li>
										<li class="mb-1"><span data-feather="user" class="feather-sm me-1"></span> Year Level: <a href="#"><?php echo $yr_lvl?></a></li>
										<li class="mb-1"><span data-feather="user" class="feather-sm me-1"></span> Course: <a href="#"><?php echo $course?></a></li>
									</ul>
								</div>
								<hr class="my-0" />
						
						<hr class="my-0" />
						<div class="card-body">
							<h5 class="h6 card-title">Mother's Information</h5>
							<ul class="list-unstyled mb-0">
							<li class="mb-1"><span data-feather="user" class="feather-sm me-1"></span> Name: <a href="#"><?php echo $mfname.' '.$mlname?></a></li>
								<li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Lives in <a href="#"><?php echo $maddress?></a></li>
								<li class="mb-1"><span data-feather="phone" class="feather-sm me-1"></span> Phone Number: <a href="#"><?php echo $mnumber?></a></li>
								<li class="mb-1"><span data-feather="calendar" class="feather-sm me-1"></span>Date of Birth: <a href="#"><?php echo $mdob?></a></li>
								<li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span>Occupation: <a href="#"><?php echo $moccupation?></a></li>
								<li class="mb-1"><span data-feather="pocket" class="feather-sm me-1"></span>Soure of Income: <a href="#"><?php echo $ms_income?></a></li>
							</ul>
						</div>
						<hr class="my-0" />
						
						<hr class="my-0" />
						<div class="card-body">
							<h5 class="h6 card-title">Father's Information</h5>
							<ul class="list-unstyled mb-0">
							<li class="mb-1"><span data-feather="user" class="feather-sm me-1"></span> Name: <a href="#"><?php echo $ffname.' '.$flname?></a></li>
								<li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Lives in <a href="#"><?php echo $faddress?></a></li>
								<li class="mb-1"><span data-feather="phone" class="feather-sm me-1"></span> Phone Number: <a href="#"><?php echo $fnumber?></a></li>
								<li class="mb-1"><span data-feather="calendar" class="feather-sm me-1"></span>Date of Birth: <a href="#"><?php echo $fdob?></a></li>
								<li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span>Occupation: <a href="#"><?php echo $foccupation?></a></li>
								<li class="mb-1"><span data-feather="pocket" class="feather-sm me-1"></span>Soure of Income: <a href="#"><?php echo $fs_income?></a></li>
							</ul>
						</div>
						<hr class="my-0" />
						<div class="card-body">
							<h5 class="h6 card-title">Guardian's Information</h5>
							<ul class="list-unstyled mb-0">
							<li class="mb-1"><span data-feather="user" class="feather-sm me-1"></span> Name:  <a href="#"><?php echo $gfname.' '.$glname?></a></li>
								<li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Relationship with the beneficiary <a href="#"><?php echo $rel?></a></li>
								<li class="mb-1"><span data-feather="phone" class="feather-sm me-1"></span> Phone Number: <a href="#"><?php echo $gnumber?></a></li>
								<li class="mb-1"><span data-feather="calendar" class="feather-sm me-1"></span>Date of Birth: <a href="#"><?php echo $rel?></a></li>
							</ul>
						</div>
							
							</div>
						</div>

						<div class="col-md-8 col-xl-9">
							<div class="card">
								<div class="card-header">

									<h5 class="card-title mb-0">Documents</h5>
								</div>
								<table class="table table-hover text-center">
  <thead>
    <tr>

      <th scope="col">Title</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>
  <?php
                                                       $qry = "SELECT * from forms where scholarID = $infoid";
                                                       $ses_sql = mysqli_query($con,$qry);
                                                      while ($row = mysqli_fetch_array($ses_sql)) {
                                        
                                        ?>
    <tr>
     
      <td><?php echo $row['title']?></td>
      <td>
	  <form  action="" method="post" enctype="multipart/form-data">
	 <a class="btn btn-primary" href="file.php?formID=<?php echo $row['formID']?>"><i data-feather = 'download'></i></a>

							<input type="hidden" name="formID" value=" <?php echo $row["formID"]; ?>">  
							<button type="submit" name="delete" class="btn btn-outline-danger "><i data-feather = 'trash-2'></i></button>
				</form>
	</td>
    </tr>

	<?php }?>
  </tbody>
</table>
                 <div class="mb-3 text-center">
                 <form  action="" method="post" enctype="multipart/form-data">
			


                           
							<input type="hidden" name="scholarID" value=" <?php echo $infoid ?>">  
							<?php
							if ($schstat == 'Scholar'){
								echo ' ';
							}else{
								echo '<button type="submit" name="grant" class="btn btn-outline-success ">Grant Scholarship</button>
								<button class="btn btn-outline-danger dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
								Declined Scholarship
							  </button>
							  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
								<li><button type="submit" name="decline" class="dropdown-item">Incomplete Requirements</button></li>
								<li><button type="submit" name="decline1" class="dropdown-item">Invalid Requirements</button></li>
								<li><button type="submit" name="decline2" class="dropdown-item">Not Eligible for the Scholarship</button></li>
							  </ul>
								 ';
							}
							
							?>
					
                 
				</form>



                 </div>
						</div>
					</div>

				</div>
			</main>

		</div>
	</div>

	<script src="js/app.js"></script>

</body>

</html>