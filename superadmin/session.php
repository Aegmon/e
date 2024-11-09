<?php 
include('../connection.php');
session_start();

$user_check = $_SESSION['login_user'];
$query = "SELECT * from userdata where Email='$user_check'";
$ses_sql = mysqli_query($con,$query);
$row = mysqli_fetch_assoc($ses_sql);
$login_session = $row['userID'];
$login_session2 = $row['Email'];

$qry = "SELECT * from userdata where userID='$login_session'";
$ses_sql2 = mysqli_query($con,$qry);
$row2 = mysqli_fetch_assoc($ses_sql2);
$id = $row2['userID'];
$email = $row2['Email'];

$info_qry = "SELECT * from scholarinfo";
$info_ses = mysqli_query($con,$info_qry);
$info = mysqli_fetch_assoc($info_ses);
$fname = $info['firstName'];
$lname = $info['LastName'];
$studnum = $info['stud_num'];
$address = $info['address'];
$number = $info['number'];
$rel_stat = $info['rel_stat'];
$yr_lvl = $info['yr_lvl'];
$course = $info['course'];
$dob = $info['dob'];
$email = $row2['Email'];
$infoid = $info['scholarID'];
?>