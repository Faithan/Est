
<?php
include ('dbconnect.php');


if (isset($_POST['reserve_id'])) {
    $reserve_id = $_POST['reserve_id'];

    $update_query = "UPDATE reserve_cottage_tbl SET reserve_status='cancelled' WHERE reserve_id='$reserve_id'";

    if (mysqli_query($con, $update_query)) {
        exit('success');
    } else {
        exit('error');
    }
}
?>