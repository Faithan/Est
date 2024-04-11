<?php
include ('db_connect.php');
session_start();



if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM reserve_room_tbl WHERE reserve_id = $manage_id";
    $manage_result = mysqli_query($con, $manage_query);
    $manage_data = mysqli_fetch_assoc($manage_result);
}

if (isset($_POST['reject'])) {
    $reserve_id = $_POST['reserve_id'];
    $update_query = "UPDATE reserve_room_tbl SET status='rejected' WHERE reserve_id='$reserve_id'";
    if (mysqli_query($con, $update_query)) {
        echo "<script> alert('Data declined successfully')</script>";
    } else {
        echo "Error: " . $update_query . "<br>" . mysqli_error($con);
    }
}


?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../fontawesome/css/brands.css" rel="stylesheet" />
    <link href="../fontawesome/css/solid.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="reservation.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="fullscreen.css?v=<?php echo time(); ?>">
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
                <button onclick="showTablePendings()" id="pending-btn" class="pending-btn">Pendings</button>
                <button onclick="showTableConfirmed()" id="confirmed-btn">Confirmed</button>
                <button onclick="showTableCheckedIn()" id="checkedIn-btn">Checked In</button>
                <button onclick="showTableExtended()" id="extended-btn">Extended</button>
                <button onclick="showTableCheckedOut()" id="checkedOut-btn">Checked Out</button>
                <button onclick="showTableRejected()" id="rejected-btn" class="rejected-btn">Rejected</button>
            </div>










            <!-- for pending table -->









            <form method="post" action="" class="table-container1" id="table-container1">
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
                    <?php $fetchdata = "SELECT * FROM reserve_room_tbl WHERE status='pending'";
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
                        $photo = $row['photo'];
                        $special_request = $row['special_request'];

                        ?>
                        <tr>
                            <td>
                                <input type="number" name="reserve_id" value="<?php echo $reserve_id ?>" readonly>
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
                                <?php echo $phone_number ?>
                            </td>
                            <td class="email">
                                <?php echo $email ?>
                            </td>
                            <td>
                                <?php echo $date_of_arrival ?>
                            </td>
                            <td>
                                <?php echo $time_of_arrival ?>
                            </td>
                            <td>
                                <?php echo $room_type ?>
                            </td>
                            <td>
                                <?php echo $number_of_person ?>
                            </td>
                            <td>
                                <?php echo $amenities ?>
                            </td>
                            <td>
                                <?php echo $rate_per_hour ?>
                            </td>

                            <td class="table-image-container"><img class="reservation-image" onclick="openFullScreen()"
                                    src="<?php echo $photo ?>"></td>
                            <td class="td2">
                                <button class="edit-btn" type="submit" name="manage"><a
                                        href="confirmation.php?manage_id=<?php echo $reserve_id; ?>"><i
                                            class="fa-solid fa-arrow-up-right-from-square"></i> Open</a></button>
                                <button class="delete-btn" type="submit" name="reject"><i
                                        class="fa-solid fa-trash-arrow-up"></i> Reject</button>
                            </td>
                        </tr>

                    <?php } ?>
                </table>
            </form> <!-- table for pendings -->






            <!-- for confirmed table -->






            <form method="post" action="" class="table-container2" id="table-container2">
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
                    <?php $fetchdata = "SELECT * FROM reserve_room_tbl WHERE status='confirmed'";
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
                        $photo = $row['photo'];
                        $special_request = $row['special_request'];

                        ?>
                        <tr>
                            <td>
                                <input type="number" name="reserve_id" value="<?php echo $reserve_id ?>" readonly>
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
                                <?php echo $phone_number ?>
                            </td>
                            <td class="email">
                                <?php echo $email ?>
                            </td>
                            <td>
                                <?php echo $date_of_arrival ?>
                            </td>
                            <td>
                                <?php echo $time_of_arrival ?>
                            </td>
                            <td>
                                <?php echo $room_type ?>
                            </td>
                            <td>
                                <?php echo $number_of_person ?>
                            </td>
                            <td>
                                <?php echo $amenities ?>
                            </td>
                            <td>
                                <?php echo $rate_per_hour ?>
                            </td>

                            <td class="table-image-container"><img class="reservation-image" onclick="openFullScreen()"
                                    src="<?php echo $photo ?>"></td>
                            <td class="td2">
                                <button class="edit-btn" type="submit" name="manage"><a
                                        href="checkinForm.php?manage_id=<?php echo $reserve_id; ?>"><i
                                            class="fa-solid fa-arrow-up-right-from-square"></i> Check In</a></button>
                                <button class="delete-btn" type="submit" name="reject"><i
                                        class="fa-solid fa-trash-arrow-up"></i> Reject</button>
                            </td>
                        </tr>

                    <?php } ?>
                </table>
            </form> <!-- table for pendings -->






            <!-- for checkin table           -->





            <form method="post" action="" class="table-container3" id="table-container3">
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
                    <?php $fetchdata = "SELECT * FROM reserve_room_tbl WHERE status='checkedIn'";
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
                        $photo = $row['photo'];
                        $special_request = $row['special_request'];

                        ?>
                        <tr>
                            <td>
                                <input type="number" name="reserve_id" value="<?php echo $reserve_id ?>" readonly>
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
                                <?php echo $phone_number ?>
                            </td>
                            <td class="email">
                                <?php echo $email ?>
                            </td>
                            <td>
                                <?php echo $date_of_arrival ?>
                            </td>
                            <td>
                                <?php echo $time_of_arrival ?>
                            </td>
                            <td>
                                <?php echo $room_type ?>
                            </td>
                            <td>
                                <?php echo $number_of_person ?>
                            </td>
                            <td>
                                <?php echo $amenities ?>
                            </td>
                            <td>
                                <?php echo $rate_per_hour ?>
                            </td>

                            <td class="table-image-container"><img class="reservation-image" onclick="openFullScreen()"
                                    src="<?php echo $photo ?>"></td>
                            <td class="td2">
                                <button class="edit-btn" type="submit" name="manage"><a
                                        href="checkedInForm.php?manage_id=<?php echo $reserve_id; ?>"><i
                                            class="fa-solid fa-arrow-up-right-from-square"></i> Open</a></button>
                            </td>
                        </tr>

                    <?php } ?>
                </table>
            </form> <!-- table for pendings -->









            
            <!-- for extended table           -->




s
            <form method="post" action="" class="table-container6" id="table-container6">
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
                    <?php $fetchdata = "SELECT * FROM reserve_room_tbl WHERE status='extended'";
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
                        $photo = $row['photo'];
                        $special_request = $row['special_request'];

                        ?>
                        <tr>
                            <td>
                                <input type="number" name="reserve_id" value="<?php echo $reserve_id ?>" readonly>
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
                                <?php echo $phone_number ?>
                            </td>
                            <td class="email">
                                <?php echo $email ?>
                            </td>
                            <td>
                                <?php echo $date_of_arrival ?>
                            </td>
                            <td>
                                <?php echo $time_of_arrival ?>
                            </td>
                            <td>
                                <?php echo $room_type ?>
                            </td>
                            <td>
                                <?php echo $number_of_person ?>
                            </td>
                            <td>
                                <?php echo $amenities ?>
                            </td>
                            <td>
                                <?php echo $rate_per_hour ?>
                            </td>

                            <td class="table-image-container"><img class="reservation-image" onclick="openFullScreen()"
                                    src="<?php echo $photo ?>"></td>
                            <td class="td2">
                                <button class="edit-btn" type="submit" name="manage"><a
                                        href="checkedInForm.php?manage_id=<?php echo $reserve_id; ?>"><i
                                            class="fa-solid fa-arrow-up-right-from-square"></i> Open</a></button>
                            </td>
                        </tr>

                    <?php } ?>
                </table>
            </form> <!-- table for pendings -->



            <!-- for checked out table -->








            <form method="post" action="" class="table-container4" id="table-container4">
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
                    <?php $fetchdata = "SELECT * FROM reserve_room_tbl WHERE status='checkedOut'";
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
                        $photo = $row['photo'];
                        $special_request = $row['special_request'];

                        ?>
                        <tr>
                            <td>
                                <input type="number" name="reserve_id" value="<?php echo $reserve_id ?>" readonly>
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
                                <?php echo $phone_number ?>
                            </td>
                            <td class="email">
                                <?php echo $email ?>
                            </td>
                            <td>
                                <?php echo $date_of_arrival ?>
                            </td>
                            <td>
                                <?php echo $time_of_arrival ?>
                            </td>
                            <td>
                                <?php echo $room_type ?>
                            </td>
                            <td>
                                <?php echo $number_of_person ?>
                            </td>
                            <td>
                                <?php echo $amenities ?>
                            </td>
                            <td>
                                <?php echo $rate_per_hour ?>
                            </td>

                            <td class="table-image-container"><img class="reservation-image" onclick="openFullScreen()"
                                    src="<?php echo $photo ?>"></td>
                            <td class="td2">
                                <button class="edit-btn" type="submit" name="manage"><a
                                        href="checkinForm.php?manage_id=<?php echo $reserve_id; ?>"><i
                                            class="fa-solid fa-arrow-up-right-from-square"></i> Open</a></button>
                            </td>
                        </tr>

                    <?php } ?>
                </table>
            </form> <!-- table for pendings -->





            <!-- for rejected table -->




            <form method="post" action="" class="table-container5" id="table-container5">
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
                    <?php $fetchdata = "SELECT * FROM reserve_room_tbl WHERE status='rejected'";
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
                        $photo = $row['photo'];
                        $special_request = $row['special_request'];

                        ?>
                        <tr>
                            <td>
                                <input type="number" name="reserve_id" value="<?php echo $reserve_id ?>" readonly>
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
                                <?php echo $phone_number ?>
                            </td>
                            <td class="email">
                                <?php echo $email ?>
                            </td>
                            <td>
                                <?php echo $date_of_arrival ?>
                            </td>
                            <td>
                                <?php echo $time_of_arrival ?>
                            </td>
                            <td>
                                <?php echo $room_type ?>
                            </td>
                            <td>
                                <?php echo $number_of_person ?>
                            </td>
                            <td>
                                <?php echo $amenities ?>
                            </td>
                            <td>
                                <?php echo $rate_per_hour ?>
                            </td>

                            <td class="table-image-container"><img class="reservation-image" onclick="openFullScreen()"
                                    src="<?php echo $photo ?>"></td>
                            <td class="td2">
                                <button class="edit-btn" type="submit" name="manage"><a
                                        href="checkinForm.php?manage_id=<?php echo $reserve_id; ?>"><i
                                            class="fa-solid fa-arrow-up-right-from-square"></i> Open</a></button>
                            </td>
                        </tr>

                    <?php } ?>
                </table>
            </form> <!-- table for pendings -->












        </div>
    </div>
    <div id="fullscreen-overlay">
        <span class="close" onclick="closeFullScreen()">&times;</span>
        <img id="fullscreen-image" src="" alt="">
    </div>

    <script src="javascripts/fullscreen.js"></script>
    <script src="javascripts/reservation.js"></script>
</body>

</html>