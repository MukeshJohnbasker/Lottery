<?php

require('dbconn.php');

// Assuming 'action' is sent via POST
$action = pg_escape_string($_POST['action']);

if ($action == 'Insert_date_time') {
    // Assuming other values are sent via POST
    $lott_date = pg_escape_string($_POST['lottery_date']);
    $lott_time = pg_escape_string($_POST['lottery_time']);

    // Validate and handle file upload securely
    if (isset($_FILES['lottery_file'])) {
        $target_dir = "lottery_files/";  // Adjust the target directory as needed
        $target_file = $target_dir . basename($_FILES['lottery_file']['name']);
        $lott_file = $_FILES['lottery_file']['name'];

        // You may want to add more security checks here, e.g., file size, file type, etc.
        
        if (move_uploaded_file($_FILES['lottery_file']['tmp_name'], $target_file)) {
            // File upload successful, now insert into the database
            $insDateTime = pg_query($db, "INSERT INTO lottery_date_time(lottery_date, lottery_time, lottery_file) VALUES(TO_DATE('$lott_date', 'MM/DD/YYYY'), '$lott_time', '$lott_file')") or die(pg_last_error($db));
            if($insDateTime){
                echo "success";
            }
        }
    } else {
        die("No file uploaded.");
    }
}

?>
