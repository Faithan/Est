<?php
require 'db_connect.php';
session_start();

// Initialize response
$response = ['status' => 'error', 'message' => 'An unexpected error occurred.'];

// Validate manage_id
if (isset($_GET['manage_id'])) {
    $manage_id = intval($_GET['manage_id']);
    $manage_query = "SELECT * FROM user_tbl WHERE id = ?";
    if ($stmt = $con->prepare($manage_query)) {
        $stmt->bind_param('i', $manage_id);
        $stmt->execute();
        $manage_result = $stmt->get_result();
        $manage_data = $manage_result->fetch_assoc();
        $stmt->close();
    } else {
        $response['message'] = 'Failed to prepare SQL statement for fetching user details.';
        echo json_encode($response);
        exit;
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
    $id = intval($_POST['id']);
    $full_name = $_POST['full_name'] ?? $manage_data['full_name'];
    $contact_number = $_POST['contact_number'] ?? $manage_data['contact_number'];
    $email = $_POST['email'] ?? $manage_data['email'];
    $gender = $_POST['gender'] ?? $manage_data['gender'];
    $birthdate = $_POST['birthdate'] ?? $manage_data['birthdate'];
    $address = $_POST['address'] ?? $manage_data['address'];
    $account_status = $_POST['account_status'] ?? $manage_data['account_status'];
    $password = $_POST['password'] ?? $manage_data['password'];

    $update_query = "UPDATE user_tbl SET full_name = ?, contact_number = ?, email = ?, gender = ?, birthdate = ?, address = ?, account_status = ?, password = ? WHERE id = ?";
    if ($stmt = $con->prepare($update_query)) {
        $stmt->bind_param('ssssssssi', $full_name, $contact_number, $email, $gender, $birthdate, $address, $account_status, $password, $id);
        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'User updated successfully!';
        } else {
            $response['message'] = 'Failed to update user. Please try again.';
        }
        $stmt->close();
    } else {
        $response['message'] = 'Failed to prepare SQL statement for updating user.';
    }
    echo json_encode($response);
    exit;
}
?>
