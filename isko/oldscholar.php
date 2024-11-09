<?php
include("sidebar.php");
if(isset($_POST['delete'])){
	$delete = $con->real_escape_string($_POST['formID']);
	mysqli_query($con,"DELETE FROM `forms` WHERE `formID`='$delete'");
	echo '<script type="text/javascript">alert("Delete Successful");</script>';
	}
?>

		<div class="main" style="background:url('../assets/user_bg.png');
  background-size:  100%;">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				
			</nav>

            <main class="content"  >
				<div class="container-fluid p-0">

					

					<div class="row">
						<div class="col-12" >
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0"></h5>
								</div>
								<div class="card-body" >
                                <div class="text-center mb-4">
       
                                <h1>Hello <strong style="color: red;"><?php echo $fname.' '.$lname?></strong> !</h1>
									<p class="text-muted">We are thrilled to welcome you here ka-Iskolar! We are greatful to assist you through your Iskolar Journey. Curious what's happening today? Head on over to the notification page and see for announcements from our dear Mayor.</p>

                                        <div class="mb-3">
                                <a type="button"  href="index.php"class="btn btn-primary btn-lg "style="background-color: #297506; border-color: border-color: coral;">OK</a>
										</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12" >
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Upload all documents needed</h5>
								</div>
								<div class="card-body" >
								<form action=" " method="post" enctype="multipart/form-data">
                                <div class="text-center mb-4">
								<div class="mb-3">
											<label class="form-label">Title</label>
									
				 							<select class="form-control" aria-label="Default select example"  name="title">
                                            <option selected disabled>Select</option>
                                           <option value="Application Form">Application Form</option>
                                           <option value="Application Letter">Application Letter</option>
                                          <option value="Cretificate of Registration">Cretificate of Registration</option>
                                           <option value="COG">COG</option>
                                           <option value="Barangay Indigency">Barangay Indigency</option>
                                           <option value="Barangay Indigency">Resume</option>
                                           </select>
										</div>
								</div>
                                 <div class="mb-3">
                                         <input type="file" class="form-control" placeholder="" name="file"  aria-describedby="basic-addon1"accept="application/pdf">
										</div>
                                        <div class="mb-3">
                                         <input type="submit"  class="btn btn-lg btn-primary"  name="upload" value="Upload"aria-describedby="basic-addon1"style="background-color: #297506; border-color: border-color: coral;">
										 <span style="color:red;">PDF only*</span>
										</div>
								</div>
								</form>
                                </div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-6" >
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Documents</h5>
								</div>
								<div class="card-body" >
                                <div class=" mb-4">
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
    
</body>

</html>