<?php
include('db_connect.php');
session_start();

// Get the user ID and new gender from the request
$user_id = $_SESSION['user_id'];
$new_gender = $_POST['new-gender'];
$password = $_POST['password'];

// Fetch the current password from the database
$query = "SELECT password FROM user_tbl WHERE id = $user_id";
$result = mysqli_query($con, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);

    // Verify the provided password against the stored password
    if ($password === $row['password']) {
        // Password is correct, proceed with updating the gender
        $update_query = "UPDATE user_tbl SET gender = '$new_gender' WHERE id = $user_id";
        if (mysqli_query($con, $update_query)) {
            echo json_encode(['success' => true, 'message' => 'Gender updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update gender.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Incorrect password.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to fetch user data.']);
}
?>
