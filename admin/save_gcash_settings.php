<?php 
require('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gcash_number = $_POST['gcash_number'];
    $gcash_photo = $_FILES['gcash_photo'];

    // Handle file upload
    $target_file = null; // Initialize target_file
    if ($gcash_photo['error'] == UPLOAD_ERR_OK) {
        $target_dir = "gcash_photo/"; // Directory to save uploaded files
        $target_file = $target_dir . basename($gcash_photo["name"]);
        move_uploaded_file($gcash_photo["tmp_name"], $target_file);
    }

    // Check if a row with id = 1 exists
    $query = "SELECT * FROM gcash_tbl WHERE id = 1";
    $result = $con->query($query);
    
    if ($result->num_rows > 0) {
        // Row exists, update it
        $update_query = "UPDATE gcash_tbl SET gcash_number = ?, gcash_photo = ? WHERE id = 1";
        $stmt = $con->prepare($update_query);
        $stmt->bind_param("ss", $gcash_number, $target_file);
        $stmt->execute();
        $response = ['success' => true, 'message' => 'Gcash settings updated successfully.'];
    } else {
        // No row exists, insert a new one
        $insert_query = "INSERT INTO gcash_tbl (id, gcash_number, gcash_photo) VALUES (1, ?, ?)";
        $stmt = $con->prepare($insert_query);
        $stmt->bind_param("ss", $gcash_number, $target_file);
        $stmt->execute();
        $response = ['success' => true, 'message' => 'Gcash settings saved successfully.'];
    }
    
    echo json_encode($response);
}

?>