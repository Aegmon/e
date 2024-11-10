<?php
include("sidebar.php");
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
                                            <th style="text-align: center;">Grade Assessments</th>
                                            <th style="text-align: center;">Application Form</th>
                                            <th style="text-align: center;">Phone Number</th>
                                            <th style="text-align: center;">Email Address</th>
                                            <th style="text-align: center;">Interview</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $qry = "SELECT * from scholarinfo ";  // Filter Eligible students
                                        $ses_sql = mysqli_query($con, $qry);
                                        while ($row = mysqli_fetch_array($ses_sql)) {
                                            $fname = $row['firstName'];
                                            $lname = $row['LastName'];
                                            $grade = $row['general_average'];
                                            $grade_assessments = $row['grade_assessments'];
                                            $phone_number = $row['number'];
                                            $email = $row['email'];
                                            $rowid = $row['scholarID'];
                                        ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $lname.', '.$fname;?></td>
                                            <td style="text-align: center;"><?php echo $grade;?></td>
                                            <td style="text-align: center;"><?php echo $grade_assessments;?></td>
                                            <td style="text-align: center;">
                                                <a class="btn btn-primary" href="viewscholar.php?stud_num=<?php echo $studnum ?>"><i data-feather='eye'></i> View</a>
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
                                                        <h5 class="modal-title" id="interviewModalLabel<?php echo $rowid; ?>">Schedule Interview</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="schedule_interview.php" method="POST">
                                                            <div class="form-group">
                                                                <label for="interviewDate">Interview Date</label>
                                                                <input type="date" class="form-control" id="interviewDate" name="interviewDate" required>
                                                            </div>
                                                            <input type="hidden" name="scholarID" value="<?php echo $rowid; ?>">
                                                            <button type="submit" class="btn btn-primary">Schedule Interview</button>
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
                                            <th style="text-align: center;">Grade Assessments</th>
                                            <th style="text-align: center;">Application Form</th>
                                            <th style="text-align: center;">Phone Number</th>
                                            <th style="text-align: center;">Email Address</th>
                                            <th style="text-align: center;">Interview</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $qry = "SELECT * from scholarinfo";  // Filter Uneligible students
                                        $ses_sql = mysqli_query($con, $qry);
                                        while ($row = mysqli_fetch_array($ses_sql)) {
                                            $fname = $row['firstName'];
                                            $lname = $row['LastName'];
                                            $grade = $row['general_average'];
                                            $grade_assessments = $row['grade_assessments'];
                                            $phone_number = $row['number'];
                                            $email = $row['email'];
                                            $rowid = $row['scholarID'];
                                        ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $lname.', '.$fname;?></td>
                                            <td style="text-align: center;"><?php echo $grade;?></td>
                                            <td style="text-align: center;"><?php echo $grade_assessments;?></td>
                                            <td style="text-align: center;">
                                                <a class="btn btn-primary" href="viewscholar.php?stud_num=<?php echo $studnum ?>"><i data-feather='eye'></i> View</a>
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
                                                        <h5 class="modal-title" id="interviewModalLabel<?php echo $rowid; ?>">Schedule Interview</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="schedule_interview.php" method="POST">
                                                            <div class="form-group">
                                                                <label for="interviewDate">Interview Date</label>
                                                                <input type="date" class="form-control" id="interviewDate" name="interviewDate" required>
                                                            </div>
                                                            <input type="hidden" name="scholarID" value="<?php echo $rowid; ?>">
                                                            <button type="submit" class="btn btn-primary">Schedule Interview</button>
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
        $("#filterTable").dataTable({
            "searching": true
        });
    });
</script>

</body>
</html>
