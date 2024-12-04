<?php
include("sidebar.php"); // Include the sidebar (which has the $con connection)

// Get the applicant ID from the URL
$applicant_id = isset($_GET['applicant_id']) ? $_GET['applicant_id'] : '';

// Check if the applicant ID is provided
if ($applicant_id != '') {
    // Query to fetch the applicant's data
    $query = "SELECT * FROM applicants WHERE id = '$applicant_id'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // Fetch the applicant data
        $applicant_data = mysqli_fetch_assoc($result);
  
        $family_query = "SELECT * FROM family WHERE applicant_id = '$applicant_id'";
        $family_result = mysqli_query($con, $family_query);

        if ($applicant_data['date_of_birth']) {
            $dob = new DateTime($applicant_data['date_of_birth']);
            $now = new DateTime();
            $age = $now->diff($dob)->y;
        } else {
            $age = ''; // Leave it empty if DOB is not available
        }
    } else {
        echo "No applicant found with the given ID.";
        exit();
    }
} else {
    echo "No applicant ID provided.";
    exit();
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
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Uploaded COR Files</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        // Fetch uploaded ROG and COR files for the specific applicant ID
                        $query = "SELECT * FROM COROG WHERE applicant_id = ?";
                        $stmt = $con->prepare($query);
                        $stmt->bind_param("i", $applicant_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result && $result->num_rows > 0) {
                        ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>COR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars(pathinfo($row['cor_path'], PATHINFO_FILENAME)); ?></td> <!-- Display the file name -->
                                            <td>
                                                <?php if ($row['cor_path']) { ?>
                                                    <a  class="btn btn-primary"href="<?php echo htmlspecialchars($row['cor_path']); ?>" download>Download COR</a>
                                                <?php } else { ?>
                                                    No File
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php
                        } else {
                            echo "<div class='alert alert-info'>No files uploaded yet.</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="js/app.js"></script>

<script>
    function printForm() {
        window.print();
    }
</script>
</body>
</html>
