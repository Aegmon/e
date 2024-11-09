<?php
 $con1 = new PDO("mysql:host=localhost;dbname=thesis_db","root","");
$id= isset($_GET['a_id'])? $_GET['a_id'] : "";
$stat = $con1->prepare("Select * from adminform where a_id=?");
$stat->bindParam(1,$id);
$stat->execute();
$row = $stat->fetch();
header('Content-Type:'.$row['mime']);
echo $row['data'];
?>