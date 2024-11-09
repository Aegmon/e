<?php

include("sidebar.php");
if(isset($_POST['create'])){
    $con1 = new PDO("mysql:host=localhost;dbname=thesis_db","root","");
	$name = $_FILES['file']['name'];
	$type = $_FILES['file']['type'];
	$data = file_get_contents($_FILES['file']['tmp_name']);
	$st = $con1->prepare("INSERT INTO adminform values ('0',?,?,?)");
	$st->bindParam(1,$name);
	$st->bindParam(2,$type);
	$st->bindParam(3,$data);
	$st->execute();
        echo '<script type="text/javascript">alert("Upload succesful");</script>';
}
if(isset($_POST['delete'])){
	$delete = $con->real_escape_string($_POST['id']);
	mysqli_query($con,"DELETE FROM `adminform` WHERE `a_id`='$delete'");
	$log = "Delete Annoucement ID = $delete"; 
	$con->query("INSERT INTO `logs`(`logs`) VALUES  ('$log')");
	echo '<script type="text/javascript">alert("Delete Successful");</script>';
	}
	if(isset($_POST['delpic'])){
		$delete = $con->real_escape_string($_POST['picture_id']);
		mysqli_query($con,"DELETE FROM `picture` WHERE `picture_id`='$delete'");
		echo '<script type="text/javascript">alert("Delete Successful");</script>';
		}
		if(isset($_POST['upload'])){
			$title =$con->real_escape_string($_POST['title']);
			$image = $_FILES['image']['name'];
			$target = "../assets/".basename($image);
			$log = "Add Annoucement -$title";
			$con->query("INSERT INTO `logs`(`logs`) VALUES  ('$log')");
			$con->query("INSERT INTO `picture`(`Title`, `image`) VALUES('$title','$image')");
			move_uploaded_file($_FILES['image']['tmp_name'], $target);
			
		}
?>

		<div class="main" style="background:url('../assets/pubmatfour.png'); background-repeat: no-repeat;
  background-size:  100%;">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					
					<div class="row">
					<div class="col-12 col-lg-12 col-xxl-12 d-flex">
							<div class="card flex-fill p-2">
								<div class="card-header">

									<h5 class="card-title mb-4">Annoucement</h5>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                Add Image
                                 </button>
								</div>
						
								
<form action="" method="post" enctype="multipart/form-data">
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
			<lable class="form-label">Title</lable>
			<input type="text"  name="title" class="form-control">
		</div>
		<div class="form-group">
			<input type="file"  name="image"class="form-control">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="upload" class="btn btn-primary">Upload</button>
      </div>
    </div>
  </div>
</div>
</form>
							<table class="table table-bordered">
									<thead>
										<tr>
											<th style="text-align: center;">Image</th>
											<th style="text-align: center;">Title</th>
									
										
											<th style="text-align: center;"class="d-none d-md-table-cell">Action</th>
									
										
										</tr>
									</thead>
									<tbody>
                                        <?php
                                                       $qry = "SELECT * from picture";
                                                       $ses_sql = mysqli_query($con,$qry);
                                                      while ($row = mysqli_fetch_array($ses_sql)) {

                                        
                                        ?>

										<tr>
											<td style="text-align: center;">
											<img src="../assets/<?php echo $row['image']?>"  width="100" height="100" />
                                           </td>
											<td style="text-align: center;">
											<?php echo $row['Title']?>
										    </td>
											<td style="text-align: center;">
											<form method="post" action="">
											<input type="hidden" name="picture_id" value="<?php echo $row['picture_id']?>"/>
											<button type="submit" name="delpic" class="btn btn-danger">Delete</button>
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

                    <div class="row">
					<div class="col-4 col-lg-4 col-xxl-4 d-flex">
							<div class="card flex-fill">
								<div class="card-header">

									<h5 class="card-title mb-0">Application Form</h5>
								</div>
								<div class="card-header">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenterr">
Application Form
</button>
                                </div>
								<form action=" " method="post" enctype="multipart/form-data">
								<div class="modal fade" id="exampleModalCenterr" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
       
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div class="mb-3">
								
		<input type="file" class="form-control" name="file" aria-describedby="basic-addon1" accept="application/pdf">
	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<input type="submit"  class="btn btn-lg btn-primary" Value="Upload" name="create"></br>
      </div>
    </div>
  </div>
</div>
													  </form>
							<table class="table table-bordered">
									<thead>
										<tr>
											<th style="text-align: center;">Application Form</th>
										
									
										
											<th style="text-align: center;"class="d-none d-md-table-cell">Action</th>
									
										
										</tr>
									</thead>
									<tbody>
                                        <?php
                                                       $qry = "SELECT * from adminform";
                                                       $ses_sql = mysqli_query($con,$qry);
                                                      while ($row = mysqli_fetch_array($ses_sql)) {

                                        
                                        ?>

										<tr>
											<td style="text-align: center;"><?php echo $row['name']?>
                                        </td>
											<td style="text-align: center;">
											<form  action="" method="post" enctype="multipart/form-data">
	   

							<input type="hidden" name="id" value=" <?php echo $row["a_id"]; ?>">  
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
			</main>

		</div>
	</div>

	<script src="js/app.js"></script>

</body>

</html>