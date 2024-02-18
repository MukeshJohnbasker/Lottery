<?php
// Check if the 'lott_file' parameter is set in the URL
if (isset($_GET['lott_file'])) {
    // Sanitize the filename to prevent security issues
    $filename = basename($_GET['lott_file']);

    // Ensure the file path is correct
    $file_path = 'lottery_files/' . $filename;

    // Check if the file exists
    if (file_exists($file_path)) {
        // Set the appropriate headers for the file download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file_path));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));

        // Read the file and output it to the browser
        readfile($file_path);
        exit;
    } else {
        // Handle the case where the file does not exist
        echo 'File not found';
    }
} else {
    // Handle the case where 'lott_file' parameter is not set
    echo 'Invalid request';
}
?>
