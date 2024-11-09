$fname = $con->real_escape_string($_POST['fname']);
		$lname = $con->real_escape_string($_POST['lname']);
		$number = $con->real_escape_string($_POST['number']);
		$dob = $con->real_escape_string($_POST['dob']);
		$rel_stat = $con->real_escape_string($_POST['rel_stat']);
		$stud_num = $con->real_escape_string($_POST['stud_num']);
		$address = $con->real_escape_string($_POST['address']);
		$yr_lvl = $con->real_escape_string($_POST['yr_lvl']);
		$course = $con->real_escape_string($_POST['course']);



        $con->query("INSERT INTO `scholarinfo`(`userID`, `firstName`, `LastName`, `number`, `dob`, `rel_stat`, `stud_num`, `address`, `yr_lvl`, `course`) VALUES
				('$id','$fname','$lname','$number','$newDate','$rel_stat','$stud_num','$address','$yr_lvl','$course')");