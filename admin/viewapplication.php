<?php
include("../connection.php");

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
    } else {
        echo "No applicant found with the given ID.";
        exit();
    }
} else {
    echo "No applicant ID provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form</title>
    <link rel="stylesheet" href="ApplicationForm.css">
    <link href="https://fonts.googleapis.com/css?family=Inter" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
  @media print {
    .btn {
      display: none; /* Hides the button during print */
    }
  }
   .back-arrow-container {
            position: absolute;
            top: 20px;
            left: 20px;
        }
        .back-arrow {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: #ffffff;
            color: #333;
            border-radius: 50%;
            text-decoration: none;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
            font-size: 1.25rem;
            transition: color 0.2s, background-color 0.2s;
        }
        .back-arrow:hover {
            color: #ffffff;
            background-color: #007bff;
        }
</style>
<body class="container my-5">
  <div class="back-arrow-container">
       <button class="back-arrow" onclick="history.back()">←</button> 
</div>
  <form id="applicationForm" action="" method="post" enctype="multipart/form-data">
    <header class="mb-4">
      <h2 class="text-center">Application Form</h2>
    </header>

    <h3 class="text-center mb-4">ASEEST Application Form</h3>
    
    <div class="text-center mb-3">
      <label for="id-picture" class="id-picture-label">
        <img src="../<?php echo $applicant_data['id_picture']; ?>" alt="Applicant ID Picture" class="img-thumbnail">
      </label>
    </div>

   <br>

    <div class="form-container personal-details mb-4 mt-4">
      <h4>Personal Details</h4>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="lastName" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="lastName" value="<?php echo $applicant_data['last_name']; ?>" readonly>
        </div>
        <div class="col-md-6 mb-3">
          <label for="firstName" class="form-label">First Name</label>
          <input type="text" class="form-control" id="firstName" value="<?php echo $applicant_data['first_name']; ?>" readonly>
        </div>
        <div class="col-md-6 mb-3">
          <label for="middleName" class="form-label">Middle Name</label>
          <input type="text" class="form-control" id="middleName" value="<?php echo $applicant_data['middle_name']; ?>" readonly>
        </div>
        <div class="col-md-6 mb-3">
          <label for="dateOfBirth" class="form-label">Date of Birth</label>
          <input type="date" class="form-control" id="dateOfBirth" value="<?php echo $applicant_data['date_of_birth']; ?>" readonly>
        </div>
        <div class="col-md-6 mb-3">
          <label for="citizenship" class="form-label">Citizenship</label>
          <input type="text" class="form-control" id="citizenship" value="<?php echo $applicant_data['citizenship']; ?>" readonly>
        </div>
        <div class="col-md-6 mb-3">
          <label for="religion" class="form-label">Religion</label>
          <input type="text" class="form-control" id="religion" value="<?php echo $applicant_data['religion']; ?>" readonly>
        </div>
        <div class="col-md-6 mb-3">
          <label for="contactNo" class="form-label">Contact No.</label>
          <input type="text" class="form-control" id="contactNo" value="<?php echo $applicant_data['contact_no']; ?>" readonly>
        </div>
        <div class="col-md-6 mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" class="form-control" id="email" value="<?php echo $applicant_data['email']; ?>" readonly>
        </div>
        <div class="col-md-6 mb-3">
          <label for="gender" class="form-label">Sex</label>
          <input type="text" class="form-control" id="gender" value="<?php echo $applicant_data['gender'] == 1 ? 'Male' : ($applicant_data['gender'] == 2 ? 'Female' : 'Non-Binary'); ?>" readonly>
        </div>
        <div class="col-md-6 mb-3">
          <label for="homeAddress" class="form-label">Home Address</label>
          <input type="text" class="form-control" id="homeAddress" value="<?php echo $applicant_data['home_address']; ?>" readonly>
        </div>
        <div class="col-md-6 mb-3">
          <label for="zipCode" class="form-label">Zip Code</label>
          <input type="text" class="form-control" id="zipCode" value="<?php echo $applicant_data['zip_code']; ?>" readonly>
        </div>
        <div class="col-md-6 mb-3">
          <label for="civilStatus" class="form-label">Civil Status</label>
          <input type="text" class="form-control" id="civilStatus" value="<?php echo $applicant_data['civil_status']; ?>" readonly>
        </div>
        <div class="col-md-12 mb-3">
          <label for="presentAddress" class="form-label">Present Address</label>
          <input type="text" class="form-control" id="presentAddress" value="<?php echo $applicant_data['present_address']; ?>" readonly>
        </div>
        <div class="col-md-12">
          <p>Do you qualify for indigent status?</p>
          <input type="text" class="form-control" value="<?php echo $applicant_data['qualify'] == 'yes' ? 'Yes' : 'No'; ?>" readonly>
        </div>
      </div>
    </div>

    <div class="form-container family-background mb-4">
      <h4>Family Background</h4>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="father_name">Father's Name</label>
          <input type="text" class="form-control" value="<?php echo $applicant_data['father_name']; ?>" readonly>
        </div>
        <div class="col-md-6 mb-3">
          <label for="father_age">Father's Age</label>
          <input type="number" class="form-control" value="<?php echo $applicant_data['father_age']; ?>" readonly>
        </div>
        <div class="col-md-6 mb-3">
          <label for="father_occupation">Father's Occupation</label>
          <input type="text" class="form-control" value="<?php echo $applicant_data['father_occupation']; ?>" readonly>
        </div>
        <div class="col-md-6 mb-3">
          <label for="father_income">Father's Monthly Income</label>
          <input type="number" class="form-control" value="<?php echo $applicant_data['father_income']; ?>" readonly>
        </div>
        <div class="col-md-6 mb-3">
          <label for="mother_name">Mother's Name</label>
          <input type="text" class="form-control" value="<?php echo $applicant_data['mother_name']; ?>" readonly>
        </div>
        <div class="col-md-6 mb-3">
          <label for="mother_age">Mother's Age</label>
          <input type="number" class="form-control" value="<?php echo $applicant_data['mother_age']; ?>" readonly>
        </div>
        <div class="col-md-6 mb-3">
          <label for="mother_occupation">Mother's Occupation</label>
          <input type="text" class="form-control" value="<?php echo $applicant_data['mother_occupation']; ?>" readonly>
        </div>
        <div class="col-md-6 mb-3">
          <label for="mother_income">Mother's Monthly Income</label>
          <input type="number" class="form-control" value="<?php echo $applicant_data['mother_income']; ?>" readonly>
        </div>
        <div class="col-md-6 mb-3">
          <label for="parent_contact">Contact no. of parent/s</label>
          <input type="number" class="form-control" value="<?php echo $applicant_data['parent_contact']; ?>" readonly>
        </div>
   
      </div>
    </div>

  
    <div class="form-container family-background mb-4">
      <h4>Educational Background</h4>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="school_name">School Name</label>
          <input type="text" class="form-control" value="<?php echo $applicant_data['senior_high_school']; ?>" readonly>
        </div>
        <div class="col-md-6 mb-3">
          <label for="school_address">School Address</label>
          <input type="text" class="form-control" value="<?php echo $applicant_data['senior_high_school_address']; ?>" readonly>
        </div>
     
      </div>
    </div>
  </form>
<div class="row mb-3">
  <div class="col-md-3">
    <div class="text-center">
      <a href="download.php?applicant_id=<?php echo $applicant_id; ?>&title=Birth cert" class="btn btn-primary">Birth Certificate</a>
    </div>
  </div>
  <div class="col-md-3">
    <div class="text-center">
      <a href="download.php?applicant_id=<?php echo $applicant_id; ?>&title=Indigency file" class="btn btn-primary">Indigency File</a>
    </div>
  </div>
  <div class="col-md-3">
    <div class="text-center">
      <a href="download.php?applicant_id=<?php echo $applicant_id; ?>&title=Good moral" class="btn btn-primary">Good Moral</a>
    </div>
  </div>
  <div class="col-md-3">
    <div class="text-center">
      <a href="download.php?applicant_id=<?php echo $applicant_id; ?>&title=Form 137" class="btn btn-primary">Form 137</a>
    </div>
  </div>
</div>
<div class="text-center mb-4">
  <a href="download.php?applicant_id=<?php echo $applicant_id; ?>&title=Voters id" class="btn btn-primary">Voter's ID</a>
</div>
    






       <div class="text-center">
      <button type="button" class="btn btn-primary" onclick="printForm()">Print Form</button>
    </div>
</body>

  <script>
      function printForm() {
          window.print();
      }
    </script>
</html>
