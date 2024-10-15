<?php
require 'db_connect.php';

$date = $_POST['date'];
$type = $_POST['type'];

if ($type == 'cottage') {
    // Fetch cottage reservation details for the selected date
    $query = "SELECT * FROM reserve_cottage_tbl WHERE date_of_arrival = '$date'";
} else if ($type == 'room') {
    // Fetch room reservation details for the selected date
    $query = "SELECT * FROM reserve_room_tbl WHERE date_of_arrival = '$date'";
}

$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Determine the correct name columns based on reservation type
        if ($type == 'cottage') {
            $firstName = $row['first_name'];
            $lastName = $row['last_name'];
        } else if ($type == 'room') {
            $firstName = $row['fname'];
            $lastName = $row['lname'];
        }
        echo "<div class='reserve-box'>";
        // Display additional details based on reservation type
        if ($type == 'cottage') {
            echo "<p><strong>Cottage Number:</strong> " . $row['cottage_number'] . "</p>";
        } else if ($type == 'room') {
            echo "<p><strong>Room Number:</strong> " . $row['room_number'] . "</p>";
        }

        // Display additional details based on reservation type
        if ($type == 'cottage') {
            echo "<p><strong>Cottage Type:</strong> " . $row['cottage_type'] . "</p>";
        } else if ($type == 'room') {
            echo "<p><strong>Room Type:</strong> " . $row['room_type'] . "</p>";
        }

        echo "<p><strong>Arrival Date:</strong> " . $row['date_of_arrival'] . "</p>";
        // Display additional details based on reservation type
        if ($type == 'cottage') {
            echo "<p><strong>Time:</strong> " . $row['time'] . "</p>";
        } else if ($type == 'room') {
            echo "<p><strong>time:</strong> " . $row['time_of_arrival'] . "</p>";
        }

        // Display reservation details
        echo "<p><strong>Name:</strong> " . $firstName . " " . $lastName . "</p>";

        echo "<p><strong>Price:</strong> ₱" . $row['price'] . "</p>";

        if ($type == 'cottage') {
            echo "<img src='".$row['cottage_photo']."' >";
        } else if ($type == 'room') {
            echo "<img src='".$row['photo']."' >";
        }

        echo "</div>";
    }
} else {
    echo "No reservation found for this date.";
}
