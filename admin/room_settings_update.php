<?php
// room_settings_update.php

include 'db_connect.php'; // Make sure this file contains your database connection logic
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['edit_id'];
    $type = $_POST['edit_type'];
    $name = $_POST['edit_name'];
    $description = $_POST['edit_description'];

    switch ($type) {
        case 'edit_room_type':
            $query = "UPDATE room_type_tbl SET room_type_name = ?, room_type_description = ? WHERE room_type_id = ?";
            break;
        case 'edit_bed_type':
            $query = "UPDATE bed_type_tbl SET bed_type_name = ?, bed_type_description = ? WHERE bed_type_id = ?";
            break;
        case 'edit_room_status':
            $query = "UPDATE room_status_tbl SET room_status_name = ?, room_status_description = ? WHERE room_status_id = ?";
            break;
        default:
            die('Invalid type');
    }

    $stmt = $con->prepare($query);
    $stmt->bind_param('ssi', $name, $description, $id);
    $stmt->execute();
    $stmt->close();
    header('Location: extraSettingsRoom.php');
}
?>
