<?php

include("sidebar.php");

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
											<th style="text-align: center;"class="d-none d-xl-table-cell">Email Verification</th>
										
									
										
										</tr>
									</thead>
									<tbody>
                                        <?php
                                                       $qry = "SELECT * from userdata where userRole= 'Scholar'";
                                                       $ses_sql = mysqli_query($con,$qry);
                                                      while ($row = mysqli_fetch_array($ses_sql)) {
													
                                        
                                        ?>

										<tr>
											<td style="text-align: center;"><?php echo $row['Email'];?></td>
											<td style="text-align: center;">
											<?php echo $row['userRole']?>
										    </td>
											<td style="text-align: center;"><?php 
                                
                                            $stat = $row['verification'];

                                            if($stat == 1){
                                                echo  '<span class="badge badge-success">Verified</span>';
                                            }elseif($stat == 2){
                                                echo  ' <span class="badge badge-warning">Pending</span>';
                                            }else{
                                                echo  ' <span class="badge badge-danger">Pending</span>';
                                            }
                                            
                                   

                                            
                                            
                                            ?></td>
									
                                         
                                           
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