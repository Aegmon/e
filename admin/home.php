<?php
include("sidebar.php"); // Include the sidebar (which has the $con connection)

// Fetch counts from the database for each category
$eligibleCount = getCount('Eligible');  
$ineligibleCount = getCount('Ineligible'); 
$pendingCount = getCount('Pending'); // Assuming Pending is a valid status
$fullScholarCount = getCountScholarType('Full Scholarship');
$grantLevel1Count = getCountScholarType('Grant Level 1');
$grantLevel2Count = getCountScholarType('Grant Level 2');
$totalApplicantsCount = getTotalApplicantsCount();
$totalScholarsCount = getCount('Granted');  // Only applicants with status "Granted"

// Function to fetch total count of applicants
function getTotalApplicantsCount() {
    global $con;
    $query = "SELECT COUNT(*) as count FROM applicants";
    $result = mysqli_query($con, $query);
    
    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    }

    $row = mysqli_fetch_assoc($result);
    return $row['count'];
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
        $targetDir = "uploads/";
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
    <!-- Additional HTML Content -->
    <main class="content">
        <div class="container-fluid p-0">
              <div class="row">
                <!-- Display Cards for each count -->
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Applicants</h5>
                            <h1><?php echo $totalApplicantsCount; ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Scholars Granted</h5>
                            <h1><?php echo $totalScholarsCount; ?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">Doughnut Chart</div>
                        <div class="card-body">
                            <canvas id="doughnutChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">Bar Chart</div>
                        <div class="card-body">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Announcement Section -->
<div class="container mt-4">
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

    <!-- Announcement Table -->
    <div class="card mt-4">
        <div class="card-header">
            <h4>Announcements</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
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
                    // Fetch announcements from the database
                    $result = mysqli_query($con, "SELECT * FROM announcements ORDER BY date DESC");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['subject']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                                      echo "<td>" . htmlspecialchars($row['content']) . "</td>";
                        echo "<td>";
                        if ($row['image']) {
                            echo "<img src='uploads/" . htmlspecialchars($row['image']) . "' alt='Announcement Image' width='100'>";
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

    </main>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Doughnut chart displaying Eligible, Ineligible, Pending statuses
    new Chart(document.getElementById("doughnutChart"), {
        type: "doughnut",
        data: {
            labels: ["Eligible", "Ineligible", "Pending"],
            datasets: [{
                data: [
                    <?php echo $eligibleCount; ?>,
                    <?php echo $ineligibleCount; ?>,
                    <?php echo $pendingCount; ?>
                ],
                backgroundColor: ["#007bff", "#dc3545", "#ffc107"],
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

    // Bar chart displaying Full Scholar, Grant Level 1, Grant Level 2
    new Chart(document.getElementById("barChart"), {
        type: "bar",
        data: {
            labels: ["Full Scholar", "Grant Level 1", "Grant Level 2"],
            datasets: [{
                data: [
                    <?php echo $fullScholarCount; ?>,
                    <?php echo $grantLevel1Count; ?>,
                    <?php echo $grantLevel2Count; ?>
                ],
                backgroundColor: ["#28a745", "#17a2b8", "#6c757d"],
                borderColor: "transparent"
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{ ticks: { beginAtZero: true } }]
            },
            legend: { display: false }
        }
    });
});
</script>
<script src="js/app.js"></script>
</body>
</html>
