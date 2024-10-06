<?php
// room_settings_add.php

include 'db_connect.php'; // Make sure this file contains your database connection logic
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['add_type'];
    $name = $_POST['add_name'];
    $description = $_POST['add_description'];

    switch ($type) {
        case 'room_type':
            $query = "INSERT INTO room_type_tbl (room_type_name, room_type_description) VALUES (?, ?)";
            break;
        case 'bed_type':
            $query = "INSERT INTO bed_type_tbl (bed_type_name, bed_type_description) VALUES (?, ?)";
            break;
        case 'room_status':
            $query = "INSERT INTO room_status_tbl (room_status_name, room_status_description) VALUES (?, ?)";
            break;
        case 'amenity': // New case for adding a room amenity
            $query = "INSERT INTO room_amenities_tbl (amenity_name, amenity_description) VALUES (?, ?)";
            break;
        default:
            die('Invalid type');
    }

    $stmt = $con->prepare($query);
    $stmt->bind_param('ss', $name, $description);
    $stmt->execute();
    $stmt->close();
    header('Location: extraSettingsRoom.php');
}
?>
