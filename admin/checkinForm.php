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

if (isset($_POST['checkedin'])) {
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

    $update_query = "UPDATE reserve_room_tbl SET status='checkedIn', fname='$fname', mname='$mname', lname='$lname', address='$address', phone_number='$phone_number', email='$email', date_of_arrival='$date_of_arrival', time_of_arrival='$time_of_arrival', time_out='$checkOutTime',
    room_type='$room_type', bed_type='$bed_type', bed_quantity='$bed_quantity', number_of_person='$number_of_person', amenities='$amenities' , rate_per_hour='$rate_per_hour', special_request='$special_request', reservation_fee='$reservation_fee' , extra_bed='$extraBed' , extra_person='$extraPerson', total_fee='$totalFee'  WHERE reserve_id='$reserve_id'";

    $manage_data = ['reserve_id' => '', 'fname' => '', 'mname' => '', 'lname' => '', 'address' => '', 'phone_number' => '', 'email' => '', 'date_of_arrival' => '', 'time_of_arrival' => '','room_number' => '', 'room_type' => '', 'bed_type' => '', 'bed_quantity' => '', 'number_of_person' => '', 'amenities' => '', 'rate_per_hour' => '', 'special_request' => '', 'reservation_fee' => '', 'photo' => ''];




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
    <script src="javascripts/totalFee2.js" defer></script>

    <link href="../fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../fontawesome/css/brands.css" rel="stylesheet" />
    <link href="../fontawesome/css/solid.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="backbtn.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="checkinForm.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
    <title>Check In</title>
</head>

<body>

    <!-- for checkin -->
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
                                <input name="first_name" value="<?php echo $manage_data['fname']; ?>" readonly>
                            </div>
                            <div>
                                <label>Middle Name</label><br>
                                <input name="middle_name" value="<?php echo $manage_data['mname']; ?>" readonly>
                            </div>
                            <div>
                                <label>Last Name</label><br>
                                <input name="last_name" value="<?php echo $manage_data['lname']; ?>" readonly>
                            </div>
                            <div>
                                <label>Address</label><br>
                                <input name="address" value="<?php echo $manage_data['address']; ?>" readonly>
                            </div>
                        </div>
                        <div class="line">
                            <div>
                                <label>Phone Number</label><br>
                                <input name="phone_number" value="<?php echo $manage_data['phone_number']; ?>" readonly>
                            </div>
                            <div>
                                <label>Email</label><br>
                                <input class="notransform" name="email" value="<?php echo $manage_data['email']; ?>"
                                    readonly>
                            </div>
                            <div>
                                <label>Room Type</label><br>
                                <input name="room_type" value="<?php echo $manage_data['room_type']; ?>" readonly>
                            </div>
                            <div>
                                <label>Bed Type</label><br>
                                <input type="text" name="bed_type" value="<?php echo $manage_data['bed_type']; ?>"
                                    readonly>
                            </div>

                        </div>
                        <div class="line">
                            <div>
                                <label>No. Bed</label><br>
                                <input type="number" name="bed_quantity"
                                    value="<?php echo $manage_data['bed_quantity']; ?>" readonly>
                            </div>
                            <div>
                                <label>Number of Persons</label><br>
                                <input type="number" name="number_of_person"
                                    value="<?php echo $manage_data['number_of_person']; ?>" readonly>
                            </div>

                            <div>
                                <label>Amenities</label><br>
                                <input name="amenities" value="<?php echo $manage_data['amenities']; ?>" readonly>
                            </div>

                            <div>
                                <label>Price (₱) <em id="goodfor">*good for 22 hours*</em></label><br>
                                <input type="number" name="rate_per_hour"
                                    value="<?php echo $manage_data['rate_per_hour']; ?>" readonly>
                            </div>


                        </div>


                        <div class="line">
                            <div>
                                <label>Room Number</label><br>
                                <input type="number" class="notransform" name="room_number"
                                    value="<?php echo $manage_data['room_number']; ?>" readonly>
                            </div>
                            <div>
                                <label>Arrival Date</label><br>
                                <input type="date" class="notransform" name="date_of_arrival"
                                    value="<?php echo $manage_data['date_of_arrival']; ?>" readonly>
                            </div>
                            <div>
                                <label>Check-in Time</label><br>
                                <input type="time" name="time_of_arrival"
                                    value="<?php echo $manage_data['time_of_arrival']; ?>" readonly>
                            </div>

                            <div>
                                <label>Check-out Time</label><br>
                                <input type="time" name="time_out" value="11:00" required readonly>
                            </div>

                        </div>



                        <div class="line">
                            <div>
                                <label>Special Request</label><br>
                                <textarea name="special_request" id=""
                                    readonly><?php echo $manage_data['special_request']; ?></textarea>
                            </div>
                        </div>


                    </div>

                    <div class="note">
                        <p>
                            <b>Note:</b> Once the customer has arrived at the hotel, this form will be marked as
                            "checked in." Please note that any modifications to the customer's information above are no
                            longer allowed. However, the customer is welcome to request additional beds or accommodate
                            more people, provided that the required additional amount is paid. We strive to ensure a
                            seamless and comfortable experience for our guests throughout their stay.

                        </p>
                    </div>

                    <div class="header-label3">
                        <label>PAYMENT</label>
                    </div>
                    <div class="payment-container">

                        <div class="line">

                            <div>
                                <label>Reservation Payment (Paid)</label><br>
                                <input type="number" class="notransform" name="reservation_fee"
                                    value="<?php echo $manage_data['reservation_fee']; ?>" readonly>
                            </div>

                            <div>
                                <label>Extra Bed (+₱600)<em id="goodfor">*If Applicable*</em></label><br>
                                <input type="number" class="notransform" name="extra_bed" value="0">
                            </div>

                            <div>
                                <label>Extra Person (+₱600) <em id="goodfor">*If Applicable*</em></label><br>
                                <input type="number" name="extra_person" value="0">
                            </div>

                            <div>
                                <label>New Total Fee (₱)</label><br>
                                <input type="number" name="total_fee" value="" required>
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
                        <button class="check-btn" type="submit" name="checkedin"><i
                                class="fa-solid fa-check-to-slot"></i> Checked In</button>
                        <a href="reservation.php" class="back-btn"><i class="fa-solid fa-rotate-left"></i> Back</a>
                        <div>

                        </div>
            </form>
        </div>

        <script src="javascripts/calculation.js"></script>
        <script src="javascripts/subtract.js"></script>

</body>

</html>