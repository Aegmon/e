<?php
include('session.php');
$cur_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
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
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-profile.html" />
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />





	



	<title>San Miguel Scholars</title>
<link href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css" rel="stylesheet">
<link href="css/app.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<!-- jQuery (Make sure this is loaded before DataTables) -->
<script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>

<!-- DataTables Core JS -->
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>

<!-- DataTables Bootstrap 5 integration -->
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js" crossorigin="anonymous"></script>

<!-- DataTables Buttons Plugin -->
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js" crossorigin="anonymous"></script>

<!-- JS libraries for exporting buttons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js" crossorigin="anonymous"></script>

	<style>
#wrapper{
  
    overflow: hidden;
   height: 50px;
}


#c1{
   float:left;
 
}


#c2{
  
    float:right;
}

active{
  
 background-color: #ffff;
}

    </style>
</head>



<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar" >
			<div class="sidebar-content js-simplebar">
			<a class="sidebar-brand" href="index.php">
			<div class="text-center">
		<img src="#" class="img-fluid rounded-circle" width="250" height="250" />
	        </div>
        </a>

				<a class="sidebar-brand" href="index.php">
          <span class="align-middle">Welcome Admin</span>
        </a>

				<ul class="sidebar-nav">
				<li class="sidebar-item <?php if( ($cur_page == 'index.php') ) {echo 'active ';} ?> ">
						<a class="sidebar-link" href="home.php">
              <i class="align-middle" style="color:#ffff;"data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
					</li>

		

					<li class="sidebar-item <?php if( ($cur_page == 'scholars.php') ) {echo 'active ';} ?>">
						<a class="sidebar-link" href="scholars.php">
              <i class="align-middle" data-feather="users" style="color:#ffff;"></i> <span class="align-middle">Eligibility Results</span>
            </a>
					</li>

					
					
					<li class="sidebar-item <?php if( ($cur_page == 'record.php') ) {echo 'active ';} ?>">
						<a class="sidebar-link" href="record.php">
              <i class="align-middle" data-feather="users" style="color:#ffff;"></i> <span class="align-middle">Records Management</span>
            </a>
					</li>
				
				
			

					<li class="sidebar-item <?php if( ($cur_page == 'adminsettings.php') ) {echo 'active ';} ?>">
						<a class="sidebar-link" href="adminsettings.php">
              <i class="align-middle" data-feather="settings" style="color:#ffff;"></i> <span class="align-middle">Admin Settings</span>
            </a>
					</li> 
					<li class="sidebar-item <?php if( ($cur_page == 'logs.php') ) {echo 'active ';} ?>">
						<a class="sidebar-link" href="logs.php">
              <i class="align-middle" data-feather="activity" style="color:#ffff;"></i> <span class="align-middle">Activity Logs</span>
            </a>
					</li> 
					<li class="sidebar-item">
						<a class="sidebar-link" href="logout.php">
              <i class="align-middle" data-feather="log-out" style="color:#ffff;"></i> <span class="align-middle">Logout</span>
            </a>
					</li>
                 
		
				</ul>

		
			</div>
		</nav>