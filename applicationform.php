
<?php
include("connection.php");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $last_name = mysqli_real_escape_string($con, $_POST['last_name']);
    $first_name = mysqli_real_escape_string($con, $_POST['first_name']);
    $middle_name = mysqli_real_escape_string($con, $_POST['middle_name']);
    $date_of_birth = mysqli_real_escape_string($con, $_POST['date_of_birth']);
    $citizenship = mysqli_real_escape_string($con, $_POST['citizenship']);
    $contact_no = mysqli_real_escape_string($con, $_POST['contact_no']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $home_address = mysqli_real_escape_string($con, $_POST['home_address']);
    $civil_status = mysqli_real_escape_string($con, $_POST['civil_status']);
    $present_address = mysqli_real_escape_string($con, $_POST['present_address']);
    $qualify = mysqli_real_escape_string($con, $_POST['qualify']);
    $living_with_family = mysqli_real_escape_string($con, $_POST['living_with_family']);
    $living_with = mysqli_real_escape_string($con, $_POST['living_with']);
    $senior_high_school = mysqli_real_escape_string($con, $_POST['last_school']);
 
        $semester = mysqli_real_escape_string($con, $_POST['semester']);
    $gen_average = mysqli_real_escape_string($con, $_POST['gen_average']);


    $year_level= mysqli_real_escape_string($con, $_POST['year_level']);
        $course= mysqli_real_escape_string($con, $_POST['course']);
    $documents = $_FILES['documents'];
  $emailCheckQuery = "SELECT * FROM applicants WHERE email = '$email'";
    $emailCheckResult = mysqli_query($con, $emailCheckQuery);


    $json_file = 'predictions_output.json';
    $json_data = file_get_contents($json_file);
    $decoded_data = json_decode($json_data, true); 
    
    $eligibility_status = 'Not Eligible';
    $scholar_type = 'No Scholarship';
  $id_picture_path = null;
    if (mysqli_num_rows($emailCheckResult) > 0) {

        echo "<script>alert('Error: This email is already registered.');</script>";
        echo "<script>window.history.back();</script>";
    } else {
    if (isset($_FILES['id_picture']) && $_FILES['id_picture']['error'] === 0) {
        $fileTmpPath = $_FILES['id_picture']['tmp_name'];
        $fileName = uniqid() . '-' . $_FILES['id_picture']['name']; 
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowedExtensions = ['jpg', 'jpeg', 'png'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $uploadPath = 'uploads/' . $fileName;
            

            if (move_uploaded_file($fileTmpPath, $uploadPath)) {
                $id_picture_path = $uploadPath;
            } else {
                echo "Error: Could not save the file.";
            }
        } else {
            echo "Error: Invalid file type.";
        }
    } else {
        echo "Error: No file uploaded or file error.";
    }

    foreach ($decoded_data as $person) {
        if ($gen_average >= $person['GWA'] && 
            (($father_income + $mother_income) >= $person['Income'])) {
            
            $eligibility_status = $person['Eligible']; 

      
            if ($gen_average >= 90 && $gen_average <= 100) {
                $scholar_type = 'Full Scholarship';
            } elseif ($gen_average >= 88 && $gen_average <= 89) {
                $scholar_type = 'Grant Level 1';
            } elseif ($gen_average >= 85 && $gen_average <= 87) {
                $scholar_type = 'Grant Level 2';
            }
            break;
        }
    }

   $query = "INSERT INTO applicants (
                last_name, first_name, middle_name, date_of_birth, citizenship, religion, contact_no, email,
                gender, home_address, zip_code, civil_status, present_address, qualify, father_name, father_age,
                father_occupation, father_income, mother_name, mother_age, mother_occupation, mother_income,
                parent_contact, living_with_family, living_with, num_household, senior_high_school, 
                senior_high_school_address, gen_average, contact_number, email_address, status, scholarType,
                id_picture, semester , year_level , year_course
            ) VALUES (
                '$last_name', '$first_name', '$middle_name', '$date_of_birth', '$citizenship', '', '$contact_no', '$email',
                '$gender', '$home_address', '', '$civil_status', '$present_address', '$qualify', '', '',
                '', '', '', '', '', '',
                '', '$living_with_family', '$living_with', '', '$senior_high_school', 
                '', '$gen_average', '$contact_no', '$email', '$eligibility_status', 
                '$scholar_type', '$id_picture_path','$semester','$year_level' , '$course'
            )";

    // Execute the query to insert applicant data
      if (mysqli_query($con, $query)) {
        $applicant_id = mysqli_insert_id($con);

        // Process and insert uploaded documents
        foreach ($documents['name'] as $key => $fileName) {
            if ($documents['error'][$key] === UPLOAD_ERR_OK) {
                $fileTmpPath = $documents['tmp_name'][$key];
                $fileMime = mime_content_type($fileTmpPath);
                $fileData = file_get_contents($fileTmpPath);

                // Insert document details into the database
                $stmt = $con->prepare("INSERT INTO applicationform (applicant_id, filename, mime_type, data, title) VALUES (?, ?, ?, ?, ?)");
                $docTitle = ucfirst(str_replace('_', ' ', $key)); // Generate title from key
                $stmt->bind_param("issss", $applicant_id, $fileName, $fileMime, $fileData, $docTitle);

                if (!$stmt->execute()) {
                    echo "Failed to upload {$fileName}.<br>";
                }
            }
        }

        echo "Application submitted successfully!";
        header("Location: thankyou.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }

  }
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
  
  <form id="applicationForm" action="" method="POST" enctype="multipart/form-data">
    <header class="mb-4">
      <h2 class="text-center">Application Form</h2>
    </header>

    <h3 class="text-center mb-4">ASEEST Application Form</h3>
    
    <div class="text-center mb-3">
      <label for="id-picture" class="id-picture-label">
        <img src="" alt="" id="id-picture-preview" class="img-thumbnail">
      </label>
 <input type="file" id="id-picture" name="id_picture" class="d-none" accept=".jpg,.jpeg,.png,.pdf">
    </div>

    <p class="text-muted text-center mb-4">
      This application form gathers key information about you and your academic achievements. By completing it, you'll have the chance to showcase your qualifications and demonstrate why you deserve the scholarship.
    </p>

    <div class="form-container personal-details mb-4">
      <h4>Personal Details</h4>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="lastName" class="form-label required">Last Name</label>
          <input type="text" class="form-control" id="lastName" placeholder="Last Name" name="last_name" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="firstName" class="form-label required">First Name</label>
          <input type="text" class="form-control" id="firstName" placeholder="First Name" name="first_name" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="middleName" class="form-label">Middle Name</label>
          <input type="text" class="form-control" id="middleName" placeholder="Middle Name" name="middle_name">
        </div>
        <div class="col-md-6 mb-3">
          <label for="dateOfBirth" class="form-label required">Date of Birth</label>
          <input type="date" class="form-control" id="dateOfBirth" name="date_of_birth" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="citizenship" class="form-label required">Citizenship</label>
          <input type="text" class="form-control" id="citizenship" placeholder="Enter your citizenship" name="citizenship">
        </div>
        <div class="col-md-6 mb-3">
          <label for="gender" class="form-label required">Sex</label>
          <select class="form-select" id="gender" name="gender">
            <option value="0">Select Gender</option>
            <option value="1">Male</option>
            <option value="2">Female</option>
            <option value="3">Non-Binary</option>
          </select>
        </div>
        <div class="col-md-6 mb-3">
          <label for="zipCode" class="form-label required">Zip Code</label>
          <input type="text" placeholder="Enter Zip Code" class="form-control" id="zipCode" name="present_address">
        </div>
        <div class="col-md-6 mb-3">
          <label for="civilStatus" class="form-label required">Civil Status</label>
          <select class="form-select" id="civilStatus" name="civil_status">
            <option value="0">Select Civil Status</option>
            <option value="1">Single</option>
            <option value="2">Married</option>
            <option value="3">Widowed</option>
            <option value="4">Divorced</option>
          </select>
        </div>

        <div class="col-md-6 mb-3">
            <p class="required">Are you a Tarlac resident?</p>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="isTarlac" id="tarlacYes" value="yes">
              <label class="form-check-label" for="residentYes">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="isTarlac" id="tarlacNo" value="no">
              <label class="form-check-label" for="residentNo">No</label>
            </div>
          </div>

          <div class="col-md-6 mb-3">
            <label for="brngy" class="form-label required">Barangay</label>
            <select class="form-select" id="brngy" name="home_address">
              <option>Select Baranggay</option>
              <option value="Not Applicable">Not Applicable</option>
<option value="Aguso">Aguso</option>
<option value="Alvindia">Alvindia</option>
<option value="Amucao">Amucao</option>
<option value="Armenia">Armenia</option>
<option value="Asturias">Asturias</option>
<option value="Atioc">Atioc</option>
<option value="Balanti">Balanti</option>
<option value="Balete">Balete</option>
<option value="Balibago I">Balibago I</option>
<option value="Balibago II">Balibago II</option>
<option value="Balingcanaway">Balingcanaway</option>
<option value="Banaba">Banaba</option>
<option value="Bantog">Bantog</option>
<option value="Baras-baras">Baras-baras</option>
<option value="Batang-batang">Batang-batang</option>
<option value="Binauganan">Binauganan</option>
<option value="Bora">Bora</option>
<option value="Buenavista">Buenavista</option>
<option value="Buhilit">Buhilit</option>
<option value="Burot">Burot</option>
<option value="Calingcuan">Calingcuan</option>
<option value="Capehan">Capehan</option>
<option value="Carangian">Carangian</option>
<option value="Care">Care</option>
<option value="Central">Central</option>
<option value="Culipat">Culipat</option>
<option value="Cut-cut I">Cut-cut I</option>
<option value="Cut-cut II">Cut-cut II</option>
<option value="Dalayap">Dalayap</option>
<option value="Dela Paz">Dela Paz</option>
<option value="Dolores">Dolores</option>
<option value="Laoang">Laoang</option>
<option value="Ligtasan">Ligtasan</option>
<option value="Lourdes">Lourdes</option>
<option value="Mabini">Mabini</option>
<option value="Maligaya">Maligaya</option>
<option value="Maliwalo">Maliwalo</option>
<option value="Mapalacsiao">Mapalacsiao</option>
<option value="Mapalad">Mapalad</option>
<option value="Matatalaib">Matatalaib</option>
<option value="Paraiso">Paraiso</option>
<option value="Poblacion">Poblacion</option>
<option value="Salapungan">Salapungan</option>
<option value="San Carlos">San Carlos</option>
<option value="San Francisco">San Francisco</option>
<option value="San Isidro">San Isidro</option>
<option value="San Jose">San Jose</option>
<option value="San Jose de Urquico">San Jose de Urquico</option>
<option value="San Juan Bautista (formerly Matadero)">San Juan Bautista (formerly Matadero)</option>
<option value="San Juan de Mata (formerly Malatiki)">San Juan de Mata (formerly Malatiki)</option>
<option value="San Luis">San Luis</option>
<option value="San Manuel">San Manuel</option>
<option value="San Miguel">San Miguel</option>
<option value="San Nicolas">San Nicolas</option>
<option value="San Pablo">San Pablo</option>
<option value="San Pascual">San Pascual</option>
<option value="San Rafael">San Rafael</option>
<option value="San Roque">San Roque</option>
<option value="San Sebastian">San Sebastian</option>
<option value="San Vicente">San Vicente</option>
<option value="Santa Cruz">Santa Cruz</option>
<option value="Santa Maria">Santa Maria</option>
<option value="Santo Cristo">Santo Cristo</option>
<option value="Santo Domingo">Santo Domingo</option>
<option value="Santo Niño">Santo Niño</option>
<option value="Sapang Maragul">Sapang Maragul</option>
<option value="Sapang Tagalog">Sapang Tagalog</option>
<option value="Sepung Calzada (Panampunan)">Sepung Calzada (Panampunan)</option>
<option value="Sinait">Sinait</option>
<option value="Suizo">Suizo</option>
<option value="Tariji">Tariji</option>
<option value="Tibag">Tibag</option>
<option value="Tibagan">Tibagan</option>
<option value="Trinidad">Trinidad</option>
<option value="Ungot">Ungot</option>
<option value="Villa Bacolor">Villa Bacolor</option>

              
            </select>
          </div>

        <div class="col-md-12 mb-3">
          <p class="required">Do you qualify for indigent status?</p>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="qualify" id="qualifyYes" value="yes">
            <label class="form-check-label" for="qualifyYes">Yes</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="qualify" id="qualifyNo" value="no">
            <label class="form-check-label" for="qualifyNo">No</label>
          </div>
        </div>

        
          
          <div class="col-md-6 mb-3">
            <p  class="required">Are you living with your family?</p>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="living_with_family" id="qualifyYes" value="yes">
              <label class="form-check-label" for="check-yes">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="living_with_family" id="qualifyNo" value="no">
              <label class="form-check-label" for="check-no">No</label>
            </div>
          </div>
          
          <div class="col-md-6 mb-3">
            <label for="num_working" class="required">If yes, how many people are working in the family?</label>
            <select class="form-select" name="num_working" required>
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
          <div class="col-md-12 mb-3">
            <label for="living_with" class="required">If not, with whom are you living?</label>
            <input type="text" class="form-control" name="living_with">
          </div>

      </div>
    </div>
     

    <!-- //FAMILY COMPOSITION -->
    <div class="form-container family-background mb-4">
      <h4>Family/Guardian Composition</h4>
      <div id="family-composition">
        <!-- Initial Row -->
        <div class="row align-items-center mb-3 family-row">
          <div class="col-md-3">
            <label for="name">Name <span style="color: red;">*</span></label>
            <input type="text" class="form-control" name="name[]" placeholder="Enter name" required>
          </div>
          <div class="col-md-3">
            <label for="relationship">Relationship <span style="color: red;">*</span></label>
            <input type="text" class="form-control" name="relationship[]" placeholder="Enter relationship" required>
          </div>
          <div class="col-md-3">
            <label for="occupation">Occupation <span style="color: red;">*</span></label>
            <input type="text" class="form-control" name="occupation[]" placeholder="Enter occupation" required>
          </div>
          <div class="col-md-3">
            <label for="monthly_income">Monthly Income <span style="color: red;">*</span></label>
            <input type="number" class="form-control" name="monthly_income[]" placeholder="Enter income" required>
          </div>
        </div>
      </div>
      <!-- Control Buttons -->
      <div class="d-flex gap-2">
        <button type="button" id="add-more" class="btn btn-primary">
          + Add More
        </button>
        <button type="button" id="remove-last" class="btn btn-danger">
          - Remove Last
        </button>
      </div>
    </div>
    
    

   <!-- Educational Background Section -->
   <div class="form-container educational-background mb-4">
    <h4>Educational Background</h4>
   
      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="lastSchool" class="form-label">
            Name of Last School Attended (For Freshmen and Transferees) <span class="text-danger">*</span>
          </label>
          <input type="text" class="form-control" id="lastSchool" name="last_school" placeholder="Put 'n/a' if not applicable" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="course" class="form-label">
            Course <span class="text-danger">*</span>
          </label>
          <select class="form-select" id="course" name="course" required>
            <option value="">Select Course</option>
            <!-- College of Education -->
            <option value="Bachelor of Elementary Education">Bachelor of Elementary Education</option>
            <option value="Bachelor of Secondary Education (Major in English)">Bachelor of Secondary Education (Major in English)</option>
            <option value="Bachelor of Secondary Education (Major in Mathematics)">Bachelor of Secondary Education (Major in Mathematics)</option>
            <option value="Bachelor of Secondary Education (Major in Science)">Bachelor of Secondary Education (Major in Science)</option>
            <option value="Bachelor of Secondary Education (Major in Filipino)">Bachelor of Secondary Education (Major in Filipino)</option>
            <option value="Bachelor of Secondary Education (Major in Social Studies)">Bachelor of Secondary Education (Major in Social Studies)</option>
            <option value="Bachelor of Early Childhood Education">Bachelor of Early Childhood Education</option>

            <!-- College of Business and Accountancy -->
            <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy</option>
            <option value="Bachelor of Science in Accounting Information System">Bachelor of Science in Accounting Information System</option>
            <option value="Bachelor of Science in Business Administration (Major in Financial Management)">Bachelor of Science in Business Administration (Major in Financial Management)</option>
            <option value="Bachelor of Science in Business Administration (Major in Human Resource Management)">Bachelor of Science in Business Administration (Major in Human Resource Management)</option>
            <option value="Bachelor of Science in Business Administration (Major in Marketing Management)">Bachelor of Science in Business Administration (Major in Marketing Management)</option>
            <option value="Bachelor of Science in Entrepreneurship">Bachelor of Science in Entrepreneurship</option>

            <!-- College of Arts and Social Sciences -->
            <option value="Bachelor of Arts in English Language Studies">Bachelor of Arts in English Language Studies</option>
            <option value="Bachelor of Science in Psychology">Bachelor of Science in Psychology</option>

            <!-- College of Computer Studies -->
            <option value="Bachelor of Science in Computer Science">Bachelor of Science in Computer Science</option>
            <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology</option>
            <option value="Bachelor of Science in Information Systems">Bachelor of Science in Information Systems</option>

            <!-- College of Engineering and Technology -->
            <option value="Bachelor of Science in Civil Engineering">Bachelor of Science in Civil Engineering</option>
            <option value="Bachelor of Science in Electrical Engineering">Bachelor of Science in Electrical Engineering</option>
            <option value="Bachelor of Science in Electronics Engineering">Bachelor of Science in Electronics Engineering</option>
            <option value="Bachelor of Science in Mechanical Engineering">Bachelor of Science in Mechanical Engineering</option>
            <option value="Bachelor of Science in Industrial Engineering">Bachelor of Science in Industrial Engineering</option>
            <option value="Bachelor of Engineering Technology">Bachelor of Engineering Technology</option>

            <!-- College of Science -->
            <option value="Bachelor of Science in Biology">Bachelor of Science in Biology</option>
            <option value="Bachelor of Science in Mathematics">Bachelor of Science in Mathematics</option>
            <option value="Bachelor of Science in Chemistry">Bachelor of Science in Chemistry</option>

            <!-- College of Public Administration and Governance -->
            <option value="Bachelor of Public Administration">Bachelor of Public Administration</option>

            <!-- College of Architecture and Fine Arts -->
            <option value="Bachelor of Science in Architecture">Bachelor of Science in Architecture</option>
            <option value="Bachelor of Fine Arts (Major in Visual Communication)">Bachelor of Fine Arts (Major in Visual Communication)</option>

            <!-- College of Criminal Justice Education -->
            <option value="Bachelor of Science in Criminology">Bachelor of Science in Criminology</option>

            <!-- College of Hospitality and Tourism Management -->
            <option value="Bachelor of Science in Hospitality Management">Bachelor of Science in Hospitality Management</option>
            <option value="Bachelor of Science in Tourism Management">Bachelor of Science in Tourism Management</option>

            <!-- College of Law -->
            <option value="Bachelor of Laws">Bachelor of Laws</option>

            
          </select>
        </div>
        <div class="col-md-6 mb-3">
          <label for="generalAverage" class="form-label">
            General Average <span class="text-danger">*</span>
            <a href="#" data-bs-toggle="modal" data-bs-target="#averageInfoModal">?</a>
          </label>
          <input type="number" class="form-control" id="generalAverage" name="gen_average" placeholder="Enter general average" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="semester" class="form-label">
            Semester <span class="text-danger">*</span>
          </label>
          <select class="form-select" id="semester" name="semester" required>
            <option value="">Select Semester</option>
            <option value="2024-2025">2024-2025</option>
            <option value="2025-2026">2025-2026</option>
            <option value="2026-2027">2026-2027</option>
          </select>
        </div>
        <div class="col-md-6 mb-3">
          <label for="yearLevel" class="form-label">
            Year Level <span class="text-danger">*</span>
          </label>
          <select class="form-select" id="yearLevel" name="year_level" required>
            <option value="">Select Year Level</option>
            <option value="1st Year">1st Year</option>
            <option value="2nd Year">2nd Year</option>
            <option value="3rd Year">3rd Year</option>
            <option value="4th Year">4th Year</option>
            <option value="5th Year">5th Year</option>
          </select>
        </div>
      </div>
    </div>
    
    <!-- Modal for General Average Information -->
    <div class="modal fade" id="averageInfoModal" tabindex="-1" aria-labelledby="averageInfoModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="averageInfoModalLabel">General Average Information</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            General Average refers to the average grade achieved in your previous academic year. If you're a transferee or freshman, include your general average from your previous school.
<br>
<br>
            For 2nd to 5th year:
            <br>
            <br>
            Please input your General Point Average (GPA) as your General Weighted Average (GWA). Refer to the conversion chart below for guidance:
            <img src="https://gwacalculator.com/wp-content/uploads/2023/07/image.png.webp" alt="GPA to GWA Conversion Chart" class="img-fluid">


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>

    <div class="form-container contact-information mb-4">
      <h4>Contact Information</h4>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="contactNumber" class="form-label">Contact Number<span style="color: red;">*</span></label>
          <input type="tel" class="form-control" id="contactNumber" placeholder="Enter contact number" name="contact_no" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="emailAddress" class="form-label">Email Address<span style="color: red;">*</span></label>
          <input type="email" class="form-control" id="emailAddress" placeholder="Enter email address" name="email" required>
        </div>
      </div>
    </div>

    <div class="file-upload-container mb-4">
        <div class="file-container">
          <h2 class="text-center">Upload the Following Required Documents:</h2>
          <p class="p3 text-center">Please make sure to read and double-check all the information you have filled out.</p>
        <div class="document-container">
    <div class="file-upload mb-3">
        <h3>Birth Certificate<span style="color: red; font-size: 20px;">*</span></h3>
        <p class="p2">(PSA)</p>
        <input type="file" id="birthcert" name="documents[birth_cert]" accept="application/pdf" class="form-control" required>
    </div>
</div>

<div class="document-container">
    <div class="file-upload mb-3">
        <h3>Indigency Certificate<span style="color: red; font-size: 20px;">*</span></h3>
        <p class="p2">with the purpose stated as Scholarship</p>
        <input type="file" id="indigencyFile" name="documents[indigency_file]" accept="application/pdf" class="form-control" required>
    </div>
</div>

<div class="document-container">
    <div class="file-upload mb-3">
        <h3>Certificate of Good Moral<span style="color: red; font-size: 20px;">*</span></h3>
        <input type="file" id="goodmoral" name="documents[good_moral]" accept="application/pdf" class="form-control" required>
    </div>
</div>

<div class="document-container">
    <div class="file-upload mb-3">
        <h3>Form 137<span style="color: red; font-size: 20px;">*</span></h3>
        <input type="file" id="form137" name="documents[form_137]" accept="application/pdf" class="form-control" required>
    </div>
</div>

<div class="document-container">
    <div class="file-upload mb-3">
        <h3>Voter's ID of Parents<span style="color: red; font-size: 20px;">*</span></h3>
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

<script>
  document.addEventListener('DOMContentLoaded', function () {
  const familyComposition = document.getElementById('family-composition');
  const addMoreButton = document.getElementById('add-more');
  const removeLastButton = document.getElementById('remove-last');

  // Add new input group
  addMoreButton.addEventListener('click', () => {
    const newRow = document.createElement('div');
    newRow.classList.add('row', 'align-items-center', 'mb-3', 'family-row');
    newRow.innerHTML = `
      <div class="col-md-3">
        <label for="name">Name <span style="color: red;">*</span></label>
        <input type="text" class="form-control" name="name[]" placeholder="Enter name" required>
      </div>
      <div class="col-md-3">
        <label for="relationship">Relationship <span style="color: red;">*</span></label>
        <input type="text" class="form-control" name="relationship[]" placeholder="Enter relationship" required>
      </div>
      <div class="col-md-3">
        <label for="occupation">Occupation <span style="color: red;">*</span></label>
        <input type="text" class="form-control" name="occupation[]" placeholder="Enter occupation" required>
      </div>
      <div class="col-md-3">
        <label for="monthly_income">Monthly Income <span style="color: red;">*</span></label>
        <input type="number" class="form-control" name="monthly_income[]" placeholder="Enter income" required>
      </div>
    `;
    familyComposition.appendChild(newRow);
  });

  // Remove the last input group
  removeLastButton.addEventListener('click', () => {
    const rows = document.querySelectorAll('.family-row');
    if (rows.length > 1) {
      familyComposition.removeChild(rows[rows.length - 1]);
    } else {
      alert('At least one row must remain.');
    }
  });
});



    


</script>

  
  