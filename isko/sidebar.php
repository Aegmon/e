
<?php
include('session.php');
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

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-profile.html" />

	<title>Profile</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
			<a class="sidebar-brand" href="index.php">
			<div class="text-center">
			<img src="../assets/SMG LOGO.png" class="img-fluid rounded-circle" width="250" height="250" />
	        </div>
        </a>
			
				<a class="sidebar-brand" href="index.php">
          <span class="align-middle">Welcome Iskolar</span>
        </a>

				<ul class="sidebar-nav">
				
					<li class="sidebar-item ">
						<a class="sidebar-link" href="index.php">
              <i class="align-middle" data-feather="user" style="color:#ffff;"></i> <span class="align-middle">Profile</span>
                        </a>
					</li>

<?php      
                   if($schstat == 'Pending'){
					echo '<li class="sidebar-item">
						<a class="sidebar-link" href="newscholar.php" >
              <i class="align-middle" data-feather="check-square" style="color:#ffff;"></i> <span class="align-middle">Application Form</span>
            </a>
		               </li>';
					}else{
						echo '<li class="sidebar-item">
						<a class="sidebar-link" href="oldscholar.php" >
              <i class="align-middle" data-feather="check-square" style="color:#ffff;"></i> <span class="align-middle">Renewal Application Form</span>
            </a>
		               </li>';
					}
					   ?> 

					
					<li class="sidebar-item">
						<a class="sidebar-link" href="settings.php">
              <i class="align-middle" data-feather="settings" style="color:#ffff;"></i> <span class="align-middle">Account Settings</span>
            </a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="logout.php">
              <i class="align-middle" data-feather="log-in" style="color:#ffff;"></i> <span class="align-middle">Logout</span>
            </a>
					</li>
                 
		
				</ul>

		
			</div>
		</nav>