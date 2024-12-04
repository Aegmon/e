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
        
  
    $family_query = "SELECT * FROM family WHERE applicant_id = '$applicant_id'";
    $family_result = mysqli_query($con, $family_query);
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
<style>
  @media print {
    .btn {
      display: none; /* Hides the button during print */
    }
  }</style>
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
             

                    <!-- <div class="button-container">
                        <button type="button" class="btn btn-primary" id="downloadButton">Download</button>
                    </div> -->

                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title">SOCIAL CASE STUDY REPORT</h1>
                            <form id="caseStudyForm" enctype="multipart/form-data">
                               
                                   <div class="text-center mb-3">
      <label for="id-picture" class="id-picture-label">
        <img src="../<?php echo $applicant_data['id_picture']; ?>" alt="Applicant ID Picture" height="200" >
      </label>
    </div>
                          
                                <div class="form-group">
                                    <label for="date-input" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="date-input" name="date" required>
                                </div>

                                <h3 class="mt-4">I. Identifying Information</h3>
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <label for="name-input" class="form-label">Name</label>
                                                         <input type="text" class="form-control" id="age-input" name="age" value="<?php echo $applicant_data['first_name'] . ' ' . $applicant_data['middle_name'] . ' ' . $applicant_data['last_name']; ?>" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="year" class="form-label">Academic Year</label>
                                        <input type="text" class="form-control" id="year" name="year" required value="<?php echo $applicant_data['year_level']; ?>" readonly>
                                    </div>
                                         <div class="col-md-6">
                                        <label for="course" class="form-label">Course</label>
                                        <input type="text" class="form-control" id="course" name="course" required value="<?php echo $applicant_data['year_course']; ?>" readonly>
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
                                            <input class="form-check-input" type="radio" id="male" name="gender" value="male" <?php echo ($applicant_data['gender'] == '1') ? 'checked' : ''; ?> disabled>
                                            <label class="form-check-label" for="male">Male</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="female" name="gender" value="female" <?php echo ($applicant_data['gender'] == '2') ? 'checked' : ''; ?> disabled>
                                            <label class="form-check-label" for="female">Female</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="non-binary" name="gender" value="non-binary" <?php echo ($applicant_data['gender'] == '3') ? 'checked' : ''; ?> disabled>
                                            <label class="form-check-label" for="non-binary">Non-Binary</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="place-of-birth-input" class="form-label">Place of Birth</label>
                                       <input type="text" class="form-control" id="home-address-input" name="home_address" value="<?php echo $applicant_data['home_address']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="home-address-input" class="form-label">Home Address</label>
                                         <input type="text" class="form-control" id="place-of-birth-input" name="place_of_birth" value="<?php echo $applicant_data['home_address']; ?>" readonly>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="family-circumstances-input" class="form-label">Family Circumstances</label>
                                    <input type="text" class="form-control" id="family-circumstances-input" name="family_circumstances" placeholder="Enter family circumstances" required>
                                </div>

                                <div class="form-group mt-5">
                                    <h3>II. FAMILY COMPOSITION</h3>
                                      <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Relationship</th>
                          <th>Occupation</th>
                <th>Income</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($family_result) > 0) {
                while ($family_row = mysqli_fetch_assoc($family_result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($family_row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($family_row['relationship']) . "</td>";
                          echo "<td>" . htmlspecialchars($family_row['occupation']) . "</td>";
                    echo "<td>" . htmlspecialchars($family_row['monthly_income']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3' class='text-center'>No family composition details found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="problem-presented" class="form-label">III. Problem Presented</label>
                                    <textarea class="form-control" id="problem-presented" name="problem_presented" placeholder="The family does not have sufficient resources..." rows="3"></textarea>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="disposition" class="form-label">IV. Disposition</label>
                                    <textarea class="form-control" id="disposition" name="disposition" placeholder="The client was able to successfully provide all necessary documentation..." rows="3"></textarea>
                                </div>

                                <div class="form-group mt-3">
                                    <?php  if ($role == 'Superadmin'){

                                       echo '<button type="submit" class="btn btn-primary btn-lg">Submit</button>';
                                    }?>
                              
                                </div>
                                    <div class="text-center">
      <button type="button" class="btn btn-primary" onclick="printForm()">Print Form</button>
    </div>
                            </form>
                        </div>
                    </div>
                </div>   
            </div>      
        </div>
    </main>
</div>
	</div>
<!-- Interview Result Modal -->
<div class="modal fade" id="interviewModal" tabindex="-1" aria-labelledby="interviewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="interviewModalLabel">Interview Result</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Did the applicant pass the interview?</p>
        <button type="button" class="btn btn-danger" id="declineButton">Decline</button>
        <button type="button" class="btn btn-success" id="acceptButton">Accept</button>
      </div>
    </div>
  </div>
</div>

<!-- Scholarship Type Modal -->
<div class="modal fade" id="scholarshipModal" tabindex="-1" aria-labelledby="scholarshipModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scholarshipModalLabel">Select Scholarship Type</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label for="scholarshipType">Scholarship Type</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="scholarshipType" value="Full Scholarship" id="fullScholarship">
          <label class="form-check-label" for="fullScholarship">
            Full Scholarship
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="scholarshipType" value="Grant Level 1" id="grantLevel1">
          <label class="form-check-label" for="grantLevel1">
            Grant Level 1
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="scholarshipType" value="Grant Level 2" id="grantLevel2">
          <label class="form-check-label" for="grantLevel2">
            Grant Level 2
          </label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveScholarshipButton">Save Scholarship Type</button>
      </div>
    </div>
  </div>
</div>

	<script src="js/app.js"></script>
<script >

    document.getElementById('caseStudyForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    // Show the interview result modal
    $('#interviewModal').modal('show');
});

// Handle Decline button click
document.getElementById('declineButton').addEventListener('click', function() {
    // Update applicant status to "Declined" and Scholarship Type to NULL
    const applicantId = '<?php echo $applicant_id; ?>'; // Retrieve the applicant ID dynamically
    
    // AJAX request to update the status and scholarship type
    fetch('updateApplicantStatus.php', {
        method: 'POST',
        body: new URLSearchParams({
            applicant_id: applicantId,
            status: 'Declined',
            scholarship_type: 'NULL'
        }),
    }).then(response => response.json())
    .then(data => {
        if (data.success) {
            // Close modal and show success message
            $('#interviewModal').modal('hide');
            alert('Applicant status updated to Declined.');
        } else {
            alert('Error updating applicant status.');
        }
    });
});

// Handle Accept button click
document.getElementById('acceptButton').addEventListener('click', function() {
    // Update applicant status to "Granted"
    const applicantId = '<?php echo $applicant_id; ?>'; // Retrieve the applicant ID dynamically
    
    // AJAX request to update the status to "Granted"
    fetch('updateApplicantStatus.php', {
        method: 'POST',
        body: new URLSearchParams({
            applicant_id: applicantId,
            status: 'New',
            scholarship_type: 'NULL',
                 year: 'NULL',
            course:  'NULL'
        }),
    }).then(response => response.json())
    .then(data => {
        if (data.success) {
            // Close the first modal and show the scholarship type modal
            $('#interviewModal').modal('hide');
            $('#scholarshipModal').modal('show');
        } else {
            alert('Error updating applicant status.');
        }
    });
});

// Save Scholarship Type and update applicant record
document.getElementById('saveScholarshipButton').addEventListener('click', function () { 
    const selectedScholarshipType = document.querySelector('input[name="scholarshipType"]:checked').value;
    const applicantId = '<?php echo $applicant_id; ?>';
console.log(applicantId)
    // Get values of year and course
    const year = document.getElementById('year').value;
    const course = document.getElementById('course').value;

    // AJAX request to update scholarship type and other details
    fetch('updateApplicantStatus.php', {
        method: 'POST',
        body: new URLSearchParams({
            applicant_id: applicantId,
            status: 'New',
            scholarship_type: selectedScholarshipType,
            year: year,
            course: course
        }),
    }).then(response => response.json())
    .then(data => {
        if (data.success) {
            // Close modal and show success message
            $('#scholarshipModal').modal('hide');
            alert('Scholarship type and details updated successfully.');
              window.location.href = 'record.php';
        } else {
            alert('Error updating scholarship details.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An unexpected error occurred.');
    });
});



</script>
  <script>
      function printForm() {
          window.print();
      }
    </script>
</body>

</html>