<?php 
include('../connection.php');
session_start();

$id = $_SESSION['application_id'];

$query = "SELECT * FROM applicants WHERE id='$id'";
$ses_sql = mysqli_query($con, $query);

$row = mysqli_fetch_array($ses_sql);

    $applicant_id = $row['id'];

    $fname = $row['first_name'];
    $lname = $row['last_name'];
    $grade = $row['gen_average'];
    $gradeAssement = $row['scholarType'];
    $number = $row['contact_no'];
    $email = $row['email'];
    $rowid = $row['id'];
      $address = $row['home_address'];
     $schstat = $row['status'];
     $rel_stat = $row['civil_status'];
       $yr_lvl = $row['year_level'];
           $course = $row['year_course'];
     $picture = $row['id_picture'];
             $course = $row['year_course'];
     $semester = $row['semester'];
     $gen_average= $row['gen_average'];
          $scholarType= $row['scholarType'];
if ($rel_stat == 1) {
    $rel_stat = 'Single';
} elseif ($rel_stat == 2) {
    $rel_stat = 'Married';
} elseif ($rel_stat == 3) {
    $rel_stat = 'Widowed';
} elseif ($rel_stat == 4) {
    $rel_stat = 'Divorced';
} else {
    $rel_stat = 'Unknown';
}

?>
