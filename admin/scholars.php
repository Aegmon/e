<?php
include("sidebar.php"); // Include the sidebar (which has the $con connection)
?>

<div class="main">
    <nav class="navbar navbar-expand navbar-light navbar-bg">
        <a class="sidebar-toggle js-sidebar-toggle">
            <i class="hamburger align-self-center"></i>
        </a>
    </nav>

    <main class="content" style="background:url('../assets/pubmatfour.png'); background-repeat: no-repeat; background-size: 100%;">
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
                                    <a class="nav-link" id="uneligible-tab" data-bs-toggle="tab" href="#uneligible" role="tab" aria-controls="uneligible" aria-selected="false">Uneligible</a>
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
