<?php
// update_password.php

include('db_connect.php');
session_start();

// Get the user ID and the submitted passwords from the request
$user_id = $_SESSION['user_id'];
$current_password = $_POST['current-password'];
$new_password = $_POST['new-password'];
$confirm_new_password = $_POST['confirm-new-password'];

// Check if new password and confirmation match
if ($new_password !== $confirm_new_password) {
    echo json_encode(['success' => false, 'message' => 'New passwords do not match.']);
    exit();
}

// Fetch the current password from the database
$query = "SELECT password FROM user_tbl WHERE id = $user_id";
$result = mysqli_query($con, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);

    // Verify the provided current password against the stored password
    if ($current_password === $row['password']) {
        // Password is correct, proceed with updating to the new password
        $update_query = "UPDATE user_tbl SET password = '$new_password' WHERE id = $user_id";
        if (mysqli_query($con, $update_query)) {
            echo json_encode(['success' => true, 'message' => 'Password updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update password.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Incorrect current password.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to fetch user data.']);
}

?>