<?php
include('../connection.php');

if (isset($_POST['create'])) {
    $fname = $con->real_escape_string($_POST['fname']);
    $lname = $con->real_escape_string($_POST['lname']);
    $number = $con->real_escape_string($_POST['number']);
    $email = $con->real_escape_string($_POST['email']);
    $dob = $con->real_escape_string($_POST['dob']);
    $rel_stat = $con->real_escape_string($_POST['rel_stat']);
    $address = $con->real_escape_string($_POST['address']);
    $address1 = $con->real_escape_string($_POST['address1']);
    $address2 = $con->real_escape_string($_POST['address2']);
    $yr_lvl = $con->real_escape_string($_POST['yr_lvl']);
    $indigent_status = $con->real_escape_string($_POST['indigent_status']);
    $family_living = $con->real_escape_string($_POST['family_living']);
    $living_with = $con->real_escape_string($_POST['living_with']);
    $household_size = $con->real_escape_string($_POST['household_size']);
    $school_name = $con->real_escape_string($_POST['school_name']);
    $school_address = $con->real_escape_string($_POST['school_address']);
    $general_average = $con->real_escape_string($_POST['general_average']);
    $image = $_FILES['image']['name'];
    $target = "../assets/img/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    // Insert the new record into scholarinfo table
    $con->query("INSERT INTO `scholarinfo` (`firstName`, `LastName`, `number`, `email`, `dob`, `rel_stat`, `address`, `address1`, `address2`, `indigent_status`, `family_living`, `living_with`, `household_size`, `school_name`, `school_address`, `general_average`, `image`)
                 VALUES ('$fname', '$lname', '$number', '$email', '$dob', '$rel_stat', '$address', '$address1', '$address2',  '$indigent_status', '$family_living', '$living_with', '$household_size', '$school_name', '$school_address', '$general_average', '$image')");

    // Retrieve the last inserted scholarID
    $infoid = $con->insert_id;

    // Redirect to mothersinfo.php with the scholarID as a query parameter
    header("location: mothersinfo.php?scholarID=" . $infoid);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-profile.html" />
    <title>Profile</title>
    <link href="css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <main class="content" style="background:url('../assets/StepByStep_regBg.png'); background-repeat: no-repeat; background-size: 125%;">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-md-6 mx-auto mt-10">
                        <form action=" " method="post" enctype="multipart/form-data">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header text-center">
                                        <h1> Personal Information</h1>
                                    </div>
                                    <div class="m-sm-2">
                                        <div class="text-center mb-3">
                                            <img src="../assets/LogoSM.png" id="output" alt="" class="img-fluid rounded-circle mb-2" width="178" height="178" />
                                            <div class="text-center"> 
                                                <input class="form-control form-control-lg text-center" onchange="validateSize(this)" id="image" type="file" name="image" required="" accept="image/*" onchange="loadFile(event)"/>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <input class="form-control form-control-lg" type="text" name="fname" required="" placeholder="First Name" />
                                                </div>
                                                <div class="col-6">
                                                    <input class="form-control form-control-lg" type="text" name="lname" required="" placeholder="Last Name" />
                                                </div>
                                            </div>
                                    
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Contact Number</label>
                                            <input type="number" class="form-control" name="number" placeholder="" aria-describedby="basic-addon1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required="" maxlength="11" minlength="11">
                                        </div>
										<div class="mb-3">
											<label class="form-label">Email Address</label>
											<input type="email" class="form-control" name="email" required>
										</div>
                                        <div class="mb-3">
                                            <label class="form-label">Date of Birth</label>
                                            <input type="date" class="form-control" name="dob" placeholder="" aria-describedby="basic-addon1" required="">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Civil Status</label>
                                            <select class="form-control" aria-label="Default select example" name="rel_stat" required="">
                                                <option selected disabled>Civil Status</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Widowed">Widowed</option>
                                                <option value="Legally Separated">Legally Separated</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" name="address" placeholder="House No./Street" required="">
                                        </div>
                                        <div class="mb-3">
                                            <select name="address1" id="cars" class="form-control form-control-lg mb-3">
                                                <option selected disabled>Barangay</option>
                                                <?php
                                                    $sql = "SELECT * FROM barangay";
                                                    $result = $con->query($sql);
                                                    if($result->num_rows > 0) {
                                                        while($row = $result->fetch_assoc()) {
                                                            echo '<option value="'.$row["brgy"].'">'.$row["brgy"].'</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="address2" value=""  required="">
                                        </div>
										<div class="mb-3">
												<label class="form-label">Do you qualify as indigent status?</label>
												<div>
													<input type="radio" name="indigent_status" value="Yes" required> Yes
													<input type="radio" name="indigent_status" value="No" required> No
												</div>
											</div>
											<div class="mb-3">
												<label class="form-label">Are you living with family?</label>
												<div>
													<input type="radio" name="family_living" value="Yes" required> Yes
													<input type="radio" name="family_living" value="No" required> No
												</div>
											</div>
											<div class="mb-3">
												<label class="form-label">If not, with whom are you living?</label>
												<input type="text" class="form-control" name="living_with">
											</div>
											<div class="mb-3">
												<label class="form-label">Number of people in household</label>
												<input type="number" class="form-control" name="household_size" min="1" required>
											</div>
											<div class="mb-3">
												<label class="form-label">Name of Senior High School</label>
												<input type="text" class="form-control" name="school_name" required>
											</div>
											<div class="mb-3">
												<label class="form-label">Address of School</label>
												<input type="text" class="form-control" name="school_address" required>
											</div>
											<div class="mb-3">
												<label class="form-label">General Average at Last Attended School</label>
												<input type="number" class="form-control" name="general_average" step="0.01" min="0" max="100" required>
											</div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" required="">
                                            <label class="form-check-label" for="defaultCheck1">
                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalLong"> <i class="fa fa-plus" aria-hidden="true">Privacy Policy</i> </a>
                                            </label>
                                        </div>
                                        <!-- Add Privacy Policy Modal here -->
                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="submit" name="create" class="btn btn-primary">Next</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
