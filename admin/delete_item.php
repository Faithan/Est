<?php
require('db_connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $type = $_POST['type'];

    if ($type == 'type') {
        $delete_query = "DELETE FROM cottage_type_tbl WHERE cottage_type_id = ?";
    } elseif ($type == 'status') {
        $delete_query = "DELETE FROM cottage_status_tbl WHERE cottage_status_id = ?";
    } else {
        echo 'Invalid type';
        exit;
    }

    if ($stmt = $con->prepare($delete_query)) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo 'Item deleted successfully.';
        } else {
            echo 'Failed to delete the item.';
        }
        $stmt->close();
    } else {
        echo 'Failed to prepare the statement.';
    }
}
?>
