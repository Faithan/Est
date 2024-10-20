<?php
require('db_connect.php');

$query = "SELECT gcash_number, gcash_photo FROM gcash_tbl WHERE id = 1"; // Assuming id = 1
$result = $con->query($query);
$data = $result->fetch_assoc();

echo json_encode($data);
?>
