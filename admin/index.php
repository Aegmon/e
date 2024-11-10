<?php
include("sidebar.php"); // Include the sidebar (which has the $con connection)

// Example of fetching counts from the database
$eligibleCount = getCount('eligible');  
$ineligibleCount = getCount('ineligible'); 
$fullScholarCount = getCount('full_scholar');
$grantLevel1Count = getCount('grant_level_1');
$grantLevel2Count = getCount('grant_level_2');

// Function to fetch count for a specific status
function getCount($status) {
    global $con; 
    $query = "SELECT COUNT(*) FROM applicants WHERE status = '$status'";
    $result = mysqli_query($con, $query);
    
    // Check for query errors
    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    }

    $count = mysqli_fetch_assoc($result)['COUNT(*)'];
    return $count;
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
<div class="row">
    <!-- Eligible Count -->
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Eligible</h5>
                    </div>
                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle" data-feather="check-circle"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3"><?php echo $eligibleCount; ?></h1>
            </div>
        </div>
    </div>

    <!-- Ineligible Count -->
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Ineligible</h5>
                    </div>
                    <div class="col-auto">
                        <div class="stat text-danger">
                            <i class="align-middle" data-feather="x-circle"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3"><?php echo $ineligibleCount; ?></h1>
            </div>
        </div>
    </div>

    <!-- Full Scholar Count -->
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Full Scholar</h5>
                    </div>
                    <div class="col-auto">
                        <div class="stat text-success">
                            <i class="align-middle" data-feather="award"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3"><?php echo $fullScholarCount; ?></h1>
            </div>
        </div>
    </div>

    <!-- Grant Level 1 Count -->
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Grant Level 1</h5>
                    </div>
                    <div class="col-auto">
                        <div class="stat text-warning">
                            <i class="align-middle" data-feather="award"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3"><?php echo $grantLevel1Count; ?></h1>
            </div>
        </div>
    </div>

    <!-- Grant Level 2 Count -->
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Grant Level 2</h5>
                    </div>
                    <div class="col-auto">
                        <div class="stat text-info">
                            <i class="align-middle" data-feather="award"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3"><?php echo $grantLevel2Count; ?></h1>
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
    // Doughnut chart
    new Chart(document.getElementById("chartjs-doughnut"), {
        type: "doughnut",
        data: {
            labels: ["Eligible", "Ineligible", "Full Scholarship", "Grant Level 1", "Grant Level 2"],
            datasets: [{
                data: [
                    <?php echo $eligible; ?>, 
                    <?php echo $ineligible; ?>, 
                    <?php echo $full_scholarship; ?>, 
                    <?php echo $grant_level_1; ?>, 
                    <?php echo $grant_level_2; ?>
                ],
                backgroundColor: [
                    window.theme.primary,
                    window.theme.success,
                    window.theme.warning,
                    window.theme.info,
                    window.theme.danger
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
       
	  <?php 
	 
	 ?>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Doughnut chart
			new Chart(document.getElementById("chartjs-doughnut"), {
				type: "doughnut",
				data: {
					labels: ["Bulualto","Balite","Balaong","Biclat", 0, 0, 0, 0, 0, 0, 0, 0],
					datasets: [{
						data: [1, 2, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0]
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