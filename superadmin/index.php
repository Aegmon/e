<?php
include("sidebar.php");

$query="SELECT * FROM userdata where userRole = 'Scholar'";
$result=mysqli_query($con,$query);
if($result->num_rows > 0) {
	$totalno = $result->num_rows;
  } else {
	$totalno = 0;
  }

  
$query1="SELECT * FROM scholarinfo WHERE sc_status = 'Scholar'";
$result1=mysqli_query($con,$query1);
if($result1->num_rows > 0) {
	$totalno1 = $result1->num_rows;
  } else {
	$totalno1 = 0;
  }

  $query1="SELECT * FROM scholarinfo WHERE sc_status = 'Pending'";
  $result1=mysqli_query($con,$query1);
  if($result1->num_rows > 0) {
	  $totalno12 = $result1->num_rows;
	} else {
	  $totalno12 = 0;
	}






	$query1="SELECT * FROM scholarinfo WHERE sc_status = 'Pending'";
	$result1=mysqli_query($con,$query1);
	if($result1->num_rows > 0) {
		$totalno12 = $result1->num_rows;
	  } else {
		$totalno12 = 0;
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
                                  <div class="row">  


					

								   <div class="col-sm-4">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Scholars</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?php echo $totalno1;?></h1>
											
											</div>
										</div>
                                   </div>
							
								   <div class="col-sm-4">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Applicants</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="user"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?php echo $totalno12;?></h1>
											</div>
										</div>
                                   </div>
								   <div class="col-sm-4">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Graduates</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">0</h1>
											</div>
										</div>
                                   </div>
							

								  </div>
								  <div class="row">
								  <div class="col-12 col-lg-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Bar Chart</h5>
								
								
								</div>
								<div class="card-body">
									<div class="chart">
										<canvas id="chartjs-bar"></canvas>
									</div>
								</div>
							</div>
						 </div>
								  <div class="col-12 col-lg-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Doughnut Chart</h5>
								
								</div>
								<div class="card-body">
									<div class="chart chart-sm">
										<canvas id="chartjs-doughnut"></canvas>
									</div>
								</div>
							</div>
						</div>
								</div>
								</div>


								



								</div>
                            </div>
						</div>
					</div>

				</div>
			</main>

		</div>
	</div>
	<script>
		$(document).ready(function () {
    $('#example').DataTable();
});
		document.addEventListener("DOMContentLoaded", function() {
			// Bar chart
			new Chart(document.getElementById("chartjs-bar"), {
				type: "bar",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "Applicants",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
						barPercentage: .75,
						categoryPercentage: .5
					}, {
						label: "Scholars",
						backgroundColor: "#dee2e6",
						borderColor: "#dee2e6",
						hoverBackgroundColor: "#dee2e6",
						hoverBorderColor: "#dee2e6",
						data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
						barPercentage: .75,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 20
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});
		});
	</script>
       
	  <?php 
	 
	 ?>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Doughnut chart
			new Chart(document.getElementById("chartjs-doughnut"), {
				type: "doughnut",
				data: {
					labels: 	<?php 
									echo '[';
									$qry = "SELECT * from barangay";
                                                       $ses_sql = mysqli_query($con,$qry);
                                                      while ($row = mysqli_fetch_array($ses_sql)) {
														$brgy = $row['brgy'];
														 
														echo "'".$brgy."'".', ';
														
														
													  }
													echo  ']';
														?>,
					datasets: [{
						data: [2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
														,
						backgroundColor: [
							window.theme.primary,
							window.theme.success,
							window.theme.warning
							
						],
						borderColor: "transparent"
					}]
				},
				options: {
					maintainAspectRatio: false,
					cutoutPercentage: 65,
					legend: {
						display: false
					}
				}
			});
		});
	</script>
	<script src="js/app.js"></script>

</body>

</html>