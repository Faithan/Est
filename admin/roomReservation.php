<?php
require ('db_connect.php');
session_start();


$message = "";
$isSuccess = false;


if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM reserve_room_tbl WHERE reserve_id = $manage_id";
    $manage_result = mysqli_query($con, $manage_query);
    $manage_data = mysqli_fetch_assoc($manage_result);
}

// if (isset($_POST['reject'])) {
//     $reserve_id = $_POST['reserve_id'];
//     $update_query = "UPDATE reserve_room_tbl SET status='rejected' WHERE reserve_id='$reserve_id'";
//     $query = (mysqli_query($con, $update_query));

//     if ($query) {
//         $message = "Rejected Successfully!";
//         $isSuccess = true;

//     } else {
//         $message = "Failed!";
//         $isSuccess = false;
//     }
// }


?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- important files -->
    <?php
    include 'assets.php'
        ?>


    <script src="javascripts/logout.js" defer></script>


    <link rel="stylesheet" type="text/css" href="css/backbtn.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" type="text/css" href="css/roomReservation.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/fullscreen.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
    <title>Reservation</title>
</head>


<!-- for reject -->
<?php if (!empty($message)): ?>
    <script>
        Swal.fire({
            title: '<?php echo $isSuccess ? "Success!" : "Error!"; ?>',
            text: '<?php echo $message; ?>',
            icon: '<?php echo $isSuccess ? "success" : "error"; ?>',
            showConfirmButton: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = window.location.href;
            }
        });
    </script>
<?php endif; ?>

<?php
include 'header.php'
    ?>


<div class="container">
    <div class="container2">
        <div class="header-label">
            <label for=""><i class="fa-solid fa-bed"></i> RESERVATION FOR ROOMS</label>
        </div>

        <div class="buttons-container">
            <button onclick="showTablePendings()" id="pending-btn" class="pending-btn"><i
                    class="fa-solid fa-hourglass-half"></i> Pendings</button>
            <button onclick="showTableConfirmed()" id="confirmed-btn"><i class="fa-regular fa-calendar-check"></i>
                Confirmed</button>
            <button onclick="showTableCheckedIn()" id="checkedIn-btn"><i class="fa-solid fa-check-to-slot"></i> Checked
                In</button>
            <button onclick="showTableExtended()" id="extended-btn"><i class="fa-solid fa-hourglass-start"></i> Extended
                Stay</button>
            <button onclick="showTableCheckedOut()" id="checkedOut-btn"><i class="fa-solid fa-user-check"></i> Checked
                Out</button>
            <button onclick="showTableRejected()" id="rejected-btn" class="rejected-btn"><i
                    class="fa-solid fa-user-xmark"></i> Rejected</button>
        </div>




        <div class="under-buttons-container">
            <div class="select-type">
                <label for="">Type of Reservation:</label>
                <select name="" id="">
                    <option value="all">All</option>
                    <option value="walk-in">Walk-in</option>
                    <option value="online">Online</option>
                </select>
            </div>

            <div>
                <div class="group">
                    <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                        <g>
                            <path
                                d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                            </path>
                        </g>
                    </svg>
                    <input placeholder="Search" type="search" class="search-input">
                </div>
            </div>

            <div class="add-reservation">
                <label for=""><em>For Walk-in <i class="fa-solid fa-hand-point-left fa-flip-horizontal"></i>
                    </em></label>
                <button name="add-reservation"><i class="fa-solid fa-plus"></i> ADD RESERVATION</button>
            </div>
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
                    <th>Room Type</th>
                    <th>Bed Type</th>
                    <th>Bed Quantity</th>
                    <th>Number of Person</th>
                    <th>Amenities</th>
                    <th>Price (Good for 22 hours)</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
                <?php $fetchdata = "SELECT * FROM reserve_room_tbl WHERE status='pending' ORDER BY reserve_id DESC";
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
                    $bed_type = $row['bed_type'];
                    $bed_quantity = $row['bed_quantity'];
                    $number_of_person = $row['number_of_person'];
                    $amenities = $row['amenities'];
                    $rate_per_hour = $row['price'];
                    $photo = $row['photo'];
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
                            <?php echo $phone_number ?>
                        </td>
                        <td class="email">
                            <?php echo $email ?>
                        </td>
                        <td>
                            <?php echo $date_of_arrival ?>
                        </td>
                        <td>
                            <?php echo $room_type ?>
                        </td>
                        <td>
                            <?php echo $bed_type ?>
                        </td>
                        <td>
                            <?php echo $bed_quantity ?>
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


                        <td>
                            <div class="edit-btn">
                                <a name="manage" href="confirmation.php?manage_id=<?php echo $reserve_id; ?>"><i
                                        class="fa-solid fa-arrow-up-right-from-square"></i>Open</a>
                            </div>
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

                    <th>Room Type</th>
                    <th>Bed Type</th>
                    <th>Bed Quantity</th>
                    <th>Number of Person</th>
                    <th>Amenities</th>
                    <th>Price (Good for 22 hours)</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
                <?php $fetchdata = "SELECT * FROM reserve_room_tbl WHERE status='confirmed' ORDER BY reserve_id DESC";
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
                    $bed_type = $row['bed_type'];
                    $bed_quantity = $row['bed_quantity'];
                    $number_of_person = $row['number_of_person'];
                    $amenities = $row['amenities'];
                    $rate_per_hour = $row['price'];
                    $photo = $row['photo'];
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
                            <?php echo $phone_number ?>
                        </td>
                        <td class="email">
                            <?php echo $email ?>
                        </td>
                        <td>
                            <?php echo $date_of_arrival ?>
                        </td>

                        <td>
                            <?php echo $room_type ?>
                        </td>
                        <td>
                            <?php echo $bed_type ?>
                        </td>
                        <td>
                            <?php echo $bed_quantity ?>
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



                        <td>
                            <div class="edit-btn">
                                <a name="manage" href="checkinForm.php?manage_id=<?php echo $reserve_id; ?>"><i
                                        class="fa-solid fa-arrow-up-right-from-square"></i>Open</a>
                            </div>
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

                    <th>Room Type</th>
                    <th>Bed Type</th>
                    <th>Bed Quantity</th>
                    <th>Number of Person</th>
                    <th>Amenities</th>
                    <th>Price (Good for 22 hours)</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
                <?php $fetchdata = "SELECT * FROM reserve_room_tbl WHERE status='checkedIn' ORDER BY reserve_id DESC";
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
                    $bed_type = $row['bed_type'];
                    $bed_quantity = $row['bed_quantity'];
                    $number_of_person = $row['number_of_person'];
                    $amenities = $row['amenities'];
                    $rate_per_hour = $row['price'];
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
                            <?php echo $room_type ?>
                        </td>
                        <td>
                            <?php echo $bed_type ?>
                        </td>
                        <td>
                            <?php echo $bed_quantity ?>
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


                        <td>
                            <div class="edit-btn">
                                <a name="manage" href="checkedInForm.php?manage_id=<?php echo $reserve_id; ?>"><i
                                        class="fa-solid fa-arrow-up-right-from-square"></i>Open</a>
                            </div>
                        </td>

                    </tr>

                <?php } ?>
            </table>
        </form> <!-- table for pendings -->










        <!-- for extended table           -->



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

                    <th>Room Type</th>
                    <th>Bed Type</th>
                    <th>Bed Quantity</th>
                    <th>Number of Person</th>
                    <th>Amenities</th>
                    <th>Price (Good for 22 hours)</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
                <?php $fetchdata = "SELECT * FROM reserve_room_tbl WHERE status='extended' ORDER BY reserve_id DESC";
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
                    $bed_type = $row['bed_type'];
                    $bed_quantity = $row['bed_quantity'];
                    $number_of_person = $row['number_of_person'];
                    $amenities = $row['amenities'];
                    $rate_per_hour = $row['price'];
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
                            <?php echo $room_type ?>
                        </td>
                        <td>
                            <?php echo $bed_type ?>
                        </td>
                        <td>
                            <?php echo $bed_quantity ?>
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

                        <td>
                            <div class="edit-btn">
                                <a name="manage" href="extended.php?manage_id=<?php echo $reserve_id; ?>"><i
                                        class="fa-solid fa-arrow-up-right-from-square"></i>Open</a>
                            </div>
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

                    <th>Room Type</th>
                    <th>Bed Type</th>
                    <th>Bed Quantity</th>
                    <th>Number of Person</th>
                    <th>Amenities</th>
                    <th>Price (Good for 22 hours)</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
                <?php $fetchdata = "SELECT * FROM reserve_room_tbl WHERE status='checkedOut' ORDER BY reserve_id DESC";
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
                    $bed_type = $row['bed_type'];
                    $bed_quantity = $row['bed_quantity'];
                    $number_of_person = $row['number_of_person'];
                    $amenities = $row['amenities'];
                    $rate_per_hour = $row['price'];
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
                            <?php echo $room_type ?>
                        </td>
                        <td>
                            <?php echo $bed_type ?>
                        </td>
                        <td>
                            <?php echo $bed_quantity ?>
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


                        <td>
                            <div class="edit-btn">
                                <a name="manage" href="checkoutForm.php?manage_id=<?php echo $reserve_id; ?>"><i
                                        class="fa-solid fa-arrow-up-right-from-square"></i>Open</a>
                            </div>
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

                    <th>Room Type</th>
                    <th>Bed Type</th>
                    <th>Bed Quantity</th>
                    <th>Number of Person</th>
                    <th>Amenities</th>
                    <th>Price (Good for 22 hours)</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
                <?php $fetchdata = "SELECT * FROM reserve_room_tbl WHERE status='rejected' OR status='cancelled' ORDER BY reserve_id DESC";
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
                    $bed_type = $row['bed_type'];
                    $bed_quantity = $row['bed_quantity'];
                    $number_of_person = $row['number_of_person'];
                    $amenities = $row['amenities'];
                    $rate_per_hour = $row['price'];
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
                            <?php echo $room_type ?>
                        </td>
                        <td>
                            <?php echo $bed_type ?>
                        </td>
                        <td>
                            <?php echo $bed_quantity ?>
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

                        <td>
                            <div class="edit-btn">
                                <a name="manage" href="rejected.php?manage_id=<?php echo $reserve_id; ?>"><i
                                        class="fa-solid fa-arrow-up-right-from-square"></i>Open</a>
                            </div>
                        </td>


                    </tr>

                <?php } ?>
            </table>
        </form> <!-- table for rejected -->












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