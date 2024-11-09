<?php

include("sidebar.php");
if(isset($_POST['delete'])){
	$delete = $con->real_escape_string($_POST['id']);
	mysqli_query($con,"DELETE FROM `userdate` WHERE `userID`='$delete'");
	echo '<script type="text/javascript">alert("Delete Successful");</script>';
	}
?>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				
			</nav>

			<main class="content" style="background:url('../assets/pubmatfour.png'); background-repeat: no-repeat;
  background-size:  100%;">
				<div class="container-fluid p-0">

					
					<div class="row">
					<div class="col-12 col-lg-12 col-xxl-12 d-flex">
							<div class="card flex-fill">
								<div class="card-header">

									<h5 class="card-title mb-0">Scholars</h5>
								</div>
							<table class="table table-bordered">
									<thead>
										<tr>
											<th style="text-align: center;">Email</th>
											<th style="text-align: center;">Role</th>
											<th style="text-align: center;"class="d-none d-xl-table-cell">Action</th>
										
									
										
										</tr>
									</thead>
									<tbody>
                                        <?php
                                                       $qry = "SELECT * from userdata where userRole= 'Admin'";
                                                       $ses_sql = mysqli_query($con,$qry);
                                                      while ($row = mysqli_fetch_array($ses_sql)) {
													
                                        
                                        ?>

										<tr>
											<td style="text-align: center;"><?php echo $row['Email'];?></td>
											<td style="text-align: center;">
											<?php echo $row['userRole']?>
										    </td>
											<td style="text-align: center;">
										
										
										
											<form  action="" method="post" enctype="multipart/form-data">
	   

	   <input type="hidden" name="id" value=" <?php echo $row["userID"]; ?>">  
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