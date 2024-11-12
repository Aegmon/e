<?php

include("sidebar.php");



if(isset($_POST['save'])){


	
    $email = $con->real_escape_string($_POST['email']);
    $password = $con->real_escape_string($_POST['password']);
    $cpassword = $con->real_escape_string($_POST['cpassword']);
    $fname = $con->real_escape_string($_POST['fname']);
    $lname = $con->real_escape_string($_POST['lname']);
    $number = $con->real_escape_string($_POST['number']);
    $dob = $con->real_escape_string($_POST['dob']);
    $rel_stat = $con->real_escape_string($_POST['rel_stat']);
    $stud_num = $con->real_escape_string($_POST['stud_num']);
    $address = $con->real_escape_string($_POST['address']);
    $yr_lvl = $con->real_escape_string($_POST['yr_lvl']);
    $course = $con->real_escape_string($_POST['course']);
    $scholarID = $con->real_escape_string($_POST['scholarID']);
    $newDate = date("Y-m-d", strtotime($dob));

    $con->query("UPDATE `scholarinfo` SET `firstName`='$fname',`LastName`='$lname',`number`='$number'
,`dob`='$dob',`rel_stat`='$rel_stat',`stud_num`='$stud_num',`address`='$address',`yr_lvl`='$yr_lvl',`course`='$course' WHERE `scholarID` = $scholarID");
    echo '<script type="text/javascript">alert("Update Successful");
    window.location = "settings.php";</script>';
}

if(isset($_POST['reset'])){

    $email = $con->real_escape_string($_POST['email']);
    $password = $con->real_escape_string($_POST['password']);
    $cpassword = $con->real_escape_string($_POST['cpassword']);

    if ($password != $cpassword){
        echo '<script type="text/javascript">alert("Password mismatch, Please try again");</script>';
     }else{
        $sql = $con->query("SELECT Email FROM userdata WHERE Email='$email'");
        if ($sql->num_rows >0){
            echo '<script type="text/javascript">alert("Email is already in use");</script>';
        }else{
         
            $query = "SELECT userID FROM userdata WHERE Email='$email'";
            $ses_sql = mysqli_query($con,$query);
            $row = mysqli_fetch_assoc($ses_sql);
            $id =$row['userID'];
            $hashedPassword =password_hash($password, PASSWORD_DEFAULT);
            $con->query("UPDATE `userdata` SET `Email`='$email',`Password`='$hashedPassword' WHERE `userID` = $id");
            echo '<script type="text/javascript">alert("Register Successful");
            window.location = "./login.php";</script>';
        } 
        
    }


}
?>
<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				
			</nav>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Management with Sidebar</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/app.css" rel="stylesheet"> <!-- Assuming custom CSS for sidebar styles -->
    <link rel="stylesheet" href="https://feathericons.com/?query=que">
    <style>
      
        .profile-container {
            padding: 20px;
            width: 700px; /* Narrower width */
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Optional: Adds a shadow for better visibility */
        }
        .profile-name, .profile-status {
            margin: 5px 0; /* Adds some vertical spacing between name and status */
        }

        /* Flexbox for centering profile picture */
        .profile-content {
            display: flex;
            align-items: center; /* Centers items vertically */
            justify-content: space-between; /* Aligns name/status to the left and picture to the right */
            flex-wrap: wrap; /* Allows content to wrap on smaller screens */
        }

        .profile-picture {
    display: flex;
    justify-content: center; /* Keeps the picture in its original position */
    align-items: center; /* Centers vertically */
    padding-bottom: 10px;
    margin-left: auto; /* Pushes the picture to the right side */
    padding-right: 10px; /* Adds padding to the right */
}


        /* Profile picture styles */
        #id-picture-preview {
            width: 150px;  /* Keeps the original size */
            height: 150px; /* Keeps the original size */
            object-fit: cover; /* Ensures image covers the box without distorting */
            border-radius: 50%; /* Keeps the circular shape */
        }

        /* Optional: Add some space below the h3 heading */
        h3.profile-heading {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    
    <!-- Profile Content -->
    <div class="container-fluid">
        <div class="profile-container">
            <!-- Profile Heading (Bold and at the top) -->
            <h3 class="profile-heading font-weight-bold">Profile</h3>

            <div class="profile-content">
                <!-- Left Side: Name and Status -->
                <div class="col-md-8">
                    <div class="d-flex flex-column">
                        <div class="profile-name">NAME</div>
                        <div class="profile-status">STATUS</div>
                    </div>
                </div>

                <!-- Right Side: Profile Picture -->
                <div class="profile-picture col-md-4">
                    <label for="id-picture" class="id-picture-label mt-3">
                        <img src="default-profile.jpg" alt="Profile Picture" id="id-picture-preview" class="img-thumbnail">
                    </label>
                    <input type="file" id="id-picture" name="id_picture" class="d-none" accept="image/*">
                </div>
            </div>

            <!-- Verify Information (Before Email Section) -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <h4 class="font-weight-bold">Verify Information</h4>
                    <br>
                    <div class="contact-info mt-4">
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2" id="email-section">
                            <span class="font-weight-bold">Email Address</span>
                            <div>
                                <span id="email-display">scholar@gmail.com</span>
                                <input type="email" id="email-input" class="form-control d-none" value="scholar@gmail.com">
                                <div class="edit-save-buttons d-inline">
                                    <button id="edit-email" onclick="toggleEdit('email')">Edit</button>
                                    <button id="save-email" class="d-none" onclick="saveEdit('email')">Save</button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mt-2" id="phone-section">
                            <span class="font-weight-bold">Phone Number</span>
                            <div>
                                <span id="phone-display">09123456789</span>
                                <input type="tel" id="phone-input" class="form-control d-none" value="09123456789">
                                <div class="edit-save-buttons d-inline">
                                    <button id="edit-phone" onclick="toggleEdit('phone')">Edit</button>
                                    <button id="save-phone" class="d-none" onclick="saveEdit('phone')">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Profile Picture Preview Functionality
    const idPictureInput = document.getElementById("id-picture");
    const idPicturePreview = document.getElementById("id-picture-preview");

    idPictureInput.addEventListener("change", function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                idPicturePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Toggle between edit and save mode for email and phone
    function toggleEdit(type) {
        const displaySpan = document.getElementById(`${type}-display`);
        const inputField = document.getElementById(`${type}-input`);
        const editButton = document.getElementById(`edit-${type}`);
        const saveButton = document.getElementById(`save-${type}`);

        displaySpan.classList.toggle("d-none");
        inputField.classList.toggle("d-none");
        editButton.classList.toggle("d-none");
        saveButton.classList.toggle("d-none");
    }

    // Save edited information for email and phone
    function saveEdit(type) {
        const displaySpan = document.getElementById(`${type}-display`);
        const inputField = document.getElementById(`${type}-input`);

        displaySpan.textContent = inputField.value;
        toggleEdit(type);
    }
</script>
</body>
</html>
