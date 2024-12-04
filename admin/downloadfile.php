<?php
include('../connection.php');

if (isset($_GET['applicant_id']) && isset($_GET['title'])) {
    $applicant_id = mysqli_real_escape_string($con, $_GET['applicant_id']);
    $file_type = mysqli_real_escape_string($con, $_GET['title']); // 'cor' or 'rog'

    // Determine the columns to fetch based on file type
    if ($file_type === 'cor') {
        $filename_col = 'cor_filename';
        $file_path_col = 'cor_file_path';  // Path of the file
    } elseif ($file_type === 'rog') {
        $filename_col = 'rog_filename';
        $file_path_col = 'rog_file_path';  // Path of the file
    } else {
        die("Invalid file type specified.");
    }

    // Query to fetch the file path and filename based on applicant_id
    $qry = "SELECT $filename_col, $file_path_col FROM applicants WHERE id = '$applicant_id'";
    $result = mysqli_query($con, $qry);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $filename = $row[$filename_col];
        $file_path = $row[$file_path_col];

        if ($file_path && file_exists($file_path)) {
            // Clear any previous output buffer
            if (ob_get_level()) {
                ob_end_clean();
            }

            // Get the file MIME type
            $mime_type = mime_content_type($file_path);

            // Send headers to force the download
            header('Content-Type: ' . $mime_type);
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Length: ' . filesize($file_path));
            header('Cache-Control: no-store, no-cache, must-revalidate');
            header('Expires: 0');

            // Output the file content
            readfile($file_path);
            exit;
        } else {
            echo "File not found.";
        }
    } else {
        echo "No file found for the specified applicant.";
    }
} else {
    echo "Applicant ID or file type not specified.";
}
?>
