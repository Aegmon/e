<?php
include('../connection.php');
$user_check = $_GET['scholarID'];


if(isset($_POST['create'])){

 
    $con1 = new PDO("mysql:host=127.0.0.1;dbname=u867152262_thesis_db","u867152262_admin","RT_Smb123");
	$name = $_FILES['file']['name'];
	$type = $_FILES['file']['type'];
	$data = file_get_contents($_FILES['file']['tmp_name']);
	$st = $con1->prepare("INSERT INTO forms values ('0','$user_check','Application Form',?,?,?)");
	$st->bindParam(1,$name);
	$st->bindParam(2,$type);
	$st->bindParam(3,$data);
	$st->execute();

    $con1 =new PDO("mysql:host=127.0.0.1;dbname=u867152262_thesis_db","u867152262_admin","RT_Smb123");
	$name = $_FILES['file1']['name'];
	$type = $_FILES['file1']['type'];
	$data = file_get_contents($_FILES['file1']['tmp_name']);
	$st = $con1->prepare("INSERT INTO forms values ('0','$user_check','Application Letter',?,?,?)");
	$st->bindParam(1,$name);
	$st->bindParam(2,$type);
	$st->bindParam(3,$data);
	$st->execute();


	$con1 = new PDO("mysql:host=127.0.0.1;dbname=u867152262_thesis_db","u867152262_admin","RT_Smb123");
	$name = $_FILES['file2']['name'];
	$type = $_FILES['file2']['type'];
	$data = file_get_contents($_FILES['file2']['tmp_name']);
	$st = $con1->prepare("INSERT INTO forms values ('0','$user_check','Cretificate of Registration',?,?,?)");
	$st->bindParam(1,$name);
	$st->bindParam(2,$type);
	$st->bindParam(3,$data);
	$st->execute();

	$con1 = new PDO("mysql:host=127.0.0.1;dbname=u867152262_thesis_db","u867152262_admin","RT_Smb123");
	$name = $_FILES['file3']['name'];
	$type = $_FILES['file3']['type'];
	$data = file_get_contents($_FILES['file3']['tmp_name']);
	$st = $con1->prepare("INSERT INTO forms values ('0','$user_check','Barangay Indigency',?,?,?)");
	$st->bindParam(1,$name);
	$st->bindParam(2,$type);
	$st->bindParam(3,$data);
	$st->execute();

	$con1 = new PDO("mysql:host=127.0.0.1;dbname=u867152262_thesis_db","u867152262_admin","RT_Smb123");
	$name = $_FILES['file4']['name'];
	$type = $_FILES['file4']['type'];
	$data = file_get_contents($_FILES['file4']['tmp_name']);
	$st = $con1->prepare("INSERT INTO forms values ('0','$user_check','Resume',?,?,?)");
	$st->bindParam(1,$name);
	$st->bindParam(2,$type);
	$st->bindParam(3,$data);
	$st->execute();





        echo '<script type="text/javascript">alert("Register Successful!, wait for the admin to review your application");
        window.location = "../index.php";</script>';
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
	
		<div class="main">
	

			<main class="content">
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
  ">3</h4>
								</div>
                            <div class="card-header text-center">
								<h1>Upload all Documents needed</h1>
								</div>
								<div class="m-sm-2">
                              
                                <div class="mb-3">
											<label class="form-label">Application Form</label>
											<input type="file" class="form-control" name="file" id="file" onchange="validateSize(this)" aria-describedby="basic-addon1" > 
				 							
										
										</div>
                                        <div class="mb-3">
										<label class="form-label">Application Letter</label>
                                         <input type="file" class="form-control" name="file1" id="file" onchange="validateSize(this)" aria-describedby="basic-addon1" > 
										</div>
										<div class="mb-3">
										<label class="form-label">Cretificate of Registration</label>
                                         <input type="file" class="form-control" name="file2" id="file" onchange="validateSize(this)" aria-describedby="basic-addon1" > 
										</div>
										<div class="mb-3">
										<label class="form-label">Barangay Indigency</label>
                                         <input type="file" class="form-control" name="file3" id="file" onchange="validateSize(this)" aria-describedby="basic-addon1" > 
										</div>
										<div class="mb-3">
										<label class="form-label">Resume</label>
                                         <input type="file" class="form-control" name="file4" id="file" onchange="validateSize(this)" aria-describedby="basic-addon1" > 
										</div>
                                      
								
									
										<div class="text-center mt-3">
											<input type="submit"  class="btn btn-lg btn-primary" Value="Submit" name="create"></br>
									
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
  function validateSize(input) {
  const fileSize = input.files[0].size / 1024 / 1024; // in MiB
  if (fileSize > 5) {
    alert('File size exceeds 5 MiB');
	document.getElementById("file").value = "";
  } else {
	
  }
}
</script>

</body>

</html>