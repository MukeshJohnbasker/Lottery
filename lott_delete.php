<?php
require('dbconn.php');

$lott_id = $_GET['lott_id'];

$updQry = pg_query($db, "UPDATE lottery_date_time SET lottery_status='0' WHERE lottery_id = '$lott_id'") or die(preg_last_error($db));

if($updQry){
    echo '<Script>alert("Data Deleted Successfully");window.location.href="lott_view_list.php"</script>';
}else{
    echo '<Script>alert("Deletion failed")</script>';
}

?>