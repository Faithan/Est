<?php
require 'db_connect.php';

if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    // Fetch Cottage Reservations
    $cottageQuery = "SELECT * FROM `reserve_cottage_tbl` WHERE `user_id` = $userId";
    $cottageResult = $con->query($cottageQuery);

    // Fetch Room Reservations
    $roomQuery = "SELECT * FROM `reserve_room_tbl` WHERE `user_id` = $userId";
    $roomResult = $con->query($roomQuery);

    $output = "<h3>Cottage Reservations</h3>";
    if ($cottageResult->num_rows > 0) {
        $output .= "<table>
                        <tr>
                            <th>Reserve ID</th>
                            <th>Cottage Number</th>
                            <th>Date of Arrival</th>
                            <th>Status</th>
                            <th>Price</th>
                            <th>Reservation Payment</th>
                            <th>Payment </th>
                            <th>Cottage Type</th>
                            <th>Special Request</th>
                            <th>Cottage Photo</th>
                        </tr>";
        while ($row = $cottageResult->fetch_assoc()) {
            $output .= "<tr>
                            <td>{$row['reserve_id']}</td>
                            <td>{$row['cottage_number']}</td>
                           
                            <td>{$row['date_of_arrival']}</td>
                             <td>{$row['reserve_status']}</td>
                              <td>{$row['price']}</td>
                              <td>{$row['cottage_reserve_fee']}</td>
                                 <td>{$row['payment']}</td>
                            <td>{$row['cottage_type']}</td>
                            <td>{$row['special_request']}</td>
                            <td><img src='{$row['cottage_photo']}' alt='Cottage Photo' style='width: 50px; height: auto;'></td>
                        </tr>";
        }
        $output .= "</table>";
    } else {
        $output .= "<p>No cottage reservations found.</p>";
    }

    $output .= "<h3>Room Reservations</h3>";
    if ($roomResult->num_rows > 0) {
        $output .= "<table>
                        <tr>
                            <th>Reserve ID</th>
                            <th>Room Number</th>
                            <th>Date of Arrival</th>
                            <th>Status</th>
                            <th>Price</th>
                              <th>Extra Bed and Person</th>
                            <th>Reservation Payment</th>
                            <th>Payment</th>
                             <th>Additional Payment</th>
                            <th>Room Type</th>
                            <th>Bed Type</th>
                            <th>Special Request</th>
                            <th>Room Photo</th>
                        </tr>";
        while ($row = $roomResult->fetch_assoc()) {
            $output .= "<tr>
                            <td>{$row['reserve_id']}</td>
                            <td>{$row['room_number']}</td>
                            <td>{$row['date_of_arrival']}</td>
                            <td>{$row['status']}</td>
                            <td>{$row['price']}</td>
                            <td>{$row['extra_bed_and_person']}</td>
                            <td>{$row['reservation_fee']}</td>
                            <td>{$row['payment']}</td>
                            <td>{$row['additional_payment']}</td>
                            <td>{$row['room_type']}</td>
                            <td>{$row['bed_type']}</td>
                            <td>{$row['special_request']}</td>
                            <td><img src='{$row['photo']}' alt='Room Photo' style='width: 50px; height: auto;'></td>
                        </tr>";
        }
        $output .= "</table>";
    } else {
        $output .= "<p>No room reservations found.</p>";
    }

    echo $output;
}
