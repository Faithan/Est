<?php
include ('db_connect.php');
session_start();
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="reservation.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
    <title>Reservation</title>
</head>

<body>

    <div>
        <nav class="navbar">
            <img src="../system_images/Picture1.png" class="logo1">
            <a class="logoLabel">Estregan Beach Resort</a>
            <ul>
                <li><a>Home</a></li>
                <li><a>Reservations</a></li>
                <li class="dropdown">
                    <a href="#" class="reservation">Rooms/Cottages</a>
                    <div class="dropdown-content">
                        <a href="#">Cottages</a>
                        <a href="#">Rooms</a>
                <li class="dropdown">
                    <a href="#" class="reservation">Add Reservation</a>
                    <div class="dropdown-content">
                        <a href="#">Add Cottages</a>
                        <a href="#">Add Rooms</a>

            </ul>
            <button>Log out</button>
        </nav>
    </div>

    <div class="container">
        <div class="container2">
            <div class="header-label">
                <label for="">RESERVATION</label>
            </div>

            <div class="buttons-container">
                <button>Pendings</button>
                <button>Checked In</button>
                <button>Checked Out</button>
            </div>

            <div class="table-container">
                <table>
                    <tr>
                        <th>Reserve ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Date of Arrival</th>
                        <th>Time of Arrival</th>
                        <th>Room Type</th>
                        <th>Number of Person</th>
                        <th>Amenities</th>
                        <th>Rate Per Hour</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                    <?php $fetchdata = "SELECT * FROM reserve_room_tbl";
                    $result = mysqli_query($con, $fetchdata);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $reserve_id = $row['reserve_id'];
                        $fname = $row['fname'];
                        $lname = $row['lname'];
                        $address = $row['address'];
                        $phone_number = $row['phone_number'];
                        $email = $row['email'];
                        $date_of_arrival = $row['date_of_arrival'];
                        $time_of_arrival = $row['time_of_arrival'];
                        $room_type = $row['room_type'];
                        $number_of_person = $row['number_of_person'];
                        $amenities = $row['amenities'];
                        $rate_per_hour = $row['rate_per_hour'];
                        $special_request = $row['special_request'];

                        ?>
                        <tr>
                            <td>
                                <?php echo $reserve_id ?>
                            </td>
                            <td>
                                <?php echo $fname ?>
                            </td>
                            <td>
                                <?php echo $lname ?>
                            </td>
                            <td>
                                <?php echo $address ?>
                            </td>
                            <td>
                                <?php echo $phone_number?>
                            </td>
                            <td class="email">
                                <?php echo $email?>
                            </td>
                            <td>
                                <?php echo $date_of_arrival?>
                            </td>
                            <td>
                                <?php echo $time_of_arrival?>
                            </td>
                            <td>
                                <?php echo $room_type?>
                            </td>
                            <td>
                                <?php echo $number_of_person?>
                            </td>
                            <td>
                                <?php echo $amenities?>
                            </td>
                            <td>
                                <?php echo $rate_per_hour?>
                            </td>

                            <td><img src="<?php echo $photo ?>" style="width:100px; height:auto;"></td>
                            <td class="td2">
                                <button class="edit-btn" type="submit" name="manage"><a
                                        href="requestlist.php?manage_id=<?php echo $id; ?>">Check in</a></button>
                                <button class="delete-btn" type="submit" name="manage"><a
                                        href="requestlist.php?manage_id=<?php echo $id; ?>">Reject</a></button>
                            </td>
                        </tr>

                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

    <script src=""></script>
</body>

</html>