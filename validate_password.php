<?php
include('db_connect.php');
session_start();

if (isset($_SESSION['user_id']) && isset($_POST['password'])) {
    $user_id = $_SESSION['user_id'];
    $password = $_POST['password'];

    // Fetch the stored password from the database
    $query = "SELECT password FROM user_tbl WHERE id = $user_id";
    $result = mysqli_query($con, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row && $row['password'] === $password) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Incorrect password.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to fetch user data.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'User not logged in or password not provided.']);
}
?>
