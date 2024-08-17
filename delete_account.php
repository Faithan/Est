<?php
include('db_connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $password = $data['password'];

    $user_id = $_SESSION['user_id'];
    
    // Fetch the current password from the database
    $query = "SELECT password FROM user_tbl WHERE id = $user_id";
    $result = mysqli_query($con, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Verify the provided password against the stored password
        if ($password === $row['password']) {
            // Password is correct, proceed with updating the account status
            $update_query = "UPDATE user_tbl SET account_status = 'deleted' WHERE id = $user_id";
            if (mysqli_query($con, $update_query)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update account status.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Incorrect password.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to fetch user data.']);
    }
}
?>
