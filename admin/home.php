<?php
include("sidebar.php"); // Include the sidebar (which has the $con connection)

// Fetch counts from the database for each category
$eligibleCount = getCount('Eligible');  
$ineligibleCount = getCount('Not Eligible'); 
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
               <h2 class="mb-3">
        <?php
        // Set the default timezone to Asia/Manila
        date_default_timezone_set("Asia/Manila");

        // Format the date and time
        echo date("M j Y g:ia"); // Example: Sept 23 2024 2:00am
        ?>
    </h2>
              <div class="row">
                <!-- Display Cards for each count -->
                 <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Applicants</h5>
                            <h1><?php echo $totalApplicantsCount; ?></h1>
                        </div>
                    </div>
                </div>
               <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Scholars </h5>
                            <h1><?php echo $totalScholarsCount; ?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                 <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">Number of Applicants' Status</div>
                        <div class="card-body">
                            <canvas id="doughnutChart"></canvas>
                        </div>
                    </div>
                </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">Number of Schlarship Type</div>
                        <div class="card-body">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Announcement Section -->
     <div class="container-fluid p-0">
    <div class="card">
        <div class="card-header">
            <h4>Create Announcement</h4>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
                       <div class="mb-3">
                    <label for="subject" class="form-label">Content</label>
             <textarea class="form-control" id="content" name="content"></textarea>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
                <button type="submit"  class="btn btn-primary">Create Announcement</button>
            </form>
        </div>
    </div>

    <div class="container-fluid p-0">
    <div class="card">
        <div class="card-header">
            <h4>Announcements</h4>
        </div>
        <div class="card-body">
            <!-- Add the responsive table wrapper -->
            <div class="table-responsive">
                <table id="announcementTable" class="table table-bordered display responsive nowrap">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Content</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = mysqli_query($con, "SELECT * FROM announcements ORDER BY date DESC");
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['subject']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                            echo "<td><div class='content-wrapper'>" . htmlspecialchars($row['content']) . "</div></td>";
                            echo "<td>";
                            if ($row['image']) {
                                echo "<img src='../uploads/" . htmlspecialchars($row['image']) . "' alt='Announcement Image' width='100'>";
                            } else {
                                echo "No Image";
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
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
    $('#announcementTable').DataTable({
        responsive: true
    });
    
    // Doughnut chart
    new Chart(document.getElementById("doughnutChart"), {
        type: "doughnut",
        data: {
            labels: ["Eligible", "Ineligible"],
            datasets: [{
                data: [
                    <?php echo $eligibleCount; ?>,
                    <?php echo $ineligibleCount; ?>
                ],
                backgroundColor: ["#007bff", "#dc3545"],
                borderColor: "transparent"
            }]
        },
        options: {
            cutoutPercentage: 65,
            responsive: true,
            maintainAspectRatio: false,
            legend: { display: true }
        }
    });

    // Bar chart
new Chart(document.getElementById("barChart"), {
    type: "bar",
    data: {
        labels: ["Full Scholar", "Grant Level 1", "Grant Level 2"],
        datasets: [{
            label: "Scholarship Levels",
            data: [
                parseInt(<?php echo (int)$fullScholarCount; ?>, 10),
                parseInt(<?php echo (int)$grantLevel1Count; ?>, 10),
                parseInt(<?php echo (int)$grantLevel2Count; ?>, 10)
            ],
            backgroundColor: ["#007bff", "#ffc107", "#dc3545"],
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
                    beginAtZero: true, // Ensure the chart starts at 0
                    stepSize: 1 // Force the steps to increments of 1
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
