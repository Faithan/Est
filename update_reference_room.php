<?php
require('db_connect.php'); // Ensure you have your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reserve_id = $_POST['reserve_id'];
    $reference_number = $_POST['reference_number'];

    // Prepare the update query
    $update_query = "UPDATE reserve_room_tbl SET reference_number = ? WHERE reserve_id = ?";
    $stmt = $con->prepare($update_query);
    $stmt->bind_param("si", $reference_number, $reserve_id);

    if ($stmt->execute()) {
        $response = ['success' => true, 'message' => 'Reference number updated successfully.'];
    } else {
        $response = ['success' => false, 'message' => 'Error updating reference number.'];
    }

    $stmt->close();
    echo json_encode($response);
}
?>
