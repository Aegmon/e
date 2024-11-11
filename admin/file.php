<?php
include("sidebar.php"); // Include the sidebar (which has the $con connection)

// Get the applicant ID from the URL
$applicant_id = isset($_GET['applicant_id']) ? $_GET['applicant_id'] : '';

// Check if the applicant ID is provided
if ($applicant_id != '') {
    // Query to fetch the applicant's data
    $query = "SELECT * FROM applicants WHERE id = '$applicant_id'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // Fetch the applicant data
        $applicant_data = mysqli_fetch_assoc($result);
        
        // Calculate age based on date of birth if it's available
        if ($applicant_data['date_of_birth']) {
            $dob = new DateTime($applicant_data['date_of_birth']);
            $now = new DateTime();
            $age = $now->diff($dob)->y;
        } else {
            $age = ''; // Leave it empty if DOB is not available
        }
    } else {
        echo "No applicant found with the given ID.";
        exit();
    }
} else {
    echo "No applicant ID provided.";
    exit();
}
?>

<div class="main">
    <nav class="navbar navbar-expand navbar-light navbar-bg">
        <a class="sidebar-toggle js-sidebar-toggle">
            <i class="hamburger align-self-center"></i>
        </a>
    </nav>

    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div id="main">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title">SOCIAL CASE STUDY REPORT</h1>
                            <form id="caseStudyForm" enctype="multipart/form-data">
                                <h3 class="mt-4">I. Identifying Information</h3>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="name-input" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name-input" name="name" value="<?php echo $applicant_data['first_name'] . ' ' . $applicant_data['middle_name'] . ' ' . $applicant_data['last_name']; ?>" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="year-course-input" class="form-label">Year & Course</label>
                                        <input type="text" class="form-control" id="year-course-input" name="year_course" value="<?php echo $applicant_data['scholarType']; ?>" placeholder="Enter Year & Course">
                                    </div>
                                </div>

                                <div class="form-row mt-3">
                                    <div class="col-md-4">
                                        <label for="age-input" class="form-label">Age</label>
                                      <input type="text" class="form-control" id="age-input" name="age" value="<?php echo $age; ?>" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="civil-status-select" class="form-label">Civil Status</label>
                                        <select class="form-control" id="civil-status-select" name="civil_status" disabled>
                                            <option value="">Select Civil Status</option>
                                            <option value="1" <?php echo ($applicant_data['civil_status'] == 1) ? 'selected' : ''; ?>>Single</option>
                                            <option value="2" <?php echo ($applicant_data['civil_status'] == 2) ? 'selected' : ''; ?>>Married</option>
                                            <option value="3" <?php echo ($applicant_data['civil_status'] == 3) ? 'selected' : ''; ?>>Widowed</option>
                                            <option value="4" <?php echo ($applicant_data['civil_status'] == 4) ? 'selected' : ''; ?>>Divorced</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="dob-input" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob-input" name="date_of_birth" value="<?php echo $applicant_data['date_of_birth']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-row mt-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Gender</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="male" name="gender" value="male" <?php echo ($applicant_data['gender'] == 'male') ? 'checked' : ''; ?> disabled>
                                            <label class="form-check-label" for="male">Male</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="female" name="gender" value="female" <?php echo ($applicant_data['gender'] == 'female') ? 'checked' : ''; ?> disabled>
                                            <label class="form-check-label" for="female">Female</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="non-binary" name="gender" value="non-binary" <?php echo ($applicant_data['gender'] == 'non-binary') ? 'checked' : ''; ?> disabled>
                                            <label class="form-check-label" for="non-binary">Non-Binary</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="place-of-birth-input" class="form-label">Place of Birth</label>
                                        <input type="text" class="form-control" id="place-of-birth-input" name="place_of_birth" value="<?php echo $applicant_data['home_address']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="home-address-input" class="form-label">Home Address</label>
                                    <input type="text" class="form-control" id="home-address-input" name="home_address" value="<?php echo $applicant_data['home_address']; ?>" readonly>
                                </div>

                                <div class="form-group mt-5">
                                    <h3>II. FAMILY COMPOSITION</h3>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Relationship to Client</th>
                                                <th>Civil Status</th>
                                                <th>Occupation</th>
                                                <th>Monthly Income</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" class="form-control" name="father_name" value="<?php echo $applicant_data['father_name']; ?>" readonly></td>
                                                <td><input type="text" class="form-control" name="father_relationship" value="Father" readonly></td>
                                                <td><input type="text" class="form-control" name="father_status" value="<?php echo $applicant_data['father_age']; ?>" readonly></td>
                                                <td><input type="text" class="form-control" name="father_occupation" value="<?php echo $applicant_data['father_occupation']; ?>" readonly></td>
                                                <td><input type="text" class="form-control" name="father_income" value="<?php echo $applicant_data['father_income']; ?>" readonly></td>
                                            </tr>
                                            <!-- Similar rows for mother and others, following the same structure -->
                                        </tbody>
                                    </table>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="problem-presented" class="form-label">III. Problem Presented</label>
                                    <textarea class="form-control" id="problem-presented" name="problem_presented" placeholder="The family does not have sufficient resources..." rows="3" readonly><?php echo $applicant_data['qualify']; ?></textarea>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="disposition" class="form-label">IV. Disposition</label>
                                    <textarea class="form-control" id="disposition" name="disposition" placeholder="The client was able to successfully provide all necessary documentation..." rows="3" readonly><?php echo $applicant_data['status']; ?></textarea>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>   
            </div>      
        </div>
    </main>
</div>

<script src="js/app.js"></script>
</body>
</html>
