<?php
include ('db_connect.php');
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location:../login.php');
    exit();
}


$manage_data = ['reserve_id' => '', 'fname' => '', 'mname' => '', 'lname' => '', 'address' => '', 'phone_number' => '', 'email' => '', 'date_of_arrival' => '', 'time_of_arrival' => '', 'room_type' => '', 'bed_type' => '', 'bed_quantity' => '', 'number_of_person' => '', 'amenities' => '', 'rate_per_hour' => '', 'special_request' => '', 'photo' => ''];

$message = "";
$isSuccess = false;


if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM reserve_room_tbl WHERE reserve_id = $manage_id";
    $manage_result = mysqli_query($con, $manage_query);
    $manage_data = mysqli_fetch_assoc($manage_result);
}

if (isset($_POST['confirm'])) {
    $reserve_id = $_POST['reserve_id'];
    $fname = $_POST['first_name'];
    $mname = $_POST['middle_name'];
    $lname = $_POST['last_name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $date_of_arrival = $_POST['date_of_arrival'];
    $time_of_arrival = $_POST['time_of_arrival'];
    $checkOutTime = $_POST['time_out'];
    $room_number = $_POST['room_number'];
    $room_type = $_POST['room_type'];
    $bed_type = $_POST['bed_type'];
    $bed_quantity = $_POST['bed_quantity'];
    $number_of_person = $_POST['number_of_person'];
    $amenities = $_POST['amenities'];
    $rate_per_hour = $_POST['rate_per_hour'];
    $special_request = $_POST['special_request'];
    $reservation_fee = $_POST['reservation_fee'];
    $extraBed = $_POST['extra_bed'];
    $extraPerson = $_POST['extra_person'];
    $totalFee = $_POST['total_fee'];

    $update_query = "UPDATE reserve_room_tbl SET status='confirmed', fname='$fname', mname='$mname', lname='$lname', address='$address', phone_number='$phone_number', email='$email', date_of_arrival='$date_of_arrival', time_of_arrival='$time_of_arrival', time_out='$checkOutTime',
     room_number='$room_number', room_type='$room_type', bed_type='$bed_type', bed_quantity='$bed_quantity',
      number_of_person='$number_of_person', amenities='$amenities' , rate_per_hour='$rate_per_hour', 
      special_request='$special_request', reservation_fee='$reservation_fee' , extra_bed='$extraBed' , 
      extra_person='$extraPerson', total_fee='$totalFee'  WHERE reserve_id='$reserve_id'";

    $manage_data = ['reserve_id' => '', 'fname' => '', 'mname' => '', 'lname' => '', 'address' => '', 'phone_number' => '', 'email' => '', 'date_of_arrival' => '', 'time_of_arrival' => '', 'room_number' => '', 'room_type' => '', 'bed_type' => '', 'bed_quantity' => '', 'number_of_person' => '', 'amenities' => '', 'rate_per_hour' => '', 'special_request' => '', 'photo' => ''];


    $query = (mysqli_query($con, $update_query));

    if ($query) {
        $message = "Changes Saved Successfully!";
        $isSuccess = true;

    } else {
        $message = "Failed!";
        $isSuccess = false;
    }
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="../sweetalert/sweetalert.js"></script>

    <script src="javascripts/logout.js" defer></script>
    <!-- <script src="javascripts/calculation.js" defer></script> -->
    <script src="javascripts/totalFee.js" defer></script>

    <link href="../fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../fontawesome/css/brands.css" rel="stylesheet" />
    <link href="../fontawesome/css/solid.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="backbtn.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="confirmation.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
    <title>Confirmation</title>
</head>

<body>

    <!-- for confirm -->
    <?php if (!empty($message)): ?>
        <script>
            Swal.fire({
                title: '<?php echo $isSuccess ? "Success!" : "Error!"; ?>',
                text: '<?php echo $message; ?>',
                icon: '<?php echo $isSuccess ? "success" : "error"; ?>',
                showConfirmButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.querySelector('.form-container').reset();
                }
            });

        </script>
    <?php endif; ?>

    <div>
        <nav class="navbar">
            <img src="../system_images/Picture1.png" class="logo1">
            <a class="logoLabel">Estregan Beach Resort</a>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="reservation.php">Reservations</a></li>
                <li class="dropdown">
                    <a href="rooms.php" class="reservation">Rooms/Cottages <i class="fa-solid fa-caret-down"></i></a>
                    <div class="dropdown-content">
                        <a href="#">Cottages</a>
                        <a href="rooms.php">Rooms</a>
                <li class="dropdown">
                    <a href="add_room.php" class="reservation">Add Reservation <i
                            class="fa-solid fa-caret-down"></i></a>
                    <div class="dropdown-content">
                        <a href="#">Add Cottages</a>
                        <a href="add_room.php">Add Rooms</a>

            </ul>
            <a class="logout-btn" id="logoutBtn"><i class="fa-solid fa-right-from-bracket"></i> Log out</a>
        </nav>
    </div>

    <div class="container">
        <div class="container2">
            <div class="header-label">
                <label for="">RESERVATION</label>
            </div>


            <form method="post" action="" class="form-container">

                <div class="info-container">
                    <div class="header-label2">
                        <label>CUSTOMER AND RESERVATION INFO</label>
                    </div>


                    <div>
                        <div class="line">
                            <div>
                                <label>First Name</label><br>
                                <input name="first_name" value="<?php echo $manage_data['fname']; ?>">
                            </div>
                            <div>
                                <label>Middle Name</label><br>
                                <input name="middle_name" value="<?php echo $manage_data['mname']; ?>">
                            </div>
                            <div>
                                <label>Last Name</label><br>
                                <input name="last_name" value="<?php echo $manage_data['lname']; ?>">
                            </div>
                            <div>
                                <label>Address</label><br>
                                <input name="address" value="<?php echo $manage_data['address']; ?>">
                            </div>
                        </div>
                        <div class="line">
                            <div>
                                <label>Phone Number</label><br>
                                <input name="phone_number" value="<?php echo $manage_data['phone_number']; ?>">
                            </div>
                            <div>
                                <label>Email</label><br>
                                <input class="notransform" name="email" value="<?php echo $manage_data['email']; ?>">
                            </div>
                            <div>
                                <label>Room Type</label><br>
                                <input name="room_type" value="<?php echo $manage_data['room_type']; ?>">
                            </div>
                            <div>
                                <label>Bed Type</label><br>
                                <input type="text" name="bed_type" value="<?php echo $manage_data['bed_type']; ?>">
                            </div>

                        </div>
                        <div class="line">
                            <div>
                                <label>No. Bed</label><br>
                                <input type="number" name="bed_quantity"
                                    value="<?php echo $manage_data['bed_quantity']; ?>">
                            </div>
                            <div>
                                <label>Number of Persons</label><br>
                                <input type="number" name="number_of_person"
                                    value="<?php echo $manage_data['number_of_person']; ?>">
                            </div>

                            <div>
                                <label>Amenities</label><br>
                                <input name="amenities" value="<?php echo $manage_data['amenities']; ?>">
                            </div>

                            <div>
                                <label>Price (₱) <em id="goodfor">*good for 22 hours*</em></label><br>
                                <input type="number" name="rate_per_hour"
                                    value="<?php echo $manage_data['rate_per_hour']; ?>">
                            </div>


                        </div>


                        <div class="line">
                            <div>
                                <label>Room Number</label><br>
                                <input type="number" class="notransform" name="room_number"
                                    value="<?php echo $manage_data['room_number']; ?>">
                            </div>
                            <div>
                                <label>Arrival Date</label><br>
                                <input type="date" class="notransform" name="date_of_arrival"
                                    value="<?php echo $manage_data['date_of_arrival']; ?>">
                            </div>
                            <div>
                                <label>Check-in Time</label><br>
                                <input type="time" name="time_of_arrival"
                                    value="<?php echo $manage_data['time_of_arrival']; ?>">
                            </div>

                            <div>
                                <label>Check-out Time</label><br>
                                <input type="time" name="time_out" value="11:00" required>
                            </div>

                        </div>



                        <div class="line">
                            <div>
                                <label>Special Request</label><br>
                                <textarea name="special_request"
                                    id=""><?php echo $manage_data['special_request']; ?></textarea>
                            </div>
                        </div>




                        <!-- <div class="edit-button-container">
                            <button class="edit-button">
                                <svg class="edit-svgIcon" viewBox="0 0 512 512">
                                    <path
                                        d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z">
                                    </path>
                                </svg>
                            </button>
                        </div> -->

                    </div>

                    <div class="note">
                        <p>
                            <b>Note:</b> Please note that the input fields are intentionally left open for any
                            necessary modifications or changes to customer and reservation information. We
                            understand that there may be updates or adjustments to be provided by the customer
                            during the confirmation of their reservation. Rest assured, we are committed to
                            accommodating any necessary revisions to ensure a seamless and satisfactory
                            experience.

                        </p>
                    </div>


                    <div class="line">
                        <div>
                            <label>Extra Bed (+₱600)<em id="goodfor">*If Applicable*</em></label><br>
                            <input type="number" class="notransform" name="extra_bed" value="0">
                        </div>

                        <div>
                            <label>Extra Person (+₱600) <em id="goodfor">*If Applicable*</em></label><br>
                            <input type="number" name="extra_person" value="0">
                        </div>



                        <div>
                            <label>Total Fee (₱)</label><br>
                            <input type="number" name="total_fee" value="" required>
                        </div>

                    </div>



                    <div class="header-label3">
                        <label>RESERVATION ADVANCE PAYMENT</label>
                    </div>
                    <div class="payment-container">

                        <div class="line">
                            <div>
                                <label>Reservation Fee</label><br>
                                <input type="number" name="reservation_fee" required>
                            </div>

                        </div>

                        <div class="invisible-id">
                            <div>
                                <label>id</label><br>
                                <input type="number" name="reserve_id"
                                    value="<?php echo $manage_data['reserve_id']; ?>">
                            </div>
                        </div>
                    </div>

                </div>



                <div class="image-container">
                    <div class="image-holder">
                        <img name="photo" src="<?php echo $manage_data['photo']; ?>" alt="">
                    </div>
                </div>

                <div class="button-container">
                    <div class="button-holder">
                        <button class="check-btn" type="submit" name="confirm"><i class="fa-solid fa-check-to-slot"></i>
                            Confirm</button>
                        <a href="reservation.php" class="back-btn"><i class="fa-solid fa-rotate-left"></i> Back</a>
                        <div>

                        </div>
            </form>
        </div>


</body>

</html>