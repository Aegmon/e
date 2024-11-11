<?php
include('session.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eligibility Assessment</title>
    <link href='https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap' rel='stylesheet'>
    <link rel="stylesheet" href="eligibility_assessment.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@40,400,0,0">
</head>

<body>
    <div class="sidebar" id="mySidebar">
        <img id="logo" src="images/website_logo.png" alt="Logo">
        <a href="dashboard.html" class="sidebar-item" id="dashboard-menu"><span class="material-symbols-rounded">grid_view</span>Dashboard</a>
        <hr>
        <a href="casestudy.html" class="sidebar-item"><span class="material-symbols-rounded">assignment_ind</span>Case Study Report</a>
        <a href="eligibility_assessment.html" class="sidebar-item"><span class="material-symbols-rounded">event_list</span>Eligibility Assessment</a>
        <a href="record_management.html" class="sidebar-item"><span class="material-symbols-rounded">folder_supervised</span>Record Management</a>
        <a href="#" class="logout" id="logoutButton"><span class="material-symbols-rounded">logout</span>Logout</a>
    </div>

    <div id="main">
        <div class="header"> 
            <button id="menuToggle" class="menu-btn" onclick="toggleSidebar()">&#9776;</button>
            <div class="header-container">
                <h1 id="eligib-text">Eligibility Assessment</h1>
                <div class="right-items">
                    <div class="profile"><span class="material-symbols-rounded">account_circle</span></div>
                    <h3 class="name" id="name">Maria Leonora Teresa</h3>
                </div>
            </div>
        </div>

        <section class="eligib_content">
            <div class="content-area">
                <div class="box-container">
                    <div class="assessment">
                          <div class="tab-content" id="eligibilityTabsContent">
                                <!-- Eligible Tab -->
                                <div class="tab-pane fade show active" id="eligible" role="tabpanel" aria-labelledby="eligible-tab">
                                    <table class="table p-2" id="filterTableEligible">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Name</th>
                                                <th style="text-align: center;">Grade</th>
                                                     <th style="text-align: center;">Grade Assesment</th>
                                                <th style="text-align: center;">Application Form</th>
                                                <th style="text-align: center;">Phone Number</th>
                                                <th style="text-align: center;">Email Address</th>
                                                <th style="text-align: center;">Interview</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Fetch eligible applicants
                                            $qry = "SELECT * from applicants WHERE status = 'eligible'"; 
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
                                                    <button class="btn btn-info" data-toggle="modal" data-target="#interviewModal<?php echo $rowid; ?>">Interview</button>
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
                                                            <form action="" method="POST">
                                                                <div class="form-group">
                                                                <textarea id="interview" name="interview" class="form-control" placeholder="Enter your message" rows="5" autocomplete="off">
                                                                    
                                                                 </textarea>
                                                                 
                                                                </div>
                                                                <input type="hidden" name="applicantID" value="<?php echo $rowid; ?>">
                                                                <button type="submit" class="btn btn-primary">Send</button>
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
                                                    <button class="btn btn-info" data-toggle="modal" data-target="#interviewModal<?php echo $rowid; ?>">Notify</button>
                                                </td>
                                            </tr>

                                            <!-- Modal for Interview -->
                                            <div class="modal fade" id="interviewModal<?php echo $rowid; ?>" tabindex="-1" role="dialog" aria-labelledby="interviewModalLabel<?php echo $rowid; ?>" aria-hidden="true">
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
                                                                <textarea id="interview" name="interview" class="form-control" placeholder="Enter your message" rows="5" autocomplete="off">
                                                                    
                                                                 </textarea>
                                                                 
                                                                </div>
                                                                <input type="hidden" name="applicantID" value="<?php echo $rowid; ?>">
                                                                <button type="submit" class="btn btn-primary">Send</button>
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
        </section>

    </div>

    <script src="eligibility_assessment.js"></script>
</body>
</html>
