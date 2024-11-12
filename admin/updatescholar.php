<?php
include("sidebar.php"); // Include sidebar for the $con connection

$applicant = null; // Initialize $applicant as null

// Check if applicant_id is provided in the URL
if (isset($_GET['applicant_id'])) {
    $applicant_id = mysqli_real_escape_string($con, $_GET['applicant_id']);
    $query = "SELECT * FROM applicants WHERE id = '$applicant_id'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $applicant = mysqli_fetch_assoc($result);
    } else {
        echo "Applicant not found.";
        exit;
    }
}

// If form is submitted, handle the POST request for updating
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $applicant) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];
    $scholarType = $_POST['scholarType'];
    $status = $_POST['status'];

    // Update the applicant's basic details
    $updateQuery = "UPDATE applicants SET 
        first_name = '$first_name', 
        last_name = '$last_name', 
        email = '$email', 
        contact_number = '$contact_number',
        scholarType = '$scholarType', 
        status = '$status'
        WHERE id = '$applicant_id'";

    // Check if the update query was successful
    if (mysqli_query($con, $updateQuery)) {
        echo "<script>alert('Record updated successfully'); window.location.href = 'record.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }

    // Handle file uploads
    if (isset($_FILES['documents'])) {
        foreach ($_FILES['documents']['tmp_name'] as $key => $tmp_name) {
            if ($_FILES['documents']['error'][$key] === UPLOAD_ERR_OK) {
                $filename = basename($_FILES['documents']['name'][$key]);
                $mime_type = $_FILES['documents']['type'][$key];
                $data = file_get_contents($tmp_name);

                if ($key === 'cor_image') {
                    // Update the "cor" document fields
                    $stmt = $con->prepare("UPDATE applicants SET 
                        cor_filename = ?, cor_mime_type = ?, cor_data = ? 
                        WHERE id = ?");
                    
                    if ($stmt === false) {
                        die("Error preparing SQL statement for cor_image: " . $con->error);
                    }

                    $stmt->bind_param("ssbi", $filename, $mime_type, $data, $applicant_id);

                } elseif ($key === 'rog_image') {
                    // Update the "rog" document fields
                    $stmt = $con->prepare("UPDATE applicants SET 
                        rog_filename = ?, rog_mime_type = ?, rog_data = ? 
                        WHERE id = ?");
                    
                    if ($stmt === false) {
                        die("Error preparing SQL statement for rog_image: " . $con->error);
                    }

                    $stmt->bind_param("ssbi", $filename, $mime_type, $data, $applicant_id);
                }

                // Execute the statement and check for success
                if ($stmt->execute()) {
                    echo "File {$filename} updated successfully.<br>";
                } else {
                    echo "Failed to update {$filename}. Error: " . $stmt->error . "<br>";
                }
                $stmt->close();
            } else {
                echo "Error uploading file: " . $_FILES['documents']['name'][$key] . "<br>";
            }
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
    
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                    <div class="card flex-fill p-2">
                        <div class="card-header">
                            <h3>Update Applicant Information</h3>
                        </div>
                        <div class="card-body">
                            <?php if ($applicant): ?>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" name="first_name" value="<?php echo $applicant['first_name']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" value="<?php echo $applicant['last_name']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" value="<?php echo $applicant['email']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_number">Contact Number</label>
                                        <input type="text" class="form-control" name="contact_number" value="<?php echo $applicant['contact_number']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="scholarType">Scholarship Type</label>
                                        <select class="form-control" name="scholarType" required>
                                            <option value="Full Scholarship" <?php echo ($applicant['scholarType'] == 'Full Scholarship') ? 'selected' : ''; ?>>Full Scholarship</option>
                                            <option value="Grantee Level 1" <?php echo ($applicant['scholarType'] == 'Grantee Level 1') ? 'selected' : ''; ?>>Grantee Level 1</option>
                                            <option value="Grantee Level 2" <?php echo ($applicant['scholarType'] == 'Grantee Level 2') ? 'selected' : ''; ?>>Grantee Level 2</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Scholarship Status</label>
                                        <select class="form-control" name="status" required>
                                            <option value="Granted" <?php echo ($applicant['status'] == 'Granted') ? 'selected' : ''; ?>>Granted</option>
                                            <option value="Retained" <?php echo ($applicant['status'] == 'Retained') ? 'selected' : ''; ?>>Retained</option>
                                            <option value="New" <?php echo ($applicant['status'] == 'New') ? 'selected' : ''; ?>>New</option>
                                            <option value="Promoted" <?php echo ($applicant['status'] == 'Promoted') ? 'selected' : ''; ?>>Promoted</option>
                                            <option value="Demoted" <?php echo ($applicant['status'] == 'Demoted') ? 'selected' : ''; ?>>Demoted</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="cor_image">Upload COR</label>
                                        <input type="file" name="documents[cor_image]" class="form-control" accept="pdf/*">
                                    </div>
                                    <div class="form-group">
                                        <label for="rog_image">Upload ROG</label>
                                        <input type="file" name="documents[rog_image]" class="form-control" accept="pdf/*">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
