<?php
include 'db_connect.php';
session_start();

$response = ['success' => false, 'message' => ''];

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Debug: Print received POST data
    error_log(print_r($_POST, true));

    // Get the cottage ID from the hidden input field
    $cottage_id = intval($_POST['cottage_id']);

    // Capture and sanitize form inputs
    $cottage_number = intval($_POST['cottage_number']);
    $cottage_type = mysqli_real_escape_string($con, $_POST['cottage_type']);
    $number_of_person = intval($_POST['number_of_person']);
    $day_price = floatval($_POST['day_price']);
    $night_price = floatval($_POST['night_price']);
    $cottage_status = mysqli_real_escape_string($con, $_POST['cottage_status']);

    // Update the cottage details in the database
    $update_query = "UPDATE cottage_tbl SET 
                        cottage_number = ?, 
                        cottage_type = ?, 
                        number_of_person = ?, 
                        day_price = ?, 
                        night_price = ?, 
                        cottage_status = ? 
                    WHERE cottage_id = ?";

    if ($stmt = $con->prepare($update_query)) {
        $stmt->bind_param('isiddsi', $cottage_number, $cottage_type, $number_of_person, $day_price, $night_price, $cottage_status, $cottage_id);
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Cottage details updated successfully.';
        } else {
            $response['message'] = 'Failed to update cottage details.';
        }
        $stmt->close();
    } else {
        $response['message'] = 'Failed to prepare SQL statement for updating cottage details.';
    }
} else {
    $response['message'] = 'Invalid request method.';
}

// Return the response as JSON
echo json_encode($response);
?>
