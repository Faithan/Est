<?php
require('db_connect.php');
session_start();

$response = ['status' => 'error', 'message' => 'Something went wrong'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $con->real_escape_string($_POST['name']);
    $description = $con->real_escape_string($_POST['description']);
    $type = $_POST['type'];

    if ($type == 'add_type') {
        $insert_query = "INSERT INTO cottage_type_tbl (cottage_type_name, cottage_type_description) VALUES (?, ?)";
        if ($stmt = $con->prepare($insert_query)) {
            $stmt->bind_param('ss', $name, $description);
            if ($stmt->execute()) {
                $response['status'] = 'success';
                $response['message'] = 'Item added successfully';
                $response['id'] = $stmt->insert_id;
            }
            $stmt->close();
        }
    } elseif ($type == 'add_status') {
        $insert_query = "INSERT INTO cottage_status_tbl (cottage_status_name, cottage_status_description) VALUES (?, ?)";
        if ($stmt = $con->prepare($insert_query)) {
            $stmt->bind_param('ss', $name, $description);
            if ($stmt->execute()) {
                $response['status'] = 'success';
                $response['message'] = 'Item added successfully';
                $response['id'] = $stmt->insert_id;
            }
            $stmt->close();
        }
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
