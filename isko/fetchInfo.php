<?php

include('../connection.php');
include('session.php');
$info_qry = "SELECT * from scholarinfo where userID='$id'";
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