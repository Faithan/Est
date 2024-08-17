<?php
// update_email.php

include('db_connect.php');
session_start();

// Get the user ID and new email from the request
$user_id = $_SESSION['user_id'];
$new_email = $_POST['new-email'];
$password = $_POST['password'];

// Fetch the current password from the database
$query = "SELECT password FROM user_tbl WHERE id = $user_id";
$result = mysqli_query($con, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);

    // Verify the provided password against the stored password
    if ($password === $row['password']) {
        // Password is correct, proceed with updating the email
        $update_query = "UPDATE user_tbl SET email = '$new_email' WHERE id = $user_id";
        if (mysqli_query($con, $update_query)) {
            echo json_encode(['success' => true, 'message' => 'Email updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update email.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Incorrect password.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to fetch user data.']);
}

?>
