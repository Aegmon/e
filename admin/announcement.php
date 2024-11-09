<?php

include("sidebar.php");
if(isset($_POST['submit'])){
    $announcement = $con->real_escape_string($_POST['announcement']);

    $con->query("INSERT INTO `annoucement`(`content`) VALUES('$announcement')");
 
    echo '<script type="text/javascript">alert("Successful");</script>';

}

if(isset($_POST['delete'])){
	$announce_id = $con->real_escape_string($_POST['announce_id']);
	mysqli_query($con,"DELETE FROM `annoucement` WHERE `announce_id`='$announce_id'");
	echo '<script type="text/javascript">alert("Delete Successful");</script>';
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
							<div class="card flex-fill">
								<div class="card-header">

									<h5 class="card-title mb-4">Announcement</h5>

                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Add Announcement
</button>

<!-- Modal -->
<form  action="" method="post" enctype="multipart/form-data">
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
    
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="m-3">
<h3>Announcement</h3>

  </div>
  <div class="m-3">
<textarea class="form-control" name="announcement">

</textarea>

  </div>

  <div class="m-3">
<input type="file" class="form-control" name="picture">



  </div>


    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</form>









								</div>
							<table class="table table-bordered">
									<thead>
										<tr>
											<th style="text-align: center;">Content</th>
											<th style="text-align: center;">Action</th>
										
										
									
										
										</tr>
									</thead>
									<tbody>
                                        <?php
                                                       $qry = "SELECT * from annoucement";
                                                       $ses_sql = mysqli_query($con,$qry);
                                                      while ($row = mysqli_fetch_array($ses_sql)) {
													
                                        
                                        ?>

										<tr>
											<td style="text-align: center;"><?php echo $row['content'];?></td>
											<td style="text-align: center;">
                                            <form  action="" method="post" enctype="multipart/form-data">
						                 	<input type="hidden" name="announce_id" value=" <?php echo $row["announce_id"]; ?>">  
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