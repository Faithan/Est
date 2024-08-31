<?php
require('db_connect.php');
session_start();

$response = ['status' => 'error', 'message' => 'Something went wrong'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $name = $con->real_escape_string($_POST['name']);
    $description = $con->real_escape_string($_POST['description']);
    $type = $_POST['type'];

    if ($type == 'type') {
        $update_query = "UPDATE cottage_type_tbl SET cottage_type_name = ?, cottage_type_description = ? WHERE cottage_type_id = ?";
        if ($stmt = $con->prepare($update_query)) {
            $stmt->bind_param('ssi', $name, $description, $id);
            if ($stmt->execute()) {
                $response['status'] = 'success';
                $response['message'] = 'Update successful';
            }
            $stmt->close();
        }
    } elseif ($type == 'status') {
        $update_query = "UPDATE cottage_status_tbl SET cottage_status_name = ?, cottage_status_description = ? WHERE cottage_status_id = ?";
        if ($stmt = $con->prepare($update_query)) {
            $stmt->bind_param('ssi', $name, $description, $id);
            if ($stmt->execute()) {
                $response['status'] = 'success';
                $response['message'] = 'Update successful';
            }
            $stmt->close();
        }
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
