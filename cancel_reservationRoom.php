<?php
include('db_connect.php');
session_start();

if (isset($_POST['reserve_id'])) {
    $reserve_id = $_POST['reserve_id'];

    // Update the status to 'cancelled' in the database
    $cancel_query = "UPDATE reserve_room_tbl SET status = 'cancelled' WHERE reserve_id = ?";
    $stmt = $con->prepare($cancel_query);
    $stmt->bind_param('i', $reserve_id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
}
?>
