
<?php
include('../connection.php');
session_start();

if(session_destroy()){
	$log = "Admin Logout"; 
	$con->query("INSERT INTO `logs`(`logs`) VALUES  ('$log')");
	header("location: index.php");
}
?>