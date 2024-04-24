
<?php
include ('db_connect.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $update_query = "DELETE FROM room_tbl WHERE id='$id'";
    if (mysqli_query($con, $update_query)) {
        exit('success');
    } else {
        exit('error');
    }
}
?>