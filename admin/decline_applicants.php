<?php
include("sidebar.php"); // Include the sidebar (which has the $con connection)

// Fetch counts from the database for each category
$eligibleCount = getCount('Declined');  
$ineligibleCount = getCount('Declined'); 
$pendingCount = getCount('New'); // Assuming Pending is a valid status
$fullScholarCount = getCountScholarType('Full Scholarship');
$grantLevel1Count = getCountScholarType('Grant Level 1');
$grantLevel2Count = getCountScholarType('Grant Level 2');
$totalApplicantsCount = getTotalApplicantsCount();
$totalScholarsCount = getCountGranted();  // Only applicants with status "Granted"

// Function to fetch total count of applicants
function getTotalApplicantsCount() {
    global $con;

    // Query for applicants who are eligible and have a scholarship other than 'No Scholarship'
    $query1 = "SELECT COUNT(*) as count 
               FROM applicants 
               WHERE (status = 'Eligible' AND scholarType != 'No Scholarship') 
                  OR scholarType != 'No Scholarship'";

    // Query for applicants who are not eligible and have 'No Scholarship'
    $query2 = "SELECT COUNT(*) as count 
               FROM applicants 
               WHERE status = 'Not Eligible' AND scholarType = 'No Scholarship'";

    // Execute the first query
    $result1 = mysqli_query($con, $query1);
    if (!$result1) {
        die("Query 1 failed: " . mysqli_error($con));
    }
    $row1 = mysqli_fetch_assoc($result1);
    $count1 = $row1['count'];

    // Execute the second query
    $result2 = mysqli_query($con, $query2);
    if (!$result2) {
        die("Query 2 failed: " . mysqli_error($con));
    }
    $row2 = mysqli_fetch_assoc($result2);
    $count2 = $row2['count'];

    // Return the total count by adding the counts from both queries
    return $count1 + $count2;
}

function getIneligibleCountPerBarangay() {
    global $con;
    $query = "SELECT home_address, COUNT(*) as count 
              FROM applicants 
              WHERE status = 'Declined' 
              GROUP BY home_address";
    $result = mysqli_query($con, $query);
    
    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    }

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = ['label' => $row['home_address'], 'count' => (int)$row['count']];
    }
    return $data;
}

function getIneligibleCountPerCourse() {
    global $con;
    $query = "SELECT year_course, COUNT(*) as count 
              FROM applicants 
              WHERE status = 'Declined' 
              GROUP BY year_course";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    }

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = ['label' => $row['year_course'], 'count' => (int)$row['count']];
    }
    return $data;
}

// Fetch ineligible counts per barangay and course
$ineligiblePerBarangay = getIneligibleCountPerBarangay();
$ineligiblePerCourse = getIneligibleCountPerCourse();
$barangayLabels = json_encode(array_column($ineligiblePerBarangay, 'label'));
$barangayCounts = json_encode(array_column($ineligiblePerBarangay, 'count'));

$courseLabels = json_encode(array_column($ineligiblePerCourse, 'label'));
$courseCounts = json_encode(array_column($ineligiblePerCourse, 'count'));
// Function to fetch count for a specific status
function getCount($status) {
    global $con; 
    $query = "SELECT COUNT(*) as count FROM applicants WHERE status = '$status'";
    $result = mysqli_query($con, $query);
    
    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    }

    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}
function getCountGranted() {
    global $con; 
    $query = "SELECT COUNT(*) as count FROM applicants WHERE status in('New','Retained','Promoted','Demoted','Granted')";
    $result = mysqli_query($con, $query);
    
    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    }

    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}
function getCountScholarType($status) {
    global $con; 
    $query = "SELECT COUNT(*) as count FROM applicants WHERE scholarType = '$status'";
    $result = mysqli_query($con, $query);
    
    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    }

    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $date = mysqli_real_escape_string($con, $_POST['date']);
        $content = mysqli_real_escape_string($con, $_POST['content']);
    $image = null;

    // Handle the file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "../uploads/";
        $image = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $image;

        // Move the uploaded file to the server
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $image = $image;
        } else {
            echo "Error uploading image.";
        }
    }

    // Insert announcement into the database
    $query = "INSERT INTO announcements (subject, date, image , content) VALUES ('$subject', '$date', '$image', '$content')";
    if (mysqli_query($con, $query)) {
        echo '<script>
 
    window.location.href = "home.php";
</script>';
    } else {
        echo "Error: " . mysqli_error($con);
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
               <h2 class="mb-3 text-center" style="font-weight:900;">
   Declined Applicants
    </h2>
              <div class="row">
                <!-- Display Cards for each count -->
                 <div class="col-md-4 col-sm-12" style="height:100%;">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total No. of Declined Applicants</h5>
                            <h1><?php echo $ineligibleCount; ?></h1>
                        </div>
                    </div>
                </div>
               <div class="col-md-4 col-sm-12">
                     <div class="card">
                        <div class="card-header">Declined Applicants per Baranggay</div>
                        <div class="card-body">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>
                   <div class="col-md-4 col-sm-12">
                     <div class="card">
                        <div class="card-header">Declined Applicants per Course</div>
                        <div class="card-body">
                            <canvas id="barChart2"></canvas>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>

 

    <div class="container-fluid p-0">
    <div class="card">
        <div class="card-header">
            <h4> List Declined Applicants</h4>
        </div>
        <div class="card-body">
            <!-- Add the responsive table wrapper -->
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
                                            <th style="text-align: center;">GWA</th>
                                            <th style="text-align: center;">Course</th>
                                            <th style="text-align: center;">Application Form</th>
                                             <th style="text-align: center;">Barangay</th>
                                              <th style="text-align: center;">Date of Application</th>
                             
                                
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                             $qry = "SELECT * from applicants WHERE status = 'Declined'"; 

                                            $ses_sql = mysqli_query($con, $qry);
                                            while ($row = mysqli_fetch_array($ses_sql)) {
                                                $fname = $row['first_name'];
                                                $lname = $row['last_name'];
                                                $rowid = $row['id'];
                                                $emailadd = $row['email'];
                                        ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $lname . ', ' . $fname; ?></td>
                                            <td style="text-align: center;"> <?php echo $row['gen_average'];?></td>
                                            <td style="text-align: center;"> <?php echo $row['year_course'];?></td>
                                            <td style="text-align: center;">
                                                <a class="btn btn-primary" href="viewapplication.php?applicant_id=<?php echo $rowid ?>"><i data-feather='eye'></i> View</a>
                                            </td>
                                            <td style="text-align: center;"><?php echo $row['home_address']; ?></td>
                                                  <td style="text-align: center;"><?php echo $row['dateCreated']; ?></td>

                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                </div>
        </div>
    </div>
</div>

</div>

    </main>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<script>
$(document).ready(function() {
    // Bar chart for Declined Applicants per Barangay
    new Chart(document.getElementById("barChart"), {
        type: "bar",
        data: {
            labels: <?php echo $barangayLabels; ?>,
            datasets: [{
                label: "Declined Applicants per Barangay",
                data: <?php echo $barangayCounts; ?>,
                backgroundColor: "#dc3545",
                borderColor: "transparent",
                barPercentage: 0.75
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: [{ stacked: false }],
                yAxes: [{
                    stacked: false,
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }]
            },
            legend: { display: true }
        }
    });

    // Bar chart for Declined Applicants per Course
    new Chart(document.getElementById("barChart2"), {
        type: "bar",
        data: {
            labels: <?php echo $courseLabels; ?>,
            datasets: [{
                label: "Declined Applicants per Course",
                data: <?php echo $courseCounts; ?>,
                backgroundColor: "#dc3545",
                borderColor: "transparent",
                barPercentage: 0.75
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: [{ stacked: false }],
                yAxes: [{
                    stacked: false,
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }]
            },
            legend: { display: true }
        }
    });
});

</script>

<script src="js/app.js"></script>
</body>
</html>
