<?php
include ('db_connect.php');

if (isset($_POST['reserve_id'])) {
    $reserve_id = $_POST['reserve_id'];
    $rejection_reason = $_POST['rejection_reason'];

    $update_query = "UPDATE reserve_room_tbl SET status='cancelled', rejection_reason='$rejection_reason' WHERE reserve_id='$reserve_id'";

    if (mysqli_query($con, $update_query)) {
        exit('success');
    } else {
        exit('error');
    }
}
?>