<?php
require 'db_connect.php';

if (isset($_GET['cottage_id'])) {
    $cottageId = $_GET['cottage_id'];

    // Use the cottage number from the `cottage_tbl` for linking
    $query = "SELECT r.reserve_id, u.full_name, u.contact_number, u.email, r.date_of_arrival
              FROM user_tbl u
              INNER JOIN reserve_cottage_tbl r
              ON u.id = r.user_id
              WHERE r.cottage_number = (SELECT cottage_number FROM cottage_tbl WHERE cottage_id = ?)";
              
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $cottageId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>
                <tr style='background-color: #f2f2f2;'>
                    <th>Reservation ID</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Arrival Date</th>
                </tr>";
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
        echo "<p>No users reserved this cottage.</p>";
    }
}
?>
