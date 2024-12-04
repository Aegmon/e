<?php
include("sidebar.php");


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
                                    <a class="nav-link active" id="eligible-tab" data-bs-toggle="tab" href="#eligible" role="tab" aria-controls="eligible" aria-selected="true">Full Scholarship</a>
                                </li>
                                    <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="grantlvl1-tab" data-bs-toggle="tab" href="#grantlvl1" role="tab" aria-controls="grantlvl1" aria-selected="true">Grant Level 1</a>
                                </li>
                                  <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="grantlvl2-tab" data-bs-toggle="tab" href="#grantlvl2" role="tab" aria-controls="grantlvl2" aria-selected="true">Grant Level 2</a>
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
                                   <div class="mb-4" style="width:50%;">
                                    <div class="input-group">
                                        <!-- Button -->
                                        <button class="btn btn-primary" type="button" id="sendInterviewBtn" onclick="sendInterview(<?php echo $rowid; ?>)">Send All Interview</button>

                                        <!-- Date Input -->
                                        <input type="date" class="form-control" id="dateInput" placeholder="Select Date" aria-label="Select Date" aria-describedby="basic-addon2">

                                        <!-- Time Input -->
                                        <input type="time" class="form-control" id="timeInput" placeholder="Select Time" aria-label="Select Time" aria-describedby="basic-addon2">
                                    </div>

                                    </div>
                                   <table class="table p-2" id="filterTableEligible">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Name</th>
                                        <th style="text-align: center;">GWA</th>
                                        <th style="text-align: center;">Barangay</th>
                               
                                        <th style="text-align: center;">Application Form</th>
                        
                                        <th style="text-align: center;">Action</th>
                                              <th style="text-align: center;">Interview Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $qry = "SELECT * 
                                        FROM applicants 
                                        WHERE (status = 'Eligible' AND scholarType = 'Full Scholarship') 
                                      
                                        ";
                                    $ses_sql = mysqli_query($con, $qry);
                                    while ($row = mysqli_fetch_array($ses_sql)) {
                                        $fname = $row['first_name'];
                                        $lname = $row['last_name'];
                                        $grade = $row['gen_average'];
                                        $gradeAssement = $row['scholarType'];
                                        $phone_number = $row['contact_number'];
                                        $email = $row['email'];
                                        $rowid = $row['id'];
                                           $barangay = $row['home_address'];
                                                $status = $row['interviewStatus'];
                                    ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $lname . ', ' . $fname; ?></td>
                                        <td style="text-align: center;"><?php echo $grade; ?></td>
                                        <td style="text-align: center;"><?php echo $barangay; ?></td>
                                        <td style="text-align: center;">
                                            <a class="btn btn-primary" href="viewapplication.php?applicant_id=<?php echo $rowid; ?>"><i data-feather='eye'></i> View</a>
                                        </td>
                            
                                        <td style="text-align: center;">
                                            <a class="btn btn-primary" href="casestudy.php?applicant_id=<?php echo $rowid; ?>">Case Study Report</a>
                                        </td>
                                           <td style="text-align: center;"><?php echo $status; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                                </div>
                                   <!-- Grant Level 1 Tab -->
                            <div class="tab-pane fade" id="grantlvl1" role="tabpanel" aria-labelledby="grantlvl1-tab">
                                <div class="mb-4" style="width:50%;">
                                    <div class="input-group">
                                        <!-- Button -->
                                        <button class="btn btn-primary" type="button" id="sendInterviewBtn" onclick="sendInterview('Grant Level 1')">Send All Interview</button>
                                        <!-- Date Input -->
                                        <input type="date" class="form-control" id="dateInput" placeholder="Select Date" aria-label="Select Date" aria-describedby="basic-addon2">
                                        <!-- Time Input -->
                                        <input type="time" class="form-control" id="timeInput" placeholder="Select Time" aria-label="Select Time" aria-describedby="basic-addon2">
                                    </div>
                                </div>
                                <table class="table p-2" id="tblgrantlvl1">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Name</th>
                                            <th style="text-align: center;">GWA</th>
                                            <th style="text-align: center;">Barangay</th>
                                            <th style="text-align: center;">Application Form</th>
                                            <th style="text-align: center;">Action</th>
                                            <th style="text-align: center;">Interview Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $qry = "SELECT * FROM applicants WHERE (status = 'Eligible' AND scholarType = 'Grant Level 1')";
                                        $ses_sql = mysqli_query($con, $qry);
                                        while ($row = mysqli_fetch_array($ses_sql)) {
                                            $fname = $row['first_name'];
                                            $lname = $row['last_name'];
                                            $grade = $row['gen_average'];
                                            $barangay = $row['home_address'];
                                            $status = $row['interviewStatus'];
                                            $rowid = $row['id'];
                                        ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo $lname . ', ' . $fname; ?></td>
                                                <td style="text-align: center;"><?php echo $grade; ?></td>
                                                <td style="text-align: center;"><?php echo $barangay; ?></td>
                                                <td style="text-align: center;">
                                                    <a class="btn btn-primary" href="viewapplication.php?applicant_id=<?php echo $rowid; ?>"><i data-feather='eye'></i> View</a>
                                                </td>
                                                <td style="text-align: center;">
                                                    <a class="btn btn-primary" href="casestudy.php?applicant_id=<?php echo $rowid; ?>">Case Study Report</a>
                                                </td>
                                                <td style="text-align: center;"><?php echo $status; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

         <div class="tab-pane fade" id="grantlvl2" role="tabpanel" aria-labelledby="grantlvl2-tab">
                <div class="mb-4" style="width:50%;">
                                    <div class="input-group">
                                        <!-- Button -->
                                        <button class="btn btn-primary" type="button" id="sendInterviewBtn" onclick="sendInterview(<?php echo $rowid; ?>)">Send All Interview</button>

                                        <!-- Date Input -->
                                        <input type="date" class="form-control" id="dateInput" placeholder="Select Date" aria-label="Select Date" aria-describedby="basic-addon2">

                                        <!-- Time Input -->
                                        <input type="time" class="form-control" id="timeInput" placeholder="Select Time" aria-label="Select Time" aria-describedby="basic-addon2">
                                    </div>

                                    </div>
                                    <table class="table p-2" id="tblgrantlvl2">
                                        <thead>
                                            <tr>
                                          <th style="text-align: center;">Name</th>
                                        <th style="text-align: center;">GWA</th>
                                        <th style="text-align: center;">Barangay</th>
                               
                                        <th style="text-align: center;">Application Form</th>
                        
                                        <th style="text-align: center;">Action</th>
                                              <th style="text-align: center;">Interview Status</th>
                                            </tr>
                                        </thead>
                                                   <tbody>
                                    <?php
                                        $qry = "SELECT * 
                                        FROM applicants 
                                            WHERE (status = 'Eligible' AND scholarType = 'Grant Level 2') 
                                      
                                        ";
                                    $ses_sql = mysqli_query($con, $qry);
                                    while ($row = mysqli_fetch_array($ses_sql)) {
                                        $fname = $row['first_name'];
                                        $lname = $row['last_name'];
                                        $grade = $row['gen_average'];
                                        $gradeAssement = $row['scholarType'];
                                        $phone_number = $row['contact_number'];
                                        $email = $row['email'];
                                        $rowid = $row['id'];
                                           $barangay = $row['home_address'];
                                                $status = $row['interviewStatus'];
                                    ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $lname . ', ' . $fname; ?></td>
                                        <td style="text-align: center;"><?php echo $grade; ?></td>
                                        <td style="text-align: center;"><?php echo $barangay; ?></td>
                                        <td style="text-align: center;">
                                            <a class="btn btn-primary" href="viewapplication.php?applicant_id=<?php echo $rowid; ?>"><i data-feather='eye'></i> View</a>
                                        </td>
                            
                                        <td style="text-align: center;">
                                            <a class="btn btn-primary" href="casestudy.php?applicant_id=<?php echo $rowid; ?>">Case Study Report</a>
                                        </td>
                                           <td style="text-align: center;"><?php echo $status; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                    </table>
                                </div>
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
                                            $qry = "SELECT * from applicants WHERE status = 'Not Eligible' AND scholarType='No Scholarship'"; 
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
                                                                <textarea id="notifyMessage<?php echo $rowid; ?>" name="notifyMessage" class="form-control" placeholder="Enter your message" rows="5" autocomplete="off">
                                                                     Dear [Applicant's Name], thank you for applying in ASEEST. After careful consideration, we regret to inform you that your application was not successful, and you are ineligible for the scholarship at this time. We appreciate your effort and encourage you to continue pursuing other opportunities to achieve your goals.


                                                                </textarea>
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
    // Apply Bootstrap classes to DataTables buttons
    $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {
        className: 'btn btn-primary' // Bootstrap primary button class
    });

    // Initialize DataTable for Eligible Table
    $("#filterTableEligible").dataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excludes the last column ("Interview")
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excludes the last column
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excludes the last column
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excludes the last column
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excludes the last column
                        }
                    }
                ]
            }
        ],
        "searching": true
    });
   $("#tblgrantlvl1").dataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excludes the last column ("Interview")
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excludes the last column
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excludes the last column
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excludes the last column
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excludes the last column
                        }
                    }
                ]
            }
        ],
        "searching": true
    });

       $("#tblgrantlvl2").dataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excludes the last column ("Interview")
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excludes the last column
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excludes the last column
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excludes the last column
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excludes the last column
                        }
                    }
                ]
            }
        ],
        "searching": true
    });
    // Initialize DataTable for Uneligible Table
    $("#filterTableUneligible").dataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excludes the last column ("Notify")
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excludes the last column
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excludes the last column
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excludes the last column
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excludes the last column
                        }
                    }
                ]
            }
        ],
        "searching": true
    });
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
            alert('Email and SMS sent successfully');
        }
    };
 xhr.send(`applicantID=${applicantID}&message=${encodeURIComponent(message)}`);
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
            alert('Email and SMS sent successfully');
        }
    };
 xhr.send(`applicantID=${applicantID}&message=${encodeURIComponent(message)}`);
}
</script>