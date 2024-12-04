<?php 
include('../connection.php');
session_start();
if (!isset($_SESSION['userID'])) {
    header("location: index.php");
    exit();
}

$user_check = $_SESSION['login_user'];
$query = "SELECT * from userdata where Email='$user_check'";
$ses_sql = mysqli_query($con,$query);
$row = mysqli_fetch_assoc($ses_sql);
$login_session = $row['userID'];
$login_session2 = $row['Email'];
$role =$row['userRole']; 
$qry = "SELECT * from userdata where userID='$login_session'";
$ses_sql2 = mysqli_query($con,$qry);
$row2 = mysqli_fetch_assoc($ses_sql2);
$id = $row2['userID'];
$email = $row2['Email'];


?>