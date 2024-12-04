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

    
    // Check if email already exists
    $check_email_query = "SELECT * FROM scholaraccount WHERE email = '$email'";
    $check_result = mysqli_query($con, $check_email_query);

    if (mysqli_num_rows($check_result) > 0) {
        // If email exists, show alert and stop further execution
        echo "<script type='text/javascript'>
                alert('Email already exists. Please use a different email.');
           window.location.href = 'record.php'; 
              </script>";
    } else {
        // If email does not exist, hash the password and insert the data
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


}
$addressQry = "SELECT DISTINCT home_address FROM applicants ";
$addressSql = mysqli_query($con, $addressQry);
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
                         
                            <ul class="nav nav-tabs" id="eligibilityTabs" role="tablist">
                                  <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="full-scholarship-tab" data-bs-toggle="tab" href="#full-scholarship" role="tab" aria-controls="full-scholarship" aria-selected="true">Full Scholarship</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="granted-level-1-tab" data-bs-toggle="tab" href="#granted-level-1" role="tab" aria-controls="granted-level-1" aria-selected="false">Granted Level 1</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="granted-level-2-tab" data-bs-toggle="tab" href="#granted-level-2" role="tab" aria-controls="granted-level-2" aria-selected="false">Granted Level 2</a>
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
                          <div class="tab-content" id="fullscholarContent">
                            <!-- Full Scholarship Tab -->
                            <div class="tab-pane fade show active" id="full-scholarship" role="tabpanel" aria-labelledby="full-scholarship-tab">
                                <div class="table-responsive">
                                     <label for="homeAddressFilter">Select Barangay:</label>
                                     <select id="homeAddressFilter" style="width: 200px;">
                                            <option value="">All</option>
                                            <?php
                                            // Fetch distinct home addresses from the database
                                            $addressQry = "SELECT DISTINCT home_address FROM applicants";
                                            $addressSql = mysqli_query($con, $addressQry);
                                            while ($row = mysqli_fetch_array($addressSql)) {
                                            ?>
                                                <option value="<?php echo $row['home_address']; ?>"><?php echo $row['home_address']; ?></option>
                                            <?php } ?>
                                        </select>
                              <table class="table p-2" id="filterTableFullScholarship">
    <thead>
        <tr>
            <th style="text-align: center;">Name</th>
            <th style="text-align: center;">Academic Year</th>
            <th style="text-align: center;">Course</th>
            <th style="text-align: center;">Application Form</th>
            <th style="text-align: center;">Barangay</th>
            <th style="text-align: center;">Payout Status</th>
            <th style="text-align: center;">Scholarship Type</th>
            <th style="text-align: center;">Scholarship Status</th>
            <th style="text-align: center;">COR</th>
            <th style="text-align: center;">ROG</th>
            <th style="text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $qry = "SELECT * FROM applicants WHERE isArchive = '0' AND status IN ('New', 'Retained', 'Promoted', 'Demoted', 'Granted') AND scholarType = 'Full Scholarship'";
        $ses_sql = mysqli_query($con, $qry);

        while ($row = mysqli_fetch_array($ses_sql)) {
            $fname = $row['first_name'];
            $lname = $row['last_name'];
            $rowid = $row['id'];
            $emailadd = $row['email'];
            $payoutStatus = $row['payout'];
        ?>
        <tr>
            <td style="text-align: center;"><?php echo $lname . ', ' . $fname; ?></td>
            <td style="text-align: center;"><?php echo $row['year_level']; ?></td>
            <td style="text-align: center;"><?php echo $row['year_course']; ?></td>
            <td style="text-align: center;">
                <a class="btn btn-primary" href="viewapplication.php?applicant_id=<?php echo $rowid; ?>"><i data-feather='eye'></i> View</a>
            </td>
            <td style="text-align: center;"><?php echo $row['home_address']; ?></td>
            <td style="text-align: center;">
                <?php if ($payoutStatus == "Not yet Received") { ?>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#payoutModal<?php echo $rowid; ?>">Mark Payout</button>
                <?php } else { ?>
                    <span><?php echo $payoutStatus; ?></span>
                <?php } ?>
            </td>
            <td style="text-align: center;"><?php echo $row['scholarType']; ?></td>
            <td style="text-align: center;"><?php echo $row['status']; ?></td>
            <td style="text-align: center;">
                <a class="btn btn-info" href="cor.php?applicant_id=<?php echo $rowid; ?>">COR</a>
            </td>
            <td style="text-align: center;">
                <a class="btn btn-info" href="rog.php?applicant_id=<?php echo $rowid; ?>">ROG</a>
            </td>
            <td style="text-align: center;">
                <button class="btn btn-info" data-toggle="modal" data-target="#createaccountmodal<?php echo $rowid; ?>">Create Account</button>
                <button class="btn btn-secondary" onclick="archiveApplicant(<?php echo $rowid; ?>, 1)">Archive</button>
            </td>
        </tr>

        <!-- Modal for Marking Payout -->
        <div class="modal fade" id="payoutModal<?php echo $rowid; ?>" tabindex="-1" role="dialog" aria-labelledby="payoutModalLabel<?php echo $rowid; ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="payoutModalLabel<?php echo $rowid; ?>">Mark Payout Status as:</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="update_payout_status.php" method="POST">
                            <input type="hidden" name="applicantID" value="<?php echo $rowid; ?>">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payoutStatus" id="received<?php echo $rowid; ?>" value="Received">
                                <label class="form-check-label" for="received<?php echo $rowid; ?>">Received</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payoutStatus" id="notReceived<?php echo $rowid; ?>" value="Not yet Received" checked>
                                <label class="form-check-label" for="notReceived<?php echo $rowid; ?>">Not yet Received</label>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Update Status</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Creating Account -->
        <div class="modal fade" id="createaccountmodal<?php echo $rowid; ?>" tabindex="-1" role="dialog" aria-labelledby="createaccountModalLabel<?php echo $rowid; ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createaccountModalLabel<?php echo $rowid; ?>">Create Account for <?php echo $lname . ', ' . $fname; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $emailadd; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <?php $password = generateRandomPassword(); ?>
                                <input type="password" name="password" class="form-control" id="generatedPassword<?php echo $rowid; ?>" value="<?php echo $password; ?>" readonly />
                                <small id="passwordHelp<?php echo $rowid; ?>" class="form-text text-muted">Password - <?php echo $password; ?></small>
                            </div>
                            <input type="hidden" name="applicantID" value="<?php echo $rowid; ?>">
                            <input type="hidden" name="application_id" value="<?php echo $rowid; ?>">
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
                    
                                  
                             <div class="tab-pane fade" id="granted-level-1" role="tabpanel" aria-labelledby="granted-level-1-tab">
                                <div class="table-responsive">
                                     <label for="homeAddressFilter">Select Barangay:</label>
                                     <select id="homeAddressFilter" style="width: 200px;">
                                            <option value="">All</option>
                                            <?php
                                            // Fetch distinct home addresses from the database
                                            $addressQry = "SELECT DISTINCT home_address FROM applicants ";
                                            $addressSql = mysqli_query($con, $addressQry);
                                            while ($row = mysqli_fetch_array($addressSql)) {
                                            ?>
                                                <option value="<?php echo $row['home_address']; ?>"><?php echo $row['home_address']; ?></option>
                                            <?php } ?>
                                        </select>
                               <table class="table p-2" id="filterTableGrantedLevel1">
                                        
                                <thead>
        <tr>
            <th style="text-align: center;">Name</th>
            <th style="text-align: center;">Academic Year</th>
            <th style="text-align: center;">Course</th>
            <th style="text-align: center;">Application Form</th>
            <th style="text-align: center;">Barangay</th>
            <th style="text-align: center;">Payout Status</th>
            <th style="text-align: center;">Scholarship Type</th>
            <th style="text-align: center;">Scholarship Status</th>
            <th style="text-align: center;">COR</th>
            <th style="text-align: center;">ROG</th>
            <th style="text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $qry = "SELECT * FROM applicants WHERE isArchive = '0' AND status IN ('New', 'Retained', 'Promoted', 'Demoted', 'Granted') AND scholarType = 'Grant Level 1'";
        $ses_sql = mysqli_query($con, $qry);

        while ($row = mysqli_fetch_array($ses_sql)) {
            $fname = $row['first_name'];
            $lname = $row['last_name'];
            $rowid = $row['id'];
            $emailadd = $row['email'];
            $payoutStatus = $row['payout'];
        ?>
        <tr>
            <td style="text-align: center;"><?php echo $lname . ', ' . $fname; ?></td>
            <td style="text-align: center;"><?php echo $row['year_level']; ?></td>
            <td style="text-align: center;"><?php echo $row['year_course']; ?></td>
            <td style="text-align: center;">
                <a class="btn btn-primary" href="viewapplication.php?applicant_id=<?php echo $rowid; ?>"><i data-feather='eye'></i> View</a>
            </td>
            <td style="text-align: center;"><?php echo $row['home_address']; ?></td>
            <td style="text-align: center;">
                <?php if ($payoutStatus == "Not yet Received") { ?>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#payoutModal<?php echo $rowid; ?>">Mark Payout</button>
                <?php } else { ?>
                    <span><?php echo $payoutStatus; ?></span>
                <?php } ?>
            </td>
            <td style="text-align: center;"><?php echo $row['scholarType']; ?></td>
            <td style="text-align: center;"><?php echo $row['status']; ?></td>
            <td style="text-align: center;">
                <a class="btn btn-info" href="cor.php?applicant_id=<?php echo $rowid; ?>">COR</a>
            </td>
            <td style="text-align: center;">
                <a class="btn btn-info" href="rog.php?applicant_id=<?php echo $rowid; ?>">ROG</a>
            </td>
            <td style="text-align: center;">
                <button class="btn btn-info" data-toggle="modal" data-target="#createaccountmodal<?php echo $rowid; ?>">Create Account</button>
                <button class="btn btn-secondary" onclick="archiveApplicant(<?php echo $rowid; ?>, 1)">Archive</button>
            </td>
        </tr>

        <!-- Modal for Marking Payout -->
        <div class="modal fade" id="payoutModal<?php echo $rowid; ?>" tabindex="-1" role="dialog" aria-labelledby="payoutModalLabel<?php echo $rowid; ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="payoutModalLabel<?php echo $rowid; ?>">Mark Payout Status as:</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="update_payout_status.php" method="POST">
                            <input type="hidden" name="applicantID" value="<?php echo $rowid; ?>">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payoutStatus" id="received<?php echo $rowid; ?>" value="Received">
                                <label class="form-check-label" for="received<?php echo $rowid; ?>">Received</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payoutStatus" id="notReceived<?php echo $rowid; ?>" value="Not yet Received" checked>
                                <label class="form-check-label" for="notReceived<?php echo $rowid; ?>">Not yet Received</label>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Update Status</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Creating Account -->
        <div class="modal fade" id="createaccountmodal<?php echo $rowid; ?>" tabindex="-1" role="dialog" aria-labelledby="createaccountModalLabel<?php echo $rowid; ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createaccountModalLabel<?php echo $rowid; ?>">Create Account for <?php echo $lname . ', ' . $fname; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $emailadd; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <?php $password = generateRandomPassword(); ?>
                                <input type="password" name="password" class="form-control" id="generatedPassword<?php echo $rowid; ?>" value="<?php echo $password; ?>" readonly />
                                <small id="passwordHelp<?php echo $rowid; ?>" class="form-text text-muted">Password - <?php echo $password; ?></small>
                            </div>
                            <input type="hidden" name="applicantID" value="<?php echo $rowid; ?>">
                            <input type="hidden" name="application_id" value="<?php echo $rowid; ?>">
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







                                  <div class="tab-pane fade" id="granted-level-2" role="tabpanel" aria-labelledby="granted-level-2-tab">
                                <div class="table-responsive">
                                     <label for="homeAddressFilter">Select Barangay:</label>
                                     <select id="homeAddressFilter" style="width: 200px;">
                                            <option value="">All</option>
                                            <?php
                                            // Fetch distinct home addresses from the database
                                            $addressQry = "SELECT DISTINCT home_address FROM applicants ";
                                            $addressSql = mysqli_query($con, $addressQry);
                                            while ($row = mysqli_fetch_array($addressSql)) {
                                            ?>
                                                <option value="<?php echo $row['home_address']; ?>"><?php echo $row['home_address']; ?></option>
                                            <?php } ?>
                                        </select>
                               <table class="table p-2" id="filterTableGrantedLevel2">
                                        
                                   <thead>
        <tr>
            <th style="text-align: center;">Name</th>
            <th style="text-align: center;">Academic Year</th>
            <th style="text-align: center;">Course</th>
            <th style="text-align: center;">Application Form</th>
            <th style="text-align: center;">Barangay</th>
            <th style="text-align: center;">Payout Status</th>
            <th style="text-align: center;">Scholarship Type</th>
            <th style="text-align: center;">Scholarship Status</th>
            <th style="text-align: center;">COR</th>
            <th style="text-align: center;">ROG</th>
            <th style="text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $qry = "SELECT * FROM applicants WHERE isArchive = '0' AND status IN ('New', 'Retained', 'Promoted', 'Demoted', 'Granted') AND scholarType = 'Grant Level 2'";
        $ses_sql = mysqli_query($con, $qry);

        while ($row = mysqli_fetch_array($ses_sql)) {
            $fname = $row['first_name'];
            $lname = $row['last_name'];
            $rowid = $row['id'];
            $emailadd = $row['email'];
            $payoutStatus = $row['payout'];
        ?>
        <tr>
            <td style="text-align: center;"><?php echo $lname . ', ' . $fname; ?></td>
            <td style="text-align: center;"><?php echo $row['year_level']; ?></td>
            <td style="text-align: center;"><?php echo $row['year_course']; ?></td>
            <td style="text-align: center;">
                <a class="btn btn-primary" href="viewapplication.php?applicant_id=<?php echo $rowid; ?>"><i data-feather='eye'></i> View</a>
            </td>
            <td style="text-align: center;"><?php echo $row['home_address']; ?></td>
            <td style="text-align: center;">
                <?php if ($payoutStatus == "Not yet Received") { ?>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#payoutModal<?php echo $rowid; ?>">Mark Payout</button>
                <?php } else { ?>
                    <span><?php echo $payoutStatus; ?></span>
                <?php } ?>
            </td>
            <td style="text-align: center;"><?php echo $row['scholarType']; ?></td>
            <td style="text-align: center;"><?php echo $row['status']; ?></td>
            <td style="text-align: center;">
                <a class="btn btn-info" href="cor.php?applicant_id=<?php echo $rowid; ?>">COR</a>
            </td>
            <td style="text-align: center;">
                <a class="btn btn-info" href="rog.php?applicant_id=<?php echo $rowid; ?>">ROG</a>
            </td>
            <td style="text-align: center;">
                <button class="btn btn-info" data-toggle="modal" data-target="#createaccountmodal<?php echo $rowid; ?>">Create Account</button>
                <button class="btn btn-secondary" onclick="archiveApplicant(<?php echo $rowid; ?>, 1)">Archive</button>
            </td>
        </tr>

        <!-- Modal for Marking Payout -->
        <div class="modal fade" id="payoutModal<?php echo $rowid; ?>" tabindex="-1" role="dialog" aria-labelledby="payoutModalLabel<?php echo $rowid; ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="payoutModalLabel<?php echo $rowid; ?>">Mark Payout Status as:</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="update_payout_status.php" method="POST">
                            <input type="hidden" name="applicantID" value="<?php echo $rowid; ?>">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payoutStatus" id="received<?php echo $rowid; ?>" value="Received">
                                <label class="form-check-label" for="received<?php echo $rowid; ?>">Received</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payoutStatus" id="notReceived<?php echo $rowid; ?>" value="Not yet Received" checked>
                                <label class="form-check-label" for="notReceived<?php echo $rowid; ?>">Not yet Received</label>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Update Status</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Creating Account -->
        <div class="modal fade" id="createaccountmodal<?php echo $rowid; ?>" tabindex="-1" role="dialog" aria-labelledby="createaccountModalLabel<?php echo $rowid; ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createaccountModalLabel<?php echo $rowid; ?>">Create Account for <?php echo $lname . ', ' . $fname; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $emailadd; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <?php $password = generateRandomPassword(); ?>
                                <input type="password" name="password" class="form-control" id="generatedPassword<?php echo $rowid; ?>" value="<?php echo $password; ?>" readonly />
                                <small id="passwordHelp<?php echo $rowid; ?>" class="form-text text-muted">Password - <?php echo $password; ?></small>
                            </div>
                            <input type="hidden" name="applicantID" value="<?php echo $rowid; ?>">
                            <input type="hidden" name="application_id" value="<?php echo $rowid; ?>">
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
                                            $qry = "SELECT * from scholaraccount sa
                                            JOIN applicants a ON sa.application_id = a.id"; 
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
                                                    <!-- <button class="btn btn-warning" onclick="archiveApplicant(<?php echo $rowid; ?>, 1)">Archive</button> -->
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
            $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {
        className: 'btn btn-primary' // Bootstrap primary button class
    });
        $("#filterTable").DataTable({
            responsive: true
        });
     
            $("#filterTableFullScholarship").dataTable({
		dom: 'Bfrtip',
		buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],
        "searching": true
      });

          $("#filterTableGrantedLevel1").dataTable({
		dom: 'Bfrtip',
		buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],
        "searching": true
      });
     $("#filterTableGrantedLevel2").dataTable({
		dom: 'Bfrtip',
		buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],
        "searching": true
      });
        
        $("#filterTableUneligible").DataTable({
            responsive: true
        });
        $("#filterTableArchive").DataTable({
            responsive: true 
        });

            $('#homeAddressFilter').on('change', function() {
            var selectedAddress = this.value;
            table.columns(4).search(selectedAddress).draw();
        });
    });
</script>

<script>
function archiveApplicant(applicantId, status) {
    // Create the modal dynamically
    const modalId = `archiveModal${applicantId}`;
    const modalHTML = `
        <div class="modal fade" id="${modalId}" tabindex="-1" role="dialog" aria-labelledby="archiveModalLabel${applicantId}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="archiveModalLabel${applicantId}">Reason to archive the scholars</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="archiveForm${applicantId}">
                            <input type="hidden" name="applicant_id" value="${applicantId}">
                            <input type="hidden" name="status" value="${status}">
                            <div class="form-group">
                                <label>Reason:</label><br>
                                <input type="radio" name="reason" value="Demoted" required> Demoted<br>
                                <input type="radio" name="reason" value="Graduate" required> Graduate
                            </div>
                            <button type="button" class="btn btn-primary" onclick="submitArchive(${applicantId})">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    `;

    // Append the modal to the body
    document.body.insertAdjacentHTML('beforeend', modalHTML);

    // Show the modal
    $(`#${modalId}`).modal('show');
}

function submitArchive(applicantId) {
    const form = document.getElementById(`archiveForm${applicantId}`);
    const formData = new FormData(form);

    // AJAX request to send data
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "archiveApplicant.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            if (xhr.responseText === 'success') {
                window.location.href = "record.php"; // Refresh the page
            } else {
                alert("Failed to archive applicant.");
            }

            // Remove the modal from DOM
            const modal = document.getElementById(`archiveModal${applicantId}`);
            if (modal) {
                modal.parentNode.removeChild(modal);
            }
        }
    };

    // Convert FormData to URL-encoded string
    const urlEncodedData = new URLSearchParams(formData).toString();
    xhr.send(urlEncodedData);
}

</script>

<script>
  
    function confirmDelete(id) {
    if (confirm("Are you sure you want to delete this applicant permanently?")) {
        window.location.href = "delete_applicant.php?id=" + id;
    }
}
</script>
