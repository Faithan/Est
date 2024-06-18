<?php
include ('db_connect.php');

if (isset($_POST['reserve_id'])) {
    $reserve_id = $_POST['reserve_id'];

    $update_query = "UPDATE reserve_room_tbl SET status='rejected' WHERE reserve_id='$reserve_id'";

    if (mysqli_query($con, $update_query)) {
        exit('success');
    } else {
        exit('error');
    }
}
?>