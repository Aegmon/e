<?php
	$con = mysqli_connect("127.0.0.1","root","","thesis_db");
	if(mysqli_connect_errno()) {
		echo "Connection failed:".mysqli_connect_error();
		exit;
	}
?>