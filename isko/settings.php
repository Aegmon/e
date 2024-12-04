<?php
include("sidebar.php");

// Function to log errors
function log_error($message) {
    $log_file = 'error_log.txt'; // Path to your log file
    file_put_contents($log_file, date('Y-m-d H:i:s') . " - $message\n", FILE_APPEND);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['save'])) {
        // Update Personal Information
        $applicant_id = $_POST['applicant_id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $number = $_POST['number'];
        $rel_stat = $_POST['rel_stat'];
        $address = $_POST['address'];
        $yr_lvl = $_POST['yr_lvl'];
        $course = $_POST['course'];
        $semester = $_POST['semester'];
        $gen_average = $_POST['gen_average'];

        // File upload handling
        $upload_dir = 'uploads/'; // Directory to store uploaded files
        $rog_path = null;
        $cor_path = null;

        // Handle ROG upload
        if (isset($_FILES['rog']) && $_FILES['rog']['error'] == UPLOAD_ERR_OK) {
            $rog_filename = basename($_FILES['rog']['name']);
            $rog_path = $upload_dir . $rog_filename;

            if (!move_uploaded_file($_FILES['rog']['tmp_name'], $rog_path)) {
                echo "<script>alert('Failed to upload ROG.');</script>";
                log_error("Failed to upload ROG file for applicant_id: $applicant_id.");
            }
        }

        // Handle COR upload
        if (isset($_FILES['cor']) && $_FILES['cor']['error'] == UPLOAD_ERR_OK) {
            $cor_filename = basename($_FILES['cor']['name']);
            $cor_path = $upload_dir . $cor_filename;

            if (!move_uploaded_file($_FILES['cor']['tmp_name'], $cor_path)) {
                echo "<script>alert('Failed to upload COR.');</script>";
                log_error("Failed to upload COR file for applicant_id: $applicant_id.");
            }
        }

        // Update applicants table with file paths
        $updateApplicantQuery = "UPDATE applicants 
                                 SET first_name = ?, last_name = ?, contact_no = ?, civil_status = ?, home_address = ?, year_level = ?, year_course = ?, semester = ?, gen_average = ?, rog_path = ?, cor_path = ?
                                 WHERE id = ?";
        $stmt = $con->prepare($updateApplicantQuery);

        if ($stmt) {
            $stmt->bind_param("sssisssdsssi", $fname, $lname, $number, $rel_stat, $address, $yr_lvl, $course, $semester, $gen_average, $rog_path, $cor_path, $applicant_id);

            if ($stmt->execute()) {
                echo "<script>alert('Applicant updated successfully!');
                            window.location.href = 'index.php';
                </script>";
            } else {
                echo "<script>alert('Failed to update applicant.');</script>";
                log_error("Failed to update applicants table. Error: " . $stmt->error);
            }
        } else {
            echo "<script>alert('Failed to prepare statement for applicant update.');</script>";
            log_error("Failed to prepare statement for applicants update. Error: " . $con->error);
        }
    }

    if (isset($_POST['update_account'])) {
        // Update Email and Password
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $applicant_id = $_POST['applicant_id'];

        // Validate passwords
        if ($password === $cpassword) {
            // Hash the password for security
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Update scholaraccount table
            $updateAccountQuery = "UPDATE scholaraccount 
                                   SET email = ?, password = ? 
                                   WHERE application_id = ?";
            $stmt = $con->prepare($updateAccountQuery);

            if ($stmt) {
                $stmt->bind_param("sss", $email, $hashedPassword, $applicant_id);

                if ($stmt->execute()) {
                    echo "<script>
                        alert('Account updated successfully!');
                        window.location.href = 'index.php';
                    </script>";
                } else {
                    echo "<script>alert('Failed to update account.');</script>";
                    log_error("Failed to update scholaraccount table. Error: " . $stmt->error);
                }
            } else {
                echo "<script>alert('Failed to prepare statement for account update.');</script>";
                log_error("Failed to prepare statement for scholaraccount update. Error: " . $con->error);
            }
        } else {
            echo "<script>alert('Passwords do not match.');</script>";
            log_error("Password mismatch for applicant_id: $applicant_id.");
        }
    }
}
?>

<div class="main" style="background-size: 100%;">
    <nav class="navbar navbar-expand navbar-light navbar-bg">
        <a class="sidebar-toggle js-sidebar-toggle">
            <i class="hamburger align-self-center"></i>
        </a>
    </nav>

    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <!-- Personal Information Form -->
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Personal Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="../<?php echo $picture ?>" alt="" class="img-fluid rounded-circle mb-2" width="178" height="178" />
                            </div>
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="applicant_id" value="<?php echo $applicant_id ?>">
                                <div class="mb-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="fname" value="<?php echo $fname ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="lname" value="<?php echo $lname ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" name="number" value="<?php echo $number ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Relationship Status</label>
                                    <select class="form-control" name="rel_stat">
                                        <option selected value="<?php echo $row['civil_status'] ?>"><?php echo $rel_stat ?></option>
                                        <option value="1">Single</option>
                                        <option value="2">Married</option>
                                        <option value="3">Widowed</option>
                                        <option value="4">Legally Separated</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" value="<?php echo $address ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Year Level</label>
                                    <input type="text" class="form-control" name="yr_lvl" value="<?php echo $yr_lvl ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Course</label>
                                    <input type="text" class="form-control" name="course" value="<?php echo $course ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Semester</label>
                                    <input type="text" class="form-control" name="semester" value="<?php echo $semester ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">General Average</label>
                                    <input type="text" class="form-control" name="gen_average" value="<?php echo $gen_average ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Upload ROG</label>
                                    <input type="file" class="form-control" name="rog">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Upload COR</label>
                                    <input type="file" class="form-control" name="cor">
                                </div>
                                <div class="mb-3">
                                    <input type="submit" class="btn btn-lg btn-primary" name="save" value="Update">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Email and Password Form -->
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Email & Password</h5>
                        </div>
                        <form action="" method="post">
                            <input type="hidden" name="applicant_id" value="<?php echo $applicant_id ?>">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo $email ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" value="">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="cpassword" value="">
                                </div>
                                <div class="mb-3">
                                    <input type="submit" class="btn btn-lg btn-primary" name="update_account" value="Update Account">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
