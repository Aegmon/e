<?php
include("../connection.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $qry = "DELETE FROM applicants WHERE id = $id";
    
    if (mysqli_query($con, $qry)) {
        header("Location: record.php"); // Replace 'your_page.php' with the name of your main page
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
} else {
    echo "Invalid ID";
}

mysqli_close($con);
?>
