<?php
include('../connection.php');

if (isset($_GET['applicant_id']) && isset($_GET['file_type'])) {
    $applicant_id = mysqli_real_escape_string($con, $_GET['applicant_id']);
    $file_type = mysqli_real_escape_string($con, $_GET['file_type']); // Expecting 'cor' or 'rog'

    // Determine columns based on file type
    if ($file_type === 'cor') {
        $filename_col = 'cor_filename';
        $mime_type_col = 'cor_mime_type';
        $data_col = 'cor_data';
    } elseif ($file_type === 'rog') {
        $filename_col = 'rog_filename';
        $mime_type_col = 'rog_mime_type';
        $data_col = 'rog_data';
    } else {
        die("Invalid file type specified.");
    }

    // Query the database to fetch the file details using applicant_id
    $qry = "SELECT $filename_col AS filename, $mime_type_col AS mime_type, $data_col AS data FROM applicants WHERE id = '$applicant_id'";
    $result = mysqli_query($con, $qry);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $filename = $row['filename'];
        $mime_type = $row['mime_type'];
        $file_data = $row['data'];

        if ($file_data) {
            // Send the appropriate headers to force the download
            header('Content-Type: ' . $mime_type);
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Length: ' . strlen($file_data));
            header('Cache-Control: no-store, no-cache, must-revalidate');
            header('Expires: 0');

            // Output the file data
            echo $file_data;
            exit;
        } else {
            echo "File data is empty.";
        }
    } else {
        echo "File not found.";
    }
} else {
    echo "Applicant ID or file type not specified.";
}
?>
