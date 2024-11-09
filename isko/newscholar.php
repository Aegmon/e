<?php

include("sidebar.php");
if(isset($_POST['upload'])){
    $title = $con->real_escape_string($_POST['title']);

    $con1 = new PDO("mysql:host=localhost;dbname=thesis_db","root","");
	$name = $_FILES['file']['name'];
	$type = $_FILES['file']['type'];
	$data = file_get_contents($_FILES['file']['tmp_name']);
	$st = $con1->prepare("INSERT INTO forms values ('0','$infoid','$title',?,?,?)");
	$st->bindParam(1,$name);
	$st->bindParam(2,$type);
	$st->bindParam(3,$data);
	$st->execute();
        echo '<script type="text/javascript">alert("Upload Successfully");</script>';
      
}
if(isset($_POST['delete'])){
	$delete = $con->real_escape_string($_POST['formID']);
	mysqli_query($con,"DELETE FROM `forms` WHERE `formID`='$delete'");
	echo '<script type="text/javascript">alert("Delete Successful");</script>';
	}



?>

		<div class="main"  style="background:url('../assets/user_bg.png'); 
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
       
                                <h1>Hello <strong ><?php echo $fname.' '.$lname?></strong> !</h1>
									<p class="text-muted">In order to apply for scholarship, please provide all neccesarry details below</p>

                                    <p class="text-muted">Upload all <a href="#"  data-toggle="modal" data-target="#exampleModalCenter">documents</a> needed</p>

									<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Documents</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="mb-3">
        <h3>Application Form</h3>
	  </div>
	  <div class="mb-3">
        <h3>Application Letter</h3>
	  </div>
	  <div class="mb-3">
        <h3>Certificate of Registration</h3>
	  </div>
	  <div class="mb-3">
        <h3>COG</h3>
	  </div>
	  <div class="mb-3">
        <h3>Barangay Indigency</h3>
	  </div>
	  <div class="mb-3">
        <h3>Resume</h3>
	  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Okay</button>
      </div>
    </div>
  </div>
</div>



<?php
                                                       $qry = "SELECT * from adminform";
                                                       $ses_sql = mysqli_query($con,$qry);
                                                      while ($row = mysqli_fetch_array($ses_sql)) {

                                        
                                        ?>

                                    <p class="text-muted">You can download the <strong style="color: red;">APPLICATION FORM</strong> <a href="file.php?a_id=<?php echo $row['a_id']?>">here.</a> </p>
									<?php }?>
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
                                         <input type="file" class="form-control" placeholder="" name="file"  aria-describedby="basic-addon1">
										</div>
                                        <div class="mb-3">
                                         <input type="submit"  class="btn btn-lg btn-primary"  name="upload" value="Upload"aria-describedby="basic-addon1">
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