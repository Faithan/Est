<?php
include 'db_connect.php';
session_start();

$response = ['success' => false, 'message' => ''];

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the room ID from the hidden input field
    $room_id = intval($_POST['id']);

    // Capture and sanitize form inputs
    $room_number = intval($_POST['room_number']);
    $room_type = mysqli_real_escape_string($con, $_POST['room_type']);
    $bed_type = mysqli_real_escape_string($con, $_POST['bed_type']);
    $bed_quantity = intval($_POST['bed_quantity']);
    $no_persons = intval($_POST['no_persons']);
    $amenities = mysqli_real_escape_string($con, $_POST['amenities']);
    $price = floatval($_POST['price']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    // Update the room details in the database
    $update_query = "UPDATE room_tbl SET 
                        room_number = ?, 
                        room_type = ?, 
                        bed_type = ?, 
                        bed_quantity = ?, 
                        no_persons = ?, 
                        amenities = ?, 
                        price = ?, 
                        status = ? 
                    WHERE id = ?";

    if ($stmt = $con->prepare($update_query)) {
        $stmt->bind_param('issiisdsi', $room_number, $room_type, $bed_type, $bed_quantity, $no_persons, $amenities, $price, $status, $room_id);
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Room details updated successfully.';
        } else {
            $response['message'] = 'Failed to update room details.';
        }
        $stmt->close();
    } else {
        $response['message'] = 'Failed to prepare SQL statement for updating room details.';
    }
} else {
    $response['message'] = 'Invalid request method.';
}

// Return the response as JSON
echo json_encode($response);
?>
