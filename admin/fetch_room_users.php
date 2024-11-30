<?php
require 'db_connect.php';

if (isset($_GET['room_id'])) {
    $roomId = $_GET['room_id'];

    // Fetch users who reserved this room
    $query = "SELECT r.reserve_id, u.full_name, u.contact_number, u.email, r.date_of_arrival
              FROM user_tbl u 
              INNER JOIN reserve_room_tbl r 
              ON u.id = r.user_id 
              WHERE r.room_number = (SELECT room_number FROM room_tbl WHERE id = ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $roomId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<table>
                <tr><th>Reservation ID</th><th>Name</th><th>Contact</th><th>Email</th><th>Arrival Date</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['reserve_id']}</td>
                    <td>{$row['full_name']}</td>
                    <td>{$row['contact_number']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['date_of_arrival']}</td>
               
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No users reserved this room.</p>";
    }
}
?>
