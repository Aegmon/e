<?php
include("sidebar.php"); // Include sidebar for the $con connection

// Fetch the applicant details based on their name
if (isset($_GET['name'])) {
    $name = mysqli_real_escape_string($con, $_GET['name']);
    $query = "SELECT * FROM applicants WHERE CONCAT(first_name, ' ', last_name) = '$name'";
    $result = mysqli_query($con, $query);
    $applicant = mysqli_fetch_assoc($result);
    if (!$applicant) {
        echo "Applicant not found.";
        exit;
    }
}

// Update the applicant's information in the database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];
    $scholarType = $_POST['scholarType'];
    $status = $_POST['status'];

    $updateQuery = "UPDATE applicants SET 
        first_name = '$first_name', 
        last_name = '$last_name', 
        email = '$email', 
        contact_number = '$contact_number',
        scholarType = '$scholarType', 
        status = '$status'
        WHERE CONCAT(first_name, ' ', last_name) = '$name'";

    if (mysqli_query($con, $updateQuery)) {
        echo "<script>alert('Record updated successfully'); window.location.href = 'record.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}

// Assuming the connection to the database is already established
if (isset($_GET['applicant_id'])) {
    $applicantID = $_GET['applicant_id'];

    // Fetch applicant details based on the applicant_id
    $query = "SELECT * FROM applicants WHERE id = '$applicantID'";
    $result = mysqli_query($con, $query);

    // Check if the query returned any rows
    if (mysqli_num_rows($result) > 0) {
        $applicant = mysqli_fetch_assoc($result);
    } else {
        echo "<p>No applicant found with ID: $applicantID</p>";
        $applicant = null; // Set $applicant to null if no data is found
    }
} else {
    echo "<p>Applicant ID not provided.</p>";
    $applicant = null; // Set $applicant to null if ID is missing
}
?>

<!-- Ensure the form only displays if $applicant data is available -->
<?php if ($applicant): ?>
    <!-- Your form fields here, using $applicant['field_name'] as needed -->
<?php else: ?>
    <p>Error: Applicant data could not be loaded.</p>
<?php endif; ?>
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
                            <form action="" method="POST">
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
                                        <option value="Retained" <?php echo ($applicant['status'] == 'Retained') ? 'selected' : ''; ?>>Retained</option>
                                        <option value="New" <?php echo ($applicant['status'] == 'New') ? 'selected' : ''; ?>>New</option>
                                        <option value="Promoted" <?php echo ($applicant['status'] == 'Promoted') ? 'selected' : ''; ?>>Promoted</option>
                                        <option value="Demoted" <?php echo ($applicant['status'] == 'Demoted') ? 'selected' : ''; ?>>Demoted</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="cor_image">Upload COR</label>
                                    <input type="file" name="cor_image" class="form-control" accept="image/*">
                                </div>
                                <div class="form-group">
                                    <label for="rog_image">Upload ROG</label>
                                    <input type="file" name="rog_image" class="form-control" accept="image/*">
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="record.php" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
