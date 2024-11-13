<?php

include("sidebar.php");

?>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				
			</nav>

			<main class="content"  style="background-color: #F3F3F3; background-repeat: no-repeat;
  background-size:  112%;">
				<div class="container-fluid p-0">

					
					<div class="row">
						<div class="col-md-4 col-xl-3">
							<div class="card mb-3">
								<div class="card-header">
								
								</div>
								<div class="card-body text-center">
									<img src="../<?php echo $picture?>" alt="" class="img-fluid rounded-circle mb-2" width="178" height="178" />
									<h5 class="card-title mb-0"><?php echo $fname.' '.$lname?></h5>
									<div class="text-muted mb-2">Scholarship Status <a href="#"><?php echo $schstat?></strong></div>

								
								</div>
								<hr class="my-0" />
						
								<hr class="my-0" />
								<div class="card-body">
									<h5 class="h6 card-title">Personal Information</h5>
									<ul class="list-unstyled mb-0">

									<li class="mb-1"><span data-feather="users" class="feather-sm me-1"></span> Scholarship Status <a href="#"><?php echo $schstat?></a></li>
										<li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Lives in <a href="#"><?php echo $address?></a></li>

										<li class="mb-1"><span data-feather="phone" class="feather-sm me-1"></span> Phone Number: <a href="#"><?php echo $number?></a></li>
										<li class="mb-1"><span data-feather="user" class="feather-sm me-1"></span> Civil Status: <a href="#"><?php echo $rel_stat?></a></li>
										<li class="mb-1"><span data-feather="user" class="feather-sm me-1"></span> Year Level: <a href="#"><?php echo $yr_lvl?></a></li>
										<li class="mb-1"><span data-feather="user" class="feather-sm me-1"></span> Course: <a href="#"><?php echo $course?></a></li>
									</ul>
								</div>
							

					
							
							</div>
						</div>

						<div class="col-md-8 col-xl-9">
							<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Announcements</h5>
    </div>
    <div class="card-body">
        <?php 
            $qry = "SELECT * from announcements";
            $ses_sql = mysqli_query($con, $qry);
            while ($row = mysqli_fetch_array($ses_sql)) {
        ?>
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="text-center mb-0"><?php echo $row['subject']; ?></h6>
                </div>
                <div class="card-body">
                    <p><?php echo $row['content']; ?></p>
					
					 <img src="../uploads/<?php echo $row['image']; ?>" alt="" class="img-fluid rounded-circle mb-2" width="400" height="400" />
                </div>
            </div>
        <?php 
            }
        ?>
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