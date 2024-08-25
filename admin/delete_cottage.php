
<?php
include ('db_connect.php');

if (isset($_POST['cottage_id'])) {
    $id = $_POST['cottage_id'];
    $update_query = "DELETE FROM cottage_tbl WHERE cottage_id='$id'";
    if (mysqli_query($con, $update_query)) {
        exit('success');
    } else {
        exit('error');
    }
}
?>