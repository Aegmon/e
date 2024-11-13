<?php
include("sidebar.php"); // Include the sidebar (which has the $con connection)
?>
<?php
// Create Account Backend Code (create_account.php)

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $applicantID = $_POST['applicantID'];
    $applicationID = $_POST['application_id'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into scholaraccount table
    $query = "INSERT INTO scholaraccount (application_id, email, password) VALUES ('$applicationID', '$email', '$hashed_password')";
    $result = mysqli_query($con, $query);
    if ($result) {
        echo "<script type='text/javascript'>
            alert('Account successfully created.');
            window.location.href = 'record.php';
          </script>";
    } else {
        echo "Error creating account: " . mysqli_error($con);
    }
}

// Function to generate a random password
function generateRandomPassword($length = 12) {
    $charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()";
    $password = "";
    for ($i = 0; $i < $length; $i++) {
        $randomIndex = rand(0, strlen($charset) - 1);
        $password .= $charset[$randomIndex];
    }
    return $password;
}

// Generate the password
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
                            <!-- Nav tabs for Eligible, Uneligible, and Archive -->
                            <ul class="nav nav-tabs" id="eligibilityTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="eligible-tab" data-bs-toggle="tab" href="#eligible" role="tab" aria-controls="eligible" aria-selected="true">Scholars</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="uneligible-tab" data-bs-toggle="tab" href="#uneligible" role="tab" aria-controls="uneligible" aria-selected="false">Accounts</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="archive-tab" data-bs-toggle="tab" href="#archive" role="tab" aria-controls="archive" aria-selected="false">Archive</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <!-- Tab content -->
                            <div class="tab-content" id="eligibilityTabsContent">
                                <!-- Eligible Tab -->
                                <div class="tab-pane fade show active" id="eligible" role="tabpanel" aria-labelledby="eligible-tab">
                            <div class="table-responsive">
                              <table class="table p-2" id="filterTableEligible">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Name</th>
                                            <th style="text-align: center;">Academic Year</th>
                                            <th style="text-align: center;">Semester</th>
                                            <th style="text-align: center;">Application Form</th>
                                            <th style="text-align: center;">Scholarship Type</th>
                                            <th style="text-align: center;">Scholarship Status</th>
                                            <th style="text-align: center;">COR</th>
                                            <th style="text-align: center;">ROG</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $qry = "SELECT * FROM applicants 
                                                    WHERE status = 'Granted' AND isArchive = '0'"; 
                                            $ses_sql = mysqli_query($con, $qry);
                                            while ($row = mysqli_fetch_array($ses_sql)) {
                                                $fname = $row['first_name'];
                                                $lname = $row['last_name'];
                                                $rowid = $row['id'];
                                                $emailadd = $row['email'];
                                        ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $lname . ', ' . $fname; ?></td>
                                            <td style="text-align: center;">Academic Year</td>
                                            <td style="text-align: center;">Semester</td>
                                            <td style="text-align: center;">
                                                <a class="btn btn-primary" href="viewapplication.php?applicant_id=<?php echo $rowid ?>"><i data-feather='eye'></i> View</a>
                                            </td>
                                            <td style="text-align: center;"><?php echo $row['scholarType']; ?></td>
                                            <td style="text-align: center;"><?php echo $row['status']; ?></td>

                                            <!-- COR Document -->
                                            <td style="text-align: center;">
                                                <?php 
                                                    if (!empty($row['cor_filename'])) {
                                                        echo '<a class="btn btn-info" href="downloadfile.php?title=cor&applicant_id=' . $rowid . '" download="' . $row['cor_filename'] . '">Download COR</a>';
                                                    } else {
                                                        echo '<span>No COR available</span>';
                                                    }
                                                ?>
                                            </td>

                                            <!-- ROG Document -->
                                            <td style="text-align: center;">
                                                <?php 
                                                    if (!empty($row['rog_filename'])) {
                                                        echo '<a class="btn btn-info" href="downloadfile.php?title=rog&applicant_id=' . $rowid . '" download="' . $row['rog_filename'] . '">Download ROG</a>';
                                                    } else {
                                                        echo '<span>No ROG available</span>';
                                                    }
                                                ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <button class="btn btn-info" data-toggle="modal" data-target="#createaccountmodal<?php echo $rowid; ?>">Create Account</button>
                                                <a class="btn btn-primary" href="updatescholar.php?applicant_id=<?php echo $rowid; ?>">Update</a>
                                                <button class="btn btn-secondary" onclick="archiveApplicant(<?php echo $rowid; ?>, 1)">Archive</button>
                                            </td>
                                        </tr>

                                        <!-- Modal for Creating Account -->
                                        <div class="modal fade" id="createaccountmodal<?php echo $rowid; ?>" tabindex="-1" role="dialog" aria-labelledby="createaccountModalLabel<?php echo $rowid; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="createaccountModalLabel<?php echo $rowid; ?>">Create Account for <?php echo $lname.', '.$fname; ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="POST">
                                                            <div class="form-group">
                                                                <label for="email">Email</label>
                                                                <input type="email" name="email" class="form-control" value="<?php echo $emailadd; ?>"  />
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="password">Password</label>
                                                                <?php $password = generateRandomPassword(); ?>
                                                                <input type="password" name="password" class="form-control" id="generatedPassword<?php echo $rowid; ?>" value="<?php echo $password; ?>" readonly />
                                                                <small id="passwordHelp<?php echo $rowid; ?>" class="form-text text-muted">Password - <?php echo $password; ?></small>
                                                            </div>
                                                            <input type="hidden" name="applicantID" value="<?php echo $rowid; ?>">
                                                            <input type="hidden" name="application_id" value="<?php echo $rowid; ?>"> <!-- Application ID as FK -->
                                                            <button type="submit" class="btn btn-primary">Create Account</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php } ?>
                                    </tbody>
                                </table>
                                </div>
                                </div>

                                <!-- Uneligible Tab -->
                                <div class="tab-pane fade" id="uneligible" role="tabpanel" aria-labelledby="uneligible-tab">
                                    <table class="table p-2" id="filterTableUneligible">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Name</th>
                                                <th style="text-align: center;">Status</th>
                                                <th style="text-align: center;">Phone Number</th>
                                                <th style="text-align: center;">Email Address</th>
                                                <th style="text-align: center;">Notify</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Fetch uneligible applicants
                                            $qry = "SELECT * from applicants"; 
                                            $ses_sql = mysqli_query($con, $qry);
                                            while ($row = mysqli_fetch_array($ses_sql)) {
                                                $fname = $row['first_name'];
                                                $lname = $row['last_name'];
                                                $phone_number = $row['contact_number'];
                                                $email = $row['email'];
                                                $rowid = $row['id'];
                                            ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo $lname.', '.$fname;?></td>
                                                <td style="text-align: center;"><?php echo $row['status'];?></td>
                                                <td style="text-align: center;"><?php echo $phone_number;?></td>
                                                <td style="text-align: center;"><?php echo $email;?></td>
                                                <td style="text-align: center;">
                                                    <button class="btn btn-warning" onclick="archiveApplicant(<?php echo $rowid; ?>, 1)">Archive</button>
                                                       <button class="btn btn-danger" onclick="confirmDelete(<?php echo $rowid; ?>)">Delete</button>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Archive Tab -->
                                <div class="tab-pane fade" id="archive" role="tabpanel" aria-labelledby="archive-tab">
                                    <table class="table p-2" id="filterTableArchive">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Name</th>
                                                <th style="text-align: center;">Status</th>
                                                <th style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Fetch archived applicants
                                            $qry = "SELECT * from applicants WHERE isArchive = '1'"; 
                                            $ses_sql = mysqli_query($con, $qry);
                                            while ($row = mysqli_fetch_array($ses_sql)) {
                                                $fname = $row['first_name'];
                                                $lname = $row['last_name'];
                                                $rowid = $row['id'];
                                            ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo $lname.', '.$fname;?></td>
                                                <td style="text-align: center;"><?php echo $row['status'];?></td>
                                                <td style="text-align: center;">
                                                    <button class="btn btn-warning"onclick="archiveApplicant(<?php echo $rowid; ?>, 0)">Restore</button>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>


<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="js/app.js"></script>
<script>
    $(document).ready(function () {
        $("#filterTable").DataTable({
            responsive: true
        });
        $("#filterTableEligible").DataTable({
            responsive: true
        });
        $("#filterTableUneligible").DataTable({
            responsive: true
        });
        $("#filterTableArchive").DataTable({
            responsive: true 
        });
    });
</script>


<script>
    function archiveApplicant(applicantId, status) {
        var action = (status == 1) ? "archive" : "restore";
        if (confirm("Are you sure you want to " + action + " this applicant?")) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "archiveApplicant.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    if (xhr.responseText === 'success') {
                        window.location.href = "record.php"; // Refresh the page
                    } else {
                        alert("Failed to update applicant status.");
                    }
                }
            };
            xhr.send("applicant_id=" + applicantId + "&status=" + status);
        }
    }
    function confirmDelete(id) {
    if (confirm("Are you sure you want to delete this applicant permanently?")) {
        window.location.href = "delete_applicant.php?id=" + id;
    }
}
</script>
