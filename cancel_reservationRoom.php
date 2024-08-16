
<?php
include ('dbconnect.php');


if (isset($_POST['reserve_id'])) {
    $reserve_id = $_POST['reserve_id'];

    $update_query = "UPDATE reserve_room_tbl SET status='cancelled' WHERE reserve_id='$reserve_id'";

    if (mysqli_query($con, $update_query)) {
        exit('success');
    } else {
        exit('error');
    }
}
?>