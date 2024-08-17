<?php
include('db_connect.php');
session_start();

// Get the user ID and new address from the request
$user_id = $_SESSION['user_id'];
$new_address = $_POST['new-address'];
$password = $_POST['password'];

// Fetch the current password from the database
$query = "SELECT password FROM user_tbl WHERE id = $user_id";
$result = mysqli_query($con, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);

    // Verify the provided password against the stored password
    if ($password === $row['password']) {
        // Password is correct, proceed with updating the address
        $update_query = "UPDATE user_tbl SET address = '$new_address' WHERE id = $user_id";
        if (mysqli_query($con, $update_query)) {
            echo json_encode(['success' => true, 'message' => 'Address updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update address.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Incorrect password.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to fetch user data.']);
}
?>
