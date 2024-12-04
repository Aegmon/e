<?php
  include("connection.php");
$userID = $_GET["userID"];
$con->query("UPDATE `userdata` SET `verification` = '2' WHERE userID = '$userID'");
echo '<script>window.location = "./login.php";</script>';

?>