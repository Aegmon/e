
<?php
include("connection.php");
    $command = escapeshellcmd("python3 app.py"); // Adjust the Python script filename if needed
    shell_exec($command); // Execute the Python script
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $last_name = mysqli_real_escape_string($con, $_POST['last_name']);
    $first_name = mysqli_real_escape_string($con, $_POST['first_name']);
    $middle_name = mysqli_real_escape_string($con, $_POST['middle_name']);
    $date_of_birth = mysqli_real_escape_string($con, $_POST['date_of_birth']);
    $citizenship = mysqli_real_escape_string($con, $_POST['citizenship']);
    $religion = mysqli_real_escape_string($con, $_POST['religion']);
    $contact_no = mysqli_real_escape_string($con, $_POST['contact_no']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $home_address = mysqli_real_escape_string($con, $_POST['home_address']);
    $zip_code = mysqli_real_escape_string($con, $_POST['zip_code']);
    $civil_status = mysqli_real_escape_string($con, $_POST['civil_status']);
    $present_address = mysqli_real_escape_string($con, $_POST['present_address']);
    $qualify = mysqli_real_escape_string($con, $_POST['qualify']);
    $father_name = mysqli_real_escape_string($con, $_POST['father_name']);
    $father_age = mysqli_real_escape_string($con, $_POST['father_age']);
    $father_occupation = mysqli_real_escape_string($con, $_POST['father_occupation']);
    $father_income = mysqli_real_escape_string($con, $_POST['father_income']);
    $mother_name = mysqli_real_escape_string($con, $_POST['mother_name']);
    $mother_age = mysqli_real_escape_string($con, $_POST['mother_age']);
    $mother_occupation = mysqli_real_escape_string($con, $_POST['mother_occupation']);
    $mother_income = mysqli_real_escape_string($con, $_POST['mother_income']);
    $parent_contact = mysqli_real_escape_string($con, $_POST['parent_contact']);
    $living_with_family = mysqli_real_escape_string($con, $_POST['living_with_family']);
    $living_with = mysqli_real_escape_string($con, $_POST['living_with']);
    $num_household = mysqli_real_escape_string($con, $_POST['num_household']);
    $senior_high_school = mysqli_real_escape_string($con, $_POST['senior_high_school']);
    $senior_high_school_address = mysqli_real_escape_string($con, $_POST['senior_high_school_address']);
    $gen_average = mysqli_real_escape_string($con, $_POST['gen_average']);
    $contact_number = mysqli_real_escape_string($con, $_POST['contact_number']);
    $email_address = mysqli_real_escape_string($con, $_POST['email_address']);

    // Run the Python script and get the output (i.e., generate the predictions.json file)
    $command = escapeshellcmd("python3 app.py"); // Adjust the Python script filename if needed
    shell_exec($command); // Execute the Python script

    // Read the predictions.json file after Python script execution
    $json_file = 'predictions_output.json';
    $json_data = file_get_contents($json_file); // Read the file content
    $decoded_data = json_decode($json_data, true); // Decode JSON to associative array
    
    // Initialize scholarship eligibility and type
    $eligibility_status = 'Ineligible';
    $scholar_type = 'No Scholarship';

    // Check eligibility based on GWA and income from JSON
    foreach ($decoded_data as $person) {
        if ($gen_average >= $person['GWA'] && 
            (($father_income + $mother_income) >= $person['Income'])) {
            
            $eligibility_status = $person['Eligible']; // Set eligibility status from JSON data

            // Determine scholarship type based on GWA
            if ($gen_average >= 90 && $gen_average <= 100) {
                $scholar_type = 'Full Scholarship';
            } elseif ($gen_average >= 88 && $gen_average <= 89) {
                $scholar_type = 'Grant Level 1';
            } elseif ($gen_average >= 85 && $gen_average <= 87) {
                $scholar_type = 'Grant Level 2';
            }
            break; // Exit the loop once eligibility is determined
        }
    }

    // Insert applicant data into the database
    $query = "INSERT INTO applicants (
                last_name, first_name, middle_name, date_of_birth, citizenship, religion, contact_no, email,
                gender, home_address, zip_code, civil_status, present_address, qualify, father_name, father_age,
                father_occupation, father_income, mother_name, mother_age, mother_occupation, mother_income,
                parent_contact, living_with_family, living_with, num_household, senior_high_school, 
                senior_high_school_address, gen_average, contact_number, email_address, status, scholarType
            ) VALUES (
                '$last_name', '$first_name', '$middle_name', '$date_of_birth', '$citizenship', '$religion', '$contact_no', '$email',
                '$gender', '$home_address', '$zip_code', '$civil_status', '$present_address', '$qualify', '$father_name', '$father_age',
                '$father_occupation', '$father_income', '$mother_name', '$mother_age', '$mother_occupation', '$mother_income',
                '$parent_contact', '$living_with_family', '$living_with', '$num_household', '$senior_high_school', 
                '$senior_high_school_address', '$gen_average', '$contact_number', '$email_address', '$eligibility_status', '$scholar_type'
            )";

    // Execute the query to insert applicant data
    if (mysqli_query($con, $query)) {
        // Get the last inserted applicant_id
        $applicant_id = mysqli_insert_id($con);

        // Insert documents into the applicationForm table (assuming documents are being handled)
        foreach ($documents as $doc) {
            $stmt = $con->prepare("INSERT INTO applicationForm (applicant_id, filename, mime_type, data, title) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $applicant_id, $doc['name'], $doc['mime_type'], $doc['data'], $doc['title']);
            
            if ($stmt->execute()) {
                echo "File {$doc['name']} uploaded successfully.<br>";
            } else {
                echo "Failed to upload {$doc['name']}.<br>";
            }
        }

        header("Location: thankyou.php"); // Redirect to a Thank You page after submission
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }

    // Close the connection
    mysqli_close($con);
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
</head>

<body class="container my-5">
  <form id="applicationForm" action="" method="post" enctype="multipart/form-data">
    <header class="mb-4">
      <h2 class="text-center">Application Form</h2>
    </header>

    <h3 class="text-center mb-4">ASEEST Application Form</h3>
    
    <div class="text-center mb-3">
      <label for="id-picture" class="id-picture-label">
        <img src="" alt="" id="id-picture-preview" class="img-thumbnail">
      </label>
      <input type="file" id="id-picture" name="id_picture" class="d-none">
    </div>

    <p class="text-muted text-center mb-4">
      This application form gathers key information about you and your academic achievements. By completing it, you'll have the chance to showcase your qualifications and demonstrate why you deserve the scholarship.
    </p>

    <div class="form-container personal-details mb-4">
      <h4>Personal Details</h4>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="lastName" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="lastName" placeholder="Last Name" name="last_name" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="firstName" class="form-label">First Name</label>
          <input type="text" class="form-control" id="firstName" placeholder="First Name" name="first_name" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="middleName" class="form-label">Middle Name</label>
          <input type="text" class="form-control" id="middleName" placeholder="Middle Name" name="middle_name">
        </div>
        <div class="col-md-6 mb-3">
          <label for="dateOfBirth" class="form-label">Date of Birth</label>
          <input type="date" class="form-control" id="dateOfBirth" name="date_of_birth" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="citizenship" class="form-label">Citizenship</label>
          <input type="text" class="form-control" id="citizenship" placeholder="Enter your citizenship" name="citizenship">
        </div>
        <div class="col-md-6 mb-3">
          <label for="religion" class="form-label">Religion</label>
          <input type="text" class="form-control" id="religion" placeholder="Enter your religion" name="religion">
        </div>
        <div class="col-md-6 mb-3">
          <label for="contactNo" class="form-label">Contact No.</label>
          <input type="number" class="form-control" id="contactNo" placeholder="Enter contact number" name="contact_no" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" class="form-control" id="email" placeholder="Enter email address" name="email" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="gender" class="form-label">Sex</label>
          <select class="form-select" id="gender" name="gender">
            <option value="0">Select Gender</option>
            <option value="1">Male</option>
            <option value="2">Female</option>
            <option value="3">Non-Binary</option>
          </select>
        </div>
        <div class="col-md-6 mb-3">
          <label for="homeAddress" class="form-label">Home Address</label>
          <input type="text" class="form-control" id="homeAddress" placeholder="Enter home address" name="home_address" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="zipCode" class="form-label">Zip Code</label>
          <input type="text" class="form-control" id="zipCode" name="zip_code">
        </div>
        <div class="col-md-6 mb-3">
          <label for="civilStatus" class="form-label">Civil Status</label>
          <select class="form-select" id="civilStatus" name="civil_status">
            <option value="0">Select Civil Status</option>
            <option value="1">Single</option>
            <option value="2">Married</option>
            <option value="3">Widowed</option>
            <option value="4">Divorced</option>
          </select>
        </div>
        <div class="col-md-12 mb-3">
          <label for="presentAddress" class="form-label">Present Address</label>
          <input type="text" class="form-control" id="presentAddress" placeholder="Enter present address" name="present_address" required>
        </div>

        <div class="col-md-12">
          <p>Do you qualify for indigent status?</p>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="qualify" id="qualifyYes" value="yes">
            <label class="form-check-label" for="qualifyYes">Yes</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="qualify" id="qualifyNo" value="no">
            <label class="form-check-label" for="qualifyNo">No</label>
          </div>
        </div>
      </div>
    </div>

      <div class="form-container family-background mb-4">
        <h4>Family Background</h4>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="father_name">Father's Name</label>
            <input type="text" class="form-control" name="father_name" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="father_age">Father's Age</label>
            <input type="number" class="form-control" name="father_age" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="father_occupation">Father's Occupation</label>
            <input type="text" class="form-control" name="father_occupation" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="father_income">Father's Monthly Income</label>
            <input type="number" class="form-control" name="father_income" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="mother_name">Mother's Name</label>
            <input type="text" class="form-control" name="mother_name" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="mother_age">Mother's Age</label>
            <input type="number" class="form-control" name="mother_age" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="mother_occupation">Mother's Occupation</label>
            <input type="text" class="form-control" name="mother_occupation" required> 
          </div>
          <div class="col-md-6 mb-3">
            <label for="mother_income">Mother's Monthly Income</label>
            <input type="number" class="form-control" name="mother_income" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="parent_contact">Contact no. of parent/s</label>
            <input type="number" class="form-control" placeholder="Enter contact number" name="parent_contact" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mb-3">
            <label>Are you living with your family?</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="check-yes" name="living_with_family" value="yes">
              <label class="form-check-label" for="check-yes">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="check-no" name="living_with_family" value="no">
              <label class="form-check-label" for="check-no">No</label>
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <label for="living_with">If not, with whom are you living?</label>
            <input type="text" class="form-control" name="living_with">
          </div>
          <div class="col-md-6 mb-3">
            <label for="num_household">Number of people in household</label>
            <select class="form-select" name="num_household" required>
              <option value="">Select</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
            </select>
          </div>
        </div>
      </div>

   <!-- Educational Background Section -->
   <div class="form-container educational-background mb-4">
    <h4>Educational Background</h4>
    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="senior_high_school">Senior High School Name of School</label>
        <input type="text" class="form-control" name="senior_high_school" required>
      </div>
      <div class="col-md-6 mb-3">
        <label for="senior_high_school_address">Senior High School Address</label>
        <input type="text" class="form-control" name="senior_high_school_address" required>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="gen_average">General Average School Last Attended</label>
        <input type="number" class="form-control" name="gen_average" placeholder="Enter general average" required>
      </div>
    </div>
  </div>

    <div class="form-container contact-information mb-4">
      <h4>Contact Information</h4>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="contactNumber" class="form-label">Contact Number</label>
          <input type="tel" class="form-control" id="contactNumber" placeholder="Enter contact number" name="contact_number" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="emailAddress" class="form-label">Email Address</label>
          <input type="email" class="form-control" id="emailAddress" placeholder="Enter email address" name="email_address" required>
        </div>
      </div>
    </div>

    <div class="file-upload-container mb-4">
        <div class="file-container">
          <h2 class="text-center">Upload the Following Required Documents:</h2>
          <p class="p3 text-center">Please make sure to read and double-check all the information you have filled out.</p>
        <div class="document-container">
    <div class="file-upload mb-3">
        <h3>Birth Certificate</h3>
        <p class="p2">(PSA)</p>
        <input type="file" id="birthcert" name="documents[birth_cert]" accept="application/pdf" class="form-control" required>
    </div>
</div>

<div class="document-container">
    <div class="file-upload mb-3">
        <h3>Indigency Certificate</h3>
        <p class="p2">with the purpose stated as Scholarship</p>
        <input type="file" id="indigencyFile" name="documents[indigency_file]" accept="application/pdf" class="form-control" required>
    </div>
</div>

<div class="document-container">
    <div class="file-upload mb-3">
        <h3>Certificate of Good Moral</h3>
        <input type="file" id="goodmoral" name="documents[good_moral]" accept="application/pdf" class="form-control" required>
    </div>
</div>

<div class="document-container">
    <div class="file-upload mb-3">
        <h3>Form 137</h3>
        <input type="file" id="form137" name="documents[form_137]" accept="application/pdf" class="form-control" required>
    </div>
</div>

<div class="document-container">
    <div class="file-upload mb-3">
        <h3>Voter's ID of Parents</h3>
        <input type="file" id="votersID" name="documents[voters_id]" accept="application/pdf" class="form-control" required>
    </div>
</div>

          
       
     
          
        <p class="p3 text-center mt-4">We appreciate your time and effort in providing us with the necessary details.<br> Best of luck with your application!</p>
      </div>
      

    <div class="button-container d-flex justify-content-between">
      <button type="button" class="btn btn-outline-danger" onclick="window.location.href='index.php';">Cancel</button>
      <button type="submit" name="apply" class="btn btn-primary">Submit</button>
    </div>
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<script>
    document.getElementById('id-picture').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');

                   
                    const targetWidth = 2 * 300; 
                    const targetHeight = 2 * 300;

                    
                    let width = img.width;
                    let height = img.height;
                    let scaleFactor = 1;

                    if (width > height) {
                        scaleFactor = targetWidth / width;
                    } else {
                        scaleFactor = targetHeight / height;
                    }

                    canvas.width = targetWidth;
                    canvas.height = targetHeight;

                    ctx.drawImage(img, 0, 0, width * scaleFactor, height * scaleFactor);

        
                    document.getElementById('id-picture-preview').src = canvas.toDataURL('image/jpeg', 0.9); // Adjust quality if needed
                };

                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

<script>
  function validatePDF(inputId) {
    const inputFile = document.getElementById(inputId);
    const filePath = inputFile.value;
    const allowedExtensions = /(\.pdf)$/i;

    if (!filePath) {
      alert('No files selected/uploaded.');
      return false;
    }

    if (!allowedExtensions.exec(filePath)) {
      alert('Only PDF files are allowed.');
      inputFile.value = '';
      return false;
    } else {
      alert('File is a valid PDF.');
      return true;
    }
  }
</script>

  
  