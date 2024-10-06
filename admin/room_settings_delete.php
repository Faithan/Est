<?php
// room_settings_delete.php

include 'db_connect.php'; // Ensure this file contains your database connection logic

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'];
    $id = intval($_POST['id']); // Ensure ID is an integer

    switch ($type) {
        case 'delete_room_type':
            $query = "DELETE FROM room_type_tbl WHERE room_type_id = ?";
            break;
        case 'delete_bed_type':
            $query = "DELETE FROM bed_type_tbl WHERE bed_type_id = ?";
            break;
        case 'delete_room_status':
            $query = "DELETE FROM room_status_tbl WHERE room_status_id = ?";
            break;
        case 'delete_amenity': // New case for deleting a room amenity
            $query = "DELETE FROM room_amenities_tbl WHERE amenity_id = ?";
            break;
        default:
            die('Invalid type');
    }

    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param('i', $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Record deleted successfully.";
        } else {
            echo "Record not found or already deleted.";
        }

        $stmt->close();
    } else {
        die('Prepare failed: ' . htmlspecialchars($con->error));
    }

    header('Location: extraSettingsRoom.php');
    exit();
} else {
    die('Invalid request method');
}
?>
