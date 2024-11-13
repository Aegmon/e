<?php
include("sidebar.php"); // Include the sidebar (which has the $con connection)


?>

<div class="main">
    <nav class="navbar navbar-expand navbar-light navbar-bg">
        <a class="sidebar-toggle js-sidebar-toggle">
            <i class="hamburger align-self-center"></i>
        </a>
    </nav>

    <main class="content" >
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                    <div class="card flex-fill p-2">
                        <div class="card-header">
                            <!-- Nav tabs for Eligible and Uneligible -->
                            <ul class="nav nav-tabs" id="eligibilityTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="eligible-tab" data-bs-toggle="tab" href="#eligible" role="tab" aria-controls="eligible" aria-selected="true">Eligible</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="uneligible-tab" data-bs-toggle="tab" href="#uneligible" role="tab" aria-controls="uneligible" aria-selected="false">Ineligible</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <!-- Tab content -->
                            <div class="tab-content" id="eligibilityTabsContent">
                                <!-- Eligible Tab -->
                                <div class="tab-pane fade show active" id="eligible" role="tabpanel" aria-labelledby="eligible-tab">
                        <table class="table p-2" id="filterTableEligible">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Name</th>
                                        <th style="text-align: center;">Grade</th>
                                        <th style="text-align: center;">Grade Assessment</th>
                                        <th style="text-align: center;">Application Form</th>
                                        <th style="text-align: center;">Phone Number</th>
                                        <th style="text-align: center;">Email Address</th>
                                        <th style="text-align: center;">Interview</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $qry = "SELECT * FROM applicants WHERE status = 'eligible'";
                                    $ses_sql = mysqli_query($con, $qry);
                                    while ($row = mysqli_fetch_array($ses_sql)) {
                                        $fname = $row['first_name'];
                                        $lname = $row['last_name'];
                                        $grade = $row['gen_average'];
                                        $gradeAssement = $row['scholarType'];
                                        $phone_number = $row['contact_number'];
                                        $email = $row['email'];
                                        $rowid = $row['id'];
                                    ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $lname . ', ' . $fname; ?></td>
                                        <td style="text-align: center;"><?php echo $grade; ?></td>
                                        <td style="text-align: center;"><?php echo $gradeAssement; ?></td>
                                        <td style="text-align: center;">
                                            <a class="btn btn-primary" href="viewapplication.php?applicant_id=<?php echo $rowid; ?>"><i data-feather='eye'></i> View</a>
                                        </td>
                                        <td style="text-align: center;"><?php echo $phone_number; ?></td>
                                        <td style="text-align: center;"><?php echo $email; ?></td>
                                        <td style="text-align: center;">
                                            <button class="btn btn-info" data-toggle="modal" data-target="#interviewModal<?php echo $rowid; ?>" onclick="prepareModal('<?php echo $phone_number; ?>', '<?php echo $email; ?>')">Interview</button>
                                            <a class="btn btn-primary" href="casestudy.php?applicant_id=<?php echo $rowid; ?>">Case Study Report</a>
                                        </td>
                                    </tr>

                                    <!-- Modal for Interview -->
                                    <div class="modal fade" id="interviewModal<?php echo $rowid; ?>" tabindex="-1" role="dialog" aria-labelledby="interviewModalLabel<?php echo $rowid; ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="interviewModalLabel<?php echo $rowid; ?>">Send Schedule</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="sendInterviewForm<?php echo $rowid; ?>" method="POST">
                                                        <div class="form-group">
                                                            <textarea id="interviewMessage<?php echo $rowid; ?>" name="interview" class="form-control" placeholder="Enter your message" rows="5" autocomplete="off"></textarea>
                                                        </div>
                                                        <input type="hidden" name="applicantID" value="<?php echo $rowid; ?>">
                                                        <button type="button" class="btn btn-primary" onclick="sendInterview(<?php echo $rowid; ?>)">Send</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </tbody>
                            </table>

                                </div>

                                <!-- Uneligible Tab -->
                                <div class="tab-pane fade" id="uneligible" role="tabpanel" aria-labelledby="uneligible-tab">
                                    <table class="table p-2" id="filterTableUneligible">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Name</th>
                                                <th style="text-align: center;">Grade</th>
                                                  <th style="text-align: center;">Grade Assesment</th>
                                                <th style="text-align: center;">Application Form</th>
                                                <th style="text-align: center;">Phone Number</th>
                                                <th style="text-align: center;">Email Address</th>
                                                <th style="text-align: center;">Notify</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Fetch uneligible applicants
                                            $qry = "SELECT * from applicants WHERE status = 'ineligible'"; 
                                            $ses_sql = mysqli_query($con, $qry);
                                            while ($row = mysqli_fetch_array($ses_sql)) {
                                                $fname = $row['first_name'];
                                                $lname = $row['last_name'];
                                                $grade = $row['gen_average'];
                                                            $gradeAssement = $row['scholarType'];
                                                $phone_number = $row['contact_number'];
                                                $email = $row['email'];
                                                $rowid = $row['id'];
                                            ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo $lname.', '.$fname;?></td>
                                                <td style="text-align: center;"><?php echo $grade;?></td>
                                                                 <td style="text-align: center;"><?php echo $gradeAssement;?></td>
                                                <td style="text-align: center;">
                                                    <a class="btn btn-primary" href="viewapplication.php?applicant_id=<?php echo $rowid ?>"><i data-feather='eye'></i> View</a>
                                                </td>
                                                <td style="text-align: center;"><?php echo $phone_number;?></td>
                                                <td style="text-align: center;"><?php echo $email;?></td>
                                                <td style="text-align: center;">
                                                    <button class="btn btn-info" data-toggle="modal" data-target="#notifyModal<?php echo $rowid; ?>">Notify</button>
                                                </td>
                                            </tr>

                                            <!-- Modal for Interview -->
                                            <div class="modal fade" id="notifyModal<?php echo $rowid; ?>" tabindex="-1" role="dialog" aria-labelledby="interviewModalLabel<?php echo $rowid; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="interviewModalLabel<?php echo $rowid; ?>">Send Notification</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="POST">
                                                            <div class="form-group">
                                                                <textarea id="notifyMessage<?php echo $rowid; ?>" name="notifyMessage" class="form-control" placeholder="Enter your message" rows="5" autocomplete="off"></textarea>
                                                            </div>
                                                            <input type="hidden" name="applicantID" value="<?php echo $rowid; ?>">
                                                            <button type="button" class="btn btn-primary" onclick="sendNotify(<?php echo $rowid; ?>)">Send Notification</button>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="js/app.js"></script>
<script>
    $(document).ready(function () {
        $("#filterTable").DataTable();
        $("#filterTableEligible").DataTable();
        $("#filterTableUneligible").DataTable();
    });
</script>
<script>
function prepareModal(phoneNumber, email) {
    window.currentPhoneNumber = phoneNumber;
    window.currentEmail = email;
}

function sendInterview(applicantID) {
    const message = document.getElementById(`interviewMessage${applicantID}`).value;
  
    // Send SMS using WebSocket
    const wsUri = 'wss://s13725.blr1.piesocket.com/v3/1?api_key=IvajwGz8nKCknp5crVplZMbrq9F8DrdSMegwGdEq&notify_self=1';
    const websocket = new WebSocket(wsUri);
    websocket.onopen = function() {
        const data = JSON.stringify({
            receiver: window.currentPhoneNumber,
            message: message 
        });
        websocket.send(data);
    };
    websocket.onclose = function() {
        alert('SMS sent successfully.');
    };

    // Send Email via AJAX to server-side PHP script
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "sendEmail.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert('Email sent successfully.');
        }
    };
    xhr.send(`email=${window.currentEmail}&message=${encodeURIComponent(message)}&otp=${otp}`);
}

function sendNotify(applicantID) {
    const message = document.getElementById(`notifyMessage${applicantID}`).value;

    // Send SMS using WebSocket
    const wsUri = 'wss://s13725.blr1.piesocket.com/v3/1?api_key=IvajwGz8nKCknp5crVplZMbrq9F8DrdSMegwGdEq&notify_self=1';
    const websocket = new WebSocket(wsUri);
    
    websocket.onopen = function() {
        const data = JSON.stringify({
            receiver: window.currentPhoneNumber,
            message: message 
        });
        websocket.send(data);
    };
    
    websocket.onclose = function() {
        alert('SMS sent successfully.');
    };

    // Send Email via AJAX to server-side PHP script
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "sendNotify.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert('Email sent successfully.');
        }
    };
    xhr.send(`email=${window.currentEmail}&message=${encodeURIComponent(message)}`);
}
</script>